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

if(!isLoggedIn()) redirect(1,'login');

echo '<div class="page-title"><span>'.lang('module_titles_txt_28',true).'</span></div>';

try {
	
	if(!mconfig('active')) throw new Exception(lang('error_47',true));
	
	// load database
	$db = Connection::Database('MuOnline');
	
	// common class
	$common = new common();
	
	$Character = new Character();
	$AccountCharacters = $Character->AccountCharacter($_SESSION['username']);
	if(!is_array($AccountCharacters)) throw new Exception(lang('error_46',true));
	
	# config file data
	$maxAlz = mconfig('max_alz');
	$exchangeRatio = mconfig('exchange_ratio');
	$incrementRate = mconfig('increment_rate');
	
	# alz buying configuration
	$buyOptions = array();
	for($multiplier = 1; $multiplier<=floor($maxAlz/$incrementRate); $multiplier++) {
		$alzAmount = $multiplier*$incrementRate;
		$creditAmount = ceil($alzAmount/$exchangeRatio);
		$buyOptions[] = $creditAmount;
	}
	
	# process request
	if(isset($_POST['submit']) && isset($_POST['character']) && isset($_POST['credits'])) {
		try {
			# check if account is online
			if($common->accountOnline($_SESSION['username']))  throw new Exception(lang('error_28',true));
			
			# check if credit value is allowed
			if(!in_array($_POST['credits'], $buyOptions)) throw new Exception(lang('error_24',true));
			
			$char = $_POST['character'];
			$alz = $_POST['credits']*$exchangeRatio;
			
			# validate form data
			if(!Validator::UnsignedNumber($_POST['credits'])) throw new Exception(lang('error_25',true));
			if($alz > $maxAlz) throw new Exception(lang('error_25',true));
			if(!in_array($char, $AccountCharacters)) throw new Exception(lang('error_24',true));
			
			# gather character information
			$characterData = $Character->CharacterData($char);
			if(!is_array($characterData)) throw new Exception(lang('error_25',true));
			
			# check alz
			$charAlz = $characterData[_CLMN_CHR_ALZ_];
			if($charAlz+$alz > $maxAlz) throw new Exception(lang('error_55',true));
			
			# subtract credits
			$creditSystem = new CreditSystem();
			$creditSystem->setConfigId(mconfig('credit_config'));
			$configSettings = $creditSystem->showConfigs(true);
			switch($configSettings['config_user_col_id']) {
				case 'userid':
					$creditSystem->setIdentifier($_SESSION['userid']);
					break;
				case 'username':
					$creditSystem->setIdentifier($_SESSION['username']);
					break;
				case 'character':
					$creditSystem->setIdentifier($char);
					break;
				default:
					throw new Exception("Invalid identifier (credit system).");
			}
			$creditSystem->subtractCredits($_POST['credits']);

			# send alz
			if(!$db->query("UPDATE "._TBL_CHR_." SET "._CLMN_CHR_ALZ_." = "._CLMN_CHR_ALZ_." + ? WHERE "._CLMN_CHR_NAME_." = ?", array($alz, $characterData[_CLMN_CHR_NAME_])));

			message('success', lang('success_21',true));
			message('info', number_format($alz) . lang('buyalz_txt_2',true) . $char);
		} catch(Exception $ex) {
			message('error', $ex->getMessage());
		}
	}
	
	echo '<form class="form-horizontal" action="" method="post">';
		echo '<div class="panel panel-general">';
			echo '<div class="panel-body">';
				echo '<div class="row">';
					echo '<div class="col-xs-4 text-center">'.lang('buyalz_txt_3',true).'</div>';
					echo '<div class="col-xs-4 text-center">'.lang('buyalz_txt_4',true).'</div>';
				echo '</div>';
				echo '<div class="row">';
					echo '<div class="col-xs-4 text-center">';
						echo '<select name="character" class="form-control">';
							foreach($AccountCharacters as $char) {
								echo '<option value="'.$char.'">'.$char.'</option>';
							}
						echo '<select>';
					echo '</div>';
					echo '<div class="col-xs-4 text-center">';
						echo '<select name="credits" class="form-control">';
							foreach($buyOptions as $creditValue) {
								$alzValue = $creditValue*$exchangeRatio;
								if($alzValue > $maxAlz) continue;
								
								echo '<option value="'.$creditValue.'">'.number_format($alzValue).' - '.$creditValue.' '.lang('buyalz_txt_6',true).'</option>';
							}
							
						echo '</select>';
					echo '</div>';
					echo '<div class="col-xs-4 text-center">';
						echo '<button name="submit" value="submit" class="btn btn-primary">'.lang('buyalz_txt_5',true).'</button>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</form>';
	
} catch(Exception $ex) {
	message('error', $ex->getMessage());
}