###

2015 - 2016 (c) by Marcel Kapfer (mmk2410)

Licensed under MIT License

Rangitaki Gulp File

###

gulp = require 'gulp'
sass = require 'gulp-sass'
sourcemaps = require 'gulp-sourcemaps'
minifyCss = require 'gulp-csso'
coffee = require 'gulp-coffee'
coffeelint = require 'gulp-coffeelint'
uglify = require 'gulp-uglify'
merge = require 'merge-stream'
del = require 'del'
size = require 'gulp-size'

gulp.task 'coffee', ->
  main = gulp.src './src/coffee/*.coffee'
    .pipe coffeelint()
    .pipe coffeelint.reporter()
    .pipe coffee()
    .pipe uglify()
    .pipe gulp.dest './res/js/'

  extensions = gulp.src './src/coffee-extensions/*.coffee'
    .pipe coffeelint()
    .pipe coffeelint.reporter()
    .pipe coffee()
    .pipe uglify()
    .pipe gulp.dest './extensions/'

  merge(main, extensions)
    .pipe size {title: 'Coffee'}

gulp.task 'sass', ->
  main = gulp.src './src/sass/*.sass'
    .pipe sourcemaps.init()
      .pipe sass {
        outputStyle: 'compressed'
      }
    .pipe sourcemaps.write './'
    .pipe gulp.dest './res/css/'

  theme = gulp.src './src/sass-themes/*.sass'
    .pipe sourcemaps.init()
      .pipe sass {
        outputStyle: 'compressed'
      }
    .pipe sourcemaps.write './'
    .pipe gulp.dest './themes/'

  merge(theme, main)
    .pipe size {title: 'SASS'}

gulp.task 'clean', del.bind null, ['res/css/no-nav.css', 'res/css/rangitaki.css', 'themes/', 'res/js/app.js']

gulp.task 'init', ['coffee', 'sass']

gulp.task 'default', ->
  gulp.watch './src/**/*.sass', ['sass']
  gulp.watch './src/**/*.coffee', ['coffee']

