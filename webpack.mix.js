const mix = require("laravel-mix");
const path = require("path")
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js/app/")
    .webpackConfig({
        resolve: {
            alias: {
                "@": path.resolve(__dirname, "frontend/src/"),
                "@themeConfig": path.resolve(
                    __dirname,
                    "frontend/themeConfig.js"
                ),
                "@core": path.resolve(__dirname, "frontend/src/@core"),
                "@validations": path.resolve(
                    __dirname,
                    "frontend/src/@core/utils/validations/validations.js"
                ),
                "@axios": path.resolve(__dirname, "frontend/src/libs/axios")
            }
        },
        // module: {
        //     rules: [
        //         {
        //             test: /\.s[ac]ss$/i,
        //             use: [
        //                 {
        //                     loader: "sass-loader",
        //                     options: {
        //                         sassOptions: {
        //                             includePaths: [
        //                                 "frontend/node_modules",
        //                                 "frontend/src/assets"
        //                             ]
        //                         }
        //                     }
        //                 }
        //             ]
        //         },
        //         {
        //             test: /(\.(png|jpe?g|gif|webp)$|^((?!font).)*\.svg$)/,
        //             loaders: {
        //                 loader: "file-loader",
        //                 options: {
        //                     name: "images/[path][name][contenthash].[ext]",
        //                     context: "../src/assets/app/images"
        //                 }
        //             }
        //         },
        //         {
        //             test: /\.(mp3|wav)$/,
        //             use: [
        //                 {
        //                     loader: "file-loader",
        //                     options: {
        //                         name: "audios/[path][name][contenthash].[ext]",
        //                         context: "../src/assets/app/audios"
        //                     }
        //                 }
        //             ]
        //         }
        //     ]
        // },
        // output: {
        //     chunkFilename: "js/chunks/app/[name][chunkhash].js"
        // }
    }).vue();

if (mix.inProduction()) {
    mix.version();
}
