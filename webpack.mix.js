const mix = require("laravel-mix");

mix.js(
    "resources/js/categories.js",
    "public/compiledCssAndJs/js/categories.js"
);
