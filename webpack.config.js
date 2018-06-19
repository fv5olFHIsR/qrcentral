var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    // .addEntry('js/app', './assets/js/app.js')
    // .addStyleEntry('css/app', './assets/css/app.scss')
    
    .addEntry('js/main', './assets/_main.js')

    .configureFilenames({
        images: 'images/[name].[ext]',
        })
    
    .addStyleEntry('css/bootstrap', './assets/MobApp/css/bootstrap.min.css')
    .addStyleEntry('css/themify', './assets/MobApp/css/themify-icons.css')
    .addStyleEntry('css/owl.carousel', './assets/MobApp/css/owl.carousel.min.css')
    .addStyleEntry('css/style', './assets/MobApp/css/style.css')
   //.addEntry('jquery', './assets/MobApp/js/jquery-3.2.1.min.js')
    //.addEntry('js/bootstrap', './assets/MobApp/js/bootstrap.bundle.min.js')
    .addEntry('js/bootstrap', "./vendor/twitter/bootstrap/dist/js/bootstrap.js")
    .addEntry('js/owl.carousel', './assets/MobApp/js/owl.carousel.min.js')
    .addEntry('js/script', './assets/MobApp/js/script.js')
    .addEntry('js/qrcodegeneration', './assets/MobApp/js/qrcodegeneration.js')
    

    // uncomment if you use Sass/SCSS files
    // .enableSassLoader()

    // uncomment for legacy applications that require $/jQuery as a global variable
    //.autoProvidejQuery()
    .autoProvidejQuery()

;

module.exports = Encore.getWebpackConfig();
