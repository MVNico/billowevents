<?php
// Menu-Array zum Einfügen bzw. Löschen von neuen Seiten

/*
 * Das könnte man eigentlich auch alles in die DB auslagern, dann kommt es allerdings darauf an, ob du über meedo ein array aus der DB zurück bekommst, das so aufgebaut ist, wie hier
 * sonst müsste ich die komplette Menüklasse umschreiben : (
 * 
 * */
$arrMenu = array(
	1=>array(
		'parent'=>0,
		'label'=>'Home',
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
		'label'=>'Freundesliste',
		'template'=>'home',
		'file'=>'friendlist',
		'name'=>'friendlist',
		'display' =>'none',
	),
	6=>array(
		'parent'=>0,
		'label'=>'Übersicht',
		'template'=>'event',
		'file'=>'test',
		'name'=>'overview',
		'display' =>'none',
	),
	7=>array(
		'parent'=>0,
		'label'=>'Notiz',
		'template'=>'home',
		'file'=>'note',
		'name'=>'note',
		'display' =>'none',
	),
	8=>array(
		'parent'=>0,
		'label'=>'Wunschliste',
		'template'=>'home',
		'file'=>'wishlist',
		'name'=>'wishlist',
		'display' =>'none',
	),
);
?>