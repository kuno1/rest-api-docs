<?php
/**
 * Translated strings.
 *
 * @package rad
 */

defined( 'ABSPATH' ) || die();

return [
	'route'  => rest_url(),
	'nonce'  => wp_create_nonce( 'wp_rest' ),
	'labels' => [
		'route'         => __( 'Home', 'rad' ),
		'namespace'     => __( 'Namespaces', 'rad' ),
		'not_set'       => __( 'Not set', 'rad' ),
		'type'          => __( 'Type', 'rad' ),
		'arguments'     => __( 'Arguments', 'rad' ),
		'no_arguments'  => __( 'No arguments.', 'rad' ),
		'default_value' => __( 'Default Value', 'rad' ),
		'allowed_value' => __( 'Allowed Value', 'rad' ),
		'required'      => __( 'Required', 'rad' ),
		'description'   => __( 'Description', 'rad' ),
		'no_namespace'  => __( 'Please select namespace.', 'rad' ),
	],
];
