# Wordpress Theme Starter

php [composer](https://getcomposer.org/) is required. Wordpress plugins are then required and installed from [https://wpackagist.org/](https://wpackagist.org/).

#### .env
Initialize .env file in root of project and define variables for docler-compose.
..* WORDPRESS_DB_NAME=some-name
..* WORDPRESS_DB_PASSWORD=some-password

Then for the theme files in the app folder to mount into the theme directory with a given theme name, change the name of **"WORDPRESS_THEME_NAME"** to your themes name. **ex: My-wp-theme** in the docker-compose.yml file.

Then replace THEME NAME in resources/styles/main.scss and app/functions.php to your themes name. **ex: My-wp-theme**.

..* RUN: npm install
..* RUN: npm run wp:init (The first time)
ref other options in package.json file.

then visit [http://localhost:8080](http://localhost:8080) and complete the wp install.
