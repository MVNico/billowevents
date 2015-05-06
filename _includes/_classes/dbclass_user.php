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
		
		public function __construct()
		{
			$this->_columns = ['U_ID','U_Anzeigename','U_PW','U_Email','U_Name','U_Vorname','U_Strase','U_HausNr','U_Plz','U_Ort','U_Visibility'];
		}
		
		/*
			Select Freunde von User
			!!Noch nicht getestet, nur Idee!!
		*/
		
		public function getFriends()
		{
			$friends = $this->select("B_FriendList",array("F_U_ID" => $this->U_ID), FALSE, FALSE, NULL); //JOIN! wegen namen
			return $friends;
		}
		
		/*
			Select Events von User
			!!Noch nicht getestet, nur Idee!!
		*/
		
		public function getEvents()
		{
			$events = $this->select("B_Event",array("E_U_Creator" => $this->U_ID), FALSE, FALSE, NULL);
			return $events;
		}
		
		/*
			Select Notizen von User
			!!Noch nicht getestet, nur Idee!!
		*/
		
		public function getNotizen()
		{
			$notizen = $this->select("B_Notizen",array("N_U_ID" => $this->U_ID), FALSE, FALSE, NULL);
			return $notizen;
		}
	}

?>