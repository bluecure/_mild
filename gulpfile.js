/* 
* Gulp File
*/

var gulp = require('gulp');

// Plugins
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var sass   = require('gulp-sass');
var prefix = require('gulp-autoprefixer');
var jshint = require('gulp-jshint');
var uglify = require('gulp-uglify');
var minify = require('gulp-minify-css');

// Default task
gulp.task( 'default', ['styles', 'scripts', 'watch'] );

// Styles task
gulp.task('styles', function() {
  return gulp.src( 'assets/styles/styles.scss' )
    .pipe( sass( { outputStyle: 'compact' } ) )
    .pipe( prefix( 'last 3 versions' ) )
    .pipe( minify() )
    .pipe( rename( 'style.css' ) )
    .pipe( gulp.dest( './' ) );
});

// Scripts task
gulp.task('scripts', function() {
  return gulp.src( ['assets/scripts/**/*.js'] )
    .pipe( jshint() )
    .pipe( concat( 'scripts.min.js' ) )
    .pipe( uglify( { outSourceMap: true } ) )
    .pipe( gulp.dest( 'assets/scripts/' ) );
});

// Rerun tasks when a file changes
gulp.task('watch', function() {
	gulp.watch( ['assets/styles/settings.scss', 'assets/styles/**/*.scss'], ['styles'] );
	gulp.watch( ['assets/scripts/**/*.js'], ['scripts'] );
});