const mix = require('laravel-mix');

mix.js('src/resources/js/app.js', 'src/public/js')
   .vue() 
   .sass('src/resources/sass/app.scss', 'src/public/css')
   .styles([
       'src/public/css/common.css',
       'src/public/css/login.css'
   ], 'src/public/css/all.css');
