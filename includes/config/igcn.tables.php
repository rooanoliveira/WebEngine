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

define('_TBL_MI_', 'MEMB_INFO');
	define('_CLMN_USERNM_', 'memb___id');
	define('_CLMN_PASSWD_', 'memb__pwd');
	define('_CLMN_MEMBID_', 'memb_guid');
	define('_CLMN_EMAIL_', 'mail_addr');
	define('_CLMN_BLOCCODE_', 'bloc_code');
	define('_CLMN_SNONUMBER_', 'sno__numb');
	define('_CLMN_MEMBNAME_', 'memb_name');
	define('_CLMN_CTLCODE_', 'ctl1_code');

define('_TBL_MS_', 'MEMB_STAT');
	define('_CLMN_CONNSTAT_', 'ConnectStat');
	define('_CLMN_MS_MEMBID_', 'memb___id');
	define('_CLMN_MS_GS_', 'ServerName');
	define('_CLMN_MS_IP_', 'IP');
	
define('_TBL_AC_', 'AccountCharacter');
	define('_CLMN_AC_ID_', 'Id');
	define('_CLMN_GAMEIDC_', 'GameIDC');
	define('_CLMN_WHEXPANSION_', 'WarehouseExpansion');
	define('_CLMN_SECCODE_', 'SecCode');
	
define('_TBL_CHR_', 'Character');
	define('_CLMN_CHR_NAME_', 'Name');
	define('_CLMN_CHR_ACCID_', 'AccountID');
	define('_CLMN_CHR_CLASS_', 'Class');
	define('_CLMN_CHR_ZEN_', 'Money');
	define('_CLMN_CHR_LVL_', 'cLevel');
	define('_CLMN_CHR_RSTS_', 'RESETS');
	define('_CLMN_CHR_GRSTS_', 'GrandResets');
	define('_CLMN_CHR_LVLUP_POINT_', 'LevelUpPoint');
	define('_CLMN_CHR_STAT_STR_', 'Strength');
	define('_CLMN_CHR_STAT_AGI_', 'Dexterity');
	define('_CLMN_CHR_STAT_VIT_', 'Vitality');
	define('_CLMN_CHR_STAT_ENE_', 'Energy');
	define('_CLMN_CHR_STAT_CMD_', 'Leadership');
	define('_CLMN_CHR_PK_KILLS_', 'PkCount');
	define('_CLMN_CHR_PK_LEVEL_', 'PkLevel');
	define('_CLMN_CHR_PK_TIME_', 'PkTime');
	define('_CLMN_CHR_MAP_', 'MapNumber');
	define('_CLMN_CHR_MAP_X_', 'MapPosX');
	define('_CLMN_CHR_MAP_Y_', 'MapPosY');
	define('_CLMN_CHR_MAGIC_L_', 'MagicList');
	define('_CLMN_CHR_INV_', 'Inventory');
	define('_CLMN_CHR_QUEST_', 'Quest');

define('_TBL_MASTERLVL_', 'Character');
	define('_CLMN_ML_NAME_', 'Name');
	define('_CLMN_ML_LVL_', 'mLevel');
	define('_CLMN_ML_EXP_', 'mlExperience');
	define('_CLMN_ML_NEXP_', 'mlNextExp');
	define('_CLMN_ML_POINT_', 'mlPoint');
	define('_CLMN_ML_I4SP_', 'i4thSkillPoint');
	
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

define('_TBL_CH_', 'ConnectionHistory');
	define('_CLMN_CH_ID_', 'ID');
	define('_CLMN_CH_ACCID_', 'AccountID');
	define('_CLMN_CH_SRVNM_', 'ServerName');
	define('_CLMN_CH_IP_', 'IP');
	define('_CLMN_CH_DATE_', 'Date');
	define('_CLMN_CH_STATE_', 'State');
	define('_CLMN_CH_HWID_', 'HWID');
	
/*
 * custom: character_class
 */
$custom['character_class'] = array(
	0 => array('Dark Wizard', 'DW', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
	1 => array('Soul Master', 'SM', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
	3 => array('Grand Master', 'GM', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
	7 => array('Soul Wizard', 'SW', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
	15 => array('Darkness Wizard', 'DSW', 'dw.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 0),
	16 => array('Dark Knight', 'DK', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
	17 => array('Blade Knight', 'BK', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
	19 => array('Blade Master', 'BM', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
	23 => array('Dragon Knight', 'DGK', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
	31 => array('Ignition Knight', 'IGK', 'dk.jpg', 'base_stats' => array('str' => 28, 'agi' => 20, 'vit' => 25, 'ene' => 10, 'cmd' => 0), 'class_group' => 16),
	32 => array('Fairy Elf', 'ELF', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
	33 => array('Muse Elf', 'ME', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
	35 => array('High Elf', 'HE', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
	39 => array('Noble Elf', 'NE', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
	47 => array('Royal Elf', 'RYE', 'elf.jpg', 'base_stats' => array('str' => 22, 'agi' => 25, 'vit' => 15, 'ene' => 20, 'cmd' => 0), 'class_group' => 32),
	48 => array('Magic Gladiator', 'MG', 'mg.jpg', 'base_stats' => array('str' => 26, 'agi' => 26, 'vit' => 26, 'ene' => 16, 'cmd' => 0), 'class_group' => 48),
	50 => array('Duel Master', 'DM', 'mg.jpg', 'base_stats' => array('str' => 26, 'agi' => 26, 'vit' => 26, 'ene' => 16, 'cmd' => 0), 'class_group' => 48),
	54 => array('Magic Knight', 'MK', 'mg.jpg', 'base_stats' => array('str' => 26, 'agi' => 26, 'vit' => 26, 'ene' => 16, 'cmd' => 0), 'class_group' => 48),
	62 => array('Duple Knight', 'DPK', 'mg.jpg', 'base_stats' => array('str' => 26, 'agi' => 26, 'vit' => 26, 'ene' => 16, 'cmd' => 0), 'class_group' => 48),
	64 => array('Dark Lord', 'DL', 'dl.jpg', 'base_stats' => array('str' => 26, 'agi' => 20, 'vit' => 20, 'ene' => 15, 'cmd' => 25), 'class_group' => 64),
	66 => array('Lord Emperor', 'LE', 'dl.jpg', 'base_stats' => array('str' => 26, 'agi' => 20, 'vit' => 20, 'ene' => 15, 'cmd' => 25), 'class_group' => 64),
	70 => array('Empire Lord', 'EL', 'dl.jpg', 'base_stats' => array('str' => 26, 'agi' => 20, 'vit' => 20, 'ene' => 15, 'cmd' => 25), 'class_group' => 64),
	78 => array('Force Emperor', 'FCE', 'dl.jpg', 'base_stats' => array('str' => 26, 'agi' => 20, 'vit' => 20, 'ene' => 15, 'cmd' => 25), 'class_group' => 64),
	80 => array('Summoner', 'SUM', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
	81 => array('Bloody Summoner', 'BS', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
	83 => array('Dimension Master', 'DSM', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
	87 => array('Dimension Summoner', 'DS', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
	95 => array('Endless Summoner', 'ESUM', 'sum.jpg', 'base_stats' => array('str' => 21, 'agi' => 21, 'vit' => 18, 'ene' => 23, 'cmd' => 0), 'class_group' => 80),
	96 => array('Rage Fighter', 'RF', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
	98 => array('Fist Master', 'FM', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
	102 => array('Fist Blazer', 'FB', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
	110 => array('Bloody Fighter', 'BF', 'rf.jpg', 'base_stats' => array('str' => 32, 'agi' => 27, 'vit' => 25, 'ene' => 20, 'cmd' => 0), 'class_group' => 96),
	112 => array('Grow Lancer', 'GL', 'gl.jpg', 'base_stats' => array('str' => 30, 'agi' => 30, 'vit' => 25, 'ene' => 24, 'cmd' => 0), 'class_group' => 112),
	114 => array('Mirage Lancer', 'ML', 'gl.jpg', 'base_stats' => array('str' => 30, 'agi' => 30, 'vit' => 25, 'ene' => 24, 'cmd' => 0), 'class_group' => 112),
	118 => array('Shining Lancer', 'SL', 'gl.jpg', 'base_stats' => array('str' => 30, 'agi' => 30, 'vit' => 25, 'ene' => 24, 'cmd' => 0), 'class_group' => 112),
	126 => array('Arcane Lancer', 'AL', 'gl.jpg', 'base_stats' => array('str' => 30, 'agi' => 30, 'vit' => 25, 'ene' => 24, 'cmd' => 0), 'class_group' => 112),
	128 => array('Rune Mage', 'RW', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
	129 => array('Rune Spell Master', 'RSM', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
	131 => array('Grand Rune Master', 'GRM', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
	135 => array('Majestic Rune Wizard', 'MRW', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
	143 => array('Infinity Rune Wizard', 'IRW', 'rw.jpg', 'base_stats' => array('str' => 13, 'agi' => 18, 'vit' => 14, 'ene' => 40, 'cmd' => 0), 'class_group' => 128),
	144 => array('Slayer', 'SLR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
	145 => array('Royal Slayer', 'SLRR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
	147 => array('Master Slayer', 'MSLR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
	151 => array('Slaughterer', 'SLTR', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
	159 => array('Rogue Slayer', 'RS', 'sl.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 144),
	160 => array('Gun Crusher', 'GC', 'gc.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 160),
	161 => array('Gun Breaker', 'GB', 'gc.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 160),
	163 => array('Master Gun Breaker', 'MGB', 'gc.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 160),
	167 => array('Heist Gun Crusher', 'HGC', 'gc.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 160),
	175 => array('Magnus Gun Crusher', 'MGC', 'gc.jpg', 'base_stats' => array('str' => 28, 'agi' => 30, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 160),
	176 => array('Light Wizard', 'LIW', 'liw.jpg', 'base_stats' => array('str' => 19, 'agi' => 19, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 176),
	177 => array('Light Master', 'LIM', 'liw.jpg', 'base_stats' => array('str' => 19, 'agi' => 19, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 176),
	179 => array('Shining Wizard', 'SHW', 'liw.jpg', 'base_stats' => array('str' => 19, 'agi' => 19, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 176),
	183 => array('Luminous Wizard', 'LUW', 'liw.jpg', 'base_stats' => array('str' => 19, 'agi' => 19, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 176),
	191 => array('Glory Wizard', 'GLW', 'liw.jpg', 'base_stats' => array('str' => 19, 'agi' => 19, 'vit' => 15, 'ene' => 30, 'cmd' => 0), 'class_group' => 176),
	192 => array('Lemuria Mage', 'LEM', 'lem.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 19, 'ene' => 30, 'cmd' => 0), 'class_group' => 192),
	193 => array('Warmage', 'WAM', 'lem.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 19, 'ene' => 30, 'cmd' => 0), 'class_group' => 192),
	195 => array('Archmage', 'ARM', 'lem.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 19, 'ene' => 30, 'cmd' => 0), 'class_group' => 192),
	199 => array('Mystic Mage', 'MYM', 'lem.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 19, 'ene' => 30, 'cmd' => 0), 'class_group' => 192),
	207 => array('Battle Mage', 'BAM', 'lem.jpg', 'base_stats' => array('str' => 18, 'agi' => 18, 'vit' => 19, 'ene' => 30, 'cmd' => 0), 'class_group' => 192),
	208 => array('Illusion Knight', 'IK', 'ik.jpg', 'base_stats' => array('str' => 25, 'agi' => 28, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 208),
	209 => array('Mirage Knight', 'MIK', 'ik.jpg', 'base_stats' => array('str' => 25, 'agi' => 28, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 208),
	211 => array('Illusion Master', 'IM', 'ik.jpg', 'base_stats' => array('str' => 25, 'agi' => 28, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 208),
	215 => array('Mystic Knight', 'MYK', 'ik.jpg', 'base_stats' => array('str' => 25, 'agi' => 28, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 208),
	223 => array('Phantom Pain Knight', 'PPK', 'ik.jpg', 'base_stats' => array('str' => 25, 'agi' => 28, 'vit' => 15, 'ene' => 10, 'cmd' => 0), 'class_group' => 208),
	224 => array('Alchemist', 'ALC', 'alc.jpg', 'base_stats' => array('str' => 15, 'agi' => 20, 'vit' => 23, 'ene' => 15, 'cmd' => 0), 'class_group' => 224),
	225 => array('Alchemic Magician', 'ALMN', 'alc.jpg', 'base_stats' => array('str' => 15, 'agi' => 20, 'vit' => 23, 'ene' => 15, 'cmd' => 0), 'class_group' => 224),
	227 => array('Alchemic Master', 'ALMTR', 'alc.jpg', 'base_stats' => array('str' => 15, 'agi' => 20, 'vit' => 23, 'ene' => 15, 'cmd' => 0), 'class_group' => 224),
	231 => array('Alchemic Force', 'ALFC', 'alc.jpg', 'base_stats' => array('str' => 15, 'agi' => 20, 'vit' => 23, 'ene' => 15, 'cmd' => 0), 'class_group' => 224),
	239 => array('Creator', 'CRE', 'alc.jpg', 'base_stats' => array('str' => 15, 'agi' => 20, 'vit' => 23, 'ene' => 15, 'cmd' => 0), 'class_group' => 224),
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
 * custom: character_cmd
 * classes who use cmd stat
 */
$custom['character_cmd'] = array(64, 66, 70, 78);

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
	'Grand Duke' => array(0,0),
	'Duke' => array(1,4),
	'Marquis' => array(5,9),
	'Count' => array(10,29),
	'Viscount' => array(30,49),
	'Baron' => array(50,99),
	'Knight Commander' => array(100,199),
	'Superior Knight' => array(200,299)
);

/*
 * custom: map_list
 */
$custom['map_list'] = array(
	0 => 'Lorencia',
	1 => 'Dungeon',
	2 => 'Devias',
	3 => 'Noria',
	4 => 'Lost Tower',
	6 => 'Arena',
	7 => 'Atlans',
	8 => 'Tarkan',
	9 => 'Devil Square',
	10 => 'Icarus',
	11 => 'Blood Castle',
	12 => 'Blood Castle',
	13 => 'Blood Castle',
	14 => 'Blood Castle',
	15 => 'Blood Castle',
	16 => 'Blood Castle',
	17 => 'Blood Castle',
	18 => 'Chaos Castle',
	19 => 'Chaos Castle',
	20 => 'Chaos Castle',
	21 => 'Chaos Castle',
	22 => 'Chaos Castle',
	23 => 'Chaos Castle',
	24 => 'Kalima 1',
	25 => 'Kalima 2',
	26 => 'Kalima 3',
	27 => 'Kalima 4',
	28 => 'Kalima 5',
	29 => 'Kalima 6',
	30 => 'Valley of Loren',
	31 => 'Land of Trials',
	32 => 'Devil Square',
	33 => 'Aida',
	34 => 'Crywolf Fortress',
	36 => 'Kalima 7',
	37 => 'Kanturu',
	38 => 'Kanturu',
	39 => 'Kanturu',
	40 => 'Silent Map',
	41 => 'Balgass Barracks',
	42 => 'Balgass Refuge',
	45 => 'Illusion Temple',
	46 => 'Illusion Temple',
	47 => 'Illusion Temple',
	48 => 'Illusion Temple',
	49 => 'Illusion Temple',
	50 => 'Illusion Temple',
	51 => 'Elbeland',
	52 => 'Blood Castle',
	53 => 'Chaos Castle',
	56 => 'Swamp of Calmness',
	57 => 'Raklion',
	58 => 'Raklion Boss',
	62 => 'Santa\'s Village',
	63 => 'Vulcanus',
	64 => 'Duel Arena',
	65 => 'Doppelganger',
	66 => 'Doppelganger',
	67 => 'Doppelganger',
	68 => 'Doppelganger',
	69 => 'Imperial Guardian',
	70 => 'Imperial Guardian',
	71 => 'Imperial Guardian',
	72 => 'Imperial Guardian',
	79 => 'Loren Market',
	80 => 'Karutan 1',
	81 => 'Karutan 2',
	82 => 'Doppelganger',
	91 => 'Acheron',
	92 => 'Acheron',
	95 => 'Debenter',
	96 => 'Debenter',
	97 => 'Chaos Castle',
	98 => 'Ilusion Temple',
	99 => 'Ilusion Temple',
	100 => 'Uruk Mountain',
	101 => 'Uruk Mountain',
	102 => 'Tormented Square',
	103 => 'Tormented Square',
	104 => 'Tormented Square',
	105 => 'Tormented Square',
	106 => 'Tormented Square',
	110 => 'Nars',
	112 => 'Ferea',
	113 => 'Nixie Lake',
	114 => 'Quest Zone',
	115 => 'Labyrinth',
	116 => 'Deep Dungeon',
	117 => 'Deep Dungeon',
	118 => 'Deep Dungeon',
	119 => 'Deep Dungeon',
	120 => 'Deep Dungeon',
	121 => 'Quest Zone',
	122 => 'Swamp of Darkness',
	123 => 'Kubera Mine',
	124 => 'Kubera Mine',
	125 => 'Kubera Mine',
	126 => 'Kubera Mine',
	127 => 'Kubera Mine',
	128 => 'Atlans Abyss',
	129 => 'Atlans Abyss 2',
	130 => 'Atlans Abyss 3',
	131 => 'Scorched Canyon',
	132 => 'Crimson Flame Icarus',
	133 => 'Temple of Arnil',
	134 => 'Aida Gray',
	135 => 'Old Kethotum',
	136 => 'Burning Kethotum',
	137 => 'Kanturu Undergrounds',
	138 => 'Volcano Ignis',
	139 => 'Boss Battle',
	140 => 'Bloody Tarkan',
	141 => 'Tormenta Island',
	142 => 'Twisted Karutan',
	143 => 'Kardamahal Underground Temple',
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