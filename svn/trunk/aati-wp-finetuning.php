<?php
/*
Plugin Name: AATI WP Finetuning
Plugin URI: https://github.com/jseutens/aati-wp-finetuning/
Description: Finetuning a WP setup by removing or adding options
Version: 0.5.2
Author: Johan Seutens
Author URI: https://www.aati.be
Text Domain: aatiwpfinetuning
Domain Path: /languages/
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// REMOVE WP EMOJI
// Done by the plugin :  Disable Emojis (GDPR friendly)
// no need to do this again when a plugin exists

// these are tips from https://www.jemjabella.co.uk/2019/10-micro-optimisations-for-a-faster-wordpress-website/
add_filter( 'wp_is_application_passwords_available', '__return_false' );
add_filter( 'allow_major_auto_core_updates', '_return_false' );
// can be found in https://wordpress.org/plugins/clearfy/ but its to big , just need a few parts of it , don't want to change it on multiple sites seperate so only code solutions like the emojis plugin are an option
// also see https://blacksaildivision.com/how-to-clean-up-wordpress-head-tag
/**
 * Remove info about WordPress version from <head>
 */
remove_action('wp_head', 'wp_generator');
/**
 * Disable XML-RPC
 */
add_filter('xmlrpc_enabled', function (): bool {
    return false;
});

/**
 * Remove XML-RPC link from <head>
 */
remove_action('wp_head', 'rsd_link');

/**
 * Disable RSS feeds by redirecting their URLs to homepage
 */
foreach (['do_feed_rss2', 'do_feed_rss2_comments'] as $feedAction) {
    add_action($feedAction, function (): void {
        // Redirect permanently to homepage
        wp_redirect(home_url(), 301);
        exit;
    }, 1);
}
/**
 * Remove the feed links from <head>
 */
remove_action('wp_head', 'feed_links', 2);
/**
 * Disable REST-API for all users except of admin
 */
/**
Disabling rest-api is a bad idea for now , CF7 broke down with a 401 not authorized
add_filter('rest_authentication_errors', function ($access) {
    if (!current_user_can('administrator')) {
        return new WP_Error('rest_cannot_access', 'Only authenticated users can access the REST API.', ['status' => rest_authorization_required_code()]);
    }
    return $access;
});
 */
/**
 * Remove REST-AI link from <head>
 */
remove_action('wp_head', 'rest_output_link_wp_head');

/**
 * Remove Windows Live Writer manifest from <head>
 */
remove_action('wp_head', 'wlwmanifest_link');

//  copied from https://github.com/miconda/wp-fail2ban-addon-cf7log
// see https://contactform7.com/2020/07/18/custom-spam-filtering/
// miconda his function :  PHP Warning:  Use of undefined constant wpcf7log_filter_spam - assumed 'wpcf7log_filter_spam' (this will throw an Error in a future version of PHP) 
// instead of declaring  I revoked it as the add filter works too
add_filter( 'wpcf7_spam', function( $spam ) {
        openlog('wpcf7log', LOG_PID, LOG_DAEMON);
        syslog(LOG_NOTICE, "contact form 7 submission from {$_SERVER['REMOTE_ADDR']}");
        closelog();
  return $spam;
}, 100, 1 );

//https://wordpress.stackexchange.com/questions/161476/how-to-remove-dashicons-min-css-from-frontend
// Remove dashicons in frontend for unauthenticated users
add_action( 'wp_enqueue_scripts', 'bs_dequeue_dashicons' );
function bs_dequeue_dashicons() {
    if ( ! is_user_logged_in() ) {
        wp_deregister_style( 'dashicons' );
    }
}
