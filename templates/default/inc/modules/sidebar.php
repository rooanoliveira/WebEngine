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

// Login block
if(!isLoggedIn()) {
	echo '<div class="panel panel-sidebar">';
		echo '<div class="panel-heading">';
			echo '<h3 class="panel-title">'.lang('module_titles_txt_2').' <a href="'.__BASE_URL__.'forgotpassword" class="btn btn-primary btn-xs pull-right">'.lang('login_txt_4').'</a></h3>';
		echo '</div>';
		echo '<div class="panel-body">';
			echo '<form action="'.__BASE_URL__.'login" method="post">';
				echo '<div class="form-group">';
					echo '<input type="text" class="form-control" id="loginBox1" name="cabalengineLogin_user" required>';
				echo '</div>';
				echo '<div class="form-group">';
					echo '<input type="password" class="form-control" id="loginBox2" name="cabalengineLogin_pwd" required>';
				echo '</div>';
				echo '<button type="submit" name="cabalengineLogin_submit" value="submit" class="btn btn-primary">'.lang('login_txt_3').'</button>';
			echo '</form>';
		echo '</div>';
	echo '</div>';

	// join now banner
	echo '<div class="sidebar-banner"><a href="'.__BASE_URL__.'register"><img src="'.__PATH_TEMPLATE_IMG__.'sidebar_banner_join.jpg"/></a></div>';
}

// Usercp block
if(isLoggedIn()) {
	echo '<div class="panel panel-sidebar panel-usercp">';
		echo '<div class="panel-heading">';
			echo '<h3 class="panel-title">'.lang('usercp_menu_title').' <a href="'.__BASE_URL__.'logout" class="btn btn-primary btn-xs pull-right">'.lang('login_txt_6').'</a></h3>';
		echo '</div>';
		echo '<div class="panel-body">';
				templateBuildUsercp();
		echo '</div>';
	echo '</div>';
}

// download banner
echo '<div class="sidebar-banner"><a href="'.__BASE_URL__.'downloads"><img src="'.__PATH_TEMPLATE_IMG__.'sidebar_banner_download.jpg"/></a></div>';

// Server info block
if(isset($srvInfo) && is_array($srvInfo)) {
	echo '<div class="panel panel-sidebar">';
		echo '<div class="panel-heading">';
			echo '<h3 class="panel-title">'.lang('sidebar_srvinfo_txt_1').'</h3>';
		echo '</div>';
		echo '<div class="panel-body">';
			echo '<table class="table">';
				if(check_value(config('server_info_episode', true))) echo '<tr><td>'.lang('sidebar_srvinfo_txt_6').'</td><td>'.config('server_info_episode', true).'</td></tr>';
				if(check_value(config('server_info_exp', true))) echo '<tr><td>'.lang('sidebar_srvinfo_txt_7').'</td><td>'.config('server_info_exp', true).'</td></tr>';
				// if(check_value(config('server_info_masterexp', true))) echo '<tr><td>'.lang('sidebar_srvinfo_txt_8').'</td><td>'.config('server_info_masterexp', true).'</td></tr>';
				// if(check_value(config('server_info_drop', true))) echo '<tr><td>'.lang('sidebar_srvinfo_txt_9').'</td><td>'.config('server_info_drop', true).'</td></tr>';
				echo '<tr><td>'.lang('sidebar_srvinfo_txt_2').'</td><td style="font-weight:bold;">'.number_format($srvInfo[0]).'</td></tr>';
				echo '<tr><td>'.lang('sidebar_srvinfo_txt_3').'</td><td style="font-weight:bold;">'.number_format($srvInfo[1]).'</td></tr>';
				echo '<tr><td>'.lang('sidebar_srvinfo_txt_4').'</td><td style="font-weight:bold;">'.number_format($srvInfo[2]).'</td></tr>';
				if(check_value(config('maximum_online', true))) echo '<tr><td>'.lang('sidebar_srvinfo_txt_5').'</td><td style="color:#00aa00;font-weight:bold;">'.number_format($onlinePlayers).'</td></tr>';
			echo '</table>';

			// Nova lógica da barra de porcentagem por facção
			$totalCharacters = isset($srvInfo[1]) ? (int)$srvInfo[1] : 0;
			$capella = isset($srvInfo[4]) ? (int)$srvInfo[4] : 0;
			$procyon = isset($srvInfo[5]) ? (int)$srvInfo[5] : 0;
			$neutral = isset($srvInfo[6]) ? (int)$srvInfo[6] : 0;

			if($totalCharacters > 0) {
				$capellaPercent = ($capella * 100 / $totalCharacters);
				$procyonPercent = ($procyon * 100 / $totalCharacters);
				$neutralPercent = ($neutral * 100 / $totalCharacters);

				echo '<h5 style="margin-bottom:5px;">'.lang('rankings_txt_24').'</h5>';
				echo '<div style="height: 20px; width: 100%; background: #eee; border-radius: 5px; overflow: hidden; display: flex;">';
				echo '<div style="width:' . round($capellaPercent, 2) . '%; background-color:#DF47FF;" title="Capella: ' . number_format($capella) . '"></div>';
				echo '<div style="width:' . round($procyonPercent, 2) . '%; background-color:#009BF4;" title="Procyon: ' . number_format($procyon) . '"></div>';
				echo '<div style="width:' . round($neutralPercent, 2) . '%; background-color:#CCCCCC;" title="Neutral: ' . number_format($neutral) . '"></div>';
				echo '</div>';
				echo '<ul style="margin-top: 5px; list-style: none; padding-left: 0;">';
					echo '<li style="font-size: 10px;"><span style="display:inline-block;width:10px;height:10px;background:#DF47FF;margin-right:5px;"></span>Capella: ('.round($capellaPercent,1).'%) | <span style="display:inline-block;width:10px;height:10px;background:#009BF4;margin-right:5px;"></span>Procyon: ('.round($procyonPercent,1).'%) | <span style="display:inline-block;width:10px;height:10px;background:#CCCCCC;margin-right:5px;"></span>Neutral: ('.round($neutralPercent,1).'%)</li>';
				echo '</ul>';
			}

		echo '</div>';
	echo '</div>';
}


// Castle Siege Block
templateCastleSiegeWidget();