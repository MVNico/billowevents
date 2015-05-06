<?php 

	class dbclass_all{
		
		private 
				$_database = NULL;
		
		private function getDatabase()
		{
			if($this->_database == NULL)
			{
				$db = new medoo([
					'database_type'=>'mssql',
					'database_name'=>'Billowdb',
					'server'=>'frozenbit.de',
					'username'=>'BillowUser',
					'password'=>'Fiae13BillowEvents',
					'charset'=>'utf8'
				]);
				$_database = $db;
			}
			else
			{
				$db = $_database;
			}
			
			return $db;
		}
		/*	nico.neumann@multivisio.de
			Update Funktion:
			$where = whereclause im select befehl
			$single = holt nur ersten Record aus der Tabelle
			$exists = schaut nach ob Eintrag vorhanden -> gut für PW-Validation. Laut Medoo am Schnellsten.
			$join = JOIN-Tabellen !!fehlt noch!!
		*/
		public function select($table = NULL, $where = NULL, $single = false, $exists = false, $join = NULL)
		{
			$database = $this->getDatabase();
			
			$whereclause = array();
			if($where != NULL){
				$whereclause = $where;
			}
			if($table == NULL){
				$table = $this->_tablename;
			}

			if($join == NULL){
				if($single){
					$tets = $database->get($table,$this->_columns,$whereclause);
					$this->setClassvar($tets);
				}
				elseif($exists AND $where != NULL){
					$tets = $database->has($table,$whereclause);
				}
				else{
					$tets = $database->select($table,$this->_columns,$whereclause);
				}
			}
			else{
				
			}
			//error einbauen?
			return $tets;
			
		}
		
		/*
			Update insert
			$_updatevalues = Werte, die eingetragen werden. Struktur.
			$_whereclause = whereclause im select befehl
			Liefert Anzahl veränderter Einträge zurück
		*/
		
		public function update($_updatevalues,$_whereclause = NULL)
		{
			$database = $this->getDatabase();
			
			$update = $database->update($this->_tablename,$_updatevalues,$_whereclause);
			//error einbauen?
			return $update;
		}
		
		/*
			Funktion insert
			$_insertvalues = Werte, die eingetragen werden. Struktur.
			Liefert -1 bei Erfolg, 0 bei misserfolg
		*/
		
		public function insert($_insertvalues)
		{
			$database = $this->getDatabase();
			
			$insert = $database->insert($this->_tablename,$_insertvalues);
			//error einbauen?
			return $insert;
		}
		
		/*
			Funktion Delete
			$_whereclause = whereclause im Delete befehl
			Liefert anzahl gelöschter Elemente zurück
			!!testen!!
		*/
		
		public function delete($_whereclause)
		{
			$database = $this->getDatabase();
			//error einbauen?
			//$delete = $database->delete($this->_tablename,$_whereclause)
		}
		
		/*
			set Klassenvariablen
			$_ccolumn = Name der Variable
			$_value = der zu setzende Wert
		*/
		
		public function setvar($_ccolumn,$_value)
		{
			$this->$_ccolumn = $_value;
		}
		
		/*
			get Klassenvariablen
			$_scolumn = Name der Variable
		*/
		
		public function getvar($_scolumn)
		{
			return $this->$_scolumn;
		}
		
		//alle Spalten der DB (in __construct aufgeführt) bekommen
		public function getAllColumns()
		{
			return $this->_columns;
		}
		
		//create GUID 
		function getGUID(){
			if (function_exists('com_create_guid')){
				return com_create_guid();
			}else{
				mt_srand((double)microtime()*10000);
				$charid = strtoupper(md5(uniqid(rand(), true)));
				$hyphen = chr(45);// "-"
				$uuid = chr(123)// "{"
					.substr($charid, 0, 8).$hyphen
					.substr($charid, 8, 4).$hyphen
					.substr($charid,12, 4).$hyphen
					.substr($charid,16, 4).$hyphen
					.substr($charid,20,12)
					.chr(125);// "}"
				return $uuid;
			}
		}
		
		//Klassenvariablen füllen bei single objekten
		// TESTEN!
		public function setClassvar($aSelect)
		{
			foreach($this->_columns as $cc)
			{
				$this->setvar($cc,$aSelect[$cc]);
			}
		}
		
	}


?>