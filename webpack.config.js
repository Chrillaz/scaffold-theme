const path = require('path'),
	UglifyJsPlugin = require('uglifyjs-webpack-plugin'),
	OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin'),
	MiniCssExtractPlugin = require('mini-css-extract-plugin'),
	StyleLintPlugin = require('stylelint-webpack-plugin'),
	BrowserSyncPlugin = require('browser-sync-webpack-plugin'),
	SpriteLoaderPlugin = require('svg-sprite-loader/plugin');

module.exports = (env, argv) => {
	const { mode } = argv,
		projectName = process.env.PWD.split('/').pop();

	return {
		context: __dirname,
		devtool: mode ? 'source-map' : false,
		entry: './src/js/main.ts',
		module: {
			rules: [
				{
					use: 'ts-loader',
					test: /\.tsx?$/,
					exclude: /node_modules/
				},
				{
					test: /\.svg$/,
					loader: 'svg-sprite-loader',
					options: {
						extract: true,
						spriteFilename: 'svg-defs.svg',
					}
				},
				{
					test: /\.s[c|a]ss$/,
					use: [mode ? 'style-loader' : MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader', 'sass-loader'],
				},
			]
		},
		optimization: mode ? {} : {
			minimize: true,
			minimizer: [
				new UglifyJsPlugin({
					cache: true,
					parallel: true,
				}),
				new OptimizeCSSAssetsPlugin({})
			]
		},
		output: {
			path: path.resolve(__dirname, `wp/wp-content/themes/${projectName}/assets/js`),
			filename: '[name].min.js'
		},
		plugins: [
			new SpriteLoaderPlugin(),
			new StyleLintPlugin(),
			new MiniCssExtractPlugin({
				filename: '../css/[name].min.css'
			}),
			new BrowserSyncPlugin({
				files: '**/*.php',
				injectChanges: true,
				proxy: 'http://localhost'
			}),

		],
		resolve: {
			extensions: ['.tsx', '.ts', '.js']
		},
		watch: mode ? true : false,
	};
}
