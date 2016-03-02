var gulp = require('gulp'),
    sass = require('gulp-sass');
    concat = require('gulp-concat');
    minifycss = require('gulp-minify-css');
    uglify = require('gulp-uglify');

gulp.task('compileSass', function () {
    return gulp.src('resources/assets/sass/**/*.scss')
        .pipe(sass())
        .pipe(minifycss())
        .pipe(gulp.dest('public/css'));
});

gulp.task('minifyFrontJs', function() {
    return gulp.src('resources/assets/scripts/front/**/*.js')
        .pipe(concat('scamp.js'))
        .pipe(uglify())
        .pipe(gulp.dest('public/scripts'));
});

gulp.task('watch', function () {
    gulp.watch('resources/assets/sass/**/*.scss', ['compileSass']);
    gulp.watch('resources/assets/scripts/front/**/*.js', ['minifyFrontJs']);
});