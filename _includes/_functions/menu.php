<?php
//Zur Menu-Erstellung mit Parent/Child Elementen (rekursiv)
function createMenu($einsprungspunkt, $level, $activePage)
{
	$strMenu = "";
	$strMenu .= '<ul class="nav navbar-nav level_'.$level.'">';

	if (isset($einsprungspunkt) && !empty($einsprungspunkt))
	{

		foreach($einsprungspunkt as $k => $v)
		{
			if ($v['parent'] > 0)
			{	//HauptMenu
				$strMenu .= '<li '. (in_array($k, $activePage['navids'])?"class='Menu_active'":NULL).'><a  href="'.$v['clickpath'].'">'.$v['label'].'</a>';
			}
			else
			{	//UnterMenu
				$strMenu .= '<li '. (in_array($k, $activePage['navids'])?"class='Menu_active'":NULL).'><a class="Top" href="'.$v['clickpath'].'">'.$v['label'].'</a>';
			}
			if(count($v['child']) > 0)
			{
				$strMenu .= createMenu($v['child'], $level++, $activePage);
			}
			$strMenu .= '</li>';
		}
		$strMenu .= '</ul>';
		return $strMenu;
	}
}