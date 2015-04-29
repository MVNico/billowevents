<?php
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
		
		if(sizeof($validate->errors) > 0)
		{
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
	  <input id="title" name="title" placeholder="Titel" class="form-control input-md" required="" type="text">
	    
	  </div>
	</div>
	
	<!-- Textarea -->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="description">Beschreibung</label>
	  <div class="col-md-4">                     
	    <textarea class="form-control" id="description" name="description"></textarea>
	  </div>
	</div>
	
	
	
	<!-- DateTimePicker -->
	        <div class="form-group">
	        <label class="col-md-4 control-label" for="datetimepicker1">Startzeit</label>  
	            <div class='input-group date col-md-4' id='datetimepicker1'>
	                <input type='text' class="form-control" id="start" />
	                <span class="input-group-addon">
	                    <span class="glyphicon glyphicon-calendar"></span>
	                </span>
	            </div>
	        </div>

	        <div class="form-group">
	        <label class="col-md-4 control-label" for="datetimepicker2">Endzeit</label> 
	            <div class='input-group date col-md-4' id='datetimepicker2'>
	                <input type='text' class="form-control" id="end" />
	                <span class="input-group-addon">
	                    <span class="glyphicon glyphicon-calendar"></span>
	                </span>
	            </div>
	        </div>





	<!-- Select Multiple -->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="guestlist">Gästeliste</label>
	  <div class="col-md-4">
	    <select id="guestlist" name="guestlist" class="form-control" multiple="multiple">
	    </select>
	  </div>
	</div>
	
	<!-- Button (Double) -->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="guest_inv"></label>
	  <div class="col-md-8">
	    <button id="guest_inv" name="guest_inv" class="btn btn-info">Gast einladen</button>
	    <button id="guest_kick" name="guest_kick" class="btn btn-info">Gast entfernen</button>
	  </div>
	</div>
	
	<!-- Select Multiple -->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="itemlist">Wunschliste</label>
	  <div class="col-md-4">
	    <select id="itemlist" name="itemlist" class="form-control" multiple="multiple">
	    </select>
	  </div>
	</div>
	
	<!-- Button (Double) -->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="item_add"></label>
	  <div class="col-md-8">
	    <button id="item_add" name="item_add" class="btn btn-info">Wunsch hinzufügen</button>
	    <button id="item_delete" name="item_delete" class="btn btn-info">Wunsch entfernen</button>
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
	    <button id="cancel" name="cancel" class="btn btn-danger">Abbrechen</button>
	  </div>
	</div>
	
	</fieldset>
</form>






<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker();
        $('#datetimepicker2').datetimepicker();
        $("#datetimepicker1").on("dp.change", function (e) {
            $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker2").on("dp.change", function (e) {
            $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>