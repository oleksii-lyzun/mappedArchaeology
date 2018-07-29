var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')

    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')

    // uncomment to define the assets of the project
    .addEntry('articles', './assets/js/articles.js')
    .addEntry('books', './assets/js/books.js')
    .addEntry('baseLayout', './assets/js/baseLayout.js')
    .addEntry('sitesList', './assets/js/sitesList.js')
    .addEntry('sitesShow', './assets/js/sitesShow.js')
    .addEntry('contactUs', './assets/js/contactUs.js')
    .addEntry('login', './assets/js/login.js')
    .addEntry('register', './assets/js/register.js')


    .enableBuildNotifications()

    .enableSassLoader()
;

module.exports = Encore.getWebpackConfig();
