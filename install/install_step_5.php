<?php

/**
 * WebEngine CMS
 * https://webenginecms.org/
 *
 * @version 1.2.6
 * @author Lautaro Angelico <http://lautaroangelico.com/>
 * @copyright (c) 2013-2025 Lautaro Angelico, All Rights Reserved
 *
 * Licensed under the MIT license
 * http://opensource.org/licenses/MIT
 */

if (!defined('access') or !access or access != 'install') die();
?>
<h3>Website Configuration</h3>
<br />
<?php
if (isset($_POST['install_step_5_submit'])) {
	try {
		# check for empty values
		if (!isset($_POST['install_step_5_1'])) throw new Exception('You must complete all required fields.');
		if (!isset($_POST['install_step_5_7'])) throw new Exception('You must complete all required fields.');

		# check admin user
		if (!Validator::AlphaNumeric($_POST['install_step_5_1'])) throw new Exception('The admin account username can only contain alpha-numeric characters.');

		# check database connection data
		if (!isset($_SESSION['install_sql_host'])) throw new Exception('Database connection info missing, restart installation process.');
		if (!isset($_SESSION['install_sql_cabalengine'])) throw new Exception('Database connection info missing, restart installation process.');
		if (!isset($_SESSION['install_sql_user'])) throw new Exception('Database connection info missing, restart installation process.');
		if (!isset($_SESSION['install_sql_pass'])) throw new Exception('Database connection info missing, restart installation process.');
		if (!isset($_SESSION['install_sql_dsn'])) throw new Exception('Database connection info missing, restart installation process.');

		# check for valid server files
		if (!array_key_exists($_POST['install_step_5_7'], $webengine['file_compatibility'])) throw new Exception('The selected server files are not compatible with WebEngine CMS.');

		// Set Configs
		$webengineDefaultConfig['admins'] = array($_POST['install_step_5_1'] => 100);
		$webengineDefaultConfig['server_files'] = strtolower($_POST['install_step_5_7']);
		$webengineDefaultConfig['SQL_DB_HOST'] = $_SESSION['install_sql_host'];
		$webengineDefaultConfig['SQL_DB_WEB_NAME'] = $_SESSION['install_sql_cabalengine'];
		$webengineDefaultConfig['SQL_DB_ACCOUNT_NAME'] = $_SESSION['install_sql_account'];
		$webengineDefaultConfig['SQL_DB_CABALCASH_NAME'] = $_SESSION['install_sql_cabalcash'];
		$webengineDefaultConfig['SQL_DB_CABALGUILD_NAME'] = $_SESSION['install_sql_cabalguild'];
		$webengineDefaultConfig['SQL_DB_CABALCOUPON_NAME'] = $_SESSION['install_sql_cabalcoupon'];
		$webengineDefaultConfig['SQL_DB_CABALEVENT_NAME'] = $_SESSION['install_sql_cabalevent'];
		$webengineDefaultConfig['SQL_DB_CABALEVENTDATA_NAME'] = $_SESSION['install_sql_cabaleventdata'];
		$webengineDefaultConfig['SQL_DB_CABALGAMESVC_NAME'] = $_SESSION['install_sql_cabalgamesvc'];
		$webengineDefaultConfig['SQL_DB_CABALITEMSHOP_NAME'] = $_SESSION['install_sql_cabalitemshop'];
		$webengineDefaultConfig['SQL_DB_CABALNETCAFEBILLING_NAME'] = $_SESSION['install_sql_cabalnetcafebilling'];
		$webengineDefaultConfig['SQL_DB_CABALSERVER01_NAME'] = $_SESSION['install_sql_cabalserver01'];
		$webengineDefaultConfig['SQL_DB_CABALTPOINTSHOP_NAME'] = $_SESSION['install_sql_cabaltpointshop'];
		$webengineDefaultConfig['SQL_DB_USER'] = $_SESSION['install_sql_user'];
		$webengineDefaultConfig['SQL_DB_PASS'] = $_SESSION['install_sql_pass'];
		$webengineDefaultConfig['SQL_DB_PORT'] = $_SESSION['install_sql_port'];
		$webengineDefaultConfig['SQL_PDO_DRIVER'] = $_SESSION['install_sql_dsn'];
		$webengineDefaultConfig['webengine_cms_installed'] = true;

		# encode settings
		$newWebengineConfigs = json_encode($webengineDefaultConfig, JSON_PRETTY_PRINT);
		if ($newWebengineConfigs == false) throw new Exception('Could not encode WebEngine CMS configurations.');

		# save configurations
		$cfgFile = fopen($webengineConfigsPath, 'w');
		if (!$cfgFile) throw new Exception('Could not open WebEngine CMS Configurations file.');
		$cfgUpdate = fwrite($cfgFile, $newWebengineConfigs);
		if (!$cfgUpdate) throw new Exception('Could not save WebEngine CMS Configurations file.');
		fclose($cfgFile);

		# clear session data
		$_SESSION = array();
		session_destroy();

		# redirect to website home
		header('Location: ' . __BASE_URL__);
		die();
	} catch (Exception $ex) {
		echo '<div class="alert alert-danger" role="alert">' . $ex->getMessage() . '</div>';
	}
}

?>
<form class="form-horizontal" method="post">
	<div class="form-group">
		<label for="input_1" class="col-sm-3 control-label">Admin account</label>
		<div class="col-sm-9">
			<input type="text" name="install_step_5_1" class="form-control" id="input_1" required>
			<p class="help-block">Type the username of the account that will have full admincp access.</p>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Server Files</label>
		<div class="col-sm-9">
			<?php foreach ($webengine['file_compatibility'] as $serverFileValue => $serverFileInfo) { ?>
				<div class="radio">
					<label>
						<input type="radio" name="install_step_5_7" name="optionsRadios" value="<?php echo $serverFileValue; ?>">
						<?php echo $serverFileInfo['name']; ?>
					</label>
				</div>
			<?php } ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<button type="submit" name="install_step_5_submit" value="continue" class="btn btn-success">Complete Installation</button>
		</div>
	</div>
</form>