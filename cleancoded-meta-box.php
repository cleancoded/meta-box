<?php
/**
 * Plugin Name: Cleancoded Meta Box
 * Plugin URI:  https://github.com/cleancoded/meta-box
 * Description: Create custom meta boxes and custom fields in WordPress.
 * Version:     1.0
 * Author:      Cleancoded
 * Author URI:  https://cleancoded.com
 *
 * 
 */

if ( defined( 'ABSPATH' ) && ! defined( 'cleancoded_VER' ) ) {
	register_activation_hook( __FILE__, 'cleancoded_check_php_version' );

	/**
	 * Display notice for old PHP version.
	 */
	function cleancoded_check_php_version() {
		if ( version_compare( phpversion(), '5.3', '<' ) ) {
			die( esc_html__( 'Meta Box requires PHP version 5.3+. Please contact your host to upgrade.', 'meta-box' ) );
		}
	}

	require_once dirname( __FILE__ ) . '/inc/loader.php';
	$cleancoded_loader = new cleancoded_Loader();
	$cleancoded_loader->init();
}
