<?php
/**
 * CabalEngine
 * http://muengine.net/
 *
 * @version 1.0.9
 * @Mod author Rooan Oliveira / Original author Lautaro Angelico <http://lautaroangelico.com/>
 * @copyright (c) 2013-2017 Lautaro Angelico, All Rights Reserved
 *
 * Licensed under the MIT license
 * http://opensource.org/licenses/MIT
 */

echo '<h1 class="page-header">New Registrations</h1>';

	$db = $account;
	$newRegs = $db->query_fetch("SELECT TOP 200 "._CLMN_MEMBID_.", "._CLMN_USERNM_.", "._CLMN_EMAIL_." FROM "._TBL_MI_." ORDER BY "._CLMN_MEMBID_." DESC");

	if(is_array($newRegs)) {
		echo '<table id="new_registrations" class="table display">';
			echo '<thead>';
			echo '<tr>';
				echo '<th>Id</th>';
				echo '<th>Username</th>';
				echo '<th>Email</th>';
				echo '<th></th>';
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			foreach($newRegs as $thisReg) {
				echo '<tr>';
					echo '<td>'.$thisReg[_CLMN_MEMBID_].'</td>';
					echo '<td>'.$thisReg[_CLMN_USERNM_].'</td>';
					echo '<td>'.$thisReg[_CLMN_EMAIL_].'</td>';
					echo '<td style="text-align:right;"><a href="'.admincp_base("accountinfo&id=".$thisReg[_CLMN_MEMBID_]).'" class="btn btn-xs btn-default">Account Information</a></td>';
				echo '</tr>';
			}
			echo '</tbody>';
		echo '</table>';
	}
?>