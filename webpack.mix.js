const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.scripts([
    'public/assets/lib/js/jquery-3.3.1.min.js',
    'public/assets/lib/js/popper.min.js',
    'public/assets/lib/js/bootstrap.min.js',
    'public/assets/lib/js/jquery-ui.min.js',
    'public/assets/lib/js/owl.carousel.min.js',
    'public/assets/lib/js/aos.js',
], 'public/assets/js/vendors.js');

// mix.js('resources/js/app.js', 'public/assets/js');
		
if (mix.inProduction()) {
    mix.sourceMaps();
    mix.version();
}