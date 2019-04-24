const Encore = require('@symfony/webpack-encore')
const BabelMinifyPlugin = require('babel-minify-webpack-plugin')

Encore
  .enableBuildNotifications(true)

  .enableSingleRuntimeChunk()
  .splitEntryChunks()

  .setOutputPath('public/build/')
  .setPublicPath('/build')
  .setManifestKeyPrefix('build/')

  .cleanupOutputBeforeBuild()

  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())

  .enableSassLoader()
  .enablePostCssLoader()
  .configureBabel(function (babelConfig) {
    babelConfig.presets[0][1].targets = {
      browsers: 'last 2 versions',
    }
  })

  .addEntry('js/theme', './assets/js/theme.js')
  .addStyleEntry('css/theme', './assets/css/theme.scss')

if (Encore.isProduction()) {
  Encore.addPlugin(
    new BabelMinifyPlugin(
      {removeConsole: true},
      {comments: false}
    )
  )
}

module.exports = Encore.getWebpackConfig()
