<?php 
	include_once PARTIALS_PATH.'/header.php';	
	$Menu = $objMenu->get_arrMenu();
	include_once PARTIALS_PATH.'/topmenu.php';
	
	if (isset($_SESSION['user'])){
		include_once PARTIALS_PATH.'/submenu.php';
	}

?>
        
<div class="container-fluid">
		  <div class="row">
			  <div class="col-md-4">
			  
			<?php

//			kristian start
// 			 $db_event = new dbclass_event();
// 			 $select_all_events = $db_event->select(null,null,null,null);

// 				Auch möglich: 
// 			$select_all_events = $db_event->select();
// 		 xDebug($select_all_events);
			?>
				<div id="inv_events">
				<label>Du bist bei diesen Events dabei:</label>
				  	<table class="table">
					  	<thead>
						  	<th>#</th>
						  	<th>Datum / Uhrzeit</th>
						  	<th>Eventname</th>
						  	<th></th>
					  	</thead>
					  	<tbody>
						  	<tr class="active">
						  		<th scope="row">1</th>
						  		<td>02.04.2016 15:32</td>
						  		<td>Tischtennistunier</td>
						  		<td><a class="btn btn-info btn-xs" href="#">Ansehen</a></td>
						  		<td><a class="btn btn-warning btn-xs" href="#">Verlassen</a></td>
						  	</tr>
							<tr class="success">
						  		<th scope="row">2</th>
								<td>04.02.2016 10:31</td>
								<td>Bingo</td>
								<td><a class="btn btn-info btn-xs" href="#">Ansehen</a></td>
								<td><a class="btn btn-warning btn-xs" href="#">Verlassen</a></td>
							</tr>
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
						  	<th></th>
					  	</thead>
					  	<tbody>
						  	<tr class="active">
						  		<th scope="row">1</th>
						  		<td>02.04.2016 15:32</td>
						  		<td>Kuchen essen</td>
						  		<td><a class="btn btn-info btn-xs" href="/overview?e_id=1">EDIT</a></td>
						  		<td><a class="btn btn-info btn-xs" href="#">Ansehen</a></td>
						  		<td><a class="btn btn-warning btn-xs" href="#">Löschen</a></td>
						  	</tr>
							<tr class="success">
						  		<th scope="row">2</th>
								<td>04.02.2016 10:31</td>
								<td>Mehr kuchen!</td>
								<td><a class="btn btn-info btn-xs" href="/overview?e_id=2">EDIT</a></td>
								<td><a class="btn btn-info btn-xs" href="#">Ansehen</a></td>
								<td><a class="btn btn-warning btn-xs" href="#">Löschen</a></td>
							</tr>
					  	</tbody>
					</table>
				</div>
				
				<div id="notes">
				<label>Notizen</label>
				  	<table class="table">
					  	<thead>
						  	<th>#</th>
						  	<th>Datum / Uhrzeit</th>
						  	<th>Notiz</th>
						  	<th></th>
					  	</thead>
					  	<tbody>
						  	<tr class="active">
						  		<th scope="row">1</th>
						  		<td>02.04.2016 15:32</td>
						  		<td>Einkaufen</td>
						  		<td><a class="btn btn-info btn-xs" href="/note?id=1">EDIT</a></td>
						  		<td><a class="btn btn-warning btn-xs" href="#">Löschen</a></td>
						  	</tr>
							<tr class="success">
							<th scope="row">2</th>
						  		<td>01.01.2018 15:32</td>
						  		<td>Schlafen</td>
						  		<td><a class="btn btn-info btn-xs" href="/note?id=2">EDIT</a></td>
						  		<td><a class="btn btn-warning btn-xs" href="#">Löschen</a></td>
							</tr>
					  	</tbody>
					</table>
					<a href="#" class="btn btn-success">ADD</a>
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