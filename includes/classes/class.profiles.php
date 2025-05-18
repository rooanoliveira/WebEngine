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

class weProfiles {

	private $_request;
	private $_type;

	private $_reqMaxLen;
	private $_guildsCachePath;
	private $_playersCachePath;
	private $_cacheUpdateTime;

	private $_fileData;

	protected $common;
	protected $dB;
	protected $cfg;

	function __construct() {

		# database
		$this->common = new common();
		$this->dB = Connection::Database('Server01');

		# settings
		$this->_guildsCachePath = __PATH_CACHE__ . 'profiles/guilds/';
		$this->_playersCachePath = __PATH_CACHE__ . 'profiles/players/';
		$this->_cacheUpdateTime = 300;

		# check cache directories
		$this->checkCacheDir($this->_guildsCachePath);
		$this->checkCacheDir($this->_playersCachePath);

		# configs
		$profileConfig = loadConfigurations('profiles');
		if(!is_array($profileConfig)) throw new Exception(lang('error_25',true));
		$this->cfg = $profileConfig;

	}

	public function setType($input) {
		switch($input) {
			case "guild":
				$this->_type = "guild";
				$this->_reqMaxLen = 16;
				break;
			default:
				$this->_type = "player";
				$this->_reqMaxLen = 16;
		}
	}

	public function setRequest($input) {
		if(array_key_exists('encode', $this->cfg) && $this->cfg['encode'] == 1) {
			if(!Validator::Chars($input, array('a-z', 'A-Z', '0-9', '_', '-'))) throw new Exception(lang('error_25',true));
			$decodedReq = base64url_decode($input);
			if($decodedReq == false) throw new Exception(lang('error_25',true));
			$this->_request = $decodedReq;
			return true;
		}

		if(!Validator::AlphaNumeric($input)) throw new Exception(lang('error_25',true));
		if(strlen($input) > $this->_reqMaxLen) throw new Exception(lang('error_25',true));
		if(strlen($input) < 4) throw new Exception(lang('error_25',true));

		$this->_request = $input;
	}

	private function checkCacheDir($path) {
		if(check_value($path)) {
			if(!file_exists($path) || !is_dir($path)) {
				if(config('error_reporting',true)) {
					throw new Exception("Invalid cache directory ($path)");
				} else {
					throw new Exception(lang('error_21',true));
				}
			} else {
				if(!is_writable($path)) {
					if(config('error_reporting',true)) {
						throw new Exception("The cache directory is not writable ($path)");
					} else {
						throw new Exception(lang('error_21',true));
					}
				}
			}
		}
	}

	private function checkCache() {
		switch($this->_type) {
			case "guild":
				$reqFile = $this->_guildsCachePath . strtolower($this->_request) . '.cache';
				if(!file_exists($reqFile)) {
					$this->cacheGuildData();
				}
				$fileData = file_get_contents($reqFile);
				$fileData = explode("|", $fileData);
				if(is_array($fileData)) {
					if(time() > ($fileData[0]+$this->_cacheUpdateTime)) {
						$this->cacheGuildData();
					}
				} else {
					throw new Exception(lang('error_21',true));
				}
				$this->_fileData = file_get_contents($reqFile);
				break;
			default:
				$reqFile = $this->_playersCachePath . strtolower($this->_request) . '.cache';
				if(!file_exists($reqFile)) {
					$this->cachePlayerData();
				}
				$fileData = file_get_contents($reqFile);
				$fileData = explode("|", $fileData);
				if(is_array($fileData)) {
					if(time() > ($fileData[0]+$this->_cacheUpdateTime)) {
						$this->cachePlayerData();
					}
				} else {
					throw new Exception(lang('error_21',true));
				}
				$this->_fileData = file_get_contents($reqFile);
		}
	}

private function cacheGuildData() {
	// General Data
	$guildData = $this->dB->query_fetch_single("SELECT * FROM "._TBL_GUILD_." WHERE "._CLMN_GUILD_NAME_." = ?", array($this->_request));
	if(!$guildData) throw new Exception(lang('error_25', true));

	$guildID = $guildData[_CLMN_GUILD_ID_];

	// Guild Score
	$guildScore = $this->dB->query_fetch_single("SELECT "._CLMN_GUILD_LVL_SCORE_.", "._CLMN_GUILD_LVL_LEVEL_." FROM "._TBL_GUILD_LVL_." WHERE "._CLMN_GUILDMEMB_ID_." = ?", [$guildID]);
	if(!$guildScore) throw new Exception(lang('error_25', true));

	// Members
	$guildMembers = $this->dB->query_fetch("SELECT "._CLMN_GUILDMEMB_CHAR_." FROM "._TBL_GUILDMEMB_." WHERE "._CLMN_GUILDMEMB_ID_." = ?", [$guildID]);
	if(!$guildMembers) throw new Exception(lang('error_25', true));

	$members = array();
	foreach($guildMembers as $gmember) {
		$memberName = $this->dB->query_fetch_single("SELECT "._CLMN_CHR_NAME_." FROM "._TBL_CHR_." WHERE "._CLMN_CHR_IDX_." = ?", array($gmember[_CLMN_GUILDMEMB_CHAR_]));
		if($memberName && isset($memberName[_CLMN_CHR_NAME_])) {
			$members[] = $memberName[_CLMN_CHR_NAME_];
		}
	}
	$gmembers_str = implode(",", $members);

	// Guild Master
	$guildMaster = $this->dB->query_fetch_single("
		SELECT c."._CLMN_CHR_NAME_."
		FROM "._TBL_GUILD_." AS g
		INNER JOIN "._TBL_GUILDMEMB_." AS gm
			ON gm."._CLMN_GUILDMEMB_ID_." = g."._CLMN_GUILD_ID_." AND gm."._CLMN_GUILDMEMB_TYPE_." = 1
		INNER JOIN "._TBL_CHR_." AS c
			ON c."._CLMN_CHR_IDX_." = gm."._CLMN_GUILDMEMB_CHAR_."
		WHERE g."._CLMN_GUILD_NAME_." = ?", [$this->_request]);

	$guildMasterName = ($guildMaster && isset($guildMaster[_CLMN_CHR_NAME_])) ? $guildMaster[_CLMN_CHR_NAME_] : 'Unknown';

	// Cache
	$data = array(
		time(),
		$guildData[_CLMN_GUILD_NAME_],
		$guildScore[_CLMN_GUILD_LVL_LEVEL_],
		$guildScore[_CLMN_GUILD_LVL_SCORE_],
		$guildMasterName,
		$gmembers_str
	);

	// Cache Ready Data
	$cacheData = implode("|", $data);

	// Update Cache File
	$reqFile = $this->_guildsCachePath . strtolower($this->_request) . '.cache';
	$fp = fopen($reqFile, 'w+');
	fwrite($fp, $cacheData);
	fclose($fp);
}


	private function cachePlayerData() {
		$Character = new Character();

		// general player data
		$playerData = $Character->CharacterData($this->_request);
		if(!$playerData) throw new Exception(lang('error_25',true));

		// guild data
		$guild = "";
		#$guildData = $this->dB->query_fetch_single("SELECT * FROM "._TBL_GUILDMEMB_." WHERE "._CLMN_GUILDMEMB_CHAR_." = ?", array($this->_request));
		$guildData = $this->dB->query_fetch_single("
		SELECT *
		FROM "._TBL_GUILD_." g
		JOIN "._TBL_GUILDMEMB_." gm ON gm."._CLMN_GUILDMEMB_ID_." = g."._CLMN_GUILD_ID_."
		JOIN "._TBL_CHR_." c ON c."._CLMN_CHR_IDX_." = gm."._CLMN_GUILDMEMB_CHAR_."
		WHERE c."._CLMN_CHR_NAME_." = ?", array($this->_request));
		if($guildData) $guild = $guildData[_CLMN_GUILD_NAME_];

		// Cache
		$data = array(
			time(),
			$playerData[_CLMN_CHR_NAME_],
			$playerData[_CLMN_CHR_CLASS_],
			$playerData[_CLMN_CHR_LVL_],
			$playerData[_CLMN_CHR_STAT_STR_],
			$playerData[_CLMN_CHR_STAT_AGI_],
			$playerData[_CLMN_CHR_STAT_ENE_],
			$guild,
			0,
		);

		// Cache Ready Data
		$cacheData = implode("|", $data);

		// Update Cache File
		$reqFile = $this->_playersCachePath . strtolower($this->_request) . '.cache';
		$fp = fopen($reqFile, 'w+');
		fwrite($fp, $cacheData);
		fclose($fp);
	}

	public function data() {
		if(!check_value($this->_type)) throw new Exception(lang('error_21',true));
		if(!check_value($this->_request)) throw new Exception(lang('error_21',true));
		$this->checkCache();
		return(explode("|", $this->_fileData));
	}

}