== Changelog ==

= 1.2.5 - Jun 16 2015 =
* Minor bug fixes
* Escaping fixes
* Remove deprecated screen_icon function

= 1.2.3 - Sep 23 2014 =
* Removed a tag widget from 404 page template.
* Clearfix on entry content to avoid misplaced tilde on 404 page template.
* Added latin extended subset to Google Font Lato.
* Changed theme/author URIs and footer links to wordpress.com/themes.
* Reduced theme string proliferation.

= 1.2.2 - Jan 15 2014 =
* Use background-color instead of background for the blog header on small screens.

= 1.2.1 - Jul 11 2013 =
* Updated hgroup selector to match new class name.

= 1.2 - Jul 09 2013 =
* Moves away from using deprecated functions.
* Updated license.
* New screenshot at 600x450 for HiDPI support.
* Makes sure iframe in widget don't get cut off.

= 1.1 - Dec 28 2012 =
* Added a check is_ssl() to define a protocol for Google fonts in order to ensure it's available for both protocols.
* Removed loading of $locale.php.
* Made sure attribute escaping occurs after printing.
* Updated custom header admin styles to accurately reflect front-end display.
* Added a color scheme specific body class to ease styling IS footer.
* Fixed overly general .attachment img selectors.
* Added styling for HTML5 email inputs.
* Improved the design for small screens.
* Return value of esc_url() must be echoed to the screen.
* I18n fixes.
* esc_url() instead of esc_attr_e().
* Variables should not be passed to gettext functions.
* Added a more specific selector in the rule for the search form on the 404 page to prevent the search form layout from breaking in the main menu area when the 404 page is in use.
* Made site title and site description smaller for small devices like iPhone.
* Moved styles to wp_enqueue_scripts hook, Remove is_admin() conditional.
* Enabled entry date to be shown fully in IE7.
* Additional IE7 bug fix. When there was no header image, site title and description were not centered.
* Fixed bug: site title block expands too much over the header image in IE7.
* Made sure dequeue fonts only gets called when Typekit is purchased.
* Set content width on full width pages using function.
* Set on full-width page template to allow embeds to fill up the entire content area.
* the_post should always be called in the loop.
* Escaped translatable attribute values with esc_attr_e().
* Wrapped byline with a span to allow css targetting.
* Improved format for updating default widgets.
* Widget array should include the array_version and wp_inactive_widgets nodes, in order to comply with how WP expects sidebars_widgets to be formatted.
* Made sure the current category to be highlighted in the menu.
* Some #respond style improvements.
* &laquo; is better than &raquo; when using a reversed title.
* Kept transparency for modern browsers.
* Redid no-text on header css for ie8.

= 1.0 =
* Initial release.