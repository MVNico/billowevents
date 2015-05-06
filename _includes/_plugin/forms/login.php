<?php

	if(isset($_POST['submit'])){
		
		
		/* TEST ohne DB-USER-CHECK */
	   $_SESSION['user'] = '1234';
		header('location:home');
	   
		
		$rules_array = array
		(
	        'login_name'=>array('type'=>'string',  'required'=>true, 'min'=>1, 'max'=>50, 'trim'=>true, 'special_chars'=>true),
	        'login_password'=>array('type'=>'string',  'required'=>true, 'min'=>1, 'max'=>50, 'trim'=>true, 'special_chars'=>false),
	    );
		
		$validate = new validation();
		$validate->addSource($_POST);
		$validate->AddRules($rules_array);
		$validate->run();
		
		if(sizeof($validate->errors) > 0)
		{
			/*
			 * 	Wenn keine Fehler vorliegen, fragst du hier die DB nach dem Usernamen mit PW ab 
			 *  
			 * 	Wenn es den User gibt, dann $_SESSION['user'] = $user_id setzen ( oder Username )
			 * 
			 * 
			 * */
			
			/* Dieser Teil müsste dann umgearbeitet werden */
			if(!empty($res)){
				$_SESSION['user'] = $res['id'];
				header('location:home');
			}
			
			xDebug($validate->errors);
		}
		
		/*** show the array of validated and sanitized variables ***/
		xDebug($validate->sanitized);
	}
	if(!isset($_SESSION['user'])){
		echo 
<<<HTML
	<form class="form-horizontal" id="login-form" method="post" autocomplete="off">
		<fieldset>
		
		<!-- Form Name -->
		<legend>Login</legend>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="login_name">User</label>  
		  <div class="col-md-4">
		  <input id="login_name" name="login_name" placeholder="User-Name" class="form-control input-md" type="text">
		    
		  </div>
		</div>
		
		<!-- Password input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="login_password">Password</label>
		  <div class="col-md-4">
		    <input id="login_password" name="login_password" placeholder="Password" class="form-control input-md" type="password">
		    
		  </div>
		</div>
		
		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="submit"></label>
		  <div class="col-md-8">
		    <button id="submit" name="submit" class="btn btn-success">Login</button>
		    <button id="register" name="register" class="btn btn-success">Registrieren</button>
		  </div>
		</div>
		</fieldset>
	</form>
HTML;
	}else {
		echo ' mit USER-WERTEN';
		include_once PLUGIN_PATH.'\forms\registration.php';
	}
?>

