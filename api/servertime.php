<?php
/**
 * CabalEngine CMS
 * 
 * @version 1.0.9.9
 * @author Lautaro Angelico <https://lautaroangelico.com/>
 * @copyright (c) 2013-2018 Lautaro Angelico, All Rights Reserved
 * 
 * Licensed under the MIT license
 * https://opensource.org/licenses/MIT
 */

define('access', 'api');

include('../includes/cabalengine.php');

echo json_encode(
	array(
		'ServerTime' => date("Y/m/d H:i:s")
	)
);
