/*
 * Gulp File
 */

var gulp = require( 'gulp' );

// Plugins
var concat = require( 'gulp-concat' );
var sass = require( 'gulp-sass' );
var map = require('gulp-sourcemaps');
var prefix = require( 'gulp-autoprefixer' );
var eslint = require('gulp-eslint');
var uglify = require( 'gulp-uglify' );

// Paths
var path = {
	styles : 'assets/styles/style.scss',
	styleWatch : [ 'assets/styles/style.scss', 'assets/styles/**/*.scss', 'assets/styles/**/**/*.scss' ],
	scripts : 'assets/scripts/',
	scriptWatch : [ 'assets/scripts/vendor/*.js', 'assets/scripts/source/*.js' ]
};

// Default task
gulp.task( 'default', ['watch'] );

// Run tasks when a file changes
gulp.task( 'watch', function() {
	gulp.watch( [ path.styleWatch ], [ 'styles' ] );
	gulp.watch( [ path.scriptWatch ], [ 'scripts' ] );
} );

// Styles task
gulp.task( 'styles', function() {
	return gulp.src( path.styles )
		.pipe( map.init() )
		.pipe( sass( { outputStyle: 'compressed' } ) )
		.pipe( prefix( 'last 3 versions' ) )
		.pipe( map.write( './' ) )
		.pipe( gulp.dest( './' ) );
} );

// Scripts task
gulp.task( 'scripts', function() {
	return gulp.src( path.scriptWatch )
		.pipe( map.init() )
		.pipe( eslint() )
		.pipe( concat( 'script.min.js' ) )
		.pipe( uglify() )
		.pipe( map.write( '/' ) )
		.pipe( gulp.dest( path.scripts ) );
} );
