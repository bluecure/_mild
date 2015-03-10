<?php
/**
 * The template for displaying the header.
 *
 * @package Mild
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php get_template_part( 'partials/header', 'meta' ); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'mild' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="row">

				<div class="site-branding col-12">
					<?php Mild\site_title(); ?>
				</div><!-- .site-branding -->

				<nav class="primary-navigation col-12" role="navigation">
					<div class="menu-toggle"><i class="fa fa-bars"></i> <?php _e( 'Menu', 'mild' ); ?></div>
					<?php wp_nav_menu( [ 'theme_location' => 'primary' ] ); ?>
				</nav><!-- .primary-navigation -->

			</div><!-- .row -->
		</div><!-- .container -->
	</header><!-- .site-header -->

	<div id="content" class="site-content">
		<div class="container">
			<div class="row">