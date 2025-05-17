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

try {
	if(!config('language_switch_active',true)) throw new Exception(lang('error_62'));
	if(!isset($_GET['to'])) throw new Exception(lang('error_63'));
	if(strlen($_GET['to']) != 2) throw new Exception(lang('error_63'));
	if(!Validator::Alpha($_GET['to'])) throw new Exception(lang('error_63'));
	if(!$handler->switchLanguage($_GET['to'])) throw new Exception(lang('error_65'));
	redirect();
} catch (Exception $ex) {
	if(!config('error_reporting',true)) redirect();
	message('error', $ex->getMessage());
}