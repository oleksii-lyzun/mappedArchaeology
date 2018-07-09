var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')

    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')

    // uncomment to define the assets of the project
    .addEntry('articles', './assets/js/articles.js')
    .addEntry('baseLayout', './assets/js/baseLayout.js')

    .enableBuildNotifications()

    .enableSassLoader()
;

module.exports = Encore.getWebpackConfig();
