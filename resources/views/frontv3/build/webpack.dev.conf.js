'use strict'
const fs = require('fs');
const path = require('path')
const utils = require('./utils')
const util = require("./util.js");
const webpack = require('webpack')
const config = require('../config')
const merge = require('webpack-merge')
const baseWebpackConfig = require('./webpack.base.conf')
const HtmlWebpackPlugin = require('html-webpack-plugin')
const FriendlyErrorsPlugin = require('friendly-errors-webpack-plugin')
const cleanWebpackPlugin = require("clean-webpack-plugin");

//字体转换插件
 const postcss = require('postcss');
 const pxtorem = require('postcss-plugin-px2rem')

// add hot-reload related code to entry chunks
Object.keys(baseWebpackConfig.entry).forEach(function (name) {
  // baseWebpackConfig.entry[name] = ['./build/dev-client'].concat(baseWebpackConfig.entry[name])
  baseWebpackConfig.entry[name] = baseWebpackConfig.entry[name]

})

module.exports = merge(baseWebpackConfig, {
  module: {
    rules: utils.styleLoaders({ sourceMap: config.dev.cssSourceMap })
  },
  // cheap-module-eval-source-map is faster for development
  devtool: '#cheap-module-eval-source-map',
  output: {
      path: path.resolve(__dirname, '../../../../public/assets/dist_f_dev'),
      publicPath: "/assets/dist_f_dev/",
      filename: "[name].js",
      chunkFilename: "[name].[chunkhash:16].chunk.js"
  },
  plugins: [
    new webpack.ProvidePlugin({
        Promise: "bluebird"
    }),
    new webpack.NormalModuleReplacementPlugin(/es6-promise$/, "bluebird"),
    new cleanWebpackPlugin(
        ["resources/views/frontv3/dist/dist/*", "public/assets/dist_f_dev/*"], {
            root: path.resolve(__dirname, "../../../../")
        }
    ),
    new webpack.DefinePlugin({
      'process.env': config.dev.env
    }),
    // https://github.com/glenjamin/webpack-hot-middleware#installation--usage
    new webpack.HotModuleReplacementPlugin(),
    new webpack.NoEmitOnErrorsPlugin(),
    new webpack.optimize.CommonsChunkPlugin('vendor'),
    new FriendlyErrorsPlugin(),

    new webpack.LoaderOptionsPlugin({
      options: {
        postcssLoader: () => {
          return [
            require('postcss-px2rem')()
          ]
        }
      }
    }),

    function() {
      this.plugin('done', function(statsData) {
        const stats = statsData.toJson();
        if (stats.errors.length) {
            return ;
        }
        util.autoBuildApi();

        const inFileName = config.base_phone +  '/index.blade.php';
        const outFileName = config.base_phone +  '/room.blade.php';
        const html = fs.readFileSync(inFileName, 'utf8');
        let htmlOutput = html.replace(/\/dist_f\/vendor.js\?v=/, '/dist_f_dev/vendor.js?v=' + stats.hash).replace(/\/dist_f\/phone.js\?v=/, '/dist_f_dev/phone.js?v=' + stats.hash);
        fs.writeFileSync(outFileName, htmlOutput);

        //pc端
        const inFileName_pc = config.base_pc +  '/index.blade.php';
        const outFileName_pc = config.base_pc +  '/room.blade.php';
        const html_pc = fs.readFileSync(inFileName_pc, 'utf8');
        let htmlOutput_pc = html_pc.replace(/\/dist_f\/vendor.js\?v=/, '/dist_f_dev/vendor.js?v=' + stats.hash).replace(/\/dist_f\/pc.js\?v=/, '/dist_f_dev/pc.js?v=' + stats.hash);
        fs.writeFileSync(outFileName_pc, htmlOutput_pc);
      });
    }
  ],
})



