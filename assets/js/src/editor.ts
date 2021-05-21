import { registerThemeBlocks } from './blocks/index'
import { registerThemePlugins } from './plugins/index'
import { blocksBlacklist } from './hooks/blocks-blacklist'

const prefix = 'scaffold';

blocksBlacklist([
  // Blacklist any editor block by defining it's name, ex 'core/buttons'
]);

registerThemeBlocks( prefix );

registerThemePlugins( prefix );