<?php
/**
 * CabalEngine CMS
 *
 * @version 1.2.0
 * @Mod author Rooan Oliveira / Original author Lautaro Angelico <http://lautaroangelico.com/>
 * @copyright (c) 2013-2019 Lautaro Angelico, All Rights Reserved
 *
 * Licensed under the MIT license
 * http://opensource.org/licenses/MIT
 */

// File Name
$file_name = basename(__FILE__);

// load databases
$web = Connection::Database('cabalengine');
$account = Connection::Database('Account');
$server01 = Connection::Database('Server01');

# total accounts
$totalAccounts = 0;
$countAccounts = $account->query_fetch_single("SELECT COUNT(*) as totalAccounts FROM "._TBL_MI_);
if(is_array($countAccounts)) $totalAccounts = $countAccounts['totalAccounts'];
$serverInfo[] = $totalAccounts;

# total characters
$totalCharacters = 0;
$countCharacters = $server01->query_fetch_single("SELECT COUNT(*) as totalCharacters FROM "._TBL_CHR_);
if(is_array($countCharacters)) $totalCharacters = $countCharacters['totalCharacters'];
$serverInfo[] = $totalCharacters;

# total guilds
$totalGuilds = 0;
$countGuilds = $server01->query_fetch_single("SELECT COUNT(*) as totalGuilds FROM "._TBL_GUILD_);
if(is_array($countGuilds)) $totalGuilds = $countGuilds['totalGuilds'];
$serverInfo[] = $totalGuilds;

# total online
$totalOnline = 0;
$countOnline = $account->query_fetch_single("SELECT COUNT(*) as totalOnline FROM "._TBL_MS_." WHERE "._CLMN_CONNSTAT_." = 1");
if(is_array($countOnline)) $totalOnline = $countOnline['totalOnline'];
$serverInfo[] = $totalOnline;

if(is_array($serverInfo)) {
	$cacheDATA = implode("|",$serverInfo);
	UpdateCache('server_info.cache',$cacheDATA);
}

// UPDATE CRON
updateCronLastRun($file_name);