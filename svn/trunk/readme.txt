=== aati-wp-finetuning ===
Contributors: jseutens
Tags: aati finetuning cf7 fail2ban
Requires at least: 5.6
Tested up to: 5.8
Requires PHP: 7.4
Stable tag: 0.5.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Fine tuning a WP setup by removing or adding options , just for easy updating setting on all my personal sites. If useful for someone else , use it :-)

== Installation ==
This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/aati-wp-finetuning` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. no settings to change , all is hardcoded

== Frequently Asked Questions ==
no faq , read the script :-) it is well documented ;-)
Included in the comments of the script from where I got each entry.

== Changelog ==
= 0.5.3 =
added removing dashicons for not logged on users
= 0.5.2 =
BUG FIX language files renamed to correct names
= 0.5.1 =
* BUG FIX: PHP Warning:  Use of undefined constant wpcf7log_filter_spam - assumed 'wpcf7log_filter_spam' (this will throw an Error in a future version of PHP) 
= 0.5.0 =
* added logging cf7 submissions for fail2ban (only usefull if fail2ban is active)
* added translations
* changed name of plugin.php to aati-wp-finetuning.php
= 0.4.0 =
Prepared for first svn publication on wp repository
= 0.3.0 =
* commented out the rest-api disabling , broke CF7
= 0.2.0 =
* updates for headers
= 0.1.0 =
* Initial release

== Upgrade Notice ==
upgrade as you please
