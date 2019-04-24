module.exports = {
  parser: 'postcss-scss',
  plugins: {
    'autoprefixer': {},
    'postcss-discard-comments': {},
    'css-mqpacker': {},
    'cssnano': {
      reduceIdents: false,
      zindex: false
    }
  }
}
