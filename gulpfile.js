const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    //below line is only for development
    //mix.copy('node_modules/bootstrap-sass/assets/fonts/*',elixir.config.assetsPath+'/fonts/');
    mix.sass('app.scss')
    mix.webpack('app.js');
    mix.copy(elixir.config.assetsPath+'/fonts/*',elixir.config.publicPath+'/fonts/');

});
