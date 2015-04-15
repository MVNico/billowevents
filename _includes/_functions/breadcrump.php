<?php
//Breadcrump Navigation
function breadcrump($page)
{
	$an="Sie befinden sind hier: ";
	$home="news";
	$pie=explode("/",$page);
	$tr=" > ";
	$b=count($pie);
	$breadcrump = $an."<a href=\"".$home."\">Startseite</a>";

	for($a=1;$a<$b-1;$a++)
	{
		$ta=$pie[$a];
		$breadcrump .= $tr."<a href=".'/'.$ta.">".ucfirst($pie[$a])."</a>";
	}
	$file=explode('.',ucfirst($pie[$b-1]));
	$breadcrump .= "<b>".$tr.$file[0]."</b>";

	return $breadcrump;
}