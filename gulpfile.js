/* 
 * Gulp File
 */

var gulp = require( 'gulp' );

// Plugins
var concat = require( 'gulp-concat' );
var sass = require( 'gulp-ruby-sass' );
var maps = require('gulp-sourcemaps');
var prefix = require( 'gulp-autoprefixer' );
var jshint = require( 'gulp-jshint' );
var uglify = require( 'gulp-uglify' );

// Paths
var path = {
	styles : 'assets/styles/',
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
	return sass( 'assets/styles/style.scss', {
		style : 'compressed',
		sourcemap: true,
		cacheLocation : path.styles + '.sass-cache'
	} )
	.pipe( prefix( 'last 3 versions' ) )
	.pipe( maps.write( '/', {
		sourceRoot: './'
	} ) )
	.pipe( gulp.dest( './' ) );
} );

// Scripts task
gulp.task( 'scripts', function() {
	return gulp.src( path.scriptWatch )
		.pipe( jshint() )
		.pipe( concat( 'script.min.js' ) )
		.pipe( uglify( { outSourceMap : true } ) )
		.pipe( gulp.dest( path.scripts ) );
} );
