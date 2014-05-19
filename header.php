<?php
/**
 * The Header file for this theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Mild
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php get_template_part( 'partials/header', 'meta' ); ?>
<?php wp_head(); ?>
<!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
<![endif]-->
</head>
<?php $logo = ot_get_option( 'ot_logo', '' ); ?>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title">
				<?php if ( $logo ) : ?>
					<img  src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>">
				<?php else : ?>
					<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<?php endif; ?>
			</a>
		</div><!-- .site-branding -->
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="menu-toggle fa fa-bars"> Menu </div>
			<a class="skip-link screen-reader-text" href="#content">Skip to content</a>
			<?php wp_nav_menu( [ 'theme_location' => 'primary' ] ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">