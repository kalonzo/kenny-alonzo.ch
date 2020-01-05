var Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
     */
    .addEntry('app', ['./assets/js/app.js','./assets/global.scss'])
    //.addEntry('date_picker', ['./assets/js/date_picker.js','./assets/sass/date_picker.scss'])
    .addEntry('header', ['./assets/css/header/header.css','./assets/js/header/header.js'])
    .addEntry('form-validation', './assets/js/form-validation.js')
    .addEntry('homepage', ['./assets/css/home/home.css','./assets/js/home/home.js'])
    /*Entry for portfolio plugin*/
    .addEntry('portfolio', [
        './assets/css/portfolio/style.css',
        './assets/css/portfolio/colorbox.css',
        './assets/css/portfolio/ie_hack.css',
        './assets/css/portfolio/reset.css',
        './assets/css/portfolio/responsive.css',
        './assets/css/portfolio/stylesheet.css',
        './assets/css/portfolio/tipTip.css',
        './assets/js/portfolio/custom.js',
       //correction './assets/js/portfolio/ie9.js',
        './assets/js/portfolio/jquery-1.7.1.min.js',
        './assets/js/portfolio/jquery.colorbox-min.js',
        './assets/js/portfolio/jquery.easing.1.3.js',
        './assets/js/portfolio/jquery.cycle.js',
        './assets/js/portfolio/jquery.easytabs.min.js',
        './assets/js/portfolio/jquery.gmap.js',
        './assets/js/portfolio/jquery.hashchange.min.js',
        './assets/js/portfolio/jquery.placeholder.js',
        './assets/js/portfolio/jquery.tipTip.js',
        './assets/js/portfolio/jquery.vticker.js',
        //'./assets/js/portfolio/modernizr.js',
        //'./assets/js/portfolio/respond.min.js'

    ])
    
    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    //.splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()

    // uncomment if you use API Platform Admin (composer req api-admin)
    //.enableReactPreset()
    //.addEntry('admin', './assets/js/admin.js')

    .addPlugin(new CopyWebpackPlugin([
        // copies to {output}/static
        { from: './assets/static', to: 'static' }
]))
;

module.exports = Encore.getWebpackConfig();
var nodeExternals = require('webpack-node-externals');

