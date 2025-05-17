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
<h1 class="page-header">Edit News</h1>
<?php
$News = new News();
loadModuleConfigs('news');

// Check if News cache folder is writable
if($News->isNewsDirWritable()) {
	
	// Edit news process::
	if(isset($_POST['news_submit'])) {
		$News->editNews($_REQUEST['id'],$_POST['news_title'],$_POST['news_content'],$_POST['news_author'],0,$_POST['news_date']);
		$News->cacheNews();
		$News->updateNewsCacheIndex();
		redirect(1, 'admincp/?module=managenews');
	}
	
	// Load News
	$editNews = $News->loadNewsData($_REQUEST['id']);
	if($editNews) {
?>
		<form role="form" method="post">
			<div class="form-group">
				<label for="input_1">Title:</label>
				<input type="text" class="form-control" id="input_1" name="news_title" value="<?php echo $editNews['news_title']; ?>"/>
			</div>
			<div class="form-group">
				<label for="news_content"></label>
				<textarea name="news_content" id="news_content"><?php echo $editNews['news_content']; ?></textarea>
			</div>
			<div class="form-group">
				<label for="input_2">Author:</label>
				<input type="text" class="form-control" id="input_2" name="news_author" value="<?php echo $editNews['news_author']; ?>"/>
			</div>
			<div class="form-group">
				<label for="input_4">News Date:</label>
				<input type="text" class="form-control" id="input_4" name="news_date" value="<?php echo date("Y-m-d H:i", $editNews['news_date']); ?>"/>
			</div>
			<button type="submit" class="btn btn-large btn-block btn-success" name="news_submit" value="ok">Update News</button>
		</form>
		
		<script>
		const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
		const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;
			
		document.addEventListener("DOMContentLoaded", function(){
			tinymce.init({
				selector: '#news_content',
				plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion',
				menubar: 'file edit view insert format tools table help',
				toolbar: "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",
				promotion: false,
				license_key: 'gpl',
				toolbar_mode: 'sliding',
				contextmenu: 'link image table',
				skin: useDarkMode ? 'oxide-dark' : 'oxide',
				content_css: useDarkMode ? 'dark' : 'default',
			});
		});
		</script>
<?php	
	} else {
		message('error','Could not load news data.');
	}
} else {
	message('error','The news cache folder is not writable.');
}

?>