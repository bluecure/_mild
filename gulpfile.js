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

// Paths
var path = {
    styles: 'assets/styles/',
    styleCompile: 'assets/styles/style.scss',
    styleWatch: [ 'assets/styles/**/*.scss', 'assets/styles/**/**/*.scss' ],
    scripts: 'assets/scripts/',
    scriptWatch: [ 'assets/scripts/vendor/*.js',  'assets/scripts/source/*.js' ]
};

// Default task
gulp.task( 'default', ['watch'] );

// Run tasks when a file changes
gulp.task('watch', function() {
	gulp.watch( [ path.styleCompile, path.styleWatch ], [ 'styles' ] );
	gulp.watch( [ path.scriptWatch ], [ 'scripts' ] );
});

// Styles task
gulp.task('styles', function() {
  return gulp.src( path.styleCompile )
    .pipe( sass({
        style: 'compact',
        sourcemap: true,
        cacheLocation: path.styles + 'cache'
    }) )
    .pipe( prefix( 'last 3 versions' ) )
    .pipe( gulp.dest( './' ) );
});

// Scripts task
gulp.task('scripts', function() {
  return gulp.src( path.scriptWatch )
    .pipe( jshint() )
    .pipe( concat( 'script.min.js' ) )
    .pipe( uglify( { outSourceMap: true } ) )
    .pipe( gulp.dest( path.scripts ) );
});
