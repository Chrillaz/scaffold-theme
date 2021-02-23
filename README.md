# Wordpress Theme Scaffold

### Use theme

First clone repo

```
git clone https://github.com/Chrillaz/wordpress-theme-scaffold && cd wordpress-theme-scaffold && rm -rf .git
```

Name theme.
  
  All theme headers for stylesheet are generated from below properties in settings.json
   * Theme Name   = settings.json name
   * Theme URI    = settings.json homepage
   * Author       = settings.json author
   * Author URI   = settings.json authoruri
   * Description  = settings.json description
   * Version      = settings.json version
   * License      = settings.json license
   * Licence URI  = settings.json licenseuri
   * Text Domain  = settings.json textdomain
   * Domain Path  = settings.json domainpath

   - RUN ```npm install```
   - RUN ```npm start``` to generate theme stylesheet

Then Install composer for psr-4 autoload. ```composer install```

### Local development with @wordpress-env

edit .wp-env.json to fit the environment. reference: [@wordpress-env docs.](https://developer.wordpress.org/block-editor/packages/packages-env/)

### Webpack

To chunk .scss or .ts files specify each by name => src in entry of the webpack-assets property in settings.json. 

settings.json
```
"webpack-assets": {
    "scripts": {
      "main": "./js/src/main.ts",
      "editor-scripts": "./js/src/editor.ts"
    },
    "styles": {
      "style": "./scss/main.scss",
      "editor-styles": "./scss/editor.scss"
    }
  },
```

then enqueue assets in functions.php using the asset loader. Example defined in functions.php.

```
add_action( 'scaffold/public_assets', function ( $assets ) {

  $assets->style( 'main', 'style.css' )->inline( $assets->getCSSVars() )->enqueue();

  $assets->script( 'main', 'main.min.js' )->load( 'defer' )->enqueue();
});
```