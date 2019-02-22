<!DOCTYPE html>
<html>
    	<?php
			if($this->session->userdata("data")=="false" || $this->session->userdata("data")=="")
			{
	?>
	<head>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url() ?>/assets/css/QuestionPaper.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
		
		
			<title id="titlee">QUESTION & ANSWER</title>
    <link rel="icon" type="image/ico" href="<?php echo base_url() ?>/assets/images/logo.png" />
		
	<script>
		    $(document).ready(function() {
                	$(".fancybox").fancybox({
                		openEffect	: 'none',
	                	closeEffect	: 'none'
            	});
                });
                
                
		</script>
		<style>
		    @media screen and (min-width:300px) {
		    
		    .logo
		    {
		        margin:5px 5px !important;
		    }
			}
		</style>
	</head>
	<body>
		<form method="post" action="<?php echo site_url()?>Questions/Report" id="myForm">


<nav class = "navbar navbar-default" role = "navigation" style="background-color:#F8F8F8;box-shadow: 5px 5px 10px #E8E8E8;">
   
   <div class = "navbar-header">
      <button type = "button" class = "navbar-toggle" 
         data-toggle = "collapse" data-target = "#example-navbar-collapse" style="margin-right:5px !important;">
         <span class = "sr-only">Toggle navigation</span>
         <span class = "icon-bar"></span>
         <span class = "icon-bar"></span>
         <span class = "icon-bar"></span>
      </button>
		
     
     			<a href="<?php echo site_url() ?>Questions/AdminHomePage"><img class="logo" src="<?php echo base_url() ?>/assets/images/logo2.png" width="225" height="35" style="margin:10px 15px;"></a>
    	
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
                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                <div class="col-xs-6" style="padding-left:0px;">
			            <a href="<?php echo site_url() ?>/Questions/AdminHomePage" class="btn homebtn"><i class="fa fa-home"></i> Home</a>
			    </div>
			    <div class="col-xs-6" style="padding-right:0px;" align="right">
			        	<input type="submit" name="pdf" class="btn homebtn" value="Export" id="button1" formtarget="_blank" style="border-color:none !important;">
			    </div>
			    </div>
	    	</div>
      </div>
				

	<?php
			}
	?>
				<?php
				        if(empty($Questions))
				    {
				?>
				       <div class="container" style="background-color:#E8E8E8;padding:2%;">
				            <div style="width:50%;margin:20px 25%;background-color:white;padding:2%;">
			    <?php
			             echo "<script>$('#button1').hide();</script>";
			    ?>
			                    <h2>Sorry, No user has solved this question paper.</h2><br>
			                  <center><b><p style="font-size:17px;">Go back to <a style="text-decoration:none;" href="<?php echo site_url()?>Questions/AdminHomePage">Home</a></b></p></center>
				            </div>
				        </div>
				<?php
				    }
				    else
				    {
				?>
			
				<div class="container" style="margin-top:10px;background-color:#F8F8F8;padding:3%;">
						<h1 style="font-size:38px;text-transform:capitalize;" align="center"><?php echo $Questions[0]->Title; ?></h1>
						<label style="margin-left:1%;">Date:&nbsp;&nbsp;<?php	$originalDate =$Questions[0]->Date;
						echo $newDate = date("d-m-Y", strtotime($originalDate));  ?></label><br>
						<label style="margin-left:1%;">Total Marks:&nbsp;&nbsp;<?php echo $Questions[0]->TotalMarks; ?></label><hr style="border-top: 1px solid #4D4D4D">
				</div>
				<div class="container" style="background-color:#F8F8F8;padding:0px 3%;">
				<?php
				$no=1;
				    
					for($i=0;$i<count($Questions);$i++)
					{	
				?>
						<div style="width:100%;float:left;">
				<?php
						if($Questions[$i]->QueType=='Multiple choice questions')
						{			
							if($Questions[$i]->Image!=null)
							{
				?>
								<div style="margin-top:15px;float:left;width:100%;">
								    <div style="width:2%;float:left;"><span style="font-size:20px"><b>Q<?php echo $no; ?>.</b></span></div>
									<div style="width:64%;float:left;margin-left:4%"><span style="font-size:20px;word-wrap: break-word;"><b><?php echo $Questions[$i]->Question ?></b></span></div>
									<div style="width:15% !important;float:left;padding:5px 0px;margin-left:10%;"><span style="font-size:20px"><b>Marks:<?php echo $Questions[$i]->Marks ?></b></span></div>
								</div>
								<div style="width:94%;float:left;margin-top:5px;margin-left:6%;">
									<a id="fbox" class="fancybox" href="#Multi"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="150" height="150"></a>
								    <div id="Multi" style="display:none;width:600px;height:500px;">
                                          <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="500" height="500">
                                    </div>
								</div>
								<div style="float:left;width:64%;margin-top:10px;margin-left:6%;">
								<span style="font-size:20px;"><b>Answers:</b></span><br>
					<?php
									foreach($Answers as $a)
									{
										if($Questions[$i]->QuestionID==$a->QuestionID)
										{
											$found=false;
											for($j=0;$j<count($AdminCorrectAns);$j++)
											{
												if($a->AnswerID==$AdminCorrectAns[$j]->AnswerID)
												{
				?>	
											<input type="checkbox" checked="checked" disabled><span style="word-wrap: break-word;">&nbsp;<?php echo $a->Answer; ?></span><br>
				<?php
												$found=true;
												}
													
											}
											if($found==false)
											{
				?>
											<input type="checkbox" disabled><span style="word-wrap: break-word;">&nbsp;<?php echo $a->Answer; ?></span><br>
				<?php	
											}
					?>		
					<?php
										}	
									}			
							
					?>
								</div>
								<div  style="width:100%;float:left;margin-top:1%;">
								    <div style="width:2%;float:left;">
									<span style="font-size:20px"><b>Ans:</b></span>
							    	</div>	
							    	<div style="width:64%;float:left;margin-left:1%;">
					<?php
								$a=1;
										foreach($UserAnswers as $ua)	
										{
											if($Questions[$i]->QuestionID==$ua->QuestionID)
											{
											
					?>
											<div style="width:95%;float:left;margin-left:5%;">
											<span style="font-size:20px;"><b><?php echo $a; ?>.</b></span>
											<span style="font-size:20px;"><b>User Email:</b></span>
											<span style="font-size:20px;"><?php echo $ua->EmailID; ?></span>
											</div>
											<div style="width:67%;float:left;margin-left:7%;">
											<span style="font-size:20px;"><b>Answers:</b></span><br>
											<span style="font-size:20px;word-wrap: break-word;">
											<?php
												$ans=$ua->AllAnswers;
												$ans1=explode('#',$ans);
												
											for($j=0;$j<count($ans1);$j++)
											{
					?>
												<span style="font-size:20px;word-wrap: break-word;"><?php print_r($ans1[$j]); ?></span><br>
					<?php 	
											}	
											 //	echo str_replace("#"," , ",$ua->AllAnswers); 
											?>
											</span>
											<hr style="border-top: 1px solid #C0C0C0">
											</div>		
				<?php
											$a++;
											}
											
										}
				?>
								</div>
								</div>
				<?php
							}
							else
							{
				?>
								<div style="margin-top:15px;float:left;width:100%;">
								    <div style="width:2%;float:left;"><span style="font-size:20px"><b>Q<?php echo $no; ?>.</b></span></div>
									<div style="width:64%;float:left;margin-left:4%"><span style="font-size:20px;word-wrap: break-word;"><b><?php echo $Questions[$i]->Question ?></b></span></div>
									<div style="width:15% !important;float:left;padding:5px 0px;margin-left:10%;"><span style="font-size:20px"><b>Marks:<?php echo $Questions[$i]->Marks ?></b></span></div>
								</div>
								<div style="float:left;width:64%;margin-top:10px;margin-left:6%;">
								<span style="font-size:20px;"><b>Answers:</b></span><br>
					<?php
									//print_r($Answers);
									foreach($Answers as $a)
									{
										if($Questions[$i]->QuestionID==$a->QuestionID)
										{
											$found=false;
											for($j=0;$j<count($AdminCorrectAns);$j++)
											{
												if($a->AnswerID==$AdminCorrectAns[$j]->AnswerID)
												{
				?>	
											<input type="checkbox" checked="checked" disabled><span style="word-wrap: break-word;"><?php echo $a->Answer; ?></span><br>
				<?php
												$found=true;
												}
													
											}
											if($found==false)
											{
				?>
											<input type="checkbox" disabled><span style="word-wrap: break-word;"><?php echo $a->Answer; ?></span><br>
				<?php	
											}
					?>		
					<?php
										}	
									}			
							
				?>
								</div>
									<div  style="width:100%;float:left;margin-top:1%;">
								    <div style="width:2%;float:left;">
									<span style="font-size:20px"><b>Ans:</b></span>
							    	</div>	
							    	<div style="width:64%;float:left;margin-left:1%;">
								
					<?php
									$a=1;
										foreach($UserAnswers as $ua)	
										{
											if($Questions[$i]->QuestionID==$ua->QuestionID)
											{
											
					?>
											<div style="width:95%;float:left;margin-left:5%;">
											<span style="font-size:20px;"><b><?php echo $a; ?>.</b></span>
											<span style="font-size:20px;"><b>User Email:</b></span>
											<span style="font-size:20px;"><?php echo $ua->EmailID; ?></span>
											</div>
											<div style="width:67%;float:left;margin-left:7%;">
											<span style="font-size:20px;"><b>Answers:</b></span><br>
											<span style="font-size:20px;word-wrap: break-word;">
											<?php
												$ans=$ua->AllAnswers;
												$ans1=explode('#',$ans);
												
											for($j=0;$j<count($ans1);$j++)
											{
					?>
												<span style="font-size:20px;word-wrap: break-word;"><?php print_r($ans1[$j]); ?></span><br>
					<?php 	
											}	
											 //	echo str_replace("#"," , ",$ua->AllAnswers); 
											?>
											</span>
											<hr style="border-top: 1px solid #C0C0C0">
											</div>		
				<?php
											$a++;
											}
											
										}
				?>
								</div>
								</div>
								
				<?php	
							}
						}
				?>
							
						</div>
						<div style="width:100%;float:left;">
				<?php
						if($Questions[$i]->QueType=='Descriptive questions')
						{			
							if($Questions[$i]->Image!=null)
							{
				?>
							<div style="margin-top:15px;float:left;width:100%;">
							        <div style="width:2%;float:left;"><span style="font-size:20px"><b>Q<?php echo $no; ?>.</b></span></div>
									<div style="width:64%;float:left;margin-left:4%"><span style="font-size:20px;word-wrap: break-word;"><b><?php echo $Questions[$i]->Question ?></b></span></div>
									<div style="width:15% !important;float:left;padding:5px 0px;margin-left:10%;"><span style="font-size:20px"><b>Marks:<?php echo $Questions[$i]->Marks ?></b></span></div>
							</div>
							<div style="width:94%;float:left;margin-top:5px;margin-left:6%;">
									<a id="fbox" class="fancybox" href="#Desc"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="150" height="150"></a>
							        <div id="Desc" style="display:none;width:600px;height:500px;">
                                          <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="500" height="500">
                                    </div>
							</div>
							<div style="float:left;width:64%;margin-top:10px;margin-left:6%;">
								<span style="font-size:20px;"><b>Answers:</b></span><br>
					<?php
									//print_r($Answers);
									foreach($Answers as $a)
									{
										if($Questions[$i]->QuestionID==$a->QuestionID)
										{
					?>							
											<p style="font-size:20px;word-wrap: break-word;"><?php echo $a->Answer; ?></p><br>
				<?php
										}	
									}			
							
				?>
							</div>
							<div  style="width:100%;float:left;margin-top:1%;">
								    <div style="width:2%;float:left;">
									<span style="font-size:20px"><b>Ans:</b></span>
							    	</div>	
							    	<div style="width:64%;float:left;margin-left:1%;">
									
					<?php
					$b=1;
										foreach($UserAnswers as $ua)	
										{
											if($Questions[$i]->QuestionID==$ua->QuestionID)
											{
											
					?>
											<div style="width:95%;float:left;margin-left:5%;">
											<span style="font-size:20px;"><b><?php echo $b; ?>.</b></span>
											<span style="font-size:20px;"><b>User Email:</b></span>
											<span style="font-size:20px;"><?php echo $ua->EmailID; ?></span>
											</div>
											<div style="width:67%;float:left;margin-left:7%;">
											<span style="font-size:20px;"><b>Answers:</b></span><br>
											<span style="font-size:20px;word-wrap: break-word;">
											<?php 
											 	echo $ua->AllAnswers; 
											?>
											</span>
											<hr style="border-top: 1px solid #C0C0C0">
											</div>		
				<?php
											$b++;
											}	
										}
				?>
							</div>
					        </div>
				<?php

							}
							else
							{
				?>
							<div style="margin-top:15px;float:left;width:100%;">
							        <div style="width:2%;float:left;"><span style="font-size:20px"><b>Q<?php echo $no; ?>.</b></span></div>
									<div style="width:64%;float:left;margin-left:4%"><span style="font-size:20px;word-wrap: break-word;"><b><?php echo $Questions[$i]->Question ?></b></span></div>
									<div style="width:15% !important;float:left;padding:5px 0px;margin-left:10%;"><span style="font-size:20px"><b>Marks:<?php echo $Questions[$i]->Marks ?></b></span></div>
							</div>
							<div style="float:left;width:64%;margin-top:10px;margin-left:6%;">
								<span style="font-size:20px;"><b>Answers:</b></span><br>
					<?php
									foreach($Answers as $a)
									{
										if($Questions[$i]->QuestionID==$a->QuestionID)
										{
					?>							
											<p style="font-size:20px;word-wrap: break-word;"><?php echo $a->Answer; ?></p><br>
				<?php
										}	
									}			
							
				?>
							</div>
							<div  style="width:100%;float:left;margin-top:1%;">
								    <div style="width:2%;float:left;">
									<span style="font-size:20px"><b>Ans:</b></span>
							    	</div>	
							    	<div style="width:64%;float:left;margin-left:1%;">
									
					<?php
					$b=1;
										foreach($UserAnswers as $ua)	
										{
											if($Questions[$i]->QuestionID==$ua->QuestionID)
											{
											
					?>
											<div style="width:95%;float:left;margin-left:5%;">
											<span style="font-size:20px;"><b><?php echo $b; ?>.</b></label>
											<span style="font-size:20px;"><b>User Email:</b></span>
											<span style="font-size:20px;"><?php echo $ua->EmailID; ?></span>
											</div>
											<div style="width:67%;float:left;margin-left:7%;">
											<span style="font-size:20px;"><b>Answers:</b></span><br>
											<span style="font-size:20px;word-wrap: break-word;">
											<?php 
											 	echo $ua->AllAnswers; 
											?>
											</span>
											<hr style="border-top: 1px solid #C0C0C0">
											</div>		
				<?php
											$b++;
											}	
										}
				?>
							</div>
							</div>
				<?php
							}		
						}	
				?>		
						</div>
						<div style="width:100%;float:left;">
				<?php
						if($Questions[$i]->QueType=='Fill in the blanks')
						{			
							if($Questions[$i]->Image!=null)
							{
				?>
							<div style="margin-top:15px;float:left;width:100%;">
							        <div style="width:2%;float:left;"><span style="font-size:20px"><b>Q<?php echo $no; ?>.</b></span></div>
									<div style="width:64%;float:left;margin-left:4%"><span style="font-size:20px;word-wrap: break-word;"><b><?php echo $Questions[$i]->Question ?></b></span></div>
									<div style="width:15% !important;float:left;padding:5px 0px;margin-left:10%;"><span style="font-size:20px"><b>Marks:<?php echo $Questions[$i]->Marks ?></b></span></div>
							</div>
							<div style="width:94%;float:left;margin-top:5px;margin-left:6%;">
									<a id="fbox" class="fancybox" href="#Fill"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="150" height="150"></a>
							        <div id="Fill" style="display:none;width:600px;height:500px;">
                                          <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="500" height="500">
                                    </div>
							</div>
						<div style="float:left;width:64%;margin-top:10px;margin-left:6%;">
								<span style="font-size:20px;"><b>Answers:</b></span><br>
					<?php
									//print_r($Answers);
									foreach($Answers as $a)
									{
										if($Questions[$i]->QuestionID==$a->QuestionID)
										{
											$found=false;
											for($j=0;$j<count($AdminCorrectAns);$j++)
											{
												if($a->AnswerID==$AdminCorrectAns[$j]->AnswerID)
												{
				?>	
											<input type="radio" checked="checked" disabled><span style="word-wrap: break-word;">&nbsp;<?php echo $a->Answer; ?></span><br>
				<?php
												$found=true;
												}
													
											}
											if($found==false)
											{
				?>
											<input type="radio" disabled><span style="word-wrap: break-word;">&nbsp;<?php echo $a->Answer; ?></span><br>
				<?php	
											}
					?>		
					<?php
										}	
									}			
							
				?>
							</div>
							<div  style="width:100%;float:left;margin-top:1%;">
								    <div style="width:2%;float:left;">
									<span style="font-size:20px"><b>Ans:</b></span>
							    	</div>	
							    	<div style="width:64%;float:left;margin-left:1%;">
								
					<?php
					$c=1;
										foreach($UserAnswers as $ua)	
										{
											if($Questions[$i]->QuestionID==$ua->QuestionID)
											{
											
					?>
											<div style="width:95%;float:left;margin-left:5%;">
											<span style="font-size:20px;"><b><?php echo $c; ?>.</b></label>
											<span style="font-size:20px;"><b>User Email:</b></span>
											<span style="font-size:20px;"><?php echo $ua->EmailID; ?></span>
											</div>
											<div style="width:67%;float:left;margin-left:7%;">
											<span style="font-size:20px;"><b>Answers:</b></span><br>
											<span style="font-size:20px;word-wrap: break-word;">
											<?php 
											 	echo $ua->AllAnswers; 
											?>
											</span>
											<hr style="border-top: 1px solid #C0C0C0">
											</div>		
				<?php
											$c++;
											}	
										}
				?>
							</div>
					        </div>
				<?php

							}
							else
							{
				?>
							<div style="margin-top:15px;float:left;width:100%;">
							        <div style="width:2%;float:left;"><span style="font-size:20px"><b>Q<?php echo $no; ?>.</b></span></div>
									<div style="width:64%;float:left;margin-left:4%"><span style="font-size:20px;word-wrap: break-word;"><b><?php echo $Questions[$i]->Question ?></b></span></div>
									<div style="width:15% !important;float:left;padding:5px 0px;margin-left:10%;"><span style="font-size:20px"><b>Marks:<?php echo $Questions[$i]->Marks ?></b></span></div>
							</div>
							<div style="float:left;width:64%;margin-top:10px;margin-left:6%;">
								<span style="font-size:20px;"><b>Answers:</b></span><br>
					<?php
									foreach($Answers as $a)
									{
										if($Questions[$i]->QuestionID==$a->QuestionID)
										{
											$found=false;
											for($j=0;$j<count($AdminCorrectAns);$j++)
											{
												if($a->AnswerID==$AdminCorrectAns[$j]->AnswerID)
												{
				?>	
											<input type="radio" checked="checked" disabled><span style="word-wrap: break-word;"><?php echo $a->Answer; ?></span><br>
				<?php
												$found=true;
												}
													
											}
											if($found==false)
											{
				?>
											<input type="radio" disabled><span style="word-wrap: break-word;"><?php echo $a->Answer; ?></span><br>
				<?php	
											}
					?>		
					<?php
										}	
									}
				?>
							</div>
							<div  style="width:100%;float:left;margin-top:1%;">
								    <div style="width:2%;float:left;">
									<span style="font-size:20px"><b>Ans:</b></span>
							    	</div>	
							    	<div style="width:64%;float:left;margin-left:1%;">
									
					<?php
					$c=1;
										foreach($UserAnswers as $ua)	
										{
											if($Questions[$i]->QuestionID==$ua->QuestionID)
											{
											
					?>
											<div style="width:95%;float:left;margin-left:5%;">
											<span style="font-size:20px;"><b><?php echo $c; ?>.</b></label>
											<span style="font-size:20px;"><b>User Email:</b></span>
											<span style="font-size:20px;"><?php echo $ua->EmailID; ?></span>
											</div>
											<div style="width:67%;float:left;margin-left:7%;">
											<span style="font-size:20px;"><b>Answers:</b></span><br>
											<span style="font-size:20px;word-wrap: break-word;">
											<?php 
											 	echo $ua->AllAnswers; 
											?>
											</span>
											<hr style="border-top: 1px solid #C0C0C0">
											</div>		
				<?php
											$c++;
											}	
										}
				?>
							</div>
							</div>
				<?php
							}		
						}	
				?>		
						</div>
						
						<div style="width:100%;float:left;">
				<?php
						if($Questions[$i]->QueType=='True false')
						{			
							if($Questions[$i]->Image!=null)
							{
				?>
							<div style="margin-top:15px;float:left;width:100%;">
							        <div style="width:2%;float:left;"><span style="font-size:20px"><b>Q<?php echo $no; ?>.</b></span></div>
									<div style="width:64%;float:left;margin-left:4%"><span style="font-size:20px;word-wrap: break-word;"><b><?php echo $Questions[$i]->Question ?></b></span></div>
									<div style="width:15% !important;float:left;padding:5px 0px;margin-left:10%;"><span style="font-size:20px"><b>Marks:<?php echo $Questions[$i]->Marks ?></b></span></div>
							</div>
							<div style="width:94%;float:left;margin-top:5px;margin-left:6%;">
									<a id="fbox" class="fancybox" href="#TF"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="150" height="150"></a>
						            <div id="TF" style="display:none;width:600px;height:500px;">
                                         <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="500" height="500">
                                    </div>
							</div>
							<div style="float:left;width:64%;margin-top:10px;margin-left:6%;">
								<span style="font-size:20px;"><b>Answers:</b></span><br>
					<?php
									//print_r($Answers);
									foreach($Answers as $a)
									{
										if($Questions[$i]->QuestionID==$a->QuestionID)
										{
											$found=false;
											for($j=0;$j<count($AdminCorrectAns);$j++)
											{
												if($a->AnswerID==$AdminCorrectAns[$j]->AnswerID)
												{
				?>	
											<input type="radio" checked="checked" disabled>&nbsp;<?php echo $a->Answer; ?><br>
				<?php
												$found=true;
												}
													
											}
											if($found==false)
											{
				?>
											<input type="radio" disabled>&nbsp;<?php echo $a->Answer; ?><br>
				<?php	
											}
					?>		
					<?php
										}	
									}			
							
				?>
							</div>
							<div  style="width:100%;float:left;margin-top:1%;">
								    <div style="width:2%;float:left;">
									<span style="font-size:20px"><b>Ans:</b></span>
							    	</div>	
							    	<div style="width:64%;float:left;margin-left:1%;">
								
					<?php
					$d=1;
										foreach($UserAnswers as $ua)	
										{
											if($Questions[$i]->QuestionID==$ua->QuestionID)
											{
											
					?>
											<div style="width:95%;float:left;margin-left:5%;">
											<span style="font-size:20px;"><b><?php echo $d; ?>.</b></label>
											<span style="font-size:20px;"><b>User Email:</b></span>
											<span style="font-size:20px;"><?php echo $ua->EmailID; ?></span>
											</div>
											<div style="width:67%;float:left;margin-left:7%;">
											<span style="font-size:20px;"><b>Answers:</b></span><br>
											<span style="font-size:20px;">
											<?php 
											 	echo $ua->AllAnswers; 
											?>
											</span>
											<hr style="border-top: 1px solid #C0C0C0">
											</div>		
				<?php
											$d++;
											}	
										}
				?>
							</div>
					        </div>
				<?php

							}
							else
							{
				?>
							<div style="margin-top:15px;float:left;width:100%;">
							        <div style="width:2%;float:left;"><span style="font-size:20px"><b>Q<?php echo $no; ?>.</b></span></div>
									<div style="width:64%;float:left;margin-left:4%"><span style="font-size:20px;word-wrap: break-word;"><b><?php echo $Questions[$i]->Question ?></b></span></div>
									<div style="width:15% !important;float:left;padding:5px 0px;margin-left:10%;"><span style="font-size:20px"><b>Marks:<?php echo $Questions[$i]->Marks ?></b></span></div>
							</div>
							<div style="float:left;width:64%;margin-top:10px;margin-left:6%;">
								<span style="font-size:20px;"><b>Answers:</b></span><br>
					<?php
									foreach($Answers as $a)
									{
										if($Questions[$i]->QuestionID==$a->QuestionID)
										{
											$found=false;
											for($j=0;$j<count($AdminCorrectAns);$j++)
											{
												if($a->AnswerID==$AdminCorrectAns[$j]->AnswerID)
												{
				?>	
											<input type="radio" checked="checked" disabled>&nbsp;<?php echo $a->Answer; ?><br>
				<?php
												$found=true;
												}
													
											}
											if($found==false)
											{
				?>
											<input type="radio" disabled>&nbsp;<?php echo $a->Answer; ?><br>
				<?php	
											}
					?>		
					<?php
										}	
									}
				?>
							</div>
						<div  style="width:100%;float:left;margin-top:1%;">
								    <div style="width:2%;float:left;">
									<span style="font-size:20px"><b>Ans:</b></span>
							    	</div>	
							    	<div style="width:64%;float:left;margin-left:1%;">
									
					<?php
					$d=1;
										foreach($UserAnswers as $ua)	
										{
											if($Questions[$i]->QuestionID==$ua->QuestionID)
											{
											
					?>
											<div style="width:95%;float:left;margin-left:5%;">
											<span style="font-size:20px;"><b><?php echo $d; ?>.</b></label>
											<span style="font-size:20px;"><b>User Email:</b></span>
											<span style="font-size:20px;"><?php echo $ua->EmailID; ?></span>
											</div>
											<div style="width:67%;float:left;margin-left:7%;">
											<span style="font-size:20px;"><b>Answers:</b></span><br>
											<span style="font-size:20px;">
											<?php 
											 	echo $ua->AllAnswers; 
											?>
											</span>
											<hr style="border-top: 1px solid #C0C0C0">
											</div>		
				<?php
											$d++;
											}	
										}
				?>
							</div>
							</div>
				<?php
							}		
						}	
				?>		
						</div>
						<div style="width:100%;float:left;">
							<hr style="border-top: 1px solid #4D4D4D">
						</div>
				<?php
					$no++;
					}
				?>
						
			</div>
			<?php
				    }
			?>
		</form>
	</body>
</html>
