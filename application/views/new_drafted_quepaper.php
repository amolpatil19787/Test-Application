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
    <link rel="icon" type="image/ico" href="<?php echo base_url() ?>/assets/images/logo.png" />
		
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
		<form method="post" action="<?php echo site_url() ?>/Questions/SaveDraftedQuestionPaperData">
			<div class="container" style="margin-top:10px;background-color:#F8F8F8;padding:3%;">
			    <?php
			        if(empty($PaperInfo))
			        {
			            
			        }
			        else
			        {
			           
			    ?>
				<div class="row">
					<input type="hidden" name="QuePaperID" value="<?php echo $PaperInfo[0]['QuePaperID']; ?>">

					<center><label style="font-size:28px;" class="wrap"><?php echo $PaperInfo[0]['PaperName']; ?></label></center>
					<input type="hidden" name="PaperName" value="<?php echo $PaperInfo[0]['PaperName']; ?>">

					<label style="margin-left:1.5%;">Date:&nbsp;&nbsp;<?php $originalDate =$PaperInfo[0]['Date'];
					echo $newDate = date("d-m-Y", strtotime($originalDate)); ?></label><br>
					<input type="hidden" name="Date" value="<?php echo $PaperInfo[0]['Date']; ?>">

					<label style="margin-left:1.5%;">Total Marks:&nbsp;&nbsp;<?php echo $PaperInfo[0]['PaperMarks']; ?></label>
					<input type="hidden" name="PaperMarks" value="<?php echo $PaperInfo[0]['PaperMarks']; ?>">

                    <input type="hidden" name="TestType" value="<?php echo $PaperInfo[0]['TestType']; ?>">
                    <input type="hidden" name="NewPaperRefDoc" value="<?php echo $PaperInfo[0]['NewPaperRefDoc']; ?>">
                    <input type="hidden" name="DeletedQues" value="<?php echo $PaperInfo[0]['DeletedQues']; ?>">
                    <input type="hidden" name="QPaperPercentage" value="<?php echo $PaperInfo[0]['QPaperPercentage']; ?>">
                   
                    <?php
				        $arr =implode(",",$PaperInfo[0]['ExamCoordinators']);
			    	?>
			    	    <input type="hidden" name="ExamCoordinators" value="<?php echo $arr ?>">
				</div>
				<?php
			        }
				?><hr style="border-top: 1px solid #4D4D4D">
			</div>
			<div class="container" style="background-color:#F8F8F8;padding:0px 3%;">
				<?php 
				$no=1;
				$Count=0;
				$CountMulti=0;
				$CountDesc=0; 
				$CountFill=0;
				$CountTF=0; 	
				
				$this->load->helper('form');
				
					//print_r($DraftedData);
					for($i=0;$i<count($DraftedData);$i++)
					{
						$Count++;
					?>
					
					<?php
						if($DraftedData[$i]['Qtypemulti']=='Multiple choice questions')
						{	
				?>
							<div style="width:100%;float:left;margin-bottom:10px;">
							<input type="hidden" name="Qtypemulti" value="<?php echo $DraftedData[$i]['Qtypemulti']; ?>">		
							
				<?php
						for($id=0;$id<count($DraftedData[$i]['MultiAnsID']);$id++)
						{
				?>
							<input type="hidden" name="MultiAnsID<?php echo $no; ?>[]" value="<?php echo $DraftedData[$i]['MultiAnsID'][$id] ?>">
				<?php
						}
				?>	
				               
				                <div class="row">
				                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
		                                 <label style="font-size:20px;">Q<?php echo $no; ?>.</label>
		                            </div>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="padding-left:0px;">
									<label class="wrap" style="font-size:20px;"><?php echo html_escape($DraftedData[$i]['Quemulti']); ?></label>
									<input type="hidden" name="MultiQueID<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['MultiQueID']; ?>">
									<input type="hidden" name="Quemulti<?php echo $Count; ?>" value="<?php echo html_escape($DraftedData[$i]['Quemulti']); ?>">
								</div>
								 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
									<label style="font-size:20px;">Marks:<span><?php echo $DraftedData[$i]['MarksMulti']; ?></span></label>
									<input type="hidden" name="MarksMulti<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['MarksMulti']; ?>">
									<input type="hidden" name="NegMarksMulti<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['NegMarksMulti']; ?>">		
								</div>
								    <input type="hidden" name="RefDocMulti<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['RefDocMulti']; ?>">
								    <input type="hidden" name="RefDocMultiPageNo<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['RefDocMultiPageNo']; ?>">
								</div>
								
					<?php
					    	if($DraftedData[$i]['ImageMulti'])
							{
					?>
							<div class="row">
					             <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1"></div>
					                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0px;">
									<a id="fbox" class="fancybox" href="#MultiExest"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $DraftedData[$i]['ImageMulti']; ?>" width="150" height="150"></a><br>
									<input type="hidden" name="ImgMulti<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['ImageMulti']; ?>">
									<div id="MultiExest" style="display:none;width:600px;height:500px;">
                                          <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $DraftedData[$i]['ImageMulti']; ?>" width="500" height="500">
                                    </div>
								</div>
							</div><br>
					<?php
							}
					?>
								<div class="row">
					        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1" style="font-size:20px;"><label>Ans:</label><br></div> 
					        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
						<?php
									for($j=0;$j<count($DraftedData[$i]['txtAnsMulti']);$j++)
									{
										//print_r($DraftedData[$i]['ChkAnsMulti'][$j]);
										if($DraftedData[$i]['ChkAnsMulti'][$j]=='1')
										{	
						?>
										<input type="checkbox" disabled="disabled" checked name="CorrAnsMultiExe<?php echo $Count; ?>[]" value="<?php echo $DraftedData[$i]['MultiAnsID'][$j]; ?>">&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo html_escape($DraftedData[$i]['txtAnsMulti'][$j]); ?></span><br>
										<input type="hidden" name="CorrAnsMultiExe<?php echo $Count; ?>[]" value="<?php echo $DraftedData[$i]['MultiAnsID'][$j]; ?>">
										<input type="hidden" name="AnsMulti<?php echo $Count; ?>[]" value="<?php echo html_escape($DraftedData[$i]['txtAnsMulti'][$j]); ?>">
						<?php
										}
										else
										{
						?>
										<input type="checkbox" disabled>&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo html_escape($DraftedData[$i]['txtAnsMulti'][$j]); ?></span><br>
										<input type="hidden" name="AnsMulti<?php echo $Count; ?>[]" value="<?php echo html_escape($DraftedData[$i]['txtAnsMulti'][$j]); ?>">
						<?php
										}				
									}
									for($j1=0;$j1<count($DraftedData[$i]['AddChkAnsMulti']);$j1++)
									{
										//print_r($DraftedData[$i]['ChkAnsMulti'][$j]);
										if($DraftedData[$i]['AddChkAnsMulti'][$j1]=='1')
										{	
						?>
										<input type="checkbox" disabled checked name="CorrAnsMultiAdd<?php echo $Count; ?>[]" value="<?php echo html_escape($DraftedData[$i]['AddtxtAnsMulti'][$j1]); ?>">&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo $DraftedData[$i]['AddtxtAnsMulti'][$j1]; ?></span><br>
									    <input type="hidden" name="CorrAnsMultiAdd<?php echo $Count; ?>[]" value="<?php echo $DraftedData[$i]['AddtxtAnsMulti'][$j1]; ?>">
										<input type="hidden" name="AnsMultiAdd<?php echo $Count; ?>[]" value="<?php echo html_escape($DraftedData[$i]['AddtxtAnsMulti'][$j1]); ?>">
						<?php
										}
										else
										{
						?>
										<input type="checkbox" disabled>&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo html_escape($DraftedData[$i]['AddtxtAnsMulti'][$j1]); ?></span><br>
										<input type="hidden" name="AnsMultiAdd<?php echo $Count; ?>[]" value="<?php echo html_escape($DraftedData[$i]['AddtxtAnsMulti'][$j1]); ?>">
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
				
						if($DraftedData[$i]['Qtypedesc']=='Descriptive questions')
						{
				?>
								<div style="width:100%;float:left;margin-bottom:10px;">
							<input type="hidden" name="Qtypedesc" value="<?php echo $DraftedData[$i]['Qtypedesc']; ?>">
							<input type="hidden" name="DescAnsID<?php echo $no; ?>" value="<?php echo $DraftedData[$i]['DescAnsID']; ?>">
			
				                <div class="row">
				                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
		                                   <label style="font-size:20px;">Q<?php echo $no; ?>.</label>
		                            </div>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="padding-left:0px;">
									<label class="wrap" style="font-size:20px;"><?php echo html_escape($DraftedData[$i]['QueDesc']); ?></label>
									<input type="hidden" name="DescQueID<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['DescQueID']; ?>">
									<input type="hidden" name="DescQue<?php echo $Count; ?>" value="<?php echo html_escape($DraftedData[$i]['QueDesc']); ?>">
								</div>
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
									<label style="font-size:20px;">Marks:<span><?php echo $DraftedData[$i]['MarksDesc']; ?></span></label>
									<input type="hidden" name="DescMarks<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['MarksDesc']; ?>">		
									<input type="hidden" name="DescNegMarks<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['NegMarksDesc']; ?>">		
								</div>
								<input type="hidden" name="RefDocDesc<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['RefDocDesc']; ?>">
								<input type="hidden" name="RefDocDescPageNo<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['RefDocDescPageNo']; ?>">
								</div>
						<?php
							if($DraftedData[$i]['ImageDesc'])
							{
			        	?>
								<div class="row">
					                <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1"></div>
					                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0px;">
									<a id="fbox" class="fancybox" href="#DescExest"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $DraftedData[$i]['ImageDesc']; ?>" width="150" height="150"></a><br>
									<input type="hidden" name="DescImg<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['ImageDesc']; ?>">
									
									<div id="DescExest" style="display:none;width:600px;height:500px;">
                                          <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $DraftedData[$i]['ImageDesc']; ?>" width="500" height="500">
                                    </div>
								</div>
								    </div><br>
						<?php
							}
						?>
							<div class="row">
					        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1" style="font-size:20px;"><label>Ans:</label></div> 
					        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
									<span class="wrap" style="font-size:20px;"><?php echo html_escape($DraftedData[$i]['AnsDesc']); ?></span>
									<input type="hidden" name="DesAns<?php echo $Count; ?>" value="<?php echo html_escape($DraftedData[$i]['AnsDesc']); ?>">		
								</div>
								</div>
							</div>
						
				<?php
				            $no++;
							}
						if($DraftedData[$i]['Qtypefill']=='Fill in the blanks')
						{
				?>
							<div style="width:100%;float:left;margin-bottom:10px;">	
							<input type="hidden" name="Qtypefill" value="<?php echo $DraftedData[$i]['Qtypefill']; ?>">
				<?php
						for($fid=0;$fid<count($DraftedData[$i]['FillAnsID']);$fid++)
						{
				?>
							<input type="hidden" name="FillAnsID<?php echo $no; ?>[]" value="<?php echo $DraftedData[$i]['FillAnsID'][$fid] ?>">
				<?php
						}
				?>
				                <div class="row">
					        	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><label style="font-size:20px;">Q<?php echo $no; ?>.</label></div>
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="padding-left:0px;">
									<label class="wrap" style="font-size:20px;"><?php echo html_escape($DraftedData[$i]['QueFill']); ?></label>
									<input type="hidden" name="FillQueID<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['FillQueID']; ?>">
									<input type="hidden" name="FillQue<?php echo $Count; ?>" value="<?php echo html_escape($DraftedData[$i]['QueFill']); ?>">		
								</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
									<label style="font-size:20px;">Marks:<span><?php echo $DraftedData[$i]['MarksFill']; ?></span></label>	
									<input type="hidden" name="FillMarks<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['MarksFill']; ?>">	
									<input type="hidden" name="FillNegMarks<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['NegMarksFill']; ?>">			
								</div>
								    <input type="hidden" name="RefDocFill<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['RefDocFill']; ?>">
								    <input type="hidden" name="RefDocFillPageNo<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['RefDocFillPageNo']; ?>">
								</div>
					<?php
					        	if($DraftedData[$i]['ImageFill'])
						    	{
					?>
								<div class="row">
					    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
					     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0px;">
									<a id="fbox" class="fancybox" href="#FillExest"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $DraftedData[$i]['ImageFill']; ?>" width="150" height="150"></a><br>
									<input type="hidden" name="FillImg<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['ImageFill']; ?>">	
									
									<div id="FillExest" style="display:none;width:600px;height:500px;">
                                          <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $DraftedData[$i]['ImageFill']; ?>" width="500" height="500">
                                    </div>
								</div>
								</div><br>
					<?php
						    	}
					?>
									<div class="row">
					        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="font-size:20px;"><label>Ans:</label></div> 
					        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
						<?php
									//print_r($DraftedData[$i]['AddChkAnsFill']);
									for($k=0;$k<count($DraftedData[$i]['txtAnsFill']);$k++)
									{
										if($DraftedData[$i]['ChkAnsFill'][$k]=='1')
										{	//echo $DraftedData[$i]['ChkAnsFill'][$k];
						?>
										<input type="radio" disabled="disabled" name="CorrAnsFillExe<?php echo $Count; ?>" checked value="<?php echo $DraftedData[$i]['FillAnsID'][$k]; ?>">&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo $DraftedData[$i]['txtAnsFill'][$k]; ?></span><br>
										<input type="hidden" name="CorrAnsFillExe<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['FillAnsID'][$k]; ?>">
										<input type="hidden" name="FillAnsExe<?php echo $Count; ?>[]" value="<?php echo html_escape($DraftedData[$i]['txtAnsFill'][$k]); ?>">
						<?php
										}
										else
										{
						?>
										<input type="radio" disabled>&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo $DraftedData[$i]['txtAnsFill'][$k]; ?></span><br>
										<input type="hidden" name="FillAnsExe<?php echo $Count; ?>[]" value="<?php echo html_escape($DraftedData[$i]['txtAnsFill'][$k]); ?>">
						<?php
										}				
									}
									for($k1=0;$k1<count($DraftedData[$i]['AddtxtAnsFill']);$k1++)
									{
										if($DraftedData[$i]['AddChkAnsFill'][$k1]=='1')
										{	//echo $DraftedData[$i]['ChkAnsFill'][$k];
						?>
										<input type="radio" disabled="disabled" name="CorrAnsFillAdd<?php echo $Count; ?>" checked value="<?php echo html_escape($DraftedData[$i]['AddtxtAnsFill'][$k1]); ?>">&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo $DraftedData[$i]['AddtxtAnsFill'][$k1]; ?></span><br>
										<input type="hidden" name="CorrAnsFillAdd<?php echo $Count; ?>" value="<?php echo html_escape($DraftedData[$i]['AddtxtAnsFill'][$k1]); ?>">
										<input type="hidden" name="FillAnsAdd<?php echo $Count; ?>[]" value="<?php echo html_escape($DraftedData[$i]['AddtxtAnsFill'][$k1]); ?>">
						<?php
										}
										else
										{
						?>
										<input type="radio" disabled>&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo $DraftedData[$i]['AddtxtAnsFill'][$k1]; ?></span><br>
										<input type="hidden" name="FillAnsAdd<?php echo $Count; ?>[]" value="<?php echo html_escape($DraftedData[$i]['AddtxtAnsFill'][$k1]); ?>">
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
			
						if($DraftedData[$i]['Qtypetf']=='True false')
						{
				?>
							<div style="width:100%;float:left;margin-bottom:10px;">
							<input type="hidden" name="Qtypetf" value="<?php echo $DraftedData[$i]['Qtypetf']; ?>">
					
						         <div class="row">
	                             <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><label style="font-size:20px;">Q<?php echo $no; ?>.</label></div>
									<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="padding-left:0px;">
									<label class="wrap" style="font-size:20px;"><?php echo html_escape($DraftedData[$i]['QueTF']); ?></label>
									<input type="hidden" name="TFQueID<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['TFQueID']; ?>">
									<input type="hidden" name="TFQue<?php echo $Count; ?>" value="<?php echo html_escape($DraftedData[$i]['QueTF']); ?>">
								</div>
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
									<label style="font-size:20px;">Marks:<span><?php echo $DraftedData[$i]['MarksTF']; ?></span></label>	
									<input type="hidden" name="MarksTF<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['MarksTF']; ?>">	
									<input type="hidden" name="NegMarksTF<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['NegMarksTF']; ?>">			
								</div>
								    <input type="hidden" name="RefDocTF<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['RefDocTF']; ?>">
								    <input type="hidden" name="RefDocTFPageNo<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['RefDocTFPageNo']; ?>">
								</div>
								
						<?php
							if($DraftedData[$i]['ImageTF'])
							{
						?>
								
								<div class="row">
					    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
					     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0px;">
									<a id="fbox" class="fancybox" href="#TFExest"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $DraftedData[$i]['ImageTF']; ?>" width="150" height="150"></a><br>
									<input type="hidden" name="ImgTF<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['ImageTF']; ?>">		
									
									<div id="TFExest" style="display:none;width:600px;height:500px;">
                                          <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $DraftedData[$i]['ImageTF']; ?>" width="500" height="500">
                                    </div>
								</div>
								</div><br>
						<?php
							}
						?>
							<div class="row">
					        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="font-size:20px;"><label>Ans:</label></div> 
					        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
						
<?php
								if($DraftedData[$i]['TFAnsChk1']=='True')
								{
						?>
									<input type="radio" disabled="disabled" checked name="CorrAnsT<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['TrueAnsID'] ?>">&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo $DraftedData[$i]['TFAns1'] ?></span><br>
									<input type="hidden" name="CorrAnsT<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['TrueAnsID'] ?>">
						<?php
								}
								else
								{
						?>
									<input type="radio" disabled>&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo $DraftedData[$i]['TFAns1'] ?></span><br>
						<?php
								}
								if($DraftedData[$i]['TFAnsChk2']=='False')
								{	
						?>
									<input type="radio" disabled="disabled" checked name="CorrAnsF<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['TrueAnsID'] ?>">&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo $DraftedData[$i]['TFAns2'] ?></span><br>
								    <input type="hidden" name="CorrAnsF<?php echo $Count; ?>" value="<?php echo $DraftedData[$i]['TrueAnsID'] ?>">	
						<?php
								}
								else
								{
						?>
									<input type="radio" disabled>&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo $DraftedData[$i]['TFAns2'] ?></span><br>
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
	                    
					    $NewCount=0;
					    
					    for($a=0;$a<count($NewData);$a++)
						{   
						    $NewCount++;
						    
					        if($NewData[$a]['QueMulti']==null){}
					        else
		                    {
		                        
			    ?>
			                        <div style="width:100%;float:left;margin-bottom:10px;">
			                                <div class="row">
		                          <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
		                              <label style="font-size:20px;">Q<?php echo $no; ?>.</label>
		                     </div>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="padding-left:0px;">
									<label class="wrap" style="font-size:20px;"><?php echo html_escape($NewData[$a]['QueMulti']); ?></label>
									<input type="hidden" name="MultiQue<?php echo $NewCount; ?>" value="<?php echo html_escape($NewData[$a]['QueMulti']); ?>">
								</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
									<label style="font-size:20px;">Marks:<span><?php echo $NewData[$a]['MarksMulti']; ?></span></label>
									<input type="hidden" name="MultiMarks<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['MarksMulti']; ?>">	
									<input type="hidden" name="MultiNegMarks<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['NegMarksMulti']; ?>">	
								</div>
								<input type="hidden" name="MultiRefDoc<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['MultiRefDoc']; ?>">
								<input type="hidden" name="MultiRefPageNo<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['MultiRefPageNo']; ?>">
								</div>
				<?php
				                if($NewData[$a]['FileMulti']!=null)
				                {
				?>
			                        <div class="row">
				            	    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
				            	     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0px;">
									<a id="fbox" class="fancybox" href="#MultiNew"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $NewData[$a]['FileMulti']; ?>" width="150" height="150"></a><br>
									<input type="hidden" name="MultiImg<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['FileMulti']; ?>">
									<div id="MultiNew" style="display:none;width:600px;height:500px;">
                                          <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $NewData[$a]['FileMulti']; ?>" width="500" height="500">
                                    </div>
									
								</div>
								</div><br>	
				<?php
		                         }
				?>  
			                        <div class="row">
					                 <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="font-size:20px;"><label>Ans:</label><br></div> 
					                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
				<?php
									for($a1=0;$a1<count($NewData[$a]['NewtxtAnsMulti']);$a1++)
									{
										if($NewData[$a]['NewChkAnsMulti'][$a1]=='1')
										{
				?>
											<input type="checkbox" disabled="disabled" name="CorrAnsMulti<?php echo $NewCount; ?>[]" value="<?php echo html_escape($NewData[$a]['NewtxtAnsMulti'][$a1]); ?>" checked>&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo $NewData[$a]['NewtxtAnsMulti'][$a1]; ?></span><br>
										    <input type="hidden" name="CorrAnsMulti<?php echo $NewCount; ?>[]" value="<?php echo html_escape($NewData[$a]['NewtxtAnsMulti'][$a1]); ?>">
											<input type="hidden" name="MultiAns<?php echo $NewCount ?>[]" value="<?php echo html_escape($NewData[$a]['NewtxtAnsMulti'][$a1]); ?>">
				<?php
										}
										else
										{	
				?>					
											<input type="checkbox" disabled>&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo $NewData[$a]['NewtxtAnsMulti'][$a1]; ?></span><br>
											<input type="hidden" name="MultiAns<?php echo $NewCount ?>[]" value="<?php echo html_escape($NewData[$a]['NewtxtAnsMulti'][$a1]); ?>">					
				<?php
										}
									}
				?>
							        	</div></div>
			                        </div>                    
			    <?php
			                $no++;
		                    }
		                    if($NewData[$a]['QueDesc']==null){}
		                    else
		                    {
		        ?>
		                            <div style="width:100%;float:left;margin-bottom:10px;">
		                                    <div class="row">
					                        	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
		                                        <label style="font-size:20px;">Q<?php echo $no; ?>.</label>
		                                   </div>
						        		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="padding-left:0px;">
							        		<label class="wrap" style="font-size:20px;"><?php echo html_escape($NewData[$a]['QueDesc']); ?></label>
						        			<input type="hidden" name="DescQue<?php echo $NewCount ?>" value="<?php echo html_escape($NewData[$a]['QueDesc']); ?>">
							        	</div>
							           	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
							        		<label style="font-size:20px;">Marks:<span><?php echo $NewData[$a]['MarksDesc']; ?></span></label>
							        		<input type="hidden" name="DescMarks<?php echo $NewCount ?>" value="<?php echo $NewData[$a]['MarksDesc']; ?>">	
							        		<input type="hidden" name="DescNegMarks<?php echo $NewCount ?>" value="<?php echo $NewData[$a]['NegMarksDesc']; ?>">	
							        	</div>
							        	    <input type="hidden" name="DescRefDoc<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['DescRefDoc']; ?>">
							        	    <input type="hidden" name="DescRefPageNo<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['DescRefPageNo']; ?>">
							        	</div>
				<?php
		                               if($NewData[$a]['FileDesc']!=null)
				                       {
		        ?>             
		                                <div class="row">
					                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
					                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0px;">
									       <a id="fbox" class="fancybox" href="#DescNew"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $NewData[$a]['FileDesc']; ?>" width="150" height="150"></a><br>
								        	<input type="hidden" name="DescImg<?php echo $NewCount ?>" value="<?php echo $NewData[$a]['FileDesc']; ?>">
									
								        	<div id="DescNew" style="display:none;width:600px;height:500px;">
                                                <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $NewData[$a]['FileDesc']; ?>" width="500" height="500">
                                            </div>
								            </div>
							            	</div><br>
		        <?php
				                       }
		        ?>      
		                                <div class="row">
					                      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="font-size:20px;"><label>Ans:</label></div> 
					                         <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
								        	<span style="font-size:20px;" class="wrap"><?php echo html_escape($NewData[$a]['AnsDesc']); ?></span>
								    	<input type="hidden" name="DescAns<?php echo $NewCount; ?>" value="<?php echo html_escape($NewData[$a]['AnsDesc']); ?>">
								        </div></div>
		                            </div>      
		        <?php
		                    $no++;
		                    }
		                    if($NewData[$a]['MarksFill']==null){}
		                    else
		                    {
		        ?>           
		                            <div style="width:100%;float:left;margin-bottom:10px;">	
		                                <div class="row">
					                    	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><label style="font-size:20px;">Q<?php echo $no; ?>.</label></div>
							            	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="padding-left:0px;">
							        		<label class="wrap" style="font-size:20px;"><?php echo $NewData[$a]['QueFill']; ?></label>
							        		<input type="hidden" name="FillQue<?php echo $NewCount ?>" value="<?php echo $NewData[$a]['QueFill']; ?>">
							          	</div>	
					            		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
						       			<label style="font-size:20px;">Marks:<span><?php echo $NewData[$a]['MarksFill']; ?></span></label>
								    	<input type="hidden" name="FillMarks<?php echo $NewCount ?>" value="<?php echo $NewData[$a]['MarksFill']; ?>">
									    <input type="hidden" name="FillNegMarks<?php echo $NewCount ?>" value="<?php echo $NewData[$a]['NegMarksFill']; ?>">
							    	</div>
							    	    <input type="hidden" name="FillRefDoc<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['FillRefDoc']; ?>">
							    	    <input type="hidden" name="FillRefPageNo<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['FillRefPageNo']; ?>">
								    </div>
							<?php
						        	if($NewData[$a]['FileFill'])
						        	{
			            	?>
			            	            <div class="row">
					                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
					                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0px;">
									<a id="fbox" class="fancybox" href="#FillNew"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $NewData[$a]['FileFill'] ?>" width="150" height="150"></a><br>
									<input type="hidden" name="FillImg<?php echo $NewCount ?>" value="<?php echo $NewData[$a]['FileFill']; ?>">
									
								    	<div id="FillNew" style="display:none;width:600px;height:500px;">
                                        <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $NewData[$a]['FileFill'] ?>" width="500" height="500">
                                        </div>
								        </div>
								</div><br>
			            	<?php
						        	}
			            	?>
			            	            <div class="row">
					                  <div class="col-md-1" style="font-size:20px;"><label>Ans:</label></div> 
					                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							<?php
								for($f1=0;$f1<count($NewData[$a]['NewtxtAnsFill']);$f1++)
								{
									if($NewData[$a]['NewChkAnsFill'][$f1]=='1')	
									{
							?>
										<input type="radio" disabled="disabled" checked name="FillAnsCorr<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['NewtxtAnsFill'][$f1] ?>">&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo $NewData[$a]['NewtxtAnsFill'][$f1] ?></span><br>
										<input type="hidden" name="FillAnsCorr<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['NewtxtAnsFill'][$f1] ?>">
										<input type="hidden" name="FillAns<?php echo $NewCount; ?>[]" value="<?php echo $NewData[$a]['NewtxtAnsFill'][$f1] ?>">
							<?php
									}
									else
									{
							?>	
										<input type="radio" disabled>&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo $NewData[$a]['NewtxtAnsFill'][$f1] ?></span><br>
										<input type="hidden" name="FillAns<?php echo $NewCount; ?>[]" value="<?php echo $NewData[$a]['NewtxtAnsFill'][$f1] ?>">
							<?php
									}
								}
							?>
								</div></div>
		                          </div>      
		        <?php
		                    $no++;
		                    }
		                    if($NewData[$a]['QueTF']==null){}
		                    else
		                    {
		        ?>
		                            <div style="width:100%;float:left;margin-bottom:10px;">	
		                                    <div class="row">
	                                     <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><label style="font-size:20px;">Q<?php echo $no; ?>.</label></div>
							            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="padding-left:0px;">
									        <label class="wrap" style="font-size:20px;"><?php echo html_escape($NewData[$a]['QueTF']); ?></label>
									        <input type="hidden" name="TFQue<?php echo $NewCount; ?>" value="<?php echo html_escape($NewData[$a]['QueTF']); ?>">
								        </div>
									    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
									    <label style="font-size:20px;">Marks:<span><?php echo $NewData[$a]['MarksTF']; ?></span></label>	
								    	<input type="hidden" name="TFMarks<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['MarksTF']; ?>">
								    	<input type="hidden" name="TFNegMarks<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['NegMarksTF']; ?>">
							        	</div>
							        	    <input type="hidden" name="TFRefDoc<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['TFRefDoc']; ?>">
							        	    <input type="hidden" name="TFRefPageNo<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['TFRefPageNo']; ?>">
							        	</div>
		                           
		        <?php
						        	if($NewData[$a]['FileTF'])
						        	{
			    ?>
			                            <div class="row">
					                     <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
					                     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0px;">
								            <a id="fbox" class="fancybox" href="#TFNew"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $NewData[$a]['FileTF'] ?>" width="150" height="150"></a><br>
									        <input type="hidden" name="TFImg<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['FileTF']; ?>">
									
							        		<div id="TFNew" style="display:none;width:600px;height:500px;">
                                            <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $NewData[$a]['FileTF'] ?>" width="500" height="500">
                                     </div>
							        	</div></div><br>
			    <?php
						        	}
			    ?>
			                            <div class="row">
					        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="font-size:20px;"><label>Ans:</label></div> 
					        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							<?php
									if($NewData[$a]['Ans1TF']=='True')	
									{
							?>
										<input type="radio" disabled="disabled" checked name="CorrTAns<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['Ans1Chkk'] ?>">&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo $NewData[$a]['Ans1Chkk'] ?></span><br>
							            <input type="hidden" name="CorrTAns<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['Ans1Chkk'] ?>">
							<?php   
									}
									else
									{
							?>	
										<input type="radio" disabled>&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo $NewData[$a]['Ans1Chkk'] ?></span><br>
							<?php
									}	
									if($NewData[$a]['Ans2TF']=='False')
									{
							?>
										<input type="radio" disabled="disabled" checked name="CorrFAns<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['Ans2Chkk'] ?>">&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo $NewData[$a]['Ans2Chkk'] ?></span><br>
							            <input type="hidden" name="CorrFAns<?php echo $NewCount; ?>" value="<?php echo $NewData[$a]['Ans2Chkk'] ?>">
							<?php
									}
									else
									{
							?>
										<input type="radio" disabled>&nbsp;&nbsp;<span style="font-size:20px;" class="wrap"><?php echo $NewData[$a]['Ans2Chkk'] ?></span><br>
							<?php
									}
							?>
								</div></div>
								</div>
		        <?php
		                    $no++;
		                    }
						}
					
				?>
	
				<input type="hidden" name="count" value="<?php echo $Count; ?>">
				<input type="hidden" name="NewCount" value="<?php echo $NewCount; ?>">
				
				<div class="row" style="float:left;">
					<hr style="border-top: 1px solid #4D4D4D">
				</div>
				
			</div></div>
			<div class="container" style="padding:2%;">
			    <div class="row text-center">
					<input type="submit" value="Save" style="background-color:#0071BC;color:white;font-weight:bold;width:200px;" class="btn btn-lg btnhover" name="save">
					<input type="submit" value="Save & Live" style="background-color:#0071BC;color:white;font-weight:bold;width:200px;" class="btn btn-lg btnhover" name="save_and_live">
				</div>    
			</div>
		</form>
	</body>
</html>
				
				
						

				
				
				
				 
				 

				
				
				

						

				
