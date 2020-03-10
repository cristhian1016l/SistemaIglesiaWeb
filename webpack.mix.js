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

/*mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');*/

mix.styles([
   'public/bootstrap/dist/css/bootstrap.min.css',
   'public/bower_components/sidebar-nav/dist/sidebar-nav.min.css',
   'public/bower_components/toast-master/css/jquery.toast.css',
   'public/bower_components/morrisjs/morris.css',
   'public/bower_components/chartist-js/dist/chartist.min.css',
   'public/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css',
   'public/bower_components/calendar/dist/fullcalendar.css',
   'public/assets/css/animate.css',
   'public/assets/css/style.css',
   'public/assets/css/blue-dark.css',
], 'public/css/plantilla.css')
.scripts([
   'public/bower_components/jquery/dist/jquery.min.js', 
   'public/bower_components/waypoints/lib/jquery.waypoints.js', 
   'public/bower_components/counterup/jquery.counterup.min.js', 
   'public/bootstrap/dist/js/bootstrap.min.js', 
   'public/bower_components/sidebar-nav/dist/sidebar-nav.min.js', 
   'public/assets/js/jquery.slimscroll.js', 
   'public/assets/js/waves.js',
   'public/bower_components/raphael/raphael-min.js', 
   'public/bower_components/morrisjs/morris.js', 
   'public/bower_components/chartist-js/dist/chartist.min.js', 
   'public/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js', 
   'public/bower_components/moment/moment.js',
   'public/bower_components/calendar/dist/fullcalendar.min.js', 
   'public/bower_components/calendar/dist/cal-init.js', 
   'public/assets/js/custom.min.js', 
   'public/assets/js/dashboard1.js', 
   'public/assets/js/cbpFWTabs.js', 
   'public/bower_components/toast-master/js/jquery.toast.js', 
   'public/bower_components/styleswitcher/jQuery.style.switcher.js',
   'public/assets/js/mask.js', 
], 'public/js/plantilla.js')
.js(['resources/js/app.js'], 'public/js/app.js')