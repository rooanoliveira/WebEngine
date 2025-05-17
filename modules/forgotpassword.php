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

echo '<div class="page-title"><span>'.lang('module_titles_txt_15',true).'</span></div>';

try {
	
	if(!mconfig('active')) throw new Exception(lang('error_47',true));
	
	if(isset($_GET['ui']) && isset($_GET['ue']) && isset($_GET['key'])) {
		
		# recovery process
		try {
			$Account = new Account();
			$Account->passwordRecoveryVerificationProcess($_GET['ui'], $_GET['ue'], $_GET['key']);
		} catch (Exception $ex) {
			message('error', $ex->getMessage());
		}
		
	} else {
		
		# form submit
		if(isset($_POST['cabalengineEmail_submit'])) {
			try {
				$Account = new Account();
				$Account->passwordRecoveryProcess($_POST['cabalengineEmail_current'], $_SERVER['REMOTE_ADDR']);
			} catch (Exception $ex) {
				message('error', $ex->getMessage());
			}
		}
		
		echo '<div class="col-xs-8 col-xs-offset-2" style="margin-top:30px;">';
			echo '<form class="form-horizontal" action="" method="post">';
				echo '<div class="form-group">';
					echo '<label for="cabalengineEmail" class="col-sm-4 control-label">'.lang('forgotpass_txt_1',true).'</label>';
					echo '<div class="col-sm-8">';
						echo '<input type="text" class="form-control" id="cabalengineEmail" name="cabalengineEmail_current" required>';
					echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
					echo '<div class="col-sm-offset-4 col-sm-8">';
						echo '<button type="submit" name="cabalengineEmail_submit" value="submit" class="btn btn-primary">'.lang('forgotpass_txt_2',true).'</button>';
					echo '</div>';
				echo '</div>';
			echo '</form>';
		echo '</div>';
	}
	
} catch(Exception $ex) {
	message('error', $ex->getMessage());
}