<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
  </head>
  <body id="sfTinyMceImageBrowser_page">
		<h1><?php echo __('Upload new file') ?></h1>
		<?php echo form_tag_for($form, 'sfTinyMceImageBrowser') ?>
			<ul>
	    <?php echo $form->renderUsing('classyList') ?>
			</ul>
    <?php echo end_form_tag() ?>
    		
		<h1><?php echo __('Choose uploaded file') ?></h1>
		<?php include_component('sfTinyMceImageBrowser', 'list') ?>
  </body>
</html>