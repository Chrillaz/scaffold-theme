const { kebabCase } = window.lodash;
const { registerBlockType } = window.wp.blocks;
import { exampleBlock } from './example-block'

const sortName = (a: any, b: any) => a.title < b.title ? -1 : a.title > b.title ? 1 : 0;

const register = ( prefix: string, block: any ) => registerBlockType( `${prefix}/${kebabCase(block.title)}`, block );

export const registerThemeBlocks = ( prefix: string ) => [
  // Import blocks at top and include here...
  exampleBlock
].sort( sortName ).forEach( block => register( prefix, block ) );