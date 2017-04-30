<?php
/**
 * Custom tweaks for this theme.
 *
 * @package Bow
 */

/**
 * Process shortcodes in widgets.
 */
add_filter('widget_text', 'do_shortcode');

/**
 * Enable core buttons.
 */
add_filter('mce_buttons_2', function($buttons) {
    $buttons[] = 'hr';
    return $buttons;
});

/**
 * Allow SVG uploads.
 */
add_filter('upload_mimes', function($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

/**
 * Alter the excerpt more.
 */
add_filter('excerpt_more', function($more) {
    return '<br><a href="' . get_permalink() . '" class="more"> ' . __('Read More...', 'bow') . '</a>';
});

/**
 * Redirect user after logout.
 */
add_filter('logout_url', function($logout_url, $redirect = null) {
    return $logout_url . '&amp;redirect_to=' . urlencode(home_url());
});
