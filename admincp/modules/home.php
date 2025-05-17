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

// check install directory
if(file_exists(__ROOT_DIR__ . 'install/')) {
	message('warning', 'Your CabalEngine CMS <strong>install</strong> directory still exists, it is recommended that you rename or delete it.', 'WARNING');
}

echo '<div class="row">';
	echo '<div class="col-md-12">';
		echo '<div class="panel panel-primary">';
		echo '<div class="panel-heading">General Information</div>';
		echo '<div class="panel-body">';

			echo '<div class="list-group">';
				echo '<div class="list-group-item" target="_blank">';
					echo 'OS';
					echo '<span class="pull-right text-muted small">';
						echo '<em>'.PHP_OS.'</em>';
					echo '</span>';
				echo '</div>';
				echo '<div class="list-group-item" target="_blank">';
					echo 'PHP';
					echo '<span class="pull-right text-muted small">';
						echo '<em>'.phpversion().'</em>';
					echo '</span>';
				echo '</div>';
				echo '<a href="https://cabalenginecms.org/" class="list-group-item" target="_blank">';
					echo 'CabalEngine';
					echo '<span class="pull-right text-muted small">';
						if(checkVersion()) echo '<span class="label label-danger">Update Available</span>  ';
						echo '<em>'.__CABALENGINE_VERSION__.'</em>';
					echo '</span>';
				echo '</a>';
			echo '</div>';

			echo '<div class="list-group">';

				$web = Connection::Database('CabalEngine');
				$account = Connection::Database('Account');
				$server01 = Connection::Database('Server01');

				// Total Accounts
				$totalAccounts = $account->query_fetch_single("SELECT COUNT(*) as result FROM "._TBL_MI_."");
				echo '<div class="list-group-item">';
					echo 'Registered Accounts';
					echo '<span class="pull-right text-muted small">'.number_format($totalAccounts['result']).'</span>';
				echo '</div>';

				// Banned Accounts
				$bannedAccounts = $account->query_fetch_single("SELECT COUNT(*) as result FROM "._TBL_MI_." WHERE "._CLMN_BLOCCODE_." = 0");
				echo '<div class="list-group-item">';
					echo 'Banned Accounts';
					echo '<span class="pull-right text-muted small">'.number_format($bannedAccounts['result']).'</span>';
				echo '</div>';

				// Total Characters
				$totalCharacters = $server01->query_fetch_single("SELECT COUNT(*) as result FROM "._TBL_CHR_."");
				echo '<div class="list-group-item">';
					echo 'Characters';
					echo '<span class="pull-right text-muted small">'.number_format($totalCharacters['result']).'</span>';
				echo '</div>';

				// Plugins Status
				$pluginStatus = (config('plugins_system_enable',true) ? 'Enabled' : 'Disabled');
				echo '<div class="list-group-item">';
					echo 'Plugin System';
					echo '<span class="pull-right text-muted small">'.$pluginStatus.'</span>';
				echo '</div>';

				// Scheduled Tasks
				$scheduledTasks = $web->query_fetch_single("SELECT COUNT(*) as result FROM ".CABALENGINE_CRON."");
				echo '<div class="list-group-item">';
					echo 'Scheduled Tasks (cron)';
					echo '<span class="pull-right text-muted small">'.number_format($scheduledTasks['result']).'</span>';
				echo '</div>';

				// Server Time
				echo '<div class="list-group-item">';
					echo 'Server Time (web)';
					echo '<span class="pull-right text-muted small">'.date("Y-m-d h:i A").'</span>';
				echo '</div>';

				// Admins
				$admincpUsers = implode(", ", array_keys(config('admins',true)));
				echo '<div class="list-group-item">';
					echo 'Admins';
					echo '<span class="pull-right text-muted small">'.$admincpUsers.'</span>';
				echo '</div>';

			echo '</div>';
		echo '</div>';
		echo '</div>';
	echo '</div>';

	// echo '<div class="col-md-6">';
	// 	echo '<div class="panel panel-default">';
	// 	echo '<div class="panel-body">';
	// 		echo '<strong>CabalEngine CMS Official Website:</strong><br>';
	// 		echo '<a href="https://cabalenginecms.org/" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> https://cabalenginecms.org/</a><br><br>';

	// 		echo '<strong>Community Discord:</strong><br>';
	// 		echo '<a href="https://cabalenginecms.org/discord/" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> https://cabalenginecms.org/discord/</a><br><br>';

	// 		echo '<strong>Facebook Page:</strong><br>';
	// 		echo '<a href="https://cabalenginecms.org/facebook/" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> https://cabalenginecms.org/facebook/</a><br><br>';
	// 	echo '</div>';
	// 	echo '</div>';
	// echo '</div>';
echo '</div>';