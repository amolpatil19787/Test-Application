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
		<script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
		
			<title>QUESTION & ANSWER</title>
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
		<form method="post" action="<?php echo site_url()?>Questions/SavePDF" id="myForm">
	
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
				    <div class="row">
				        <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
				        <div class="col-xs-6" style="padding-left:0px;">
				     <a href="<?php echo site_url() ?>/Questions/ShowQuestionPaper" class="btn homebtn"><i class="fa fa-home"></i> Home</a>
				     </div>
				     <div class="col-xs-6" style="padding-right:0px;" align="right">
			<input type="submit" name="pdf" class="btn btn-primary" value="Export" id="button1" formtarget="_blank" style="border-color:none !important;">
			        </div>
			        </div>
			        </div>
				</div>

	<?php
			}
			
			         if(empty($Questions))
			         {
			             
			         }
			         else
			         {
	?>
			       	
					<div class="container" style="margin-top:10px;background-color:#F8F8F8;padding:3%;">
						<h1 align="center" style="text-transform:capitalize;"><?php echo $Questions[0]->Title; ?></h1>
						<label>Date:&nbsp;&nbsp;<?php	$originalDate =$Questions[0]->Date;
echo $newDate = date("d-m-Y", strtotime($originalDate));  ?></label><br>
						<label>Total Marks:&nbsp;&nbsp;<?php echo $Questions[0]->TotalMarks; ?></label><br>
						<input type="hidden" id="QuePaperID" value="<?php echo $Questions[0]->QuePaperID; ?>">
						<?php
						if(empty($PaperRefDoc)){}
						else{
						    if($PaperRefDoc[0]->ReferenceDoc!=null)
						    {
						?>
						<label><a href="<?php echo base_url() ?>/assets/uploads/<?php echo $PaperRefDoc[0]->ReferenceDoc; ?>" target="_blank">Reference Document</a></label>
						<?php
						    }}
						?>
						<hr style="border-top: 1px solid #4D4D4D">
					</div>
					<?php
			         }
					?>
					<div class="container" style="background-color:#F8F8F8;padding:0px 3%;">
					<div style="width:100%;float:left;">
				<?php
					$no=1;
					$user_total=0;	
					$admin_total=0;
				    
				      //  print_r($AdminQuestions);
				
					for($i=0;$i<count($Questions);$i++)
					{	
				?>
						<div style="width:100%;float:left;">
			        <?php
						if($Questions[$i]->QueType=='Multiple choice questions')
						{
			    	?>
			                 <div style="margin-top:15px;float:left;width:100%;">
							        <div style="width:2%;float:left;"><span style="font-size:20px"><b>Q<?php echo $no; ?>.</b></span></div>
							    	<div style="width:64%;float:left;margin-left:4%"><span style="font-size:20px;word-wrap: break-word;"><b><?php echo $Questions[$i]->Question ?></b></span></div>
							    	<div style="width:15% !important;float:left;padding:5px 0px;margin-left:10%;"><span style="font-size:15px"><b>Marks:<?php echo $Questions[$i]->Marks ?></b></span></div>
						    </div>
					<?php
					           if($Questions[$i]->Image!=null) 
					           {
				    ?>
					            <div style="width:94%;float:left;margin-top:5px;margin-left:6%;">
							    	<a id="fbox" class="fancybox" href="#Multi"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="150" height="150"></a>
						             <div id="Multi" style="display:none;width:600px;height:500px;">
                                          <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="500" height="500">
                                    </div>
						    	</div>
					<?php
					           }
					?>
				            <div style="float:left;width:100%;margin-top:10px;">
				                <div style="width:64%;float:left;margin-left:6%">
					                <label>Answers:</label><br>  
					   <?php
									foreach($AdminAnswers as $a)
									{
										if($Questions[$i]->QuestionID==$a->QuestionID)
										{
											$found=false;
											for($j=0;$j<count($UserAnswers);$j++)
											{
												if($a->AnswerID==$UserAnswers[$j]->AnswerID)
												{
				?>
				                                    <input type="checkbox" checked="checked" disabled><span style="word-wrap: break-word;"><?php echo html_escape($a->Answer); ?></span><br>
				<?php
													$found=true;
												}
											}
											if($found==false)
											{
				?>
												<input type="checkbox" disabled><span style="word-wrap: break-word;"><?php echo html_escape($a->Answer); ?></span><br>
				<?php	
											}
										}
									}
									 
				?>
					            </div> 
					             <div style="width:15% !important;float:left;padding:5px 0px;margin-left:10%;">
				<?php		
				                if($Questions[$i]->UserMarks==null)
							    {
				?>
				                        <div style="width:100%;float:left;">
				                            <p><b>Not Attempted<b></p>
				                        </div>
				<?php
								}
								else
								{
				?>
				                        <div style="width:100%;float:left;">
				                            <p><b>Attempted</b></p>
				                        </div>
				<?php  
								}
				                if($Questions[$i]->ReferenceDoc!=null)
				                {
				?>
				                    <div style="width:100%;float:left;">
				                        <label><a href="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->ReferenceDoc; ?>" target="_blank">Reference Document</a></label>
				                    </div>
				<?php
				                }
				                if($Questions[$i]->RefDocPageNo!=null && $Questions[$i]->RefDocPageNo!=0)
				                {
				?>
				                         <div style="width:100%;float:left;">
				                            <label> <a href="<?php echo base_url() ?>/assets/uploads/<?php echo $PaperRefDoc[0]->ReferenceDoc; ?>#page=<?php echo $Questions[$i]->RefDocPageNo ?>" target="_blank">Reference Document</a></label>
				                         </div>
			    <?php
				                }
				
				    
				                $AdminMarks=$Questions[$i]->Marks;
								$UserMarks=$Questions[$i]->UserMarks;
								$NegativeMarks=$Questions[$i]->Negative_marks;
				             
								
								if($AdminMarks==$UserMarks)
								{
				?>
									<div style="width:100%;float:left;">				
									<img src="<?php echo base_url() ?>/assets/images/checked.png">
									</div>
									<div style="width:100%;float:left;margin-top:10px;">
									<div style="color:green;"><b>Full Marks:&nbsp;<?php echo $UserMarks; ?></b></div>
									</div>								
									
				<?php
								}
								else if($UserMarks=='0' || $UserMarks==null)
								{
				?>
									<div style="width:100%;float:left;margin-bottom:7px;">
									<img src="<?php echo base_url() ?>/assets/images/cancel.png">
									</div>
									<div style="width:100%;float:left;margin-top:10px;">
									<div style="color:red;"><b>Negative Marks:&nbsp;<?php echo $UserMarks-=$NegativeMarks; ?></b></div>
									</div>
				<?php
								}
								else if($UserMarks>=1 && $UserMarks<$AdminMarks)
								{
				?>
									<div style="width:100%;float:left;">
									<img src="<?php echo base_url() ?>/assets/images/warning.png">
									</div>
									<div style="width:100%;float:left;margin-top:10px;">
									<div style="color:orange;"><b>Partial Marks:&nbsp;<?php echo $UserMarks; ?></b></div>
									</div>
				<?php	
								}
				?>
							</div>
				            </div>    
			    	<?php
						}
			    	?>
						</div>
						<div style="width:100%;float:left;">
			    <?php
						if($Questions[$i]->QueType=='Descriptive questions')
						{
				?>   
				                <div style="margin-top:15px;float:left;width:100%;">
							       <div style="width:2%;float:left;"><span style="font-size:20px"><b>Q<?php echo $no; ?>.</b></span></div>
							       <div style="width:64%;float:left;margin-left:4%"><span style="font-size:20px;word-wrap: break-word;"><b><?php echo $Questions[$i]->Question ?></b></span></div>
							       <div style="width:15% !important;float:left;padding:5px 0px;margin-left:10%;"><span style="font-size:15px"><b>Marks:<?php echo $Questions[$i]->Marks ?></b></span></div>
					    		</div>
				<?php
				            if($Questions[$i]->Image!=null)
							{
				?>
				                <div style="width:94%;float:left;margin-top:5px;margin-left:6%;">
							    	<a id="fbox" class="fancybox" href="#Desc"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="150" height="150"></a>
                                    <div id="Desc" style="display:none;width:600px;height:500px;">
                                        <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="500" height="500">
                                    </div>							
						    	</div>
				<?php
							}
				?>
				                <div style="float:left;width:100%;margin-top:10px;">
				                    <div style="width:64%;float:left;margin-left:6%">
						            	<label>Answer:</label><br>
				<?php
						            	foreach($UserAnswers as $a)
							       		{
								    		if($Questions[$i]->QuestionID==$a->QuestionID && $a->IsDescriptive=='1')
									    	{
				?>	
											    <p style="word-wrap: break-word;"><?php echo html_escape($a->DescAns); ?></p><br>
				<?php
									    	}
									    }
				?>
						        	</div>             
				                    <div style="width:15% !important;float:left;padding:5px 0px;margin-left:10%;">
				                        
			    <?php		
				                if($Questions[$i]->UserMarks==null)
							    {
				?>
				                        <div style="width:100%;float:left;">
				                            <p><b>Not Attempted<b></p>
				                        </div>
				<?php
								}
								else
								{
				?>
				                        <div style="width:100%;float:left;">
				                            <p><b>Attempted</b></p>
				                        </div>
				
				<?php	
								}
				                if($Questions[$i]->ReferenceDoc!=null)
				                       {
				?>
				                         <div style="width:100%;float:left;">
				                              <label><a href="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->ReferenceDoc; ?>" target="_blank">Reference Document</a></label>
				                         </div>
				<?php
				                }
				                if($Questions[$i]->RefDocPageNo!=null && $Questions[$i]->RefDocPageNo!=0)
				                {
				?>
				                         <div style="width:100%;float:left;">
				                            <label> <a href="<?php echo base_url() ?>/assets/uploads/<?php echo $PaperRefDoc[0]->ReferenceDoc; ?>#page=<?php echo $Questions[$i]->RefDocPageNo ?>" target="_blank">Reference Document</a></label>
				                         </div>
			    <?php
				                }
				
								$AdminMarks=$Questions[$i]->Marks;
								$UserMarks=$Questions[$i]->UserMarks;
								$NegativeMarks=$Questions[$i]->Negative_marks;
								
								if($AdminMarks==$UserMarks)
								{
				?>
									<div style="width:100%;float:left;">				
									<img src="<?php echo base_url() ?>/assets/images/checked.png">
									</div>
									<div style="width:100%;float:left;margin-top:10px;">
									<div style="color:green;"><b>Full Marks:&nbsp;<?php echo $UserMarks; ?></b></div>
									</div>								
									
				<?php
								}
								else if($UserMarks=='0' || $UserMarks==null)
								{
				?>
									<div style="width:100%;float:left;margin-bottom:7px;">
									<img src="<?php echo base_url() ?>/assets/images/cancel.png">
									</div>
									<div style="width:100%;float:left;margin-top:10px;">
									<div style="color:red;"><b>Negative Marks:&nbsp;<?php echo $UserMarks-=$NegativeMarks; ?></b></div>
									</div>
				<?php
								}
								else if($UserMarks>=1 && $UserMarks<$AdminMarks)
								{
				?>
									<div style="width:100%;float:left;">
									<img src="<?php echo base_url() ?>/assets/images/warning.png">
									</div>
									<div style="width:100%;float:left;margin-top:10px;">
									<div style="color:orange;"><b>Partial Marks:&nbsp;<?php echo $UserMarks; ?></b></div>
									</div>
				<?php	
								}
				?>
							</div>
				                </div>
				<?php
						}
				?>
						</div>
						<div style="width:100%;float:left;">
				<?php
				    	if($Questions[$i]->QueType=='Fill in the blanks')
					    {
				?>
				            <div style="margin-top:15px;float:left;width:100%;">
							    <div style="width:2%;float:left;"><span style="font-size:20px"><b>Q<?php echo $no; ?>.</b></span></div>
								<div style="width:64%;float:left;margin-left:4%"><span style="font-size:20px;word-wrap: break-word;"><b><?php echo $Questions[$i]->Question ?></b></span></div>
								<div style="width:15% !important;float:left;padding:5px 0px;margin-left:10%;"><span style="font-size:15px"><b>Marks:<?php echo $Questions[$i]->Marks ?></b></span></div>
							</div>
				<?php
				            if($Questions[$i]->Image!=null)
					    	{
				?>
				                <div style="width:94%;float:left;margin-top:5px;margin-left:6%;">
							    	<a id="fbox" class="fancybox" href="#Fill"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="150" height="150"></a>
							    	<div id="Fill" style="display:none;width:600px;height:500px;">
                                          <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="500" height="500">
                                    </div>
							    </div>
				<?php
					    	}
				?>
				            <div style="float:left;width:100%;margin-top:10px;">
				                <div style="width:64%;float:left;margin-left:6%">
					    		<label>Answers:</label><br>
						<?php
								foreach($AdminAnswers as $a)
								{
									if($Questions[$i]->QuestionID==$a->QuestionID)
									{
											$found=false;
											for($j=0;$j<count($UserAnswers);$j++)
											{
												if($a->AnswerID==$UserAnswers[$j]->AnswerID)
												{
			        	?>	
											<input type="radio" checked="checked" disabled><span style="word-wrap: break-word;"><?php echo html_escape($a->Answer); ?></span><br>
			        	<?php
												$found=true;
												}
													
											}
											if($found==false)
											{
			        	?>
											<input type="radio" disabled><span style="word-wrap: break-word;"><?php echo html_escape($a->Answer); ?></span><br>
			        	<?php	
											}
									}
								}
							
						?>
							</div>
							<div style="width:15% !important;float:left;padding:5px 0px;margin-left:10%;">
				<?php		
				                if($Questions[$i]->UserMarks==null)
							    {
				?>
				                        <div style="width:100%;float:left;">
				                            <p><b>Not Attempted<b></p>
				                        </div>
				<?php
								}
								else
								{
				?>
				                        <div style="width:100%;float:left;">
				                            <p><b>Attempted</b></p>
				                        </div>
				
				<?php	
								}			    
							    
				                if($Questions[$i]->ReferenceDoc!=null)
				                {
				?>
				                    <div style="width:100%;float:left;">
				                        <label><a href="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->ReferenceDoc; ?>" target="_blank">Reference Document</a></label>
				                    </div>
				<?php
				                }
				                if($Questions[$i]->RefDocPageNo!=null && $Questions[$i]->RefDocPageNo!=0)
				                {
				?>
				                         <div style="width:100%;float:left;">
				                            <label> <a href="<?php echo base_url() ?>/assets/uploads/<?php echo $PaperRefDoc[0]->ReferenceDoc; ?>#page=<?php echo $Questions[$i]->RefDocPageNo ?>" target="_blank">Reference Document</a></label>
				                         </div>
			    <?php
				                }
				
								$AdminMarks=$Questions[$i]->Marks;
								$UserMarks=$Questions[$i]->UserMarks;
								$NegativeMarks=$Questions[$i]->Negative_marks;
								
								if($AdminMarks==$UserMarks)
								{
				?>
									<div style="width:100%;float:left;">				
									<img src="<?php echo base_url() ?>/assets/images/checked.png">
									</div>
									<div style="width:100%;float:left;margin-top:10px;">
									<div style="color:green;"><b>Full Marks:&nbsp;<?php echo $UserMarks; ?></b></div>
									</div>								
									
				<?php
								}
								else if($UserMarks=='0' || $UserMarks==null)
								{
				?>
									<div style="width:100%;float:left;margin-bottom:7px;">
									<img src="<?php echo base_url() ?>/assets/images/cancel.png">
									</div>
									<div style="width:100%;float:left;margin-top:10px;">
									<div style="color:red;"><b>Negative Marks:&nbsp;<?php echo $UserMarks-=$NegativeMarks; ?></b></div>
									</div>
				<?php
								}
								else if($UserMarks>=1 && $UserMarks<$AdminMarks)
								{
				?>
									<div style="width:100%;float:left;">
									<img src="<?php echo base_url() ?>/assets/images/warning.png">
									</div>
									<div style="width:100%;float:left;margin-top:10px;">
									<div style="color:orange;"><b>Partial Marks:&nbsp;<?php echo $UserMarks; ?></b></div>
									</div>
				<?php	
								}

				?>
							</div>
				            </div>
				        <?php
				    }
			    	?>
						</div>
						<div style="width:100%;float:left;margin-bottom:5px;">
                <?php
					if($Questions[$i]->QueType=='True false')
					{
				?>
				                <div style="margin-top:15px;float:left;width:100%;">
							        <div style="width:2%;float:left;"><span style="font-size:20px"><b>Q<?php echo $no; ?>.</b></span></div>
							    	<div style="width:64%;float:left;margin-left:4%"><span style="font-size:20px;word-wrap: break-word;"><b><?php echo $Questions[$i]->Question ?></b></span></div>
								    <div style="width:15% !important;float:left;padding:5px 0px;margin-left:10%;"><span style="font-size:15px"><b>Marks:<?php echo $Questions[$i]->Marks ?></b></span></div>
					        	</div>
				<?php
				            if($Questions[$i]->Image!=null)
					    	{
				?>
				                <div style="width:94%;float:left;margin-top:5px;margin-left:6%;">
							    	<a id="fbox" class="fancybox" href="#TF"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="150" height="150"></a>
							    	<div id="Fill" style="display:none;width:600px;height:500px;">
                                      <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="500" height="500">
                                    </div>
						    	</div>
				<?php
					    	}
				?>
				                <div style="float:left;width:100%;margin-top:10px;">
				                        <div style="width:64%;float:left;margin-left:6%">
						            	<label>Answers:</label><br>
					    	<?php
							        	foreach($AdminAnswers as $a)
								        {
								        	if($Questions[$i]->QuestionID==$a->QuestionID)
								        	{
											$found=false;
											for($j=0;$j<count($UserAnswers);$j++)
											{
												if($a->AnswerID==$UserAnswers[$j]->AnswerID)
												{
				?>	
											<input type="radio" checked="checked" disabled><?php echo html_escape($a->Answer); ?><br>
				<?php
												$found=true;
												}
													
											}
											if($found==false)
											{
				?>
											<input type="radio" disabled><?php echo html_escape($a->Answer); ?><br>
				<?php	
											}
								        	}
							    	    }
							
						?>
						        	</div>	
						        	<div style="width:15% !important;float:left;padding:5px 0px;margin-left:10%;">
			    <?php		
				                if($Questions[$i]->UserMarks==null)
							    {
				?>
				                        <div style="width:100%;float:left;">
				                            <p><b>Not Attempted<b></p>
				                        </div>
				<?php
								}
								else
								{
				?>
				                        <div style="width:100%;float:left;">
				                            <p><b>Attempted</b></p>
				                        </div>
				
				<?php	
								}				        	    
						
                                if($Questions[$i]->ReferenceDoc!=null)
				                {
				?>
				                    <div style="width:100%;float:left;">
				                        <label><a href="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->ReferenceDoc; ?>" target="_blank">Reference Document</a></label>
				                    </div>
				<?php
				                }
				                if($Questions[$i]->RefDocPageNo!=null && $Questions[$i]->RefDocPageNo!=0)
				                {
				?>
				                         <div style="width:100%;float:left;">
				                            <label> <a href="<?php echo base_url() ?>/assets/uploads/<?php echo $PaperRefDoc[0]->ReferenceDoc; ?>#page=<?php echo $Questions[$i]->RefDocPageNo ?>" target="_blank">Reference Document</a></label>
				                         </div>
			    <?php
				                }
				
								$AdminMarks=$Questions[$i]->Marks;
								$UserMarks=$Questions[$i]->UserMarks;
								$NegativeMarks=$Questions[$i]->Negative_marks;
								
								if($AdminMarks==$UserMarks)
								{
				?>
									<div style="width:100%;float:left;">				
									<img src="<?php echo base_url() ?>/assets/images/checked.png">
									</div>
									<div style="width:100%;float:left;margin-top:10px;">
									<div style="color:green"><b>Full Marks:&nbsp;<?php echo $UserMarks; ?></b></div>
									</div>								
									
				<?php
								}
								else if($UserMarks=='0' || $UserMarks==null)
								{
				?>
									<div style="width:100%;float:left;margin-bottom:7px;">
									<img src="<?php echo base_url() ?>/assets/images/cancel.png">
									</div>
									<div style="width:100%;float:left;margin-top:10px;">
									<div style="color:red"><b>Negative Marks:&nbsp;<?php echo $UserMarks-=$NegativeMarks; ?></b></div>
									</div>
				<?php
								}
								else if($UserMarks>=1 && $UserMarks<$AdminMarks)
								{
				?>
									<div style="width:100%;float:left;">
									<img src="<?php echo base_url() ?>/assets/images/warning.png">
									</div>
									<div style="width:100%;float:left;margin-top:10px;">
									<div style="color:orange"><b>Partial Marks:&nbsp;<?php echo $UserMarks; ?></b></div>
									</div>
				<?php	
								}

				?>
							</div>
				                </div>
				<?php
					}
				?>
						</div>
												
				<?php
					$no++;
					$admin_total+=$AdminMarks;
			    	$user_total+=$UserMarks;
					}
				?>
					
					</div>
					
					<div style="width:100%;float:left;">	
						<hr style="border-top: 1px solid #4D4D4D">
					</div>
					<div style="width:100%;float:left;">	
						<div align="right" style="margin-right:4%">
							<b>Total Marks:&nbsp;<?php echo $user_total."/".$admin_total; ?></b>
							<input type="hidden" id="UserTotalMarks" value="<?php echo $user_total ?>">
						</div>
					</div>
				</div>
				</div>
					
		</form>	
	</body>
</html>
