<?php

$DatenAusDB = array(
		'title' => '',
		'description' => '',
		'datetime' => ''
);
if (isset($_GET['e_id'])){
	/* 		
	 * 		DB Abfrage nach dieser Userid / Eventid
	 * 		Damit diese Werte beim Editieren eingefügt werden können
	 *  
	 *  */

	$DatenAusDB = array(
			'title' => 'blub',
			'description' => 'more blub',
			'start' => '05/07/2015 11:35 AM',
			'end' => '05/07/2015 11:45 AM'
	);
}

	if(isset($_POST['submit'])){
		
		xDebug($_POST);
	   
		$rules_array = array
		(
	        'title'=>array('type'=>'string',  'required'=>true, 'min'=>2, 'max'=>250, 'trim'=>true, 'special_chars'=>false),
	        'description'=>array('type'=>'string',  'required'=>false, 'min'=>2, 'max'=>250, 'trim'=>true, 'special_chars'=>false),
	        'start'=>array('type'=>'string',  'required'=>true, 'min'=>2, 'max'=>250, 'trim'=>true, 'special_chars'=>false),
	        'end'=>array('type'=>'string',  'required'=>true, 'min'=>2, 'max'=>250, 'trim'=>true, 'special_chars'=>false),
         );
		
		$validate = new validation();
		$validate->addSource($_POST);
		$validate->AddRules($rules_array);
		$validate->run();
		
		if(sizeof($validate->errors) == 0)
		{	 
			 //kristian start
			 $db_event = new dbclass_event();
// 			 /*
// 				E_ID ist bei Phil so ein komisches Gerüst, daher mache ich das mit getGUID
// 				start = DateVon oder TimeVon? 
// 				end = DateBis oder TimeBis?
// 			 */
			 $insertvalues = array("E_ID" => $db_event->getGUID(),"E_Ueberschrift" => $validate->sanitized["title"],"E_Beschreibung" => $validate->sanitized["description"],"E_DateVon" => $validate->sanitized["start"],"E_DateBis" => $validate->sanitized["end"]);
			 $insertevent = $db_event->insert($inservalues);
			 //kristian ende
			xDebug($validate->errors);
		}
		
		/*** show the array of validated and sanitized variables ***/
		xDebug($validate->sanitized);
	}
?>
<form class="form-horizontal" id="event-form" method="post" autocomplete="off">
	<fieldset>
	
	<!-- Form Name -->
	<legend>Event-Erstellung</legend>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="title">Name</label>  
	  <div class="col-md-4">
	  <input value="<?php echo $DatenAusDB['title']; ?>" id="title" name="title" placeholder="Titel" class="form-control input-md" required="" type="text">
	    
	  </div>
	</div>
	
	<!-- Textarea -->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="description">Beschreibung</label>
	  <div class="col-md-4">                     
	    <textarea class="form-control" id="description" name="description"><?php echo $DatenAusDB['description']; ?></textarea>
	  </div>
	</div>
	
	
	
	<!-- DateTimePicker -->
	        <div class="form-group">
	        <label class="col-md-4 control-label" for="datetimepicker1">Startzeit</label>  
	            <div class='input-group date col-md-4' id='datetimepicker1'>
	                <input value="<?php echo $DatenAusDB['start']; ?>" type='text' class="form-control" id="start" />
	                <span class="input-group-addon">
	                    <span class="glyphicon glyphicon-calendar"></span>
	                </span>
	            </div>
	        </div>

	        <div class="form-group">
	        <label class="col-md-4 control-label" for="datetimepicker2">Endzeit</label> 
	            <div class='input-group date col-md-4' id='datetimepicker2'>
	                <input value="<?php echo $DatenAusDB['end']; ?>" type='text' class="form-control" id="end" />
	                <span class="input-group-addon">
	                    <span class="glyphicon glyphicon-calendar"></span>
	                </span>
	            </div>
	        </div>
	
	<!-- Button (Double) -->
	<div class="form-group">
	  <div class="col-md-12">
		  <div class="col-md-4"></div>
		  <div class="col-md-4">
		    <a class="btn btn-info" href="/wishlist?e_id=1">Wunschliste bearbeiten</a>
		    <a class="btn btn-info" href="#">Gästeliste bearbeiten</a>
	    </div>
	  </div>
	</div>
	
	<!-- Multiple Radios -->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="radios">Sichtbarkeit</label>
	  <div class="col-md-4">
	  <div class="radio">
	    <label for="radios-0">
	      <input name="radios" id="radios-0" value="1" checked="checked" type="radio">
	      Public
	    </label>
		</div>
	  <div class="radio">
	    <label for="radios-1">
	      <input name="radios" id="radios-1" value="2" type="radio">
	      Privat
	    </label>
		</div>
	  </div>
	</div>
	
		<!-- Button (Double) -->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="submit"></label>
	  <div class="col-md-8">
	    <button id="submit" name="submit" class="btn btn-success">Speichern</button>
	    <button id="cancel" name="cancel" class="btn btn-warning">Abbrechen</button>
	  </div>
	</div>
	
	</fieldset>
</form>






<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
			locale: 'de'
            });
        $('#datetimepicker2').datetimepicker({
			locale: 'de'
        });
        $("#datetimepicker1").on("dp.change", function (e) {
            $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker2").on("dp.change", function (e) {
            $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>