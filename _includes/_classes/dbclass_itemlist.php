<?php 

	class dbclass_itemlist extends dbclass_all
	{
		
		protected
				$_tablename = 'B_ItemList',
				$_columns = array(),
				$I_ID = NULL,
				$I_Name = NULL,
				$I_Bedarfmenge = NULL,
				$I_CurrMenge = NULL,
				$I_Url = NULL,
				$I_Zusatz = NULL,
				$I_Visibility = NULL,
				$I_E_ID = NULL,
				$I_U_ID = NULL
				;
		
		public function __construct()
		{
			$this->_columns = ['I_ID','I_Name','I_Bedarfmenge','I_CurrMenge','I_Url','I_Zusatz','I_Visibility','I_E_ID','I_U_ID'];
		}
		
		/*
			Select Items von Event
			!!Noch nicht getestet, nur Idee!!
		*/
		
		public function getItemcomments()
		{
			$itemcomments = $this->select("B_ItemComments",array("IC_I_ID" => $this->E_ID), FALSE, FALSE, NULL);
			return $itemcomments;
		}
		
	}

?>