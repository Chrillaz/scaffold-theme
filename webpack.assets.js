const { config } = require( './config/asset' );

config.disable( "jquery" );

config.add( "main", "./js/src/main.ts" )
  .add( "editor-scripts", "./js/src/editor.ts" )
  .add( "admin-scripts", "./js/src/admin.ts" )
  .add( "style", "./scss/main.scss" )
  .add( "editor-styles", "./scss/editor.scss")
  .add( "admin-styles", "./scss/admin.scss" );

module.exports = config;
