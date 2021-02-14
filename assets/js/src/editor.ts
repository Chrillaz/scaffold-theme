const config = require( '../../../settings.json' );

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