const webpack = require( 'webpack' ),
      { helper } = require( './config/bundler/webpack-helper' );

helper.addExternal({ 
  React: 'react',
  $: 'jquery',
  JQuery: 'jquery'
});

helper.addEntry( "main", "./js/src/main.ts" )
  .addEntry( "editor-scripts", "./js/src/editor.ts" )
  .addEntry( "admin-scripts", "./js/src/admin.ts" )
  .addEntry( "style", "./scss/main.scss" )
  .addEntry( "editor-styles", "./scss/editor.scss")
  .addEntry( "admin-styles", "./scss/admin.scss" );

module.exports = helper;