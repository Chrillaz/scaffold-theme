const { hooks } = window.wp;

export const blocksBlacklist = ( blacklist: string[] ) => hooks.addFilter(
  'blocks.registerBlockType',
  'hideBlocks',
  ( settings: {supports: {}}, name: string ) => {
      
    if ( blacklist.indexOf( name ) > -1 ) {
  
      return Object.assign({}, settings, {
        supports: Object.assign({}, settings.supports, {inserter: false})
      });
    }
  
    return settings;
  }
);