const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const production = process.env.NODE_ENV === 'production';

module.exports = {
  mode: process.env.NODE_ENV,
  entry: path.resolve(__dirname, './src/index.js'),
  devtool: production ? false : 'inline-source-map',
  optimization: {
    minimize: production,
  },
  plugins: [
    new MiniCssExtractPlugin(),
  ],
  module: {
    rules: [
      {
        test: [/\.css$/,/\.(s(a|c)ss)$/],
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          'sass-loader',
        ]
      }
    ]
  },
  resolve: {
    extensions: ['*', '.js', '.jsx']
  },
  output: {
    path: path.resolve(__dirname, './dist'),
    filename: 'main.js',
  },
};