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
		'attributes'      => [
			'className' => [
			'type'    => 'string',
			'default' => '',
		],],
		// 'render_callback' => function ( $attributes ) {
		// 	// $base_url = 'https://qiita.com';
		// 	// $tag = 'PHP';
		// 	// $query = ['page'=>'1','per_page'=>'5'];
		// 	// $response = file_get_contents(
        //     //       $base_url.'/api/v2/tags/'.$tag.'/items?' .
        //     //       http_build_query($query)
		// 	// );
		// 	// // https://qiita.com/api/v2/tags/PHP/items?page=1&per_page=5
		// 	// // 結果はjson形式で返されるので

		// 	// $base_url = 'https://catalog.data.metro.tokyo.lg.jp';
		// 	// $tag = 'package_show';
		// 	// $query = ['id'=>'t000010d0000000068'];
		// 	// $response = file_get_contents(
        //     //       $base_url.'/api/3/action/'.$tag.'?' .
        //     //       http_build_query($query)
		// 	// );
		// 	// $result = json_decode($response,true);
		// 	// $return ="";
		// 	// if($result["success"]){
		// 	// 	$resources_url = $result["result"]["resources"][0]["url"];
		// 	// 	$row = 1;
		// 	// 	if (($handle = fopen($resources_url, "r")) !== FALSE) {

		// 	// 		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		// 	// 			$num = count($data);
		// 	// 			$return .= "<p> $num fields in line $row: <br /></p>\n";
		// 	// 			$row++;
		// 	// 			for ($column=0; $c < $num; $column++) {
		// 	// 				$return .= $data[$column] . "<br />\n";
		// 	// 			}
		// 	// 		}
		// 	// 		fclose($handle);
		// 	// 	}
		// 	// }
		// 	// return $return;

		// 	$render = '
		// 	<script>alert("JavaScriptのアラート");</script>
		// 	<div id="chart_div">helllllo</div>
		// 	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		// 	<script type="text/javascript">
		// 	// Load the Visualization API and the piechart package.
		// 	google.charts.load("current", {"packages":["corechart"]})
		// 	// Set a callback to run when the Google Visualization API is loaded.
		// 	google.charts.setOnLoadCallback(drawChart)
		// 	function drawChart() {		
		// 	  // Create our data table out of JSON data loaded from server.
		// 	  var data = new google.visualization.DataTable({
		// 		"cols": [
		// 			  {"id":"","label":"Topping","pattern":"","type":"string"},
		// 			  {"id":"","label":"Slices","pattern":"","type":"number"}
		// 			],
		// 		"rows": [
		// 			  {"c":[{"v":"Mushrooms","f":null},{"v":3,"f":null}]},
		// 			  {"c":[{"v":"Onions","f":null},{"v":1,"f":null}]},
		// 			  {"c":[{"v":"Olives","f":null},{"v":1,"f":null}]},
		// 			  {"c":[{"v":"Zucchini","f":null},{"v":1,"f":null}]},
		// 			  {"c":[{"v":"Pepperoni","f":null},{"v":2,"f":null}]}
		// 			]
		// 	  });
		// 	  // Instantiate and draw our chart, passing in some options.
		// 	  var chart = new google.visualization.PieChart(document.getElementById("chart_div"));
		// 	  chart.draw(data, {width: 400, height: 240});
		// 	}
		// 	console.log("fsafdsafafsadfasdfafsadf");
		// 	</script>';
		// 	return $render;
		// },
	) );
}

function theme_name_scripts() {
	wp_enqueue_script( 'google-charts', 'https://www.gstatic.com/charts/loader.js', array(), '1.0.0', false );
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );
add_action( 'admin_enqueue_scripts', 'theme_name_scripts' );