var path = require( 'path' );
var webpack = require( 'webpack' );

module.exports = {
	entry: './assets/jsx/jsx-assets.js',
	output: { path: __dirname + '/assets/js/', filename: 'crowded-news.js' },
	module: {
		loaders: [
			{
				test: /.jsx?$/,
				loader: 'babel-loader',
				exclude: /node_modules/,
				query: {
					presets: ['es2015', 'react']
				}
			}
		]
	}
}