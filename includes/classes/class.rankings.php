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

class Rankings
{

	private $_results;
	private $_excludedCharacters = array('');
	private $_excludedGuilds = array('');
	private $_rankingsMenu;

	protected $config;
	protected $serverFiles;
	protected $web;
	protected $account;
	protected $server01;

	function __construct()
	{

		// cabalengine configs
		$this->config = cabalengineConfigs();
		$this->serverFiles = strtolower($this->config['server_files']);

		// rankings configs
		loadModuleConfigs('rankings');
		$this->_results = (check_value(mconfig('rankings_results')) ? mconfig('rankings_results') : 25);

		// excluded characters
		if (check_value(mconfig('rankings_excluded_characters'))) {
			$excludedCharacters = explode(",", mconfig('rankings_excluded_characters'));
			$this->_excludedCharacters = $excludedCharacters;
		}

		// excluded guilds
		if (check_value(mconfig('rankings_excluded_guilds'))) {
			$excludedGuilds = explode(",", mconfig('rankings_excluded_guilds'));
			$this->_excludedGuilds = $excludedGuilds;
		}

		// rankings menu
		$this->_rankingsMenu = array(
			// language phrase, module, status, file-exclusive (array)
			array(lang('rankings_txt_1', true), 'level', mconfig('rankings_enable_level')),
			array(lang('rankings_txt_2', true), 'resets', mconfig('rankings_enable_resets')),
			array(lang('rankings_txt_3', true), 'killers', mconfig('rankings_enable_pk')),
			array(lang('rankings_txt_4', true), 'guilds', mconfig('rankings_enable_guilds')),
			array(lang('rankings_txt_5', true), 'grandresets', mconfig('rankings_enable_gr')),
			array(lang('rankings_txt_6', true), 'online', mconfig('rankings_enable_online'), array('xteam')),
			array(lang('rankings_txt_7', true), 'votes', mconfig('rankings_enable_votes')),
			array(lang('rankings_txt_8', true), 'gens', mconfig('rankings_enable_gens')),
			array(lang('rankings_txt_22', true), 'master', mconfig('rankings_enable_master')),
		);

		// extra menu links
		$extraMenuLinks = getRankingMenuLinks();
		if (is_array($extraMenuLinks)) {
			foreach ($extraMenuLinks as $menuLink) {
				$this->_rankingsMenu[] = array($menuLink[0], $menuLink[1], true);
			}
		}
	}

	public function UpdateRankingCache($type)
	{
		switch ($type) {
			case 'level':
				$this->_levelsRanking();
				break;
			case 'resets':
				$this->_resetsRanking();
				break;
			case 'online':
				$this->_onlineRanking();
				break;
			case 'votes':
				$this->_votesRanking();
				break;
			case 'guilds':
				$this->_guildsRanking();
				break;
			case 'gens':
				$this->_gensRanking();
				break;
			default:
				return;
		}
	}

	private function _levelsRanking()
	{
		if (mconfig('combine_level_masterlevel')) {
			// level + master level combined (same tables)
			$result = $this->_getLevelRankingData(true);
		} else {
			// level only
			$result = $this->_getLevelRankingData(false);
		}
		if (!is_array($result)) return;

		$cache = BuildCacheData($result);
		UpdateCache('rankings_level.cache', $cache);
	}

	private function _resetsRanking()
	{
		if (mconfig('combine_level_masterlevel')) {
			// level + master level combined (same tables)
			$result = $this->_getResetRankingData(true);
		} else {
			// level only
			$result = $this->_getResetRankingData(false);
		}
		if (!is_array($result)) return;

		$cache = BuildCacheData($result);
		UpdateCache('rankings_resets.cache', $cache);
	}

	private function _guildsRanking()
	{
		$this->server01 = Connection::Database('Server01');

		$query = "
		SELECT TOP " . $this->_results . "
			g." . _CLMN_GUILD_NAME_ . ",
			cc." . _CLMN_CHR_NAME_ . " AS GuildMaster,
			gl." . _CLMN_GUILD_LVL_SCORE_ . " AS GuildPoints,
			gl." . _CLMN_GUILD_LVL_LEVEL_ . " AS GuildLevel
		FROM " . _TBL_GUILD_ . " g
		INNER JOIN " . _TBL_GUILD_LVL_ . " gl ON g." . _CLMN_GUILD_ID_ . " = gl." . _CLMN_GUILD_LVL_ID_ . "
		INNER JOIN " . _TBL_GUILDMEMB_ . " gm ON g." . _CLMN_GUILD_ID_ . " = gm." . _CLMN_GUILDMEMB_ID_ . " AND gm." . _CLMN_GUILDMEMB_TYPE_ . " = 1
		INNER JOIN " . _TBL_CHR_ . " cc ON gm." . _CLMN_GUILDMEMB_CHAR_ . " = cc." . _CLMN_CHR_IDX_ . "
		WHERE g." . _CLMN_GUILD_NAME_ . " NOT IN(" . $this->_rankingsExcludeGuilds() . ")
		ORDER BY gl." . _CLMN_GUILD_LVL_SCORE_ . " DESC
		";

		$result = $this->server01->query_fetch($query);
		if (!is_array($result)) return;

		$cache = BuildCacheData($result);
		UpdateCache('rankings_guilds.cache', $cache);
	}

	private function _gensRanking()
	{
		$duprianData = $this->_generateGensRankingData(1);
		if (!is_array($duprianData)) $duprianData = array();

		$vanertData = $this->_generateGensRankingData(2);
		if (!is_array($vanertData)) $vanertData = array();

		$rankingData = array_merge($duprianData, $vanertData);
		usort($rankingData, function ($a, $b) {
			return $b['contribution'] - $a['contribution'];
		});
		$result = array_slice($rankingData, 0, $this->_results);
		if (empty($result)) return;
		if (!is_array($result)) return;

		$cache = BuildCacheData($result);
		UpdateCache('rankings_gens.cache', $cache);
	}

	private function _votesRanking()
	{
		$this->web = Connection::Database('CabalEngine');

		$voteMonth = date("m/01/Y 00:00");
		$voteMonthTimestamp = strtotime($voteMonth);
		$accounts = $this->web->query_fetch("SELECT TOP " . $this->_results . " user_id,COUNT(*) as count FROM " . CABALENGINE_VOTE_LOGS . " WHERE timestamp >= ? GROUP BY user_id ORDER BY count DESC", array($voteMonthTimestamp));
		if (!is_array($accounts)) return;

		foreach ($accounts as $data) {
			$common = new common();

			$accountInfo = $common->accountInformation($data['user_id']);
			if (!is_array($accountInfo)) continue;

			$Character = new Character();
			$characterName = $Character->AccountCharacterIDC($accountInfo[_CLMN_USERNM_]);
			if (!check_value($characterName)) continue;

			$characterData = $Character->CharacterData($characterName);
			if (!is_array($characterData)) continue;

			if (in_array($characterName, $this->_excludedCharacters)) continue;

			$result[] = array($characterName, $data['count'], $characterData[_CLMN_CHR_CLASS_], $characterData[_CLMN_CHR_MAP_]);
		}
		if (!is_array($result)) return;
		$cache = BuildCacheData($result);
		UpdateCache('rankings_votes.cache', $cache);
	}

	private function _onlineRanking()
	{
		$this->web = Connection::Database('CabalEngine');
		$this->server01 = Connection::Database('Server01');

		switch ($this->serverFiles) {
			case "xteam":
				$result = $this->_getOnlineRankingDataMembStatHours();
				break;
			default:
				return;
		}
		if (!is_array($result)) return;

		$cache = BuildCacheData($result);
		UpdateCache('rankings_online.cache', $cache);
	}

	public function rankingsMenu()
	{
		echo '<div class="rankings_menu">';
		foreach ($this->_rankingsMenu as $rm_item) {
			if (array_key_exists(3, $rm_item)) {
				if (is_array($rm_item[3])) {
					if (!in_array($this->serverFiles, $rm_item[3])) continue;
				}
			}
			if ($rm_item[2]) {
				if ($_REQUEST['subpage'] == $rm_item[1]) {
					echo '<a href="' . __PATH_MODULES_RANKINGS__ . $rm_item[1] . '/" class="active">' . $rm_item[0] . '</a>';
				} else {
					echo '<a href="' . __PATH_MODULES_RANKINGS__ . $rm_item[1] . '/">' . $rm_item[0] . '</a>';
				}
			}
		}
		echo '</div>';
	}

	private function _rankingsExcludeChars()
	{
		if (!is_array($this->_excludedCharacters)) return;
		$return = array();
		foreach ($this->_excludedCharacters as $characterName) {
			$return[] = "'" . $characterName . "'";
		}
		return implode(",", $return);
	}

	private function _rankingsExcludeGuilds()
	{
		if (!is_array($this->_excludedGuilds)) return;
		$return = array();
		foreach ($this->_excludedGuilds as $guildName) {
			$return[] = "'" . $guildName . "'";
		}
		return implode(",", $return);
	}

	private function _generateGensRankingData($influence = 1)
	{
		$this->server01 = Connection::Database('Server01');

		$result = $this->server01->query_fetch("SELECT t1." . _CLMN_GENS_NAME_ . ", t1." . _CLMN_GENS_TYPE_ . ", t1." . _CLMN_GENS_POINT_ . ", t2." . _CLMN_CHR_LVL_ . ", t2." . _CLMN_CHR_CLASS_ . ", t2." . _CLMN_CHR_MAP_ . " FROM " . _TBL_GENS_ . " as t1 INNER JOIN " . _TBL_CHR_ . " as t2 ON t1." . _CLMN_GENS_NAME_ . " = t2." . _CLMN_CHR_NAME_ . " WHERE t1." . _CLMN_GENS_TYPE_ . " = ? AND t1." . _CLMN_GENS_NAME_ . " NOT IN(" . $this->_rankingsExcludeChars() . ") ORDER BY t1." . _CLMN_GENS_POINT_ . " DESC", array($influence));
		if (!is_array($result)) return;

		foreach ($result as $rankPos => $row) {
			$gensRank = getGensRank($row[_CLMN_GENS_POINT_]);
			if ($row[_CLMN_GENS_POINT_] >= 10000) {
				$gensRank = getGensLeadershipRank($rankPos);
			}

			$rankingData[] = array(
				'name' => $row[_CLMN_GENS_NAME_],
				'influence' => $row[_CLMN_GENS_TYPE_],
				'contribution' => $row[_CLMN_GENS_POINT_],
				'rank' => $gensRank,
				'level' => $row[_CLMN_CHR_LVL_],
				'class' => $row[_CLMN_CHR_CLASS_],
				'map' => $row[_CLMN_CHR_MAP_]
			);
		}

		if (!is_array($rankingData)) return;
		return $rankingData;
	}

	private function _getLevelRankingData($combineMasterLevel = false)
	{
		$this->server01 = Connection::Database('Server01');

		$result = $this->server01->query_fetch("SELECT TOP " . $this->_results . " " . _CLMN_CHR_NAME_ . "," . _CLMN_CHR_CLASS_ . "," . _CLMN_CHR_LVL_ . "," . _CLMN_CHR_MAP_ . "," . _CLMN_CHR_NATION_ . " FROM " . _TBL_CHR_ . " WHERE " . _CLMN_CHR_NAME_ . " NOT IN(" . $this->_rankingsExcludeChars() . ") ORDER BY " . _CLMN_CHR_LVL_ . " DESC");
		if (!is_array($result)) return;
		return $result;
	}

	private function _getResetRankingData($combineMasterLevel = false)
	{
		$this->server01 = Connection::Database('Server01');

		// level only (no master level)
		if (!$combineMasterLevel) {
			$result = $this->server01->query_fetch("SELECT TOP " . $this->_results . " " . _CLMN_CHR_NAME_ . "," . _CLMN_CHR_CLASS_ . "," . _CLMN_CHR_RSTS_ . "," . _CLMN_CHR_LVL_ . "," . _CLMN_CHR_MAP_ . " FROM " . _TBL_CHR_ . " WHERE " . _CLMN_CHR_NAME_ . " NOT IN(" . $this->_rankingsExcludeChars() . ") AND " . _CLMN_CHR_RSTS_ . " > 0 ORDER BY " . _CLMN_CHR_RSTS_ . " DESC, " . _CLMN_CHR_LVL_ . " DESC");
			if (!is_array($result)) return;
			return $result;
		}

		if (_TBL_CHR_ == _TBL_MASTERLVL_) {
			// level + master level (in same table)
			$result = $this->server01->query_fetch("SELECT TOP " . $this->_results . " " . _CLMN_CHR_NAME_ . "," . _CLMN_CHR_CLASS_ . "," . _CLMN_CHR_RSTS_ . ",(" . _CLMN_CHR_LVL_ . "+" . _CLMN_ML_LVL_ . ") as " . _CLMN_CHR_LVL_ . "," . _CLMN_CHR_MAP_ . " FROM " . _TBL_CHR_ . " WHERE " . _CLMN_CHR_NAME_ . " NOT IN(" . $this->_rankingsExcludeChars() . ") AND " . _CLMN_CHR_RSTS_ . " > 0 ORDER BY " . _CLMN_CHR_RSTS_ . " DESC, " . _CLMN_CHR_LVL_ . " DESC");
			if (!is_array($result)) return;
			return $result;
		} else {
			// level + master level (different tables)
			$Character = new Character();
			$result = $this->server01->query_fetch("SELECT TOP " . $this->_results . " " . _TBL_CHR_ . "." . _CLMN_CHR_NAME_ . ", " . _TBL_CHR_ . "." . _CLMN_CHR_CLASS_ . ", " . _TBL_CHR_ . "." . _CLMN_CHR_RSTS_ . ", (" . _TBL_CHR_ . "." . _CLMN_CHR_LVL_ . " + " . _TBL_MASTERLVL_ . "." . _CLMN_ML_LVL_ . ") as " . _CLMN_CHR_LVL_ . ", " . _TBL_CHR_ . "." . _CLMN_CHR_MAP_ . " FROM " . _TBL_CHR_ . " INNER JOIN " . _TBL_MASTERLVL_ . " ON " . _TBL_CHR_ . "." . _CLMN_CHR_NAME_ . " = " . _TBL_MASTERLVL_ . "." . _CLMN_ML_NAME_ . " WHERE " . _TBL_CHR_ . "." . _CLMN_CHR_NAME_ . " NOT IN (" . $this->_rankingsExcludeChars() . ") AND " . _TBL_CHR_ . "." . _CLMN_CHR_RSTS_ . " > 0 ORDER BY " . _TBL_CHR_ . "." . _CLMN_CHR_RSTS_ . " DESC, " . _CLMN_CHR_LVL_ . " DESC");
			if (!is_array($result)) return;
			return $result;
		}
	}

	private function _getKillersRankingData($combineMasterLevel = false)
	{
		$this->server01 = Connection::Database('Server01');

		// level only (no master level)
		if (!$combineMasterLevel) {
			$result = $this->server01->query_fetch("SELECT TOP " . $this->_results . " " . _CLMN_CHR_NAME_ . "," . _CLMN_CHR_CLASS_ . "," . _CLMN_CHR_PK_KILLS_ . "," . _CLMN_CHR_LVL_ . "," . _CLMN_CHR_MAP_ . "," . _CLMN_CHR_PK_LEVEL_ . " FROM " . _TBL_CHR_ . " WHERE " . _CLMN_CHR_NAME_ . " NOT IN(" . $this->_rankingsExcludeChars() . ") AND " . _CLMN_CHR_PK_KILLS_ . " > 0 ORDER BY " . _CLMN_CHR_PK_KILLS_ . " DESC");
			if (!is_array($result)) return;
			return $result;
		}
	}

	private function _getOnlineRankingDataMembStatHours()
	{
		$this->account = Connection::Database('Account');

		$accounts = $this->server01->query_fetch("SELECT TOP " . $this->_results . " " . _CLMN_MS_MEMBID_ . ", " . _CLMN_MS_PLAYTIME_ . " FROM " . _TBL_MS_ . " WHERE " . _CLMN_MS_PLAYTIME_ . " > 0 ORDER BY " . _CLMN_MS_PLAYTIME_ . " DESC");
		if (!is_array($accounts)) return;
		$Character = new Character();
		foreach ($accounts as $row) {
			$playerIDC = $Character->AccountCharacterIDC($row[_CLMN_MS_MEMBID_]);
			if (!check_value($playerIDC)) continue;
			$platerData = $Character->CharacterData($playerIDC);
			if (!is_array($platerData)) continue;
			$result[] = array(
				$playerIDC,
				$row[_CLMN_MS_PLAYTIME_] / 24,
				$platerData[_CLMN_CHR_CLASS_],
				$platerData[_CLMN_CHR_MAP_]
			);
		}
		if (!is_array($result)) return;
		return $result;
	}

	private function _getRankingsFilterData()
	{
		$classesData = custom('character_class');
		$rankingsFilter = custom('rankings_classgroup_filter');

		if (is_array($rankingsFilter)) {
			foreach ($rankingsFilter as $class => $phrase) {
				if (!array_key_exists($class, $classesData)) continue;

				$filterName = lang($phrase) == 'ERROR' ? $phrase : lang($phrase);
				$classGroupList = array();
				foreach ($classesData as $key => $row) {
					if ($row['class_group'] == $class) {
						$classGroupList[] = $key;
					}
				}
				$filterList[] = array(
					$class,
					implode(',', $classGroupList),
					$filterName,
				);
			}
		}

		if (!is_array($filterList)) return;
		return $filterList;
	}

	public function rankingsFilterMenu()
	{
		$filterData = $this->_getRankingsFilterData();
		if (!is_array($filterData)) return;

		echo '<div class="text-center">';
		echo '<ul class="rankings-class-filter">';

		echo '<li><a onclick="rankingsFilterRemove()" class="rankings-class-filter-selection"><div class="rounded-class">' . getPlayerClassAvatar(0, true, false, 'rankings-class-filter-image') . '</div><br />' . lang('rankings_filter_1') . '</a></li>';

		foreach ($filterData as $row) {
			$classStyle = $row[0];
			if ($classStyle >= 8) {
				$avatarStyle = ($classStyle - 8) | (1 << 23);
			} else {
				$avatarStyle = $classStyle;
			}

			echo '<li><a onclick="rankingsFilterByClass(' . $classStyle . ')" class="rankings-class-filter-selection rankings-class-filter-grayscale"><div class="rounded-class">' . getPlayerClassAvatar($avatarStyle, true, false, 'rankings-class-filter-image') . '</div><br />' . $row[2] . '</a></li>';
		}
		echo '</ul>';
		echo '</div>';
	}
}
