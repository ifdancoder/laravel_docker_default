const path = require('path');

module.exports = {
  pages: {
    index: {
      entry: 'resources/js/app.js',
      template: 'resources/views/index.blade.php',
      filename: 'index.html'
    }
  },
  outputDir: 'public/build/assets',
  assetsDir: 'assets',
  publicPath: '/',
  configureWebpack: {
    resolve: {
      alias: {
        '@': path.resolve(__dirname, 'resources/js'),
      }
    }
  },
  devServer: {
    proxy: {
      '^/api': {
        target: 'http://localhost:8000',
        ws: true,
        changeOrigin: true
      }
    },
    watchOptions: {
      poll: 1000,
      ignored: /node_modules/,
    },
    devtools: true,
  },
  productionSourceMap: false,
  chainWebpack: config => {
    config.optimization.splitChunks({
      chunks: 'all',
    });
  }
};