import { gallery } from './featured-gallery'

const { registerPlugin } = window.wp.plugins;

const register = ( prefix: string, plugin: any ) => {

  const { name, config } = plugin;

  registerPlugin( `${prefix}-${name}`, config );
}

export const registerThemePlugins = ( prefix: string ) => [
  gallery
].forEach( plugin => register( prefix, plugin ) );
