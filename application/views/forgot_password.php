<html>
	<head>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="<?php echo base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
		
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  			<script src="<?php echo base_url() ?>/assets/js/Validations.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
		
		<title>QUESTION & ANSWER</title>
        <link rel="icon" type="image/ico" href="<?php echo base_url() ?>/assets/images/logo.png" />
		
		<style>
		.main_div
		{
			padding:5%;
			padding-left:9%;
			padding-right:9%;
			background-color:#F8F8F8;
			box-shadow: 5px 5px 10px #E8E8E8;
			border-radius:10px;
		}
		.input-group-addon
		{
			background-color:white !important;	
		}
		.glyphicon-user,.glyphicon-lock
		{
			color:#C1272D !important;	
		}
		
	</style>
	</head>
	<body>
	    <nav class="navbar" style="background-color:#F8F8F8;box-shadow: 5px 5px 10px #E8E8E8;">
  		<div class="container-fluid">
   		 <div class="navbar-header">
     			<img src="<?php echo base_url() ?>/assets/images/logo2.png" width="225" height="35" style="margin:10px 0px;">
    		</div>
   
    			
  </div>
</nav>
		<div class="container" style="margin-top:40px;">
		    <div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6 main_div">
				<form method="post" class="form-horizontal" id="myform">
				    <center><img src="<?php echo base_url() ?>/assets/images/logo.png" width="225" height="150" style="margin-bottom:20px"></center>
				    <div class="row text-center" style="margin-bottom:2%;">
				        <h3 style="color:#337ab7">Forgot Password</h3>
				    </div>
					<div class="form-group">
							<label>Enter Email:</label>
							<div class="input-group">
							    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input type="email" name="email" id="emailid" class="form-control" placeholder="Enter email" autofocus>	
							</div>
					</div>
					<div class="form-group">
					        	<div class="g-recaptcha" data-sitekey="6Ld-i30UAAAAAJTiM6jS4YpFM10Cz7x85jy6655H"></div>
                        </div><br>
					<div class="form-group">
							<center><input type="button" onclick="validateForgotPass(this);" style="background-color:#0071BC;color:white;font-weight:bold;" class="btn btn-primary" value="Submit" name="submit"></center>
					</div>
					<div class="form-group">
					        	<center><p style="font-size:17px;"><b>Back to <a syle="text-decoration:none;font-size:17px;" href="<?php echo site_url()?>Questions/Login">Sign In</a></b></p></center>
                    </div>
					
				</form>	
			</div>
			<div class="col-md-3"></div>
			</div>
		</div>	
	</body>		
</html>
