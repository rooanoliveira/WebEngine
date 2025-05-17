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

session_name('CabalEngineInstaller126'); 
session_start();
ob_start();

@ini_set('default_charset', 'utf-8');

define('HTTP_HOST', $_SERVER['HTTP_HOST']);
define('SERVER_PROTOCOL', (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on' ) ? 'https://' : 'http://');
define('__ROOT_DIR__', str_replace('\\','/',dirname(dirname(__FILE__))).'/');
define('__RELATIVE_ROOT__', str_ireplace(rtrim(str_replace('\\','/', realpath(str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['SCRIPT_FILENAME']))), '/'), '', __ROOT_DIR__));// /
define('__BASE_URL__', SERVER_PROTOCOL.HTTP_HOST.__RELATIVE_ROOT__);
define('__PATH_INCLUDES__', __ROOT_DIR__.'includes/');
define('__PATH_CLASSES__', __PATH_INCLUDES__.'classes/');
define('__PATH_CRON__', __PATH_INCLUDES__.'cron/');
define('__PATH_CONFIGS__', __PATH_INCLUDES__.'config/');
define('__INSTALL_ROOT__', __ROOT_DIR__ . 'install/');
define('__INSTALL_URL__', __BASE_URL__ . 'install/');

try {
	
	if(!@include_once(__PATH_CONFIGS__ . 'cabalengine.tables.php')) throw new Exception('Could not load CabalEngine CMS tables.');
	if(!@include_once(__INSTALL_ROOT__ . 'definitions.php')) throw new Exception('Could not load CabalEngine CMS Installer definitions.');
	
	$cabalengineConfigsPath = __PATH_CONFIGS__.CABALENGINE_CONFIGURATION_FILE;
	if(!file_exists($cabalengineConfigsPath)) throw new Exception('CabalEngine CMS configuration file missing.');
	if(!is_readable($cabalengineConfigsPath)) throw new Exception('CabalEngine CMS configuration file is not readable.');
	if(!is_writable($cabalengineConfigsPath)) throw new Exception('CabalEngine CMS configuration file is not writable.');
	
	$cabalengineConfigsFile = file_get_contents($cabalengineConfigsPath);
	if($cabalengineConfigsFile) {
		$cabalengineConfig = json_decode($cabalengineConfigsFile, true);
		if(!is_array($cabalengineConfig)) throw new Exception('CabalEngine CMS configuration file could not be decoded.');
		if($cabalengineConfig['cabalengine_cms_installed'] === true) throw new Exception('CabalEngine CMS installation is complete, it is recommended to rename or delete this directory.');
	}
	
	$cabalengineDefaultConfigsPath = __PATH_CONFIGS__.CABALENGINE_DEFAULT_CONFIGURATION_FILE;
	if(!file_exists($cabalengineDefaultConfigsPath)) throw new Exception('CabalEngine CMS default configuration file missing.');
	if(!is_readable($cabalengineDefaultConfigsPath)) throw new Exception('CabalEngine CMS default configuration file is not readable.');
	$cabalengineDefaultConfigsFile = file_get_contents($cabalengineDefaultConfigsPath);
	if(!$cabalengineDefaultConfigsFile) throw new Exception('CabalEngine CMS default configuration file could not be loaded.');
	$cabalengineDefaultConfig = json_decode($cabalengineDefaultConfigsFile, true);
	if(!is_array($cabalengineDefaultConfig)) throw new Exception('CabalEngine CMS default configuration file could not be decoded.');
	
	if(!@include_once(__PATH_INCLUDES__ . 'functions.php')) throw new Exception('Could not load CabalEngine CMS functions.');
	if(!@include_once(__PATH_CLASSES__ . 'class.validator.php')) throw new Exception('Could not load CabalEngine CMS validator library.');
	if(!@include_once(__PATH_CLASSES__ . 'class.database.php')) throw new Exception('Could not load CabalEngine CMS database library.');
	if(!@include_once(__PATH_CONFIGS__ . 'compatibility.php')) throw new Exception('Could not load CabalEngine CMS files compatibility.');
	if(!@include_once(__PATH_CONFIGS__ . 'timezone.php')) throw new Exception('Could not load CabalEngine CMS timezone.');
	
	$writablePaths = loadJsonFile(__PATH_CONFIGS__.CABALENGINE_WRITABLE_PATHS_FILE);
	if(!is_array($writablePaths)) throw new Exception('Could not load CabalEngine CMS writable paths list.');
	
	if(!isset($_SESSION['install_cstep'])) {
		$_SESSION['install_cstep'] = 0;
	}

	function stepListSidebar() {
		global $install;
		if(is_array($install['step_list'])) {
			echo '<ul class="list-group">';
			foreach($install['step_list'] as $key => $row) {
				if($key == $_SESSION['install_cstep']) {
					echo '<li class="list-group-item active">'.$row[1].'</li>';
					continue;
				}
				echo '<li class="list-group-item">'.$row[1].'</li>';
			}
			echo '</ul>';
		}
		if($_SESSION['install_cstep'] > 0) {
			echo '<a href="?action=restart" class="btn btn-danger">Start Over</a>';
		}
	}

	if(isset($_GET['action'])) {
		if($_GET['action'] == 'restart') {
			# restart install process
			$_SESSION = array();
			session_destroy();
			header('Location: install.php');
			die();
		}
	}
	
} catch (Exception $ex) {
	die($ex->getMessage());
}