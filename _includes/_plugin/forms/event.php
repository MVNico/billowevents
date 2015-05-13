<?php
/*
	title = E_Ueberschrift
	description = E_Beschreibung
	sichtbarkeit: 1 = public, 2 = private
*/

	$DatenAusDB = array(
			'title' => '',
			'description' => '',
			'datetime' => '',
			'sichtbarkeit' => 1,
			'ort' => '',
			'id' => 0
	);
	if (isset($_GET['e_id'])){
		
		$whereclause = [
			"AND" => [
				"E_ID" => $_GET["e_id"],
				"E_U_Creator" => $_SESSION["user"]
				]
			];
		$db_event = new dbclass_event();
		$dbevent_select = $db_event->select(null,null,$whereclause,null,true);
		$DatenAusDB["title"] = $dbevent_select["E_Ueberschrift"];
		$DatenAusDB["description"] = $dbevent_select["E_Beschreibung"];
		
		$datetime_start = date_create($dbevent_select["E_Datevon"]." ".$dbevent_select["E_TimeVon"]);
		$datetime_bis = date_create($dbevent_select["E_Datebis"]." ".$dbevent_select["E_TimeBis"]);
		$DatenAusDB["start"] = date_format($datetime_start,"d.m.Y H:i"); //gibt "dd/mm/yyyy hh:mm am/pm" aus
		$DatenAusDB["end"] = date_format($datetime_bis,"d.m.Y H:i");
		$DatenAusDB["id"] = $dbevent_select["E_ID"];
		$DatenAusDB["sichtbarkeit"] = $dbevent_select["E_Sichtbarkeit"];
		$DatenAusDB["ort"] = $dbevent_select["E_Ort"];
		
		$get_items = $event->getItems($_GET["e_id"]); //get Event-Items
		$get_gaeste = $event->getGaeste($_GET["e_id"]); //get Event-Gäste
	}

		
		
	if(isset($_POST['submit']) || isset($_POST['guestlist']) || isset($_POST['friendlist'])){
		
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
			$db_event = new dbclass_event();
			$res = $validate->sanitized;
			$start = date_create($res["start"]);
			$end = date_create($res["end"]);
			$start_date = date_format($start,"Y-m-d");
			$start_time = date_format($start,"H:i:s");
			$end_date = date_format($end,"Y-m-d");
			$end_time = date_format($end,"H:i:s");

			$values = array(
				"E_Ueberschrift" => $res["title"],
				"E_Beschreibung" => $res["description"],
				"E_DateVon" => $start_date,
				"E_DateBis" => $end_date,
				"E_Timevon" => $start_time,
				"E_Timebis" => $end_time,
				"E_Sichtbarkeit" => $_POST["radios"]
			);
			
			if (isset($_GET['e_id'])){
				$whereclause = [
					"AND" =>
						[
							"E_ID" => $_GET['e_id'],
							"E_U_Creator" => $_SESSION['user']
						]];
				$updateevent = $db_event->update($values,$whereclause);
			}
			else{
				$eventid = $db_event->getGUID();
				$eventid_insert = [
					"E_ID" => $eventid,
					"E_U_Creator" => $_SESSION['user']
					];
				$mmm = array_merge($values,$eventid_insert);
				$insertevent = $db_event->insert($mmm);
			}
			
		}
		
		switch ($_POST){
			case 'guestlist': 	
								if(isset($_GET['e_id'])){
									header('location:adduser?e_id='.$_GET['e_id'].'');									
								}else{
									header("location:adduser?e_id='.$eventid.'");
								}	
								break;
			case 'itemlist':	
								if(isset($_GET['e_id'])){
									header('location:adduser?e_id='.$_GET['e_id'].'');
								}else{
									header("location:adduser?e_id='.$eventid.'");
								}
								break;
			case 'submit':		
				break;
		}

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
	    <textarea class="form-control" id="description" name="description" placeholder="Beschreibung"><?php echo $DatenAusDB['description']; ?></textarea>
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="title">Ort</label>
	  <div class="col-md-4">
		<input value="<?php echo $DatenAusDB['ort']; ?>" id="ort" name="ort" placeholder="Ort" class="form-control input-md" required="" type="text">
	  </div>
	</div>
	
	<!-- DateTimePicker -->
	<div class="form-group">
	<label class="col-md-4 control-label" for="datetimepicker1">Startzeit</label>  
		<div class='input-group date col-md-4' id='datetimepicker1'>
			<input value="<?php echo $DatenAusDB['start']; ?>" type='text' class="form-control" id="start" name="start" />
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
		</div>
	</div>

	<div class="form-group">
	<label class="col-md-4 control-label" for="datetimepicker2">Endzeit</label> 
		<div class='input-group date col-md-4' id='datetimepicker2'>
			<input value="<?php echo $DatenAusDB['end']; ?>" type='text' class="form-control" id="end" name="end" />
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
		 	<button id="guestlist" name="guestlist" class="btn btn-info">Gästeliste bearbeiten</button>
		 	<button id="itemlist" name="itemlist" class="btn btn-info">Wunschliste bearbeiten</button>
	    </div>
	  </div>
	</div>
	
	<!-- Multiple Radios -->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="radios">Sichtbarkeit</label>
	  <div class="col-md-4">
	  <div class="radio">
	    <label for="radios-0">
	      <input name="radios" id="radios-0" value="1" <?php if($DatenAusDB["sichtbarkeit"] == 1){ ?> checked="checked" <?php } ?> type="radio">
	      Public
	    </label>
		</div>
	  <div class="radio">
	    <label for="radios-1">
	      <input name="radios" id="radios-1" value="2" <?php if($DatenAusDB["sichtbarkeit"] == 2){ ?> checked="checked" <?php } ?> type="radio">
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