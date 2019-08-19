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

mix.js('resources/js/app.js', 'public/js')
    .extract(['vue', 'lodash', 'axios'])
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-easy-import'),
        require('tailwindcss')('./resources/tailwind.config.js'),
        require('autoprefixer'),
    ]);

if (mix.inProduction()) {
    mix.version();
    mix.disableNotifications();
}
