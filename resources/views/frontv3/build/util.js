const async = require("async");
const os = require('os');
const fs = require('fs');
const path = require('path');
const http = require('http');
const nodekl = require('nodekl');
const ExtractTextPlugin = require('extract-text-webpack-plugin')

const cp = require('child_process');
const execSync = cp.execSync;

var PHP_CONFIG = {
    ENV_WEB: {
        devsrv: 'http://tifa.wsdev.com',
    }
};

const config_dir = path.join(path.resolve(__dirname, '../../../..'), 'config')
const dump = path.join(config_dir, 'dumpjson.php')
const config = path.join(config_dir, 'app-config.ignore.php')
fs.exists(config, function (exists) {
    if (exists) {
        var output = execSync(`php ${dump} ${config}`);

        PHP_CONFIG = output ? JSON.parse(output) : {};
    } else {

    }
});

function autoBuildApi() {
    var http_host = (PHP_CONFIG['ENV_WEB'] || {})['devsrv'];
    if (!http_host) {
        return;
    }
    var dev_token = nodekl.encode(PHP_CONFIG['ENV_DEVELOP_KEY'], PHP_CONFIG['CRYPT_KEY']);
    dev_token && !(function () {
        console.log('\nbuild api js');
        setTimeout(function () {
            var url = http_host + "/develop/deploy/buildapimodjs?dev_debug=1&dev_token=" + dev_token;
            http.get(url, function (res) {
                console.log("Build API js response: " + res.statusCode);
                res.statusCode != 200 && console.log(url);
            }).on('error', function (e) {
                console.log("Build API js error: " + e.message);
                console.log(url);
            });
        }, 100);

        setTimeout(function () {
            var url = http_host + "/api/ApiHub/autoBuildComponentImport?dev_debug=1&dev_token=" + dev_token;
            http.get(url, function (res) {
                console.log("Build autoBuildComponentImport js response: " + res.statusCode);
                res.statusCode != 200 && console.log(url);
            }).on('error', function (e) {
                console.log("Build autoBuildComponentImport js error: " + e.message);
                console.log(url);
            });
        }, 1100);
    })();
}

// cursively make dir
function mkdirs(p, mode, f, made) {
    if (typeof mode === 'function' || mode === undefined) {
        f = mode;
        mode = 777 & (~process.umask());
    }
    if (!made)
        made = null;

    var cb = f || function () {};
    if (typeof mode === 'string')
        mode = parseInt(mode, 8);
    p = path.resolve(p);

    fs.mkdir(p, mode, function (er) {
        if (!er) {
            made = made || p;
            return cb(null, made);
        }
        switch (er.code) {
            case 'ENOENT':
                mkdirs(path.dirname(p), mode, function (er, made) {
                    if (er) {
                        cb(er, made);
                    } else {
                        mkdirs(p, mode, cb, made);
                    }
                });
                break;

                // In the case of any other error, just see if there's a dir
                // there already.  If so, then hooray!  If not, then something
                // is borked.
            default:
                fs.stat(p, function (er2, stat) {
                    // if the stat fails, then that's super weird.
                    // let the original error be the failure reason.
                    if (er2 || !stat.isDirectory()) {
                        cb(er, made);
                    } else {
                        cb(null, made)
                    }
                });
                break;
        }
    });
}
// single file copy
function copyFile(file, toDir, cb) {
    async.waterfall([
        function (callback) {
            fs.exists(toDir, function (exists) {
                if (exists) {
                    callback(null, false);
                } else {
                    callback(null, true);
                }
            });
        },
        function (need, callback) {
            if (need) {
                mkdirs(path.dirname(toDir), callback);
            } else {
                callback(null, true);
            }
        },
        function (p, callback) {
            var reads = fs.createReadStream(file);
            var writes = fs.createWriteStream(path.join(path.dirname(toDir), path.basename(file)));
            reads.pipe(writes);
            //don't forget close the  when  all the data are read
            reads.on("end", function () {
                writes.end();
                callback(null);
            });
            reads.on("error", function (err) {
                console.log("error occur in reads");
                callback(true, err);
            });

        }
    ], cb);

}

// cursively count the  files that need to be copied

function _ccoutTask(from, to, cbw) {
    async.waterfall([
        function (callback) {
            fs.stat(from, callback);
        },
        function (stats, callback) {
            if (stats.isFile()) {
                cbw.addFile(from, to);
                callback(null, []);
            } else if (stats.isDirectory()) {
                fs.readdir(from, callback);
            }
        },
        function (files, callback) {
            if (files.length) {
                for (var i = 0; i < files.length; i++) {
                    _ccoutTask(path.join(from, files[i]), path.join(to, files[i]), cbw.increase());
                }
            }
            callback(null);
        }
    ], cbw);

}
// wrap the callback before counting
function ccoutTask(from, to, cb) {
    var files = [];
    var count = 1;

    function wrapper(err) {
        count--;
        if (err || count <= 0) {
            cb(err, files)
        }
    }
    wrapper.increase = function () {
        count++;
        return wrapper;
    }
    wrapper.addFile = function (file, dir) {
        files.push({
            file: file,
            dir: dir
        });
    }

    _ccoutTask(from, to, wrapper);
}

function copyDir(from, to, cb) {
    if (!cb) {
        cb = function () {};
    }
    async.waterfall([
        function (callback) {
            fs.exists(from, function (exists) {
                if (exists) {
                    callback(null, true);
                } else {
                    console.log(from + " not exists");
                    callback(true);
                }
            });
        },
        function (exists, callback) {
            fs.stat(from, callback);
        },
        function (stats, callback) {
            if (stats.isFile()) {
                // one file copy
                copyFile(from, to, function (err) {
                    if (err) {
                        // break the waterfall
                        callback(true);
                    } else {
                        callback(null, []);
                    }
                });
            } else if (stats.isDirectory()) {
                ccoutTask(from, to, callback);
            }
        },
        function (files, callback) {
            // prevent reaching to max file open limit
            async.mapLimit(files, 30, function (f, cb) {
                copyFile(f.file, f.dir, cb);
            }, callback);
        }
    ], cb);
}


var cssLoaders = function (options) {
    options = options || {}

    const cssLoader = {
        loader: 'css-loader',
        options: {
            sourceMap: options.sourceMap
        }
    }

    const postcssLoader = {
        loader: 'postcss-loader',
        options: {
            sourceMap: options.sourceMap
        }
    }

    // generate loader string to be used with extract text plugin
    function generateLoaders(loader, loaderOptions) {
        const loaders = options.usePostCSS ? [cssLoader, postcssLoader] : [cssLoader]

        if (loader) {
            loaders.push({
                loader: loader + '-loader',
                options: Object.assign({}, loaderOptions, {
                    sourceMap: options.sourceMap
                })
            })
        }

        // Extract CSS when that option is specified
        // (which is the case during production build)
        if (options.extract) {
            return ExtractTextPlugin.extract({
                use: loaders,
                fallback: 'vue-style-loader'
            })
        } else {
            return ['vue-style-loader'].concat(loaders)
        }
    }

    // https://vue-loader.vuejs.org/en/configurations/extract-css.html
    return {
        css: generateLoaders(),
        postcss: generateLoaders(),
        less: generateLoaders('less'),
        sass: generateLoaders('sass', {
            indentedSyntax: true
        }),
        scss: generateLoaders('sass'),
        stylus: generateLoaders('stylus'),
        styl: generateLoaders('stylus')
    }
}

// Generate loaders for standalone style files (outside of .vue)
var styleLoaders = function (options) {
    const output = []
    const loaders = cssLoaders(options)

    for (const extension in loaders) {
        const loader = loaders[extension]
        output.push({
            test: new RegExp('\\.' + extension + '$'),
            use: loader
        })
    }

    return output
}

function scanFiles(inPath, func, dir_func) {
  var file_map = {};
  var files = fs.readdirSync(inPath);
  files.forEach(function(filename) {
    if(filename == '.' || filename == '..') {
      return;
    }
    var f_path = path.join(inPath, filename);
    var stats = fs.statSync(f_path);
    if(stats.isFile()){   //是文件
      if(func) {
        var test = func(f_path);
        if(test) {
          file_map[f_path] = filename;
        }
      } else {
        file_map[f_path] = filename;
      }
    } else if(stats.isDirectory()){   //是子目录
      if(dir_func) {
        var test = dir_func(f_path + '\\');
        if(test) {
          var tmp = scanFiles(f_path, func, dir_func);
          file_map = Object.assign(file_map, tmp);
        }
      } else {
        var tmp = scanFiles(f_path, func, dir_func);
        file_map = Object.assign(file_map, tmp);
      }
    }
  });
  return file_map;
}

module.exports = {
    scanFiles: scanFiles,
    cssLoaders: cssLoaders,
    styleLoaders: styleLoaders,
    autoBuildApi: autoBuildApi,
    mkdirs: mkdirs,
    copyFile: copyFile,
    copyDir: copyDir,
    PHP_CONFIG: PHP_CONFIG
};
