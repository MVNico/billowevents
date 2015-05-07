<?php 

	class dbclass_all{
		
		private 
				$_database = NULL;//Variable für Datenbank. Wird in getDatabase gefüllt, falls erste Initialisierung. Damit nur eine Medoo-Klasse herumgurkt
		
		/*
			Spalten der Klasse angeben
		*/
		public function __construct()
		{
			$this->_columns = $this->getColumns($this->_tablename);
		}
		
		/*
			Datenbankklasse holen
		*/
		protected function getDatabase()
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

		/*	
			Update Funktion:
			$where = whereclause im select befehl
			$single = holt nur ersten Record aus der Tabelle
			$exists = schaut nach ob Eintrag vorhanden -> gut für PW-Validation. Laut Medoo am Schnellsten.
			$join = JOIN-Tabellen !!fehlt noch!!
		*/
		public function select($table = NULL, $columns = NULL, $where = NULL, $join = NULL)
		{
			$database = $this->getDatabase();
			
			if($table == NULL){
				$table = $this->_tablename;
			}
			
			if($columns == NULL){
				$columns = $this->_columns;
			}
			
			$whereclause = array();
			if($where != NULL){
				$whereclause = $where;
			}
			
			if($join == NULL){
				$tets = $database->select($table,$columns,$whereclause);
				//Falls nur ein Eintrag und Klassentabelle ungleich Abfragetabelle, muss es sich um eine ID-Abfrage (= z.B. User loggt sich ein) handeln
				if($table == $this->_tablename && count($tets) == 1){
					$this->setClassvar($tets[0]);
				}
			}
			else{
				//hier kommen noch die JOIN-Abfragen rein (falls gebraucht)
			}
			
			//kleine Errormessage, falls Datenbankfehler
			if($database->error()[0] != "00000"){
				var_dump($database->error());
			}

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
			
			//kleine Errormessage, falls Datenbankfehler
			if($database->error()[0] != "00000"){
				var_dump($database->error());
			}
			
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
			
			//kleine Errormessage, falls Datenbankfehler
			if($database->error()[0] != "00000"){
				var_dump($database->error());
			}
			
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
			$delete = 0;
			//$delete = $database->delete($this->_tablename,$_whereclause)
			
			//kleine Errormessage, falls Datenbankfehler
			if($database->error()[0] != "00000"){
				var_dump($database->error());
			}
			
			return $delete;
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
		
		//alle Spalten der DB (in getColumns aufgeführt) bekommen
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
		
		//Klassenvariablen füllen
		public function setClassvar($aSelect)
		{
			foreach($this->_columns as $cc)
			{
				$this->setvar($cc,$aSelect[$cc]);
			}
		}
		
		//Liste aller Spalten der Datenbank
		public function getColumns($table)
		{
			switch($table){
				case "B_User":
					$columns = ['U_ID','U_Anzeigename','U_PW','U_Email','U_Name','U_Vorname','U_Strase','U_HausNr','U_Plz','U_Ort','U_Visibility'];
					break;
				case "B_Event":
					$columns = ['E_ID','E_Beschreibung','E_Ueberschrift','E_Datevon','E_Datebis','E_TimeVon','E_TimeBis','E_Ort','E_Sichtbarkeit','E_U_Creator'];
					break;
				case "B_EventComments":
					$columns = ['EK_ID','EK_E_ID','EK_U_ID','EK_Kommentar','EK_Date'];
					break;
				case "B_Gaesteliste":
					$columns = ['GL_E_ID','GL_U_ID','GL_TeilnehmerStatus'];
					break;
				case "B_ItemList":
					$columns = ['I_ID','I_Name','I_Bedarfmenge','I_CurrMenge','I_Url','I_Zusatz','I_Visibility','I_E_ID','I_U_ID'];
					break;
				case "B_ItemHolder":
					$columns = ['IB_ID','IB_I_ID','IB_U_ID','IB_Anzahl'];
					break;
				case "B_ItemComments":
					$columns = ['IC_ID','IC_I_ID','IC_U_ID','IC_Comment','IC_DateTime'];
					break;
				case "B_Notizen":
					$columns = ['N_ID','N_Beschreibung','N_Text','N_U_ID'];
					break;
				case "B_Friendlist":
					$columns = ['F_U_ID','F_U_ID_F','F_Status'];
					break;
			}
			
			return $columns;
		}
		
	}


?>