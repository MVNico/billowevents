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
				$U_Strase = NULL,
				$U_HausNr = NULL,
				$U_Plz = NULL,
				$U_Ort = NULL,
				$U_Visibility = NULL
		;
		
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
				echo"Fehlermedlung dbclass_user: <br />";
				var_dump($database->error());
			}
			
			return $_userexists;
			
		}
		
		/*
			Select Freunde von User
			!!Noch nicht getestet, nur Idee!!
		*/
		
		public function getFriends($user)
		{
			
			$where = [
				"AND" => [
				"F_U_ID" => $user,
				"F_Status" => 1
				]];
			$join = ["[><]B_FriendList" => ["U_ID" => "F_U_ID_F"]];
			$friends = $this->select(null,null,$where,$join,false);
			return $friends;
		}
		
		public function getFriends_anfrage($user)
		{
			
			$where = [
				"AND" => [
				"F_U_ID_F" => $user,
				"F_Status" => 10
				]];
			$join = ["[><]B_FriendList" => ["U_ID" => "F_U_ID"]];
			$friends_anfrage = $this->select(null,null,$where,$join,false);
			return $friends_anfrage;
		}
		
		/*
			Select eigene Events von User
		*/
		
		public function getEvents_own($user)
		{
			$table = "B_Event";
			$columns = $this->getColumns($table);
			$where = [
			"E_U_Creator" => $user,
			"ORDER" => "E_Datevon asc"
			];
			$events = $this->select($table,$columns,$where,null,false);
			return $events;
		}
		
		/*
			Select Events an denen User teilnimmt
		*/
		
		public function getEvents_participate($user)
		{
			$table = "B_Event";
			$columns = $this->getColumns($table);
			$where = [
				"AND" => [
					"GL_U_ID" => $user,
					"GL_Teilnahmestatus" => 1
					],
				"ORDER" => "E_Datevon asc"
				];
			$join = ["[><]B_Gaesteliste" => ["E_ID" => "GL_E_ID"]];
			$events = $this->select($table,$columns,$where,$join,false);
			return $events;
		}
		
		/*
			Select Notizen von User
		*/
		
		public function getNotizen_all($user)
		{
			$table = "B_Notizen";
			$columns = $this->getColumns($table);
			$where = array("N_U_ID" => $user);
			$notizen = $this->select($table,$columns,$where,NULL,false);
			return $notizen;
		}
		
		public function gethash($s)
		{

			$hash = 0;
			$len = strlen($s);
			for($i = 0; $i <$len; $i++){
				$hash = 31 * $hash + $s[$i];
				
			}
			return $hash*8;
			/*$stringLength = strlen($str);
			for ($i = 0; $i < $stringLength; $i++){
				$char = $str[$i];
				$str_int += hash("md5",$char) * 8;
			}*/
			
			//return $str_int;
		}
		
		
	}

?>