<?php
/**
 * Plugin Name: API Charts
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', 'register_myguten_block' );

function register_myguten_block() {

	$asset_file = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php');
	wp_register_script(
		'api-charts',
		plugins_url( 'build/index.js', __FILE__ ),
		$asset_file['dependencies'],
		$asset_file['version']
	);
	register_block_type( 'api-charts/default', array(
		'editor_script' => 'api-charts',
		'attributes'      => [
			'className' => [
			'type'    => 'string',
			'default' => '',
		],],
		'render_callback' => function ( $attributes ) {
			return "<div>Hello</div>";
		},
	) );
}