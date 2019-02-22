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
	    
			<div class="container" style="margin-top:40px;">
	        <div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-6 main_div">
				<form method="post" class="form-horizontal">
				    <?php
				        if(empty($userid[0]))
				        {}
				        else{
				    ?>
		        		    <input type="hidden" id="userid" value="<?php echo $userid[0]; ?>">
				    <?php
				        }
				        if(empty($ExamCoordinatorID[0]))
				        {}
				        else
				        {
				        ?>
				            <input type="hidden" id="ExamCoID" value="<?php echo $ExamCoordinatorID[0]; ?>">
				    <?php
				        }
				        if(empty($AdminID[0]))
				        {}
				        else
				        {
				    ?>
				          <input type="hidden" id="AdminID" value="<?php echo $AdminID[0]; ?>">
				    <?php
				        }
				        if(empty($SuperAdminID[0]))
				        {}
				        else
				        {
				    ?>
				           <input type="hidden" id="SuperAdminID" value="<?php echo $SuperAdminID[0]; ?>">
				    <?php
				        }
				    ?>
				     <center><img src="<?php echo base_url() ?>/assets/images/logo.png" width="225" height="150" style="margin-bottom:20px"></center>
				     <div class="row text-center" style="margin-bottom:2%;">
				        <h3 style="color:#337ab7">Reset Password</h3>
				    </div>
					<div class="form-group">
					        <label>New Password:</label>
							<div class="input-group">
							    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input type="password" id="pass" name="password" class="form-control" autofocus>	
							</div>
					</div>
					 <div class="form-group">
							<label>Confirm Password:</label>
							<div class="input-group">
							    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input type="password" id="pass1" class="form-control">	
							</div>
					</div>
					<div class="form-group"> 
						<center><input type="button" id="submitbtn" onclick="ResetPassword(this);" class="btn btn-primary" name="reset" value="Submit"></center>
					</div>
					
				</form>	
			</div>
			<div class="col-md-3"></div>
		</div>	
		</div>
	</body>		
</html>