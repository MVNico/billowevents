<?php 

	class dbclass_user extends dbclass_all
	{
		
		protected
				$_tablename = 'B_User',
				$_columns = array(),
				$U_ID = 0,
				$U_Anzeigename = NULL,
				$U_PW = NULL,
				$U_Email = NULL,
				$U_Name = NULL,
				$U_Vorname = NULL,
				$U_Straße = NULL,
				$U_HausNr = NULL,
				$U_Plz = NULL,
				$U_Ort = NULL,
				$U_Visibility = NULL
		;
		
		/*public function __construct()
		{
			$this->_columns = ['U_ID','U_Anzeigename','U_PW','U_Email','U_Name','U_Vorname','U_Strase','U_HausNr','U_Plz','U_Ort','U_Visibility'];
		}*/
		/*
			Überprüft ob User existiert. Gibt User-ID zurück, falls er existiert, sonst 0.
		*/
		public function userExists($whereclause){
			$_userexists = 0;
			$database = $this->getDatabase();
			$tets = $database->select($this->_tablename,["U_ID"],$whereclause);
			
			if(count($tets) == 1){
				$_userexists = $tets[0];
			}
			
			if($database->error()[0] != "00000"){
				var_dump($database->error());
			}
			
			return $_userexists;
			
		}
		
		/*
			Select Freunde von User
			!!Noch nicht getestet, nur Idee!!
		*/
		
		public function getFriends()
		{
			$table = "B_FriendList";
			$columns = $this->getColumns($table);
			$where = array("F_U_ID" => $this->U_ID);
			$friends = $this->select($table,$columns,$where, NULL);//JOIN einfügen? wgen namen
			return $friends;
		}
		
		/*
			Select Events von User
			!!Noch nicht getestet, nur Idee!!
		*/
		
		public function getEvents()
		{
			$table = "B_Event";
			$columns = $this->getColumns($table);
			$where = array("E_U_Creator" => $this->U_ID);
			$events = $this->select($table,$columns,$where, NULL);
			return $events;
		}
		
		/*
			Select Notizen von User
			!!Noch nicht getestet, nur Idee!!
		*/
		
		public function getNotizen()
		{
			$table = "B_Notizen";
			$columns = $this->getColumns($table);
			$where = array("N_U_ID" => $this->U_ID);
			$notizen = $this->select($table,$columns,$where, NULL);
			return $notizen;
		}
	}

?>