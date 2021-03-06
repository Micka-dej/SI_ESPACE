const { VueLoaderPlugin } = require("vue-loader");
const path = require("path");

const HtmlWebpackPlugin = require("html-webpack-plugin");
const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
const CopyWebpackPlugin = require("copy-webpack-plugin");

const env = "development";
const sourceMap = env === "development";
const minify = env === "production";

const config = {
  entry: path.join(__dirname, "src", "main.js"),
  mode: env,
  output: {
    publicPath: ""
  },
  optimization: {
    splitChunks: {
      chunks: "all"
    }
  },
  devtool: sourceMap ? "cheap-module-eval-source-map" : undefined,
  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: "vue-loader"
      },
      {
        test: /\.js$/,
        loader: "babel-loader",
        include: [path.join(__dirname, "src")]
      },
      {
        test: /\.scss$/,
        loader:
          "vue-style-loader!css-loader!resolve-url-loader!sass-loader?sourceMap"
      },
      {
        test: /\.(png|jp(e*)g|svg|ico)$/,
        use: [
          {
            loader: "url-loader",
            options: {
              limit: 1, // Convert images < 8kb to base64 strings
              name: "images/[hash]-[name].[ext]"
            }
          }
        ]
      },
      {
        test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
        use: [
          {
            loader: "file-loader",
            options: {
              name: "fonts/[name].[ext]"
            }
          }
        ]
      }
    ]
  },
  plugins: [
    new VueLoaderPlugin(),
    new HtmlWebpackPlugin({
      filename: path.join(__dirname, "dist", "index.html"),
      template: path.join(__dirname, "static", "index.html"),
      inject: true,
      minify: minify
        ? {
            removeComments: true,
            collapseWhitespace: true,
            removeAttributeQuotes: true
          }
        : false
    }),
    new CopyWebpackPlugin([
      {
        from: path.join(__dirname, "static", "app-icons", "*"),
        to: path.join(__dirname, "dist", "app-icons"),
        flatten: true
      },
      {
        from: path.join(__dirname, "static", "browserconfig.xml"),
        to: path.join(__dirname, "dist", "browserconfig.xml"),
        flatten: true
      }
    ])
  ],
  resolve: {
    alias: {
      "@Component": path.resolve(__dirname, "src/components/"),
      "@View": path.resolve(__dirname, "src/views/"),
      "@ViewStyle": path.resolve(__dirname, "src/scss/views/"),
      "@ComponentStyle": path.resolve(__dirname, "src/scss/components/"),
      "@DataStore": path.resolve(__dirname, "src/datastore/")
    }
  }
};

if (minify) {
  config.optimization.minimizer = [
    new UglifyJsPlugin({
      cache: true,
      parallel: true
    })
  ];
}

module.exports = config;
