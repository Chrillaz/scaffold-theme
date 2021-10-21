import { registerThemeBlocks } from './blocks/register'
import { registerThemePlugins } from './plugins/register'
import { blocksBlacklist } from './hooks/blocks-blacklist'
const { select, subscribe } = window.wp.data;

const prefix = 'scaffold';

blocksBlacklist([
  // Blacklist any editor block by defining it's name, ex 'core/buttons'
]);

registerThemeBlocks( prefix );

const { getCurrentPostType } = select( 'core/editor' );

let postType = getCurrentPostType(); 

subscribe(() => {

    if ( postType !== getCurrentPostType() ) {
  
      registerThemePlugins( prefix, getCurrentPostType() );
    }
  
    postType = getCurrentPostType()
  })