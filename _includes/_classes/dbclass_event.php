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
		
		/*
			Select Eventcomments von Event
		*/
		
		public function getEventcomments($event)
		{
			$table = "B_EventComments";
			$columns = ["EK_Kommentar","U_AnzeigeName"];
			$where = ["EK_E_ID" => $event];
			$join = ["[>]B_User" => ["U_ID" => "GL_U_ID"]];
			$eventcomments = $this->select($table,$columns,$where,$join,false);

			return $eventcomments;
		}
		
		/*
			Select Items von Event
		*/
		
		public function getItems($event)
		{
			$table = "B_ItemList";
			$columns = $this->getColumns($table);
			$where = ["I_E_ID" => $event];
			$items = $this->select($table,$columns,$where,null,false);
			return $items;
		}
		
		/*
			Select Gäste von Event
		*/
		
		public function getGaeste($event)
		{
			$table = "B_GaesteListe";
			$columns = ["U_AnzeigeName","U_Email"];
			$where = ["GL_E_ID" => $event];
			$join = ["[>]B_User" => ["GL_U_ID" => "U_ID"]];
			$gaeste = $this->select($table,$columns,$where,$join,false);

			return $gaeste;

		}
		
	}

?>