const {src, dest, watch} = require("gulp");
const sass = require("gulp-sass")(require('sass'));
const plumber = require("gulp-plumber");

function css(done){

    src('sass/scss/**/*.scss')
        .pipe(plumber())
        .pipe(sass())
        .pipe(dest("../public/css"));


    done();
}


function dev(done){

    watch("sass/scss/**/*.scss", css);


    done();
}

exports.css = css;
exports.dev = dev;




