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

if (!defined('access') or !access or access != 'install') die();
?>
<h3>Create Tables</h3>
<br />
<?php
try {
	if (isset($_POST['install_step_3_submit'])) {
		if (!isset($_POST['install_step_3_error'])) {
			# move to next step
			$_SESSION['install_cstep']++;
			header('Location: install.php');
			die();
		} else {
			echo '<div class="alert alert-danger" role="alert">One of more errors have been logged, cannot continue.</div>';
		}
	}

	$cabalenginedb = new dB($_SESSION['install_sql_host'], $_SESSION['install_sql_port'], $_SESSION['install_sql_cabalengine'], $_SESSION['install_sql_user'], $_SESSION['install_sql_pass'], $_SESSION['install_sql_dsn']);

	if ($cabalenginedb->dead) {
		throw new Exception("Could not connect to database");
	}

	// SQL List
	if (!is_array($install['sql_list'])) throw new Exception('Could not load CabalEngine CMS SQL tables list.');
	foreach ($install['sql_list'] as $sqlFileName => $sqlTableName) {
		if (!file_exists('sql/' . $sqlFileName . '.txt')) {
			throw new Exception('The installation script is missing SQL tables.');
		}
	}

	$error = false;

	echo '<div class="list-group">';
	foreach ($install['sql_list'] as $sqlFileName => $sqlTableName) {
		$sqlFileContents = file_get_contents('sql/' . $sqlFileName . '.txt');
		if (!$sqlFileContents) continue;

		// rename table
		$query = str_replace('{TABLE_NAME}', $sqlTableName, $sqlFileContents);
		if (!$query) continue;

		// delete table
		if ($_GET['force'] == 1) {
			$cabalenginedb->query("DROP TABLE " . $sqlTableName);
		}

		// check if exists
		$tableExists = $cabalenginedb->query_fetch_single("SELECT * FROM sysobjects WHERE xtype = 'U' AND name = ?", array($sqlTableName));

		if (!$tableExists) {
			$create = $cabalenginedb->query($query);
			if ($create) {
				echo '<div class="list-group-item">' . $sqlTableName . '<span class="label label-success pull-right">Created</span></div>';
			} else {
				echo '<div class="list-group-item">' . $sqlTableName . '<span class="label label-danger pull-right">Error</span></div>';
				$error = true;
			}
		} else {
			echo '<div class="list-group-item">' . $sqlTableName . '<span class="label label-default pull-right">Already Exists</span></div>';
		}
	}
	echo '</div>';

	echo '<form method="post">';
	if ($error) echo '<input type="hidden" name="install_step_3_error" value="1"/>';
	echo '<a href="' . __INSTALL_URL__ . 'install.php" class="btn btn-default">Re-Check</a> ';
	echo '<button type="submit" name="install_step_3_submit" value="continue" class="btn btn-success">Continue</button>';
	echo '<a href="' . __INSTALL_URL__ . 'install.php?force=1" class="btn btn-danger pull-right">Delete Tables and Create Again</a>';
	echo '</form>';
} catch (Exception $ex) {
	echo '<div class="alert alert-danger" role="alert">' . $ex->getMessage() . '</div>';
}
