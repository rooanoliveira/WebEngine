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

try {
	
	if(!@include_once(rtrim(str_replace('\\','/', dirname(__DIR__)), '/') . '/includes/cabalengine.php')) throw new Exception('Could not load CabalEngine.');
	
	$castleSiege = new CastleSiege();
	$siegeData = $castleSiege->siegeData();
	if(!is_array($siegeData)) throw new Exception(lang('error_103', true));
	
	http_response_code(200);
	echo json_encode(
		array(
			'TimeLeft' => $siegeData['warfare_stage_timeleft']
		)
	);

} catch(Exception $ex) {
	http_response_code(500);
	echo json_encode(array('code' => 500, 'error' => $ex->getMessage()));
}