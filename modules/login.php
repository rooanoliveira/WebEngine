<?php
/**
 * CabalEngine CMS
 * 
 * @version 1.2.5
 * @Mod author Rooan Oliveira / Original author Lautaro Angelico <http://lautaroangelico.com/>
 * @copyright (c) 2013-2023 Lautaro Angelico, All Rights Reserved
 * 
 * Licensed under the MIT license
 * http://opensource.org/licenses/MIT
 */

if(isLoggedIn()) redirect();

echo '<div class="page-title"><span>'.lang('module_titles_txt_2',true).'</span></div>';

try {
	
	if(!mconfig('active')) throw new Exception(lang('error_47',true));
	
	// Login Process
	if(isset($_POST['cabalengineLogin_submit'])) {
		try {
			$userLogin = new login();
			$userLogin->validateLogin($_POST['cabalengineLogin_user'],$_POST['cabalengineLogin_pwd']);
		} catch (Exception $ex) {
			message('error', $ex->getMessage());
		}
	}
	
	echo '<div class="col-xs-8 col-xs-offset-2" style="margin-top:30px;">';
		echo '<form class="form-horizontal" action="" method="post">';
			echo '<div class="form-group">';
				echo '<label for="cabalengineLogin1" class="col-sm-4 control-label">'.lang('login_txt_1',true).'</label>';
				echo '<div class="col-sm-8">';
					echo '<input type="text" class="form-control" id="cabalengineLogin1" name="cabalengineLogin_user" required>';
				echo '</div>';
			echo '</div>';
			echo '<div class="form-group">';
				echo '<label for="cabalengineLogin2" class="col-sm-4 control-label">'.lang('login_txt_2',true).'</label>';
				echo '<div class="col-sm-8">';
					echo '<input type="password" class="form-control" id="cabalengineLogin2" name="cabalengineLogin_pwd" required>';
					echo '<span id="helpBlock" class="help-block"><a href="'.__BASE_URL__.'forgotpassword/">'.lang('login_txt_4',true).'</a></span>';
				echo '</div>';
			echo '</div>';
			echo '<div class="form-group">';
				echo '<div class="col-sm-offset-4 col-sm-8">';
					echo '<button type="submit" name="cabalengineLogin_submit" value="submit" class="btn btn-primary">'.lang('login_txt_3',true).'</button>';
				echo '</div>';
			echo '</div>';
		echo '</form>';
	echo '</div>';

} catch(Exception $ex) {
	message('error', $ex->getMessage());
}