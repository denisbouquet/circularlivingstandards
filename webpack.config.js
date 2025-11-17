/**
 *  Require
 *  -------------
 *  Load required modules. Webpack will load it's own `loaders` as defined
 *  within the exported configuration object, however Node.js libraries (ie: `path`)
 *  plugins (ie: ExtractTextPlugin), and objects (ie: package.json) need to be
 *  loaded in separatly.
 *
 */

var MiniCssExtractPlugin = require("mini-css-extract-plugin"),
    path =              require('path'),
    pkg =               require('./package.json');

/**
 *  Export
 *  -------------
 *  Export the Webpack configuration for ingestion by Webpack.
 *
 *  Note that this core object is never loaded directly into Webpack, but by the
 *  `webpack.deveopment.config.js` and `webpack.production.config.js`
 *  to be modified before deploying for the proper environment.
 *
 */

module.exports =
{
    /**
     *  Stats
     *  -------------
     *  Visually defines what information is displayed within the terminal
     *  set warnings, errors, and other information when Webpack is run.
     * 
     *
     */
    stats: {
        colors: true,
        assets: true,
        modules: true,
        entrypoints: true,
        children: false,
        warnings: false,
        errors: true,
        timings: true,
        version: false,
        hash: false,
        builtAt: false,
    },
    /**
     *  Entry
     *  -------------
     *  The main `entry` file for the CNNIX Virgil project. The `react-hot-loader/patch`
     *  loader is not required for project using or not using React.js, but will
     *  allow for live editing of React components.
     *
     */

    entry : ['./src/js/main.js'],

    /**
     *  Output
     *  -------------
     *  Set the directory, filename, and other properties of the exported project.
     *
     */

    output :
    {
        path : __dirname + "/dist/",
        filename : "js/" + pkg.name + ".js"
    },

    /**
     *  Resolve
     *  -------------
     *  The resolve object defines what values Webpack will look to apply to when
     *  parsing through the project. `extensions` are filetypes that should be
     *  included when using `import` or `require`. `modules` are directory locatons
     *  where module libraries are kept. `alias` defines "shortcuts" for import/require
     *  pathing, so that each path doesn't need to be set relative to the importing document.
     *
     */

    resolve :
    {
        extensions : ['.js', '.json', '.jsx'],

        modules :
        [
            path.join(__dirname, 'bower_components/'),
            path.join(__dirname, 'node_modules/')
        ],

        alias:
        {
            Bower :         path.join(__dirname, 'bower_components/'),

            Proj_Styles :   path.join(__dirname, 'src/styles/'),
            Proj_JS :       path.join(__dirname, 'src/js/proj/'),
            Styles :        path.join(__dirname, 'src/styles/'),
            JS :            path.join(__dirname, 'src/js/')
        }
    },

    /**
     *  DevServer
     *  -------------
     *  Settings for the `react-dev-server`
     *
     */

    devServer :
    {
        hot: true,
    },

    /**
     *  Externals
     *  -------------
     *  Libraries imported into a Webpack project JS will be compiled into
     *  the exported JS. To exclude a library from being un-neededly packed
     *  into your project, include it into the `externals` object, and it
     *  will be ignored, allowing you to utilize a library already supplied
     *  on the page. (ie: jQuery).
     *
     */

    externals :
    {
        "jquery" : "jQuery",
    },

    /**
     *  Module
     *  -------------
     *  Module defines the rules and actions to follow and be taken by Webpack.
     *  It is the heart of the Webpack configuration file.
     *
     */

    module :
    {
        rules :
        [
            /**
             *  Javascript / JSX / React / ES6
             *  -------------------------------
             *  This rule tests for js(x) imports (excluding those imported from
             *  node_modules and bower_components) and runs them through the
             *  babel-loader, using the defined presets.
             *
             */

            {
                test : /\.jsx?$/,
                exclude : /(node_modules|bower_components)/,
                loader : 'babel-loader',
                options :
                {
                    presets :
                    [
                        '@babel/preset-env',
                        '@babel/preset-react'
                    ],

                    plugins :
                    [
                        'react-require'
                    ]
                }
            },

            /**
             *  SCSS / CSS
             *  -----------
             *  This rule tests for scss | css imports (excluding those imported from
             *  vendor locations) and passes them through the loaders defined within
             *  the `getSASSLoaders` function.
             *
             */

            {
                test : /\.scss$|\.css$/,
                exclude : [path.resolve(__dirname, "src/vendor")],
                use : getSASSLoaders()
            },

            /**
             *  CSS (Vendor)
             *  -------------
             *  This rule tests for CSS files within the `vendor` directory and
             *  moves it to the distribution folder without modification.
             *
             */

            {
                test : /\.css$/,
                include : [path.resolve(__dirname, "src/vendor")],
                use :
                [
                    {
                        loader : "file-loader",
                        options :
                        {
                            name : "css/[path][name].[ext]",
                            context : "./src"
                        }
                    }
                ]
            },

            /**
             *  JS (Vendor)
             *  ------------
             *  This rule tests for JS files within the `vendor` directory and
             *  moves it to the distribution folder without modification.
             *
             */

            {
                test : /\.js$/,
                include : [path.resolve(__dirname, "src/vendor")],
                use :
                [
                    {
                        loader : "file-loader",
                        options :
                        {
                            name : "js/[path][name].[ext]",
                            context : "./src"
                        }
                    }
                ]
            },

            /**
             *  Media / Data
             *  -------------
             *  This rule tests for media / data files and moves them to the distribution
             *  folder without modification.
             *
             */

            {
                test: /\.(ttf|eot|woff|woff2|jpe?g|gif|png|webp|avif|svg|wav|mp3?4?|webm|jsonp|xml|swf|json|geojson|topojson|csv)$/,
                use :
                [
                    {
                        loader : "file-loader",
                        options :
                        {
                            name : "[path][name].[ext]",
                            context : "./src"
                        }
                    }
                ]
            },

            /**
             *  Handlebars
             *  -----------
             *  This rule tests for `handlebars` files and processes them through
             *  the `handlebars-loader.` This rule is not invoked by the `main.js`
             *  like the other files, but rather through the environment-based
             *  configuration files.
             *
             */

            {
                test : /\.hbs$|\.html?$/,
                loader : 'handlebars-loader',
                options :
                {
                    helperDirs: path.join(__dirname, 'src/helpers'),
                    partialDirs :
                    [
                        path.join(__dirname, 'bower_components/'),
                        path.join(__dirname, 'src/views/'),
                        path.join(__dirname, 'src/views/components/'),
                    ]
                }
            }
        ]
    },

    /**
     *  Plugins
     *  -----------
     *  Plugins used within Webpack.
     *
     */

    plugins :
    [
        /**
         *  ExtractTextPlugin
         *  -----------
         *  The ExtractTextPlugin is used to export the CSS file generated by
         *  the SASS rule to a CSS file in the distribution folder. This is only
         *  invoked in the `stage` and `production` environments.
         *
         */

        new MiniCssExtractPlugin({
            filename: "css/" + pkg.name + ".css"
        })
    ]
}

/**
 *  SASS Loaders
 *  -------------
 *  SASS / Stylesheets need to be loaded / exported different ways, depending on
 *  the environment. Use this function to return the appropriate loaders to the
 *  module test case.
 *
 */

function getSASSLoaders()
{
        /**
         *  CSS Loader
         *  -------------
         *  The CSS loader allows for advanced @import/require support and
         *  will update all `url(...)` values to CDN URLs in production.
         *
         */

    var cssLoader =
        {
            loader : 'css-loader',
            options :
            {
                url: false
                // 'url' : process.env.NODE_ENV === "stage" ? false : true
            }
        },

        /**
         *  SASS Loader
         *  -------------
         *  The SASS loader is responsible for transpiling SASS into CSS.
         *
         */

        sassLoader =
        {
            loader : 'sass-loader',
            options :
            {
                additionalData : '$PROJECT_NAME: ' + pkg.name + ';',
                sassOptions : {
                    includePaths : [
                        path.resolve(__dirname, './node_modules/compass-mixins/lib'),
                        path.resolve(__dirname, './bower_components'),
                        path.resolve(__dirname, './node_modules')
                    ]
                }
            }
        },

        /**
         *  PostCSS Loader
         *  -------------
         *  The PostCSS loader allows for the use of auto-prefixing, which
         *  will automatically preprend browser-specific prefixes to CSS
         *  styles that need it.
         *
         */

        postcssLoader =
        {
            loader : 'postcss-loader',
            options : {
                postcssOptions: {
                    plugins: [
                        require('autoprefixer')({ overrideBrowserslist: ['last 2 versions', 'ie 10'] })
                    ]
                }
            }
        }

        /**
         *  Style Loader
         *  -------------
         *  The Style loader will import the generated CSS directly into the
         *  compiled Javascript file removing the need to load a CSS file separatly.
         *  This is only used in development.
         *
         */

        styleLoader =
        {
            loader : 'style-loader'
        };

    return process.env.NODE_ENV === "development"
            ? [styleLoader, cssLoader, postcssLoader, sassLoader]
            : [MiniCssExtractPlugin.loader, cssLoader, postcssLoader, sassLoader];
}
