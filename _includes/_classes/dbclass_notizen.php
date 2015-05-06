<?php 

	class dbclass_notizen extends dbclass_all
	{
		
		protected
				$_tablename = 'B_Notizen',
				$_columns = array(),
				$N_ID = NULL,
				$N_Beschreibung = NULL,
				$N_Text = NULL,
				$N_U_ID = NULL
		;
		
		public function __construct()
		{
			$this->_columns = ['N_ID','N_Beschreibung','N_Text','N_U_ID'];
		}
	}

?>