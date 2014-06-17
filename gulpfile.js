/* 
* Gulp File
*/

var gulp = require('gulp');

// Plugins
var concat = require('gulp-concat');
var sass   = require('gulp-ruby-sass');
var prefix = require('gulp-autoprefixer');
var jshint = require('gulp-jshint');
var uglify = require('gulp-uglify');

/* Paths */
var path = {
    styles: 'assets/styles/',
    styleFile: 'assets/styles/style.scss',
    styleFiles: 'assets/styles/**/*.scss',
    scripts: 'assets/scripts/',
    scriptFile: 'script.min.js',
    scriptFiles: 'assets/scripts/**/*.js',
};

// Default task
gulp.task( 'default', ['watch'] );

// Styles task
gulp.task('styles', function() {
  return gulp.src( path.styleFile )
    .pipe( sass( { 
        style: 'compressed', 
        sourcemap: true,
        cacheLocation: path.styles + 'cache'
    } ) )
    .pipe( prefix( 'last 3 versions' ) )
    .pipe( gulp.dest( './' ) );
});

// Scripts task
gulp.task('scripts', function() {
  return gulp.src( path.scriptFiles )
    .pipe( jshint() )
    .pipe( concat( path.scriptFile ) )
    .pipe( uglify( { outSourceMap: true } ) )
    .pipe( gulp.dest( path.scripts ) );
});

// Rerun tasks when a file changes
gulp.task('watch', function() {
	gulp.watch( [ path.styleFile, path.styleFiles ], [ 'styles' ] );
	gulp.watch( [ path.scriptFiles ], [ 'scripts' ] );
});