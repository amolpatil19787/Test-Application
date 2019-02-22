<html>
	<head>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url() ?>/assets/css/QuestionPaper.css" rel="stylesheet">
		<link href="<?php echo base_url() ?>/assets/css/QuestionPaper.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
	
		<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>  
		<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"></script>
	   <!-- <script src="http://html2canvas.hertzen.com/build/html2canvas.js"></script> -->
		
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
			@media screen and (@screen-sm) {
		    
		    
		    .col-md-9
		    {
		        width:75% !important;
		    }
		    
			}
			
			.clsprogressByJS
			{
			    position: fixed;
                left: 0px;
                 top: 0px;
               width: 100%;
               height: 100%;
               z-index: 9999;
               background: #3d464d;
               opacity: 0.99;
            }
            .circleimage
            {
                width: 40px;
               height: 40px;
               position: absolute;
               left: 50%;
               right: 50%;
               bottom: 50%;
               top: 50%;
               margin: -20px;
            }
			
		    .booth
		    {
		        width:400px;
		        background:#ccc;
		        border:10px solid #ddd;
		        margin:0 auto;
		    }
		</style>
		<script>
		
		        $(document).ready(
		            function()
		            {
		                var QuePaperID=$('#QuePaperID').val();
		                $.ajax({
					type: "post",
					data:{QuePaperID:QuePaperID},
         				url:"<?php echo base_url(); ?>Questions/UserQuePaperDetails", //the page containing php script
            				success:function(data)
				        	{
				        	 //  alert(data);
				        	   if(data>=1)
				        	   {
				        	       window.location.href = '<?php echo site_url() ?>/Questions/ShowQuestionPaper';
				        	   }
				        	},
				        	 error:function()
        			        {
        			         	 //alert('fail');
        			       	 }
				        	
                       });
		            }
		        )
		
        
		  
          $(document).ready(function() {
                	$(".fancybox").fancybox({
                		openEffect	: 'none',
	                	closeEffect	: 'none'
            	});
            	    //alert($('#QuePaperID').val());
            	    
            	        var QuePaperID=$('#QuePaperID').val();
            	    
            	        $.ajax({
					type: "post",
         				url:"<?php echo base_url(); ?>Questions/UserAttemptQuePaperDate", //the page containing php script
           				data: {QuePaperID:QuePaperID},
            				success:function(data)
					{
					      //  alert('success');
					       // window.location.href = '<?php echo base_url(); ?>Questions/AdminHomePage';
					},
					 error:function()
        			        {
        			         	 //alert('fail');
        			       	 }
					});
            	    
                });
        
            function capitalize(textboxid, str) {
                
      // string with alteast one character
      if (str && str.length >= 1)
      {       
          var firstChar = str.charAt(0);
          var remainingStr = str.slice(1);
          str = firstChar.toUpperCase() + remainingStr;
      }
      document.getElementById(textboxid).value = str;
  }
       
 
    
       // var upgradeTime = 
var seconds = <?php echo $Questions[0]->Timer ?>;

function timer() {

  var days        = Math.floor(seconds/24/60/60);
  var hoursLeft   = Math.floor((seconds) - (days*86400));
  var hours       = Math.floor(hoursLeft/3600);
  var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
  var minutes     = Math.floor(minutesLeft/60);
  var remainingSeconds = seconds % 60;
  function pad(n) {
    return (n < 10 ? "0" + n : n);
  }
  document.getElementById('countdown').innerHTML =  pad(hours) + ":" + pad(minutes) + ":" + pad(remainingSeconds);
  
  
  
  if (seconds == 0) {
    clearInterval(countdownTimer);
    
            $.confirm({
            title: '',
            content: 'Your time is over!',
            buttons: {
                Ok: function () {
                    $.ajax({
					type: "post",
					data:$('form').serialize(),
         				url:"<?php echo base_url(); ?>Questions/UserQuestionPaper", //the page containing php script
            				success:function(data)
				        	{
                                window.location.href = '<?php echo site_url() ?>/Questions/ShowQuestionPaper';
				        	},
				        	 error:function()
        			        {
        			         	 //alert('fail');
        			       	 }
				        	
                       });
                }
            }
        });
    
    //document.getElementById('countdown').innerHTML = "Completed";
  } else {
    seconds--;
  }
}
var countdownTimer = setInterval('timer()', 1000);  

        
        var recorder;
        
        
        function confSubmit(obj)
		  {
		      $.confirm({
                    title: '',
                 content: 'Are you sure you want to submit question paper?',
                 buttons: {
                       Yes: function () {
                         
                         /*  $("#progress_By_JS")[0].style.display = "block";
                                  $("#mydiv").css("background-color", "#929292");
                                  $("#mydiv").css("opacity", "0.2");
                         */
                        
                         
                           $.ajax({
					type: "post",
					data:$('form').serialize(),
         				url:"<?php echo base_url(); ?>Questions/UserQuestionPaper", //the page containing php script
            				success:function(data)
				        	{
				        	    // stoprecord();
				        	    
				        	    $.confirm({title:"",content:"You have successfully solved this question paper",
                        buttons: {
                       Ok: function () {
                      window.location.href = '<?php echo site_url() ?>/Questions/ShowQuestionPaper';
                           
                 }}});
				        	    
				        	},
				        	 error:function()
        			        {
        			         	 //alert('fail');
        			       	 }
				        	
                       });
                       },
                       No: function () {
                                                        $(this).confirm("close");    
                             }
                       }})
       
         }
         
       
 
            $(document).ready(function(){
   $('.prevent').on("cut copy paste",function(e) {
      e.preventDefault();
   });
        
        $(".prevent").on("contextmenu",function(e){
        return false;
    });
   
});

        var pagecount=0;
        var blankpagecount=0;

   var interval = setInterval(function(){
        if (document.visibilityState == "visible")
        {   
            pagecount=pagecount+1;
            
             var QuePaperName=$('#QuePaperName').val();
            var QuePaperDate=$('#QuePaperDate').val();
            
              html2canvas(document.body).then(function(canvas) {
    

            var imagedata = canvas.toDataURL('image/png');
	    	var imgdata = imagedata.replace(/^data:image\/(png|jpg);base64,/, "");

            $.ajax({
			url: 'http://www.test.acquiscent.com/Questions/Screenshots',
			data: {
			       imgdata:imgdata,QuePaperName:QuePaperName,QuePaperDate:QuePaperDate,pagecount:pagecount
				   },
			type: 'post',
			success: function (response) {   
              // alert(response);
		        	}
	        	});

            });
        }
        else
        {
            blankpagecount=blankpagecount+1;
            
    
             var QuePaperName=$('#QuePaperName').val();
            var QuePaperDate=$('#QuePaperDate').val();
    
                const el = document.querySelector('#blankdiv');
                el.style.display = "block";       
                
                      html2canvas(el).then(function(canvas) {
    

            var imagedata = canvas.toDataURL('image/png');
	    	var imgdata = imagedata.replace(/^data:image\/(png|jpg);base64,/, "");

            $.ajax({
			url: 'http://www.test.acquiscent.com/Questions/BlankImg',
			data: {
			       imgdata:imgdata,QuePaperName:QuePaperName,QuePaperDate:QuePaperDate,blankpagecount:blankpagecount
				   },
			type: 'post',
			success: function (response) {   
             //  alert(response);
	        		}
	        	});

                el.style.display = "none";
}); 
        }

   }, 10000);       
            
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
            
           <div id="blankdiv" style="padding:20%;display:none;">
                    <h1><center>User is on another tab</center></h1>
            </div>

            <div class="container">
                <div class="row">
                    <h4>Please do not refresh page or press F5.</h4>   
                </div>
            </div> 
       
            <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left:0px;padding-right:0px;">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6" style="padding-left:0px;">
			            <a href="<?php echo site_url() ?>/Questions/ShowQuestionPaper" class="btn homebtn"><i class="fa fa-home"></i> Home</a>
			    </div>
			    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6" style="padding-right:0px;" align="right">
			        	<span id="countdown" class="timer" style="padding:1.5%;border-radius:5px;background-color: #0071BC;text-align:center;font-size:20px;color:white;font-weight:bold;">00:00:00</span>
			    </div>
			    </div>
	    	</div>
      </div>
      
               
                
        <!--  <h1 id="header">RecordRTC Upload to PHP</h1>
            <video id="your-video-id" controls="" autoplay="" style="width:250px;height:250px;z-index:1;position:fixed;"></video> -->
            
            
			<form method="post">
			
			<div class="container" style="margin-top:10px;background-color:#F8F8F8;padding:3%;">
			    <?php
			    if(empty($Questions))
				{
				}
				else
				{
			    ?>
				<div class="row">
					<center><h1 style="font-size:28px;"><?php echo $Questions[0]->Title; ?></h1></center>
					<input type="hidden" id="QuePaperName" name="QuePaperName" value="<?php echo $Questions[0]->Title; ?>">
					<input type="hidden" name="QuePaperID" id="QuePaperID" value="<?php echo $Questions[0]->QuePaperID; ?>">
					<input type="hidden" name="PaperTimer" id="PaperTimer" value="<?php echo  $duration=$Questions[0]->Timer;
					
				/*	$hours = floor($duration / 60);
$mins = $duration % 60;

echo str_pad($hours, 2, '0', STR_PAD_LEFT) , ':' , str_pad($mins, 2, '0', STR_PAD_LEFT) , ':00';*/
					
					?>">
					
					<input type="hidden" id="QuePaperDate" value="<?php	$originalDate =$Questions[0]->Date;
					echo $newDate = date("d-m-Y", strtotime($originalDate));  ?>">
					
					<label style="margin-left:1.5%;">Date:&nbsp;&nbsp;<?php	$originalDate =$Questions[0]->Date;
					echo $newDate = date("d-m-Y", strtotime($originalDate));  ?></label><br>
					<label style="margin-left:1.5%;">Total Marks:&nbsp;&nbsp;<?php echo $Questions[0]->TotalMarks; ?></label><br>
					<?php
						if(empty($PaperRefDoc)){}
						else{
						    if($PaperRefDoc[0]->ReferenceDoc!=null)
						    {
						?>
						<label style="margin-left:1.5%;"><a href="<?php echo base_url() ?>/assets/uploads/<?php echo $PaperRefDoc[0]->ReferenceDoc; ?>" target="_blank">Reference Document</a></label>
						<?php
						    }}
						?>
				</div>
				<?php
				}
				?><hr style="border-top: 1px solid #4D4D4D">
			</div>
			<div class="container" style="background-color:#F8F8F8;padding:0px 3%;" id="mydiv">
				<div style="float:left;width:100%;">
				<?php
				$no=1;

				$count=0;
				if(empty($Questions))
				{
				    
				}
				else
				{
				for($i=0;$i<count($Questions);$i++)
				{	
					$count++;
				?>
				
				<?php
					if($Questions[$i]->QueType=='Multiple choice questions')
					{
				?>
				        	<div style="width:100%;float:left;margin-bottom:10px;">
				    		<input type="hidden" name="MCQ_QueType" value="<?php echo $Questions[$i]->QueType; ?>">
				            <div class="row">
		                      <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
		                                <label style="font-size:20px;">Q<?php echo $no; ?>.</label>
		                      </div>
							<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
							<label class="wrap" style="font-size:20px;"><?php echo $Questions[$i]->Question ?></label>
							<input type="hidden" name="MultiQueID<?php echo $count ?>" value="<?php echo $Questions[$i]->QuestionID ?>">
							
							</div>
					    	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
							<label style="font-size:20px;">Marks:<span><?php echo $Questions[$i]->Marks ?></span></label>	
							</div>
							</div>
			    	<?php
						if($Questions[$i]->Image!=null)
						{
							
				    ?>
						<div class="row">
					    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
					     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0px;">
							<a id="fbox" class="fancybox" href="#Multi"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="150" height="150"></a><br>
							<div id="Multi" style="display:none;width:600px;height:500px;">
                                <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="500" height="500">
                            </div>
							</div>
						</div><br>
				    <?php
						}
				    ?>
								<div class="row">
					        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style="font-size:20px;"><label>Ans:</label><br></div> 
					        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
				<?php
							
							foreach($Answers as $a)
							{
								if($Questions[$i]->QuestionID==$a->QuestionID)
								{
				?>	
									<input type="checkbox" name="MultiAnsID<?php echo $count; ?>[]" value="<?php echo $a->AnswerID; ?>">&nbsp;&nbsp;<span class="wrap" style="font-size:20px;"><?php echo html_escape($a->Answer); ?></span><br>
				<?php
								}	
							}
							
							
				?>
							</div>
							 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<?php			     
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
				?>			     
							     </div>
							</div>
						    </div>
				<?php
						}
			
					if($Questions[$i]->QueType=='Descriptive questions')
					{
				?>
				        <div style="width:100%;float:left;margin-bottom:10px;">
					    	<input type="hidden" name="Desc_QueType" value="<?php echo $Questions[$i]->QueType; ?>">
			
				            <div class="row">
					           	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
		                           <label style="font-size:20px;">Q<?php echo $no; ?>.</label>
		                        </div>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
							<label class="wrap" style="font-size:20px;"><?php echo $Questions[$i]->Question ?></label>
							<input type="hidden" name="DescQueID<?php echo $count; ?>" value="<?php echo $Questions[$i]->QuestionID ?>">
							</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<label style="font-size:20px;">Marks:<span><?php echo $Questions[$i]->Marks ?></span></label>	
							</div>
							</div>
					<?php
						if($Questions[$i]->Image!=null)
						{
							
			    	?>
						<div class="row">
					    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
					     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0px;">
							<a id="fbox" class="fancybox" href="#Desc"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="150" height="150"></a>
						    <div id="Desc" style="display:none;width:600px;height:500px;">
                                <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="500" height="500">
                            </div>
						</div>
							</div><br>
					<?php
						}
					?>
						<div class="row">
					        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="font-size:20px;"><label>Ans:</label></div> 
					        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
						<?php
							foreach($Answers as $a)
							{
								if($Questions[$i]->QuestionID==$a->QuestionID)
									{
				?>	
								<textarea name="DescAns<?php echo $count; ?>" id="DescAnss<?php echo $count; ?>" class="form-control prevent" onkeyup="javascript:capitalize(this.id, this.value);"></textarea><br>
				<?php
								}
							}
							
							
				?>
							</div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<?php			     
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
				?>			     
							     </div>
							</div>
						</div>
				<?php
						}
				?>
						
					
				<?php
					if($Questions[$i]->QueType=='Fill in the blanks')
					{
				?>
				        <div style="width:100%;float:left;margin-bottom:10px;">
					    	<input type="hidden" name="Fill_QueType" value="<?php echo $Questions[$i]->QueType; ?>">
				
				             <div class="row">
					        	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><label style="font-size:20px;">Q<?php echo $no; ?>.</label></div> 
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
							<label class="wrap" style="font-size:20px;"><?php echo $Questions[$i]->Question ?></label>
							<input type="hidden" name="FillQueID<?php echo $count; ?>" value="<?php echo $Questions[$i]->QuestionID ?>">
							</div>
					    	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					    		<label style="font-size:20px;">Marks:<?php echo $Questions[$i]->Marks ?></label>
							</div>
							</div>
				<?php
						if($Questions[$i]->Image!=null)
						{
							
				?>
							<div class="row">
					    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
					     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0px;">
							<a id="fbox" class="fancybox" href="#Fill"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="150" height="150"></a>
						    <div id="Fill" style="display:none;width:600px;height:500px;">
                                <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="500" height="500">
                            </div>      
						
							</div>
							</div><br>
				<?php
						}
				?>
							<div class="row">
					        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="font-size:20px;"><label>Ans:</label></div> 
					        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
						<?php
							foreach($Answers as $a)
							{
								if($Questions[$i]->QuestionID==$a->QuestionID)
								{
				?>	
									<input type="radio" name="FillAnsID<?php echo $count; ?>" value="<?php echo $a->AnswerID; ?>">&nbsp;&nbsp;<span class="wrap" style="font-size:20px;"><?php echo html_escape($a->Answer); ?></span><br>
				<?php
								}
							}
							
				?>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<?php			     
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
				?>			     
							     </div>
							</div>
						</div>
				<?php
						}
		
					if($Questions[$i]->QueType=='True false')
					{
				?>
				        <div style="width:100%;float:left;margin-bottom:10px;">
					    	<input type="hidden" name="TF_QueType" value="<?php echo $Questions[$i]->QueType; ?>">
				
				            <div class="row">
	                         <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><label style="font-size:20px;">Q<?php echo $no; ?>.</label></div>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
							<label class="wrap" style="font-size:20px;"><?php echo $Questions[$i]->Question ?></label>
							<input type="hidden" name="TFQueID<?php echo $count; ?>" value="<?php echo $Questions[$i]->QuestionID ?>">
							</div>
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<label style="font-size:20px;">Marks:<?php echo $Questions[$i]->Marks ?></label>
							</div>
							</div>
				<?php
						if($Questions[$i]->Image!=null)
						{
							
				?>
						<div class="row">
					    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
					     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0px;">
							<a id="fbox" class="fancybox" href="#TF"><img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="150" height="150"></a>	
							<div id="TF" style="display:none;width:600px;height:500px;">
                                <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $Questions[$i]->Image ?>" width="500" height="500">
                            </div>
						</div>
						</div><br>
				<?php
						}
				?>
							<div class="row">
					         <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style="font-size:20px;"><label>Ans:</label><br></div> 
					        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
						<?php
							//print_r($Answers);
							foreach($Answers as $a)
							{
								if($Questions[$i]->QuestionID==$a->QuestionID)
								{
				?>	
									<input type="radio" name="TFAnsID<?php echo $count; ?>" value="<?php echo $a->AnswerID; ?>">&nbsp;&nbsp;<span class="wrap" style="font-size:20px;"><?php echo $a->Answer; ?></span><br>
				<?php
								}
							}
							
				?>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<?php			     
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
				?>			     
							     </div>
							</div>
						</div>
				<?php
						}
				$no++;
				}}
				?>	
			</div>
			<input type="hidden" name="count" value="<?php echo $count; ?>">
			
			</div>
				<div style="width:100%;float:left;margin:20px 0px;" align="center">
				<input type="button" name="save" value="Submit" class="btn btnhover" onclick="confSubmit(this.form);" style="width:200px;background-color:#0071BC;color:white;font-weight:bold;">
			</div>
			</form>
	</body>
	</html>
