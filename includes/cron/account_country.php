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

// File Name
$file_name = basename(__FILE__);

// Load database connections
$accountdb = Connection::Database('Account');
$webDbName = config('SQL_DB_WEB_NAME', true); // e.g., "CabalEngine"

// Build fully qualified table name for the country table
$countryTable = $webDbName . ".dbo." . CABALENGINE_ACCOUNT_COUNTRY;

// Fetch up to 40 accounts without a country entry
$sql = "
    SELECT TOP 40 *
    FROM " . _TBL_MS_ . "
    WHERE " . _CLMN_MS_MEMBID_ . " COLLATE Chinese_Taiwan_Stroke_CI_AS NOT IN (
        SELECT [account] FROM " . $countryTable . "
    )
    AND " . _CLMN_MS_IP_ . " IS NOT NULL
";
$accountList = $accountdb->query_fetch($sql);

// Process each account and assign a country based on IP
if(is_array($accountList)) {
    $Account = new Account();
    foreach($accountList as $row) {
        $countryCode = getCountryCodeFromIp($row[_CLMN_MS_IP_]);
        if(!check_value($countryCode)) continue;
        $Account->setAccount($row[_CLMN_MS_MEMBID_]);
        $Account->setCountry($countryCode);
        $Account->insertAccountCountry();
    }
}

// Update cron job last run time
updateCronLastRun($file_name);