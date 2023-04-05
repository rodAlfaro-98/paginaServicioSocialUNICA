import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

const glob = require('glob');

const assetsFileList = [];

function readAssetsDir(dir, array) {

    (glob.sync(dir) || []).forEach(f => {
        f = f.replace(/[\\/]+/g, '/');
        if (f !== null){
            array.push(f);
        }
    });

    return array;
}

readAssetsDir('resources/css/*.css', assetsFileList);


export default defineConfig({
    plugins: [
        laravel({
            input: assetsFileList,
            refresh: true,
        }),
    ],

});