const config = require( '../../../settings.json' );

if ( Array.isArray( config['block-types-exclude'] ) && config['block-types-exclude'].length > 0 ) {

  // @ts-ignore
  wp.hooks.addFilter(
    'blocks.registerBlockType',
    'hideBlocks',
    (settings: {supports: {}}, name: string) => {
      
      if ( config['block-types-exclude'].indexOf( name ) !== -1 ) {
  
        return Object.assign({}, settings, {
          supports: Object.assign({}, settings.supports, {inserter: false})
        });
      }
  
      return settings;
    }
  );
}