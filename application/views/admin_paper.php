<!DOCTYPE html>
<html>
	<head>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url() ?>/assets/css/QuestionPaper.css" rel="stylesheet">
		<link href="<?php echo base_url() ?>/assets/css/QuestionPaper.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
		
	    <title>QUESTION & ANSWER</title>
        <link rel="icon" type="image/ico" href="<?php echo base_url() ?>/assets/images/logo.png" width="800px;" />
		
		<style>
		    .btnhover:hover
			{
	            background-color:#23527c !important;		    
			}
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
	
	      /*  @media screen and (min-width:992px)  {
	       .queno
		    {
		        width:8.33333333% !important;
		    }
		    .que
		    {
		        width:75% !important;
		    } 
	        }*/
	
		</style>
		<script>
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
		<form method="post" action="<?php echo site_url() ?>/Questions/SaveQuestionPaperData">
		<div class="container" style="margin-top:10px;background-color:#F8F8F8;padding:2%;">
			<div class="row">
				
				<center><label style="font-size:28px;" class="wrap"><?php echo $que_paper['que_paper_name']; ?></label></center>
				<input type="hidden" name="QuePaperName" value="<?php echo $que_paper['que_paper_name']; ?>">	
				
				<label style="margin-left:1.5%;">Date:&nbsp;&nbsp;<?php $originalDate =$que_paper['date'];
echo $newDate = date("d-m-Y", strtotime($originalDate)); ?></label><br>
				<input type="hidden" name="QuePaperDate" value="<?php echo $que_paper['date']; ?>">

				<label style="margin-left:1.5%;">Total Marks:&nbsp;&nbsp;<?php echo $que_paper['total_marks']; ?></label>
				<input type="hidden" name="QPTotalMarks" value="<?php echo $que_paper['total_marks']; ?>">
				
				<input type="hidden" name="TestType" value="<?php echo $que_paper['TestType']; ?>">
				<input type="hidden" name="RefDoc" value="<?php echo $que_paper['RefDoc']; ?>">
				<input type="hidden" name="PassingPercentage" value="<?php echo $que_paper['PassingPercentage']; ?>">
				
				<?php
				        $arr =implode(",",$que_paper['ExamCoordinators']);
				?>
		        	    <input type="hidden" name="ExamCoordinators" value="<?php echo $arr ?>">
			
			</div><hr style="border-top: 1px solid #4D4D4D">
		</div>
		
		<div class="container" style="background-color:#F8F8F8;padding:0px 3%;">
		    <div class="col-xs-12 col-sm-12 col-sm-12 col-lg-12">
		<?php
		  $count=0; 
		  $no=1;
		  //  print_r($Data);
		    for($i=0;$i<count($Data);$i++)
		    {
		          $count++;
		        if($Data[$i]['que_multi']==null){}
		        else
		        {
		  ?>
		            <div style="float:left;width:100%;margin-bottom:10px;">
		              <div class="row">
		                <div class="col-md-1 col-sm-1 col-lg-1 col-xs-1">
		                        <label style="font-size:20px;">Q<?php echo $no; ?>.</label>
		                </div>
		                <div class="col-md-9 col-sm-9 col-xs-9 col-lg-9" style="padding-left:0px;">
		                        <label class="wrap" style="font-size:20px;"><?php print_r($Data[$i]['que_multi']); ?></label>
		                        <input type="hidden" name="MultiQue<?php echo $count; ?>" value="<?php print_r(html_escape($Data[$i]['que_multi'])); ?>">
		                </div>
		                <div class="col-md-2 col-sm-2 col-lg-2 col-xs-2">
		                        <label style="font-size:20px;">Marks: <?php print_r($Data[$i]['marks_multi']);?></label>
		                        
		                        <input type="hidden" name="MultiMarks<?php echo $count; ?>" value="<?php print_r($Data[$i]['marks_multi']);?>">
					        	<input type="hidden" name="MultiNegMarks<?php echo $count; ?>" value="<?php print_r($Data[$i]['neg_marks_multi']);?>">
		                </div>
		                        <input type="hidden" name="MultiRefDoc<?php echo $count; ?>" value="<?php print_r($Data[$i]['MultiRefDoc']);?>">
		                        <input type="hidden" name="MultiRefPageNo<?php echo $count; ?>" value="<?php print_r($Data[$i]['MultiRefPageNo']);?>">
		            </div>
		 <?php
		               if($Data[$i]['file_multi']!=null) 
		               {
		 ?>
		            <div class="row">
					    <div class="col-md-1 col-sm-1 col-lg-1 col-xs-1"></div>
					     <div class="col-md-8 col-xs-8 col-sm-8 col-lg-8" style="padding-left:0px;">
				            	<a id="fbox" class="fancybox" href="#Multi"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Data[$i]['file_multi'];?>" width="150" height="150"></a>
					            <input type="hidden" name="MultiImg<?php echo $count; ?>" value="<?php echo $Data[$i]['file_multi'];?>">	
					            
					            <div id="Multi" style="display:none;width:600px;height:500px;">
                                          <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Data[$i]['file_multi'];?>" width="500" height="500">
                                    </div>
					    </div>
					</div><br>
		<?php
		               }
		?>
		            <div class="row">
					        <div class="col-md-1 col-lg-1 col-xs-1 col-sm-1" style="font-size:20px;"><label>Ans:</label><br></div> 
					        <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
					            
					                    
					                <?php
					
						
						for($i1=0;$i1<count($Data[$i]['txtAnsMulti']);$i1++)
						{
							
							if($Data[$i]['ChkAnsMulti'][$i1] =='1')
							{	
		?>	
								<input type="checkbox" style="font-size:20px;" disabled checked value="<?php echo html_escape($Data[$i]['txtAnsMulti'][$i1]); ?>" name="CorrectMultiAns<?php echo $count; ?>[]">&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"> <?php echo html_escape($Data[$i]['txtAnsMulti'][$i1]); ?></span><br>
							    <input type="hidden" value="<?php echo html_escape($Data[$i]['txtAnsMulti'][$i1]); ?>" name="CorrectMultiAns<?php echo $count; ?>[]">
								<input type="hidden" value="<?php echo html_escape($Data[$i]['txtAnsMulti'][$i1]); ?>" name="MultiAns<?php echo $count; ?>[]">						
								
		<?php				
							}
							else
							{	
		?>
								<input type="checkbox" disabled>&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"> <?php echo html_escape($Data[$i]['txtAnsMulti'][$i1]); ?></span><br>	
								<input type="hidden" value="<?php echo html_escape($Data[$i]['txtAnsMulti'][$i1]); ?>" name="MultiAns<?php echo $count; ?>[]">						
		<?php	
							}
					
						}
				
						
		?>
					        </div>
					</div>      
		            </div>
		<?php
		            $no++;
		        }
		        if($Data[$i]['que_desc']==null){}
		        else
		        {
		?> 
		             <div style="float:left;width:100%;margin-bottom:10px;">   
		                 <div class="row">
						<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
		                     <label style="font-size:20px;">Q<?php echo $no; ?>.</label>
		                </div>
		                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="padding-left:0px;">
							<label style="font-size:20px;" class="wrap"><?php echo html_escape($Data[$i]['que_desc']); ?></label>
							<input type="hidden" name="DescQue<?php echo $count; ?>" value="<?php echo html_escape($Data[$i]['que_desc']); ?>">
						</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<label style="font-size:20px;">Marks: <?php echo $Data[$i]['marks_desc'];?></label>
							<input type="hidden" name="DescMarks<?php echo $count; ?>" value="<?php echo $Data[$i]['marks_desc'];?>">
							<input type="hidden" name="DescNegMarks<?php echo $count; ?>" value="<?php echo $Data[$i]['neg_marks_desc'];?>">
						</div>
						    <input type="hidden" name="DescRefDoc<?php echo $count; ?>" value="<?php print_r($Data[$i]['DescRefDoc']);?>">
						    <input type="hidden" name="DescRefPageNo<?php echo $count; ?>" value="<?php print_r($Data[$i]['DescRefPageNo']);?>">
					</div>
		<?php
		               if($Data[$i]['file_desc']!=null) 
		               {
		 ?>
		               <div class="row">
					    <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1"></div>
					     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0px;">
							<a id="fbox" class="fancybox" href="#Desc"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Data[$i]['file_desc'];?>" width="150" height="150"></a>	
							<input type="hidden" name="DescImg<?php echo $count; ?>" value="<?php echo $Data[$i]['file_desc'];?>">	
							
							 <div id="Desc" style="display:none;width:600px;height:500px;">
                                          <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Data[$i]['file_desc'];?>" width="500" height="500">
                                    </div>
						</div>	
						</div><br>
		 <?php
		               }
		 ?>
						<div class="row">
					        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1" style="font-size:20px;"><label>Ans:</label></div> 
					        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							<span style="font-size:20px;" class="wrap"><?php echo html_escape($Data[$i]['ans_desc']); ?></span>
							<input type="hidden" name="DescAns<?php echo $count; ?>" value="<?php echo html_escape($Data[$i]['ans_desc']) ?>">
					    	</div>
					    </div><br>
		   
		
		            </div>
		<?php         
		        $no++;
		        }
		        if($Data[$i]['que_fill']==null){}
		        else
		        {
		?>
		             <div style="float:left;width:100%;margin-bottom:10px;">   
		                    <div class="row">
					        	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><label style="font-size:20px;">Q<?php echo $no; ?>.</label></div>
					        	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="padding-left:0px;">
					       		<label style="font-size:20px;" class="wrap"><?php echo html_escape($Data[$i]['que_fill']); ?></label>
						    	<input type="hidden" name="FillQue<?php echo $count; ?>" value="<?php echo html_escape($Data[$i]['que_fill']); ?>">
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<label style="font-size:20px;">Marks: <?php echo $Data[$i]['marks_fill'];?></label>
							<input type="hidden" name="FillMarks<?php echo $count; ?>" value="<?php echo $Data[$i]['marks_fill']; ?>">
							<input type="hidden" name="FillNegMarks<?php echo $count; ?>" value="<?php echo $Data[$i]['neg_marks_fill']; ?>">
							
						</div>
						       <input type="hidden" name="FillRefDoc<?php echo $count; ?>" value="<?php print_r($Data[$i]['FillRefDoc']);?>">
						       <input type="hidden" name="FillRefPageNo<?php echo $count; ?>" value="<?php print_r($Data[$i]['FillRefPageNo']);?>">
				        </div>
		<?php
		                if($Data[$i]['file_fill']!=null) 
		               {
		?>
				        <div class="row">
					    <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1"></div>
					     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0px;">
							<a id="fbox" class="fancybox" href="#Fill"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Data[$i]['file_fill'];?>" width="150" height="150"></a>
							<input type="hidden" name="FillImg<?php echo $count; ?>" value="<?php echo $Data[$i]['file_fill'];?>">	
							
							<div id="Fill" style="display:none;width:600px;height:500px;">
                                          <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Data[$i]['file_fill'];?>" width="500" height="500">
                                    </div>
						</div>
						</div><br>
						
		<?php
		               }
		?>
	                    <div class="row">
					        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1" style="font-size:20px;"><label>Ans:</label></div> 
					        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<?php
						for($a1=0;$a1<count($Data[$i]['txtAnsFill']);$a1++)
						{
							
							if($Data[$i]['ChkAnsFill'][$a1]=='1')
							{	
		?>
								<input type="radio" disabled="disabled" name="FillAnsCorr<?php echo $count; ?>" checked value="<?php echo html_escape($Data[$i]['txtAnsFill'][$a1]); ?>">&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo html_escape($Data[$i]['txtAnsFill'][$a1]); ?></span><br>
								<input type="hidden" name="FillAnsCorr<?php echo $count; ?>" value="<?php echo html_escape($Data[$i]['txtAnsFill'][$a1]); ?>">
								<input type="hidden" name="FillAns<?php echo $count; ?>[]" value="<?php echo html_escape($Data[$i]['txtAnsFill'][$a1]); ?>">
		<?php
							}
							else
							{	
		?>
								<input type="radio" disabled>&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo html_escape($Data[$i]['txtAnsFill'][$a1]); ?></span><br>
								<input type="hidden" name="FillAns<?php echo $count; ?>[]" value="<?php echo html_escape($Data[$i]['txtAnsFill'][$a1]); ?>">
		<?php
							}
						}
						
		?>
						</div></div><br>
	
	                </div>
		<?php
		        $no++;
		        }
		        if($Data[$i]['que_tf']==null){}
		        else
		        {
		 ?>
		            <div style="float:left;width:100%;margin-bottom:10px;">  
		                    <div class="row">
	                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><label style="font-size:20px;">Q<?php echo $no; ?>.</label></div>
					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="padding-left:0px;">
						<label style="font-size:20px;" class="wrap"><?php echo html_escape($Data[$i]['que_tf']); ?></label>
						<input type="hidden" name="TFQue<?php echo $count; ?>" value="<?php echo html_escape($Data[$i]['que_tf']); ?>">
					</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
						<label style="font-size:20px;">Marks: <?php echo $Data[$i]['marks_tf'];?></label>
						<input type="hidden" name="TFMarks<?php echo $count; ?>" value="<?php echo $Data[$i]['marks_tf'];?>">
						<input type="hidden" name="TFNegMarks<?php echo $count; ?>" value="<?php echo $Data[$i]['neg_marks_tf'];?>">
					</div>
					    <input type="hidden" name="TFRefDoc<?php echo $count; ?>" value="<?php print_r($Data[$i]['TFRefDoc']);?>">
					    <input type="hidden" name="TFRefPageNo<?php echo $count; ?>" value="<?php print_r($Data[$i]['TFRefPageNo']);?>">
					</div>
		<?php
		                if($Data[$i]['file_tf']!=null) 
		               {
		?>
					<div class="row">
					    <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1"></div>
					     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0px;">
						<a id="fbox" class="fancybox" href="#TF"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Data[$i]['file_tf'];?>" width="150" height="150"></a>
						<input type="hidden" name="TFImg<?php echo $count; ?>" value="<?php echo $Data[$i]['file_tf'];?>">	
						
						<div id="TF" style="display:none;width:600px;height:500px;">
                            <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Data[$i]['file_tf'];?>" width="500" height="500">
                        </div>
		            </div>
		            </div><br>
		<?php
		               }
		?>
		            <div class="row">
					        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1" style="font-size:20px;"><label>Ans:</label></div> 
					        <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
		<?php
					if($Data[$i]['ans1_tf']=='True')
					{
	?>
						<input type="radio" disabled="disabled" checked name="CorrTAns<?php echo $count; ?>" value="<?php echo $Data[$i]['ans1_chkk'] ?>">&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo html_escape($Data[$i]['ans1_chkk']); ?></span><br>
						<input type="hidden" name="CorrTAns<?php echo $count; ?>" value="<?php echo $Data[$i]['ans1_chkk'] ?>">
						<input type="hidden" name="TrueAns" value="<?php echo $Data[$i]['ans1_chkk'] ?>">
	<?php
					}
					else
					{	
	?>
						<input type="radio" disabled>&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo html_escape($Data[$i]['ans1_chkk']); ?></span><br>
	<?php
					}
					if($Data[$i]['ans2_tf']=='False')
					{
	?>
						<input type="radio" disabled="disabled" checked name="CorrFAns<?php echo $count; ?>" value="<?php echo $Data[$i]['ans2_chkk'] ?>">&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo html_escape($Data[$i]['ans2_chkk']); ?></span><br>
						<input type="hidden" name="CorrFAns<?php echo $count; ?>" value="<?php echo $Data[$i]['ans2_chkk'] ?>">
						<input type="hidden" name="FalseAns" value="<?php echo $Data[$i]['ans2_chkk'] ?>">
	<?php
					}
					else
					{	
	?>
						<input type="radio" disabled>&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo html_escape($Data[$i]['ans2_chkk']) ?></span><br>
	<?php
					}
	?>		
					</div>
					</div>
					
		            </div>
		<?php 
		        $no++;
		        
		        }
		    }
		?>
		</div>
		</div>
		<div class="container" align="center" style="margin-top:20px;margin-bottom:20px;">
				
					<input type="hidden" value="<?php echo $count; ?>" name="count">
					<input type="submit" value="Save" style="background-color:#0071BC;color:white;font-weight:bold;width:200px;" class="btn btn-lg btnhover" name="save">
					<input type="submit" value="Save & Live" style="background-color:#0071BC;color:white;font-weight:bold;width:200px;" class="btn btn-lg btnhover" name="save_and_live">	
				</div>
	
		</form>
	</body>
</html>
