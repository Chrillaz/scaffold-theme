const fs = require( 'fs' ),
      path = require( 'path' ),
      webpack = require('webpack'),
      package = require( './settings.json' ),
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
  ' * Theme Name: ' + package.title,
  ' * Theme URI: ' + package.homepage,
  ' * Author: ' + package.author,
  ' * Author URI: ' + package.authoruri,
  ' * Description: ' + package.description,
  ' * Version: ' + package.version,
  ' * License: ' + package.license,
  ' * Licence URI: ' + package.licenseuri,
  ' * Text Domain: ' + package.textdomain,
  ' * Domain Path: ' + package.domainpath,
  ' * Template: ' + package.template,
  ' */\n',
].join( '\n' );

const generateThemeHeaders = development => {

  if ( ! fs.existsSync( './style.scss' ) ) {
  
    fs.writeFile( 'style.css', banner, err => console.log( err ? err : 'Theme style.css generated! \n' ) ); 
  }
}

const setAssets = () => {
  
  const entries = {};

  for ( type in package['webpack-assets'] ) {
    
    for ( chunk in package['webpack-assets'][type] ) {

      entries[chunk] = package['webpack-assets'][type][chunk];
    }
  }

  return entries;
}

module.exports = (env, argv) => {
  
  const development = argv.mode === 'development';

  const context = path.resolve(__dirname, 'assets');

  generateThemeHeaders( development );

  const config = {
    context,
    devtool: development ? 'cheap-module-source-map' : 'source-map',
    entry: setAssets(),
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
            {
              loader: 'postcss-loader',
              options: {
                postcssOptions: {
                  plugins: [
                    require( 'autoprefixer' )()
                  ]
                }
              }
            },
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