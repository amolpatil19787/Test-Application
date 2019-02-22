<!DOCTYPE html>
<html>
	<head>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url() ?>/assets/css/style.css" rel="stylesheet">
			<link href="<?php echo base_url() ?>/assets/css/CreateDraftLayout.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!--	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">  -->
		<!--<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">-->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
		
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
         <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>
			<script src="<?php echo base_url() ?>/assets/js/QuestionTypesDraftPaper.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/DraftedPaperTotal.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/DraftedValidation.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
	
	        	<title>QUESTION & ANSWER</title>
    <link rel="icon" type="image/ico" href="<?php echo base_url() ?>/assets/images/logo.png" />
	
	<style>

			@import url(https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500);

			.cls {
   				 float:right;
    				display:inline-block;
   				padding:0px 4px;
				height:25px;
				font-weight:200;
				margin-right:10px;
   				background:#ccc;
				color:white;
				font-size:18px;
				border-radius:2px;
				cursor:pointer;
				}
			
			.cls:hover {
  			  float:right;
   			 display:inline-block;
   			
   			 background:#ccc;
    			color:black;
			}
			.format:hover
			{	
				text-decoration:none;
				background-color:#23527c !important;
			}
			.btnhover:hover
	    	{
	    	    background-color:#23527c !important;
	    	}
	    	.wrap
	        {
	            word-wrap: break-word;
	        }
	         .disabledbutton {
    pointer-events: none;
    opacity: 0.4;
}
.homebtn
{
    background-color:#0071BC;
    color:white;
}
.homebtn:hover
{
   background-color:#23527c !important;
   color:white;
   
}

.circleimage {
   position: absolute;
   left: 50%;
}

.clsprogressByJS {
   display: none;
   background-color: #e9e3e3;
   opacity: 0.4;
   text-align: center;
   z-index: 999;
   vertical-align: middle;
   position: absolute;
   width: 100%;
   height: 100%;
}
    @media screen and (min-width:300px) {
		    
		    .logo
		    {
		        margin:5px 5px !important;
		    }
			}

.multiselect {
 
  width:58%;
  margin-top:10px;
  z-index:1;
  position:relative;
}

.selectBox {
  position: relative;
   height:25px;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: lightgray;
}


	</style>
	
	<script>
			
		
		submitcount=0;
		function FormSubmit()
		{
			
			debugger;
			if($('#drafted').is(":visible"))
			{
				$('#drafted').hide();
				$('#Createddrafted').show();
				$('#edit').attr('value','Edit');	
				$('#submitbtn').show();
			}
			else
			{
				$('#Createddrafted').hide();
				$('#drafted').show();
			}
		}
		
		$(document).on('click',function(){
	$('.collapse').collapse('hide');
    })
    
    $(document).ready(
        function()
        {
                debugger;
                var Count=$('#TotalCount').val();
                var ExecCount = Count.split(','); 
             
        	      if ($("#mock").is(":checked")) 
				    {
				        $('#NewPaperRefDoc').removeAttr('disabled');
        	          for(var c=0;c<ExecCount.length;c++)
        	          {
        	                $('#RefDocMulti'+ExecCount[c]).removeAttr('disabled');
        	                $('#RefDocMultiPageNo'+ExecCount[c]).removeAttr('disabled');
        	                
        	                $('#RefDocDesc'+ExecCount[c]).removeAttr('disabled');
        	                 $('#RefDocDescPageNo'+ExecCount[c]).removeAttr('disabled');
        	                
        	                $('#RefDocFill'+ExecCount[c]).removeAttr('disabled');
        	                 $('#RefDocFillPageNo'+ExecCount[c]).removeAttr('disabled');
        	                
        	                $('#RefDocTF'+ExecCount[c]).removeAttr('disabled');
        	                $('#RefDocTFPageNo'+ExecCount[c]).removeAttr('disabled'); 
        	          }
				    }
				    if ($("#regular").is(":checked")) 
				    {
				        $('#NewPaperRefDoc').attr('disabled','disabled');
        	         for(var c=0;c<ExecCount.length;c++)
        	          {
        	                $('#RefDocMulti'+ExecCount[c]).attr('disabled','disabled');
        	                $('#RefDocMultiPageNo'+ExecCount[c]).attr('disabled','disabled');
        	                 
        	                $('#RefDocDesc'+ExecCount[c]).attr('disabled','disabled');
        	                $('#RefDocDescPageNo'+ExecCount[c]).attr('disabled','disabled');
        	                
        	                $('#RefDocFill'+ExecCount[c]).attr('disabled','disabled');
        	                $('#RefDocFillPageNo'+ExecCount[c]).attr('disabled','disabled');
        	                
        	                $('#RefDocTF'+ExecCount[c]).attr('disabled','disabled');
        	                $('#RefDocMultiPageNo'+ExecCount[c]).attr('disabled','disabled');
        	          }
				    }
        }
        )
    
   $(function() {
       debugger;
               $("#datepicker").datepicker({  minDate: new Date(),dateFormat: 'dd-mm-yy'});
        	      $('#datepicker').datepicker('setDate', 'today');
        	      
        	     
        	  });
        	  
       var expanded = false;

function showCheckboxes() {
    
    $('#checkboxes').toggle();
  
}	  
    
    
	</script>
	</head>
	<body onload="DraftedPaperMarks(this);MarksTotal();">
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
 <div id="progress_By_JS" class="clsprogressByJS" style="display: none;margin-top:20%;" align="center">
            <input type="image" name="image" class="circleimage" src="<?php echo base_url() ?>/assets/images/progress.gif" title="Wait" alt="Wait">
    </div>
	<div class="container" id="mydiv" style="margin:1%;">
          <div class="row">
			        <a href="<?php echo site_url() ?>/Questions/AdminHomePage" class="btn homebtn"><i class="fa fa-home"></i> Home</a>
			</div>
      </div>	
	 <form method="post" class="form-horizontal" enctype="multipart/form-data" id="draftedform" action="<?php echo site_url()?>/Questions/DraftedQuestionPaperData">
	<div class="container-fluid" style="background-color:#F0F0F0;padding:1%;" id="mycontainer">
	        <div class="row">
	        	<center><h4 style="color:#C1272D;"><b><u>EDIT QUESTION PAPER</b></u></h4></center>
	    	</div>
		<div class="row">
			<div class="col-md-6">
			 
				<table style="margin-left:4%;font-size:14px;border: none !important;"> 
				    <?php
				    if(empty($Questions))
				    {
				    ?>
				      <tr>	
						<td style="width:40%;">Question Paper Name:&nbsp;</td>
						<td><input type="text" name="paper_name" id="paper_name" style="border:1px solid lightgray;width:58%;padding:1%;"><br></td>
					</tr>
					<tr>
						<td style="width:40%;">Date:</td>
						<td><input type="text" onkeydown="return false" name="date" style="border:1px solid lightgray;margin-top:10px;width:58%;padding:1%;"></td>
					</tr>
					<tr>
						<td style="width:40%;">Total Marks:</td>
						<td><input type="text" id="Marks" name="paper_marks" style="margin-top:10px !important;border:1px solid lightgray;width:58%;padding:1%;" oninput="MarksTotal()"><br></td>
					</tr>	
					<tr style="visibility: hidden"><td>dfsd</td></tr>
					<tr>
						<td style="width:40%;">Out Of Marks:</td>
						<td><input type="text" name="final_marks" id="total" style="width:26%;border:1px solid lightgray;padding:1%;" readonly>&nbsp;<span style="font-size:35px;">/</span>&nbsp;<input type="text" id="TotalMarks" style="border:1px solid lightgray;width:27%;padding:1%;" placeholder="Total marks" readonly></td>
					</tr>
				    <?php  
				    }
				    else
				    {
				    ?>
					<tr>	
						<td style="width:32%;">Question Paper Name:&nbsp;</td>
						<td><input type="text" name="paper_name" style="border:1px solid lightgray;width:58%;" onkeyup="javascript:capitalize(this.id, this.value);" id="paper_name" value="<?php echo $Questions[0]->Title; ?>"><br></td>
					</tr>
					<tr>
						<td>Date:</td>
						<td><input type="text" style="border:1px solid lightgray;width:58%;margin-top:10px;" id="datepicker" value="<?php $originalDate =$QuePaperDate[0]->Date;echo $newDate = date("d-m-Y", strtotime($originalDate)); ?>" name="date"></td>
					</tr>
					<tr>
						<td>Total Marks:</td>
						<td><input type="text" style="border:1px solid lightgray;width:58%;margin-top:10px;" onkeypress="return isNumberKey(event)" id="Marks" name="paper_marks" style="border:1px solid lightgray;width:58%;margin-top:10px;" oninput="MarksTotal()" value="<?php echo $Questions[0]->TotalMarks; ?>"><br></td>
					</tr>	
					<tr>
						<td>Out Of Marks:</td>
						<td><input type="text" name="final_marks" style=" width:26%;border:1px solid lightgray;" id="total" readonly>&nbsp;<span style="font-size:35px;">/</span>&nbsp;<input type="text" style="border:1px solid lightgray;width:27%;" id="TotalMarks" placeholder="Total marks" readonly></td>
					</tr>
					<tr>
                        <td>Passing Percentage:</td>
                        <td><input type="text" style="border:1px solid lightgray;width:20%;" onkeypress="return isNumberKey(event);" name="QPaperPercentage" value="<?php echo $Questions[0]->PassingPercentage; ?>" id="QPaperPercentage">&nbsp;&nbsp;<b>%</b></td>
                    </tr>
                    <tr>
                        <td>Exam Coordinator:</td>
                        <td>
                            <div class="multiselect" style="">
                                <div class="selectBox" onclick="showCheckboxes()">
                                  <select style="height:25px;">
                                       <option>Select an option</option>
                                         </select>
                                         <div class="overSelect"></div>
                                     </div>
                                     <div id="checkboxes" style="display:none;height:90px;overflow:auto;z-index:1000;position:absolute;background-color:white;width:100%;padding:2%;">
                                        <?php
                                       
                                      
                                foreach($ExamCoordinator as $e)
                                {
                                     $found=false;
                                    for($j=0;$j<count($ExamCoordinatorAssocQuePaper);$j++)
									{
                                        if($e->ExamCoordinatorID==$ExamCoordinatorAssocQuePaper[$j]->ExamCoordinatorID)
                                        {
                            ?>
                                     <label><input type="checkbox" name="ExamCoordinators[]" checked value="<?php echo $e->ExamCoordinatorID; ?>"><?php echo $e->DisplayName; ?></label>
                            <?php
                                            $found=true;
                                        }
									}
                                        if($found==false)
                                        {
                            ?>
                                    <label><input type="checkbox" name="ExamCoordinators[]"  value="<?php echo $e->ExamCoordinatorID; ?>"><?php echo $e->DisplayName; ?></label>
                            <?php
                                        }
                                    }
                                
                            ?>
                                     </div>
                                 </div>
                        </td>
                    </tr>
					<tr>
                        <td>Test Type</td>
                        <td>
                            <?php 
                                if($Questions[0]->IsMockTest=='1')
                                {
                            ?>
                            <label class="radio-inline">
                                <input type="radio" name="test" id="mock" value="Mock" checked onchange="AddReferece();">Mock Test
                            </label>
                            <?php
                                }
                                else
                                {
                            ?>
                             <label class="radio-inline">
                                <input type="radio" id="mock" name="test" value="Mock" onchange="AddReferece();">Mock Test
                            </label>
                            <?php
                                    
                                }
                                if($Questions[0]->IsMockTest=='0')
                                {
                            ?>
                            <label class="radio-inline">
                                <input type="radio" name="test" id="regular" value="Regular" checked onchange="RemoveReferece();">Regular Test
                            </label>
                            <?php
                                }
                                else
                                {
                            ?>
                            <label class="radio-inline">
                                <input type="radio" name="test" id="regular" value="Regular" onchange="RemoveReferece();">Regular Test
                            </label>
                            <?php
                                }
                            ?>
                        </td>
                    </tr>
                   <tr style="visibility:hidden"><td>a</td><td>a</td></tr>
                    <tr>
                        <td>Reference Document:</td>
                        <td>
                            <?php
                                if($QuePaperRefDoc[0]->ReferenceDoc!=null)
                                {
                            ?>
                                    <a href="<?php echo base_url() ?>/assets/uploads/<?php echo $QuePaperRefDoc[0]->ReferenceDoc; ?>" target="_blank">Old Reference Document</a><br>
                            <?php
                                }    
                           ?>
                                    <input type="file" id="NewPaperRefDoc" name="NewPaperRefDoc" onchange="GetPaperRefDoc(this)" disabled></td> 
                    </tr>
					<?php
				    }
					?>
				</table>	
			</div>
			<div class="col-md-6">
				<a class="format" href="#demo" data-toggle="collapse" style="background-color:#0071BC;color:white;padding:10px;float:right;">Marks Format<span class="caret"></span></a>
				<div id="demo" class="collapse" style="float:right;margin-left:50%">
					<table class="table" border="1" cellspacing="5" cellpadding="5" style="width:70%;background-color:white;border:1px solid lightgray;">
				<tr>
					<th>Question Type</th>
					<th>Total Questions</th>
					<th>Marks</th>
				</tr>
				<tr>
					<td>Multiple</td>
					<td align="center"><input type="text" id="cnt_multi" style="width:50%;border:0px;" readonly></td>
					<td align="center"><input type="text" id="marks_multiple" style="width:70%;border:0px;" readonly></td>
				</tr>
				<tr>
					<td>Descriptive</td>
					<td align="center"><input type="text" id="cnt_desc" style="width:50%;border:0px;" readonly></td>
					<td align="center"><input type="text" id="marks_Desc" style="width:70%;border:0px;" readonly></td>
				</tr>
				<tr>
					<td>Fill in the blanks</td>
					<td align="center"><input type="text" id="cnt_fill" style="width:50%;border:0px;" readonly></td>
					<td align="center"><input type="text" id="marks_Fills" style="width:70%;border:0px;" readonly></td>
				</tr>
				<tr>
					<td>True False</td>
					<td align="center"><input type="text" id="cnt_tf" style="width:50%;border:0px;" readonly></td>
					<td align="center"><input type="text" id="marks_tf" style="width:70%;border:0px;" readonly>
				</tr>
				<tr>
					<th>Total</th>
					<td align="center"><input type="text" id="total_questions" style="width:50%;border:0px;" readonly></td>
					<td align="center"><input type="text" id="total_marks" style="width:70%;border:0px;" readonly></td>
				</tr>

			</table>
				</div>
			</div>
		</div>
	</div>
		
			
		
				<div style="width:100%;margin-top:20px;">
					<div class="col-md-12">
  						<div class="col-md-3" id="btnquetype" style="background-color:#F0F0F0;padding:20px 20px;height:500px;">
							<center><h4>Question Types</h4></center>
				<?php	
					foreach($QuestionType as $q)
					{
						
				?>
					<input type="button" class="btn btn-block btnhover" style="background-color:#0071BC;color:white;font-weight:bold;margin:20px 0px;" value="<?php echo $q->QueType; ?>" onclick="QuestionTypeClick(this);">
				<input type="hidden" value="<?php echo $q->QueType; ?>" id="qptype">
				<?php	
					}
				?>
  						</div>
						
  						<div class="col-md-9" style="border:1px solid lightgray;height:500px;overflow-x:scroll;padding-top:20px;">

							<div style="width:100%;" id="drafted">
							<?php
								$this->load->helper('form');
							    if(empty($Questions))
							    {
							        
							    }
							    else
							    {
								$no=0;
								$MultiQueCount=0;
								$DescQueCount=0;
								$FillQueCount=0;
								$TFQueCount=0;	
								$ansfill=0;
								$ans=0;
								$array=array();
								
								for($i=0;$i<count($Questions);$i++)
								{
									//print_r($Questions);
								$no++;	
							?>	
								<input type="hidden" name="QuePaperID" value="<?php echo $Questions[$i]->QuePaperID ?>">		
								
							<?php
							
									if($Questions[$i]->QueType=='Multiple choice questions')
									{
								$MultiQueCount++;
								       
								        array_push($array,$no);
							?>
								<div class="container" id="Multiple_Form<?php echo $no; ?>" style="margin-bottom:20px;border:0.5px solid lightgray;padding:10px 0px;width:100%" class="mm">
									<input type="hidden" id="QueType1" name="MultiQueType<?php echo $no; ?>" value="<?php echo $Questions[$i]->QueType ?>">
									<input type="hidden" name="MultiQueID<?php echo $no; ?>" value="<?php echo $Questions[$i]->QuestionID ?>">
									<span class="cls"  onclick="DeleteDraftedQuestion(this)" title="close">X</span>
								<div class="col-md-12" id="MultipleQ<?php echo $no; ?>" style="display:flow-root">		
									<div class="form-group">
										<label class="col-md-2">Question:</label>
										<div class="col-md-8"><input type="text" onkeyup="javascript:capitalize(this.id, this.value);" name="Quemulti<?php echo $no; ?>" value="<?php echo html_escape($Questions[$i]->Question); ?>" class="form-control" id="Quemulti<?php echo $no; ?>" oninput="Data(<?php echo $no; ?>);">
										</div>
										<div class="col-md-2"></div>
									</div>
									<div class="form-group">
										<label class="col-md-2">Image:</label>
										<div class="col-md-4">
								<?php 
										if($Questions[$i]->Image)	
										{
								?>
											<img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image; ?>" width="100" height="100" id="ExistingImgMulti<?php echo $no; ?>">
											<input type="hidden" value="<?php echo $Questions[$i]->Image; ?>" name="ExistingImgMulti<?php echo $no; ?>">
								<?php
										}
								?>
											<img id="ImageMulti<?php echo $no; ?>" width="100" height="100" style="display:none;">
											<input type="file" name="ImgMulti<?php echo $no; ?>" onchange="ValidateFiles(this); ShowImg(this,<?php echo $no; ?>);" id="ImgMulti<?php echo $no; ?>">
										</div>
										</div>
										<div class="form-group">
										<label class="col-md-2">Reference Document:</label>
										<div class="col-md-3">
										    <input type="file" id="RefDocMulti<?php echo $no; ?>" onchange="DisablePageNo(<?php echo $no; ?>)" name="RefDocMulti<?php echo $no; ?>" disabled>
										</div>
										<label class="col-md-1">OR</label>
										<label class="col-md-2">Page No:</label>
										<div class="col-md-2">
										    <input type="text" id="RefDocMultiPageNo<?php echo $no; ?>" onkeypress="return isNumberKey(event)" onfocus="DisableRefDoc(<?php echo $no; ?>)" class="form-control" name="RefDocMultiPageNo<?php echo $no; ?>" <?php if($Questions[$i]->RefDocPageNo=='0'){ ?>value="" <?php  }else{ ?> value="<?php echo html_escape($Questions[$i]->RefDocPageNo); ?>" <?php }?> disabled>
										</div>
										</div>
										<div class="form-group">
											<label class="col-md-2">Marks:</label>
											<div class="col-md-3">
									    		<input type="text" class="form-control" onkeypress="return isNumberKey(event)" name="MarksMulti<?php echo $no; ?>" id="MarksMulti-<?php echo $no; ?>" value="<?php echo $Questions[$i]->Marks; ?>" onblur="AddNewQuesMarks(this); Data(<?php echo $no; ?>);">
										    </div>
											<label class="col-md-2">Negative Marks:</label>
												<div class="col-md-3">
											<input type="text" class="form-control" onkeypress="return onlyNumbersWithdash(event,this);" name="NegMarksMulti<?php echo $no; ?>" id="NegMarksMulti<?php echo $no; ?>" oninput="Data(<?php echo $no; ?>);" value="<?php echo $Questions[$i]->Negative_marks; ?>">
											</div>
										</div>
										<div class="form-group">
										<div class="col-md-12">
										<input type="button" value="Add Answers" id="btnMulti<?php echo $no; ?>" onclick="AddNewAnsMulti(<?php echo $no; ?>)"/>
										</div>
									</div>
									<div class ="col-md-offset-10 col-md-2">
										<label>Correct Answer:</label>
									</div>
								<?php
								
									foreach($Answers as $a)
									{
									    if($Questions[$i]->QuestionID!=$a->QuestionID)
										{
									    	$ans=0;
										}
										if($Questions[$i]->QuestionID==$a->QuestionID)
										{
										$ans=$ans+1;
								?>
										<div class="form-group" id="Multiple-<?php echo $no; ?>">
										<label class="col-md-2" id="Anslabel-<?php echo $ans; ?>">Answer&nbsp;<?php echo $ans; ?>:</label>
										<div class="col-md-8">
											<input type="text" onkeyup="javascript:capitalize(this.id, this.value);" id="txtAnsMulti<?php echo $no; ?>-<?php echo $ans; ?>" name="txtAnsMulti<?php echo $no ?>[]" class="form-control" value="<?php echo html_escape($a->Answer); ?>" oninput="MutliExecAns(<?php echo $no; ?>,<?php echo $ans; ?>);">
											<input type="hidden" name="MultiAnsID<?php echo $no; ?>[]" value="<?php echo $a->AnswerID; ?>">
										</div>
										<?php
										$found=false;
										
										for($j=0;$j<count($AdminCorrectAns);$j++)
										{
											if($a->AnswerID==$AdminCorrectAns[$j]->AnswerID)
											{
				?>	
											<div class="col-md-2">
												<input type="checkbox" id="ChkAnsMulti<?php echo $no; ?>" checked onchange="MultiCheck(this)">	
												<input type="hidden" name="ChkAnsMulti<?php echo $no; ?>[]" value="1">
											</div>
											
				<?php
												$found=true;
											}
													
										}
										if($found==false)
										{
				?>
											<div class="col-md-2">
												<input type="checkbox" id="ChkAnsMulti<?php echo $no; ?>" onchange="MultiCheck(this)">
											<input type="hidden" name="ChkAnsMulti<?php echo $no; ?>[]" value="0">
											</div>
											
								<?php
										}
					
								?>

										</div>
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
							$DescQueCount++;
							            
							            array_push($array,$no);
						?>
									<div class="container" id="Desc_Form<?php echo $no; ?>" style="margin-bottom:20px;border:0.5px solid lightgray;padding:10px 0px;width:100%" class="mm">
									<input type="hidden" id="QueType2" name="DescQueType<?php echo $no; ?>" value="<?php echo $Questions[$i]->QueType ?>">
									<input type="hidden" name="DescQueID<?php echo $no; ?>" value="<?php echo $Questions[$i]->QuestionID ?>">
									<span class="cls"  onclick="DeleteDraftedQuestion(this)" title="close">X</span>
									<div class="col-md-12" id="DescriptiveQ<?php echo $no; ?>" style="display:flow-root">
									<div class="form-group">
										<label class="col-md-2">Question:</label>
										<div class="col-md-8"><input type="text" onkeyup="javascript:capitalize(this.id, this.value);" name="QueDesc<?php echo $no; ?>" value="<?php echo html_escape($Questions[$i]->Question); ?>" class="form-control" id="QueDesc<?php echo $no; ?>" oninput="Data(<?php echo $no; ?>);">
										</div>
										<div class="col-md-2"></div>
									</div>
									<div class="form-group">
										<label class="col-md-2">Image:</label>
										<div class="col-md-4">
								<?php 
										if($Questions[$i]->Image)	
										{
								?>
											<img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image; ?>" width="100" height="100" id="ExistingImgDesc<?php echo $no; ?>">
											<input type="hidden" value="<?php echo $Questions[$i]->Image; ?>" name="ExistingImgDesc<?php echo $no; ?>">
								<?php
										}
								?>
											<img width="100" height="100" id="ImageDesc<?php echo $no; ?>" style="display:none;">
											<input type="file" name="ImgDesc<?php echo $no; ?>" onchange="ValidateFiles(this); ShowImg(this,<?php echo $no; ?>);" id="ImgDesc<?php echo $no; ?>">
										</div>
									    </div>
									    <div class="form-group">
										<label class="col-md-2">Reference Document:</label>
										<div class="col-md-3">
										    <input type="file" id="RefDocDesc<?php echo $no; ?>" onchange="DisablePageNo(<?php echo $no; ?>)" name="RefDocDesc<?php echo $no; ?>" disabled>
										</div>
										<label class="col-md-1">OR</label>
										<label class="col-md-2">Page No:</label>
										<div class="col-md-2">
										    <input type="text" id="RefDocDescPageNo<?php echo $no; ?>" onkeypress="return isNumberKey(event)" class="form-control" onfocus="DisableRefDoc(<?php echo $no; ?>)" name="RefDocDescPageNo<?php echo $no; ?>" <?php if($Questions[$i]->RefDocPageNo=='0'){ ?>value="" <?php  }else{ ?> value="<?php echo html_escape($Questions[$i]->RefDocPageNo); ?>" <?php }?> disabled>
										</div>
										</div>
										<div class="form-group">
										    <label class="col-md-2">Marks:</label>
										    <div class="col-md-3">
										        <input type="text" class="form-control" onkeypress="return isNumberKey(event)" name="MarksDesc<?php echo $no; ?>" id="MarksDesc-<?php echo $no; ?>" onblur="AddNewQuesMarks(this);"  value="<?php echo $Questions[$i]->Marks; ?>" oninput="Data(<?php echo $no; ?>)">
										    </div>
										    <label class="col-md-2">Negative Marks:</label>
										    <div class="col-md-3">
										        <input type="text" class="form-control" onkeypress="return onlyNumbersWithdash(event,this);" name="NegMarksDesc<?php echo $no; ?>" id="NegMarksDesc<?php echo $no; ?>" value="<?php echo $Questions[$i]->Negative_marks; ?>" oninput="Data(<?php echo $no; ?>)">
										        </div>
									</div>
									<div class="form-group">
										<label class="col-md-2">Answer:</label>		
								<?php
									foreach($Answers as $a)
									{
									
										if($Questions[$i]->QuestionID==$a->QuestionID)
										{		
								?>
										<div class="col-md-8">
										<input type="hidden" name="DescAnsID<?php echo $no; ?>" value="<?php echo $a->AnswerID; ?>">
										<textarea class="form-control" onkeyup="javascript:capitalize(this.id, this.value);" name="AnsDesc<?php echo $no; ?>" id="AnsDesc<?php echo $no; ?>" oninput="Data(<?php echo $no; ?>)"><?php echo html_escape($a->Answer); ?></textarea></div>
								<?php
										}
									}
								?>
								
										
										<div class="col-md-2"></div>
									</div>
								</div>
								</div>
								<?php
								}
								if($Questions[$i]->QueType=='Fill in the blanks')
								{
									$FillQueCount++;
								
									array_push($array,$no);
									$fillans=explode('_____',$Questions[$i]->Question); 
					
						?>
									<div class="container" id="Fill_Form<?php echo $no; ?>" style="margin-bottom:20px;border:0.5px solid lightgray;padding:10px 0px;width:100%;" class="mm">
									<input type="hidden" id="QueType3" name="FillQueType<?php echo $no; ?>" value="<?php echo $Questions[$i]->QueType ?>">
									<input type="hidden" name="FillQueID<?php echo $no; ?>" value="<?php echo $Questions[$i]->QuestionID ?>">
									<span class="cls" style="margin-bottom:10px !important;" onclick="DeleteDraftedQuestion(this)" title="close">X</span>
									<div class="col-md-12" id="FillQ<?php echo $no; ?>" style="display:flow-root">
									<div class="form-group">
										<label class="col-md-2">Question:</label>
										<div class="col-md-4">
											<input type="text" onkeyup="javascript:capitalize(this.id, this.value);" name="QueFill1<?php echo $no; ?>" value="<?php echo html_escape($fillans[0]); ?>" class="form-control" id="QueFill1<?php echo $no; ?>" oninput="Data(<?php echo $no; ?>)">
											</div>
											<label class="col-md-2">_ _ _ _ _ _ _ _ _</label>
										<div class="col-md-4">
										<input type="text" name="QueFill2<?php echo $no; ?>" value="<?php echo html_escape($fillans[1]); ?>" class="form-control fill" id="QueFill2<?php echo $no; ?>" oninput="Data(<?php echo $no; ?>)">
										</div>
										<div class="col-md-2"></div>
									</div>
									<div class="form-group">
										<label class="col-md-2">Image:</label>
										<div class="col-md-4">
								<?php 
										if($Questions[$i]->Image)	
										{
								?>
											<img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image; ?>" width="100" height="100" id="ExistingImgFill<?php echo $no; ?>">
											<input type="hidden" value="<?php echo $Questions[$i]->Image; ?>" name="ExistingImgFill<?php echo $no; ?>">
								<?php
										}
								?>
											<img width="100" height="100" id="ImageFill<?php echo $no; ?>" style="display:none;">
											<input type="file" name="ImgFill<?php echo $no; ?>" onchange="ValidateFiles(this); ShowImg(this,<?php echo $no; ?>);" id="ImgFill<?php echo $no; ?>">
										</div>
										</div>
										<div class="form-group">
										<label class="col-md-2">Reference Document:</label>
										<div class="col-md-3">
										    <input type="file" id="RefDocFill<?php echo $no; ?>" onchange="DisablePageNo(<?php echo $no; ?>)" name="RefDocFill<?php echo $no; ?>" disabled>
									    </div>
									    <label class="col-md-1">OR</label>
									    <label class="col-md-2">Page No:</label>
									    <div class="col-md-2">
										    <input type="text" id="RefDocFillPageNo<?php echo $no; ?>" onkeypress="return isNumberKey(event)" onfocus="DisableRefDoc(<?php echo $no; ?>)" class="form-control" name="RefDocFillPageNo<?php echo $no; ?>" <?php if($Questions[$i]->RefDocPageNo=='0'){ ?>value="" <?php  }else{ ?> value="<?php echo html_escape($Questions[$i]->RefDocPageNo); ?>" <?php }?> disabled>
									    </div>
									    </div>
									    <div class="form-group">
									        <label class="col-md-2">Marks:</label>
										    <div class="col-md-3">
										        <input type="text" class="form-control" onkeypress="return isNumberKey(event)" name="MarksFill<?php echo $no; ?>" id="MarksFill-<?php echo $no; ?>" onblur="AddNewQuesMarks(this);" value="<?php echo $Questions[$i]->Marks; ?>" oninput="Data(<?php echo $no; ?>)">
										    </div>
										    <label class="col-md-2">Negative Marks:</label>
									    	<div class="col-md-3">
									    	    <input type="text" class="form-control" onkeypress="return onlyNumbersWithdash(event,this);" name="NegMarksFill<?php echo $no; ?>" value="<?php echo $Questions[$i]->Negative_marks; ?>" id="NegMarksFill<?php echo $no; ?>" oninput="Data(<?php echo $no; ?>)">
									    	</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
										<input type="button" value="Add Answers" id="btnFill<?php echo $no; ?>" onclick="AddNewAnsFill(<?php echo $no; ?>)"/>
										</div>
									</div>
									<div class ="col-md-offset-10 col-md-2">
										<label>Correct Answer:</label>
									</div>
									<?php
								
									foreach($Answers as $a)
									{
									    if($Questions[$i]->QuestionID!=$a->QuestionID)
										{
										    $ansfill=0;
										}
									
										if($Questions[$i]->QuestionID==$a->QuestionID)
										{
										$ansfill=$ansfill+1;
								?>
										<div class="form-group" id="Fill-<?php echo $no; ?>">
										<label class="col-md-2" id="Anslabel-<?php echo $ansfill; ?>">Answer&nbsp;<?php echo $ansfill; ?>:</label>
										<input type="hidden" name="FillAnsID<?php echo $no; ?>[]" value="<?php echo $a->AnswerID; ?>">
										<div class="col-md-8">
											<input type="text" onkeyup="javascript:capitalize(this.id, this.value);" id="txtAnsFill<?php echo $no; ?>-<?php echo $ansfill; ?>" name="txtAnsFill<?php echo $no; ?>[]" class="form-control" value="<?php echo html_escape($a->Answer); ?>" oninput="FillExecAns(<?php echo $no; ?>,<?php echo $ansfill; ?>)">
										</div>
										<?php
										$found=false;
										
										for($j=0;$j<count($AdminCorrectAns);$j++)
										{
											if($a->AnswerID==$AdminCorrectAns[$j]->AnswerID)
											{
				?>	
											<div class="col-md-2">
												<input type="checkbox" id="ChkAnsFill<?php echo $no; ?>" checked onchange="AnsCheckedFillDB(this,<?php echo $no; ?>); CheckedAns(this,<?php echo $no; ?>);" class="chkfill<?php echo $no; ?>">
											<input type="hidden" name="ChkAnsFill<?php echo $no; ?>[]" value="1"></div>
											
				<?php
												$found=true;
											}
													
										}
										if($found==false)
										{
				?>
											<div class="col-md-2">
												<input type="checkbox" id="ChkAnsFill<?php echo $no; ?>" onchange="AnsCheckedFillDB(this,<?php echo $no; ?>,<?php echo $ansfill; ?>); CheckedAns(this,<?php echo $no; ?>);" class="chkfill<?php echo $no; ?>">
												<input type="hidden" name="ChkAnsFill<?php echo $no; ?>[]" value="0">
											</div>
											
								<?php
										}
					
								?>

										</div>
								<?php
										}	
									}
								?>
									</div>
									</div>
									<?php
								}
								if($Questions[$i]->QueType=='True false')
								{
									$TFQueCount++;
								
									array_push($array,$no);
						?>
									<div class="container" id="Tf_Form<?php echo $no; ?>" style="margin-bottom:20px;border:0.5px solid lightgray;padding:10px 0px;width:100%;" class="mm">
									<input type="hidden" id="QueType4" name="TFQueType<?php echo $no; ?>" value="<?php echo $Questions[$i]->QueType ?>">
									<input type="hidden" name="TFQueID<?php echo $no; ?>" value="<?php echo $Questions[$i]->QuestionID ?>">
									<span class="cls"  onclick="DeleteDraftedQuestion(this)" title="close">X</span>
									<div class="col-md-12" id="TfQ<?php echo $no; ?>" style="display:flow-root">
									<div class="form-group">
										<label class="col-md-2">Question:</label>
										<div class="col-md-8"><input type="text" onkeyup="javascript:capitalize(this.id, this.value);" name="QueTF<?php echo $no; ?>" value="<?php echo html_escape($Questions[$i]->Question); ?>" class="form-control" id="QueTF<?php echo $no; ?>" oninput="Data(<?php echo $no; ?>);">
										</div>
										<div class="col-md-2"></div>
									</div>
									<div class="form-group">
										<label class="col-md-2">Image:</label>
										<div class="col-md-4">
									<?php 
										if($Questions[$i]->Image)	
										{
								?>
											<img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image; ?>" width="100" height="100" id="ExistingImgTF<?php echo $no; ?>">
											<input type="hidden" name="ExistingImgTF<?php echo $no; ?>" value="<?php echo $Questions[$i]->Image; ?>">
									<?php
										}
									?>
											<img width="100" height="100" id="ImageTF<?php echo $no; ?>" style="display:none;">
											<input type="file" name="ImgTF<?php echo $no; ?>" onchange="ValidateFiles(this); ShowImg(this,<?php echo $no; ?>);" id="ImgTF<?php echo $no; ?>">
										</div>
										</div>
										<div class="form-group">
										<label class="col-md-2">Reference Document:</label>
										<div class="col-md-3">
										    <input type="file" id="RefDocTF<?php echo $no; ?>" onchange="DisablePageNo(<?php echo $no; ?>)" name="RefDocTF<?php echo $no; ?>" disabled>
										</div>
										<label class="col-md-1">OR</label>
										<label class="col-md-2">Page No:</label>
										<div class="col-md-2">
										    <input type="text" id="RefDocTFPageNo<?php echo $no; ?>" onkeypress="return isNumberKey(event)" onfocus="DisableRefDoc(<?php echo $no; ?>)" class="form-control" name="RefDocTFPageNo<?php echo $no; ?>" <?php if($Questions[$i]->RefDocPageNo=='0'){ ?>value="" <?php  }else{ ?> value="<?php echo html_escape($Questions[$i]->RefDocPageNo); ?>" <?php }?> disabled>
										</div>
										</div>
										<div class="form-group">
										    <label class="col-md-2">Marks:</label>
										    <div class="col-md-3">
										        <input type="text" class="form-control" onkeypress="return isNumberKey(event)" name="MarksTF<?php echo $no; ?>" id="MarksTF-<?php echo $no; ?>" onblur="AddNewQuesMarks(this);" value="<?php echo $Questions[$i]->Marks; ?>" oninput="Data(<?php echo $no; ?>);">
										    </div>
										    <label class="col-md-2">Negative Marks:</label>
									    	<div class="col-md-3">
									    	    <input type="text" class="form-control" onkeypress="return onlyNumbersWithdash(event,this);" name="NegMarksTF<?php echo $no; ?>" id="NegMarksTF<?php echo $no; ?>" value="<?php echo $Questions[$i]->Negative_marks; ?>">
									    	</div>
									</div>
									<div class="form-group">
										<label class="col-md-2">Answers:</label>	
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
													<input type="radio" checked="checked" name="TFAns<?php echo $no ?>" value="<?php echo $a->Answer; ?>" id="TFAns<?php echo $no ?>" onchange="TrueFalseAnsCheck(this,<?php echo $no; ?>)">&nbsp;<?php echo $a->Answer; ?>
													
													<input type="hidden" name="TrueAnsID<?php echo $no; ?>" value="<?php echo $a->AnswerID; ?>">
									<?php
													$found=true;
													}
															
												}
												if($found==false)
												{
									?>	
													<input type="radio" name="TFAns<?php echo $no ?>" value="<?php echo $a->Answer; ?>" onchange="TrueFalseAnsCheck(this,<?php echo $no; ?>)">&nbsp;<?php echo $a->Answer; ?>
													<input type="hidden" name="FalseAnsID<?php echo $no; ?>" value="<?php echo $a->AnswerID; ?>">
													
									<?php	
												}
											}	
										}
							
				?>


									</div>
								</div>
								</div>
								
							<?php
								}
							
							}}
						?>
		
							</div>
						<?php
					        if(empty($array)){}
					        else{
						        $finalstring=implode(",",$array);
					        }
						?>
							  <div style="width:100%;display:none;" id="Createddrafted">	
							<?php
								$no=0;
								for($i=0;$i<count($Questions);$i++)
								{
									$no++;	
							?>	
									<input type="hidden" name="QuePaperID" value="<?php echo $Questions[$i]->QuePaperID ?>">		
									
							<?php
									if($Questions[$i]->QueType=='Multiple choice questions')
									{
							?>
									<div class="container" id="Multiple_created<?php echo $no; ?>" style="margin-bottom:20px;background-color:#F8F8F8;border:0.5px solid lightgray;padding:20px 0px;width:100%;">
								<div class="col-md-12" id="CreatedMultipleQ<?php echo $no; ?>">		
									<div class="form-group">
										<label class="col-md-2">Question:</label>
										<div class="col-md-8"><b><p class="wrap" id="MultiQue<?php echo $no; ?>"><?php echo $Questions[$i]->Question; ?></p></b>
										</div>
										<div class="col-md-2"></div>
									</div>
									<div class="form-group">
										<label class="col-md-2">Image:</label>
										<div class="col-md-4">
								<?php 
										if($Questions[$i]->Image)	
										{
								?>
											<img  src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image; ?>" width="100" height="100" id="CreatedImgMulti<?php echo $no; ?>">
								<?php
										}
										else
										{
								?>
											<b><img id="CreatedImgMulti<?php echo $no; ?>" alt="no image available"></b>
								<?php
										}
								?>
										</div>
										<div class="col-md-3"><label>Marks:</label>&nbsp;&nbsp;
											<b><span id="MultiMarks<?php echo $no; ?>"><?php echo $Questions[$i]->Marks; ?></span></b>
										</div>
										<div class="col-md-3"><label>Negative Marks:</label>&nbsp;&nbsp;
											<b></M><span id="MultiNegMarks<?php echo $no; ?>"><?php echo $Questions[$i]->Negative_marks; ?></span></b>
										</div>
									</div>
									
									<div class="form-group" id="Multiple-<?php echo $no; ?>">
										<div class="col-md-2">
											<label>Answers:</label>
										</div>
								<div class="col-md-8 ExecAllMuitipleAns">
								<?php
								$ans=0;
									foreach($Answers as $a)
									{
									    if($Questions[$i]->QuestionID!=$a->QuestionID)
										{
										    $ans=1;
										}
									
										if($Questions[$i]->QuestionID==$a->QuestionID)
										{
										$ans=$ans+1;
								?>
										
											
												<b><p class="wrap" id="AnsMulti<?php echo $no; ?>-<?php echo $ans; ?>"><?php echo $a->Answer; ?></p></b>
											
										
								<?php
										}	
									}
								?></div>
									</div>
								</div></div>
								<?php
								}
								if($Questions[$i]->QueType=='Descriptive questions')
								{
								?>
								<div class="container" id="Desc_created<?php echo $no; ?>" style="margin-bottom:20px;background-color:#F8F8F8;padding:20px 0px;width:100%;border:0.5px solid lightgray;" class="mm">
								<div class="col-md-12" id="CreatedDescriptiveQ<?php echo $no; ?>">
									<div class="form-group">
										<label class="col-md-2">Question:</label>
										<div class="col-md-8">
										<b><p class="wrap" id="DescQue<?php echo $no; ?>">
												<?php echo $Questions[$i]->Question; ?></p></b>
										</div>
										<div class="col-md-2"></div>
									</div>
									<div class="form-group">
										<label class="col-md-2">Image:</label>
										<div class="col-md-4">
								<?php 
										if($Questions[$i]->Image)	
										{
								?>
											<img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image; ?>" width="100" height="100" id="CreatedImageDesc<?php echo $no; ?>">
								<?php
										}
										else
										{
								?>
											<b><img id="CreatedImageDesc<?php echo $no; ?>" alt="no image available"></b>

								<?php
										}
								?>
										</div>
										<div class="col-md-3">
											<label>Marks:</label>&nbsp;&nbsp;
											<b><span id="DescMarks<?php echo $no; ?>"><?php echo $Questions[$i]->Marks; ?></span></b>
										</div>
										<div class="col-md-3">
											<label>Negative Marks:</label>&nbsp;&nbsp;
											<b><span id="DescNegMarks<?php echo $no; ?>"><?php echo $Questions[$i]->Negative_marks; ?></span></b>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2">Answer:</label>		
								<?php
									foreach($Answers as $a)
									{
									
										if($Questions[$i]->QuestionID==$a->QuestionID)
										{		
								?>
										<div class="col-md-8">
										<b><p class="wrap" id="DescAns<?php echo $no; ?>"><?php echo $a->Answer; ?></p></b>
										</div>
								<?php
										}
									}
								?>
								
										
										<div class="col-md-2"></div>
									</div>
								</div>
								</div>
							<?php
								}
								if($Questions[$i]->QueType=='Fill in the blanks')
								{
									$fillans=explode('_____',$Questions[$i]->Question); 
					
							?>
								<div class="container" id="Fill_created<?php echo $no; ?>" style="margin-bottom:20px;background-color:#F8F8F8;padding:20px 0px;width:100%;border:0.5px solid lightgray;" class="mm">
									<div class="col-md-12" id="CreatedFillQ<?php echo $no; ?>">
									<div class="form-group">
										<label class="col-md-2">Question:</label>
										<div class="col-md-8">
											<b><span class="wrap" id="FillQue1<?php echo $no; ?>"><?php echo $fillans[0] ?></span></b>
											&nbsp;<span>_____</span>&nbsp;
											<b><span class="wrap" id="FillQue2<?php echo $no; ?>"><?php echo $fillans[1] ?></span></b>	
										</div>
										<div class="col-md-2"></div>
									</div>
									<div class="form-group">
										<label class="col-md-2">Image:</label>
										<div class="col-md-4">
								<?php 
										if($Questions[$i]->Image)	
										{
								?>
											<img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image; ?>" width="100" height="100" id="CreatedImageFill<?php echo $no; ?>">
								<?php
										}
										else
										{
								?>
											<b><img id="CreatedImageFill<?php echo $no; ?>" alt="no image available"></b>
								<?php
										}
								?>
										</div>
										<div class="col-md-3">
											<label>Marks:</label>&nbsp;&nbsp;
											<b><span id="FillMarks<?php echo $no; ?>"><?php echo $Questions[$i]->Marks; ?></span></b>
										</div>
										<div class="col-md-3">
											<label>Negative Marks:</label>&nbsp;&nbsp;
											<b><span id="FillNegMarks<?php echo $no; ?>">
												<?php echo $Questions[$i]->Negative_marks; ?>
											</span></b>
										</div>
									</div>
									
									<div class="form-group" id="Fill-<?php echo $no; ?>">
										<div class ="col-md-2">
											<label>Answers:</label>
										</div>
									<div class="col-md-8 ExecAllFillAns">
									<?php
								$ansfill=0;
									foreach($Answers as $a)
									{
									
										if($Questions[$i]->QuestionID==$a->QuestionID)
										{
										$ansfill=$ansfill+1;
								?>
										
											
												<b><p class="wrap" id="FillAns<?php echo $no; ?>-<?php echo $ansfill; ?>">
												<?php echo $a->Answer; ?></p></b>
											
									
								<?php
										}	
									}
								?>
									</div>
									</div></div>
									</div>
						<?php
								}
								if($Questions[$i]->QueType=='True false')
								{
						?>
								<div class="container" id="Tf_created<?php echo $no; ?>" style="margin-bottom:20px;background-color:#F8F8F8;padding:20px 0px;width:100%;border:0.5px solid lightgray;" class="mm">
									<div class="col-md-12" id="CreatedTfQ<?php echo $no; ?>">
										<div class="form-group">
											<label class="col-md-2">Question:</label>
											<div class="col-md-8">
												<b><p class="wrap" id="TFQue<?php echo $no; ?>">
												<?php echo $Questions[$i]->Question; ?></p></b>
											</div>
											<div class="col-md-2"></div>
										</div>
										<div class="form-group">
										<label class="col-md-2">Image:</label>
										<div class="col-md-4">
									<?php 
										if($Questions[$i]->Image)	
										{
								?>
											<img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image; ?>" width="100" height="100" id="CreatedImageTF<?php echo $no; ?>">
									<?php
										}
										else
										{
									?>
											<b><img id="CreatedImageTF<?php echo $no; ?>" alt="no image available"></b>
									<?php
										}
									?>
										</div>
										<div class="col-md-3">
											<label>Marks:</label>&nbsp;&nbsp;
											<b><span class="wrap" id="TFMarks<?php echo $no; ?>">
												<?php echo $Questions[$i]->Marks; ?>
											</span></b>
										</div>
										<div class="col-md-3">
											<label>Negative Marks:</label>&nbsp;&nbsp;
											<b><span class="wrap" id="TFNegMarks<?php echo $no; ?>">
												<?php echo $Questions[$i]->Negative_marks; ?>
											</span></b>
										</div>
									</div>
									<div class="form-group">
											<label class="col-md-2">Answer:</label>
											<div class="col-md-8">
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
													<b><span id="AnsTF<?php echo $no; ?>">
														<?php echo $a->Answer; ?>
													</span></b>
									<?php
													}
												}
											}
										}
									?>
									    </div>
										</div>
									</div>
								</div>
						<?php
								}
							
							}
						?>
							</div>
						</div>		
					</div>						
				</div>
				<?php
				if(empty($Questions)) 
				    {
				        
				    }
				    else
				    {
				?>
				    
				<input type="hidden" id="TotalCount" name="countt" value="<?php echo $finalstring;?>"> 
				<input type="hidden" id="MultiQueCount" value="<?php echo $MultiQueCount?>"> 
				<input type="hidden" id="DescQueCount" value="<?php echo $DescQueCount?>"> 
				<input type="hidden" id="FillQueCount" value="<?php echo $FillQueCount;?>">
				<input type="hidden" id="TFQueCount" value="<?php echo $TFQueCount;?>"> 
				<input type="hidden" id="NewMultiAnsCount" value="1"> 
				<input type="hidden" id="NewFillAnsCount" value="1"> 
				<input type="hidden" name="hdn1" class="counter">
				<input type="hidden" id="DeletedQues" name="DeletedQues">
				<?php
				    }
			    ?>
				<div class="col-lg-12" style="padding-bottom:2%;padding-top:2%;">
				
					<input type="button" id="submitbtn" class="btn btnhover" name="save" value="Submit" style="color:white;float:right;margin-right:35px;width:200px;background-color:#0071BC;font-weight:bold;display:none;" onclick="ValidateDraftedPaperSubmit()">
					<input type="button" id="edit" class="btn btnhover" value="Create" style="color:white;float:right;margin-right:35px;width:200px;background-color:#0071BC;font-weight:bold;" onclick="ValidateDraftedPaper();">
					
				</div>
				
			</form>

	</body>
</html>
