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
    moment = require('moment'),
    extend = require('extend'),

//  Plugins
//  --------

    MiniCssExtractPlugin = require("mini-css-extract-plugin"),
    HtmlWebpackPlugin = require('html-webpack-plugin'),

//  Config
//  -------

    baseConfig = require('./webpack.config'),
    pkg = require('./package.json');
    pkg.icdn = pkg.cdn;
    pkg.cdn = "./";
    // pkg.data = require('./src/data/data.json');

const { CleanWebpackPlugin } = require('clean-webpack-plugin');


//  Exports
//  --------

    module.exports = extend(true, baseConfig,
    {
        /**
         *  DevTool
         *  --------
         *  Controls SourceMapping.
         *
         */

        devtool: 'eval',

        /**
         *  Output
         *  -------
         *  Mofify output object from the core config.
         *
         */

        output :
        {
            publicPath: ''
        },

        /**
         *  DevServer
         *  ----------
         *  Mofify devServer object from the core config.
         *
         */

        devServer :
        {
            liveReload: true,
            historyApiFallback: true,
            hot : true,
            open: true,
            client: {
                overlay: false
            }
        },

        /**
         *  Plugins
         *  --------
         *  Mofify plugins object from the core config.
         *
         */

        plugins:
        [
            /**
             *  DefinePlugin
             *  -------------
             *  DefinePlugin defines variables to be passed into Webpack to be
             *  used within the build process.
             *
             */

            new webpack.DefinePlugin(
            {
                'NODE_ENV': JSON.stringify(process.env.NODE_ENV || 'development'),
                'PROJECT_ID' : JSON.stringify(pkg.name),
                'CDN': JSON.stringify('./')
            }),

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
                cdn : "./",
                pkg : pkg,
                inject : false
            }),
            new HtmlWebpackPlugin(
            {
                filename : 'standards-reusable.html',
                template : './src/views/standards-reusable.hbs',
                prettyDate : moment().format('YYYY/MM/DD'),
                timestamp : moment().format('DDMMYYhmm'),
                cdn : "./",
                pkg : pkg,
                inject : false
            }),
            new HtmlWebpackPlugin(
            {
                filename : 'standards-preloved.html',
                template : './src/views/standards-preloved.hbs',
                prettyDate : moment().format('YYYY/MM/DD'),
                timestamp : moment().format('DDMMYYhmm'),
                cdn : "./",
                pkg : pkg,
                inject : false
            }),
            new HtmlWebpackPlugin(
            {
                filename : 'standards-refillable.html',
                template : './src/views/standards-refillable.hbs',
                prettyDate : moment().format('YYYY/MM/DD'),
                timestamp : moment().format('DDMMYYhmm'),
                cdn : "./",
                pkg : pkg,
                inject : false
            }),
            new HtmlWebpackPlugin(
            {
                filename : 'standards-durable.html',
                template : './src/views/standards-durable.hbs',
                prettyDate : moment().format('YYYY/MM/DD'),
                timestamp : moment().format('DDMMYYhmm'),
                cdn : "./",
                pkg : pkg,
                inject : false
            }),
            // new HtmlWebpackPlugin(
            // {
            //     filename : 'artx/index.html',
            //     template : './src/views/artx.hbs',
            //     prettyDate : moment().format('YYYY/MM/DD'),
            //     timestamp : moment().format('DDMMYYhmm'),
            //     cdn : "./",
            //     pkg : pkg,
            //     inject : false
            // }),

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
