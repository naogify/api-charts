<?php
/**
 * Plugin Name: Myguten-block
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', 'register_myguten_block' );

function register_myguten_block() {

	$asset_file = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php');

	wp_register_script(
		'myguten-block',
		plugins_url( 'build/index.js', __FILE__ ),
		$asset_file['dependencies'],
		$asset_file['version']
	);
	register_block_type( 'myguten-block/example-01-basic-esnext', array(
		'editor_script' => 'myguten-block',
	) );
}
add_action( 'init', 'gutenberg_examples_01_esnext_register_block' );
