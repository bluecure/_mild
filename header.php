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
<?php get_template_part( 'partials/header', 'meta' ); ?>
<?php wp_head(); ?>
<!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
<![endif]-->
</head>
<?php $logo = ot_get_option( 'ot_logo', '' ); ?>
<body <?php body_class(); ?>>
<div class="hfeed site container">
    <a class="skip-link screen-reader-text" href="#content">Skip to content</a>
	<header id="masthead" class="site-header row" role="banner">
		<div class="site-branding col-6">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php if ( $logo ) : ?>
					<img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" class="site-logo">
				<?php else : ?>
					<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<?php endif; ?>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</a>
		</div><!-- .site-branding -->
		<nav class="main-navigation col-6" role="navigation">
			<div class="menu-toggle fa fa-bars"> Menu </div>
			<?php wp_nav_menu( [ 'theme_location' => 'primary' ] ); ?>
		</nav><!-- .main-navigation -->
	</header><!-- .site-header -->

	<div id="content" class="site-content row">