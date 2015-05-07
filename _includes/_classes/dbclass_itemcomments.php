<?php 

	class dbclass_itemcomments extends dbclass_all
	{
		
		protected
				$_tablename = 'B_ItemComments',
				$_columns = array(),
				$IC_ID = NULL,
				$IC_I_ID = NULL,
				$IC_U_ID = NULL,
				$IC_Comment = NULL,
				$IC_DateTime = NULL
				;
		
		/*public function __construct()
		{
			$this->_columns = ['IC_ID','IC_I_ID','IC_U_ID','IC_Comment','IC_DateTime'];
		}*/
		
	}

?>