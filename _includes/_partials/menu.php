<?php
// Menu-Array zum Einfügen bzw. Löschen von neuen Seiten
$arrMenu = array(
	1=>array(
		'parent'=>0,
		'label'=>'Home',
		'template'=>'home',
		'file'=>'home',
		'name'=>'home',
	),
	2=>array(
		'parent'=>1,
		'label'=>'Registrieren',
		'template'=>'home',
		'file'=>'register',
		'name'=>'register',
	),
);
?>