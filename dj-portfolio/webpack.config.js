const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const { WebpackManifestPlugin } = require('webpack-manifest-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');

module.exports = (env, argv) => {
  const isDevelopment = argv.mode === 'development';

  return {
    entry: './src/index.js',
    output: {
      path: path.resolve(__dirname, 'dist'),
      filename: isDevelopment ? 'bundle.js' : 'js/[name].[contenthash].js',
    },
    devtool: isDevelopment ? 'inline-source-map' : false,
    devServer: {
      static: {
        directory: path.join(__dirname, 'dist'),
        watch: true,
      },
      hot: true,
      open: true,
      port: 3000,
    },
    module: {
      rules: [
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: ['@babel/preset-env', '@babel/preset-react'],
            },
          },
        },
        {
          test: /\.scss$/,
          use: [
            isDevelopment ? 'style-loader' : MiniCssExtractPlugin.loader,
            'css-loader',
            'sass-loader',
          ],
        },
        {
          test: /\.(html)$/,
          use: ['html-loader'],
        },
      ],
    },
    optimization: {
      minimizer: [
        `...`, // Extends default minimizers (terser-webpack-plugin for JS)
        new CssMinimizerPlugin(), // Uses cssnano to optimize CSS
      ],
    },
    plugins: [
      new CleanWebpackPlugin(),
      new HtmlWebpackPlugin({
        template: './src/index.html',
        filename: 'index.html',
      }),
      new MiniCssExtractPlugin({
        filename: isDevelopment ? 'css/[name].css' : 'css/[name].[contenthash].css',
      }),
      new WebpackManifestPlugin({
        fileName: 'manifest.json',
        publicPath: '',
        generate: (seed, files) => {
          return files.reduce((acc, file) => {
            if (file.name.endsWith('.js')) acc['main.js'] = file.path;
            if (file.name.endsWith('.css')) acc['main.css'] = file.path;
            return acc;
          }, seed);
        },
      }),
    ],
  };
};