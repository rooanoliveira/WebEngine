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

// load database connections
$database = Connection::Database('CabalEngine');
$webDB  = config('SQL_DB_WEB_NAME', true);
$characterDB = config('SQL_DB_CABALSERVER01_NAME', true);

// fully qualified table names
$countryTable   = $webDB . ".dbo." . CABALENGINE_ACCOUNT_COUNTRY;
$characterTable = $characterDB    . ".dbo." . _TBL_CHR_;

// build and run the query
// note: in SQL Server integer division truncates automatically
$query = "
    SELECT
    t2." . _CLMN_CHR_NAME_ . "   AS character_name,
    t1.country AS country
    FROM {$countryTable} AS t1
    INNER JOIN {$characterTable} AS t2
    ON t1.account = (t2." . _CLMN_CHR_IDX_ . " / 16)
";

$charactersCountryList = $database->query_fetch($query);

// re‑index into [characterName => country]
$result = [];
if (is_array($charactersCountryList)) {
	foreach ($charactersCountryList as $row) {
		$result[$row[_CLMN_CHR_NAME_]] = $row['country'];
	}
}

// encode and write cache
$cacheData = encodeCache($result);
updateCacheFile('character_country.cache', $cacheData);

// Update this cron’s last‐run timestamp
updateCronLastRun($file_name);
