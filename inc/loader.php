<?php
/**
 * Load plugin's files with check for installing it as a standalone plugin or
 * a module of a theme / plugin. If standalone plugin is already installed, it
 * will take higher priority.
 *
 * @package Meta Box
 */

/**
 * Plugin loader class.
 *
 * @package Meta Box
 */
class cleancoded_Loader {
	/**
	 * Define plugin constants.
	 */
	protected function constants() {
		// Script version, used to add version for scripts and styles.
		define( 'cleancoded_VER', '5.2.10' );

		list( $path, $url ) = self::get_path( dirname( dirname( __FILE__ ) ) );

		// Plugin URLs, for fast enqueuing scripts and styles.
		define( 'cleancoded_URL', $url );
		define( 'cleancoded_JS_URL', trailingslashit( cleancoded_URL . 'js' ) );
		define( 'cleancoded_CSS_URL', trailingslashit( cleancoded_URL . 'css' ) );

		// Plugin paths, for including files.
		define( 'cleancoded_DIR', $path );
		define( 'cleancoded_INC_DIR', trailingslashit( cleancoded_DIR . 'inc' ) );
	}

	/**
	 * Get plugin base path and URL.
	 * The method is static and can be used in extensions.
	 *
	 * @link http://www.deluxeblogtips.com/2013/07/get-url-of-php-file-in-wordpress.html
	 * @param string $path Base folder path.
	 * @return array Path and URL.
	 */
	public static function get_path( $path = '' ) {
		// Plugin base path.
		$path       = wp_normalize_path( untrailingslashit( $path ) );
		$themes_dir = wp_normalize_path( untrailingslashit( dirname( get_stylesheet_directory() ) ) );

		// Default URL.
		$url = plugins_url( '', $path . '/' . basename( $path ) . '.php' );

		// Included into themes.
		if (
			0 !== strpos( $path, wp_normalize_path( WP_PLUGIN_DIR ) )
			&& 0 !== strpos( $path, wp_normalize_path( WPMU_PLUGIN_DIR ) )
			&& 0 === strpos( $path, $themes_dir )
		) {
			$themes_url = untrailingslashit( dirname( get_stylesheet_directory_uri() ) );
			$url        = str_replace( $themes_dir, $themes_url, $path );
		}

		$path = trailingslashit( $path );
		$url  = trailingslashit( $url );

		return array( $path, $url );
	}

	/**
	 * Bootstrap the plugin.
	 */
	public function init() {
		$this->constants();

		// Register autoload for classes.
		require_once cleancoded_INC_DIR . 'autoloader.php';
		$autoloader = new cleancoded_Autoloader();
		$autoloader->add( cleancoded_INC_DIR, 'RW_' );
		$autoloader->add( cleancoded_INC_DIR, 'cleancoded_' );
		$autoloader->add( cleancoded_INC_DIR . 'about', 'cleancoded_' );
		$autoloader->add( cleancoded_INC_DIR . 'fields', 'cleancoded_', '_Field' );
		$autoloader->add( cleancoded_INC_DIR . 'walkers', 'cleancoded_Walker_' );
		$autoloader->add( cleancoded_INC_DIR . 'interfaces', 'cleancoded_', '_Interface' );
		$autoloader->add( cleancoded_INC_DIR . 'storages', 'cleancoded_', '_Storage' );
		$autoloader->add( cleancoded_INC_DIR . 'helpers', 'cleancoded_Helpers_' );
		$autoloader->add( cleancoded_INC_DIR . 'update', 'cleancoded_Update_' );
		$autoloader->register();

		// Plugin core.
		$core = new cleancoded_Core();
		$core->init();

		// Validation module.
		new cleancoded_Validation();

		$sanitizer = new cleancoded_Sanitizer();
		$sanitizer->init();

		$media_modal = new cleancoded_Media_Modal();
		$media_modal->init();

		// WPML Compatibility.
		$wpml = new cleancoded_WPML();
		$wpml->init();

		// Update.
		$update_option  = new cleancoded_Update_Option();
		$update_checker = new cleancoded_Update_Checker( $update_option );
		$update_checker->init();
		$update_settings = new cleancoded_Update_Settings( $update_checker, $update_option );
		$update_settings->init();
		$update_notification = new cleancoded_Update_Notification( $update_checker, $update_option );
		$update_notification->init();

		if ( is_admin() ) {
			$about = new cleancoded_About( $update_checker );
			$about->init();
		}

		// Public functions.
		require_once cleancoded_INC_DIR . 'functions.php';
	}
}
