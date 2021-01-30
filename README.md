# Wordpress Theme Scaffold

### Use theme

First clone repo

```
git clone https://github.com/Chrillaz/wordpress-theme-scaffold && cd wordpress-theme-scaffold && rm -rf .git
```

Name theme.
  
  All theme headers for stylesheet are generated from below properties in package.json
   * Theme Name   = package.json title
   * Theme URI    = package.json homepage
   * Author       = package.json author
   * Author URI   = package.json authorUri
   * Description  = package.json description
   * Version      = package.json version
   * License      = package.json license
   * Licence URI  = package.json licenseUri
   * Text Domain  = package.json textDomain
   * Domain Path  = package.json domainPath

   - RUN ```npm install```
   - RUN ```npm start``` to generate theme stylesheet

Then Install composer for psr-4 autoload. ```composer install```

### Local development with @wordpress-env

edit .wp-env.json to fit the environment. reference: [@wordpress-env docs.](https://developer.wordpress.org/block-editor/packages/packages-env/)

### Webpack

To chunk .scss or .ts files specify each by name => src in entry of the config

```
entry: { 
    main: './js/src/main.ts',
    style: './scss/main.scss',
    example: './js/src/example.ts
}
```

then enqueue assets in functions.php using the asset loader. Example defined in functions.php.

```
$theme->assets()->enqueue( function ( $self ) {

    $self->addScript( 'main', [
      'src'          => $self->src( '/assets/js/main.min.js' ),
      'scriptexec'   => 'defer',
      'dependencies' => [],
      'infooter'     => true
    ]);
});
```