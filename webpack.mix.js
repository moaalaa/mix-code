let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */


mix.sass('src/css/app.scss', 'dist/css/')
    .sass('src/css/dark_mode.scss', 'dist/css/')
    .options({
        processCssUrls: false
    });

mix.js('src/js/app.js', 'dist/js/');

mix.sourceMaps(); // Enable sourcemaps

// mix.version(); // Enable versioning.

