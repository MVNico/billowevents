<?php 
	include_once PARTIALS_PATH.'/header.php';	
	include_once PARTIALS_PATH.'/topmenu.php';
	
	if (isset($_SESSION['user'])){
		include_once PARTIALS_PATH.'/submenu.php';		
	}
	
?>


<div class="container-fluid">

		  <div class="row">
			  <div class="col-md-2"></div>
			  <div class="col-md-8">
<?php
	
	$file = $objMenu->get_activePage('file');
	
	include(FILE_PATH.'/'.$file.'.php');
?>
			</div>
			  <div class="col-md-2"></div>
		</div>
</div>
<?php
	include_once PARTIALS_PATH.'/footer.php';
?>