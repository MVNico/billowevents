<?php 

	class dbclass_gaesteliste extends dbclass_all
	{
		
		protected
				$_tablename = 'B_GaesteListe',
				$_columns = array(),
				$GL_E_ID = NULL,
				$GL_U_ID = NULL,
				$GL_TeilnehmerStatus = NULL
				;
		
		/*public function __construct()
		{
			$this->_columns = ['GL_E_ID','GL_U_ID','GL_TeilnehmerStatus'];
		}*/
		
	}

?>