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

$cabalengineModules = array(
	'_global' => array(
		array('News','news'),
		array('Login','login'),
		array('Register','register'),
		array('Downloads','downloads'),

		array('Donation','donation'),
		array('PayPal','paypal'),

		array('Rankings','rankings'),
		// array('Castle Siege','castlesiege'),
		array('Email System','email'),
		array('Profiles','profiles'),
		array('Contact Us','contact'),
		array('Forgot Password','forgotpassword'),
	),
	'_usercp' => array(
		array('Add Stats','addstats'),
		array('Clear PK','clearpk'),
		// array('Clear Skill-Tree','clearskilltree'),
		array('My Account','myaccount'),
		array('Change Password','mypassword'),
		array('Change Email','myemail'),
		// array('Character Reset','reset'),
		array('Reset Stats','resetstats'),
		array('Unstick Character','unstick'),
		array('Vote and Reward','vote'),
		array('Buy alz','buyalz'),
	),
);

echo '<h1 class="page-header">Module Manager</h1>';

echo '<div class="row">';

	echo '<div class="col-md-6">';
		echo '<h4>Global:</h4>';
		echo '<div class="modulesManager">';
			echo '<ul>';
			foreach($cabalengineModules['_global'] as $moduleList) {
				echo '<li><a href="'.admincp_base("modules_manager&config=".$moduleList[1]).'">'.$moduleList[0].'</a></li>';
			}
			echo '</ul>';
		echo '</div>';
	echo '</div>';

	echo '<div class="col-md-6">';
		echo '<h4>User CP:</h4>';
		echo '<div class="modulesManager">';
			echo '<ul>';
			foreach($cabalengineModules['_usercp'] as $moduleList) {
				echo '<li><a href="'.admincp_base("modules_manager&config=".$moduleList[1]).'">'.$moduleList[0].'</a></li>';
			}
			echo '</ul>';
		echo '</div>';
	echo '</div>';

echo '</div>';

echo '<hr>';

if(isset($_GET['config'])) {
	$filePath = __PATH_ADMINCP_MODULES__.'mconfig/'.$_GET['config'].'.php';
	if(file_exists($filePath)) {
		include($filePath);
	} else {
		message('error','Invalid module.');
	}
}