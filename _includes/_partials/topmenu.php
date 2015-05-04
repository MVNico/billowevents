<div id="content">
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
        <?php 
        echo createMenu($Menu[0]['child'], '1', $activePage);
 		if (isset($_SESSION['user']) && !empty($_SESSION['user'])){
 			echo '<p class="navbar-text navbar-right">Signed in as '.$_SESSION['user'].' - <a href="logout" class="navbar-link">Logout</a></p>';
 		}
        ?>
        </div>
        <div class="clear"></div>
</nav>