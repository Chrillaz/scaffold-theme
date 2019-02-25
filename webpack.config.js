const dotenv = require('dotenv').config({path: __dirname + '/.env'}),
			path = require('path'),
			webpack = require('webpack'),
			UglifyJsPlugin = require('uglifyjs-webpack-plugin'),
			MiniCssExtractPlugin = require('mini-css-extract-plugin'),
			OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');

module.exports = env => {
	return {
		entry: ['@babel/polyfill', './src/js/app.js'],
		output: {
			path: path.resolve(__dirname, 'dist'),
			filename: 'bundle.min.js'
		},
		optimization: {
			minimize: true,
			minimizer: [ new UglifyJsPlugin({
				cache: true,
				parallel: true,
				sourceMap: true
			}),
			new OptimizeCSSAssetsPlugin({}) ]
		},
		devtool: 'inline-source-map',
		module: {
			rules: [
				{
					use: 'babel-loader',
					test: /\.js$/,
					exclude: /node_modules/
				},
				{
					test: /\.s[c|a]ss$/,
					use: ['style-loader', MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader', 'sass-loader']
				}
			]
		},
		plugins: [
			new MiniCssExtractPlugin({
				filename: 'style.css',
			}),
			new webpack.DefinePlugin({
	      'process.env': dotenv.parsed
	    })
		]
	}
};