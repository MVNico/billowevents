<?php
	if(isset($_POST['submit'])){
		
	   
		$rules_array = array
		(
	        'name'=>array('type'=>'string',  'required'=>true, 'min'=>2, 'max'=>250, 'trim'=>true, 'special_chars'=>true),
	        'lastname'=>array('type'=>'string',  'required'=>true, 'min'=>2, 'max'=>250, 'trim'=>true, 'special_chars'=>true),
	        'email'=>array('type'=>'email',  'required'=>false, 'min'=>6, 'max'=>250, 'trim'=>true, 'special_chars'=>false),
         );
		
		$validate = new validation();
		$validate->addSource($_POST);
		$validate->AddRules($rules_array);
		$validate->run();
		
		if(sizeof($validate->errors) > 0)
		{
			/*
			 * 	Wenn keine Fehler vorliegen, kannst du die Werte aus den bereinigten Eingabewerten in die DB schreiben
			 *  
			 *  $res = $validate->santized;
			 *  $res['name'] wäre in diesem Fall der String mit dem Namen des Users
			 * 
			 * */
			xDebug($validate->errors);
		}
		
		/*** show the array of validated and sanitized variables ***/
		xDebug($validate->sanitized);
	}
?>
<form class="form-horizontal" id="adduser-form" method="post" autocomplete="off">
	<fieldset>
	
	<!-- Form Name -->
	<legend>Gast hinzufügen</legend>
	
	<!-- Search input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="name">Vorname</label>
	  <div class="col-md-4">
	    <input id="name" name="name" placeholder="" class="form-control input-md" type="search">
	    
	  </div>
	</div>
	
	<!-- Search input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="lastname">Nachname</label>
	  <div class="col-md-4">
	    <input id="lastname" name="lastname" placeholder="" class="form-control input-md" type="search">
	    
	  </div>
	</div>
	
	<!-- Select Multiple -->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="friendlist">Freundesliste</label>
	  <div class="col-md-4">
	    <select id="friendlist" name="friendlist" class="form-control" multiple="multiple">
	    </select>
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="email">Neuen Nutzer per E-Mail einladen</label>  
	  <div class="col-md-4">
	  <input id="email" name="email" placeholder="dummy@email.com" class="form-control input-md" type="text">
	  </div>
	</div>
	
	<!-- Button -->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="submit"></label>
	  <div class="col-md-4">
	    <button id="submit" name="submit" class="btn btn-primary">Einladung versenden</button>
	  </div>
	</div>
	</fieldset>
</form>

