<html>
	<head>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
		.btn-sm:hover
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
					<form class="form-horizontal" method="post">
							<center><img src="<?php echo base_url() ?>/assets/images/logo.png" width="225" height="150" style="margin-bottom:20px"></center>
						<div class="form-group">
							<label>Email:</label>
				    		<div class="input-group">
						        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input type="text" name="email" class="form-control" id="emailid" autofocus placeholder="Enter email">	
					    	</div>
							<span id="msg2"></span>
						</div>
						<div class="form-group">
                             <label>Select Admin:</label>
                             <select class="form-control" name="AdminID" id="AdminID">
                            <?php
                                foreach($AdminDetails as $a)
                                {
                            ?>
                                     <option value="<?php echo $a->Admin_id; ?>"><?php echo $a->DisplayName; ?></option>
                            <?php
                                }
                            ?>
                             </select>
                        </div>
						<div class="form-group">
					        	<div class="g-recaptcha" data-sitekey="6Ld-i30UAAAAAJTiM6jS4YpFM10Cz7x85jy6655H"></div>
                        </div><br>
						<div class="form-group text-center">						
							<input type="button" id="submit" onclick="return validateRegistration(this);" style="color:white;width:100px;height:40px;background-color:#0071BC;font-weight:bold;" class="btn btn-sm" name="signup" value="Sign Up">&nbsp;&nbsp;
							<input type="reset" style="color:white;width:100px;height:40px;background-color:#0071BC;font-weight:bold;" class="btn btn-sm" value="Cancel">
						</div>
						<div class="form-group">
					        	<center><p style="font-size:17px;"><b>Back to <a syle="text-decoration:none;font-size:17px;" href="<?php echo site_url()?>Questions/Login">Sign In</a></b></p></center>
                        </div>
					</form>
				</div><div class="col-md-3"></div>
		        </div>
			</div>
		</div>
	</body>
</html>
