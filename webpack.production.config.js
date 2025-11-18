/**
 *  Require
 *  --------
 *  Load required modules. Webpack will load it's own `loaders` as defined
 *  within the exported configuration object, however Node.js libraries (ie: `webpack`)
 *  plugins (ie: ExtractTextPlugin), and objects (ie: package.json) need to be
 *  loaded in separatly.
 *
 */

var webpack = require('webpack'),
    extend = require('extend'),
    moment = require('moment'),
    util = require('util'),

//  Import Plugins
//  -------------------
    MiniCssExtractPlugin = require("mini-css-extract-plugin"),
    HtmlWebpackPlugin = require('html-webpack-plugin'),
    // BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin,

//  Import Config Files
//  -------------------

    baseConfig = require('./webpack.config'),
    // data = require('./src/data/data.json'),
    pkg = require('./package.json');

    pkg.icdn = pkg.cdn;


    // pkg.data = require('./src/data/data.json');

const { CleanWebpackPlugin } = require('clean-webpack-plugin');

//  Exports
//  -------------------

    module.exports = extend(true, baseConfig,
    {
        /**
         *  DevTool
         *  --------
         *  Controls SourceMapping.
         *
         */

        devtool : 'source-map',

        /**
         *  Output
         *  -------
         *  Mofify output object from the core config.
         *
         */

        output :
        {
            publicPath: pkg.cdn
        },

        /**
         *  Plugins
         *  --------
         *  Mofify plugins object from the core config.
         *
         */

        plugins :
        [
            /**
             *  CleanWebpackPlugin
             *  -------------------
             *  CleanWebpackPlugin deletes the distribution folder before building.
             *
             */

            new CleanWebpackPlugin({cleanOnceBeforeBuildPatterns: ['dist/', 'build/']}),

            // new BundleAnalyzerPlugin(),
            /**
             *  HtmlWebpackPlugin
             *  ------------------
             *  HtmlWebpackPlugin invokes the `handlebars` rule within the Webpack
             *  to the `template` file to be generated into the distribution folder.
             *
             */

            new HtmlWebpackPlugin(
            {
                filename : 'index.html',
                template : './src/views/index.hbs',
                prettyDate : moment().format('YYYY/MM/DD'),
                timestamp : moment().format('DDMMYYhmm'),
                pkg : pkg,
                inject : false
            }),
            new HtmlWebpackPlugin(
            {
                filename : 'standards-reusable.html',
                template : './src/views/standards-reusable.hbs',
                prettyDate : moment().format('YYYY/MM/DD'),
                timestamp : moment().format('DDMMYYhmm'),
                pkg : pkg,
                inject : false
            }),
            new HtmlWebpackPlugin(
            {
                filename : 'standards-preloved.html',
                template : './src/views/standards-preloved.hbs',
                prettyDate : moment().format('YYYY/MM/DD'),
                timestamp : moment().format('DDMMYYhmm'),
                pkg : pkg,
                inject : false
            }),
            new HtmlWebpackPlugin(
            {
                filename : 'standards-refillable.html',
                template : './src/views/standards-refillable.hbs',
                prettyDate : moment().format('YYYY/MM/DD'),
                timestamp : moment().format('DDMMYYhmm'),
                pkg : pkg,
                inject : false
            }),
            new HtmlWebpackPlugin(
            {
                filename : 'standards-durable.html',
                template : './src/views/standards-durable.hbs',
                prettyDate : moment().format('YYYY/MM/DD'),
                timestamp : moment().format('DDMMYYhmm'),
                pkg : pkg,
                inject : false
            }),
            new HtmlWebpackPlugin(
            {
                filename : 'process.html',
                template : './src/views/process.hbs',
                prettyDate : moment().format('YYYY/MM/DD'),
                timestamp : moment().format('DDMMYYhmm'),
                pkg : pkg,
                inject : false
            }),
            new HtmlWebpackPlugin(
            {
                filename : 'terms-and-conditions.html',
                template : './src/views/terms-and-conditions.hbs',
                prettyDate : moment().format('YYYY/MM/DD'),
                timestamp : moment().format('DDMMYYhmm'),
                pkg : pkg,
                inject : false
            }),
            new HtmlWebpackPlugin(
            {
                filename : 'privacy-policy.html',
                template : './src/views/privacy-policy.hbs',
                prettyDate : moment().format('YYYY/MM/DD'),
                timestamp : moment().format('DDMMYYhmm'),
                pkg : pkg,
                inject : false
            }),
            new HtmlWebpackPlugin(
            {
                filename : 'accessibility-statement.html',
                template : './src/views/accessibility-statement.hbs',
                prettyDate : moment().format('YYYY/MM/DD'),
                timestamp : moment().format('DDMMYYhmm'),
                pkg : pkg,
                inject : false
            }),
            new HtmlWebpackPlugin(
            {
                filename : 'contact.html',
                template : './src/views/contact.hbs',
                prettyDate : moment().format('YYYY/MM/DD'),
                timestamp : moment().format('DDMMYYhmm'),
                pkg : pkg,
                inject : false
            }),
            new HtmlWebpackPlugin(
            {
                filename : 'faq.html',
                template : './src/views/faq.hbs',
                prettyDate : moment().format('YYYY/MM/DD'),
                timestamp : moment().format('DDMMYYhmm'),
                pkg : pkg,
                inject : false
            }),

            /**
             *  DefinePlugin
             *  -------------
             *  DefinePlugin defines variables to be passed into Webpack to be
             *  used within the build process.
             *
             */

            new webpack.DefinePlugin(
            {
                'process.env':{
                    'NODE_ENV': JSON.stringify('production'),
                },
                'PROJECT_ID' : JSON.stringify(pkg.name),
                'CDN': JSON.stringify(pkg.cdn)
            }),

            /**
             *  ExtractTextPlugin
             *  ------------------
             *  The ExtractTextPlugin is used to export the CSS file generated by
             *  the SASS rule to a CSS file in the distribution folder. This is only
             *  invoked in the `stage` and `production` environments.
             *
             */

            new MiniCssExtractPlugin({
                filename: "css/" + pkg.name + ".css"
            })
        ]
    });
