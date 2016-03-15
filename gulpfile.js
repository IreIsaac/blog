var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

elixir(function(mix) {
    mix.copy('./node_modules/font-awesome/fonts', './public/fonts')
       .copy('./node_modules/normalize.css/normalize.css', './resources/assets/sass/base/_normalize.scss')
       .sass('app.scss')
       .browserify('app.js')
       .version(['css/app.css', 'js/app.js'])
       .browserSync({
            proxy: 'laravel.dev'
        });
});
