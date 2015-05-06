<?php
function __autoload($class)
{
	xDebug(file_exists(CLASSES_PATH.'/'.$class.'.php'));
	require CLASSES_PATH.'/'.$class.'.php';
}