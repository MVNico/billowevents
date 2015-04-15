<?php
class Menu 
{
	private	$_menu,
			$_activePage,
			$_urlMap = array(),
			$_topnavid,
			$_seite,
			$_arrMenu,
			$_key
			;

	public function __construct($arrMenu, $seite) 
	{	
		$this->_arrMenu = $arrMenu;
		$this->_seite 	= $seite;
		$this->set_arrMenu();
	}
	
	
	public function set_arrMenu()
	{
		foreach ($this->_arrMenu as $k => $v)
		{
			if (!isset($this->_arrMenu[$v['parent']])) 
			{
				$this->_arrMenu[$v['parent']] = array('child'=>array(), 'clickpath'=>'', 'navids'=>array());
			}

			$this->_arrMenu[$k]['clickpath'] = $this->_arrMenu[$v['parent']]['clickpath'].'/'.$v['name'];
			$this->_arrMenu[$k]['navids']	 = $this->_arrMenu[$v['parent']]['navids'];

			array_push($this->_arrMenu[$k]['navids'], $k);
			
			$this->_arrMenu[$k]['child']	  = array();
			$this->_arrMenu[$v['parent']]['child'][$k] =&$this->_arrMenu[$k];


			$this->_key = trim($this->_arrMenu[$k]['clickpath'], '/');

			$this->_urlMap[$this->_key] = $k;


		}

		if (isset($this->_urlMap[$this->_seite]))
		{
			$this->_activePage = $this->_arrMenu[$this->_urlMap[$this->_seite]];
		}
		
 		$this->_topnavid = $this->_activePage['navids'][0];
	}

	public function get_arrMenu($id=NULL, $key=NULL)
	{
		$ret = NULL;
		if(is_null($id))
		{
			$ret = $this->_arrMenu;
		}
		else
		{
			if(isset($this->_arrMenu[$id]))
			{
				if (is_null($key)) 
				{
					$ret = $this->_arrMenu[$id];
				}
				else 
				{
					if(isset($this->_arrMenu[$id][$key]))
					{
						$ret = $this->_arrMenu[$id][$key];
					}
						
				}	
			}
		}
		return $ret;
	}

	public function get_activePage($key=NULL)
	{
		$ret = NULL;
		if(is_null($key))
		{
			$ret = $this->_activePage;
		}
		else 
		{
			if (isset($this->_activePage[$key]))
			{
				$ret = $this->_activePage[$key];
			}
		}
		return $ret;
		
	}	

	public function get_topnavid()
	{
		return $this->_topnavid;
	}
}
?>