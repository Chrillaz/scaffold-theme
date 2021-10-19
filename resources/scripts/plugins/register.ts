const { registerPlugin } = window.wp.plugins;
import { examplePlugin } from "./example-plugin";

const register = ( prefix: string, plugin: any ) => {

  const { name, config } = plugin;

  registerPlugin( `${prefix}-${name}`, config );
}

export const registerThemePlugins = ( prefix: string, postType: string ) => [
  // Import plugins and include here...
  examplePlugin
].forEach((plugin: any) => plugin.supports.includes( postType ) ? register( prefix, plugin ) : false );
