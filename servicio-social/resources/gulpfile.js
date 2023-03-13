
// CSS
const {src, dest, watch, parallel} = require("gulp");
const sass = require("gulp-sass")(require('sass'));
const plumber = require("gulp-plumber");
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const postcss = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps');

// Images
const cache = require('gulp-cache');
const webp = require('gulp-webp');
const imagemin = require("gulp-imagemin");
const avif = require('gulp-avif');
const { functionsIn } = require("lodash");
const { auto } = require("@popperjs/core");

// Paths
const sourceCss = 'sass/scss/**/*.scss';
const targetCss = '../public/css';
const sourceJS = 'js/**/*.js';
const targetJS = '../public/assets/js';
const sourceImages = 'img/**/*.{jpg,png}';
const targetImages = '../public/assets/img'

// Javascript

const terser = require('gulp-terser-js');


function css(done){
    src(sourceCss)
        .pipe(sourcemaps.init())
        .pipe(plumber())
        .pipe(sass())
        .pipe(postcss([ autoprefixer(), cssnano() ]))
        .pipe(sourcemaps.write("."))
        .pipe(dest(targetCss));


    done();
}

function javascript(done){
    src(sourceJS)
        .pipe(sourcemaps.init())
        .pipe(terser())
        .pipe(sourcemaps.write("."))
        .pipe(dest(targetJS));

    done();
}

function images(done){
    const options = {
        optimizationLevel: 3
    }
    src(sourceImages)
        .pipe(cache(imagemin(options)))
        .pipe(dest(targetImages));

    done();
}

function toWebp(done){

    const options = {
        quality:50
    };

    src(sourceImages)
        .pipe(webp(options))
        .pipe(dest(targetImages));

    done();
}

function toAvif(done){

    const options = {
        quality:50
    };

    src(sourceImages)
        .pipe(webp(options))
        .pipe(dest(targetImages));

    done();
}

function dev(done){

    watch(sourceCss, css);
    watch(sourceJS, javascript);


    done();
}

exports.css = css;
exports.js = javascript;
exports.images = images;
exports.toWebp = toWebp;
exports.toAvif = toAvif;
//exports.dev = parallel(images, dev, toWebp, javascript, toAvif);
exports.dev = parallel(images, dev, toWebp, toAvif);




