'use strict'
const fs = require('fs');
const path = require('path')
const utils = require('./utils')
const util = require("./util.js");
const webpack = require('webpack')
const config = require('../config')
const merge = require('webpack-merge')
const baseWebpackConfig = require('./webpack.base.conf')
const CopyWebpackPlugin = require('copy-webpack-plugin')
const HtmlWebpackPlugin = require('html-webpack-plugin')
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const OptimizeCSSPlugin = require('optimize-css-assets-webpack-plugin')
const cleanWebpackPlugin = require("clean-webpack-plugin");

//字体转换插件
const postcss = require('postcss');
const px2rem = require('postcss-plugin-px2rem')


const env = config.build.env

const webpackConfig = merge(baseWebpackConfig, {
  module: {
    rules: utils.styleLoaders({
      sourceMap: config.build.productionSourceMap,
      extract: true
    })
  },
  devtool: false,
  output: {
      path: path.resolve(__dirname, '../../../../public/assets/dist_f'),
      publicPath: "/assets/dist_f/",
      filename: "[name].js",
      chunkFilename: "[name].[chunkhash:16].chunk.js"
  },
  plugins: [
    new webpack.ProvidePlugin({
      Promise: "bluebird"
    }),
    new webpack.NormalModuleReplacementPlugin(/es6-promise$/, "bluebird"),
    new cleanWebpackPlugin(
      ["resources/views/frontv3/dist/dist/*", "public/assets/dist_f/*"], {
          root: path.resolve(__dirname, "../../../../")
      }
    ),
    // http://vuejs.github.io/vue-loader/en/workflow/production.html
    new webpack.DefinePlugin({
      'process.env': env
    }),
    // UglifyJs do not support ES6+, you can also use babel-minify for better treeshaking: https://github.com/babel/minify
    new webpack.optimize.UglifyJsPlugin({
       compress: {
         warnings: false
       },
       sourceMap: false
    }),
    // extract css into its own file
    new ExtractTextPlugin({
      filename: utils.assetsPath('css/[name].css')
    }),
    // Compress extracted CSS. We are using this plugin so that possible
    // duplicated CSS from different components can be deduped.
    new OptimizeCSSPlugin({
      cssProcessorOptions: {
        safe: true
      }
    }),
    new webpack.optimize.CommonsChunkPlugin('vendor'),
    // keep module.id stable when vender modules does not change
    new webpack.HashedModuleIdsPlugin(),
    function () {
      this.plugin('done', function (statsData) {
        const stats = statsData.toJson();
        if (stats.errors.length) {
          return;
        }
        util.autoBuildApi();

        //phone
        const inFileName_phone = config.base_phone + '/index.blade.php';
        const outFileName_phone = config.base_phone + '/room.blade.php';
        const outFileName_phone_prod = config.base_phone + '/room_prod.blade.php';
        const html = fs.readFileSync(inFileName_phone, 'utf8');

        let htmlOutput = html.replace(/vendor.js\?v=/, 'vendor.js?v=' + stats.hash)
          .replace(/phone.js\?v=/, 'phone.js?v=' + stats.hash);
        fs.writeFileSync(outFileName_phone, htmlOutput);
        fs.writeFileSync(outFileName_phone_prod, htmlOutput);

        //pc
        const inFileName_pc = config.base_pc + '/index.blade.php';
        const outFileName_pc = config.base_pc + '/room.blade.php';
        const outFileName_pc_prod = config.base_pc + '/room_prod.blade.php';
        const html_pc = fs.readFileSync(inFileName_pc, 'utf8');
        let htmlOutput_pc = html_pc.replace(/vendor.js\?v=/, 'vendor.js?v=' + stats.hash)
          .replace(/pc.js\?v=/, 'pc.js?v=' + stats.hash);
        fs.writeFileSync(outFileName_pc, htmlOutput_pc);
        fs.writeFileSync(outFileName_pc_prod, htmlOutput_pc);
      });
    }
  ]
})

if (config.build.productionGzip) {
  const CompressionWebpackPlugin = require('compression-webpack-plugin')

  webpackConfig.plugins.push(
    new CompressionWebpackPlugin({
      asset: '[path].gz[query]',
      algorithm: 'gzip',
      test: new RegExp(
        '\\.(' +
        config.build.productionGzipExtensions.join('|') +
        ')$'
      ),
      threshold: 10240,
      minRatio: 0.8
    })
  )
}


if (config.build.bundleAnalyzerReport) {
  const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin
  webpackConfig.plugins.push(new BundleAnalyzerPlugin())
}

module.exports = webpackConfig
