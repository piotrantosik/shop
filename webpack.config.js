let Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    .addEntry('app', [
        './assets/js/app.js',
        './assets/css/app.scss'
    ])
    .addEntry('login', './assets/css/login.scss')
    .enableSassLoader()

    // .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
