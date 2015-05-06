<?php
session_start();
	
	define('DOCFOLDER','/');
	define('DOCROOT',realpath(dirname(__FILE__).'/'));
	
// 	include (CLASSES_PATH,'');
	include (DOCFOLDER.'_includes/config.php');
// 	include (INCLUDE_PATH.'/dbconnect.php');
	include (FUNCTIONS_PATH.'/autoload.php');
	include (FUNCTIONS_PATH.'/debug.php');
	include (FUNCTIONS_PATH.'/menu.php');
	include (PARTIALS_PATH.'/menu.php');
	
	// Erkennen der aktuellen Seite
	$seite = isset($_GET['seite']) && !empty($_GET['seite']) ? $_GET['seite'] : 'home';
	
	// Erstellen eines Menüs & aktuellen Seitencontent bestimmen
	$objMenu 	= new Menu($arrMenu, $seite);
	$template	= $objMenu->get_activePage('template');
	$activePage = $objMenu->get_activePage();
	

	$Menu = $objMenu->get_arrMenu();
	
	include(TEMPLATE_PATH.'/'.$template.'.php');
?>