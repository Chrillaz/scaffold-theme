const path = require( 'path' ),
      helper = require( '../webpack.helper' ),
      { CleanWebpackPlugin } = require( 'clean-webpack-plugin' ),
      MiniCSSExtractPlugin = require( 'mini-css-extract-plugin' ),
      RemoveEmptyScriptsPlugin = require('webpack-remove-empty-scripts');

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

module.exports = (env, argv) => {
  
  const development = argv.mode === 'development';

  const context = path.resolve(__dirname, '../assets');

  helper.doThemeHeaders();

  const config = {
    context,
    devtool: development ? 'inline-source-map' : 'source-map',
    entry: helper.getEntries(),
    externals: helper.getExternals(),
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
      removeEmptyChunks: true
    },
    module: { 
      rules: [
        {
          test: /\.tsx?$/,
          exclude: /node_modules/,
          use: {
            loader: 'ts-loader',
            options: {
              configFile: path.resolve(__dirname, './tsconfig.json' )
            }
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
      ].concat( helper.getRules() )
    },
    plugins: [
      new CleanWebpackPlugin({
        dry: true,
        cleanOnceBeforeBuildPatterns: ['**/*', ...cleanExcludes]
      }),
      new RemoveEmptyScriptsPlugin({ extensions:['css', 'scss', 'sass'] }),
      new MiniCSSExtractPlugin({
        filename: 'css/[name].css'
      })
    ].concat( helper.getPlugins() ).filter( Boolean )
  };

  return config;
};
