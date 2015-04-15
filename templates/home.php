<?php 
	include_once PARTIALS_PATH.'/header.php';
	
	$Menu = $objMenu->get_arrMenu();
	echo '<div id="top_menu">'.createMenu($Menu[0]['child'], '1', $activePage).'</div><div class="clear"></div>';
	
	/* Hier dann die DB Verbindung für den Content der Seite*/
	// 	include(CONTENT_PATH.'/'.$file.'.php');
	
	include_once PLUGIN_PATH.'/forms/login.php';
	
	include_once PARTIALS_PATH.'/footer.php';