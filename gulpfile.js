var elixir = require('laravel-elixir');

var bowerPath = '../../../bower_components/';
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss', 'resources/assets/css/app.css')

   		.styles([
            bowerPath + 'admin-lte/bootstrap/css/bootstrap.css',
            bowerPath + 'admin-lte/dist/css/AdminLTE.css',
            bowerPath + 'admin-lte/dist/css/skins/_all-skins.css',
            bowerPath + 'sweetalert/dist/sweetalert.css',
            bowerPath + 'fontawesome/css/font-awesome.css',
            bowerPath + 'ionicons/css/ionicons.css',
   			'app.css',
   		], 'public/css/app.css')

   		.scripts([
            bowerPath + 'jquery/dist/jquery.js',
   			bowerPath + 'admin-lte/bootstrap/js/bootstrap.js',
            bowerPath + 'admin-lte/dist/js/app.js',
            bowerPath + 'sweetalert/dist/sweetalert-dev.js',
            'app.js',
   		], 'public/js/app.js')

         .styles([
            bowerPath + 'admin-lte/plugins/datepicker/datepicker3.css',
            bowerPath + 'admin-lte/plugins/daterangepicker/daterangepicker-bs3.css',
         ], 'public/css/datepicker.css')

         .scripts([
            bowerPath + 'admin-lte/plugins/daterangepicker/moment.js',
            bowerPath + 'admin-lte/plugins/datepicker/bootstrap-datepicker.js',
            bowerPath + 'admin-lte/plugins/daterangepicker/daterangepicker.js',
            'datepicker.js',
         ], 'public/js/datepicker.js')

         .browserify('components/UserRoles.js')
         .browserify('components/CompanyRoles.js')
         .browserify('components/Speakers.js')

         .copy('bower_components/admin-lte/fonts', 'public/build/fonts')
         .copy('bower_components/fontawesome/fonts/', 'public/build/fonts')
         .copy('bower_components/ionicons/fonts/', 'public/build/fonts')
         .copy('bower_components/admin-lte/dist/img', 'public/dist/img')

   		.version([
   			'public/css/app.css',
   			'public/js/app.js',

            'public/css/datepicker.css',
            'public/js/datepicker.js',
   		]);
});
