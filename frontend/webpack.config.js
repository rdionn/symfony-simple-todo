const path = require('path')
const VueLoaderPlugin = require('vue-loader/lib/plugin')

module.exports = {
  entry: {
    app: path.join(__dirname, 'src', 'Todo.js')
  },
  output: {
    path: path.join(__dirname, '..', 'public', 'js'),
    publicPath: '/js/'
  },
  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: 'vue-loader'
      }
    ]
  },
  plugins: [
    new VueLoaderPlugin()
  ],
  resolve: {
       alias: {
           vue: 'vue/dist/vue.js'
       },
   }
}
