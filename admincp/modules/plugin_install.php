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
<h1 class="page-header">Import Plugin</h1>
<?php
if(!config('plugins_system_enable',true)) {
	message('warning', '<strong>WARNING</strong><br />The plugin system is not currently enabled. To enable it please change your <a href="'.admincp_base('website_settings').'">website settings</a>.');
}

if(isset($_POST['submit'])) {

	if($_FILES["file"]["error"] > 0) {
		message('error', 'There has been an error uploading the file.');
	} else {
		$Plugin = new Plugins();
		$Plugin->importPlugin($_FILES);
	}
}

?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Select file</label>
		<input type="file" name="file" id="file"/>
	</div>
	<input type="submit" name="submit" class="btn btn-primary span2" value="Install"/>
</form>
<p>Make sure you upload all the plugin files before importing it.</p>