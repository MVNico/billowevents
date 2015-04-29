<?php 
	include_once PARTIALS_PATH.'/header.php';
	
	$Menu = $objMenu->get_arrMenu();
?>
	<nav role="navigation" class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="home" class="navbar-brand">Billow-Events</a>
        </div>
        <div id="navbarCollapse" class="collapse navbar-collapse">
        <?php echo createMenu($Menu[0]['child'], '1', $activePage);?>
        </div>
        <div class="clear"></div>
        
        <div class="container-fluid">
		  <div class="row">
			  <div class="col-md-4">Menu mit Events und Notizen</div>
			  <div class="col-md-8">Formulare und Grids für die Events</div>
			</div>
		</div>
<?php
	/* Hier dann die DB Verbindung für den Content der Seite*/
	
	$file = $objMenu->get_activePage('file');
	
	include(FILE_PATH.'/'.$file.'.php'); 
	
	include_once PARTIALS_PATH.'/footer.php';
?>
