<html>
    <head>
        <meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="<?php echo base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
		
		  <title>QUESTION & ANSWER</title>
    <link rel="icon" type="image/ico" href="<?php echo base_url() ?>/assets/images/logo.png" width="200px;" />
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
         <li><a style="color:#23527c;"><?php echo $this->session->userdata('ExamCoOrdinatorEmail'); ?></a></li>
         <li><a style="color:#23527c;" href = "<?php echo site_url() ?>/Questions/Logout">Logout</a></li>
      </ul>
   </div>
   
</nav>
         <div class="container">
             <div class="row">
           <?php
      // print_r($Data);
       $found=false;
       $a=0;
        for($i=0;$i<count($Data);$i++)
        {
            for($j=0;$j<count($Data[$a]);$j++)
            {
    ?>
                <div class="col-md-5" style="border:1px solid lightgray;margin:10px 2% !important;background-color:#F8F8F8;">
                    <h2 style="color:#337ab7"><center><?php echo $Data[$a][$j]->Title; ?></center></h2>
                    <h4><center><?php echo $Data[$a][$j]->EmailID; ?></center></h4>
                </div>
    <?php
                $found=true;
             
            }
         $a++;   
        }
        if($found==false)
        {
    ?>
            <div class="container">
                <h2 style="color:#337ab7"><center>No Data Available</center></h2>
            </div>
    <?php
        }
        
        //real time chat jquery
        
        //https://chatcamp.io/blog/jquery-chat/
        
        //https://pusher.com/tutorials/chat-widget-javascript
        
   // echo $this->session->userdata('ExamCoOrdinatorID');
  //  echo $this->session->userdata('ExamCoOrdinatorEmail');
?> 
            </div>
         </div>
    </body>
</html>    
       
            
        
