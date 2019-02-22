<!DOCTYPE html>
<html>
	<head>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url() ?>/assets/css/CreateDraftLayout.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/QuestionsTypeCreatePaper.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/CreatePaperValidation.js"></script> 
		<script src="<?php echo base_url() ?>/assets/js/total_marks.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/DeleteCreatedQuestions.js"></script>
		
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
			.marks:hover
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
        		
        	  $(function() {
               $("#datepicker").datepicker({  minDate: new Date(),dateFormat: 'dd-mm-yy'});
        	      $('#datepicker').datepicker('setDate', 'today');
        	       $('#datepicker').datepicker({
                      onClose: function(dateText, inst) {
                       $(this).focus();
                     }
                     });
                    
                    $(document).ready(
                       
                            function()
                            {
                               //  alert('hello');
                              //  $('input').attr('readonly', true);
                            }
                        )
                    // CKEDITOR.replace( 'editor1' );
                     
        	  });
       
            function DuplicatePaperName()
            {
                debugger;
                var PaperName=$('#paper_name').val();
                
                $.ajax({
		    	type: "post",
         		url:"<?php echo site_url()?>Questions/ValidateQuePaperName ", //the page containing php script
           		data: {PaperName:PaperName},
            		success:function(data)
			        {
			            if(data>0)
			            {
			                $('#paper_name').focus();
				
			            	$.alert({
				        	    title: '',
                                 content: 'Same question paper name is already exists!'
                                });
			                $('#paper_name').val('');
			            }
			            
			        },
        	        error:function()
        	        {
        	         	// alert('fail');
        	       	 }
           		
         		});
			        
            }
            
           var expanded = false;

function showCheckboxes() {
    
    $('#checkboxes').toggle();
  
}
    function demo()
    {
        debugger;
    }
 
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
   
   
   <div id="progress_By_JS" class="clsprogressByJS" style="margin-top:20%;" align="center">
                <input type="image" name="image" class="circleimage" src="<?php echo base_url() ?>/assets/images/progress.gif" title="Wait" alt="Wait">
       </div>
    <div class="container" id="mydiv" style="margin:1%;">
          <div class="row">
			       <a href="<?php echo site_url() ?>/Questions/AdminHomePage" class="btn homebtn"><i class="fa fa-home"></i> Home</a>
			</div>
      </div>
 
  <form method="post" class="form-horizontal" enctype="multipart/form-data" id="myform" action="<?php echo site_url()?>Questions/CreatedQuestionPaper">
	<div class="container-fluid" style="background-color:#F0F0F0;padding:1%;" id="headingpart">
	    <div class="row">
	        <center><h4 style="color:#C1272D;"><b><u>CREATE QUESTION PAPER</u></b></h4></center>
	    </div>
		<div class="row">
		    	
			<div class="col-md-6">
			    <table style=" margin-left:4%;font-size:14px;border: none !important;">
					<tr>		
					<td style="width:32%;">Question Paper Name:&nbsp;</td>
						<td><input type="text" style="border:1px solid lightgray;width:58%;" onblur="DuplicatePaperName();" onkeyup="javascript:capitalize(this.id, this.value);" name="paper_name" id="paper_name" autofocus></td>
					</tr>
					<tr>
						<td>Date:</td>
						<td><input type="text" id="datepicker" style="border:1px solid lightgray;width:58%;margin-top:10px;" name="date"></td>
					</tr>
					<tr>
						<td>Total Marks:</td>
						<td><input type="text" style="border:1px solid lightgray;width:58%;margin-top:10px;" id="markssss" onkeypress="return isNumberKey(event)" name="paper_marks" oninput="markssss_total()"></td>
					</tr>	
					<tr>
						<td>Out Of Marks:</td>
						<td><input type="text" style=" width:26%;border:1px solid lightgray;" name="final_marks" id="total" readonly>&nbsp;<span style="font-size:35px;">/</span>&nbsp;<input type="text" style="border:1px solid lightgray;width:27%;" id="total_marksss" placeholder="Total marks" readonly></td>
					</tr>
					<tr>
                        <td>Passing Percentage:</td>
                        <td><input type="text" style="border:1px solid lightgray;width:20%;" onkeypress="return isNumberKey(event);" name="QPaperPercentage" id="QPaperPercentage">&nbsp;&nbsp;<b>%</b></td>
                    </tr>
                    <tr>
                        <td>Exam Coordinator:</td>
                        <td>
                            <div class="multiselect" id="sselect" onblur="demo();">
                                <div class="selectBox" id="list" onclick="showCheckboxes()">
                                  <select style="height:25px;">
                                       <option>Select an option</option>
                                         </select>
                                         <div class="overSelect"></div>
                                </div>
                                <div id="checkboxes" style="height:90px;overflow:auto;z-index:1000;position:absolute;background-color:white;width:100%;padding:2%;">
                            <?php
                                foreach($ExamCoordinator as $e)
                                {
                            ?>
                                     <label><input type="checkbox" name="ExamCoordinators[]" value="<?php echo $e->ExamCoordinatorID; ?>"><?php echo $e->DisplayName; ?></label>
                            <?php
                                }
                            ?>
                                </div>
                            </div>
                             
                             

                        </td>
                    </tr>
					<tr>
                        <td>Test Type:</td>
                        <td>
                            <label class="radio-inline">
                                <input type="radio" id="mock" name="test" value="Mock" onchange="AddReference();">Mock Test
                            </label>
                            <label class="radio-inline">
                                <input type="radio" id="regular" name="test" value="Regular" onchange="RemoveReference();">Regular Test
                            </label>
                             
                        </td>
                    </tr>
                    <tr style="visibility:hidden"><td>a</td><td>a</td></tr>
                    <tr>
                        <td>Reference Document:</td> 
                        <td><input type="file" id="reference" onchange="AddPageNo()" disabled name="RefDoc"></td>
                    </tr>
                    
				</table>
			</div>
			<div class="col-md-6">
				<a class="marks" href="#demo" data-toggle="collapse" style="background-color:#0071BC;color:white;padding:10px;float:right;">Marks Format<span class="caret"></span></a>
				<div id="demo" class="collapse" style="float:right;margin-left:65%">
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
		
				<input type="hidden" name="hdn1" class="counter">
				<input type="hidden" name="hdn2" class="counter2">
				<input type="hidden" name="hdn3" class="counter3">
				<input type="hidden" name="hdn4" class="counter4">
		

				<input type="hidden" id="MultiAnsCount" value="1" name="MultiAnsCount">
				<input type="hidden" id="FillAnsCount" value="1" name="FillAnsCount">				

				<div style="width:100%;margin-top:20px;">
					<div class="col-lg-12">
  						<div class="col-md-3 abcd" id="btnquetype"  style="background-color:#F0F0F0;padding:20px 20px;height:500px;">
							<center><h4>Question Types</h4></center>
				<?php
					
					foreach($QuestionType as $q)
					{
						
				?>
						<input type="button" class="btn btn-block btnhover" style="background-color:#0071BC;color:white;font-weight:bold;margin:20px 0px;" value="<?php echo $q->QueType; ?>" onclick="QuestionTypeClick(this);">
				<input type="hidden" name="quepaper_id" value="<?php echo $q->QueTypeID; ?>" id="qpid">
				<?php	
					}
				?>
  						</div>
						
  						<div class="col-lg-9" style="border:1px solid lightgray;overflow-x:scroll;height:500px;padding-top:20px;">
							<div style="width:100%;" id="NewQuestionPaper">
							    
							</div>
							<div style="width:100%;display:none;" id="CreatedQuestionPaper">

							</div>
						</div>
				</div>		
				</div>
				<div class="col-lg-12" style="padding-bottom:5%;padding-top:2%;">

<input type="button" id="submitbtn" class="btn btnhover" name="save" value="Submit" style="color:white;float:right;margin-right:35px;width:200px;background-color:#0071BC;font-weight:bold;display:none;" onclick="ValidateSubmit();">

<input type="button" id="edit" class="btn btnhover" value="Create" style="color:white;float:right;margin-right:25px;width:200px;background-color:#0071BC;font-weight:bold;" onclick="Validator();">
				</div>
			</form>

		
	</body>
	
</html>
