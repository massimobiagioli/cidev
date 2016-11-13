var webpack = require("webpack");

module.exports = {
  entry: './src/main.js',
  output: {
    path: '../assets/js',
    filename: 'cidev.min.js'
  },
  plugins: [
    new webpack.optimize.UglifyJsPlugin({minimize: true})
  ],
  module: {
    loaders: [
      {
        test: /\.js$/,
        loader: 'babel',
        exclude: /node_modules/
      }
    ]
  }
};
