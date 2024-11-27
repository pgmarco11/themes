const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const { WebpackManifestPlugin } = require('webpack-manifest-plugin');

module.exports = (env, argv) => {
  const isDevelopment = argv.mode === 'development';

  return {
    entry: './src/index.js', // Change this to your main JS entry point
    output: {
      path: path.resolve(__dirname, 'dist'),
      filename: isDevelopment ? 'bundle.js' : 'js/[name].[contenthash].js', // Use contenthash for cache busting in production
    },
    devtool: isDevelopment ? 'inline-source-map' : false, // Sourcemaps for development only
    devServer: {
      static: {
        directory: path.join(__dirname, 'dist'), // Set the directory for static files
        watch: true, // Watch for changes to files in the 'dist' folder
      },
      hot: true, // Enable Hot Module Replacement
      open: true, // Automatically open the browser
      port: 3000, // Port for the server
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
            isDevelopment ? 'style-loader' : MiniCssExtractPlugin.loader, // Use style-loader in dev and mini-css-extract-plugin in prod
            'css-loader',
            'sass-loader',
          ],
        },
        {
          test: /\.(html)$/,
          use: ['html-loader'], // If you have HTML files to be processed
        },
      ],
    },
    plugins: [
      new CleanWebpackPlugin({
        cleanOnceBeforeBuildPatterns: ['**/*'], // Keeps the 'css' folder intact
      }), // Clean dist folder before each build, except for the 'css' folder
      new HtmlWebpackPlugin({
        template: './src/index.html', // Path to your HTML template
        filename: 'index.html', // Output HTML file
      }),
      new MiniCssExtractPlugin({
        filename: isDevelopment ? 'css/[name].css' : 'css/[name].[contenthash].css', // Output CSS filename
      }),
      new WebpackManifestPlugin({
        fileName: 'manifest.json', // Manifest file output
        publicPath: '', 
        generate: (seed, files) => {
          const manifest = files.reduce((acc, file) => {
            const name = file.name;
            if (name.endsWith('.js')) {
              acc['main.js'] = file.path;
            }
            if (name.endsWith('.css')) {
              acc['main.css'] = file.path;
            }
            return acc;
          }, seed);

          return manifest;
        },
      }),
    ],
  };
};
