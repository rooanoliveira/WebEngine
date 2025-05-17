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

echo '<h2>Clear Skill-Tree Settings</h2>';

function saveChanges() {
	global $_POST;
	foreach($_POST as $setting) {
		if(!check_value($setting)) {
			message('error','Missing data (complete all fields).');
			return;
		}
	}
	$xmlPath = __PATH_MODULE_CONFIGS__.'usercp.clearskilltree.xml';
	$xml = simplexml_load_file($xmlPath);
	
	if(!isset($_POST['setting_1'])) throw new Exception('Invalid setting (active)');
	if(!in_array($_POST['setting_1'], array(0, 1))) throw new Exception('Invalid setting (active)');
	$xml->active = $_POST['setting_1'];
	
	if(!isset($_POST['setting_2'])) throw new Exception('Invalid setting (alz_cost)');
	if(!Validator::UnsignedNumber($_POST['setting_2'])) throw new Exception('Invalid setting (alz_cost)');
	$xml->alz_cost = $_POST['setting_2'];
	
	if(!isset($_POST['setting_3'])) throw new Exception('Invalid setting (credit_config)');
	if(!Validator::UnsignedNumber($_POST['setting_3'])) throw new Exception('Invalid setting (credit_config)');
	$xml->credit_config = $_POST['setting_3'];
	
	if(!isset($_POST['setting_4'])) throw new Exception('Invalid setting (credit_cost)');
	if(!Validator::UnsignedNumber($_POST['setting_4'])) throw new Exception('Invalid setting (credit_cost)');
	$xml->credit_cost = $_POST['setting_4'];
	
	if(!isset($_POST['setting_5'])) throw new Exception('Invalid setting (required_level)');
	if(!Validator::UnsignedNumber($_POST['setting_5'])) throw new Exception('Invalid setting (required_level)');
	if($_POST['setting_5'] > 400) throw new Exception('The required level setting can have a maximum value of 400.');
	$xml->required_level = $_POST['setting_5'];
	
	if(!isset($_POST['setting_6'])) throw new Exception('Invalid setting (required_master_level)');
	if(!Validator::UnsignedNumber($_POST['setting_6'])) throw new Exception('Invalid setting (required_master_level)');
	$xml->required_master_level = $_POST['setting_6'];
	
	$save = $xml->asXML($xmlPath);
	if($save) {
		message('success','Settings successfully saved.');
	} else {
		message('error','There has been an error while saving changes.');
	}
}

if(isset($_POST['submit_changes'])) {
	saveChanges();
}

loadModuleConfigs('usercp.clearskilltree');

$creditSystem = new CreditSystem();
?>
<form action="" method="post">
	<table class="table table-striped table-bordered table-hover module_config_tables">
		<tr>
			<th>Status<br/><span>Enable/disable the clear skill tree module.</span></th>
			<td>
				<?php enabledisableCheckboxes('setting_1',mconfig('active'),'Enabled','Disabled'); ?>
			</td>
		</tr>
		<tr>
			<th>Alz Cost<br/><span>Amount of alz required to clear the master skill tree. Set to 0 to disable alz requirement.</span></th>
			<td>
				<input class="form-control" type="text" name="setting_2" value="<?php echo mconfig('alz_cost'); ?>"/>
			</td>
		</tr>
		<tr>
			<th>Credit Cost<br/><span>Amount of credits required to clear the master skill tree. Set to 0 to disable credit requirement.</span></th>
			<td>
				<input class="form-control" type="text" name="setting_4" value="<?php echo mconfig('credit_cost'); ?>"/>
			</td>
		</tr>
		<tr>
			<th>Credit Configuration<br/><span></span></th>
			<td>
				<?php echo $creditSystem->buildSelectInput("setting_3", mconfig('credit_config'), "form-control"); ?>
			</td>
		</tr>
		<tr>
			<th>Required Level<br/><span>Minimum level required to clear the master skill tree. It is recommended to keep this setting at the maximum level of 400.</span></th>
			<td>
				<input class="form-control" type="text" name="setting_5" value="<?php echo mconfig('required_level'); ?>"/>
			</td>
		</tr>
		<tr>
			<th>Required Master Level<br/><span>Minimum master level required to clear the master skill tree.</span></th>
			<td>
				<input class="form-control" type="text" name="setting_6" value="<?php echo mconfig('required_master_level'); ?>"/>
			</td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="submit_changes" value="Save Changes" class="btn btn-success"/></td>
		</tr>
	</table>
</form>