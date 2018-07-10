require('dotenv').config()
let mix = require('laravel-mix');
const workboxPlugin = require('workbox-webpack-plugin');
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;

const package = require('./package.json');
const dependencies = Object.keys(package.dependencies);

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.extract(dependencies)
    .js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .autoload({
        jquery: ['$', 'window.jQuery']
    })
    .options({
        extractVueStyles: true,
        processCssUrls: true,
        uglify: {},
        purifyCss: false,
        postCss: [require('autoprefixer')],
        clearConsole: false
    })
    .webpackConfig({
        plugins: [
            new workboxPlugin({
                globDirectory: './public',
                globPatterns: [
                    '**/*.{html,css,js}',
                    'fonts/**/*.*'
                ],
                swDest: path.join(`${__dirname}/public`, 'sw.js'),
                clientsClaim: true,
                skipWaiting: true,
                runtimeCaching: [
                    {
                        urlPattern: '/',
                        handler: 'networkFirst',
                        options: {
                            cacheName: 'Wodemocracy frontpage'
                        }
                    },
                    {
                        urlPattern: new RegExp('https://fonts.(googleapis|gstatic).com'),
                        handler: 'cacheFirst',
                        options: {
                            cacheName: 'google-fonts'
                        }
                    }
                ]
            }),
            new BundleAnalyzerPlugin({
                analyzerMode: 'static',
                reportFilename: path.join(`${__dirname}/public`, 'webpack-report.html'),
                openAnalyzer: false,
                logLevel: 'silent'
            }),
        ]
    })
    .sourceMaps(!mix.inProduction())
    .disableNotifications();