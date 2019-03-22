var gulp = require('gulp');
var gulpsync = require('gulp-sync')(gulp);
var usemin = require('gulp-usemin');
var uglify = require('gulp-uglify');
var htmlmin = require('gulp-htmlmin');
var cssnano = require('gulp-cssnano');
var cleanCss = require('gulp-clean-css');
var rev = require('gulp-rev');
var del = require('del');
//var Q = require('q');

// https://www.npmjs.com/package/gulp-concat
var concat = require('gulp-concat');
var merge = require('merge-stream');

// https://github.com/ajwhite/gulp-ng-config

// var source = __dirname + '/html/';
// var output = __dirname + '/html-min/';
var source = __dirname + '/html-2019-03-22/';
var output = __dirname + '/html-2019-03-22-min/';
var paths = [];

// Dockblock
// https://github.com/zont/gulp-usemin
gulp.task('usemin', function() {
    return gulp.src([
        source + '**/*.html',
    ])
    .pipe(usemin({
        //css: [ function(){ return cssnano({discardComments: {removeAll: true}}); } ],
        //inlinecss:[ function(){ return cleanCss(); }, 'concat'],
        html: [ function(){ return htmlmin({
            collapseWhitespace: true,
            removeComments: true
        }); } ],
        //js: [ function(){ return uglify();} ], // rev(), 
        //inlinejs: [ function(){ return uglify();} ]
    }))

    .pipe( gulp.dest( output ) );
});



// removes all compiled dev files
gulp.task('clean', function() {
    return del(output + '**/*', {dot: true});
});


// GLOBAL PRODUCTION SCRIPT 'clean', 
gulp.task('build', gulpsync.sync([
    'usemin', 
]));


