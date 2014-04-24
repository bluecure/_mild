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

// Paths
var paths = {
	stylesSettings: 'assets/styles/settings.scss',
	stylesName: 'style.css',
	stylesPath: './',
	styles: [
		'assets/styles/vendor/*.scss', 
		'assets/styles/source/*.scss'
	],
	scriptsName: 'scripts.min.js',
	scriptsPath: 'assets/scripts/',
	scripts: [
		'assets/scripts/vendor/*.js', 
		'assets/scripts/source/*.js'
	]
};

// Default task
gulp.task( 'default', ['styles', 'scripts', 'watch'] );

// Styles task
gulp.task('styles', function() {
  return gulp.src( paths.stylesSettings )
    .pipe( sass( { outputStyle: 'compact' } ) )
    .pipe( prefix( 'last 3 versions' ) )
    .pipe( rename( paths.stylesName ) )
    .pipe( gulp.dest( paths.stylesPath ) );
});

// Scripts task
gulp.task('scripts', function() {
  return gulp.src( paths.scripts )
    .pipe( jshint() )
    .pipe( concat( paths.scriptsName ) )
    .pipe( uglify() )
    .pipe( gulp.dest( paths.scriptsPath ) );
});

// Rerun tasks when a file changes
gulp.task('watch', function() {
	gulp.watch( paths.styles, ['styles'] );
	gulp.watch( paths.scripts, ['scripts'] );
});
