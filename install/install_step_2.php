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
<h3>Database Connection</h3>
<br />
<?php
if (isset($_POST['install_step_2_submit'])) {
	try {

		$_SESSION['install_sql_host'] = $_POST['install_step_2_1'];
		if (!isset($_POST['install_step_2_1'])) throw new Exception('You must complete all required fields.');

		$_SESSION['install_sql_port'] = $_POST['install_step_2_2'];
		if (!isset($_POST['install_step_2_2'])) throw new Exception('You must complete all required fields.');

		$_SESSION['install_sql_dsn'] = $_POST['install_step_2_3'];
		if (!isset($_POST['install_step_2_3'])) throw new Exception('You must complete all required fields.');
		if (!array_key_exists($_POST['install_step_2_3'], $install['PDO_DSN'])) throw new Exception('You must complete all required fields.');

		$_SESSION['install_sql_user'] = $_POST['install_step_2_4'];
		if (!isset($_POST['install_step_2_4'])) throw new Exception('You must complete all required fields.');

		$_SESSION['install_sql_pass'] = $_POST['install_step_2_5'];
		if (!isset($_POST['install_step_2_5'])) throw new Exception('You must complete all required fields.');

		$_SESSION['install_sql_cabalengine'] = $_POST['install_step_2_6'];
		if (!isset($_POST['install_step_2_6'])) throw new Exception('You must complete all required fields.');

		$_SESSION['install_sql_account'] = $_POST['install_step_2_7'];
		if (!isset($_POST['install_step_2_7'])) throw new Exception('You must complete all required fields.');

		$_SESSION['install_sql_cabalcash'] = $_POST['install_step_2_8'];
		if (!isset($_POST['install_step_2_8'])) throw new Exception('You must complete all required fields.');

		$_SESSION['install_sql_cabalguild'] = $_POST['install_step_2_9'];
		if (!isset($_POST['install_step_2_9'])) throw new Exception('You must complete all required fields.');

		$_SESSION['install_sql_cabalcoupon'] = $_POST['install_step_2_10'];
		if (!isset($_POST['install_step_2_10'])) throw new Exception('You must complete all required fields.');

		$_SESSION['install_sql_cabalevent'] = $_POST['install_step_2_11'];
		if (!isset($_POST['install_step_2_11'])) throw new Exception('You must complete all required fields.');

		$_SESSION['install_sql_cabaleventdata'] = $_POST['install_step_2_12'];
		if (!isset($_POST['install_step_2_12'])) throw new Exception('You must complete all required fields.');

		$_SESSION['install_sql_cabalgamesvc'] = $_POST['install_step_2_13'];
		if (!isset($_POST['install_step_2_13'])) throw new Exception('You must complete all required fields.');

		$_SESSION['install_sql_cabalitemshop'] = $_POST['install_step_2_14'];
		if (!isset($_POST['install_step_2_14'])) throw new Exception('You must complete all required fields.');

		$_SESSION['install_sql_cabalnetcafebilling'] = $_POST['install_step_2_15'];
		if (!isset($_POST['install_step_2_15'])) throw new Exception('You must complete all required fields.');

		$_SESSION['install_sql_cabalserver01'] = $_POST['install_step_2_16'];
		if (!isset($_POST['install_step_2_16'])) throw new Exception('You must complete all required fields.');

		$_SESSION['install_sql_cabaltpointshop'] = $_POST['install_step_2_17'];
		if (!isset($_POST['install_step_2_17'])) throw new Exception('You must complete all required fields.');


		# test connection (cabalengine)
		$cabalengine = new dB($_SESSION['install_sql_host'], $_SESSION['install_sql_port'], $_SESSION['install_sql_cabalengine'], $_SESSION['install_sql_user'], $_SESSION['install_sql_pass'], $_SESSION['install_sql_dsn']);
		if ($cabalengine->dead) {
			throw new Exception("Could not connect to database CabalEngine");
		}

		# test connection (account)
		$account = new dB($_SESSION['install_sql_host'], $_SESSION['install_sql_port'], $_SESSION['install_sql_account'], $_SESSION['install_sql_user'], $_SESSION['install_sql_pass'], $_SESSION['install_sql_dsn']);
		if ($account->dead) {
			throw new Exception("Could not connect to database Account");
		}

		# test connection (cabalcash)
		$cabalcash = new dB($_SESSION['install_sql_host'], $_SESSION['install_sql_port'], $_SESSION['install_sql_cabalcash'], $_SESSION['install_sql_user'], $_SESSION['install_sql_pass'], $_SESSION['install_sql_dsn']);
		if ($cabalcash->dead) {
			throw new Exception("Could not connect to database CabalCash");
		}

		# test connection (cabalguild)
		$cabalguild = new dB($_SESSION['install_sql_host'], $_SESSION['install_sql_port'], $_SESSION['install_sql_cabalguild'], $_SESSION['install_sql_user'], $_SESSION['install_sql_pass'], $_SESSION['install_sql_dsn']);
		if ($cabalguild->dead) {
			throw new Exception("Could not connect to database CabalGuild");
		}

		# test connection (coupon)
		$coupon = new dB($_SESSION['install_sql_host'], $_SESSION['install_sql_port'], $_SESSION['install_sql_coupon'], $_SESSION['install_sql_user'], $_SESSION['install_sql_pass'], $_SESSION['install_sql_dsn']);
		if ($coupon->dead) {
			throw new Exception("Could not connect to database Coupon");
		}

		# test connection (event)
		$event = new dB($_SESSION['install_sql_host'], $_SESSION['install_sql_port'], $_SESSION['install_sql_event'], $_SESSION['install_sql_user'], $_SESSION['install_sql_pass'], $_SESSION['install_sql_dsn']);
		if ($event->dead) {
			throw new Exception("Could not connect to database Event");
		}

		# test connection (eventdata)
		$eventdata = new dB($_SESSION['install_sql_host'], $_SESSION['install_sql_port'], $_SESSION['install_sql_eventdata'], $_SESSION['install_sql_user'], $_SESSION['install_sql_pass'], $_SESSION['install_sql_dsn']);
		if ($eventdata->dead) {
			throw new Exception("Could not connect to database EventData");
		}

		# test connection (gamesvc)
		$gamesvc = new dB($_SESSION['install_sql_host'], $_SESSION['install_sql_port'], $_SESSION['install_sql_gamesvc'], $_SESSION['install_sql_user'], $_SESSION['install_sql_pass'], $_SESSION['install_sql_dsn']);
		if ($gamesvc->dead) {
			throw new Exception("Could not connect to database GameSvc");
		}

		# test connection (itemshop)
		$itemshop = new dB($_SESSION['install_sql_host'], $_SESSION['install_sql_port'], $_SESSION['install_sql_itemshop'], $_SESSION['install_sql_user'], $_SESSION['install_sql_pass'], $_SESSION['install_sql_dsn']);
		if ($itemshop->dead) {
			throw new Exception("Could not connect to database ItemShop");
		}

		# test connection (netcafebilling)
		$netcafebilling = new dB($_SESSION['install_sql_host'], $_SESSION['install_sql_port'], $_SESSION['install_sql_netcafebilling'], $_SESSION['install_sql_user'], $_SESSION['install_sql_pass'], $_SESSION['install_sql_dsn']);
		if ($netcafebilling->dead) {
			throw new Exception("Could not connect to database NetcafeBilling");
		}

		# test connection (server01)
		$server01 = new dB($_SESSION['install_sql_host'], $_SESSION['install_sql_port'], $_SESSION['install_sql_server01'], $_SESSION['install_sql_user'], $_SESSION['install_sql_pass'], $_SESSION['install_sql_dsn']);
		if ($server01->dead) {
			throw new Exception("Could not connect to database Server01");
		}

		# test connection (tpointshop)
		$tpointshop = new dB($_SESSION['install_sql_host'], $_SESSION['install_sql_port'], $_SESSION['install_sql_tpointshop'], $_SESSION['install_sql_user'], $_SESSION['install_sql_pass'], $_SESSION['install_sql_dsn']);
		if ($tpointshop->dead) {
			throw new Exception("Could not connect to database TPointShop");
		}

		# move to next step
		$_SESSION['install_cstep']++;
		header('Location: install.php');
		die();
	} catch (Exception $ex) {
		echo '<div class="alert alert-danger" role="alert">' . $ex->getMessage() . '</div>';
	}
}
?>
<form class="form-horizontal" method="post">
	<div class="form-group">
		<label for="input_1" class="col-sm-2 control-label">Host</label>
		<div class="col-sm-10">
			<input type="text" name="install_step_2_1" class="form-control" id="input_1" value="<?php echo (isset($_SESSION['install_sql_host']) ? $_SESSION['install_sql_host'] : null); ?>">
			<p class="help-block">Set the IP address of your MSSQL server.</p>
		</div>
	</div>
	<div class="form-group">
		<label for="input_2" class="col-sm-2 control-label">Port</label>
		<div class="col-sm-10">
			<input type="text" name="install_step_2_2" class="form-control" id="input_2" value="<?php echo (isset($_SESSION['install_sql_port']) ? $_SESSION['install_sql_port'] : '1433'); ?>">
			<p class="help-block">Default: 1433.</p>
		</div>
	</div>

	<div class="form-group">
		<label for="input_3" class="col-sm-2 control-label">PDO Driver</label>
		<div class="col-sm-10">
			<div class="radio">
				<label>
					<input type="radio" name="install_step_2_3" id="input_3" value="1" checked="checked">
					DBLib (Web Server Linux)
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="install_step_2_3" id="input_3" value="2">
					SQLSRV (Web Server Windows)
				</label>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label for="input_4" class="col-sm-2 control-label">Username</label>
		<div class="col-sm-10">
			<input type="text" name="install_step_2_4" class="form-control" id="input_4" value="<?php echo (isset($_SESSION['install_sql_user']) ? $_SESSION['install_sql_user'] : 'sa'); ?>">
			<p class="help-block">It is recommended that you create a new MSSQL user just for the web connection (better security).</p>
		</div>
	</div>
	<div class="form-group">
		<label for="input_5" class="col-sm-2 control-label">Password</label>
		<div class="col-sm-10">
			<input type="text" name="install_step_2_5" class="form-control" id="input_5" value="<?php echo (isset($_SESSION['install_sql_pass']) ? $_SESSION['install_sql_pass'] : null); ?>">
			<p class="help-block">It is recommended that you use a strong password to ensure maximum security.</p>
		</div>
	</div>
	<div class="form-group">
		<label for="input_6" class="col-sm-2 control-label">Database CabalEngine</label>
		<div class="col-sm-10">
			<input type="text" name="install_step_2_6" class="form-control" id="input_6" value="<?php echo (isset($_SESSION['install_sql_cabalengine']) ? $_SESSION['install_sql_cabalengine'] : 'CabalEngine'); ?>">
			<p class="help-block">Usually <strong>CabalEngine</strong>. CabalEngine tables will be created in this database.</p>
		</div>
	</div>
	<div class="form-group">
		<label for="input_7" class="col-sm-2 control-label">Database Account</label>
		<div class="col-sm-10">
			<input type="text" name="install_step_2_7" class="form-control" id="input_7" value="<?php echo (isset($_SESSION['install_sql_db_account']) ? $_SESSION['install_sql_db_account'] : 'Account'); ?>">
			<p class="help-block">Usually <strong>Account</strong>. </p>
		</div>
	</div>
	<div class="form-group">
		<label for="input_8" class="col-sm-2 control-label">Database CabalCash</label>
		<div class="col-sm-10">
			<input type="text" name="install_step_2_8" class="form-control" id="input_8" value="<?php echo (isset($_SESSION['install_sql_db_cabalcash']) ? $_SESSION['install_sql_db_cabalcash'] : 'CabalCash'); ?>">
			<p class="help-block">Usually <strong>CabalCash</strong>. </p>
		</div>
	</div>
	<div class="form-group">
		<label for="input_9" class="col-sm-2 control-label">Database CabalGuild</label>
		<div class="col-sm-10">
			<input type="text" name="install_step_2_9" class="form-control" id="input_9" value="<?php echo (isset($_SESSION['install_sql_db_cabalguild']) ? $_SESSION['install_sql_db_cabalguild'] : 'CabalGuild'); ?>">
			<p class="help-block">Usually <strong>CabalGuild</strong>. </p>
		</div>
	</div>
	<div class="form-group">
		<label for="input_10" class="col-sm-2 control-label">Database Coupon</label>
		<div class="col-sm-10">
			<input type="text" name="install_step_2_10" class="form-control" id="input_10" value="<?php echo (isset($_SESSION['install_sql_db_coupon']) ? $_SESSION['install_sql_db_coupon'] : 'Coupon'); ?>">
			<p class="help-block">Usually <strong>Coupon</strong>. </p>
		</div>
	</div>
	<div class="form-group">
		<label for="input_11" class="col-sm-2 control-label">Database Event</label>
		<div class="col-sm-10">
			<input type="text" name="install_step_2_11" class="form-control" id="input_11" value="<?php echo (isset($_SESSION['install_sql_db_event']) ? $_SESSION['install_sql_db_event'] : 'Event'); ?>">
			<p class="help-block">Usually <strong>Event</strong>. </p>
		</div>
	</div>
	<div class="form-group">
		<label for="input_12" class="col-sm-2 control-label">Database EventData</label>
		<div class="col-sm-10">
			<input type="text" name="install_step_2_12" class="form-control" id="input_12" value="<?php echo (isset($_SESSION['install_sql_db_eventdata']) ? $_SESSION['install_sql_db_eventdata'] : 'EventData'); ?>">
			<p class="help-block">Usually <strong>EventData</strong>. </p>
		</div>
	</div>
	<div class="form-group">
		<label for="input_13" class="col-sm-2 control-label">Database GameSvc</label>
		<div class="col-sm-10">
			<input type="text" name="install_step_2_13" class="form-control" id="input_13" value="<?php echo (isset($_SESSION['install_sql_db_gamesvc']) ? $_SESSION['install_sql_db_gamesvc'] : 'GameSvc'); ?>">
			<p class="help-block">Usually <strong>GameSvc</strong>. </p>
		</div>
	</div>
	<div class="form-group">
		<label for="input_14" class="col-sm-2 control-label">Database ItemShop</label>
		<div class="col-sm-10">
			<input type="text" name="install_step_2_14" class="form-control" id="input_14" value="<?php echo (isset($_SESSION['install_sql_db_itemshop']) ? $_SESSION['install_sql_db_itemshop'] : 'ItemShop'); ?>">
			<p class="help-block">Usually <strong>ItemShop</strong>. </p>
		</div>
	</div>
	<div class="form-group">
		<label for="input_15" class="col-sm-2 control-label">Database NetcafeBilling</label>
		<div class="col-sm-10">
			<input type="text" name="install_step_2_15" class="form-control" id="input_15" value="<?php echo (isset($_SESSION['install_sql_db_netcafebilling']) ? $_SESSION['install_sql_db_netcafebilling'] : 'NetcafeBilling'); ?>">
			<p class="help-block">Usually <strong>NetcafeBilling</strong>. </p>
		</div>
	</div>
	<div class="form-group">
		<label for="input_16" class="col-sm-2 control-label">Database Server01</label>
		<div class="col-sm-10">
			<input type="text" name="install_step_2_16" class="form-control" id="input_16" value="<?php echo (isset($_SESSION['install_sql_db_server01']) ? $_SESSION['install_sql_db_server01'] : 'Server01'); ?>">
			<p class="help-block">Usually <strong>Server01</strong>. </p>
		</div>
	</div>
	<div class="form-group">
		<label for="input_17" class="col-sm-2 control-label">Database TPointShop</label>
		<div class="col-sm-10">
			<input type="text" name="install_step_2_17" class="form-control" id="input_17" value="<?php echo (isset($_SESSION['install_sql_db_tpointshop']) ? $_SESSION['install_sql_db_tpointshop'] : 'TPointShop'); ?>">
			<p class="help-block">Usually <strong>TPointShop</strong>. </p>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="install_step_2_submit" value="continue" class="btn btn-success">Continue</button>
		</div>
	</div>
</form>