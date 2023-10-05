const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/cart.js", "public/js")
    .js("resources/js/book.js", "public/js")
    .js('resources/js/dashboard.js', 'public/js')
    .js('resources/js/review.js', 'public/js')
    .js('resources/js/deletebook.js', 'public/js')
    .js('resources/js/admin.js', 'public/js')
    .js('resources/js/order.js', 'public/js')
    .postCss("resources/css/app.css", "public/css", [
        require("tailwindcss"),
        require("autoprefixer"),
    ])
    .postCss("resources/css/w3.css", "public/css", [require("autoprefixer")])
    .postCss("resources/css/google-fonts.css", "public/css", [require("autoprefixer")]);
