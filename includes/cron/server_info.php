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
$web       = Connection::Database('cabalengine');
$account   = Connection::Database('Account');
$server01  = Connection::Database('Server01');

$serverInfo = [];

// total accounts
$countAccounts = $account->query_fetch_single(
	"SELECT COUNT(*) as totalAccounts FROM " . _TBL_MI_
);
$totalAccounts = is_array($countAccounts) ? (int)$countAccounts['totalAccounts'] : 0;
$serverInfo[] = $totalAccounts;

// total characters
$countCharacters = $server01->query_fetch_single(
	"SELECT COUNT(*) as totalCharacters FROM " . _TBL_CHR_
);
$totalCharacters = is_array($countCharacters) ? (int)$countCharacters['totalCharacters'] : 0;
$serverInfo[] = $totalCharacters;

// total guilds
$countGuilds = $server01->query_fetch_single(
	"SELECT COUNT(*) as totalGuilds FROM " . _TBL_GUILD_
);
$totalGuilds = is_array($countGuilds) ? (int)$countGuilds['totalGuilds'] : 0;
$serverInfo[] = $totalGuilds;

// total online
$countOnline = $account->query_fetch_single(
	"SELECT COUNT(*) as totalOnline FROM " . _TBL_MS_ . " WHERE " . _CLMN_CONNSTAT_ . " = 1"
);
$totalOnline = is_array($countOnline) ? (int)$countOnline['totalOnline'] : 0;
$serverInfo[] = $totalOnline;

// total by nation
$countNation = $server01->query_fetch_single(
	"SELECT
        SUM(CASE WHEN " . _CLMN_CHR_NATION_ . " = 0 THEN 1 ELSE 0 END) AS NeutralCount,
        SUM(CASE WHEN " . _CLMN_CHR_NATION_ . " = 1 THEN 1 ELSE 0 END) AS CapellaCount,
        SUM(CASE WHEN " . _CLMN_CHR_NATION_ . " = 2 THEN 1 ELSE 0 END) AS ProcyonCount
	FROM " . _TBL_CHR_ . "
    "
);
if (is_array($countNation)) {
	$totalNeutral  = (int)$countNation['NeutralCount'];
	$totalCapella  = (int)$countNation['CapellaCount'];
	$totalProcyon  = (int)$countNation['ProcyonCount'];
} else {
	$totalNeutral = $totalCapella = $totalProcyon = 0;
}
$serverInfo[] = $totalNeutral;
$serverInfo[] = $totalCapella;
$serverInfo[] = $totalProcyon;

// write cache
if (is_array($serverInfo)) {
	$cacheDATA = implode("|", $serverInfo);
	UpdateCache('server_info.cache', $cacheDATA);
}

// UPDATE CRON
updateCronLastRun($file_name);
