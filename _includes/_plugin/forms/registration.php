<?php
	if(isset($_POST['submit'])){
		
		xDebug($_POST);
	   
		$rules_array = array
		(
	        'firstname'=>array('type'=>'string',  'required'=>true, 'min'=>1, 'max'=>50, 'trim'=>true, 'special_chars'=>true),
	        'lastname'=>array('type'=>'string',  'required'=>true, 'min'=>1, 'max'=>50, 'trim'=>true, 'special_chars'=>false),
	        'username'=>array('type'=>'string',  'required'=>true, 'min'=>1, 'max'=>50, 'trim'=>true, 'special_chars'=>false),
	        'email'=>array('type'=>'email',  'required'=>true, 'min'=>6, 'max'=>150, 'trim'=>true, 'special_chars'=>false),
	        'password'=>array('type'=>'password', 'required'=>true, 'min'=>6, 'max'=>120, 'trim'=>false, 'special_chars'=>false),
	        'agree'=>array('type'=>'int',  'required'=>true, 'min'=>0, 'max'=>0, 'trim'=>false, 'special_chars'=>false)
	    );
		
		$validate = new validation();
		$validate->addSource($_POST);
		$validate->AddRules($rules_array);
		$validate->run();
		
		if(sizeof($validate->errors) > 0)
		{
			/*
			 * 	Wenn keine Fehler vorliegen, kannst du die Werte aus den bereinigten Eingabewerten in die DB schreiben
			 *
			 *  $res = $validate->santized;
			 *  $res['firstname'] wäre in diesem Fall der String mit dem Vornamen
			 *
			 * */
			xDebug($validate->errors);
		}
		
		/*** show the array of validated and sanitized variables ***/
		xDebug($validate->sanitized);
	}
?>



<form class="form-horizontal" id="registration-form" method="post" autocomplete="off">
	<fieldset>
	
	<!-- Form Name -->
	<legend>Registration</legend>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="firstname">firstname</label>  
	  <div class="col-md-4">
	  <input id="firstname" name="firstname" placeholder="firstname" class="form-control input-md" type="text">
	    
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="lastname">lastname</label>  
	  <div class="col-md-4">
	  <input id="lastname" name="lastname" placeholder="lastname" class="form-control input-md" type="text">
	    
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="username">username</label>  
	  <div class="col-md-4">
	  <input id="username" name="username" placeholder="username" class="form-control input-md" type="text">
	    
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="email">Email</label>  
	  <div class="col-md-4">
	  <input id="email" name="email" placeholder="Email" class="form-control input-md">
	    
	  </div>
	</div>
	
	<!-- Password input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="password">Password</label>
	  <div class="col-md-4">
	    <input id="password" name="password" placeholder="Password" class="form-control input-md" type="password">
	    <span class="help-block">Mind. 6 Zeichen</span>
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="confirm_password">Confirm password</label>  
	  <div class="col-md-4">
	  <input id="confirm_password" name="confirm_password" placeholder="Password" class="form-control input-md"  type="password">
	    
	  </div>
	</div>
	
<!-- Multiple Checkboxes -->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="policy">Please agree to our policy</label>
	  <div class="col-md-4">
	  <div class="checkbox">
	    <label for="agree">
	      <input name="agree" id="agree" value="1" type="checkbox">
	    </label>
		</div>
	  </div>
	</div>
	
	<!-- Button (Double) -->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="submit"></label>
	  <div class="col-md-8">
	    <button id="submit" name="submit" class="btn btn-success">Submit</button>
	    <button id="cancle" name="cancle" class="btn btn-danger">Cancle</button>
	  </div>
	</div>
	
	</fieldset>
</form>