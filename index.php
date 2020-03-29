<?php
/**
 * Plugin Name: API Charts
 */

require("App/RestAPI/csv/EntryPoint.php");

defined( 'ABSPATH' ) || exit;
add_action( 'init', 'register_myguten_block' );

function register_myguten_block() {

	new EntryPoint();

	$asset_file = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php');
	wp_register_script(
		'api-charts',
		plugins_url( 'build/index.js', __FILE__ ),
		$asset_file['dependencies'],
		$asset_file['version']
	);
	register_block_type( 'api-charts/default', array(
		'editor_script' => 'api-charts',
		'render_callback' => function ( $attributes,$content ) {
			$js = file_get_contents(plugin_dir_path( __FILE__ ).'src/blocks/default/drawCharts.js');
			$js = trim($js);
			$js = ltrim($js, 'export const drawCharts = () => {');
			$js = rtrim($js, '}; ');
			return '<div id="chart_div">Loading Charts ...</div><script type="text/javascript">' . $js .'</script>';
		},
	) );
}

function theme_name_scripts() {
	wp_enqueue_script( 'google-charts', 'https://www.gstatic.com/charts/loader.js', array(), '1.0.0', false );
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );
add_action( 'admin_enqueue_scripts', 'theme_name_scripts' );



	// $base_url = 'https://catalog.data.metro.tokyo.lg.jp';
			// $tag = 'package_show';
			// $query = ['id'=>'t000010d0000000068'];
			// $response = file_get_contents(
            //       $base_url.'/api/3/action/'.$tag.'?' .
            //       http_build_query($query)
			// );
			// $result = json_decode($response,true);
			// $return ="";
			// if($result["success"]){
			// 	$resources_url = $result["result"]["resources"][0]["url"];
			// 	$row = 1;
			// 	if (($handle = fopen($resources_url, "r")) !== FALSE) {

			// 		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			// 			$num = count($data);
			// 			$return .= "<p> $num fields in line $row: <br /></p>\n";
			// 			$row++;
			// 			for ($column=0; $c < $num; $column++) {
			// 				$return .= $data[$column] . "<br />\n";
			// 			}
			// 		}
			// 		fclose($handle);
			// 	}
			// }
			// return $return;