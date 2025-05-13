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

define('_TBL_MI_', 'cabal_auth_table');
define('_CLMN_USERNM_', 'ID');
define('_CLMN_PASSWD_', 'Password');
define('_CLMN_MEMBID_', 'UserNum');
define('_CLMN_EMAIL_', 'Email');
define('_CLMN_BLOCCODE_', 'AuthType');
define('_CLMN_SNONUMBER_', 'UserValidation');
define('_CLMN_MEMBNAME_', 'UserName');
#	define('_CLMN_CTLCODE_', 'ctl1_code');

define('_TBL_MS_', 'cabal_auth_table');
define('_CLMN_CONNSTAT_', 'Login');
define('_CLMN_MS_MEMBID_', 'ID');
define('_CLMN_MS_GS_', 'ChannelIdx');
#	define('_CLMN_MS_IP_', 'LastIp');

define('_TBL_CHINI_', 'cabal_gms_ini_table');
define('_CLMN_CH_ID_', 'Channel');

define('_TBL_AC_', 'AccountCharacter');
define('_CLMN_AC_ID_', 'Id');
define('_CLMN_GAMEIDC_', 'GameIDC');
define('_CLMN_WHEXPANSION_', 'WarehouseExpansion');
define('_CLMN_SECCODE_', 'SecCode');

define('_TBL_CHR_', 'cabal_character_table');
define('_CLMN_CHR_NAME_', 'Name');
define('_CLMN_CHR_IDX_', 'CharacterIdx ');
#	define('_CLMN_CHR_ACCID_', 'AccountID');
define('_CLMN_CHR_CLASS_', 'Style');
define('_CLMN_CHR_ZEN_', 'Alz');
define('_CLMN_CHR_LVL_', 'LEV');
#	define('_CLMN_CHR_RSTS_', 'RESETS');
#	define('_CLMN_CHR_GRSTS_', 'GrandResets');
define('_CLMN_CHR_LVLUP_POINT_', 'PNT');
define('_CLMN_CHR_STAT_STR_', 'STR');
define('_CLMN_CHR_STAT_AGI_', 'DEX');
#	define('_CLMN_CHR_STAT_VIT_', 'Vitality');
define('_CLMN_CHR_STAT_ENE_', 'INT');
#	define('_CLMN_CHR_STAT_CMD_', 'Leadership');
#	define('_CLMN_CHR_PK_KILLS_', 'PkCount');
define('_CLMN_CHR_PK_LEVEL_', 'PKPenalty');
#	define('_CLMN_CHR_PK_TIME_', 'PkTime');
define('_CLMN_CHR_MAP_', 'WorldIdx');
#	define('_CLMN_CHR_MAP_X_', 'MapPosX');
#	define('_CLMN_CHR_MAP_Y_', 'MapPosY');
#	define('_CLMN_CHR_MAGIC_L_', 'MagicList');
#	define('_CLMN_CHR_INV_', 'Inventory');
#	define('_CLMN_CHR_QUEST_', 'Quest');

#define('_TBL_MASTERLVL_', 'Character');
#define('_CLMN_ML_NAME_', 'Name');
#define('_CLMN_ML_LVL_', 'mLevel');
#define('_CLMN_ML_EXP_', 'mlExperience');
#define('_CLMN_ML_NEXP_', 'mlNextExp');
#define('_CLMN_ML_POINT_', 'mlPoint');
#define('_CLMN_ML_I4SP_', 'i4thSkillPoint');

define('_TBL_MC_', 'MEMB_CREDITS');
define('_CLMN_MC_ID_', 'memb___id');
define('_CLMN_MC_CREDITS_', 'credits');
define('_CLMN_MC_USED_', 'used');

define('_TBL_MUCASTLE_DATA_', 'MuCastle_DATA');
define('_CLMN_MCD_GUILD_OWNER_', 'OWNER_GUILD');
define('_CLMN_MCD_MONEY_', 'MONEY');
define('_CLMN_MCD_TRC_', 'TAX_RATE_CHAOS');
define('_CLMN_MCD_TRS_', 'TAX_RATE_STORE');
define('_CLMN_MCD_THZ_', 'TAX_HUNT_ZONE');
define('_CLMN_MCD_OCCUPY_', 'CASTLE_OCCUPY');

define('_TBL_GUILD_', 'Guild');
define('_CLMN_GUILD_NAME_', 'G_Name');
define('_CLMN_GUILD_LOGO_', 'G_Mark');
define('_CLMN_GUILD_SCORE_', 'G_Score');
define('_CLMN_GUILD_MASTER_', 'G_Master');
define('_CLMN_GUILD_NOTICE_', 'G_Notice');
define('_CLMN_GUILD_UNION_', 'G_Union');

define('_TBL_GUILDMEMB_', 'GuildMember');
define('_CLMN_GUILDMEMB_CHAR_', 'Name');
define('_CLMN_GUILDMEMB_NAME_', 'G_Name');
define('_CLMN_GUILDMEMB_LEVEL_', 'G_Level');
define('_CLMN_GUILDMEMB_STATUS_', 'G_Status');

define('_TBL_MUCASTLE_RS_', 'MuCastle_REG_SIEGE');
define('_CLMN_MCRS_GUILD_', 'REG_SIEGE_GUILD');
define('_CLMN_MCRS_SEQNUM_', 'SEQ_NUM');

define('_TBL_MUCASTLE_SGL_', 'MuCastle_SIEGE_GUILDLIST');
define('_CLMN_MCSGL_MAPSRVGRP_', 'MAP_SVR_GROUP');
define('_CLMN_MCSGL_GNAME_', 'GUILD_NAME');
define('_CLMN_MCSGL_GID_', 'GUILD_ID');
define('_CLMN_MCSGL_GINV_', 'GUILD_INVOLVED');
define('_CLMN_MCSGL_GSCORE_', 'GUILD_SCORE');

define('_TBL_GENS_', 'IGC_Gens');
define('_CLMN_GENS_NAME_', 'Name');
define('_CLMN_GENS_TYPE_', 'Influence');
define('_CLMN_GENS_RANK_', 'Class');
define('_CLMN_GENS_POINT_', 'Points');

define('_TBL_VIP_', 'T_VIPList');
define('_CLMN_VIP_ID_', 'AccountID');
define('_CLMN_VIP_DATE_', 'Date');
define('_CLMN_VIP_TYPE_', 'Type');

#define('_TBL_CH_', 'cabal_time_log');
#	define('_CLMN_CH_ID_', 'ID');
define('_CLMN_CH_ACCID_', 'usernum');
#	define('_CLMN_CH_SRVNM_', 'ServerName');
define('_CLMN_CH_IP_', 'ipaddr');
define('_CLMN_CH_DATE_', 'logintime');
define('_CLMN_CH_DATEOUT_', 'logouttime');
#	define('_CLMN_CH_STATE_', 'State');
#	define('_CLMN_CH_HWID_', 'HWID');

/*
 * custom: character_class
 */
$custom['character_class'] = array(
	1 => array('Warrior', 'WA', 'wa.jpg', 'base_stats' => array('str' => 24, 'agi' => 8, 'ene' => 3), 'class_group' => 1),
	2 => array('Blader', 'BL', 'bl.jpg', 'base_stats' => array('str' => 16, 'agi' => 16, 'ene' => 3), 'class_group' => 2),
	3 => array('Wizard', 'WI', 'wi.jpg', 'base_stats' => array('str' => 3, 'agi' => 6, 'ene' => 26), 'class_group' => 3),
	4 => array('Force Archer', 'FA', 'fa.jpg', 'base_stats' => array('str' => 6, 'agi' => 12, 'ene' => 17), 'class_group' => 4),
	5 => array('Force Shielder', 'FS', 'fs.jpg', 'base_stats' => array('str' => 15, 'agi' => 9, 'ene' => 11), 'class_group' => 5),
	6 => array('Force Blader', 'FB', 'fb.jpg', 'base_stats' => array('str' => 12, 'agi' => 11, 'ene' => 12), 'class_group' => 6),
	7 => array('Gladiator', 'GL', 'gl.jpg', 'base_stats' => array('str' => 17, 'agi' => 13, 'ene' => 5), 'class_group' => 7),
	8 => array('Force Gunner', 'FG', 'fg.jpg', 'base_stats' => array('str' => 8, 'agi' => 11, 'ene' => 16), 'class_group' => 8),
	9 => array('Dark mage', 'DM', 'dm.jpg', 'base_stats' => array('str' => 3, 'agi' => 6, 'ene' => 26), 'class_group' => 9)
);

/*
 * custom: rankings_classgroup_filter
 */
$custom['rankings_classgroup_filter'] = array(
	0 => 'rankings_filter_2',
	16 => 'rankings_filter_3',
	32 => 'rankings_filter_4',
	48 => 'rankings_filter_5',
	64 => 'rankings_filter_6',
	80 => 'rankings_filter_7',
	96 => 'rankings_filter_8',
	112 => 'rankings_filter_9',
	128 => 'rankings_filter_10',
	144 => 'rankings_filter_11',
	160 => 'rankings_filter_12',
	176 => 'rankings_filter_13',
	192 => 'rankings_filter_14',
	208 => 'rankings_filter_15',
	224 => 'rankings_filter_16',
);

/*
 * custom: gens_ranks
 */
$custom['nation_name'] = array(
	0 => 'Neutral',
	1 => 'Capella',
	2 => 'Procyon'
);

/*
 * custom: gens_ranks
 */
$custom['gens_ranks'] = array(
	10000 => 'Knight',
	6000 => 'Guard',
	3000 => 'Officer',
	1500 => 'Lieutenant',
	500 => 'Sergeant',
	499 => 'Private'
);

/*
 * custom: gens_ranks_leadership
 */
$custom['gens_ranks_leadership'] = array(
	'Grand Duke' => array(0, 0),
	'Duke' => array(1, 4),
	'Marquis' => array(5, 9),
	'Count' => array(10, 29),
	'Viscount' => array(30, 49),
	'Baron' => array(50, 99),
	'Knight Commander' => array(100, 199),
	'Superior Knight' => array(200, 299)
);

/*
 * custom: map_list
 */
$custom['map_list'] = array(
	1 => 'Blood Ice',
	2 => 'Desert Scream',
	3 => 'Green Dispair',
	4 => 'Port Lux',
	5 => 'Fort. Ruin',
	6 => 'Undead Ground',
	7 => 'Forgotten Temple',
	8 => 'Lakeside',
	9 => 'Mutant Forest',
	10 => 'Pontus Ferrum',
	11 => 'Porta Inferno',
	12 => 'Arcane Trace',
	13 => 'Senillinea',
);

/*
 * custom: pk_level
 */
$custom['pk_level'] = array(
	0 => 'Normal',
	1 => 'Hero',
	2 => 'Hero',
	3 => 'Commoner',
	4 => 'Warning',
	5 => 'Murder',
	6 => 'Outlaw',
);
