<?php
/**
 * The Header file for this theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Mild
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="hfeed site container">
    <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'mild' ); ?></a>
	<header id="masthead" class="site-header row" role="banner">
		<div class="site-branding col-12">
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div><!-- .site-branding -->
		<nav class="main-navigation col-12" role="navigation">
			<div class="menu-toggle fa fa-bars"> <?php _e( 'Menu', 'mild' ); ?> </div>
			<?php wp_nav_menu( [ 'theme_location' => 'primary' ] ); ?>
		</nav><!-- .main-navigation -->
	</header><!-- .site-header -->

	<div id="content" class="site-content row">