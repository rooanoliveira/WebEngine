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

if(!defined('access') or !access or access != 'install') die();

/**
 * INSTALLER_VERSION
 */
define('INSTALLER_VERSION', '1.0.0');

/**
 * CABALENGINE_CONFIGURATION_FILE
 */
define('CABALENGINE_CONFIGURATION_FILE', 'cabalengine.json');

/**
 * CABALENGINE_WRITABLE_PATHS_FILE
 */
define('CABALENGINE_WRITABLE_PATHS_FILE', 'writable.paths.json');

/**
 * CABALENGINE_DEFAULT_CONFIGURATION_FILE
 */
define('CABALENGINE_DEFAULT_CONFIGURATION_FILE', 'cabalengine.json.default');

$install['PDO_DSN'] = array(
	1 => 'dblib',
	2 => 'sqlsrv',
	3 => 'odbc',
);

$install['sql_list'] = array(
	'CABALENGINE_BANS' => CABALENGINE_BANS,
	'CABALENGINE_BAN_LOG' => CABALENGINE_BAN_LOG,
	'CABALENGINE_BLOCKED_IP' => CABALENGINE_BLOCKED_IP,
	'CABALENGINE_CREDITS_CONFIG' => CABALENGINE_CREDITS_CONFIG,
	'CABALENGINE_CREDITS_LOGS' => CABALENGINE_CREDITS_LOGS,
	'CABALENGINE_CRON' => CABALENGINE_CRON,
	'CABALENGINE_DOWNLOADS' => CABALENGINE_DOWNLOADS,
	'CABALENGINE_FLA' => CABALENGINE_FLA,
	'CABALENGINE_NEWS' => CABALENGINE_NEWS,
	'CABALENGINE_PASSCHANGE_REQUEST' => CABALENGINE_PASSCHANGE_REQUEST,
	'CABALENGINE_PAYPAL_TRANSACTIONS' => CABALENGINE_PAYPAL_TRANSACTIONS,
	'CABALENGINE_PLUGINS' => CABALENGINE_PLUGINS,
	'CABALENGINE_REGISTER_ACCOUNT' => CABALENGINE_REGISTER_ACCOUNT,
	'CABALENGINE_VOTES' => CABALENGINE_VOTES,
	'CABALENGINE_VOTE_LOGS' => CABALENGINE_VOTE_LOGS,
	'CABALENGINE_VOTE_SITES' => CABALENGINE_VOTE_SITES,
	'CABALENGINE_ACCOUNT_COUNTRY' => CABALENGINE_ACCOUNT_COUNTRY,
	'CABALENGINE_NEWS_TRANSLATIONS' => CABALENGINE_NEWS_TRANSLATIONS,
);

$install['step_list'] = array(
	array('install_intro.php', 'Intro'),
	array('install_step_1.php', 'Web Server Requirements'),
	array('install_step_2.php', 'Database Connection'),
	array('install_step_3.php', 'Create Tables'),
	array('install_step_4.php', 'Add Cron Jobs'),
	array('install_step_5.php', 'Website Configuration'),
);

$install['cron_jobs'] = array(
	// cron_name,cron_description,cron_file_run,cron_run_time,cron_status,cron_protected,cron_file_md5
	array('Levels Ranking','Scheduled task to update characters level ranking','levels_ranking.php','300','1','0'),
	// array('Resets Ranking','Scheduled task to update characters reset ranking','resets_ranking.php','300','0','0'),
	array('Killers Ranking','Scheduled task to update top killers ranking','killers_ranking.php','300','0','0'),
	// array('Master Level Ranking','Scheduled task to update characters master level ranking','masterlevel_ranking.php','300','0','0'),
	array('Guilds Ranking','Scheduled task to update top guilds ranking','guilds_ranking.php','300','1','0'),
	// array('Grand Resets Ranking','Scheduled task to update characters grand reset ranking','grandresets_ranking.php','300','0','0'),
	array('Online Ranking','Scheduled task to update top online ranking','online_ranking.php','300','1','0'),
	array('Nation Ranking','Scheduled task to update gens ranking','gens_ranking.php','300','0','0'),
	array('Votes Ranking','Scheduled task to update vote rankings','votes_ranking.php','300','1','0'),
	// array('Castle Siege','Saves castle siege information in cache','castle_siege.php','300','0','0'),
	array('Ban System','Scheduled task to lift temporal bans','temporal_bans.php','300','1','0'),
	array('Server Info','Scheduled task to update the sidebar statistics information','server_info.php','300','1','0'),
	array('Account Country','Scheduled task to detect the accounts country by their ip address','account_country.php','60','1','0'),
	array('Character Country','Scheduled task to cache characters country','character_country.php','300','1','0'),
	array('Online Characters','Scheduled task to cache online characters','online_characters.php','300','1','0'),
);

$install['PDO_PWD_ENCRYPT'] = array(
	'none',
	'wzmd5',
	'phpmd5',
	'sha256',
);