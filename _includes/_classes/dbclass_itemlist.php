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
		
		/*
			Select Items von Event
		*/
		
		public function getItemcomments($item)
		{
			$table = "B_ItemComments";
			$columns = ["IC_Comment","IC_DateTime","U_AnzeigeName"];
			$where = ["IC_I_ID" => $item];
			$join = ["[>]B_User" => ["IC_U_ID" => "U_ID"]];
			$itemcomments = $this->select($table,$columns,$where,$join,false);
			
			return $itemcomments;
		}
		
	}

?>