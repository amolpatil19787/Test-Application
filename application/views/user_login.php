<html>
	<head>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="<?php echo base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
        
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/Validations.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
		
		  <title>QUESTION & ANSWER</title>
    <link rel="icon" type="image/ico" href="<?php echo base_url() ?>/assets/images/logo.png" width="200px;" />
		
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
		.btn-block:hover
		{
		    background-color:#23527c !important;
		}
		
	</style>
	</head>
	<body>
		<div class="container" style="margin-top:40px;">
			<div class="row">
			 <div class="col-xs-12">
				<div class="col-md-3"></div>
				<div class="col-md-6 main_div">
					<form class="form" method="post">
						<center><img src="<?php echo base_url() ?>/assets/images/logo.png" width="225" height="150" style="margin-bottom:20px"></center>
						<div class="form-group">
							<label>Email</label>
							<div class="input-group">
    							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="text" name="email" class="form-control" id="emailid" placeholder="Enter email" autofocus>
							
							</div>
							<span id="msg2"></span>
						</div>
						<div class="form-group">
							<label>Password</label>
							<div class="input-group">
    							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="password" name="password" class="form-control" id="pass" placeholder="Enter password">
							
							</div>
							<span id="msg3"></span>
							
						</div>
						<div class="form-group">
							<b><a href="<?php echo site_url(); ?>Questions/ForgotPassword" style="float:right">Forgot Password</a></b>
						</div>
						   <br><br>
						<div class="form-group">
							<input type="button" id="submitbtn" onclick="return validateLogin(this)" style="background-color:#0071BC;color:white;font-weight:bold;" class="btn btn-block" name="login" value="Login">
						</div>
						   	
						<center><b><a href="<?php echo site_url(); ?>Questions/UserRegistration">Register Here</a></b></center>
					<!--	<div class="form-group" style="text-align:center;margin-top:40px;">
							click here to <b><a href="<?php echo site_url() ?>/Questions/UserRegistration">REGISTER NOW!</a></b>
						</div>	-->
					</form>
				</div>
				<div class="col-md-3"></div>
			</div>
			</div>
		</div>	
	<body>
</html>
