<?php
/*
Plugin Name: AATI WP Finetuning
Plugin URI: https://github.com/jseutens/aati-wp-finetuning/
Description: Finetuning a WP setup by removing or adding options
Version: 1.0
Author: Johan Seutens
Author URI: https://www.aati.be
License: GPLv2 or later
Text Domain: aatiwpfinetuning
 */

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
