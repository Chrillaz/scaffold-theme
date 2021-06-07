const { registerPlugin } = window.wp.plugins;

const register = ( prefix: string, plugin: any ) => {

  const { name, config } = plugin;

  registerPlugin( `${prefix}-${name}`, config );
}

export const registerThemePlugins = ( prefix: string ) => [
  // Import plugins
].forEach( plugin => register( prefix, plugin ) );