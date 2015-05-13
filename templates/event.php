<?php 
	include_once PARTIALS_PATH.'/header.php';	
	$Menu = $objMenu->get_arrMenu();
	include_once PARTIALS_PATH.'/topmenu.php';
	
	if (isset($_SESSION['user'])){
		include_once PARTIALS_PATH.'/submenu.php';
	}
	
	$dbuser = new dbclass_user();
	
	//Notizen oder Events löschen
	if(isset($_GET['del'])){
		if($_GET['del'] == 'notiz'){
			$whereclause = [
				"AND" => [
					"N_ID" => $_GET["id"],
					"N_U_ID" => $_SESSION["user"]
				]];
			$dbuser->delete("B_Notizen",$whereclause);
		}
		elseif($_GET['del'] == 'event'){
			$whereclause = [
				"AND" => [
					"E_ID" => $_GET["id"],
					"E_U_Creator" => $_SESSION["user"]
				]];
			$dbuser->delete("B_Event",$whereclause);
		}

		header('location:overview');
	}
	
	//Events als Gast verlassen
	if(isset($_GET['leave'])){
		$whereclause = [
			"AND" => [
				"GL_E_ID" => $_GET['id'],
				"GL_U_ID" => $_SESSION['user']
			]];
		$dbuser->delete("B_Gaesteliste",$whereclause);
		header('location:overview');
	}

	//holt alle eigenen Events
	$events_all_own = $dbuser->getEvents_own($_SESSION["user"]);
	//holt alle events an denen der user teilnimmt
	$events_all_participate = $dbuser->getEvents_participate($_SESSION["user"]);
	//holt alle user-Notizen
	$notizen_all = $dbuser->getNotizen_all($_SESSION["user"]);
	
?>
        
<div class="container-fluid">
		  <div class="row">
			  <div class="col-md-4">
				<div id="inv_events">
				<label>Du bist bei diesen Events dabei:</label>
				  	<table class="table">
					  	<thead>
						  	<th>#</th>
						  	<th>Datum / Uhrzeit</th>
						  	<th>Eventname</th>
						  	<th></th>
							<th></th>
							<th></th>
					  	</thead>
					  	<tbody>
							<?php 
								$loopcounter = 0;
								foreach($events_all_participate as $events_all_participate_single){ 
									$loopcounter ++;
									if($loopcounter & 1){
										//ungerade = active
										$trclass = "active";
									}
									else{
										//gerade = success
										$trclass = "success";
									}
									?>
									<tr class="<?php echo $trclass; ?>">
										<th scope="row"><?php echo $loopcounter ?></th>
										<td>
											<table>
												<tr><td><?php echo $events_all_participate_single["E_Datevon"]; ?></td></tr>
												<tr><td><?php echo $events_all_participate_single["E_TimeVon"]; ?></td></tr>
											</table>
										</td>
										<td>
											<table>
												<tr><td><?php echo $events_all_participate_single["E_Datebis"]; ?></td></tr>
												<tr><td><?php echo $events_all_participate_single["E_TimeBis"]; ?></td></tr>
											</table>
										</td>
										<td><?php echo $events_all_participate_single["E_Ueberschrift"]; ?></td>
										<td><a class="btn btn-info btn-xs" href="/eventoverview?e_id=<?php echo $events_all_participate_single["E_ID"]; ?>">Ansehen</a></td>
										<td><a class="btn btn-warning btn-xs" href="/overview?del=event&id=<?php echo $events_all_participate_single["E_ID"]; ?>">Verlassen</a></td>
									</tr>
							<?php } ?>
					  	</tbody>
					</table>
				</div>
				
				<div id="own_events">
				<label>Deine erstellten Events:</label>
				  	<table class="table">
					  	<thead>
						  	<th>#</th>
						  	<th>Datum / Uhrzeit</th>
						  	<th>Eventname</th>
						  	<th>Überschrift</th>
							<th>Beschreibung</th>
							<th></th>
							<th></th>
							<th></th>
					  	</thead>
					  	<tbody>
							<?php 
								$loopcounter = 0;
								foreach($events_all_own as $events_all_own_single){ 
									$loopcounter ++;
									if($loopcounter & 1){
										//ungerade = active
										$trclass = "active";
									}
									else{
										//gerade = success
										$trclass = "success";
									}
									?>
									<tr class="<?php echo $trclass; ?>">
										<th scope="row"><?php echo $loopcounter ?></th>
										<td>
											<table>
												<tr><td><?php echo $events_all_own_single["E_Datevon"]; ?></td></tr>
												<tr><td><?php echo $events_all_own_single["E_TimeVon"]; ?></td></tr>
											</table>
										</td>
										<td>
											<table>
												<tr><td><?php echo $events_all_own_single["E_Datebis"]; ?></td></tr>
												<tr><td><?php echo $events_all_own_single["E_TimeBis"]; ?></td></tr>
											</table>
										</td>
										<td><?php echo $events_all_own_single["E_Ueberschrift"]; ?></td>
										<td><?php echo $events_all_own_single["E_Beschreibung"]; ?></td>
										<td><a class="btn btn-info btn-xs" href="/overview?e_id=<?php echo $events_all_own_single["E_ID"]; ?>">EDIT</a></td>
										<td><a class="btn btn-info btn-xs" href="/eventoverview?e_id=<?php echo $events_all_own_single["E_ID"]; ?>">Ansehen</a></td>
										<td><a class="btn btn-warning btn-xs" href="/overview?del=event&id=<?php echo $events_all_own_single["E_ID"]; ?>">Löschen</a></td>
									</tr>
							<?php } ?>
					  	</tbody>
					</table>
				</div>
				
				<div id="notes">
				<label>Notizen</label>
				  	<table class="table">
					  	<thead>
						  	<th>#</th>
							<th>Titel</th>
						  	<th>Beschreibung</th>
						  	<th></th>
							<th></th>
					  	</thead>
					  	<tbody>
							<?php 
								$loopcounter = 0;
								foreach($notizen_all as $notizen_single){ 
									$loopcounter ++;
									if($loopcounter & 1){
										//ungerade = active
										$trclass = "active";
									}
									else{
										//gerade = success
										$trclass = "success";
									}
									?>
									<tr class="<?php echo $trclass; ?>">
										<th scope="row"><?php echo $loopcounter; ?></th>
										<td><?php echo $notizen_single["N_Beschreibung"]; ?></td>
										<td><?php echo $notizen_single["N_Text"]; ?></td>
										<td><a class="btn btn-info btn-xs" href="/note?id=<?php echo $notizen_single["N_ID"]; ?>">EDIT</a></td>
										<td><a class="btn btn-warning btn-xs" href="/overview?del=notiz&id=<?php echo $notizen_single["N_ID"]; ?>">Löschen</a></td>
									</tr>
							<?php } ?>
					  	</tbody>
					</table>
					<a href="/note?id=0" class="btn btn-success">ADD</a>
				</div>
			</div>
		  <div class="col-md-8">
<?php
	
	$file = $objMenu->get_activePage('file');
	
	include(FILE_PATH.'/'.$file.'.php');
?>
			</div>
		</div>
</div>
<?php
	include_once PARTIALS_PATH.'/footer.php';
?>