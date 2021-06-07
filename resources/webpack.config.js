const config = require( '@chrillaz/scaffold-pipe/config/webpack.config' );

module.exports = {
  ...config,
  entry: {
    public: './scripts/public.ts',
    editor: './scripts/editor.ts',
    admin: './scripts/admin.ts',
    'public-styles': './styles/public.scss',
    'editor-styles': './styles/editor.scss',
    'admin-styles': './styles/admin.scss'
  }
}