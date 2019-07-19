const webpack = require('webpack')
const path = require('path')
const packages = require('./package.json')
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const OptimizeCSSPlugin = require('optimize-css-assets-webpack-plugin')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin

const config = require('./config.json')

// Naming and path settings
var appName = 'app'
var entryPoint = {
  frontend: './assets/src/frontend/main.js',
  admin: './assets/src/admin/main.js',
  vendor: Object.keys(packages.dependencies),
  style: './assets/styles/style.css'
}

var exportPath = path.resolve(__dirname, './assets/js')

// Enviroment flag
var plugins = []
var env = process.env.WEBPACK_ENV

function isProduction() {
  if (process.env.WEBPACK_ENV !== 'production') {
    console.log(
      'RUNNING DEV SERVER FOR: ' + process.env.MADWIRE_USER.toUpperCase()
    )
  }
  return process.env.WEBPACK_ENV === 'production'
}

// extract css into its own file
const extractCss = new ExtractTextPlugin({
  filename: '../css/[name].css'
})

plugins.push(extractCss)

// Extract all 3rd party modules into a separate 'vendor' chunk
plugins.push(
  new webpack.optimize.CommonsChunkPlugin({
    name: 'vendor',
    minChunks: ({ resource }) => /node_modules/.test(resource)
  })
)

plugins.push(
  new BrowserSyncPlugin({
    proxy: {
      target: config[process.env.MADWIRE_USER]
    },
    files: ['**/*.php'],
    cors: true,
    reloadDelay: 0,
    ui: false
  })
)

// Generate a 'manifest' chunk to be inlined in the HTML template
// plugins.push(new webpack.optimize.CommonsChunkPlugin('manifest'));

// Compress extracted CSS. We are using this plugin so that possible
// duplicated CSS from different components can be deduped.
plugins.push(
  new OptimizeCSSPlugin({
    cssProcessorOptions: {
      safe: true,
      map: {
        inline: false
      }
    }
  })
)



// Differ settings based on production flag
if (isProduction()) {
  console.log('PRODUCTION BUILD')
  plugins.push(
    new UglifyJsPlugin({
      sourceMap: true
    })
  )

  plugins.push(
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: '"production"'
      }
    })
  )

  plugins.push(
    new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)
  )

  appName = '[name].min.js'
  vueVersion = 'vue/dist/vue.min.js'
  console.log(appName)
  console.log(vueVersion)
} else {
  appName = '[name].js'
  vueVersion = 'vue/dist/vue.js'
}

  plugins.push(
    new BundleAnalyzerPlugin({
      analyzerPort: 1337
    })
  )



module.exports = {
  entry: entryPoint,
  output: {
    path: exportPath,
    filename: appName,
    chunkFilename: 'chunks/[chunkhash].js',
    jsonpFunction: 'pluginWebpack'
  },

  resolve: {
    alias: {
      vue$: vueVersion,
      '@': path.resolve('./assets/src/'),
      frontend: path.resolve('./assets/src/frontend/'),
      admin: path.resolve('./assets/src/admin/')
    },
    modules: [
      path.resolve('./node_modules'),
      path.resolve(path.join(__dirname, 'assets/src/'))
    ],
    extensions: ['.js', '.vue', '.css']
  },

  plugins,

  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        loader: 'babel-loader'
      },
      {
        test: /\.vue$/,
        loader: 'vue-loader',
        options: {
          extractCSS: true
        }
      },
      {
        test: /\.css$/,
        use: ['style-loader', 'css-loader']
      }
    ]
  }
}
