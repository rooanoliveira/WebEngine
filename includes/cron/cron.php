<?php
/**
 * CabalEngine CMS
 * 
 * @version 1.2.0
 * @Mod author Rooan Oliveira / Original author Lautaro Angelico <http://lautaroangelico.com/>
 * @copyright (c) 2013-2019 Lautaro Angelico, All Rights Reserved
 * 
 * Licensed under the MIT license
 * http://opensource.org/licenses/MIT
 */

// access
define('access', 'cron');

// Load CabalEngine
if(!@include_once(str_replace('\\','/',dirname(dirname(__FILE__))).'/' . 'cabalengine.php')) die('Failed to load CabalEngine CMS.');

// Cron List
$cronList = getCronList();
if(!is_array($cronList)) die();

// Encapsulation
function loadCronFile($path) {
	include($path);
}

// Execute Crons
foreach($cronList as $cron) {
	if($cron['cron_status'] != 1) continue;
	if(!check_value($cron['cron_last_run'])) {
		$lastRun = $cron['cron_run_time'];
	} else {
		$lastRun = $cron['cron_last_run']+$cron['cron_run_time'];
	}
	if(time() > $lastRun) {
		$filePath = __PATH_CRON__.$cron['cron_file_run'];
		if(file_exists($filePath)) {
			loadCronFile($filePath);
		}
	}
}