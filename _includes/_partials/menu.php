<?php
// Menu-Array zum Einfügen bzw. Löschen von neuen Seiten
$arrMenu = array(
	1=>array(
		'parent'=>0,
		'label'=>'Profil',
		'template'=>'home',
		'file'=>'login',
		'name'=>'home',
		'display'=>'yes'
	),
	2=>array(
		'parent'=>0,
		'label'=>'Registrieren',
		'template'=>'home',
		'file'=>'registration',
		'name'=>'registration',
		'display'=>'yes'
	),
	3=>array(
		'parent'=>0,
		'label'=>'Disclaimer',
		'template'=>'home',
		'file'=>'disclaimer',
		'name'=>'disclaimer',
		'display'=>'yes'
	),
	4=>array(
		'parent'=>0,
		'label'=>'Logout',
		'template'=>'home',
		'file'=>'logout',
		'name'=>'logout',
		'display' =>'none',
	),
	5=>array(
		'parent'=>0,
		'label'=>'Test',
		'template'=>'event',
		'file'=>'test',
		'name'=>'test',
		'display' =>'yes',
	),
);
?>