// include gulp
var gulp = require('gulp');

// include error handling plugins
var plumber = require('gulp-plumber');

// include imagemin plugins
var changed		= require('gulp-changed');
var imagemin	= require('gulp-imagemin');

// include js plugins
// var browserify	= require('gulp-browserify'); optional
var concat			= require('gulp-concat');
var stripDebug	= require('gulp-strip-debug');
var uglify			= require('gulp-uglify');

// include css plugins
var sass				= require('gulp-sass');
var autoprefix	= require('gulp-autoprefixer');
var minifyCSS		= require('gulp-minify-css');

// minify new images
gulp.task('imagemin', function() {
	var imageSource	= './src/img/**/*',
			imageBuild	= './out/pingz/img';

	gulp.src(imageSource)
		.pipe(changed(imageBuild))
		.pipe(imagemin())
		.pipe(gulp.dest(imageBuild));
});

// JS concat, strip debugging and minify
gulp.task('scripts', function() {
	gulp.src(['./src/js/**/*'])
		.pipe(plumber())
		.pipe(uglify())
		.pipe(gulp.dest('./out/pingz/src/js/'));

	gulp.src(['./src/js/parsley-1.1.16.js', './src/js/twitterbootstrap-2.0.4.js', './src/js/pingz.functions.js'])
		.pipe(plumber())
		.pipe(concat('pingz.bundle.js'))
		.pipe(stripDebug())
		.pipe(uglify())
		.pipe(gulp.dest('./out/pingz/src/js/'));
});

// CSS concat, auto-prefix and minify
gulp.task('styles', function() {
	gulp.src('./src/scss/*.scss')
		.pipe(plumber())
		.pipe(sass())
		.pipe(autoprefix('last 2 versions'))
		.pipe(minifyCSS())
		.pipe(gulp.dest('./out/pingz/src/css/'));
});

// default gulp task
gulp.task('default', ['imagemin', 'scripts', 'styles'], function() {
	// watch for JS changes
	gulp.watch('./src/js/*.js', function() {
		gulp.run('scripts');
	});

	// watch for CSS changes
	gulp.watch('./src/scss/*.scss', function() {
		gulp.run('styles');
	});
});