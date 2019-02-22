<!DOCTYPE html>
<html>
	<head>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url() ?>/assets/css/QuestionPaper.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>
        
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
	</style>
	</head>
	
	<body>
	    <nav class = "navbar navbar-default" role = "navigation" style="background-color:#F8F8F8;box-shadow: 5px 5px 10px #E8E8E8;">
   
   <div class = "navbar-header">
      <button type = "button" class = "navbar-toggle" 
         data-toggle = "collapse" data-target = "#example-navbar-collapse">
         <span class = "sr-only">Toggle navigation</span>
         <span class = "icon-bar"></span>
         <span class = "icon-bar"></span>
         <span class = "icon-bar"></span>
      </button>
		
      <div class="navbar-header">
     			<a href="<?php echo site_url() ?>Questions/AdminHomePage"><img src="<?php echo base_url() ?>/assets/images/logo2.png" width="225" height="35" style="margin:10px 15px;"></a>
    		</div>
   </div>
   
   <div class = "collapse navbar-collapse" id = "example-navbar-collapse">
	
      <ul class="nav navbar-nav navbar-right">
         <li><a style="color:#23527c;"><?php echo $this->session->userdata('admin_session'); ?></a></li>
         <li><a style="color:#23527c;" href = "<?php echo site_url() ?>/Questions/Logout">Logout</a></li>
      </ul>
   </div>
   
</nav>
	    <div class="container">
          <div class="row">
			        <a href="<?php echo site_url() ?>/Questions/AdminHomePage" class="btn homebtn"><i class="fa fa-home"></i> Home</a>
			</div>
      </div>
		<div class="container" style="margin-top:10px;">
		<div class="row">
		    <?php
		        /*if(empty($qp_name))
		        {
		            
		        }
		        else
		        {*/
		    ?>
			<center><h2 style="text-transform:capitalize;"><?php echo $QuePaper[0]->Title ?></h2></center>
			<?php
		        //}
			?>
		<table class="table table-bordered">
			<tr style="font-size:20px;">
					<th class="text-center">User Name</th>
					<th class="text-center">Date</th>
					<th class="text-center">Open</th>
					<th class="text-center">Marks</th>
					<th class="text-center">Result</th>
			</tr>
					
		<?php
		       // echo floor($UserMarks[0][0]->Percentage);
		     //   echo $QuePaper[0]->PassingPercentage;
		   //  print_r($UserMarks);
			if(empty($UserMarks))
			{
			    
			}
			else
			{
			for($i=0;$i<count($UserMarks);$i++)
			{
				   
		?>	

				<form method="post" action="<?php echo site_url() ?>Questions/QuestionPapers">
				<tr>
				<td><p class="qp"><?php echo $users[$i][0]->EmailID ?></p></td>
				<td><p class="qp"><?php $originalDate =$UserMarks[$i][0]->QuePaperSubmissionDate;
echo $newDate = date("d-m-Y", strtotime($originalDate)); ?></p></td>
				<td class="text-center"><input type="submit" name="open" class="btn btn-link" value="Open" style="font-size:22px;"></td>
				<?php
                            $found=false;
							for($a=0;$a<count($UserMarks);$a++)
							{
							    if($UserMarks[$a][0]->UserID==$users[$i][0]->UserID)
							    {
							             
								if($UserMarks[$a][0]->UserTotalMarks!=null)
								{
					?>
									<td class="text-center"><p class="qp"><?php echo $UserMarks[$a][0]->UserTotalMarks;?>/<?php echo $QuePaper[0]->TotalMarks ?></p></td>
					<?php
									$found=true;
								}
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
					        for($a=0;$a<count($UserMarks);$a++)
							{
							    if($UserMarks[$a][0]->UserID==$users[$i][0]->UserID)
							    {
					?>
					            		         
					<?php	
					            if($UserMarks[$a][0]->Percentage==null)
					            {
			        ?>
			                            <td></td>
			        <?php
					            }
								elseif($UserMarks[$a][0]->Percentage!=0 && floor($UserMarks[$a][0]->Percentage)>=$QuePaper[0]->PassingPercentage)
								{
					?>
									 <td class="text-center"><p class="qp">Pass</p></td>
					<?php
									$flag=1;
								}
								else
								{
				    ?>	    
					                <td class="text-center"><p class="qp">Fail</p></td>
					<?php		
					                $flag=1;
								}
					?>
					           </td
					<?php
							    }
							}
					
			        ?>		   
				
				</tr>
				<input type="hidden" name="userid" value="<?php echo $users[$i][0]->UserID ?>">
				</form>
				
		<?php
			
			}}
		?>
				
				</table>
			</div>	
				</div>
	</body>
</html>
