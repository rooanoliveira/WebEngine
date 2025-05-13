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

class common
{

	protected $_serverFiles = 'ep33';
	protected $_debug = false;

	protected $_blockedIpCache = 'blocked_ip.cache';

	protected $web; #CabalEngine
	protected $account; #Account
	protected $cabalcash; #CabalCash
	protected $cabalguild; #CabalGuild
	protected $cabalcoupon; #Coupon
	protected $cabalevent; #Event
	protected $cabaleventdata; #EventData
	protected $cabalgamesvc; #GameSvc
	protected $cabalitemshop; #ItemShop
	protected $cabalnetcafebilling; #NetcafeBilling
	protected $cabalserver01; #Server01
	protected $cabaltpointshop; #TPointShop

	function __construct()
	{

		// load databases
		$this->web = Connection::Database('CabalEngine');
		$this->account = Connection::Database('Account');
		$this->cabalcash = Connection::Database('CabalCash');
		$this->cabalguild = Connection::Database('CabalGuild');
		$this->cabalcoupon = Connection::Database('Coupon');
		$this->cabalevent = Connection::Database('Event');
		$this->cabaleventdata = Connection::Database('EventData');
		$this->cabalgamesvc = Connection::Database('GameSvc');
		$this->cabalitemshop = Connection::Database('ItemShop');
		$this->cabalnetcafebilling = Connection::Database('NetcafeBilling');
		$this->cabalserver01 = Connection::Database('Server01');
		$this->cabaltpointshop = Connection::Database('TPointShop');

		// configs
		$this->_serverFiles = config('server_files', true);
		$this->_debug = config('error_reporting', true);
	}

	public function emailExists($email)
	{
		if (!Validator::Email($email)) return;
		$result = $this->account->query_fetch_single("SELECT * FROM " . _TBL_MI_ . " WHERE " . _CLMN_EMAIL_ . " = ?", array($email));
		if (is_array($result)) return true;
		return;
	}

	public function userExists($username)
	{
		if (!Validator::UsernameLength($username)) return;
		if (!Validator::AlphaNumeric($username)) return;
		$result = $this->account->query_fetch_single("SELECT * FROM " . _TBL_MI_ . " WHERE " . _CLMN_USERNM_ . " = ?", array($username));
		if (is_array($result)) return true;
		return;
	}

	public function validateUser($username, $password)
	{
		if (!Validator::UsernameLength($username)) return;
		if (!Validator::AlphaNumeric($username)) return;
		if (!Validator::PasswordLength($password)) return;

		$data = array(
			'username' => $username,
			'password' => $password
		);
		$query = "SELECT * FROM cabal_auth_table WHERE ID = :username AND pwdcompare(:password, Password) =1";

		$result = $this->account->query_fetch_single($query, $data);
		if (is_array($result)) return true;
		return false;
	}

	public function retrieveUserID($username)
	{
		if (!Validator::UsernameLength($username)) return;
		if (!Validator::AlphaNumeric($username)) return;
		$result = $this->account->query_fetch_single("SELECT " . _CLMN_MEMBID_ . " FROM " . _TBL_MI_ . " WHERE " . _CLMN_USERNM_ . " = ?", array($username));
		if (is_array($result)) return $result[_CLMN_MEMBID_];
		return;
	}

	public function retrieveUserIDbyEmail($email)
	{
		if (!$this->emailExists($email)) return;
		$result = $this->account->query_fetch_single("SELECT " . _CLMN_MEMBID_ . " FROM " . _TBL_MI_ . " WHERE " . _CLMN_EMAIL_ . " = ?", array($email));
		if (is_array($result)) return $result[_CLMN_MEMBID_];
		return;
	}

	public function accountInformation($id)
	{
		if (!Validator::Number($id)) return;
		$result = $this->account->query_fetch_single("SELECT * FROM " . _TBL_MI_ . " WHERE " . _CLMN_MEMBID_ . " = ?", array($id));
		if (is_array($result)) return $result;
		return;
	}
	// !NEED CHANGE FOR CABAL ENGINE
	public function accountOnline($username)
	{
		if (!Validator::UsernameLength($username)) return;
		if (!Validator::AlphaNumeric($username)) return;
		$result = $this->account->query_fetch_single("SELECT " . _CLMN_CONNSTAT_ . " FROM " . _TBL_MS_ . " WHERE " . _CLMN_USERNM_ . " = ? AND " . _CLMN_CONNSTAT_ . " = ?", array($username, 1));
		if (is_array($result)) return true;
		return;
	}

	public function changePassword($id, $username, $new_password)
	{
		if (!Validator::UnsignedNumber($id)) return;
		if (!Validator::UsernameLength($username)) return;
		if (!Validator::AlphaNumeric($username)) return;
		if (!Validator::PasswordLength($new_password)) return;

		$data = array(
			'userid' => $id,
			'password' => $new_password
		);

		$query = "UPDATE " . _TBL_MI_ . " SET " . _CLMN_PASSWD_ . " = pwdencrypt(:password) WHERE " . _CLMN_MEMBID_ . " = :userid";

		$result = $this->account->query($query, $data);
		if ($result) return true;
		return;
	}

	public function addPasswordChangeRequest($userid, $new_password, $auth_code)
	{
		if (!check_value($userid)) return;
		if (!check_value($new_password)) return;
		if (!check_value($auth_code)) return;
		if (!Validator::PasswordLength($new_password)) return;

		$data = array(
			$userid,
			$new_password,
			$auth_code,
			time()
		);

		$query = "INSERT INTO " . WEBENGINE_PASSCHANGE_REQUEST . " (user_id,new_password,auth_code,request_date) VALUES (?, ?, ?, ?)";
		$result = $this->account->query($query, $data);
		if ($result) return true;
		return;
	}

	public function hasActivePasswordChangeRequest($userid)
	{
		if (!check_value($userid)) return;

		$result = $this->account->query_fetch_single("SELECT * FROM " . WEBENGINE_PASSCHANGE_REQUEST . " WHERE user_id = ?", array($userid));
		if (!is_array($result)) return;

		$configs = loadConfigurations('usercp.mypassword');
		if (!is_array($configs)) return;

		$request_timeout = $configs['change_password_request_timeout'] * 3600;
		$request_date = $result['request_date'] + $request_timeout;
		if (time() < $request_date) return true;

		$this->removePasswordChangeRequest($userid);
		return;
	}

	public function removePasswordChangeRequest($userid)
	{
		$result = $this->account->query("DELETE FROM " . WEBENGINE_PASSCHANGE_REQUEST . " WHERE user_id = ?", array($userid));
		if ($result) return true;
		return;
	}

	public function generatePasswordChangeVerificationURL($user_id, $auth_code)
	{
		$build_url = __BASE_URL__;
		$build_url .= 'verifyemail/';
		$build_url .= '?op='; // operation
		$build_url .= 1;
		$build_url .= '&uid=';
		$build_url .= $user_id;
		$build_url .= '&ac=';
		$build_url .= $auth_code;
		return $build_url;
	}

	public function blockAccount($userid)
	{
		if (!check_value($userid)) return;
		if (!Validator::UnsignedNumber($userid)) return;
		$result = $this->account->query("UPDATE " . _TBL_MI_ . " SET " . _CLMN_BLOCCODE_ . " = ? WHERE " . _CLMN_MEMBID_ . " = ?", array(1, $userid));
		if ($result) return true;
		return;
	}

	public function paypal_transaction($transaction_id, $user_id, $payment_amount, $paypal_email, $order_id)
	{
		if (!check_value($transaction_id)) return;
		if (!check_value($user_id)) return;
		if (!check_value($payment_amount)) return;
		if (!check_value($paypal_email)) return;
		if (!check_value($order_id)) return;
		if (!Validator::UnsignedNumber($user_id)) return;

		$data = array(
			$transaction_id,
			$user_id,
			$payment_amount,
			$paypal_email,
			time(),
			1,
			$order_id
		);

		$query = "INSERT INTO " . WEBENGINE_PAYPAL_TRANSACTIONS . " (transaction_id, user_id, payment_amount, paypal_email, transaction_date, transaction_status, order_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
		$result = $this->account->query($query, $data);
		if ($result) return true;
		return;
	}

	public function paypal_transaction_reversed_updatestatus($order_id)
	{
		if (check_value($order_id)) return;
		$result = $this->account->query("UPDATE " . WEBENGINE_PAYPAL_TRANSACTIONS . " SET transaction_status = ? WHERE order_id = ?", array(0, $order_id));
		if ($result) return true;
		return;
	}

	/*
	public function retrieveAccountIPs($username) {
		if(!check_value($username)) return;
		if(!$this->userExists($username)) return;
		switch($this->_serverFiles) {
			case 'ep33':
				$result = $this->account->query_fetch("SELECT "._CLMN_LOGEX_IP_." FROM "._TBL_LOGEX_." WHERE "._CLMN_LOGEX_ACCID_." = ? GROUP BY "._CLMN_LOGEX_IP_."", array($username));
				if(is_array($result)) return $result;
				return;
			default:
				return;
		}
	}
*/

	public function generateAccountRecoveryCode($userid, $username)
	{
		if (!check_value($userid)) return;
		if (!check_value($username)) return;
		return md5($userid . $username . date("m-d-Y"));
	}

	public function isIpBlocked($ip)
	{
		if (!Validator::Ip($ip)) return true;
		$result = $this->account->query_fetch_single("SELECT * FROM " . WEBENGINE_BLOCKED_IP . " WHERE block_ip = ?", array($ip));
		if (!is_array($result)) return;
		return true;
	}

	public function blockIpAddress($ip, $user)
	{
		if (!check_value($user)) return;
		if (!Validator::Ip($ip)) return;
		if ($this->isIpBlocked($ip)) return;
		$result = $this->account->query("INSERT INTO " . WEBENGINE_BLOCKED_IP . " (block_ip,block_by,block_date) VALUES (?,?,?)", array($ip, $user, time()));
		if (!$result) return;

		$this->_updateBlockedIpCache();
		return true;
	}

	public function retrieveBlockedIPs()
	{
		return $this->account->query_fetch("SELECT * FROM " . WEBENGINE_BLOCKED_IP . " ORDER BY id DESC");
	}

	public function unblockIpAddress($id)
	{
		if (!check_value($id)) return;
		$result = $this->account->query("DELETE FROM " . WEBENGINE_BLOCKED_IP . " WHERE id = ?", array($id));
		if (!$result) return;

		$this->_updateBlockedIpCache();
		return true;
	}

	protected function _updateBlockedIpCache()
	{
		$blockedIps = $this->retrieveBlockedIPs();
		if (!is_array($blockedIps)) {
			updateCacheFile($this->_blockedIpCache, "");
			return;
		}
		foreach ($blockedIps as $row) {
			$ipList[] = $row['block_ip'];
		}
		if (!is_array($ipList)) return;
		$cacheData = encodeCache($ipList);
		updateCacheFile($this->_blockedIpCache, $cacheData);
	}

	public function updateEmail($userid, $newemail)
	{
		if (!Validator::UnsignedNumber($userid)) return;
		if (!Validator::Email($newemail)) return;
		$result = $this->account->query("UPDATE " . _TBL_MI_ . " SET " . _CLMN_EMAIL_ . " = ? WHERE " . _CLMN_MEMBID_ . " = ?", array($newemail, $userid));
		if ($result) return true;
		return;
	}
}
