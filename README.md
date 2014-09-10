#Mild

Hi, This is `Mild` a WordPress Starter Theme based off `_s`.

`Mild` uses `Sass` as it's preprocessor and `Gulp` or `Prepros` for compilation, concatenation and so on.

Note: This is a work in progress and can break at anytime. 
[Underscores](http://github.com/Automattic/_s) or [Roots](http://github.com/roots/roots) might be more useful.

####Mild includeds:
* Standard templates
* Default styles
* Custom functions
* Helper classes
* Image widget
* Latest posts widgets
* Shortcodes plugin
* Normalize (3.0.1)
* Font Awesome (4.2.0)
* OwlCarousel (2.0.0)
* Magnific Popup (0.9.9)
* OptionTree (Latest)

####Installing theme (via composer):
1. `$ composer create-project lambry/mild theme-name --prefer-dist`

####Installing theme (via git):
1. `$ git clone --recursive https://github.com/lambry/mild.git`
2. `$ rmdir mild\.git /s /q` (optional: remove git folder)
3. `$ Rename mild my-new-theme-name` (optional: rename folder)

####Setting up theme:
1. Rename the theme in `assets/styes/styles.scss`
2. Also, update the Author, URIs and description.

####Using Gulp:
1. Rename the theme in `package.json`
2. Install Gulp and plugins: `$ npm install`
3. Run gulp: `$ gulp`

####Using Prepros:
1. Rename the theme in `prepros.json`
2. Open theme folder in Prepros (pro)
