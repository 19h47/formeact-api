const ManifestPlugin = require('webpack-manifest-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const production = process.env.NODE_ENV === 'production';

module.exports = {
	watch: production ? false : true,
	output: {
		filename: production ? '[name].[chunkhash:8].js' : '[name].js'
	},
	module: {
		rules: [{
			enforce: "pre",
			test: /\.js$/,
			exclude: /node_modules/,
			loader: 'eslint-loader'
		},{
			test: /\.js$/,
			exclude: /node_modules/,
			loader: 'babel-loader'
		},
		{
			test: /\.scss$/,
			exclude: /node_modules/,
			use: ExtractTextPlugin.extract({
				use: [{
					loader: 'css-loader',
					options: {
						sourceMap: production ? false : true
					}
				},{
					loader: 'postcss-loader',
					options: {
						sourceMap: production ? false : true
					}
				},{
					loader: 'sass-loader',
					options: {
						sourceMap: production ? false : true
					}
				}],
				fallback: 'style-loader'
			})
		},
		{
			test: /\.svg$/,
			use: [{
				loader: 'file-loader',
				options: {
					outputPath: 'img/svg'
				}
			},{
				loader: 'svgo-loader',
				options: {
					plugins: [{
						removeTitle: true
					},{
						convertColors: {
							shorthex: false
						}
					},{
						convertPathData: false
					}]
				}
			}]
		},
		{
			test: /\.(gif|png|jpe?g)$/i,
			use: [{
					loader: 'file-loader',
					options: {
						outputPath: 'img/',
						name: '[ext]/[name].[ext]',
					}
				},
				{
					loader: 'image-webpack-loader',
					options: {
						mozjpeg: {
						progressive: true,
						quality: 65
					},

					optipng: {
						enabled: false
					},
					pngquant: {
						quality: '65-90',
						speed: 4
					},
					gifsicle: {
						interlaced: false
					}
				}
			}]
		}]
	},
	plugins: [
		new ExtractTextPlugin({
			filename: production ? 'main.[chunkhash:8].css' : 'main.css'
		}),

		new CleanWebpackPlugin(
			['dist'],
			{
				exclude:  ['feature.min.js'],
			}
		),

		new ManifestPlugin()
	],
	devtool: production ? false : 'source-map',
};
