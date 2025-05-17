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

class Connection
{

	public static function Database($database = '')
	{
		switch ($database) {
			case 'CabalEngine':
				$db = new dB(self::_config('SQL_DB_HOST'), self::_config('SQL_DB_PORT'), self::_config('SQL_DB_WEB_NAME'), self::_config('SQL_DB_USER'), self::_config('SQL_DB_PASS'), self::_config('SQL_PDO_DRIVER'));
				if ($db->dead) {
					if (self::_config('error_reporting')) {
						throw new Exception($db->error);
					}
					throw new Exception('Connection to database failed (' . self::_config('SQL_DB_NAME') . ')');
				}
				return $db;
				break;
			case 'Account':
				$db = new dB(self::_config('SQL_DB_HOST'), self::_config('SQL_DB_PORT'), self::_config('SQL_DB_ACCOUNT_NAME'), self::_config('SQL_DB_USER'), self::_config('SQL_DB_PASS'), self::_config('SQL_PDO_DRIVER'));
				if ($db->dead) {
					if (self::_config('error_reporting')) {
						throw new Exception($db->error);
					}
					throw new Exception('Connection to database failed (' . self::_config('SQL_DB_NAME') . ')');
				}
				return $db;
				break;
			case 'CabalCash':
				$db = new dB(self::_config('SQL_DB_HOST'), self::_config('SQL_DB_PORT'), self::_config('SQL_DB_CABALCASH_NAME'), self::_config('SQL_DB_USER'), self::_config('SQL_DB_PASS'), self::_config('SQL_PDO_DRIVER'));
				if ($db->dead) {
					if (self::_config('error_reporting')) {
						throw new Exception($db->error);
					}
					throw new Exception('Connection to database failed (' . self::_config('SQL_DB_NAME') . ')');
				}
				return $db;
				break;
			case 'CabalGuild':
				$db = new dB(self::_config('SQL_DB_HOST'), self::_config('SQL_DB_PORT'), self::_config('SQL_DB_CABALGUILD_NAME'), self::_config('SQL_DB_USER'), self::_config('SQL_DB_PASS'), self::_config('SQL_PDO_DRIVER'));
				if ($db->dead) {
					if (self::_config('error_reporting')) {
						throw new Exception($db->error);
					}
					throw new Exception('Connection to database failed (' . self::_config('SQL_DB_NAME') . ')');
				}
				return $db;
				break;
			case 'Coupon':
				$db = new dB(self::_config('SQL_DB_HOST'), self::_config('SQL_DB_PORT'), self::_config('SQL_DB_CABALCOUPON_NAME'), self::_config('SQL_DB_USER'), self::_config('SQL_DB_PASS'), self::_config('SQL_PDO_DRIVER'));
				if ($db->dead) {
					if (self::_config('error_reporting')) {
						throw new Exception($db->error);
					}
					throw new Exception('Connection to database failed (' . self::_config('SQL_DB_NAME') . ')');
				}
				return $db;
				break;
			case 'Event':
				$db = new dB(self::_config('SQL_DB_HOST'), self::_config('SQL_DB_PORT'), self::_config('SQL_DB_CABALEVENT_NAME'), self::_config('SQL_DB_USER'), self::_config('SQL_DB_PASS'), self::_config('SQL_PDO_DRIVER'));
				if ($db->dead) {
					if (self::_config('error_reporting')) {
						throw new Exception($db->error);
					}
					throw new Exception('Connection to database failed (' . self::_config('SQL_DB_NAME') . ')');
				}
				return $db;
				break;
			case 'EventData':
				$db = new dB(self::_config('SQL_DB_HOST'), self::_config('SQL_DB_PORT'), self::_config('SQL_DB_CABALEVENTDATA_NAME'), self::_config('SQL_DB_USER'), self::_config('SQL_DB_PASS'), self::_config('SQL_PDO_DRIVER'));
				if ($db->dead) {
					if (self::_config('error_reporting')) {
						throw new Exception($db->error);
					}
					throw new Exception('Connection to database failed (' . self::_config('SQL_DB_NAME') . ')');
				}
				return $db;
				break;
			case 'GameSvc':
				$db = new dB(self::_config('SQL_DB_HOST'), self::_config('SQL_DB_PORT'), self::_config('SQL_DB_CABALGAMESVC_NAME'), self::_config('SQL_DB_USER'), self::_config('SQL_DB_PASS'), self::_config('SQL_PDO_DRIVER'));
				if ($db->dead) {
					if (self::_config('error_reporting')) {
						throw new Exception($db->error);
					}
					throw new Exception('Connection to database failed (' . self::_config('SQL_DB_NAME') . ')');
				}
				return $db;
				break;
			case 'ItemShop':
				$db = new dB(self::_config('SQL_DB_HOST'), self::_config('SQL_DB_PORT'), self::_config('SQL_DB_CABALITEMSHOP_NAME'), self::_config('SQL_DB_USER'), self::_config('SQL_DB_PASS'), self::_config('SQL_PDO_DRIVER'));
				if ($db->dead) {
					if (self::_config('error_reporting')) {
						throw new Exception($db->error);
					}
					throw new Exception('Connection to database failed (' . self::_config('SQL_DB_NAME') . ')');
				}
				return $db;
				break;
			case 'NetcafeBilling':
				$db = new dB(self::_config('SQL_DB_HOST'), self::_config('SQL_DB_PORT'), self::_config('SQL_DB_CABALNETCAFEBILLING_NAME'), self::_config('SQL_DB_USER'), self::_config('SQL_DB_PASS'), self::_config('SQL_PDO_DRIVER'));
				if ($db->dead) {
					if (self::_config('error_reporting')) {
						throw new Exception($db->error);
					}
					throw new Exception('Connection to database failed (' . self::_config('SQL_DB_NAME') . ')');
				}
				return $db;
				break;
			case 'Server01':
				$db = new dB(self::_config('SQL_DB_HOST'), self::_config('SQL_DB_PORT'), self::_config('SQL_DB_CABALSERVER01_NAME'), self::_config('SQL_DB_USER'), self::_config('SQL_DB_PASS'), self::_config('SQL_PDO_DRIVER'));
				if ($db->dead) {
					if (self::_config('error_reporting')) {
						throw new Exception($db->error);
					}
					throw new Exception('Connection to database failed (' . self::_config('SQL_DB_NAME') . ')');
				}
				return $db;
				break;
			case 'TPointShop':
				$db = new dB(self::_config('SQL_DB_HOST'), self::_config('SQL_DB_PORT'), self::_config('SQL_DB_CABALTPOINTSHOP_NAME'), self::_config('SQL_DB_USER'), self::_config('SQL_DB_PASS'), self::_config('SQL_PDO_DRIVER'));
				if ($db->dead) {
					if (self::_config('error_reporting')) {
						throw new Exception($db->error);
					}
					throw new Exception('Connection to database failed (' . self::_config('SQL_DB_NAME') . ')');
				}
				return $db;
				break;
			default:
				return;
		}
	}

	private static function _config($config)
	{
		$cabalengineConfig = cabalengineConfigs();
		if (!is_array($cabalengineConfig)) return;
		if (!array_key_exists($config, $cabalengineConfig)) return;
		return $cabalengineConfig[$config];
	}
}
