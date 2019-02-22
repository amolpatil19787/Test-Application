<html>
	<head>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url() ?>/assets/css/QuestionPaper.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
		
		<script src="<?php echo base_url() ?>/assets/js/jquery-3.3.1.min.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
    
        	<title>QUESTION & ANSWER</title>
    <link rel="icon" type="image/ico" href="<?php echo base_url() ?>/assets/images/logo.png" />

        <style>
           .wrap
	        {
	            word-wrap: break-word;
	        }
	         @media screen and (min-width:300px) {
		    
		    .logo
		    {
		        margin:5px 5px !important;
		    }
			}
        </style>
		<script>
		function submitData(btn){
			//alert("egfeslg");
			debugger;

//var cnt=$("#total").val();
	//var cnt=btn.parentElement.parentElement.nextElementSibling.nextElementSibling.value;
	var marks;
	if(btn.id=="partial")
	{
 		marks =btn.parentElement.childNodes[5].value;

		var labelmarks=btn.parentElement.parentElement.childNodes[5].innerHTML.split(':')[1].split('<')[0];
		var textboxmarks=parseInt(marks);
		var labelmarkss=parseInt(labelmarks);
		if(marks=="")
		{
		   // alert('Please enter marks');
		    $.alert({
				        	    title: '',
                         content: 'Please enter partial marks first!'
                    });
                    return false;
		}
		if( textboxmarks <= labelmarkss && textboxmarks>=1)
		{
			marks =btn.parentElement.childNodes[5].value;
		}

		else
		{
			marks=0;
		//	alert("please enter marks less than or equal to "+labelmarks);
			 $.alert({
				        	    title: '',
                         content: 'please enter marks less than or equal to '+labelmarks+'!'
                    });
                    return false;
		}
		
	}
	else
	{
      
	 		marks =btn.parentElement.parentElement.childNodes[5].innerHTML.split(':')[1].split('<')[0];
	}
			var id=btn.parentElement.parentElement.childNodes[1].value;
	   		 var btnid=btn.id;
		//	alert(btnid);
           		 $.ajax({
                	type: "POST",
                	url: '<?php echo base_url() ?>/Questions/UserMarks',
                	data: {marks:marks,id:id,buttonid:btnid},
                	success:function(data)
                	{
				debugger;
        		        //  alert('SUCCESS!!');
        	        },
        	        error:function()
        	        {
        	         	// alert('fail');
        	        }
        	    });
	}
	
	function StoreUserResult()
	{
	    // alert($('#UserID').val());
	     
	     var UserID=$('#UserID').val();
	    
	     var QuePaperID=$('#UserQPID').val();
	     
            	            $.ajax({
					type: "post",
         				url:"<?php echo base_url(); ?>Questions/SubmitUsersTotalMarks", //the page containing php script
           				data: {UserID:UserID,QuePaperID:QuePaperID},
            				success:function(data)
					{
					      
					       var QPName=$('#QPName').val();
					       
					       $.confirm({
                            title: '',
                              content: 'You have successfully stored user result!',
                             buttons: {
                                Ok: function () {
                                   window.location.href='<?php echo site_url() ?>Questions/UserList?QPName='+QPName;
                                  }
                               }
                            });
					},
					 error:function()
        			        {
        			         	 //alert('fail');
        			       	 }
					});
	}

    function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
         $(document).ready(function() {
                	$(".fancybox").fancybox({
                		openEffect	: 'none',
	                	closeEffect	: 'none'
            	});
                });
		</script>
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
     			<a href="<?php echo site_url() ?>Questions/AdminHomePage"><img class="logo" src="<?php echo base_url() ?>/assets/images/logo2.png" width="225" height="35" style="margin:10px 15px;"></a>
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
            <div class="container">
                <div class="row">
                     <form method="post" action="<?php echo site_url() ?>/Questions/UserQuestionPaper">
                            <div class="col-md-6" style="margin-top:10px;background-color:#F8F8F8;border-right:10px solid white;">
                                <div class="row">
                                    <h1 class="text-center" style="color:#0071BC">Admin</h1>
                                </div>
                                <?php
				            	if(empty($Questions))
				            	{}
            					else
			            		{
			            		?>
			            	<div style="width:98%;float:left;margin-top:5px;margin-left:2%;">
			            		    <center><h1 style="font-size:38px;text-transform:capitalize;"><?php echo $Questions[0]->Title; ?></h1></center>
			            		    <input type="hidden" id="QPName" value="<?php echo $Questions[0]->Title; ?>">
						        	<label>Date:&nbsp;&nbsp;<?php	$originalDate =$Questions[0]->Date;
						            	echo $newDate = date("d-m-Y", strtotime($originalDate));  ?></label><br>
					            		<label>Total Marks:&nbsp;&nbsp;<?php echo $Questions[0]->TotalMarks; ?></label>
					            	
				                	<hr style="border-top: 1px solid #4D4D4D">   
			            		</div>
			            		<div class="row">
			            		        <?php
			            		}
			                    		if(empty($Questions))
			                    		{		}
				                    	else
				                    	{
				                    	$no=1;

				                    	$count=0;
				                    	for($i=0;$i<count($Questions);$i++)
				                    	{	
				                		$count++;
				                		
				                    	?>
				                    	   
				                    	<?php
					                	if($Questions[$i]->QueType=='Multiple choice questions')
					                    {
					                    ?>   
					                             <div style="width:98%;float:left;margin-top:5px;margin-left:2%;">
					                   
				                    	            <div style="width:100%;float:left;">
				                    	                <div style="width:78%;float:left;margin-left:2%;">
					                        				<label style="font-size:20px;" class="wrap">Q<?php echo $no; ?>.<?php echo $Questions[$i]->Question ?></label>
						                        		</div>
						                        		<div style="width:18%;float:left;margin-left:2%;">
								                        	<label>Marks:<span><?php echo $Questions[$i]->Marks ?></span></label>	
							                        	</div>
				                    	            </div>
				                    	<?php
							                    if($Questions[$i]->Image!=null)
						                    	{
							
				                    	  ?>
				                    	            <div style="width:98%;float:left;margin-top:5px;margin-left:2%;">
							                    		<a id="fbox" class="fancybox" href="#Multi"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="70" height="70"></a><br>
							                    	    <div id="Multi" style="display:none;width:600px;height:500px;">
                                                           <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="500" height="500">
                                                        </div>
							                    	</div>
							            <?php
						                    	}
							            ?>
							                    <div style="float:left;width:92%;margin-top:10px;margin-left:4%;margin-right:4%;">
		                            						<label>Answers:</label><br>
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
										                            	<input type="checkbox" checked="checked" disabled><span class="wrap"><?php echo html_escape($a->Answer); ?></span><br>
			                        	<?php
									        			$found=true;
											                        }
													
							                    			}
								                    		if($found==false)
										                    {
		                           		?>
			                            								<input type="checkbox" disabled><span class="wrap"><?php echo html_escape($a->Answer); ?></span><br>
                                        <?php	
		                    								}
	                     				?>		
	                    				<?php
	                       								}	
								                    }
							
			                        	?>
					                        		</div>
					                        		</div>
					                   <?php 		
								            }
				                       
				                    		if($Questions[$i]->QueType=='Descriptive questions')
				                    		{
				                        ?>
				                                 <div style="width:98%;float:left;margin-top:5px;margin-left:2%;">
				                       
				                    	                <div style="width:100%;float:left;">
				                    	                    <div style="width:78%;float:left;margin-left:2%;">
						                                    	<label style="font-size:20px;" class="wrap">Q<?php echo $no; ?>.<?php echo $Questions[$i]->Question ?></label>
						                                    	<input type="hidden" name="DescQueID<?php echo $count; ?>" value="$Questions[$i]->QuestionID">
						                                	</div>
							                                <div style="width:18%;float:left;margin-left:2%;">
						                                    	<label>Marks:<span><?php echo $Questions[$i]->Marks ?></span></label>	
						                                	</div>
				                    	                </div>
				                    	  <?php
				                    			if($Questions[$i]->Image!=null)
				                    			{
							
			                            	?>
				                    	                <div style="width:98%;float:left;margin-top:5px;margin-left:2%;">
						                                    	<a id="fbox" class="fancybox" href="#Desc"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="70" height="70"></a>
						                                        <div id="Desc" style="display:none;width:600px;height:500px;">
                                                                     <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="500" height="500">
                                                                 </div>
						                            	</div>
						                    <?php
				                    			}
						                    ?>
						                            	<div style="float:left;width:92%;margin-top:10px;margin-left:4%;margin-right:4%;">
			                                				<label>Answer:</label><br>
			                            	<?php
				                    				foreach($Answers as $a)
				                    				{
			                        						if($Questions[$i]->QuestionID==$a->QuestionID)
								                        	{
									
			                            	?>	
						                            				<p class="wrap"><?php echo html_escape($a->Answer); ?></p><br>
				                            <?php
					                           				}
					                    			}
							
							
			                            	?>
						                        	</div>
						                        	</div>
						                        	 
				                    	    <?php
				                    			}
				                    		
			                        			if($Questions[$i]->QueType=='Fill in the blanks')
			                        			{
			                        		?>
			                        		        <div style="width:98%;float:left;margin-top:5px;margin-left:2%;">
			                        	     
			                                                   <div style="width:100%;float:left;">
			                                                        <div style="width:78%;float:left;margin-left:2%;">
						                                        		<label style="font-size:20px;" class="wrap">Q<?php echo $no; ?>.<?php echo $Questions[$i]->Question ?></label>
							                                    	</div>
							                                    	 <div style="width:18%;float:left;margin-left:2%;">
							                                            	<label>Marks:<?php echo $Questions[$i]->Marks ?></label>
								                                    </div>
			                                                    </div> 
			                               	<?php
			                        				if($Questions[$i]->Image!=null)
				                        			{
				    			
			                                ?> 
			                              
			                                                     <div style="width:98%;float:left;margin-top:5px;margin-left:2%;">
					                                            	<a id="fbox" class="fancybox" href="#Fill"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="70" height="70"></a>
							                                	    <div id="Fill" style="display:none;width:600px;height:500px;">
                                                                       <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="500" height="500">
                                                                     </div>
							                                	</div>
							                <?php
				                        			}
							                ?>
							                                	<div style="float:left;width:92%;margin-top:10px;margin-left:4%;margin-right:4%;">
							                                	    <label>Answers:</label><br>
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
										                                	<input type="radio" checked="checked" disabled><span class="wrap"><?php echo html_escape($a->Answer); ?></span><br>
			                                	<?php
				                    				            			$found=true;
										                            	}
													
									                            	}
									                        	if($found==false)
									                        	{
			                                	?>	
										                                	<input type="radio" disabled><span class="wrap"><?php echo html_escape($a->Answer); ?></span><br>
				                                <?php	
								                        		}
								                    	}	
							                    	}
							
				?>
							                                	</div>
							                                </div>
			                                	<?php
				                        			}
				                        		
					                               	if($Questions[$i]->QueType=='True false')
					                            	{
					                            ?>
					                                    <div style="width:98%;float:left;margin-top:5px;margin-left:2%;">
					                           
			                                	                 <div style="width:100%;float:left;">
			                                	                        <div style="width:78%;float:left;margin-left:2%;">
							                                            	<label style="font-size:20px;" class="wrap">Q<?php echo $no; ?>.<?php echo $Questions[$i]->Question ?></label>
							                                        	</div>
							                                        	<div style="width:18%;float:left;margin-left:2%;">
							                                            	<label>Marks:<?php echo $Questions[$i]->Marks ?></label>
							                                        	</div>
			                                	                 </div>
			                                	 <?php
					                            		if($Questions[$i]->Image!=null)
						                            	{
							
			                                	?> 
			                                	                 <div style="width:98%;float:left;margin-top:5px;margin-left:2%;">
						                                            <a id="fbox" class="fancybox" href="#TF"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="70" height="70"></a>
							                                        <div id="TF" style="display:none;width:600px;height:500px;">
                                                                       <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="500" height="500">
                                                                     </div>
							                                	</div>
							                     <?php
						                            	}
							                     ?>
							                                	<div style="float:left;width:92%;margin-top:10px;margin-left:4%;margin-right:4%;">
							                                	        <label>Answers:</label><br>
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
									                                    		<input type="radio" checked="checked" disabled><?php echo $a->Answer; ?><br>
			                            	<?php       
										                                	$found=true;
										                            	}
													
									                            	}
									                             	if($found==false)
									                            	{
			                            	?>	
							                                    				<input type="radio" disabled><?php echo $a->Answer; ?><br>
			                            	<?php	
									                            	}
								                        	}	
							                        	}
							
				                            ?>
							                                    </div>
							                                   </div>
			                                	<?php
						                            	}
						                            	
					                            ?>
				                    	   
				                    	<?php
				                    	$no++;}}
				                    	?>
			            		</div>
                            </div>
                            <div class="col-md-6" style="margin-top:10px;background-color:#F8F8F8;">
                                <div class="row">
                                    <h1 class="text-center" style="color:#0071BC">User</h1>
                                    <h4 class="text-center" style="color:#0071BC"><?php echo $Questions[0]->EmailID; ?></h4>
                                </div>
                                <?php
					            if(empty($Questions))
				        	    {}
			        		    else
					             {
				            	?>
				            	 <div style="width:98%;float:left;margin-top:5px;margin-left:2%;">
				            	        <center><h1 style="font-size:38px;text-transform:capitalize;"><?php echo $Questions[0]->Title; ?></h1></center>
		                    			<label>Date:&nbsp;&nbsp;<?php	$originalDate =$Questions[0]->Date;
                                        echo $newDate = date("d-m-Y", strtotime($originalDate));  ?></label><br>
			                    		<label>Total Marks:&nbsp;&nbsp;<?php echo $Questions[0]->TotalMarks; ?></label>
			                    		<input type="hidden" id="UserID" value="<?php echo $Questions[0]->UserID; ?>">
			                    		<input type="hidden" id="UserQPID" value="<?php echo $Questions[0]->QuePaperID; ?>">
			                       		<hr style="border-top: 1px solid #4D4D4D">
				            	 </div>
				            	 <div class="row">
				            	 <?php
					             }
			            		if(empty($Questions))
				              	{	}
					            else
				            	{
				                	$no=1;
				                	$count=0;
				                	for($i=0;$i<count($Questions);$i++)
				                	{	
				                		$count++;
				            
					                	if($Questions[$i]->QueType=='Multiple choice questions')
				                		{
				            	?>
				            	                 <div style="width:98%;float:left;margin-top:5px;margin-left:2%;">
					                    		<input type="hidden" value="<?php echo $Questions[$i]->QueAttemptID ?>">
				            	
				            	                    <div style="width:78%;float:left;margin-left:2%;">
						                            	<label style="font-size:20px;" class="wrap">Q<?php echo $no; ?>.<?php echo $Questions[$i]->Question ?></label>
						                           	</div>
						                        	<div style="width:18%;float:left;margin-left:2%;">
						                            	<label>Marks:<?php echo $Questions[$i]->Marks ?></label>	
						                        	</div>
						      <?php
				                    			if($Questions[$i]->Image!=null)
						                    	{
							
				            	?>    
						                        	<div style="width:98%;float:left;margin-top:5px;margin-left:2%;">
						                            	<img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="70" height="70"><br>
						                        	</div>
						      <?php
						                    	}
						      ?>
						                        	<div style="float:left;width:92%;margin-top:10px;margin-left:4%;margin-right:4%;">
						                        	    <div style="width:80%;float:left;border:1px solid #F8F8F8;">
						                        	     <label>Answers:</label><br>
			            	<?php
							
				                        				foreach($UserAnswers as $a)
						                        		{
						                        			if($Questions[$i]->QuestionID==$a->QuestionID)
							                        		{
			            	?>	
								                            	    	<p class="wrap"><?php echo html_escape($a->Answer); ?></p>
			            	<?php	
							                        		}	
						                        		}
			            	?>
			            	                                </div>
			            	                                       <div style="width:16%;float:left;margin-left:4%;">
					        <?php
					                                        if($Questions[$i]->QueAttemptID==null)
					                                        {
					        ?>
					                                            <p><b>Not Attempted</b></p>
					       <?php
					                                        }
					                                        else
					                                        {
					       ?>
					                                            <p><b>Attempted</b></p>
					       <?php
					                                        }
					        ?>
							                        		</div>
						                        	</div>
					        <?php
					                                        if($Questions[$i]->QueAttemptID!=null)
					                                        {
					        ?>
						                        	<div style="float:left;width:92%;margin-top:10px;margin-left:4%;margin-right:4%;">
						                        	    <input type="button" value="correct" id="correct" class="btn btn-success" onclick="submitData(this)">
							                        	<input type="button" value="incorrect" id="incorrect" class="btn btn-danger" onclick="submitData(this)">
							                        	<input type="text" id="PartialMarks" onkeypress="return isNumberKey(event)" style="width:20%;">&nbsp;<b>=</b>&nbsp;
							                           	<input type="button" value="partial" id="partial" class="btn btn-primary" onclick="submitData(this)">
						                        	</div>
					        <?php
					                                        }
					        ?>
						                        </div>
				            	<?php
						                    	}
						  
				                    	if($Questions[$i]->QueType=='Descriptive questions')
			                    		{
			                	?>
			                	                <div style="width:98%;float:left;margin-top:5px;margin-left:2%;">
			                            			<input type="hidden" value="<?php echo $Questions[$i]->QueAttemptID ?>">
			                              
				            	                    <div style="width:78%;float:left;margin-left:2%;">
				                            			<label style="font-size:20px;" class="wrap">Q<?php echo $no; ?>.<?php echo $Questions[$i]->Question ?></label>
				                        			</div>
					                        		<div style="width:18%;float:left;margin-left:2%;">
					                            		<label>Marks:<?php echo $Questions[$i]->Marks ?></label>	
						                        	</div>
						      	<?php
				                    		if($Questions[$i]->Image!=null)
				                    		{
				                ?> 
						                        	<div style="width:98%;float:left;margin-top:5px;margin-left:2%;">
						                                	<img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="70" height="70">
						                         	</div>
						        <?php
				                    		} 
						        ?>
						                         	<div style="float:left;width:92%;margin-top:10px;margin-left:4%;margin-right:4%;">
						                         	    <div style="width:80%;float:left;border:1px solid #F8F8F8;">
                                                    <label>Answer:</label><br>
                                                    
					        	<?php
						                    	foreach($UserAnswers as $a)
						                    	{
						                        		if($Questions[$i]->QuestionID==$a->QuestionID && $a->IsDescriptive=='1')
							                        	{
			                	?>	
							                            		<p class="wrap"><?php echo html_escape($a->DescAns); ?></p><br>
							                            		
			                	<?php
							                        	}
						                    	}
							
							
			                	?>
			                	                    </div>
			                	                                <div style="width:16%;float:left;margin-left:4%;">
					        <?php
					                                        if($Questions[$i]->QueAttemptID==null)
					                                        {
					        ?>
					                                            <p><b>Not Attempted</b></p>
					       <?php
					                                        }
					                                        else
					                                        {
					       ?>
					                                            <p><b>Attempted</b></p>
					       <?php
					                                        }
					        ?>
							                        		</div>
				            	                    </div>
				            <?php
					                                        if($Questions[$i]->QueAttemptID!=null)
					                                        {
					        ?>
				            	                    <div style="float:left;width:92%;margin-top:10px;margin-left:4%;margin-right:4%;">
				            	                            <input type="button" value="correct" id="correct" class="btn btn-success" onclick="submitData(this)">
							                            	<input type="button" value="incorrect" id="incorrect" class="btn btn-danger" onclick="submitData(this)">
								                            <input type="text" id="PartialMarks" onkeypress="return isNumberKey(event)" style="width:20%;">&nbsp;<b>=</b>&nbsp;
								                            <input type="button" value="partial" id="partial" class="btn btn-primary" onclick="submitData(this)">
				            	                    </div>
				            <?php
					                                        }
				            ?>
				            	               </div>
				            	<?php
				                    		}
				            
				                    	if($Questions[$i]->QueType=='Fill in the blanks')
				                    	{
				                ?>
				                                <div style="width:98%;float:left;margin-top:5px;margin-left:2%;">
				                        		<input type="hidden" value="<?php echo $Questions[$i]->QueAttemptID ?>">
			                	          
				            	                        <div style="width:78%;float:left;margin-left:2%;">
						                                	<label style="font-size:20px;" class="wrap">Q<?php echo $no; ?>.<?php echo $Questions[$i]->Question ?></label>
							                                <input type="hidden" name="FillQueID<?php echo $count; ?>" value="<?php echo $Questions[$i]->QuestionID ?>">
							                            </div>
							                            <div style="width:18%;float:left;margin-left:2%;">
						                                	<label>Marks:<?php echo $Questions[$i]->Marks ?></label>
						                            	</div>
						      <?php
					                        	if($Questions[$i]->Image!=null)
					                        	{		
			                	?> 
						                            	<div style="width:98%;float:left;margin-top:5px;margin-left:2%;">
						                                    	<img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="70" height="70">
						                            	</div>
						          <?php
					                        	}
						          ?>
						                            	<div style="float:left;width:92%;margin-top:10px;margin-left:4%;margin-right:4%;">
						                            	     <div style="width:80%;float:left;border:1px solid #F8F8F8;">
						                            	    <label>Answer:</label><br>
					    	<?php
						                        	foreach($UserAnswers as $a)
						                        	{
							                        	if($Questions[$i]->QuestionID==$a->QuestionID)
							                        	{
			            	?>	
							                        		<p class="wrap"><?php echo html_escape($a->Answer); ?></p>
							                        		
			            	<?php
							                        	}
					                    	    	}
					       ?>
					                                        	</div>
					                    	    	        <div style="width:16%;float:left;margin-left:4%;">
					        <?php
					                                        if($Questions[$i]->QueAttemptID==null)
					                                        {
					        ?>
					                                            <p><b>Not Attempted</b></p>
					       <?php
					                                        }
					                                        else
					                                        {
					       ?>
					                                            <p><b>Attempted</b></p>
					       <?php
					                                        }
					        ?>
							                        		</div>
				            	                        </div>
				            <?php
					                                        if($Questions[$i]->QueAttemptID!=null)
					                                        {
					        ?>
				            	                        <div style="float:left;width:92%;margin-top:10px;margin-left:4%;margin-right:4%;">
				            	                                <input type="button" value="correct" id="correct" class="btn btn-success" onclick="submitData(this)">
						                                		<input type="button" value="incorrect" id="incorrect" class="btn btn-danger" onclick="submitData(this)">
						                                		<input type="text" id="PartialMarks" onkeypress="return isNumberKey(event)" style="width:20%;">&nbsp;<b>=</b>&nbsp;
							                                	<input type="button" value="partial" id="partial" class="btn btn-primary" onclick="submitData(this)">
				            	                        </div>
				            <?php
					                                        }
				            ?>
				            	                   </div>
				            	<?php
					               }
					          
					             if($Questions[$i]->QueType=='True false')
				                    {
			                	?>
			                	            <div style="width:98%;float:left;margin-top:5px;margin-left:2%;">
				                        		<input type="hidden" value="<?php echo $Questions[$i]->QueAttemptID ?>">
			                
			                	                        <div style="width:78%;float:left;margin-left:2%;">
					                                		<label style="font-size:20px;" class="wrap">Q<?php echo $no; ?>.<?php echo $Questions[$i]->Question ?></label>
						                            	</div>
						                            	<div style="width:18%;float:left;margin-left:2%;">
						                                   	<label>Marks:<?php echo $Questions[$i]->Marks ?></label>	
						                            	</div>
						          	<?php
				                        		if($Questions[$i]->Image!=null)
					                        	{
			                    	?>  
						                            	<div style="width:98%;float:left;margin-top:5px;margin-left:2%;">
					                                		<img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="70" height="70">
						                            	</div>
						            <?php
					                        	}
						            ?>
						                            	<div style="float:left;width:92%;margin-top:10px;margin-left:4%;margin-right:4%;">
						                            	<div style="width:80%;float:left;border:1px solid #F8F8F8;">    
						                            	<label>Answer:</label><br>						
				                <?php
						                    		foreach($UserAnswers as $a)
							                    	{
							                    		if($Questions[$i]->QuestionID==$a->QuestionID)
							                    		{
			                	?>	
			                	                                 
							                        	    		<p><?php echo html_escape($a->Answer); ?></p>
							                        			 
				                <?php
							                    		}
							                    	}
				?>
				                                            </div>
				                                                <div style="width:16%;float:left;margin-left:4%;">
					        <?php
					                                        if($Questions[$i]->QueAttemptID==null)
					                                        {
					        ?>
					                                            <p><b>Not Attempted</b></p>
					       <?php
					                                        }
					                                        else
					                                        {
					       ?>
					                                            <p><b>Attempted</b></p>
					       <?php
					                                        }
					        ?>
							                        		</div>
						                            	</div>
						  <?php
					                                        if($Questions[$i]->QueAttemptID!=null)
					                                        {
					        ?>
						                            	<div style="float:left;width:92%;margin-top:10px;margin-left:4%;margin-right:4%;">
						                            	        <input type="button" value="correct" id="correct" class="btn btn-success" onclick="submitData(this)">
							                                	<input type="button" value="incorrect" id="incorrect" class="btn btn-danger" onclick="submitData(this)">
								                                <input type="text" id="PartialMarks" onkeypress="return isNumberKey(event)" style="width:20%;">&nbsp;<b>=</b>&nbsp;
							                                   	<input type="button" value="partial" id="partial" class="btn btn-primary" onclick="submitData(this)">
						                            	</div>
					        <?php
					                                        }
					        ?>
						                          </div>
			                	<?php
					            }
					                       
				            	    $no++;
					                }
				            	    
				            	}
				            	?>
				            	        <div style="width:100%;padding:2%;margin-top:2%;float:left;text-align:center;">
				            	            <input type="button" value="Store User Result" class="btn btn-primary" onclick="StoreUserResult();">
				            	        </div>
				            	 </div>
                            </div>
                     </form>
                </div>
            </div>
	</body>
	</html>
