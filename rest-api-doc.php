<?php
/**
 * Plugin Name:     REST API Docs
 * Plugin URI:      https://wordpress.org/plugins/rest-api-docs
 * Description:     A documentation tool for WP REST API.
 * Author:          TAROSKY INC.
 * Author URI:      https://tarosky.co.jp/
 * Text Domain:     rad
 * Domain Path:     /languages
 * Version:         0.2.0
 *
 * @package         rad
 */

defined( 'ABSPATH' ) || die();

/**
 * Display errors on admin screen.
 *
 * @internal
 */
function rad_alert() {
	// translators: %s is PHP version.
	$msg = sprintf( __( 'This plugin requires PHP 5.4 and over, but your\'s %s.', 'rad' ), phpversion() );
	printf( '<div class="error"><p><strong>REST API Docs</strong>%s</p></div>', esc_html( $msg ) );
}

/**
 * Register plugin
 *
 * @internal
 */
function rad_init() {
	load_plugin_textdomain( 'rad', null, basename( dirname( __FILE__ ) ) . '/languages' );
	if ( version_compare( phpversion(), '5.4.0', '<' ) ) {
		add_action( 'admin_notices', 'rad_alert' );
	} else {
		add_action( 'admin_menu', 'rad_register_menu' );
	}
}

add_action( 'plugins_loaded', 'rad_init' );

/**
 * Register admin menu page
 *
 * @internal
 */
function rad_register_menu() {
	add_submenu_page( 'tools.php', __( 'REST API Doc', 'rad' ), __( 'REST API', 'rad' ), 'manage_options', 'rest-api-doc', 'rad_admin_page' );
}

/**
 * Enqueue Assets.
 *
 * @param string $page Page slug.
 */
function rad_assets( $page ) {
	if ( 'tools_page_rest-api-doc' !== $page ) {
		return;
	}
	$asset_dir = plugin_dir_url( __FILE__ ) . 'assets';
	$info      = get_file_data( __FILE__, array(
		'version' => 'Version',
	) );
	$version   = $info['version'];
	// Load global style.
	wp_enqueue_style( 'rad-admin', $asset_dir . '/css/rest-api-docs.css', [], $version );
	// Load Scripts.
	wp_enqueue_script( 'rad-admin', $asset_dir . '/js/rest-api-docs.js', [], $version, true );
	$vars = include __DIR__ . '/includes/i18n.php';
	wp_localize_script( 'rad-admin', 'RadVars', $vars );
}

add_action( 'admin_enqueue_scripts', 'rad_assets' );

/**
 * Register admin page
 *
 * @internal
 */
function rad_admin_page() {
	?>
	<div class="wrap">
		<h2><?php esc_html_e( 'REST API Documentation', 'rad' ); ?></h2>
		<div id="rest-api-doc"></div>
	</div>
	<?php
}
