const { registerBlockType } = window.wp.blocks;

import { test } from './test'

const prefix = 'scaffold/';

const register = ( prefix: string, block: any ) => {

  const { name, config } = block;

  registerBlockType( `${prefix}/${name}`, config );
}

export const registerThemeBlocks = ( prefix: string ) => [
  // Import blocks at the top and include in this list
  test
].forEach( block => register( prefix, block ) );