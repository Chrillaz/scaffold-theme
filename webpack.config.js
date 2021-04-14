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
  ' * Theme Name: ' + settings.package.name,
  ' * Theme URI: ' + settings.package.homepage,
  ' * Author: ' + settings.package.author,
  ' * Author URI: ' + settings.package.authoruri,
  ' * Description: ' + settings.package.description,
  ' * Version: ' + settings.package.version,
  ' * License: ' + settings.package.license,
  ' * Licence URI: ' + settings.package.licenseuri,
  ' * Text Domain: ' + settings.package.textdomain,
  ' * Domain Path: ' + settings.package.domainpath,
  ' * Template: ' + settings.package.template,
  ' */\n',
].join( '\n' );

const generateThemeHeaders = development => {

  if ( ! fs.existsSync( './style.scss' ) ) {
  
    fs.writeFile( 'style.css', banner, err => console.log( err ? err : 'Theme style.css generated! \n' ) ); 
  }
}

const setAssets = () => {
  
  const entries = {};

  for ( type in settings['webpack-assets'] ) {
    
    for ( chunk in settings['webpack-assets'][type] ) {

      if ( type !== settings['webpack-assets']['flags'] ) {

        entries[chunk] = settings['webpack-assets'][type][chunk];
      }
    }
  }

  return entries;
}

const usesJquery = config => {

  if ( settings['webpack-assets'].flags.jquery ) {

    config.externals = {
      jquery: 'jQuery' 
    };

    config.plugins.push( 
      new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery'
      })
    );
  }
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
      })
    ].filter( Boolean )
  };

  return usesJquery( config );
};