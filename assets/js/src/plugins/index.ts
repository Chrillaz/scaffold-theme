const { registerPlugin } = window.wp.plugins;

const register = ( prefix: string, plugin: any ) => {

  const { name, config } = plugin;

  registerPlugin( `${prefix}-${name}`, config );
}

export const registerThemePlugins = ( prefix: string ) => [
  // Import plugins at the top and put inside this list
].forEach( plugin => register( prefix, plugin ) );