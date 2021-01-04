<?php
/*
  Plugin Name: AATI WP Finetuning
  Plugin URI: https://github.com/jseutens/aati-wp-finetuning/
  Description: Finetuning a WP setup by removing or adding options
  Version: 0.2
  Author: Johan Seutens
  Author URI: https://www.aati.be
  Text Domain: aatiwpfinetuning
  Domain Path: /languages/
	License: GPLv3
	License URI: http://www.gnu.org/licenses/gpl-3.0.txt

	Copyright (C) 2021 by AATI <https://www.aati.be>

	This file is part of AATI WP Finetuning.

	AATI WP Finetuning is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	AATI WP Finetuning is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with AATI WP Finetuning; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
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

