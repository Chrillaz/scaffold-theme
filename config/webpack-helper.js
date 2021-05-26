const fs = require( 'fs' ),
      package = require( '../package.json' );

const themeHeaders = () => {

  return this.headers = [
    '/*',
    ' * Theme Name: ' + package.themeName,
    ' * Theme URI: ' + package.homepage,
    ' * Author: ' + package.author,
    ' * Author URI: ' + package.authorUri,
    ' * Description: ' + package.description,
    ' * Version: ' + package.version,
    ' * License: ' + package.license,
    ' * Licence URI: ' + package.licenseUri,
    ' * Text Domain: ' + package.name,
    ' * Template: ',
    ' */\n',
  ].join( '\n' );
}

class WebpackHelper {

  constructor () {

    this.externals = {};

    this.entries = {};

    this.rules = [];

    this.plugins = [];
  }

  addEntry ( name, path ) {

    Object.assign( this.entries, {[name]: path });

    return this;
  }

  getEntries () {

    return this.entries;
  }

  addRule ( rule ) {

    this.rules.push( rule );

    return this;
  }

  getRules () {

    return this.rules;
  }

  addPlugin ( plugin ) {

    this.plugins.push( plugin );

    return this;
  }

  getPlugins () {

    return this.plugins;
  }

  addExternal ( external ) {

    Object.assign( this.externals, external );

    return this;
  }

  getExternals () {

    return this.externals;
  }

  doThemeHeaders () {

    if ( ! fs.existsSync( './style.css' ) ) {
  
      fs.writeFile( 'style.css', themeHeaders(), err => 
        console.log( err ? err : 'Theme style.css generated! \n' ) 
      ); 
    }
  }
}

exports.helper = new WebpackHelper();