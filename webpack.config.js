const fs = require( 'fs' ),
      path = require( 'path' ),
      webpack = require('webpack'),
      settings = require( './settings.json' ),
      TerserPlugin = require( 'terser-webpack-plugin' ),
      { CleanWebpackPlugin } = require( 'clean-webpack-plugin' ),
      MiniCSSExtractPlugin = require( 'mini-css-extract-plugin' ),
      FixStyleOnlyEntriesPlugin = require( 'webpack-fix-style-only-entries' ),
      OptimizeCSSAssetsPlugin = require( 'optimize-css-assets-webpack-plugin' );

const cleanExcludes = [
  '!js', 
  '!js/src', 
  '!js/src/**/*', 
  '!scss', 
  '!scss/**/*', 
  '!fonts', 
  '!fonts/**/*',
  '!icons',
  '!icons/**/*'
];

const banner = [
  '/*',
  ' * Theme Name: ' + settings.details.name,
  ' * Theme URI: ' + settings.details.uri,
  ' * Author: ' + settings.details.author,
  ' * Author URI: ' + settings.details.authoruri,
  ' * Description: ' + settings.details.description,
  ' * Version: ' + settings.details.version,
  ' * License: ' + settings.details.license,
  ' * Licence URI: ' + settings.details.licenseuri,
  ' * Text Domain: ' + settings.details.textdomain,
  ' * Domain Path: ' + settings.details.domainpath,
  ' */\n',
].join( '\n' );

if ( ! fs.existsSync( './style.scss' ) ) {

  fs.writeFile( 'style.css', banner, err => console.log( err ? err : 'Theme style.css generated! \n' ) );
}

module.exports = (env, argv) => {
  
  const development = argv.mode === 'development';

  const context = path.resolve(__dirname, 'assets');

  const config = {
    context,
    devtool: development ? 'cheap-module-source-map' : 'source-map',
    entry: { 
      main: './js/src/main.ts',
      style: './scss/main.scss',
    },
    output: {
      path: context,
      filename: 'js/[name].min.js',
      publicPath: '../'
    },
    resolve: {
      extensions: ['.ts', '.tsx', '.js']
    },
    externals: {
      jquery: 'jQuery' 
    },
    watch: development,
    optimization: {
      minimizer: [
        new TerserPlugin({
          sourceMap: true
        }),
        new OptimizeCSSAssetsPlugin({
          cssProcessorOptions: {
            map: {
              inline: false,
              annotation: true
            }
          }
        })
      ]
    },
    module: { 
      rules: [
        {
          test: /\.tsx?$/,
          exclude: /node_modules/,
          use: {
            loader: 'ts-loader'
          }
        },
        {
          test: /\.s[c|a]ss$/,
          use: [
            MiniCSSExtractPlugin.loader, 
            'css-loader',
            'postcss-loader',
            'sass-loader'
          ]
        },
        {
          test: /\.(png|woff|woff2|eot|ttf|svg)$/,
          use: [
            {
              loader: 'url-loader',
              options: {
                limit: 10000,
                name: 'fonts/[name].[ext]',
              }
            }
          ]
        }
      ]
    },
    plugins: [
      new CleanWebpackPlugin({
        verbose: true,
        cleanOnceBeforeBuildPatterns: ['**/*', ...cleanExcludes]
      }),
      ! development && new FixStyleOnlyEntriesPlugin(),
      new MiniCSSExtractPlugin({
        filename: 'css/[name].css'
      }),
      new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery'
      })
    ].filter( Boolean )
  };

  return config;
};