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
?>
<div class="row">
	<div class="col-xs-8 home-news-block">
		<div class="row home-news-block-header">
			<div class="col-xs-8">
				<h2><?php echo lang('news_txt_4'); ?></h2>
			</div>
			<div class="col-xs-4 text-right">
				<a href="<?php echo __BASE_URL__ . 'news/'; ?>"><?php echo lang('news_txt_5'); ?></a>
			</div>
		</div>
		<div class="row home-news-block-body">
			<div class="col-xs-12">
				<?php
				$News = new News();
				$newsList = loadCache('news.cache');
				if (is_array($newsList)) {
					foreach ($newsList as $key => $newsArticle) {

						if ($key >= 13) break;

						$News->setId($newsArticle['news_id']);
						$news_title = base64_decode($newsArticle['news_title']);

						if (config('language_switch_active', true)) {
							if (isset($_SESSION['language_display']) && isset($newsArticle['translations']) && is_array($newsArticle['translations']) && array_key_exists($_SESSION['language_display'], $newsArticle['translations'])) {
								$news_title = base64_decode($newsArticle['translations'][$_SESSION['language_display']]);
							}
						}

						$news_url = __BASE_URL__ . 'news/' . $newsArticle['news_id'] . '/';

						echo '<div class="row home-news-block-article">';
						echo '<div class="col-xs-3">';
						echo '<span class="home-news-block-article-type">' . lang('news_txt_6') . '</span>';
						echo '</div>';
						echo '<div class="col-xs-6 home-news-block-article-title-container">';
						echo '<span class="home-news-block-article-title"><a href="' . $news_url . '">' . $news_title . '</a></span>';
						echo '</div>';
						echo '<div class="col-xs-3 text-right">';
						echo '<span class="home-news-block-article-date">' . date("Y/m/d", $newsArticle['news_date']) . '</span>';
						echo '</div>';
						echo '</div>';
					}
				}
				?>
			</div>
		</div>
	</div>
	<div class="col-xs-4">
		<?php
		if (!isLoggedIn()) {
			echo '<div class="panel panel-sidebar">';
			echo '<div class="panel-heading">';
			echo '<h3 class="panel-title">' . lang('module_titles_txt_2') . ' <a href="' . __BASE_URL__ . 'forgotpassword" class="btn btn-primary btn-xs pull-right">' . lang('login_txt_4') . '</a></h3>';
			echo '</div>';
			echo '<div class="panel-body">';
			echo '<form action="' . __BASE_URL__ . 'login" method="post">';
			echo '<div class="form-group">';
			echo '<input type="text" class="form-control" id="loginBox1" name="cabalengineLogin_user" required>';
			echo '</div>';
			echo '<div class="form-group">';
			echo '<input type="password" class="form-control" id="loginBox2" name="cabalengineLogin_pwd" required>';
			echo '</div>';
			echo '<button type="submit" name="cabalengineLogin_submit" value="submit" class="btn btn-primary">' . lang('login_txt_3') . '</button>';
			echo '</form>';
			echo '</div>';
			echo '</div>';

			echo '<div class="sidebar-banner"><a href="' . __BASE_URL__ . 'register"><img src="' . __PATH_TEMPLATE_IMG__ . 'sidebar_banner_join.jpg"/></a></div>';
		} else {
			echo '<div class="panel panel-sidebar panel-usercp">';
			echo '<div class="panel-heading">';
			echo '<h3 class="panel-title">' . lang('usercp_menu_title') . ' <a href="' . __BASE_URL__ . 'logout" class="btn btn-primary btn-xs pull-right">' . lang('login_txt_6') . '</a></h3>';
			echo '</div>';
			echo '<div class="panel-body">';
			templateBuildUsercp();
			echo '</div>';
			echo '</div>';
		}
		$serverInfoCache = LoadCacheData('server_info.cache');
		if(is_array($serverInfoCache)) {
			$srvInfo = explode("|", $serverInfoCache[1][0]);
		}
		// Server info block
		if (isset($srvInfo) && is_array($srvInfo)) {
			echo '<div class="panel panel-sidebar">';
			echo '<div class="panel-heading">';
			echo '<h3 class="panel-title">' . lang('sidebar_srvinfo_txt_1') . '</h3>';
			echo '</div>';
			echo '<div class="panel-body">';
			echo '<table class="table">';
			if (check_value(config('server_info_episode', true))) echo '<tr><td>' . lang('sidebar_srvinfo_txt_6') . '</td><td>' . config('server_info_episode', true) . '</td></tr>';
			if (check_value(config('server_info_exp', true))) echo '<tr><td>' . lang('sidebar_srvinfo_txt_7') . '</td><td>' . config('server_info_exp', true) . '</td></tr>';
			// if(check_value(config('server_info_masterexp', true))) echo '<tr><td>'.lang('sidebar_srvinfo_txt_8').'</td><td>'.config('server_info_masterexp', true).'</td></tr>';
			// if(check_value(config('server_info_drop', true))) echo '<tr><td>'.lang('sidebar_srvinfo_txt_9').'</td><td>'.config('server_info_drop', true).'</td></tr>';
			echo '<tr><td>' . lang('sidebar_srvinfo_txt_2') . '</td><td style="font-weight:bold;">' . number_format($srvInfo[0]) . '</td></tr>';
			echo '<tr><td>' . lang('sidebar_srvinfo_txt_3') . '</td><td style="font-weight:bold;">' . number_format($srvInfo[1]) . '</td></tr>';
			echo '<tr><td>' . lang('sidebar_srvinfo_txt_4') . '</td><td style="font-weight:bold;">' . number_format($srvInfo[2]) . '</td></tr>';
			if (check_value(config('maximum_online', true))) echo '<tr><td>' . lang('sidebar_srvinfo_txt_5') . '</td><td style="color:#00aa00;font-weight:bold;">' . number_format($onlinePlayers) . '</td></tr>';
			echo '</table>';

			$totalCharacters = isset($srvInfo[1]) ? (int)$srvInfo[1] : 0;
			$capella = isset($srvInfo[4]) ? (int)$srvInfo[4] : 0;
			$procyon = isset($srvInfo[5]) ? (int)$srvInfo[5] : 0;
			$neutral = isset($srvInfo[6]) ? (int)$srvInfo[6] : 0;

			if ($totalCharacters > 0) {
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
		?>
	</div>
</div>

<div class="row" style="margin-top: 20px;">
	<div class="col-xs-4">
		<?php
		// Top Level
		$levelRankingData = LoadCacheData('rankings_level.cache');
		$topLevelLimit = 10;
		if (is_array($levelRankingData)) {
			$topLevel = array_slice($levelRankingData, 0, $topLevelLimit + 1);
			echo '<div class="panel panel-sidebar">';
			echo '<div class="panel-heading">';
			echo '<h3 class="panel-title">' . lang('rankings_txt_1') . '<a href="' . __BASE_URL__ . 'rankings/level" class="btn btn-primary btn-xs pull-right" style="text-align:center;width:22px;">+</a></h3>';
			echo '</div>';
			echo '<div class="panel-body" style="min-height:400px;">';
			echo '<table class="table table-condensed">';
			echo '<thead>';
			echo '<tr>';
			echo '<th class="text-center"></th>';
			echo '<th class="text-center">' . lang('rankings_txt_10') . '</th>'; // Character
			echo '<th class="text-center">' . lang('rankings_txt_11') . '</th>'; // Class
			echo '<th class="text-center">' . lang('rankings_txt_12') . '</th>'; // Level
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			foreach ($topLevel as $key => $row) {
				if ($key == 0) continue;
				echo '<tr>';
				echo '<td class="text-center">' . $key . '</td>';
				echo '<td class="text-center">' . playerProfile($row[0]) . '</td>';
				echo '<td class="text-center">' . getPlayerClass($row[1]) . '</td>';
				echo '<td class="text-center">' . number_format($row[2]) . '</td>';
				echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';
			echo '</div>';
			echo '</div>';
		}
		?>
	</div>
	<div class="col-xs-4">
		<?php
		// Top Guilds
		$guildRankingData = LoadCacheData('rankings_guilds.cache');
		$topGuildLimit = 10;
		if (is_array($guildRankingData)) {
			$rankingsConfig = loadConfigurations('rankings');
			$topGuild = array_slice($guildRankingData, 0, $topGuildLimit + 1);
			echo '<div class="panel panel-sidebar">';
			echo '<div class="panel-heading">';
			echo '<h3 class="panel-title">' . lang('rankings_txt_4') . '<a href="' . __BASE_URL__ . 'rankings/guilds" class="btn btn-primary btn-xs pull-right" style="text-align:center;width:22px;">+</a></h3>';
			echo '</div>';
			echo '<div class="panel-body" style="min-height:400px;">';
			echo '<table class="table table-condensed">';
			echo '<thead>';
			echo '<tr>';
			echo '<th class="text-center"></th>';
			echo '<th class="text-center">' . lang('rankings_txt_17') . '</th>'; // Guild Name
			echo '<th class="text-center">' . lang('rankings_txt_19') . '</th>'; // Score
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			foreach ($topGuild as $key => $row) {
				if ($key == 0) continue;
				$multiplier = $rankingsConfig['guild_score_formula'] == 1 ? 1 : $rankingsConfig['guild_score_multiplier'];
				echo '<tr>';
				echo '<td class="text-center">' . $key . '</td>';
				echo '<td class="text-center">' . guildProfile($row[0]) . '</td>';
				echo '<td class="text-center">' . number_format(floor($row[2] * $multiplier)) . '</td>';
				echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';
			echo '</div>';
			echo '</div>';
		}
		?>
	</div>
	<div class="col-xs-4">
		<?php
		// Event Timers
		echo '<div class="panel panel-sidebar panel-sidebar-events">';
		echo '<div class="panel-heading">';
		echo '<h3 class="panel-title">' . lang('event_schedule') . '</h3>';
		echo '</div>';
		echo '<div class="panel-body" style="min-height:400px;">';
		echo '<table class="table table-condensed">';
		echo '<tr>';
		echo '<td><span id="event1_name"></span><br /><span class="smalltext">' . lang('event_schedule_start') . '</span></td>';
		echo '<td class="text-right"><span id="event1_next"></span><br /><span class="smalltext" id="event1"></span></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><span id="event2_name"></span><br /><span class="smalltext">' . lang('event_schedule_start') . '</span></td>';
		echo '<td class="text-right"><span id="event2_next"></span><br /><span class="smalltext" id="event2"></span></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><span id="event3_name"></span><br /><span class="smalltext">' . lang('event_schedule_start') . '</span></td>';
		echo '<td class="text-right"><span id="event3_next"></span><br /><span class="smalltext" id="event3"></span></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><span id="event4_name"></span><br /><span class="smalltext">' . lang('event_schedule_start') . '</span></td>';
		echo '<td class="text-right"><span id="event4_next"></span><br /><span class="smalltext" id="event4"></span></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><span id="event5_name"></span><br /><span class="smalltext">' . lang('event_schedule_start') . '</span></td>';
		echo '<td class="text-right"><span id="event5_next"></span><br /><span class="smalltext" id="event5"></span></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><span id="event6_name"></span><br /><span class="smalltext">' . lang('event_schedule_start') . '</span></td>';
		echo '<td class="text-right"><span id="event6_next"></span><br /><span class="smalltext" id="event6"></span></td>';
		echo '</tr>';
		echo '</table>';
		echo '</div>';
		echo '</div>';
		?>
	</div>
</div>