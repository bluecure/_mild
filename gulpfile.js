/*
 * Gulp File
 */

var gulp = require( 'gulp' );

// Plugins
var browserSync = require('browser-sync').create();
var concat = require( 'gulp-concat' );
var sass = require( 'gulp-sass' );
var map = require('gulp-sourcemaps');
var prefix = require( 'gulp-autoprefixer' );
var eslint = require('gulp-eslint');
var uglify = require( 'gulp-uglify' );

// Proxy / Host name
var hostName = 'wp.dev';

// Paths
var path = {
	styles : 'assets/styles/style.scss',
	styleWatch : [ 'assets/styles/style.scss', 'assets/styles/**/*.scss', 'assets/styles/**/**/*.scss' ],
	scripts : 'assets/scripts/',
	scriptWatch : [ 'assets/scripts/vendor/*.js', 'assets/scripts/source/*.js' ]
};

// Default task
gulp.task( 'default', ['start'] );

// Start browserSync and run tasks when a file changes
gulp.task( 'start', function() {
	browserSync.init({
		proxy: hostName
	});
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
		.pipe( gulp.dest( './' ) )
		.pipe( browserSync.stream() );
} );

// Scripts task
gulp.task( 'scripts', function() {
	return gulp.src( path.scriptWatch )
		.pipe( map.init() )
		.pipe( eslint() )
		.pipe( concat( 'script.min.js' ) )
		.pipe( uglify() )
		.pipe( map.write( '/' ) )
		.pipe( gulp.dest( path.scripts ) )
		.on( 'finish', browserSync.reload );
} );
