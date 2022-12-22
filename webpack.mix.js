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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');


mix.styles([
    'public/admin/css/bootstrap.min.css',
    'public/admin/css/font-awesome.min.css',
    'public/admin/css/ionicons.min.css',
    'public/admin/css/AdminLTE.min.css',
    'public/admin/css/_all-skins.min.css',
    'public/admin/css/custome.css',
],'public/css/all.css');

mix.js([
	'public/admin/js/jquery.slimscroll.min.js',
	'public/admin/js/fastclick.js',
	'public/admin/js/adminlte.min.js',
	'public/admin/js/demo.js',
	'public/admin/js/app.js'	
],'public/js/all.js');
