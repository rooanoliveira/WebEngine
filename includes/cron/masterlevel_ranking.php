<?php
/**
 * CabalEngine CMS
 * 
 * @version 1.0.9.8
 * @Mod author Rooan Oliveira / Original author Lautaro Angelico <http://lautaroangelico.com/>
 * @copyright (c) 2013-2017 Lautaro Angelico, All Rights Reserved
 * 
 * Licensed under the MIT license
 * http://opensource.org/licenses/MIT
 */

// File Name
$file_name = basename(__FILE__);

// Load Rankings Class
$Rankings = new Rankings();

// Load Ranking Configs
loadModuleConfigs('rankings');

if(mconfig('active')) {
	if(mconfig('rankings_enable_master')) {
		$Rankings->UpdateRankingCache('master');
	}
}

// UPDATE CRON
updateCronLastRun($file_name);