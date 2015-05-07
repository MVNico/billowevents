<?php
	if(isset($_POST['submit'])){
		
		xDebug($_POST);
	   
		$rules_array = array
		(
	        'comment'=>array('type'=>'string',  'required'=>true, 'min'=>5, 'max'=>250, 'trim'=>true, 'special_chars'=>false),
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
			 *  $res['comment'] wäre in diesem Fall der String mit dem Kommentar
			 * 
			 * */
			 
			//kristian start
// 			$db_eventcomment = new dbclass_eventcomments();
// 			/*
// 				Bin ich mit eventcomments richtig? ;) ODer sind das Itemcomments?
// 				Wie komme ich an globale variablen oder cookies? weil man die für die Event-ID braucht. Oder kannst du ein hidden field mit der Event-ID oder so mitschicken?
// 			*/
// 			$inservalues = ["EK_ID" => $db_eventcomment->getGUID(),"EK_E_ID" => "","EK_U_ID" => $_SESSION['user'],"EK_Kommentar" => $res['comment'],"EK_Date" => date('Y-m-d')]
// 			$insert_eventcomment = $db_eventcomment->insert($inservalues);
			//kristian ende
			xDebug($validate->errors, 'Fehler');
		}
		
		/*** show the array of validated and sanitized variables ***/
		xDebug($validate->sanitized,'Komplett');
	}
?>
<form class="form-horizontal" id="comment-form" method="post" autocomplete="off">
<fieldset>

<!-- Form Name -->
<legend>Anmerkung</legend>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="comment">Anmerkung</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="comment" name="comment"></textarea>
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-8">
    <button id="submit" name="submit" class="btn btn-success">Speichern</button>
    <button id="cancel" name="cancel" class="btn btn-danger">Abbrechen</button>
  </div>
</div>

</fieldset>
</form>
