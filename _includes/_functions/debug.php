<?php
function xDebug($pmixValue, $strDesc=null, $boolDump=false) {
	echo '<pre style="text-align:left;font-family:courier;background-color:#cccccc; padding:10px; margin:10px; border:3px ridge #980000;">';
	if($strDesc != null || $strDesc != ''){
		echo '<b>'.$strDesc.'</b><br />';
	}
	$strVarType = gettype($pmixValue);
	echo 'Vartype: '.$strVarType.'<br />';
	if(is_array($pmixValue)){
		echo "Arraygröße: ". count($pmixValue).'<br />';
	}
	echo 'Inhalt: ';
	if($boolDump){
		var_dump($pmixValue);
	}else{
		if($strVarType == 'boolean'){
			if($pmixValue===true){
				echo 'true';
			}else{
				echo 'false';
			}
		}else{
			print_r($pmixValue);
		}
	}
	echo '</pre>';
}