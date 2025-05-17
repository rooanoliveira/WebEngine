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
?>
<h1 class="page-header">Ban Account</h1>
<?php
	$dbweb = $web;
	$dbaccount = $account;

	// Add ban system cron if doesn't exist
	$banCron = "INSERT INTO ".CABALENGINE_CRON." (cron_name, cron_description, cron_file_run, cron_run_time, cron_status, cron_protected, cron_file_md5) VALUES ('Ban System', 'Scheduled task to lift temporal bans', 'temporal_bans.php', '3600', 1, 1, '1a3787c5179afddd1bfb09befda3d1c7')";
	$checkBanCron = $dbweb->query_fetch_single("SELECT * FROM ".CABALENGINE_CRON." WHERE cron_file_run = ?", array("temporal_bans.php"));
	if(!is_array($checkBanCron)) $dbweb->query($banCron);

	if(isset($_POST['submit_ban'])) {
		try {
			if(!isset($_POST['ban_account'])) throw new Exception("Please enter the account username.");
			if(!$common->userExists($_POST['ban_account'])) throw new Exception("Invalid account username.");
			if(!isset($_POST['ban_days'])) throw new Exception("Please enter the amount of days.");
			if(!Validator::UnsignedNumber($_POST['ban_days'])) throw new Exception("Invalid ban days.");
			if(isset($_POST['ban_reason'])) {
				if(!Validator::Length($_POST['ban_reason'], 100, 1)) throw new Exception("Invalid ban reason.");
			}

			// Check Online Status
			if($common->accountOnline($_POST['ban_account'])) throw new Exception("The account is currently online.");

			// Account Information
			$userID = $common->retrieveUserID($_POST['ban_account']);
			$accountData = $common->accountInformation($userID);

			// Check if aready banned
			if($accountData[_CLMN_BLOCCODE_] == 0) throw new Exception("This account is already banned.");

			// Ban Type
			$banType = ($_POST['ban_days'] >= 1 ? "temporal" : "permanent");

			// Log Ban
			$banLogData = array(
				'acc' => $_POST['ban_account'],
				'by' => $_SESSION['username'],
				'type' => $banType,
				'date' => time(),
				'days' => $_POST['ban_days'],
				'reason' => (isset($_POST['ban_reason']) ? $_POST['ban_reason'] : "")
			);

			$logBan = $dbweb->query("INSERT INTO ".CABALENGINE_BAN_LOG." (account_id, banned_by, ban_type, ban_date, ban_days, ban_reason) VALUES (:acc, :by, :type, :date, :days, :reason)", $banLogData);
			if(!$logBan) throw new Exception("Could not log ban (check tables)[1].");

			// Add temporal ban
			if($banType == "temporal") {
				$tempBanData = array(
					'acc' => $_POST['ban_account'],
					'by' => $_SESSION['username'],
					'date' => time(),
					'days' => $_POST['ban_days'],
					'reason' => (isset($_POST['ban_reason']) ? $_POST['ban_reason'] : "")
				);
				$tempBan = $dbweb->query("INSERT INTO ".CABALENGINE_BANS." (account_id, banned_by, ban_date, ban_days, ban_reason) VALUES (:acc, :by, :date, :days, :reason)", $tempBanData);
				if(!$tempBan) throw new Exception("Could not add temporal ban (check tables)[2]. - " . $dbweb->error);
			}

			// Ban Account
			$banAccount = $dbaccount->query("UPDATE "._TBL_MI_." SET "._CLMN_BLOCCODE_." = ? WHERE "._CLMN_USERNM_." = ?", array(1, $_POST['ban_account']));
			if(!$banAccount) throw new Exception("Could not ban account.");

			message('success', 'Account Banned');
		} catch(Exception $ex) {
			message('error', $ex->getMessage());
		}
	}
?>
<div class="row">
	<div class="col-md-6">
		<form action="" method="post" role="form">
			<div class="form-group">
				<label for="acc">Account</label>
				<input type="text" name="ban_account" class="form-control" id="acc">
			</div>
			<div class="form-group">
				<label for="days">Days (0 for permanent ban)</label>
				<input type="text" name="ban_days" class="form-control" id="days" value="0">
			</div>
			<div class="form-group">
				<label for="reason">Reason (optional)</label>
				<input type="text" name="ban_reason" class="form-control" id="reason">
			</div>
			<input type="submit" name="submit_ban" class="btn btn-primary" value="Ban Account"/>
		</form>
	</div>
</div>