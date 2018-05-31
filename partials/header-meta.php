<?php
/**
 * The partial for display within the head section.
 *
 * @package Bow
 */
?>

<link rel="manifest" href="<?php echo get_template_directory_uri() . '/manifest.json'; ?>">

<?php // Get theme mods
$javascript = get_theme_mod('javascript');

/* JavaScript */
if ($javascript) : ?>
    <script><?php echo $javascript; ?></script>
<?php endif;
