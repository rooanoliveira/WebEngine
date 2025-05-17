<?php
/**
 * CabalEngine CMS
 * 
 * @version 1.0.0 / Based on WebEngine 1.2.6 by Lautaro Angelico <http://webenginecms.com/>
 * @Mod author Rooan Oliveira / Original author Lautaro Angelico <http://lautaroangelico.com/>
 * @copyright (c) 2013-2025 Lautaro Angelico, All Rights Reserved
 * 
 * Licensed under the MIT license
 * http://opensource.org/licenses/MIT
 */

define('access', 'api');
header('Content-Type: application/json');

try {
	
	// Load CabalEngine
	if(!@include_once(rtrim(str_replace('\\','/', dirname(__DIR__)), '/') . '/includes/cabalengine.php')) throw new Exception('Could not load CabalEngine.');
	
	// Apache Version
	if(!function_exists('apache_get_version')) {
		function apache_get_version() {
			if(!isset($_SERVER['SERVER_SOFTWARE']) || strlen($_SERVER['SERVER_SOFTWARE']) == 0) {
				return '';
			}
			return $_SERVER['SERVER_SOFTWARE'];
		}
	}
	
	// Listener
	$handler = new Handler();
	
	// Response
	http_response_code(200);
	echo json_encode(array('code' => 200, 'apache' => apache_get_version(), 'php' => phpversion(), 'cabalengine' => __CABALENGINE_VERSION__), JSON_PRETTY_PRINT);
	
} catch(Exception $ex) {
	http_response_code(500);
	echo json_encode(array('code' => 500, 'error' => $ex->getMessage()), JSON_PRETTY_PRINT);
}