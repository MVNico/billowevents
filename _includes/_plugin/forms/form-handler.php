<?php
if (isset($_POST['submit'])){
	foreach ($_POST as $val){
		
		print_r(htmlentities($val));
	}
}