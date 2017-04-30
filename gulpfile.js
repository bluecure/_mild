/*
 * Gulp File
 */
var gulp = require('gulp');
var browserSync = require('browser-sync').create();
var sass = require('gulp-sass');
var prefix = require('gulp-autoprefixer');
var stylelint = require('gulp-stylelint');
var map = require('gulp-sourcemaps');
var babel = require('gulp-babel');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var eslint = require('gulp-eslint');

// Proxy / Host name
var hostName = 'wp.dev';

// Paths
var path = {
    styles: 'assets/styles/',
    styleWatch: [
        'assets/styles/style.scss',
        'assets/styles/**/*.scss',
        'assets/styles/**/**/*.scss'
    ],
    scripts: 'assets/scripts/',
    scriptWatch: [
        'assets/scripts/vendor/*.js',
        'assets/scripts/source/*.js'
    ]
};

/**
 * Default task to start browserSync and watch files
 */
gulp.task('default', function() {
    browserSync.init({
        proxy: hostName
    });
    gulp.watch([path.styleWatch], ['styles']);
    gulp.watch([path.scriptWatch], ['scripts']);
});

// Styles task to process sass
gulp.task('styles', function() {
    return gulp.src(path.styleWatch)
        .pipe(map.init())
        .pipe(sass({
            outputStyle: 'compressed'
        }))
        .pipe(prefix('last 3 versions'))
        .pipe(map.write('./'))
        .pipe(gulp.dest(path.styles))
        .pipe(browserSync.stream({
            match: '**/*.css'
        }));
});

// Scripts task to process js
gulp.task('scripts', function() {
    return gulp.src(path.scriptWatch)
        .pipe(map.init())
        .pipe(babel())
        .pipe(concat('script.min.js'))
        .pipe(uglify())
        .pipe(map.write('./'))
        .pipe(gulp.dest(path.scripts))
        .on('finish', browserSync.reload);
});

/**
 * Test task to run any css and js tests
 */
gulp.task('test', ['stylesTest', 'scriptsTest']);

// Styles test task to lint sass
gulp.task('stylesTest', function() {
    return gulp.src(path.styleWatch)
        .pipe(stylelint({
            reporters: [{
                formatter: 'verbose',
                console: true
            }]
        }));
});

// Scripts test task to lint js
gulp.task('scriptsTest', function() {
    return gulp.src(path.scriptWatch)
        .pipe(eslint())
        .pipe(eslint.format());
});
