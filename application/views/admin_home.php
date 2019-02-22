<!DOCTYPE html>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
		   
		<!--  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
 	       	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  		  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
  		  <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
         <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
	
	       <title>QUESTION & ANSWER</title>
    <link rel="icon" type="image/ico" href="<?php echo base_url() ?>/assets/images/logo.png" width="800px;" />
	
	<style>
		.qp
		{
			margin:5px 0px;
			text-align:center;
			font-size:18px;
			border:0px;	
		}
		.glyphicon:hover
		{
			color:#C1272D !important;
			cursor:default;
		}
		.tablerow
		{
		    font-size:20px;
		}
		.mynav {
  bottom: 0;
  position: fixed;
  margin: 1em;
  right: 0px;
}

.buttons {
  
  display: block;
  width: 75px;
  height: 75px;
  margin: 20px auto 0;
  position: relative;
  -webkit-transition: all .1s ease-out;
          transition: all .1s ease-out;  
}

	mynav:hover 
.buttons:not(:last-child) {
  opacity: 1;
  -webkit-transform: none;
      -ms-transform: none;
          transform: none;
  margin: 15px auto 0;
}.buttons:nth-last-child(1) {
  -webkit-transition-delay: 25ms;
          transition-delay: 25ms;
 
  background-size: contain;
}
[tooltip]:before {
  bottom: 25%;
  font-family: arial;
  font-weight: 600;
  border-radius: 2px;
  background: #C1272D;
  border-radius:5px;
  color: #fff;
  content: attr(tooltip);
  font-size: 12px;
  visibility: hidden;
  opacity: 0;
  padding: 5px 7px;
  margin-right: 12px;
  position: absolute;
  right: 100%;
  white-space: nowrap;
}

[tooltip]:hover:before,
[tooltip]:hover:after {
  visibility: visible;
  opacity: 1;
}
    .buttons:hover
    {
        transform: scale(1.2, 1.2) translate3d(0, 0, 0);
    }

    @media screen and (min-width:300px) {
		    
		    .logo
		    {
		        margin:5px 5px !important;
		    }
	}

	</style>
	<script>
		function delete_paper(row)
		{
			debugger;
			   var QuePaperID=row.parentElement.parentElement.childNodes[7].value;
			$.confirm({
                    title: '',
                 content: 'Do you want to delete this question paper?',
                 buttons: {
                       Yes: function () {
                          $.ajax({
					type: "post",
         				url:"<?php echo base_url(); ?>Questions/DeleteLiveQuestionPaper", //the page containing php script
           				data: {QuePaperID:QuePaperID},
            				success:function(data)
					{
					        window.location.href = '<?php echo base_url(); ?>Questions/AdminHomePage';
					},
					 error:function()
        			        {
        			         	 //alert('fail');
        			       	 }
					});
                     },
                     No: function () {
                                 }
    }
});
		
		}
		
	function confSubmit(form) {
        $.confirm({
            title: '',
            content: 'Do you want to edit this question paper?',
            buttons: {
                Yes: function () {
                    form.submit()
                },
                No: function () {
                  
                }
            }
        });
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
		 <ul class="nav nav-tabs">
   			 <li class="active"><a data-toggle="tab" href="#live">Live Question Papers</a></li>
  			  <li><a data-toggle="tab" href="#deleted">Deleted Question Papers</a></li>
  			  <li><a data-toggle="tab" href="#drafted">Drafted Question Papers</a></li>
  		</ul>
		<div class="tab-content">
			<div class="container tab-pane fade in active" style="margin-top:10px;" id="live">	
				<div class="row" style="margin-top:20px;">
				    <div style="overflow-x:auto;">	
					<table class="table table-bordered">
					    <thead>
						<tr class="tablerow" style="background-color:#F8F8F8;">
								<th class="text-center">No</th>
								<th class="text-center">Question Paper Name</th>
								<th class="text-center">Date</th>
								<th class="text-center">Open / View</th>
								<th class="text-center">Delete</th>
						</tr>
					    </thead>
					    <tbody>
					<?php
					$no=1;
						foreach($QuestionPaper as $qp)
						{
							if($qp->IsDelete=='0' && $qp->IsLive=='1')
							{			
					?>	
						<form method="post" action="<?php echo site_url() ?>Questions/UserList">
						<tr>
							<td><p class="qp"><?php echo $no; ?></p></td>
							<td><p class="qp"><?php echo $qp->Title; ?></p></td>
							<input type="hidden" name="qp_name" value="<?php echo $qp->Title; ?>">
							<input type="hidden" id="qp_id" value="<?php echo $qp->QuePaperID; ?>">
							<td><p class="qp"><?php $originalDate =$qp->Date; 
							echo $newDate = date("d-m-Y", strtotime($originalDate));?></p></td>
							<td class="text-center"><input type="submit" name="open" class="btn btn-link" value="Open" style="font-size:18px;"></td>
							<td class="text-center"><a onclick="delete_paper(this);"><i class="glyphicon glyphicon-trash" style="font-size:20px;margin-top:10px;color:blue;"></a></td>
					
						</tr>
					<?php
						$no++;
					?>
						</form>
					<?php
							}
						
						}	
					?>
				    </tbody>
					</table>
					</div>
				</div>
			</div>
			<div class="container tab-pane fade" style="margin-top:10px;" id="deleted">	
				<div class="row" style="margin-top:20px;">
				     <div style="overflow-x:auto;">	
					<table class="table table-bordered">
						<tr class="tablerow" style="background-color:#F8F8F8;">
							<th class="text-center">No</th>
							<th class="text-center">Question Paper Name</th>
							<th class="text-center">Date</th>
							<th class="text-center">View Report</th>
						</tr>
					
					<?php
					$no1=1;
						foreach($QuestionPaper as $qp)
						{
							if($qp->IsDelete=='1')
							{
					
					?>	
						<form method="post" action="<?php echo site_url() ?>Questions/DeletedQuestionPaperReport">
							<tr>
								<td><p class="qp"><?php echo $no1; ?></p></td>
								<td><p class="qp"><?php echo $qp->Title; ?></p></td>
								<input type="hidden" name="qp_name" value="<?php echo $qp->Title; ?>">
								<input type="hidden" name="qp_id" value="<?php echo $qp->QuePaperID; ?>">
								<td><p class="qp"><?php $originalDate =$qp->Date; 
								echo $newDate = date("d-m-Y", strtotime($originalDate));?></p></td>
								<td class="text-center"><input type="submit" name="report" class="btn btn-link" value="Report" style="font-size:18px;"></td>
					
							</tr>
					<?php
						$no1=$no1+1;
					?>
						</form>
					<?php
							}
					
						}
					?>
				
					</table>
					</div>
				</div>
			</div>
			<div class="container tab-pane fade" style="margin-top:10px;" id="drafted">	
				<div class="row" style="margin-top:20px;">
				     <div style="overflow-x:auto;">	
					<table class="table table-bordered">
						<tr class="tablerow" style="background-color:#F8F8F8;">
							<th class="text-center">No</th>
							<th class="text-center">Question Paper Name</th>
							<th class="text-center">Date</th>
							<th class="text-center">Open / View</th>
						</tr>
					
					<?php
					$no2=1;
						foreach($QuestionPaper as $qp)
						{
							if($qp->IsLive=='0' && $qp->IsDelete=='0')
							{
					
					?>	
						<form method="post" id="draftForm" action="<?php echo site_url() ?>Questions/DraftedQuestionPapers">
							<tr>
							<td><p class="qp"><?php echo $no2; ?></p></td>
							<td><p class="qp"><?php echo $qp->Title; ?></p></td>
							<input type="hidden" name="qp_name" value="<?php echo $qp->Title; ?>">
							<input type="hidden" name="qp_id" value="<?php echo $qp->QuePaperID; ?>">
							<td><p class="qp"><?php $originalDate =$qp->Date; 
							echo $newDate = date("d-m-Y", strtotime($originalDate));?></p></td>
							<td class="text-center"><input type="button"  name="open" class="btn btn-link" value="Open" style="font-size:18px;" onClick="confSubmit(this.form);"></td>
					
							</tr>
					<?php
						$no2++;
					?>
						</form>
					<?php
							}
				
						}
					?>
				
				</table>
				</div>
			</div>
		</div>
		</div>		
		<div class="container">
			<nav class="mynav"> 
  		 <a class="buttons" tooltip="create question paper" style="background-image:url('<?php echo base_url() ?>/assets/images/create Q paper icon.png');" href="<?php echo site_url() ?>Questions/CreateQuestionPaper"></a>

  			</nav>
		</div>
			
	</body>
</html>
