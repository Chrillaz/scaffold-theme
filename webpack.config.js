const path = require('path'),
			StyleLintPlugin = require('stylelint-webpack-plugin'),
			MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = (env, argv) => {
	const { mode } = argv,
				projectName = process.env.PWD.split('/').pop();

	return {
		context: __dirname,
		devtool: mode ? 'source-map' : false,
		entry: {
			main: [
      	'./resources/scripts/main.ts',
      	'./resources/styles/scss/bootstrap.scss'
			]
		},
		module: {
			rules: [
				{
					use: 'ts-loader',
					test: /\.tsx?$/,
					exclude: /node_modules/
				},
				{
					test: /\.s[c|a]ss$/,
					use: [mode ? 'style-loader' : MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader', 'sass-loader'],
				},
			]
		},
		optimization: {},
		output: {
			path: path.resolve(__dirname, `app/assets/js`),
			filename: '[name].min.js',
			publicPath: `app/assets/js`,
		},
		plugins: [
			new StyleLintPlugin(),
			new MiniCssExtractPlugin({
				filename: '../../style.css'
			})
		],
		resolve: {
			extensions: ['.tsx', '.ts', '.js']
		},
		watch: mode ? true : false,
  };
}
