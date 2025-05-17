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

echo '<h1 class="page-header">Connection Settings</h1>';

$allowedSettings = array(
	'settings_submit', # the submit button
	'SQL_DB_HOST',
	'SQL_DB_WEB_NAME',
	'SQL_DB_ACCOUNT_NAME',
	'SQL_DB_CABALCASH_NAME',
	'SQL_DB_CABALGUILD_NAME',
	'SQL_DB_CABALCOUPON_NAME',
	'SQL_DB_CABALEVENT_NAME',
	'SQL_DB_CABALEVENTDATA_NAME',
	'SQL_DB_CABALGAMESVC_NAME',
	'SQL_DB_CABALITEMSHOP_NAME',
	'SQL_DB_CABALNETCAFEBILLING_NAME',
	'SQL_DB_CABALSERVER01_NAME',
	'SQL_DB_CABALTPOINTSHOP_NAME',
	'SQL_DB_USER',
	'SQL_DB_PASS',
	'SQL_DB_PORT',
	'SQL_PDO_DRIVER',
);

if(isset($_POST['settings_submit'])) {
	try {

		# host
		if(!isset($_POST['SQL_DB_HOST'])) throw new Exception('Invalid Host setting.');
		$setting['SQL_DB_HOST'] = $_POST['SQL_DB_HOST'];

		# database web
		if(!isset($_POST['SQL_DB_WEB_NAME'])) throw new Exception('Invalid Database Web setting.');
		$setting['SQL_DB_WEB_NAME'] = $_POST['SQL_DB_WEB_NAME'];

		# database account
		if(!isset($_POST['SQL_DB_ACCOUNT_NAME'])) throw new Exception('Invalid Database Account setting.');
		$setting['SQL_DB_ACCOUNT_NAME'] = $_POST['SQL_DB_ACCOUNT_NAME'];

		# database cabalcash
		if(!isset($_POST['SQL_DB_CABALCASH_NAME'])) throw new Exception('Invalid Database CabalCash setting.');
		$setting['SQL_DB_CABALCASH_NAME'] = $_POST['SQL_DB_CABALCASH_NAME'];

		# database cabalguild
		if(!isset($_POST['SQL_DB_CABALGUILD_NAME'])) throw new Exception('Invalid Database CabalGuild setting.');
		$setting['SQL_DB_CABALGUILD_NAME'] = $_POST['SQL_DB_CABALGUILD_NAME'];

		# database coupon
		if(!isset($_POST['SQL_DB_CABALCOUPON_NAME'])) throw new Exception('Invalid Database Coupon setting.');
		$setting['SQL_DB_CABALCOUPON_NAME'] = $_POST['SQL_DB_CABALCOUPON_NAME'];

		# database eventdata
		if(!isset($_POST['SQL_DB_CABALEVENTDATA_NAME'])) throw new Exception('Invalid Database EventData setting.');
		$setting['SQL_DB_CABALEVENTDATA_NAME'] = $_POST['SQL_DB_CABALEVENTDATA_NAME'];

		# database gamesvc
		if(!isset($_POST['SQL_DB_CABALGAMESVC_NAME'])) throw new Exception('Invalid Database GameSvc setting.');
		$setting['SQL_DB_CABALGAMESVC_NAME'] = $_POST['SQL_DB_CABALGAMESVC_NAME'];

		# database itemshop
		if(!isset($_POST['SQL_DB_CABALITEMSHOP_NAME'])) throw new Exception('Invalid Database ItemShop setting.');
		$setting['SQL_DB_CABALITEMSHOP_NAME'] = $_POST['SQL_DB_CABALITEMSHOP_NAME'];

		# database netcafebilling
		if(!isset($_POST['SQL_DB_CABALNETCAFEBILLING_NAME'])) throw new Exception('Invalid Database NetcafeBilling setting.');
		$setting['SQL_DB_CABALNETCAFEBILLING_NAME'] = $_POST['SQL_DB_CABALNETCAFEBILLING_NAME'];

		# database server01
		if(!isset($_POST['SQL_DB_CABALSERVER01_NAME'])) throw new Exception('Invalid Database Server01 setting.');
		$setting['SQL_DB_CABALSERVER01_NAME'] = $_POST['SQL_DB_CABALSERVER01_NAME'];

		# database tpointshop
		if(!isset($_POST['SQL_DB_CABALTPOINTSHOP_NAME'])) throw new Exception('Invalid Database TPointShop setting.');
		$setting['SQL_DB_CABALTPOINTSHOP_NAME'] = $_POST['SQL_DB_CABALTPOINTSHOP_NAME'];

		# user
		if(!isset($_POST['SQL_DB_USER'])) throw new Exception('Invalid User setting.');
		$setting['SQL_DB_USER'] = $_POST['SQL_DB_USER'];

		# password
		if(!isset($_POST['SQL_DB_PASS'])) throw new Exception('Invalid Password setting.');
		$setting['SQL_DB_PASS'] = $_POST['SQL_DB_PASS'];

		# port
		if(!isset($_POST['SQL_DB_PORT'])) throw new Exception('Invalid Port setting.');
		if(!Validator::UnsignedNumber($_POST['SQL_DB_PORT'])) throw new Exception('Invalid Port setting.');
		$setting['SQL_DB_PORT'] = $_POST['SQL_DB_PORT'];

		# pdo dsn
		if(!isset($_POST['SQL_PDO_DRIVER'])) throw new Exception('Invalid PDO Driver setting.');
		if(!Validator::UnsignedNumber($_POST['SQL_PDO_DRIVER'])) throw new Exception('Invalid PDO Driver setting.');
		if(!in_array($_POST['SQL_PDO_DRIVER'], array(1, 2))) throw new Exception('Invalid PDO Driver setting.');
		$setting['SQL_PDO_DRIVER'] = $_POST['SQL_PDO_DRIVER'];

		# test connection web
		$testdB = new dB($setting['SQL_DB_HOST'], $setting['SQL_DB_PORT'], $setting['SQL_DB_WEB_NAME'], $setting['SQL_DB_USER'], $setting['SQL_DB_PASS'], $setting['SQL_PDO_DRIVER']);
		if($testdB->dead) {
			throw new Exception('The connection to database web was unsuccessful, settings not saved.');
		}

		# test connection account
		$testdB = new dB($setting['SQL_DB_HOST'], $setting['SQL_DB_PORT'], $setting['SQL_DB_ACCOUNT_NAME'], $setting['SQL_DB_USER'], $setting['SQL_DB_PASS'], $setting['SQL_PDO_DRIVER']);
		if($testdB->dead) {
			throw new Exception('The connection to database account was unsuccessful, settings not saved.');
		}

		# test connection cabalcash
		$testdB = new dB($setting['SQL_DB_HOST'], $setting['SQL_DB_PORT'], $setting['SQL_DB_CABALCASH_NAME'], $setting['SQL_DB_USER'], $setting['SQL_DB_PASS'], $setting['SQL_PDO_DRIVER']);
		if($testdB->dead) {
			throw new Exception('The connection to database cabalcash was unsuccessful, settings not saved.');
		}

		# test connection cabalguild
		$testdB = new dB($setting['SQL_DB_HOST'], $setting['SQL_DB_PORT'], $setting['SQL_DB_CABALGUILD_NAME'], $setting['SQL_DB_USER'], $setting['SQL_DB_PASS'], $setting['SQL_PDO_DRIVER']);
		if($testdB->dead) {
			throw new Exception('The connection to database web was unsuccessful, settings not saved.');
		}

		# test connection coupon
		$testdB = new dB($setting['SQL_DB_HOST'], $setting['SQL_DB_PORT'], $setting['SQL_DB_CABALCOUPON_NAME'], $setting['SQL_DB_USER'], $setting['SQL_DB_PASS'], $setting['SQL_PDO_DRIVER']);
		if($testdB->dead) {
			throw new Exception('The connection to database coupon was unsuccessful, settings not saved.');
		}

		# test connection event
		$testdB = new dB($setting['SQL_DB_HOST'], $setting['SQL_DB_PORT'], $setting['SQL_DB_CABALEVENT_NAME'], $setting['SQL_DB_USER'], $setting['SQL_DB_PASS'], $setting['SQL_PDO_DRIVER']);
		if($testdB->dead) {
			throw new Exception('The connection to database event was unsuccessful, settings not saved.');
		}

		# test connection eventdata
		$testdB = new dB($setting['SQL_DB_HOST'], $setting['SQL_DB_PORT'], $setting['SQL_DB_CABALEVENTDATA_NAME'], $setting['SQL_DB_USER'], $setting['SQL_DB_PASS'], $setting['SQL_PDO_DRIVER']);
		if($testdB->dead) {
			throw new Exception('The connection to database eventdata was unsuccessful, settings not saved.');
		}

		# test connection gamesvc
		$testdB = new dB($setting['SQL_DB_HOST'], $setting['SQL_DB_PORT'], $setting['SQL_DB_CABALGAMESVC_NAME'], $setting['SQL_DB_USER'], $setting['SQL_DB_PASS'], $setting['SQL_PDO_DRIVER']);
		if($testdB->dead) {
			throw new Exception('The connection to database gamesvc was unsuccessful, settings not saved.');
		}

		# test connection itemshop
		$testdB = new dB($setting['SQL_DB_HOST'], $setting['SQL_DB_PORT'], $setting['SQL_DB_CABALITEMSHOP_NAME'], $setting['SQL_DB_USER'], $setting['SQL_DB_PASS'], $setting['SQL_PDO_DRIVER']);
		if($testdB->dead) {
			throw new Exception('The connection to database itemshop was unsuccessful, settings not saved.');
		}

		# test connection netcafebilling
		$testdB = new dB($setting['SQL_DB_HOST'], $setting['SQL_DB_PORT'], $setting['SQL_DB_CABALNETCAFEBILLING_NAME'], $setting['SQL_DB_USER'], $setting['SQL_DB_PASS'], $setting['SQL_PDO_DRIVER']);
		if($testdB->dead) {
			throw new Exception('The connection to database netcafebilling was unsuccessful, settings not saved.');
		}

		# test connection server01
		$testdB = new dB($setting['SQL_DB_HOST'], $setting['SQL_DB_PORT'], $setting['SQL_DB_CABALSERVER01_NAME'], $setting['SQL_DB_USER'], $setting['SQL_DB_PASS'], $setting['SQL_PDO_DRIVER']);
		if($testdB->dead) {
			throw new Exception('The connection to database server01 was unsuccessful, settings not saved.');
		}

		# test connection tpointshop
		$testdB = new dB($setting['SQL_DB_HOST'], $setting['SQL_DB_PORT'], $setting['SQL_DB_CABALTPOINTSHOP_NAME'], $setting['SQL_DB_USER'], $setting['SQL_DB_PASS'], $setting['SQL_PDO_DRIVER']);
		if($testdB->dead) {
			throw new Exception('The connection to database tpointshop was unsuccessful, settings not saved.');
		}

		# cabalengine configs
		$cabalengineConfigurations = cabalengineConfigs();

		# make sure the settings are in the allow list
		foreach(array_keys($setting) as $settingName) {
			if(!in_array($settingName, $allowedSettings)) throw new Exception('One or more submitted setting is not editable.');

			$cabalengineConfigurations[$settingName] = $setting[$settingName];
		}

		$newCabalEngineConfig = json_encode($cabalengineConfigurations, JSON_PRETTY_PRINT);
		$cfgFile = fopen(__PATH_CONFIGS__.'cabalengine.json', 'w');
		if(!$cfgFile) throw new Exception('There was a problem opening the configuration file.');

		fwrite($cfgFile, $newCabalEngineConfig);
		fclose($cfgFile);

		message('success', 'Settings successfully saved!');
	} catch(Exception $ex) {
		message('error', $ex->getMessage());
	}
}

echo '<div class="col-md-12">';
	echo '<form action="" method="post">';
		echo '<table class="table table-striped table-bordered table-hover" style="table-layout: fixed;">';


			echo '<tr>';
				echo '<td>';
					echo '<strong>Host</strong>';
					echo '<p class="setting-description">Hostname/IP address of your MSSQL server.</p>';
				echo '</td>';
				echo '<td>';
					echo '<input type="text" class="form-control" name="SQL_DB_HOST" value="'.config('SQL_DB_HOST',true).'" required>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td>';
					echo '<strong>Database Web</strong>';
					echo '<p class="setting-description">Usually "CabalEngine".</p>';
				echo '</td>';
				echo '<td>';
					echo '<input type="text" class="form-control" name="SQL_DB_WEB_NAME" value="'.config('SQL_DB_WEB_NAME',true).'" required>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td>';
					echo '<strong>Database Account</strong>';
					echo '<p class="setting-description">Usually "Account".</p>';
				echo '</td>';
				echo '<td>';
					echo '<input type="text" class="form-control" name="SQL_DB_ACCOUNT_NAME" value="'.config('SQL_DB_ACCOUNT_NAME',true).'" required>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td>';
					echo '<strong>Database CabalCash</strong>';
					echo '<p class="setting-description">Usually "CabalCash".</p>';
				echo '</td>';
				echo '<td>';
					echo '<input type="text" class="form-control" name="SQL_DB_CABALCASH_NAME" value="'.config('SQL_DB_CABALCASH_NAME',true).'" required>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td>';
					echo '<strong>Database CabalGuild</strong>';
					echo '<p class="setting-description">Usually "CabalGuild".</p>';
				echo '</td>';
				echo '<td>';
					echo '<input type="text" class="form-control" name="SQL_DB_CABALGUILD_NAME" value="'.config('SQL_DB_CABALGUILD_NAME',true).'" required>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td>';
					echo '<strong>Database Coupon</strong>';
					echo '<p class="setting-description">Usually "Coupon".</p>';
				echo '</td>';
				echo '<td>';
					echo '<input type="text" class="form-control" name="SQL_DB_CABALCOUPON_NAME" value="'.config('SQL_DB_CABALCOUPON_NAME',true).'" required>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td>';
					echo '<strong>Database Event</strong>';
					echo '<p class="setting-description">Usually "Event".</p>';
				echo '</td>';
				echo '<td>';
					echo '<input type="text" class="form-control" name="SQL_DB_CABALEVENT_NAME" value="'.config('SQL_DB_CABALEVENT_NAME',true).'" required>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td>';
					echo '<strong>Database EventData</strong>';
					echo '<p class="setting-description">Usually "EventData".</p>';
				echo '</td>';
				echo '<td>';
					echo '<input type="text" class="form-control" name="SQL_DB_CABALEVENTDATA_NAME" value="'.config('SQL_DB_CABALEVENTDATA_NAME',true).'" required>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td>';
					echo '<strong>Database GameSvc</strong>';
					echo '<p class="setting-description">Usually "GameSvc".</p>';
				echo '</td>';
				echo '<td>';
					echo '<input type="text" class="form-control" name="SQL_DB_CABALGAMESVC_NAME" value="'.config('SQL_DB_CABALGAMESVC_NAME',true).'" required>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td>';
					echo '<strong>Database ItemShop</strong>';
					echo '<p class="setting-description">Usually "ItemShop".</p>';
				echo '</td>';
				echo '<td>';
					echo '<input type="text" class="form-control" name="SQL_DB_CABALITEMSHOP_NAME" value="'.config('SQL_DB_CABALITEMSHOP_NAME',true).'" required>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td>';
					echo '<strong>Database NetcafeBilling</strong>';
					echo '<p class="setting-description">Usually "NetcafeBilling".</p>';
				echo '</td>';
				echo '<td>';
					echo '<input type="text" class="form-control" name="SQL_DB_CABALNETCAFEBILLING_NAME" value="'.config('SQL_DB_CABALNETCAFEBILLING_NAME',true).'" required>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td>';
					echo '<strong>Database Server01</strong>';
					echo '<p class="setting-description">Usually "Server01".</p>';
				echo '</td>';
				echo '<td>';
					echo '<input type="text" class="form-control" name="SQL_DB_CABALSERVER01_NAME" value="'.config('SQL_DB_CABALSERVER01_NAME',true).'" required>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td>';
					echo '<strong>Database TPointShop</strong>';
					echo '<p class="setting-description">Usually "TPointShop".</p>';
				echo '</td>';
				echo '<td>';
					echo '<input type="text" class="form-control" name="SQL_DB_CABALTPOINTSHOP_NAME" value="'.config('SQL_DB_CABALTPOINTSHOP_NAME',true).'" required>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td>';
					echo '<strong>User</strong>';
					echo '<p class="setting-description">Usually "sa".</p>';
				echo '</td>';
				echo '<td>';
					echo '<input type="text" class="form-control" name="SQL_DB_USER" value="'.config('SQL_DB_USER',true).'" required>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td>';
					echo '<strong>Password</strong>';
					echo '<p class="setting-description">User\'s password.</p>';
				echo '</td>';
				echo '<td>';
					echo '<input type="text" class="form-control" name="SQL_DB_PASS" value="'.config('SQL_DB_PASS',true).'" required>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td>';
					echo '<strong>Port</strong>';
					echo '<p class="setting-description">Port number to remotely connect to your MSSQL server. Usually 1433.</p>';
				echo '</td>';
				echo '<td>';
					echo '<input type="number" class="form-control" name="SQL_DB_PORT" value="'.config('SQL_DB_PORT',true).'" required>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td>';
					echo '<strong>PDO Driver</strong>';
					echo '<p class="setting-description">Choose which driver CabalEngine should use to remotely connect to your MSSQL server.</p>';
				echo '</td>';
				echo '<td>';
					echo '<div class="radio">';
						echo '<label>';
							echo '<input type="radio" name="SQL_PDO_DRIVER" value="1" '.(config('SQL_PDO_DRIVER',true) == 1 ? 'checked' : null).'>';
							echo 'dblib (linux webserver)';
						echo '</label>';
					echo '</div>';
					echo '<div class="radio">';
						echo '<label>';
							echo '<input type="radio" name="SQL_PDO_DRIVER" value="2" '.(config('SQL_PDO_DRIVER',true) == 2 ? 'checked' : null).'>';
							echo 'sqlsrv (windows webserver)';
						echo '</label>';
					echo '</div>';
				echo '</td>';
			echo '</tr>';

		echo '</table>';

		echo '<button type="submit" name="settings_submit" value="ok" class="btn btn-success">Save Settings</button>';
	echo '</form>';
echo '</div>';