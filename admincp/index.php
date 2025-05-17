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

// access
define('access', 'admincp');

try {
	
	// Load CabalEngine
	if(!@include_once('../includes/cabalengine.php')) throw new Exception('Could not load CabalEngine.');

	// Check if user is logged in
	if(!isLoggedIn()) { redirect(); }

	// Check if user has access
	if(!canAccessAdminCP($_SESSION['username'])) { redirect(); }

	// Load AdminCP Tools
	if(!@include_once(__PATH_ADMINCP_INC__ . 'functions.php')) throw new Exception('Could not load AdminCP functions.');
	
	// Check Configurations
	if(!@include_once(__PATH_ADMINCP_INC__ . 'check.php')) throw new Exception('Could not load AdminCP configuration check.');
	
} catch (Exception $ex) {
	$errorPage = file_get_contents('../includes/error.html');
	echo str_replace("{ERROR_MESSAGE}", $ex->getMessage(), $errorPage);
	die();
}

$admincpSidebar = array(
	array("News Management", array(
		"addnews" => "Publish",
		"managenews" => "Edit / Delete",
	), "fa-newspaper-o"),
	array("Account", array(
		"searchaccount" => "Search",
		"accountsfromip" => "Find Accounts from IP",
		"onlineaccounts" => "Online Accounts",
		"newregistrations" => "New Registrations",
		"accountinfo" => "", // HIDDEN
	), "fa-users"),
	array("Character", array(
		"searchcharacter" => "Search",
		"editcharacter" => "", // HIDDEN
	), "fa-user"),
	array("Bans", array(
		"searchban" => "Search",
		"banaccount" => "Ban Account",
		"latestbans" => "Latest Bans",
		"blockedips" => "Block IP (web)",
	), "fa-exclamation-circle"),
	array("Credits", array(
		"creditsconfigs" => "Credit Configurations",
		"creditsmanager" => "Credit Manager",
		"latestpaypal" => "PayPal Donations",
		"topvotes" => "Top Voters",
	), "fa-money"),
	array("Website Configuration", array(
		"admincp_access" => "AdminCP Access",
		"connection_settings" => "Connection Settings",
		"website_settings" => "Website Settings",
		"modules_manager" => "Modules Manager",
		"navbar" => "Navigation Menu",
		"usercp" => "UserCP Menu",
	), "fa-toggle-on"),
	array("Tools", array(
		"cachemanager" => "Cache Manager",
		"cronmanager" => "Cron Job Manager",
	), "fa-wrench"),
	array("Languages", array(
		"phrases" => "Phrase List",
	), "fa-language"),
	array("Plugins", array(
		"plugins" => "Plugins Manager",
		"plugin_install" => "Import Plugin",
	), "fa-plug"),
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="CabalEngine AdminCP 2.0">
    <meta name="author" content="Lautaro Angelico">
    <title>CabalEngine AdminCP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo __PATH_ADMINCP_HOME__; ?>css/metisMenu.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@3.3.7/dist/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tinymce@7.7.0/skins/ui/oxide/content.min.css">
    <link rel="stylesheet" href="css/cabalengine.css">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
	<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo admincp_base(); ?>"><img src="img/logo.png" /></a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li><a href="<?php echo __BASE_URL__; ?>" target="_blank"><i class="fa fa-fw fa-home"></i> Website Home</a></li>
                <li><a href="<?php echo __BASE_URL__; ?>logout/"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
						<?php
							foreach($admincpSidebar as $sidebarItem) {
								$active = '';
								if(isset($_GET['module'])) {
									if(array_key_exists($_GET['module'], $sidebarItem[1])) {
										$active = ' class="active"';
									}
								}
								
								echo '<li'.$active.'>';
									$itemIcon = (check_value($sidebarItem[2]) ? '<i class="fa '.$sidebarItem[2].' fa-fw"></i>&nbsp;' : '');
									if(is_array($sidebarItem[1])) {
										echo '<a href="#">'.$itemIcon.$sidebarItem[0].'<span class="fa arrow"></span></a>';
										echo '<ul class="nav nav-second-level">';
											foreach($sidebarItem[1] as $sidebarSubItemModule => $sidebarSubItemTitle) {
												if(check_value($sidebarSubItemTitle)) echo '<li><a href="'.admincp_base($sidebarSubItemModule).'">'.$sidebarSubItemTitle.'</a></li>';
											}
										echo '</ul>';
									} else {
										echo '<a href="'.admincp_base($sidebarItem[1]).'">'.$itemIcon.$sidebarItem[0].'</a>';
									}
								echo '</li>';
							}
							
							if(isset($extra_admincp_sidebar)) {
								if(is_array($extra_admincp_sidebar)) {
									echo '<li>';
										echo '<a href="#"><i class="fa fa-square fa-fw"></i>Active Plugins<span class="fa arrow"></span></a>';
										echo '<ul class="nav nav-second-level">';
											foreach($extra_admincp_sidebar as $pluginSidebarItem) {
												if(is_array($pluginSidebarItem) && is_array($pluginSidebarItem[1])) {
													echo '<li>';
														echo '<a href="#">'.$pluginSidebarItem[0].' <span class="fa arrow"></span></a>';
														echo '<ul class="nav nav-third-level collapse" aria-expanded="false" style="height: 0px;">';
															foreach($pluginSidebarItem[1] as $pluginSidebarSubItem) {
																echo '<li><a href="'.admincp_base($pluginSidebarSubItem[1]).'">'.$pluginSidebarSubItem[0].'</a></li>';
															}
														echo '</ul>';
													echo '</li>';
												}
											}
										echo '</ul>';
									echo '</li>';
								}
							}
						?>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row contentpadding">
                <div class="col-lg-12">
					<?php
						$req = isset($_REQUEST['module']) ? $_REQUEST['module'] : '';
						$handler->loadAdminCPModule($req);
					?>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <script src="<?php echo __PATH_ADMINCP_HOME__; ?>js/metisMenu.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@3.3.7/dist/js/sb-admin-2.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/tinymce@7.7.0/tinymce.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#new_registrations').DataTable({
				"searching":		false,
				"ordering":			false,
				"lengthChange":		false,
				"pageLength":		10,
				"info":				false
			});
			$('#blocked_ips').DataTable({
				"searching":		false,
				"ordering":			false,
				"lengthChange":		false,
				"pageLength":		10,
				"info":				false
			});
			$('#paypal_donations').DataTable({
				"searching":		true,
				"ordering":			false,
				"lengthChange":		false,
				"pageLength":		10,
				"info":				true
			});
			$('#superrewards_donations').DataTable({
				"searching":		true,
				"ordering":			false,
				"lengthChange":		false,
				"pageLength":		10,
				"info":				true
			});
			$('#credits_logs').DataTable({
				"searching":		true,
				"ordering":			false,
				"lengthChange":		false,
				"pageLength":		10,
				"info":				true
			});
		} );
	</script>
</body>
</html>

