/**
 * MyJungly author JL
 */

'use strict';

// Include Gulp & Tools We'll Use
var gulp = require('gulp');
var $ = require('gulp-load-plugins')();
var del = require('del');
var runSequence = require('run-sequence');
var browserSync = require('browser-sync');
var pagespeed = require('psi');
var reload = browserSync.reload;

var AUTOPREFIXER_BROWSERS = [
  'ie >= 10',
  'ie_mob >= 10',
  'ff >= 30',
  'chrome >= 34',
  'safari >= 7',
  'opera >= 23',
  'ios >= 7',
  'android >= 4.4',
  'bb >= 10'
];

//add handlebars
var handlebars = require('gulp-handlebars');
var wrap = require('gulp-wrap');
var declare = require('gulp-declare');
var concat = require('gulp-concat');

//add Tools
var uglify = require('gulp-uglify');
var gutil = require('gulp-util');
var size = require('gulp-filesize');

// add Paths
var bower = 'app/bower_components';


// Lint JavaScript
gulp.task('jshint', function () {
  return gulp.src('app/scripts/**/*.js')
  //return gulp.src([bower + '/jquery/dist/jquery.js', bower + '/bootstrap-sass/assets/javascripts/bootstrap.js', bower + '/slick-carousel/slick/slick.min.js', 'app/scripts/**/*.js'])
        .pipe(reload({
            stream: true,
            once: true
        }))
        /*.pipe($.jshint())
        .pipe($.jshint.reporter('jshint-stylish'))
        .pipe($.if(!browserSync.active, $.jshint.reporter('fail')));*/
});

// add handlebars
gulp.task('templates', function() {
    gulp.src('app/templates/**/*.hbs')
        .pipe(handlebars())
        .pipe(wrap('Handlebars.template(<%= contents %>)'))
        .pipe(declare({
            namespace: 'app.templates',
            noRedeclare: true, // Avoid duplicate declarations
        }))
        .pipe(concat('templates.js'))
        .pipe(gulp.dest('.tmp/scripts'))
        .pipe(gulp.dest('dist/scripts'));
});


// Optimize Images
gulp.task('images', function () {
  return gulp.src('app/images/**/*')
    /*.pipe($.cache($.imagemin({
      progressive: true,
      interlaced: true
    })))*/
    .pipe(gulp.dest('dist/images'))
    .pipe($.size({title: 'images'}));
});

// Copy All Files At The Root Level (app)
gulp.task('copy', function () {
  return gulp.src([
    'app/*',
    '!app/*.html',
    'node_modules/apache-server-configs/dist/.htaccess'
  ], {
    dot: true
  }).pipe(gulp.dest('dist'))
    .pipe($.size({title: 'copy'}));
});

// Copy dossier vendor
gulp.task('copyvendor', function() {
    return gulp.src([
            'app/scripts/vendor/*',
        ], {
            dot: true
        }).pipe(gulp.dest('dist/scripts/vendor/'))
        .pipe($.size({
            title: 'copyvendor'
        }));
});


// Copy Web Fonts To Dist
gulp.task('fonts', function () {
  return gulp.src(['app/fonts/**'])
    .pipe(gulp.dest('dist/fonts'))
    .pipe($.size({title: 'fonts'}));
});

// Compile and Automatically Prefix Stylesheets
gulp.task('styles', function () {
  // For best performance, don't add Sass partials to `gulp.src`
  return gulp.src([
      'app/styles/*.scss',
      'app/styles/**/*.css',
      'app/styles/components/components.scss'
    ])
    .pipe($.changed('styles', {extension: '.scss'}))
    .pipe($.rubySass({
        style: 'expanded',
        precision: 10
      })
      .on('error', console.error.bind(console))
    )
    .pipe($.autoprefixer(AUTOPREFIXER_BROWSERS))
    .pipe(gulp.dest('.tmp/styles'))
    // Concatenate And Minify Styles
    .pipe($.if('*.css', $.csso()))
    .pipe(gulp.dest('dist/styles'))
    .pipe($.size({title: 'styles'}));
});


// Scan Your HTML For Assets & Optimize Them
gulp.task('html', function () {
  var assets = $.useref.assets({searchPath: '{.tmp,app}'});

  return gulp.src('app/**/*.html')
    .pipe(assets)
    // Concatenate And Minify JavaScript
    .pipe($.if('*.js', $.uglify({preserveComments: 'some'})))
    // Remove Any Unused CSS
    .pipe($.if('*.css', $.uncss({
      html: [
        'app/index.html'
      ],
      // CSS Selectors for UnCSS to ignore example
      ignore: [
        /.navdrawer-container.open/,
        /.app-bar.open/
      ]
    })))
    // Concatenate And Minify Styles
    // In case you are still using useref build blocks
    .pipe($.if('*.css', $.csso()))
    .pipe(assets.restore())
    .pipe($.useref())
    // Update Production Style Guide Paths
    .pipe($.replace('components/components.css', 'components/main.min.css'))
    // Minify Any HTML
    // TODO
    /*.pipe($.if('*.html', $.minifyHtml()))*/
    // Output Files
    .pipe(gulp.dest('dist'))
    .pipe($.size({title: 'html'}));
});

// Clean Output Directory
gulp.task('clean', del.bind(null, ['.tmp', 'dist', '!dist/.git'], {
  dot: true
}));
// Watch Files For Changes & Reload
gulp.task('serve', ['styles', 'templates'], function () {
  browserSync({
    notify: false,
    // Run as an https by uncommenting 'https: true'
    // Note: this uses an unsigned certificate which on first access
    //       will present a certificate warning in the browser.
    // https: true,
    server: ['.tmp', 'app']
  });

  gulp.watch(['app/**/*.html'], reload);
  gulp.watch(['app/styles/**/*.{scss,css}'], ['styles', reload]);
  gulp.watch(['app/templates/**/*.hbs'], ['templates', reload]);
  gulp.watch(['app/scripts/**/*.js'], ['jshint']);
  gulp.watch(['app/images/**/*'], reload);
});

// Build and serve the output from the dist build
gulp.task('serve:dist', ['default'], function () {
  browserSync({
    notify: false,
    // Run as an https by uncommenting 'https: true'
    // Note: this uses an unsigned certificate which on first access
    //       will present a certificate warning in the browser.
    // https: true,
    server: 'dist'
  });
});


// Build Production Files, the Default Task
gulp.task('default', ['clean'], function (cb) {
    runSequence('styles', ['jshint', 'html', 'images', 'fonts', 'copyvendor', 'templates', 'copy'], cb);
});



// Run PageSpeed Insights
// Update `url` below to the public URL for your site
gulp.task('pagespeed', pagespeed.bind(null, {
  // By default, we use the PageSpeed Insights
  // free (no API key) tier. You can use a Google
  // Developer API key if you have one. See
  // http://goo.gl/RkN0vE for info key: 'YOUR_API_KEY'
  url: 'http://localhost:3000',
  strategy: 'desktop'
}));

// Load custom tasks from the `tasks` directory
//try { require('require-dir')('tasks'); } catch (err) {}
