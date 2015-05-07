<?php 

	class dbclass_event extends dbclass_all
	{
		
		protected
				$_tablename = 'B_Event',
				$_columns = array(),
				$E_ID = 0,
				$E_Ueberschrift = NULL,
				$E_Beschreibung = NULL,
				$E_Datevon = NULL,
				$E_Datebis = NULL,
				$E_TimeVon = NULL,
				$E_TimeBis = NULL,
				$E_Ort = NULL,
				$E_Sichtbarkeit = NULL,
				$E_U_Creator = NULL
		;
			
		/*public function __construct()
		{
			$this->_columns = ['E_ID','E_Beschreibung','E_Ueberschrift','E_Datevon','E_Datebis','E_TimeVon','E_TimeBis','E_Ort','E_Sichtbarkeit','E_U_Creator'];
		}*/
		
		/*
			Select Eventcomments von Event
			!!Noch nicht getestet, nur Idee!!
		*/
		
		public function getEventcomments()
		{
			$table = "B_EventComments";
			$columns = $this->getColumns($table);
			$where = array("EK_E_ID" => $this->U_ID);
			$eventcomments = $this->select($table,$columns,$where, NULL);//JOIN ?

			return $eventcomments;
		}
		
		/*
			Select Items von Event
			!!Noch nicht getestet, nur Idee!!
		*/
		
		public function getItems()
		{
			$items = $this->select("B_Itemlist",NULL,array("I_E_ID" => $this->E_ID), NULL);
			return $items;
		}
		
		/*
			Select Items von Event
			!!Noch nicht getestet, nur Idee!!
		*/
		
		public function getGaeste()
		{
			$gaeste = $this->select("B_GaesteListe",NULL,array("GL_E_ID" => $this->E_ID), NULL);//JOIN wegen usernamen
			return $gaeste;
		}
		
	}

?>