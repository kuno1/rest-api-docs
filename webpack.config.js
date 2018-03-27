const webpack = require('webpack');

module.exports = {
  entry: './src/js/rest-api-docs.js',
  mode: 'production',
  output: {
    path: __dirname + '/assets/js',
    publicPath: '/',
    filename: 'rest-api-docs.js'
  },
  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: 'vue-loader',
        options: {
          loaders: {
            js: 'babel-loader'
          }
        }
      },
      {
        test: /\.js$/,
        loader: 'babel-loader',
        exclude: /node_modules/
      }
    ]
  },
  resolve: {
    alias: {
      'vue$': 'vue/dist/vue.common.js'
    }
  }
};
