<?php
//Zur Menu-Erstellung mit Parent/Child Elementen (rekursiv)
function createTable($einsprungspunkt, $level, $activePage)
{
	$strMenu = "";
	$strMenu .= '<ul class="nav navbar-nav level_'.$level.'">';

	if (isset($einsprungspunkt) && !empty($einsprungspunkt))
	{
		foreach($einsprungspunkt as $k => $v)
		{
			if ($v['parent'] > 0 && $v['display'] == 'yes')
			{	//HauptMenu
				$strMenu .= '<li '. (in_array($k, $activePage['navids'])?"class='Menu_active'":NULL).'><a  href="'.$v['clickpath'].'">'.$v['label'].'</a>';
			}
			elseif ($v['display'] == 'yes')
			{
				$strMenu .= '<li '. (in_array($k, $activePage['navids'])?"class='Menu_active'":NULL).'><a class="Top" href="'.$v['clickpath'].'">'.$v['label'].'</a>';
			}
			if(count($v['child']) > 0  && $v['display'] == 'yes')
			{
				$strMenu .= createMenu($v['child'], $level++, $activePage);
			}
			$strMenu .= '</li>';
		}
		$strMenu .= '</ul>';
		return $strMenu;
	}
}