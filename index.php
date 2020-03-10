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
			// $base_url = 'https://qiita.com';
			// $tag = 'PHP';
			// $query = ['page'=>'1','per_page'=>'5'];
			// $response = file_get_contents(
            //       $base_url.'/api/v2/tags/'.$tag.'/items?' .
            //       http_build_query($query)
			// );
			// // https://qiita.com/api/v2/tags/PHP/items?page=1&per_page=5
			// // 結果はjson形式で返されるので

			$base_url = 'https://catalog.data.metro.tokyo.lg.jp';
			$tag = 'package_show';
			$query = ['id'=>'t000010d0000000068'];
			$response = file_get_contents(
                  $base_url.'/api/3/action/'.$tag.'?' .
                  http_build_query($query)
			);
			$result = json_decode($response,true);
			$return ="";
			if($result["success"]){
				$resources_url = $result["result"]["resources"][0]["url"];
				$row = 1;
				if (($handle = fopen($resources_url, "r")) !== FALSE) {

					while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
						$num = count($data);
						$return .= "<p> $num fields in line $row: <br /></p>\n";
						$row++;
						for ($column=0; $c < $num; $column++) {
							$return .= $data[$column] . "<br />\n";
						}
					}
					fclose($handle);
				}
			}
			return $return;
		},
	) );
}