const settings = require( './settings.json' );

const injectCustomProperties = (options, { prefix, injectTo }) => {

  const { 
    custom, 
    colors,
    typography 
  } = options.settings;
  
  const declaration = {};

  const customProperties = [];

  const kebabify = str => str.replace(/([a-z0-9])([A-Z])/g, '$1-$2').toLowerCase();
  
  Object.assign(declaration, {
    custom: Object.keys( custom ).map( key => ({ slug: key, value: custom[key]})),
    color: [...colors.palette],
    fontSize: [...typography.fontSize]
  });
  
  for ( decl in declaration ) {

    declaration[decl] != 'undefined' && customProperties.push( declaration[decl] );
  }

  const parsed = customProperties.map((property, index) => 

    property.reduce((prev, curr) => {
        
        const key = Object.keys(declaration)[index],
              value = Object.values(curr)[Object.keys(curr).length -1];
        
        return prev + `${prefix + kebabify(key)}--${kebabify(curr.slug)}: ${value}; \n`;
      }, '')
  ).join('');

  return {
    postcssPlugin: 'inject-custom-properties',
    Once( root, { Rule } ) {

      const filePath = root.source.input.file.split( /[\\\/]/ ),
            file = filePath[filePath.length - 1];

      if ( injectTo.includes( file ) ) {

        const selector = new Rule({ selector: ':root' });
        selector.append( parsed );
        root.nodes.unshift( selector );
      }
    }
  }
}

module.exports = {
  plugins: [
    require('autoprefixer'),
    injectCustomProperties(settings, {
      prefix: '--noor--',
      injectTo: ['main.scss', 'editor.scss']
    })
  ]
}