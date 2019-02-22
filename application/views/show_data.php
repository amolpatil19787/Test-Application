<!DOCTYPE html>
<html>
	<head>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/UserFunctions.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
		
			<title>QUESTION & ANSWER</title>
    <link rel="icon" type="image/ico" href="<?php echo base_url() ?>/assets/images/logo.png" />
		
	<style>
		.qp
		{
			margin:5px 0px;
			text-align:center;
			font-size:18px;
			border:0px;
		}
		
		 @media screen and (min-width:300px) {
		    
		    .logo
		    {
		        margin:5px 5px !important;
		    }
			}
	</style>
	
	</head>
	
	<body>
	
<nav class = "navbar navbar-default" role = "navigation" style="background-color:#F8F8F8;box-shadow: 5px 5px 10px #E8E8E8;">
   
   <div class = "navbar-header">
      <button type = "button" class = "navbar-toggle" 
         data-toggle = "collapse" data-target = "#example-navbar-collapse" style="margin-right:5px !important;">
         <span class = "sr-only">Toggle navigation</span>
         <span class = "icon-bar"></span>
         <span class = "icon-bar"></span>
         <span class = "icon-bar"></span>
      </button>
		
      <div class="navbar-header">
     			<a href="<?php echo site_url() ?>Questions/ShowQuestionPaper"><img class="logo" src="<?php echo base_url() ?>/assets/images/logo2.png" width="225" height="35" style="margin:10px 15px;"></a>
    		</div>
   </div>
   
   <div class = "collapse navbar-collapse" id = "example-navbar-collapse">
	
      <ul class="nav navbar-nav navbar-right">
         <li><a style="color:#23527c;"><?php echo $this->session->userdata('user_session'); ?></a></li>
         <li><a style="color:#23527c;" href = "<?php echo site_url() ?>/Questions/Logout">Logout</a></li>
      </ul>
   </div>
   
</nav>

			<div class="container">
			        <div style="overflow-x:auto;">
			       	<table class="table table-bordered">
					<tr style="font-size:20px;">
					<th class="text-center">No</th>
					<th class="text-center">Question Paper Name</th>
					<th class="text-center">Date</th>
					<th class="text-center">Open</th>
					<th class="text-center">Paper Attempt Date</th>
					<th class="text-center">Paper Submission Date</th>
					<th class="text-center">Result</th>
					</tr>
					
					<?php
					$no=1;	
					
						foreach($question_papers as $qp)
						{	
							if($qp->IsLive=='1')
							{
								$b = $qp->Title;
								
						//	echo $qp->QuePaperID;
					?>
							<form method="post" id="myform">
							<tr>
							<td><p class="qp"><?php echo $no; ?></p></td>
							<input type="hidden" name="que_paper_id" value="<?php echo $qp->QuePaperID ?>">
							<td class="text-center"><p class="qp"><?php echo $qp->Title ?></p></td>
							<input type="hidden" name="qp_name" value="<?php echo $qp->Title ?>">
							<td class="text-center"><p class="qp"><?php $originalDate =$qp->Date; 
                            echo $newDate = date("d-m-Y", strtotime($originalDate)); ?></p></td>
							<td class="text-center"><input type="button" id="test" onclick="SubmitForm(this)" class="btn btn-link" value="Test" style="font-size:18px;"></td>
						
					<?php
                            $found=false;
							for($a=0;$a<count($UserQuePaperDetails);$a++)
							{
								if($UserQuePaperDetails[$a]->QuePaperID==$qp->QuePaperID)
								{
					?>
									<td class="text-center">	<p class="qp"><?php $originalDate =$UserQuePaperDetails[$a]->QuePaperAttemptDate; 
                                    echo $newDate = date("d-m-Y H:i:s", strtotime($originalDate)); ?></p></td>
					<?php
									$found=true;
								}
							}
					?>
					    <?php
								if($found==false)
								{
					?>
								<td>	</td>
					<?php
								}
								
								$flag=0;
								for($a=0;$a<count($UserQuePaperDetails);$a++)
							{
								if($UserQuePaperDetails[$a]->QuePaperID==$qp->QuePaperID && $UserQuePaperDetails[$a]->QuePaperSubmissionDate!=null)
								{
					?>
									<td class="text-center">	<p class="qp"><?php $originalDate =$UserQuePaperDetails[$a]->QuePaperSubmissionDate; 
                                    echo $newDate = date("d-m-Y H:i:s", strtotime($originalDate)); ?></p></td>
					<?php
									$flag=1;
								}
							}
					?>
					    <?php
								if($flag==0)
								{
					?>
								<td>	</td>
					<?php
								}
					?>
					    
						<td class="text-center"><input type="button" onclick="SubmitFormResult(this)" name="result" class="btn btn-link" value="Result" style="font-size:18px;"></td>
					<?php
						$no++;
					?>
						</tr></form>
							
					<?php
							}
						
						}				
						
					?>
							
							
					
					
				</table>
				</div>
			</div>	
	</body>
</html>
