const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const dotenv = require('dotenv');
const webpack = require('webpack');

const env = dotenv.config({ path: path.resolve(__dirname, './includes/.env') }).parsed;

const envKeys = Object.keys(env).reduce((prev, next) => {
  prev[`process.env.${next}`] = JSON.stringify(env[next]);
  return prev;
}, {});
// console.log('ENV:', env);
module.exports = {
  mode: env.ENVIROMENT,
  entry: {
    'js/app': './src/js/app.js',
    'js/main': './src/js/main.js',

    'js/inicio': {
      import: './src/js/inicio.js',
      dependOn: 'js/app',
    },
    'js/pages/contacto': {
      import: './src/js/pages/contacto.js',
      dependOn: 'js/app',
    },
    'js/pages/armas': {
      import: './src/js/pages/armas.js',
      dependOn: 'js/app',
    },
    'js/pages/detalle': {
      import: './src/js/pages/detalle.js',
      dependOn: 'js/app',
    },
    'css/styles': ['./src/scss/app.scss'],
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'public/build'),
    publicPath: '/public/build/',
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: 'css/styles.css',
      chunkFilename: '[id].css',
    }),
    new webpack.DefinePlugin(envKeys)
  ],
  module: {
    rules: [
      {
        test: /\.(c|sc|sa)ss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
          },
          {
            loader: 'css-loader',
          },
          'sass-loader',
        ],
      },
      {
        test: /\.(png|svg|jpe?g|gif)$/,
        type: 'asset/resource',
      },
    ],
  },
};
