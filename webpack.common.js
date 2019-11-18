const path = require("path");
const webpack = require("webpack");
var ExtractTextPlugin = require("extract-text-webpack-plugin");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");

var extractPlugin = new ExtractTextPlugin({
  filename: "app.css"
});

if (process.env.NODE_ENV === "production") {
}

module.exports = {
  entry: {
    app: ["./public/assets/scripts/app.js", "./public/assets/styles/app.scss"]
  },
  output: {
    path: path.resolve(__dirname, "public/dist"),
    filename: "app.js",
    publicPath: "/assets/dist"
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: [
          {
            loader: "babel-loader",
            options: {
              presets: ["@babel/env"]
            }
          }
        ]
      },
      {
        test: /\.ts$/,
        use: "ts-loader",
        exclude: /node_modules/
      },
      {
        test: /\.css$/,
        use: extractPlugin.extract({
          use: ["css-loader"]
        })
      },
      {
        test: /\.scss$/,
        use: extractPlugin.extract({
          use: ["css-loader", "sass-loader", "import-glob-loader"]
        })
      },
      {
        test: /\.html$/,
        exclude: /node_modules/,
        use: {
          loader: "raw-loader"
        }
      },
      {
        test: /\.(jpg|png|gif|jpeg|svg|bmp)$/,
        use: [
          {
            loader: "file-loader",
            options: {
              name: "[name].[ext]",
              outputPath: "images/",
              publicPath: "./images"
            }
          }
        ]
      },
      {
        test: /\.(ttf|eot|otf|woff|svg|woff2)$/,
        use: [
          {
            loader: "file-loader",
            options: {
              name: "[name].[ext]",
              outputPath: "fonts/",
              publicPath: "./fonts"
            }
          }
        ]
      }
    ]
  },
  resolve: {
    extensions: [".tsx", ".ts", ".js"]
  },
  plugins: [
    new webpack.ProvidePlugin({
      $: "jquery",
      jQuery: "jquery",
      Popper: ["popper.js", "default"]
    }),
    extractPlugin,
    new CleanWebpackPlugin()
  ]
};
