let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .js('resources/assets/js/chef.js', 'public/frontend/js/chef')
   .sass('resources/assets/sass/chef.scss', 'public/frontend/css')
   .js('resources/assets/js/cashier.js', 'public/frontend/js/cashier')
   .sass('resources/assets/sass/cashier.scss', 'public/frontend/css')
   ;