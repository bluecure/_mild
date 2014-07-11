/**
 * Adds shortcode buttons to editor.
 */

( function( $ ) {

    tinymce.create('tinymce.plugins.shortcodes', {
        
        /**
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init : function(ed, url) {

            ed.on('init', function( ed ) {
                // Toggle the third row
                var toggleBtn = $('.mce_wp_adv'),
                    rowTwo = $('.mceToolbarRow2'),
                    rowThree = $('.mceToolbarRow3');
                if ( getUserSetting( 'hidetb', '0' ) == '0' ) {
                    rowThree.hide();
                }
                toggleBtn.on('click', function() {
                    if ( rowTwo.is(':visible') ) {
                        rowThree.show();
                    } else {
                        rowThree.hide();
                    }
                });
            });

            // Add row button
            ed.addButton('s_row', {
                title : 'Insert row with columns',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert row with columns',
                        url: url + '/views/row.php',
                        width: 500,
                        height: 220,
                        inline: true
                    });
                }
            });

            // Add icon button
            ed.addButton('s_icon', {
                title : 'Insert icon',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert Icon',
                        url: url + '/views/icon.php',
                        width: 500,
                        height: 280,
                        inline: true
                    });
                }
            });

            // Add button button
            ed.addButton('s_button', {
                title : 'Insert button',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert Button',
                        url: url + '/views/button.php',
                        width: 500,
                        height: 280,
                        inline: true
                    });
                }
            });

            // Add panel button
            ed.addButton('s_panel', {
                title : 'Insert panel',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert Panel',
                        url: url + '/views/panel.php',
                        width: 500,
                        height: 230,
                        inline: true
                    });
                }
            });

            // Add alignment
            ed.addButton('s_align', {
                title : 'Insert alignment',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert Alignment',
                        url: url + '/views/align.php',
                        width: 500,
                        height: 180,
                        inline: true
                    });
                }
            });
            
            // Add accordion button
            ed.addButton('s_accordion', {
                title : 'Insert accordion',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert Accordion',
                        url: url + '/views/accordion.php',
                        width: 500,
                        height: 230,
                        inline: true
                    });
                }
            });
            
            // Add show button
            ed.addButton('s_show', {
                title : 'Show recent posts',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert Posts',
                        url: url + '/views/show.php',
                        width: 500,
                        height: 280,
                        inline: true
                    });
                }
            });
            
            // Add login button
            ed.addButton('s_login', {
                title : 'Insert login form',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert Login Form',
                        url: url + '/views/login.php',
                        width: 500,
                        height: 180,
                        inline: true
                    });
                }
            });

            // Add sitemap button
            ed.addButton('s_sitemap', {
                title : 'Insert sitemap',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert Sitemap',
                        url: url + '/views/sitemap.php',
                        width: 500,
                        height: 180,
                        inline: true
                    });
                }
            });

            // Add map button
            ed.addButton('s_map', {
                title : 'Insert map',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert Map',
                        url: url + '/views/map.php',
                        width: 500,
                        height: 220,
                        inline: true
                    });
                }
            });

            // Add iframe button
            ed.addButton('s_iframe', {
                title : 'Insert iframe',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert iFrame',
                        url: url + '/views/iframe.php',
                        width: 500,
                        height: 220,
                        inline: true
                    });
                }
            });

        },

        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo : function() {
            return {
                    longname : 'Shortcode Buttons',
                    version : "1.0"
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('mce_editor_shortcodes', tinymce.plugins.shortcodes);

} )( jQuery );