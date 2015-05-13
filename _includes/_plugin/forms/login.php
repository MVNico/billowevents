<?php
// xDebug($_POST);


	if(isset($_POST['submit'])){
	   		
		$rules_array = array
		(
	        'login_email'=>array('type'=>'email',  'required'=>true, 'min'=>6, 'max'=>150, 'trim'=>true, 'special_chars'=>false),
	        'login_password'=>array('type'=>'string',  'required'=>true, 'min'=>1, 'max'=>50, 'trim'=>true, 'special_chars'=>false),
	    );
		
		$validate = new validation();
		$validate->addSource($_POST);
		$validate->AddRules($rules_array);
		$validate->run();
		
		if(sizeof($validate->errors) == 0)
		{
			
			$whereclause = array(
				"AND" =>[
					"U_Email" => $validate->sanitized['login_email'],
					"U_PW" => hash("md5",$validate->sanitized['login_password'])
					//wegen tests noch drin
					//"U_PW" => $validate->sanitized['login_password']
				]
			);
			
			$user = new dbclass_user();
			$userexists = $user->userExists($whereclause);

			if($userexists != 0){
				$_SESSION['user'] = $userexists["U_ID"];
				header('location:overview');
			 }
		}

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
		  <label class="col-md-4 control-label" for="login_email">User</label>  
		  <div class="col-md-4">
		  <input id="login_email" name="login_email" placeholder="User-Email" class="form-control input-md" type="text">
		    
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
		  </div>
		</div>
		</fieldset>
	</form>
HTML;
	}else {
	header('location:overview');
	}