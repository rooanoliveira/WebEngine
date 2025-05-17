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

echo '<h1 class="page-header">Credit Configurations</h1>';

$creditSystem = new CreditSystem();

// NEW CONFIG
if(isset($_POST['new_submit'])) {
	try {
		if(!isset($_POST['new_title'])) throw new Exception("Please fill all the required fields.");
		if(!isset($_POST['new_database'])) throw new Exception("Please fill all the required fields.");
		if(!isset($_POST['new_table'])) throw new Exception("Please fill all the required fields.");
		if(!isset($_POST['new_credits_column'])) throw new Exception("Please fill all the required fields.");
		if(!isset($_POST['new_creditsbonus_column'])) throw new Exception("Please fill all the required fields.");
		if(!isset($_POST['new_user_column'])) throw new Exception("Please fill all the required fields.");
		if(!isset($_POST['new_user_column_id'])) throw new Exception("Please fill all the required fields.");
		if(!isset($_POST['new_checkonline'])) throw new Exception("Please fill all the required fields.");
		if(!isset($_POST['new_display'])) throw new Exception("Please fill all the required fields.");

		$creditSystem->setConfigTitle($_POST['new_title']);
		$creditSystem->setConfigDatabase($_POST['new_database']);
		$creditSystem->setConfigTable($_POST['new_table']);
		$creditSystem->setConfigCreditsColumn($_POST['new_credits_column']);
		$creditSystem->setConfigCreditsBonusColumn($_POST['new_creditsbonus_column']);
		$creditSystem->setConfigUserColumn($_POST['new_user_column']);
		$creditSystem->setConfigUserColumnId($_POST['new_user_column_id']);
		$creditSystem->setConfigCheckOnline($_POST['new_checkonline']);
		$creditSystem->setConfigDisplay($_POST['new_display']);
		$creditSystem->saveConfig();

	} catch (Exception $ex) {
		message('error', $ex->getMessage());
	}
}

// EDIT CONFIG
if(isset($_POST['edit_submit'])) {
	try {
		if(!isset($_POST['edit_id'])) throw new Exception("Please fill all the required fields.");
		if(!isset($_POST['edit_title'])) throw new Exception("Please fill all the required fields.");
		if(!isset($_POST['edit_database'])) throw new Exception("Please fill all the required fields.");
		if(!isset($_POST['edit_table'])) throw new Exception("Please fill all the required fields.");
		if(!isset($_POST['edit_credits_column'])) throw new Exception("Please fill all the required fields.");
		if(!isset($_POST['edit_creditsbonus_column'])) throw new Exception("Please fill all the required fields.");
		if(!isset($_POST['edit_user_column'])) throw new Exception("Please fill all the required fields.");
		if(!isset($_POST['edit_user_column_id'])) throw new Exception("Please fill all the required fields.");
		if(!isset($_POST['edit_checkonline'])) throw new Exception("Please fill all the required fields.");
		if(!isset($_POST['edit_display'])) throw new Exception("Please fill all the required fields.");

		$creditSystem->setConfigId($_POST['edit_id']);
		$creditSystem->setConfigTitle($_POST['edit_title']);
		$creditSystem->setConfigDatabase($_POST['edit_database']);
		$creditSystem->setConfigTable($_POST['edit_table']);
		$creditSystem->setConfigCreditsColumn($_POST['edit_credits_column']);
		$creditSystem->setConfigCreditsBonusColumn($_POST['edit_creditsbonus_column']);
		$creditSystem->setConfigUserColumn($_POST['edit_user_column']);
		$creditSystem->setConfigUserColumnId($_POST['edit_user_column_id']);
		$creditSystem->setConfigCheckOnline($_POST['edit_checkonline']);
		$creditSystem->setConfigDisplay($_POST['edit_display']);

		$creditSystem->editConfig();
	} catch (Exception $ex) {
		message('error', $ex->getMessage());
	}
}

// DELETE CONFIG
if(isset($_GET['delete'])) {
	try {
		$creditSystem->setConfigId($_GET['delete']);
		$creditSystem->deleteConfig();
	} catch (Exception $ex) {
		message('error', $ex->getMessage());
	}
}

echo '<div class="row">';
	echo '<div class="col-md-4">';

		if(!isset($_GET['edit'])) {
			// ADD NEW CONFIG
			echo '<div class="panel panel-primary">';
			echo '<div class="panel-heading">New Configuration</div>';
			echo '<div class="panel-body">';

				echo '<form role="form" action="'.admincp_base("creditsconfigs").'" method="post">';
					echo '<div class="form-group">';
						echo '<label for="input_1">Title:</label>';
						echo '<input type="text" class="form-control" id="input_1" name="new_title"/>';
					echo '</div>';

					echo '<label>Database:</label>';
					echo '<div class="radio">';
						echo '<label>';
							echo '<input type="radio" name="new_database" id="databaseRadios1" value="CabalCash" checked> ' . config('SQL_DB_CABALCASH_NAME', true);
						echo '</label>';
					echo '</div>';

					echo '<div class="form-group">';
						echo '<label for="input_2">Table:</label>';
						echo '<input type="text" class="form-control" id="input_2" name="new_table"/>';
					echo '</div>';

					echo '<div class="form-group">';
						echo '<label for="input_3">Cash Column:</label>';
						echo '<input type="text" class="form-control" id="input_3" name="new_credits_column"/>';
					echo '</div>';

					echo '<div class="form-group">';
						echo '<label for="input_5">Cash Bonus Column:</label>';
						echo '<input type="text" class="form-control" id="input_5" name="new_creditsbonus_column"/>';
					echo '</div>';

					echo '<div class="form-group">';
						echo '<label for="input_4">User Column:</label>';
						echo '<input type="text" class="form-control" id="input_4" name="new_user_column"/>';
					echo '</div>';

					echo '<label>User Identifier:</label>';
					echo '<div class="radio">';
						echo '<label>';
							echo '<input type="radio" name="new_user_column_id" id="coRadios1" value="userid" checked> User ID';
						echo '</label>';
					echo '</div><br />';

					echo '<label>Check Online Status:</label>';
					echo '<div class="radio">';
						echo '<label>';
							echo '<input type="radio" name="new_checkonline" id="coRadios1" value="1" checked> Yes';
						echo '</label>';
					echo '</div>';
					echo '<div class="radio">';
						echo '<label>';
							echo '<input type="radio" name="new_checkonline" id="coRadios1" value="0"> No';
						echo '</label>';
					echo '</div><br />';

					echo '<label>Display in My Account:</label>';
					echo '<div class="radio">';
						echo '<label>';
							echo '<input type="radio" name="new_display" id="coRadios1" value="1" checked> Yes';
						echo '</label>';
					echo '</div>';
					echo '<div class="radio">';
						echo '<label>';
							echo '<input type="radio" name="new_display" id="coRadios1" value="0"> No';
						echo '</label>';
					echo '</div><br />';

					echo '<button type="submit" name="new_submit" value="1" class="btn btn-default">Save Configuration</button>';
				echo '</form>';

			echo '</div>';
			echo '</div>';
		} else {
			// EDIT
			$creditSystem->setConfigId($_GET['edit']);
			$configsData = $creditSystem->showConfigs(true);
			echo '<div class="panel panel-yellow">';
			echo '<div class="panel-heading">Edit Configuration</div>';
			echo '<div class="panel-body">';
				echo '<form role="form" action="'.admincp_base("creditsconfigs").'" method="post">';
				echo '<input type="hidden" name="edit_id" value="'.$configsData['config_id'].'"/>';
					echo '<div class="form-group">';
						echo '<label for="input_1">Title:</label>';
						echo '<input type="text" class="form-control" id="input_1" name="edit_title" value="'.$configsData['config_title'].'"/>';
					echo '</div>';

					echo '<label>Database:</label>';
					echo '<div class="radio">';
						echo '<label>';
							echo '<input type="radio" name="edit_database" id="databaseRadios1" value="CabalCash" checked> ' . config('SQL_DB_CABALCASH_NAME', true);
						echo '</label>';
					echo '</div>';

					echo '<div class="form-group">';
						echo '<label for="input_2">Table:</label>';
						echo '<input type="text" class="form-control" id="input_2" name="edit_table" value="'.$configsData['config_table'].'"/>';
					echo '</div>';

					echo '<div class="form-group">';
						echo '<label for="input_3">Cash Column:</label>';
						echo '<input type="text" class="form-control" id="input_3" name="edit_credits_column" value="'.$configsData['config_credits_col'].'"/>';
					echo '</div>';

					echo '<div class="form-group">';
						echo '<label for="input_5">Cash Bonus Column:</label>';
						echo '<input type="text" class="form-control" id="input_5" name="edit_creditsbonus_column" value="'.$configsData['config_creditsbonus_col'].'"/>';
					echo '</div>';

					echo '<div class="form-group">';
						echo '<label for="input_4">User Column:</label>';
						echo '<input type="text" class="form-control" id="input_4" name="edit_user_column" value="'.$configsData['config_user_col'].'"/>';
					echo '</div>';

					echo '<label>User Identifier:</label>';
					echo '<div class="radio">';
						echo '<label>';
							echo '<input type="radio" name="edit_user_column_id" id="coRadios1" value="userid" '.($configsData['config_user_col_id'] == "userid" ? 'checked' : null).'> User ID';
						echo '</label>';
					echo '</div><br />';

					echo '<label>Check Online Status:</label>';
					echo '<div class="radio">';
						echo '<label>';
							echo '<input type="radio" name="edit_checkonline" id="coRadios1" value="1" '.($configsData['config_checkonline'] == 1 ? 'checked' : null).'> Yes';
						echo '</label>';
					echo '</div>';
					echo '<div class="radio">';
						echo '<label>';
							echo '<input type="radio" name="edit_checkonline" id="coRadios1" value="0" '.($configsData['config_checkonline'] == 0 ? 'checked' : null).'> No';
						echo '</label>';
					echo '</div><br />';

					echo '<label>Display in My Account:</label>';
					echo '<div class="radio">';
						echo '<label>';
							echo '<input type="radio" name="edit_display" id="coRadios1" value="1" '.($configsData['config_display'] == 1 ? 'checked' : null).'> Yes';
						echo '</label>';
					echo '</div>';
					echo '<div class="radio">';
						echo '<label>';
							echo '<input type="radio" name="edit_display" id="coRadios1" value="0" '.($configsData['config_display'] == 0 ? 'checked' : null).'> No';
						echo '</label>';
					echo '</div><br />';

					echo '<button type="submit" name="edit_submit" value="1" class="btn btn-warning">Save Configuration</button>';
				echo '</form>';
			echo '</div>';
			echo '</div>';
		}

	echo '</div>';
	echo '<div class="col-md-8">';

		$configsList = $creditSystem->showConfigs();
		if(is_array($configsList)) {
			foreach($configsList as $data) {

				$checkOnline = ($data['config_checkonline'] ? '<span class="label label-success">Yes</span>' : '<span class="label label-default">No</span>');
				$configdisplay = ($data['config_display'] ? '<span class="label label-success">Yes</span>' : '<span class="label label-default">No</span>');
				$databaseDisplay = $data['config_database'];

				echo '<div class="panel panel-default">';
					echo '<div class="panel-heading">';
						echo $data['config_title'];
						echo '<a href="'.admincp_base("creditsconfigs&delete=".$data['config_id']).'" class="btn btn-danger btn-xs pull-right">Delete</a>';
						echo '<a href="'.admincp_base("creditsconfigs&edit=".$data['config_id']).'" class="btn btn-default btn-xs pull-right" style="margin-right:5px;">Edit</a>';
					echo '</div>';
					echo '<div class="panel-body">';

						echo '<table class="table" style="margin-bottom:0px;">';
							echo '<tbody>';
								echo '<tr>';
									echo '<th>Config Id</th>';
									echo '<td>'.$data['config_id'].'</td>';
									echo '<th>User Column Identifier</th>';
									echo '<td>'.$data['config_user_col_id'].'</td>';
								echo '</tr>';
								echo '<tr>';
									echo '<th>Database</th>';
									echo '<td>'.$databaseDisplay.'</td>';
									echo '<th>Online Check</th>';
									echo '<td>'.$checkOnline.'</td>';
								echo '</tr>';
								echo '<tr>';
									echo '<th>Table</th>';
									echo '<td>'.$data['config_table'].'</td>';
									echo '<th>Display in My Account</th>';
									echo '<td>'.$configdisplay.'</td>';
								echo '</tr>';
								echo '<tr>';
									echo '<th>Cash Column</th>';
									echo '<td>'.$data['config_credits_col'].'</td>';
									echo '<th></th>';
									echo '<td></td>';
								echo '</tr>';
								echo '<tr>';
									echo '<th>Cash Bonus Column</th>';
									echo '<td>'.$data['config_creditsbonus_col'].'</td>';
									echo '<th></th>';
									echo '<td></td>';
								echo '</tr>';
								echo '<tr>';
									echo '<th>User Column</th>';
									echo '<td>'.$data['config_user_col'].'</td>';
									echo '<th></th>';
									echo '<td></td>';
								echo '</tr>';
							echo '</tbody>';
						echo '</table>';

					echo '</div>';
				echo '</div>';

			}
		} else {
			message('warning', 'You have not created any configuration.');
		}

	echo '</div>';
echo '</div>';