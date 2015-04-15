<?php
function __autoload($class)
{
	require CLASSES_PATH.'/'.$class.'.php';
}