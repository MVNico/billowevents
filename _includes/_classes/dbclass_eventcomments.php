<?php 

	class dbclass_eventcomments extends dbclass_all
	{
		
		protected
				$_tablename = 'B_EventComments',
				$_columns = array(),
				$EK_ID = NULL,
				$EK_E_ID = NULL,
				$EK_U_ID = NULL,
				$EK_Kommentar = NULL,
				$EK_Date = NULL
				;
		
		public function __construct()
		{
			$this->_columns = ['EK_ID','EK_E_ID','EK_U_ID','EK_Kommentar','EK_Date'];
		}
		
	}

?>