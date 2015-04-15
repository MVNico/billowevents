<?php
session_start();
	
	define('DOCFOLDER','/');
	define('DOCROOT',realpath(dirname(__FILE__).'/'));
	
	
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
	$file		= $objMenu->get_activePage('file');
	$activePage = $objMenu->get_activePage();
	
// 	xDebug($seite);
// 	xDebug($file);
// 	xDebug($activePage);
	
	include(TEMPLATE_PATH.'/'.$file.'.php');
?>