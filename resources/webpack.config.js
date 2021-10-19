const config = require( '@chrillaz/scaffold-scripts/config/webpack.config' );

module.exports = {
  ...config,
  externals: {
    React: 'react',
    $: 'jquery',
    JQuery: 'jquery'
  },
  entry: {
    public: './scripts/public.ts',
    editor: './scripts/editor.ts',
    admin: './scripts/admin.ts',
    'public-styles': './styles/public.scss',
    'editor-styles': './styles/editor.scss',
    'admin-styles': './styles/admin.scss'
  }
}