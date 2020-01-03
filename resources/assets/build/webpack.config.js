// webpack v4
const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const HtmlWebpackPlugin = require('html-webpack-plugin');
const {CleanWebpackPlugin} = require('clean-webpack-plugin');

module.exports = {
  entry: {
    main: './resources/assets/scripts/main.js',
    admin: './resources/assets/styles/admin.scss',
    editor: './resources/assets/styles/editor.scss'
    // editor: '../scripts/editor.js'
  },
  output: {
    path: path.resolve(__dirname, '../../../dist'),
    filename: '[name].js'
  },
  target: 'web', // update from 23.12.2018
  devServer: {
    open: true,
    hot: true,
    port: 9000,
    proxy: {
      '/': {
        target: 'http://wp.localhost',
        changeOrigin: true,
        autoRewrite: true,
        headers: {
          'X-ProxiedBy-Webpack': true,
        },
      },
    },
    publicPath: '/app/themes/libarts/dist/',
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader"
        }
      },
      {
        test: /\.scss$/,
        use: [ MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader', 'sass-loader' ]
      },
      {
        test: /\.(ttf|otf|eot|woff2?|png|jpe?g|gif|svg|ico)$/,
        include: path.resolve(process.cwd(), 'resources/assets'),
        loader: 'file-loader',
        options: {
          limit: 4096,
          name: `[path][name].[hash].[ext]`,
        },
      },
      {
        test: /\.(ttf|otf|eot|woff2?|png|jpe?g|gif|svg|ico)$/,
        include: /node_modules/,
        loader: 'file-loader',
        options: {
          limit: 4096,
          outputPath: 'vendor/',
          name: `[name].[hash].[ext]`,
        },
      },
    ]
  },
  plugins: [
    new CleanWebpackPlugin(),
    new MiniCssExtractPlugin({
      filename: '[name].css'
    }),
  ]
};