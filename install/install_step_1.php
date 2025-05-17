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

if(!defined('access') or !access or access != 'install') die();
?>
<h3>Web Server Requirements</h3>
<br />
<?php
if(isset($_POST['install_step_1_submit'])) {
	try {
		# move to next step
		$_SESSION['install_cstep']++;
		header('Location: install.php');
		die();
	} catch (Exception $ex) {
		echo '<div class="alert alert-danger" role="alert">'.$ex->getMessage().'</div>';
	}
}

echo '<div class="list-group">';

	$chk_1 = version_compare(PHP_VERSION, '8.1', '>=');
	$check_1 = ($chk_1 ? '<span class="label label-success">Ok</span>' : '<span class="label label-danger">Fix</span>');
	echo '<div class="list-group-item">';
		echo 'PHP 8.1 or higher';
		echo '<span class="pull-right">(PHP '.PHP_VERSION.') '.$check_1.'</span>';
	echo '</div>';

	$chk_3 = (extension_loaded('openssl') ? true : false);
	$check_3 = ($chk_3 ? '<span class="label label-success">Ok</span>' : '<span class="label label-danger">Fix</span>');
	echo '<div class="list-group-item">';
		echo 'OpenSSL Extension';
		echo '<span class="pull-right">'.$check_3.'</span>';
	echo '</div>';
	
	$chk_4 = (extension_loaded('curl') ? true : false);
	$check_4 = ($chk_4 ? '<span class="label label-success">Ok</span>' : '<span class="label label-danger">Fix</span>');
	echo '<div class="list-group-item">';
		echo 'cURL Extension';
		echo '<span class="pull-right">'.$check_4.'</span>';
	echo '</div>';
	
	$chk_11 = (extension_loaded('gd') ? true : false);
	$check_11 = ($chk_11 ? '<span class="label label-success">Ok</span>' : '<span class="label label-danger">Fix</span>');
	echo '<div class="list-group-item">';
		echo 'GD Extension';
		echo '<span class="pull-right">'.$check_11.'</span>';
	echo '</div>';
	
	$chk_12 = (extension_loaded('xml') ? true : false);
	$check_12 = ($chk_12 ? '<span class="label label-success">Ok</span>' : '<span class="label label-danger">Fix</span>');
	echo '<div class="list-group-item">';
		echo 'XML Extension';
		echo '<span class="pull-right">'.$check_12.'</span>';
	echo '</div>';

	$chk_5 = (extension_loaded('pdo') ? true : false);
	$check_5 = ($chk_5 ? '<span class="label label-success">Ok</span>' : '<span class="label label-danger">Fix</span>');
	echo '<div class="list-group-item">';
		echo 'PDO';
		echo '<span class="pull-right">'.$check_5.'</span>';
	echo '</div>';
	
	if($chk_5) {
		$chk_6 = (extension_loaded('pdo_dblib') ? true : false);
		$check_6 = ($chk_6 ? '<span class="label label-success">Ok</span>' : '<span class="label label-warning">Optional Fix</span>');
		echo '<div class="list-group-item">';
			echo 'PDO dblib (linux)';
			echo '<span class="pull-right">'.$check_6.'</span>';
		echo '</div>';

		$chk_8 = (extension_loaded('pdo_sqlsrv') ? true : false);
		$check_8 = ($chk_8 ? '<span class="label label-success">Ok</span>' : '<span class="label label-warning">Optional Fix</span>');
		echo '<div class="list-group-item">';
			echo 'PDO sqlsrv (windows)';
			echo '<span class="pull-right">'.$check_8.'</span>';
		echo '</div>';
	}
	
	$chk_9 = (extension_loaded('json') ? true : false);
	$check_9 = ($chk_9 ? '<span class="label label-success">Ok</span>' : '<span class="label label-danger">Fix</span>');
	echo '<div class="list-group-item">';
		echo 'JSON';
		echo '<span class="pull-right">'.$check_9.'</span>';
	echo '</div>';
	
	$chk_10 = file_get_contents(__BASE_URL__ . 'includes/config/cabalengine.json');
	$chk_10_code = explode(' ', $http_response_header[0]);
	$chk_10 = ($chk_10_code[1] == '403' ? '<span class="label label-success">Ok</span>' : '(private directories can be accessed by everyone) <span class="label label-danger">Fix</span>');
	echo '<div class="list-group-item">';
		echo 'Apache .htaccess';
		echo '<span class="pull-right">'.$chk_10.'</span>';
	echo '</div>';
	
echo '</div>';

echo '<h3>Writable Directories and Files (chmod)</h3>';
if(is_array($writablePaths)) {
	foreach($writablePaths as $filepath) {
		if(file_exists(__PATH_INCLUDES__ . $filepath)) {
			if(!is_writable(__PATH_INCLUDES__ . $filepath)) {
				echo '<div class="list-group-item">';
					echo $filepath;
					echo '<span class="pull-right"><span class="label label-warning">Not Writable</span></span>';
				echo '</div>';
			} else {
				echo '<div class="list-group-item">';
					echo $filepath;
					echo '<span class="pull-right"><span class="label label-success">Ok</span></span>';
				echo '</div>';
			}
		} else {
			echo '<div class="list-group-item">';
				echo $filepath;
				echo '<span class="pull-right"><span class="label label-danger">File Missing</span></span>';
			echo '</div>';
		}
	}
}

echo '<br /><br />';
echo '<p style="color:red;">We strongly advise that you fix any issues before proceeding.</p>';
echo '<br />';

echo '<form action="" method="post">';
	echo '<a href="'.__INSTALL_URL__.'install.php" class="btn btn-default">Re-Check</a> ';
	echo '<button type="submit" name="install_step_1_submit" value="ok" class="btn btn-success">Continue</button>';
echo '</form>';