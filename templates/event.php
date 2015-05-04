<?php 
	include_once PARTIALS_PATH.'/header.php';	
	$Menu = $objMenu->get_arrMenu();
	include_once PARTIALS_PATH.'/topmenu.php';

?>
        
<div class="container-fluid">
		  <div class="row">
			  <div class="col-md-4">
			  	<table class="table">
				  	<thead>
					  	<th>#</th>
					  	<th>Blub</th>
					  	<th>asdsd</th>
					  	<th>asdsd</th>
				  	</thead>
				  	<tbody>
					  	<tr class="active">
					  		<th scope="row">1</th>
					  		<td>blub</td>
					  		<td>blub</td>
					  		<td>blub</td>
					  	</tr>
						<tr class="success">
					  		<th scope="row">2</th>
							<td>bla</td>
							<td>bla</td>
							<td>bla</td>
						</tr>
						<tr class="warning">
					  		<th scope="row">3</th>
					  		<td>bli</td>
							<td>bli</td>
							<td>bli</td>
						</tr>
						<tr class="danger">
						<th scope="row">4</th>
					  		<td>bli</td>
							<td>bli</td>
							<td>bli</td>
						</tr>
						<tr class="info">
						<th scope="row">5</th>
					  		<td>bli</td>
							<td>bli</td>
							<td>bli</td>
						</tr></tr>
				  	</tbody>
				</table>
			</div>
		  <div class="col-md-8">
<?php
	/* Hier dann die DB Verbindung für den Content der Seite*/
	
	$file = $objMenu->get_activePage('file');
	
	include(FILE_PATH.'/'.$file.'.php');
?>
			</div>
		</div>
</div>
<?php
	include_once PARTIALS_PATH.'/footer.php';
?>