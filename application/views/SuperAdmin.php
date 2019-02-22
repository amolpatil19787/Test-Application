<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>/assets/js/Validations.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
        
        <title>QUESTION & ANSWER</title>
        <link rel="icon" type="image/ico" href="<?php echo base_url() ?>/assets/images/logo.png" width="800px;" />
        
        <script>
            function isNumberKey(evt){
              var charCode = (evt.which) ? evt.which : evt.keyCode
             if (charCode > 31 && (charCode < 48 || charCode > 57))
               return false;
             return true;
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
     			<a href="<?php echo site_url() ?>Questions/SuperAdminHomePage"><img class="logo" src="<?php echo base_url() ?>/assets/images/logo2.png" width="225" height="35" style="margin:10px 15px;"></a>
    		</div>
   </div>
   
   <div class = "collapse navbar-collapse" id = "example-navbar-collapse">
	
      <ul class="nav navbar-nav navbar-right">
         <li><a style="color:#23527c;"><?php echo $this->session->userdata('SuperAdminEmail'); ?></a></li>
         <li><a style="color:#23527c;" href = "<?php echo site_url() ?>/Questions/Logout">Logout</a></li>
      </ul>
   </div>
   
</nav>
        <div class="container" style="margin-bottom:20px;">
            <div class="col-lg-12"> 
                 <a href="#" data-toggle="modal" data-target="#modalRegister" class="btn btn-primary"><i class="fa fa-user"></i> New Admin</a>
                 <a href="#" data-toggle="modal" data-target="#modalExamCoordinator" class="btn btn-primary"><i class="fa fa-user"></i> New Exam Coordinator</a>
            </div>
            
            <div id="modalRegister" class="modal fade" role="dialog" style="top:20%;">
             <div class="modal-dialog">
             <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title" style="text-align-last: center">Add Admin</h4>
                 </div>
                    <div class="modal-body">
                            <div class="container">
                                <div class="col-lg-12">
                                        <form class="form-horizontal">
                                    <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">Email ID:</label>
                                    <div class="col-sm-3"> 
                                      <input type="text" id="email" class="form-control" name="Email" placeholder="Enter Email" autofocus>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                       <label class="col-sm-2 control-label">Display Name:</label>
                                      <div class="col-sm-3">
                                       <input type="text" class="form-control" id="displayName" name="DisplayName" placeholder="Enter display name">
                                        </div>
                                    </div>
                                      <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">No of users:</label>
                                    <div class="col-sm-3"> 
                                      <input type="text" class="form-control" id="noOfUsers" name="UserNo" placeholder="Enter no of users" onkeypress="return isNumberKey(event)">
                                        </div>
                                      </div>
                                      <div class="form-group"> 
                                        <div class="col-sm-offset-2 col-sm-10">
                                          <button type="button" onclick="validateNewAdmin();" id="submitbtn" class="btn btn-primary">Submit</button>
                                        </div>
                                      </div>
                                    </form>
                                </div>
                            </div>
                    </div>
              </div>
            </div>
            </div>
            
            <div id="modalExamCoordinator" class="modal fade" role="dialog" style="top:20%;">
             <div class="modal-dialog">
             <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title" style="text-align-last: center">Add Exam Coordinator</h4>
                 </div>
                    <div class="modal-body">
                            <div class="container">
                                <div class="col-lg-12">
                                        <form class="form-horizontal">
                                    <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">Email ID:</label>
                                    <div class="col-sm-3"> 
                                      <input type="text" id="ExamCemail" class="form-control" name="Email" placeholder="Enter Email" autofocus>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                       <label class="col-sm-2 control-label">Display Name:</label>
                                      <div class="col-sm-3">
                                       <input type="text" class="form-control" id="displayExamCoName" name="DisplayName" placeholder="Enter display name">
                                        </div>
                                        </div>
                                      <div class="form-group">
                                       <label class="col-sm-2 control-label">Select Admin:</label>
                                      <div class="col-sm-3">
                                       <select class="form-control" name="AdminID" id="AdminID">
                                    <?php
                                        foreach($AdminDetails as $a)
                                       {
                                   ?>
                                            <option value="<?php echo $a->Admin_id; ?>"><?php echo $a->DisplayName; ?></option>
                                      <?php
                                        }
                                     ?>
                             </select>
                                        </div>
                                    </div>
                                      <div class="form-group"> 
                                        <div class="col-sm-offset-2 col-sm-10">
                                          <button type="button" onclick="validateExamCoordinator();" id="submitbtn" class="btn btn-primary">Submit</button>
                                        </div>
                                      </div>
                                    </form>
                                </div>
                            </div>
                    </div>
              </div>
            </div>
            </div>
            
        </div> 
         <div class="container">
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Admin Email</th>
                            <th class="text-center">Display Name</th>
                            <th class="text-center">No Of Users</th>
                            <th class="text-center">Password</th>
                            <th class="text-center">Active/Deactive</th>
                        </tr>
                        <?php
                        $no=1;
                            foreach($AdminDetails as $a)
                            {
                        ?>
                        <tr>
                                <input type="hidden" name="AdminId" value="<?php echo $a->Admin_id; ?>">
                                <td class="text-center"><?php echo $no; ?></td>     
                                <td class="text-center"><?php echo $a->EmailID; ?></td> 
                                <td class="text-center"><?php echo $a->DisplayName; ?></td> 
                                <td class="text-center"><?php echo $a->NumberOfUsers; ?></td> 
                                <td class="text-center"><?php echo $a->Password; ?></td> 
                                <td class="text-center">
                                <?php
                                    if($a->IsActive=='1')
                                    {
                                ?>
                                    <a href="<?php echo site_url() ?>Questions/SaveAdminStatus/<?php echo $a->Admin_id; ?>/<?php echo $a->IsActive; ?>" class="btn btn-primary" style="width:70%;">Active</a>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                        <a href="<?php echo site_url() ?>Questions/SaveAdminStatus/<?php echo $a->Admin_id; ?>/<?php echo $a->IsActive; ?>" class="btn btn-primary" style="width:70%;">Deactive</a>
                                <?php
                                    }
                                ?>
                                    
                                </td> 
                        </tr>
                        <?php
                            $no++;
                            }
                        ?>
                    </table>
                </div>
        </div>
    </body>
</html>