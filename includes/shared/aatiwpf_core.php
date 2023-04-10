<?php
// Check if the ABSPATH constant is defined
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
// Remove WP auto sitemaps
add_filter('wp_sitemaps_enabled', '__return_false');

//  disabling the Application Passwords feature
add_filter( 'wp_is_application_passwords_available', '__return_false' );
// major automatic updates will be disabled 
add_filter( 'allow_major_auto_core_updates', '__return_false' );
/**
 * Disable XML-RPC
 */
add_filter( 'xmlrpc_enabled', '__return_false' );
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
 * Disable REST-API for all users except of admin
 */
/**
add_filter('rest_authentication_errors', function ($access) {
    if (!current_user_can('administrator')) {
        return new WP_Error('rest_cannot_access', 'Only authenticated users can access the REST API.', ['status' => rest_authorization_required_code()]);
    }
    return $access;
});
*/

