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

echo '<div class="page-title"><span>'.lang('profiles_txt_2',true).'</span></div>';

loadModuleConfigs('profiles');
if(mconfig('active')) {
	if(isset($_GET['req'])) {
		try {
			$weProfiles = new weProfiles();
			$weProfiles->setType("player");
			$weProfiles->setRequest($_GET['req']);
			$cData = $weProfiles->data();
			$battleStyleExpend = (($cData[2] & (1 << 23)) > 1) ? 8 : 0;
			$classCode = ($cData[2] & 7) + $battleStyleExpend;

			$onlineStatus = 0;
			$onlineCharactersCache = loadCache('online_characters.cache');
			if(is_array($onlineCharactersCache) && in_array($cData[1], $onlineCharactersCache)) {
				$onlineStatus = 1;
			}

			echo '<div class="profiles_player_card '.$custom['character_class'][$classCode][1].'">';
				echo '<div class="profiles_player_content">';
					echo '<table class="profiles_player_table">';
						echo '<tr>';
							echo '<td class="cname">'.$cData[1].'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td class="cclass">'.getPlayerClass($cData[2]).'</td>';
						echo '</tr>';
					echo '</table>';

					# info table
					echo '<table class="profiles_player_table profiles_player_table_info">';
						echo '<tr>';
							echo '<td>'.lang('profiles_txt_7',true).'</td>';
							echo '<td>'.number_format($cData[3]).'</td>';
						echo '<tr>';
							echo '<td>'.lang('profiles_txt_10',true).'</td>';
							echo '<td>'.number_format($cData[4]).'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td>'.lang('profiles_txt_11',true).'</td>';
							echo '<td>'.number_format($cData[5]).'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td>'.lang('profiles_txt_13',true).'</td>';
							echo '<td>'.number_format($cData[6]).'</td>';
						echo '</tr>';
						if(check_value($cData[7])) {
							echo '<tr>';
								echo '<td>'.lang('profiles_txt_16',true).'</td>';
								echo '<td>'.guildProfile($cData[7]).'</td>';
							echo '</tr>';
						}
						echo '<tr>';
							echo '<td>'.lang('profiles_txt_17',true).'</td>';
							if($onlineStatus) {
								echo '<td class="isonline">'.lang('profiles_txt_18',true).'</td>';
							} else {
								echo '<td class="isoffline">'.lang('profiles_txt_19',true).'</td>';
							}
						echo '</tr>';
					echo '</table>';
				echo '</div>';
			echo '</div>';

		} catch(Exception $e) {
			message('error', $e->getMessage());
		}
	} else {
		message('error', lang('error_25',true));
	}
} else {
	message('error', lang('error_47',true));
}