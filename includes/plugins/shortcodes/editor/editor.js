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

            ed.onInit.add(function( ed ) {
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

            // add row button
            ed.addButton('row', {
                title : 'Insert row with columns',
                cmd : 'row',
                class: 'dashicons-screenoptions',
                icon: false,
                wrapper: false,
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert row with columns',
                        url: url + '/views/row.php',
                        width: 500,
                        height: 350,
                        inline: true
                    });
                }
            });

            // add icon button
            ed.addButton('icon', {
                title : 'Insert icon',
                cmd : 'icon',
                class: 'dashicons-star-filled',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert Icon',
                        url: url + '/views/icon.php',
                        width: 500,
                        height: 350,
                        inline: true
                    });
                }
            });

            // add button button
            ed.addButton('button', {
                title : 'Insert button',
                cmd : 'button',
                class: 'dashicons-align-none',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert Button',
                        url: url + '/views/button.php',
                        width: 500,
                        height: 350,
                        inline: true
                    });
                }
            });

            // add panel button
            ed.addButton('panel', {
                title : 'Insert panel',
                cmd : 'panel',
                class: 'dashicons-align-center',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert Panel',
                        url: url + '/views/panel.php',
                        width: 500,
                        height: 300,
                        inline: true
                    });
                }
            });

            // add alignment
            ed.addButton('align', {
                title : 'Insert alignment',
                cmd : 'align',
                class: 'dashicons-editor-outdent',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert Alignment',
                        url: url + '/views/align.php',
                        width: 500,
                        height: 250,
                        inline: true
                    });
                }
            });

            // add accordion button
            ed.addButton('accordion', {
                title : 'Insert accordion',
                cmd : 'accordion',
                class: 'dashicons-plus',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert Accordion',
                        url: url + '/views/accordion.php',
                        width: 500,
                        height: 300,
                        inline: true
                    });
                }
            });

            // add show button
            ed.addButton('show', {
                title : 'Show recent posts',
                cmd : 'show',
                class: 'dashicons-visibility',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert Posts',
                        url: url + '/views/show.php',
                        width: 500,
                        height: 350,
                        inline: true
                    });
                }
            });

            // add sitemap button
            ed.addButton('sitemap', {
                title : 'Insert sitemap',
                cmd : 'sitemap',
                class: 'dashicons-networking',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert Sitemap',
                        url: url + '/views/sitemap.php',
                        width: 500,
                        height: 250,
                        inline: true
                    });
                }
            });

            // add map button
            ed.addButton('map', {
                title : 'Insert map',
                cmd : 'map',
                class: 'dashicons-location',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Insert Map',
                        url: url + '/views/map.php',
                        width: 500,
                        height: 300,
                        inline: true
                    });
                }
            });

        },

        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl : function(n, cm) {
            return null;
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
                    author : 'David Featherston',
                    authorurl : 'http://lambry.com',
                    version : "1.0"
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('mce_editor_shortcodes', tinymce.plugins.shortcodes);

} )( jQuery );