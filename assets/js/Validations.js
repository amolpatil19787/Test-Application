		   function isValidEmailAddress(emailAddress) 
		    {
                var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
                return pattern.test(emailAddress);
            }
            
            
            //login
            
			function validateLogin(obj)
			{
			    debugger;
			    
				if(document.getElementById('emailid').value=="")
				{
					document.getElementById('emailid').focus();
				        	$.alert({
				        	    title: '',
                         content: 'Please enter email!'
                    });
				   
					return false;
					
				}
		    	if( !isValidEmailAddress(document.getElementById('emailid').value) )
                { 
                    $('#email').focus();
                    $.alert({
				            title: '',
                            content: 'Please enter valid email!'
                    });
                    return false;
                    
                }
				if(document.getElementById('pass').value=="")
				{
						document.getElementById('pass').focus();
					$.alert({
					     title: '',
                         content: 'Please enter password!',
                    });
                    
                        
				        	return false;
				}
				else
				{
				    var email=$('#emailid').val();
				    var password=$('#pass').val();
				    
				    $.ajax({
					type: "post",
         				url:"http://www.test.acquiscent.com/Questions/GetUserDataForLogin", //the page containing php script
           				data: {email:email,password:password},
            				success:function(data)
				        	{
				        	  
				        	   var btnid=obj.id;
				        	    
				        	    var arr =JSON.parse(data);
				        	    
				        	     var SuperAdminCount = arr["SuperAdminCount"];
				        	     var SuperAdminEmail = arr["SuperAdminEmail"];
				        	     var SuperAdminID = arr["SuperAdminID"];
				        	     var ActiveAdminCount = arr["ActiveAdminCount"];
				        	     var AdminCount = arr["AdminCount"];
				        	     var AdminEmail = arr["AdminEmail"];
				        	     var AdminPass = arr["AdminPass"];
				        	     var AdminID = arr["AdminID"];
				        	     var UserCount=arr["UserCount"];
				        	     var UserEmail = arr["UserEmail"];
				        	     var UserID = arr["UserID"];
				        	     var AdminIDUsertbl = arr["AdminIDUsertbl"];
				        	     var ExamCoOrdinatorCount=arr["ExamCoOrdinatorCount"];
				        	     var ExamCoID=arr["ExamCoID"];
				        	     var ExamCoEmail=arr["ExamCoEmail"];
				        	     
				        	      //alert(AdminCount);
				        	      if(SuperAdminCount==1 && ActiveAdminCount==0 && UserCount==0)
				        	      {
				        	          window.location.href = 'http://www.test.acquiscent.com/Questions/Login?SuperAdminCount='+SuperAdminCount+'&SuperAdminID='+SuperAdminID+'&SuperAdminEmail='+SuperAdminEmail+'&btnid='+btnid+'&ActiveAdminCount='+ActiveAdminCount+'&UserCount='+UserCount;
				        	      }
                                  else if(UserCount==1 && SuperAdminCount==0 && ActiveAdminCount==0)
                                  {
                                    window.location.href = 'http://www.test.acquiscent.com/Questions/Login?UserCount='+UserCount+'&UserEmail='+UserEmail+'&UserID='+UserID+'&AdminIDUsertbl='+AdminIDUsertbl+'&btnid='+btnid+'&SuperAdminCount='+SuperAdminCount+'&ActiveAdminCount='+ActiveAdminCount;    
                                  }
                                  else if(AdminCount==1 && UserCount==0 && SuperAdminCount==0)
                                  {
                                      if(ActiveAdminCount==1 && SuperAdminCount==0 && UserCount==0)
                                      {
                                          window.location.href = 'http://www.test.acquiscent.com/Questions/Login?ActiveAdminCount='+ActiveAdminCount+'&AdminEmail='+AdminEmail+'&AdminID='+AdminID+'&btnid='+btnid+'&UserCount='+UserCount+'&SuperAdminCount='+SuperAdminCount;  
                                      }
                                      else
                                      {
                                          $.alert({
					                       title: '',
                                         content: 'Sorry you are not active!',
                                         });
				                    	return false;
                                      }
                                  }
                                  else if(ExamCoOrdinatorCount==1 && SuperAdminCount==0 && ActiveAdminCount==0 && UserCount==0)
                                  {
                                        window.location.href = 'http://www.test.acquiscent.com/Questions/Login?ExamCoOrdinatorCount='+ExamCoOrdinatorCount+'&ExamCoID='+ExamCoID+'&ExamCoEmail='+ExamCoEmail+'&btnid='+btnid;  
                                  }
                                  else
                                  {
                                      $.alert({
					                       title: '',
                                         content: 'Username or password is incorrect!',
                                         });
				                    	return false;
                                  }
				        	},
				        	 error:function()
        			        {
        			         	 //alert('fail');
        			       	 }
					});
				}
			}
			
			
			//registration
			
			function validateRegistration(obj)
			{
			    debugger;
			    
				if(document.getElementById('emailid').value=="")
				{
				    document.getElementById('emailid').focus();
				        	$.alert({
				        	    title: '',
                         content: 'Please enter email!'
                    });
				   
					return false;
				}
		      if( !isValidEmailAddress(document.getElementById('emailid').value) )
                { 
                    $('#emailid').focus();
                    $.alert({
				            title: '',
                            content: 'Please enter valid email!'
                    });
                    return false;
                    
                }
		        	
		    		var response = grecaptcha.getResponse();
                     if (response.length === 0) {
                        $.alert({
				        	    title: '',
                         content: 'Please fill the captcha!'
                    });
                     // alert("You need to fill the captcha");
                          return false;
                  }
                  
                  var email=$('#emailid').val();
                  var adminid=$('#AdminID :selected').val();
                  var btnid=obj.id;
                  
                  $.ajax({
					type: "post",
         				url:"http://www.test.acquiscent.com/Questions/AdminData", //the page containing php script
           				data: {email:email,adminid:adminid},
            				success:function(data)
					        {
					              
					              var arr =JSON.parse(data);
					               
					               var EmailCount = arr["EmailCount"];
					               var UsersPerAdmin = arr["UsersPerAdmin"];
					               var NoOfUsers = arr["NoOfUsers"];
					               
					               
					               if(UsersPerAdmin>=NoOfUsers)
					               {
					                    $.alert({
				                    	    title: '',
                                             content: 'You cannot do registration for this admin!'
                                          }); 
					               }
					               else if(EmailCount>=1)
					               {
					                   $.alert({
				                    	    title: '',
                                             content: 'This email id already exists'
                                          }); 
					               }
					               else
					               {
					                   
					                   
					                  $.ajax({
		                    			type: "post",
         			                	url:"http://www.test.acquiscent.com/Questions/UserRegistration", //the page containing php script
                           				data: {email:email,adminid:adminid,btnid:btnid},
            	            			success:function(data)
					                    {
					                     //   alert('hello');
					                     var msgbody="<html><div style='background-color:lightgray;padding:5%;width:50%;margin:20px 20%;'><h2>Hello "+email+",</h2><h3>Thanks for contacting regarding to forgot password,</h3><h3>Click here to <a href='https://www.test.acquiscent.com//Questions/ResetPassword?UserID="+data+"'><b>Reset Password</b></a></h3></div></html>";
					                        
					                        $.ajax({
                                       type: "POST",
                                          url:"http://autokattawebapi.us-east-2.elasticbeanstalk.com//api/AutoKattaWebService/MailCode?ToMail="+email+"&Subject=Reset Password&msgBody="+msgbody+"&temp=&fileName=&Keyword=", 
                                          //the page containing php script
                                          success:function()
                                         {
                                                 $.confirm({
                                                 title: '',
                                                 content: 'You are register successfully please check your mail to reset password!',
                                                    buttons: {
                                                     Ok: function () {
                                                     window.location.href = 'http://www.test.acquiscent.com/Questions/Login';
                                                     }
                                                 }
                                                    });
                                          },
                                              error:function()
                                             {
                                    $.confirm({
                                       title: '',
                                        content: 'You are register successfully please check your mail to reset password!',
                                        buttons: {
                                        Ok: function () {
                                             window.location.href = 'http://www.test.acquiscent.com/Questions/Login';
                                          }
                                          }
                                         });
                               }
                                });
                                    	},
		                    			 error:function()
        			                    {
        		            	         	 //alert('fail');
        			       	            }
				                    	});
					               }
				        	},
					 error:function()
        			        {
        			         	 //alert('fail');
        			       	 }
					});
			}
			
			
			
			//forgot 
			
			 function validateForgotPass(btn)
	         {
	        debugger;
	        var response = grecaptcha.getResponse();
	        var email=$('#emailid').val();
	        
	        if(email=="")
	        {
	            $('#emailid').focus();
	            $.alert({
					     title: '',
                         content: 'Please enter email!',
                    });
					
					return false;
	        }
	        else if( !isValidEmailAddress(email) )
            { 
                    $('#emailid').focus();
                    $.alert({
				            title: '',
                            content: 'Please enter valid email!'
                    });
                    return false;
                    
            }
	        else if (response.length === 0)
	        {
                        $.alert({
				        	    title: '',
                         content: 'Please fill the captcha!'
                    });
                     // alert("You need to fill the captcha");
                          return false;
            } 
            else
            {
                 $.ajax({
                	type: "POST",
                	url: 'http://www.test.acquiscent.com/Questions/ForgotPasswordMail',
                	data: {email:email},
                	success:function(data)
                	{
        		            var arr = JSON.parse( data );
        		            
                            var AdminCount = arr["AdminCount"];
                            var EncrAdminID = arr["EncrAdminID"];
                            var AdminEmailID = arr["AdminEmailID"];
                            
                            var UserCount = arr["UserCount"];
                            var EncrUserID = arr["EncrUserID"];
                            var UserEmailID = arr["UserEmailID"];
                            
                            var ExamCoCount = arr["ExamCoCount"];
                            var EncrExamCoID = arr["EncrExamCoID"];
                            var ExamcoEmailID = arr["ExamcoEmailID"];
                            
                            var SuperAdminCount = arr["SuperAdminCount"];
                            var EncrSuperAdminID = arr["EncrSuperAdminID"];
                            var SuperAdminEmailID = arr["SuperAdminEmailID"];
                           
                            var btnid=btn.id;
                    
                            if(AdminCount==1)
                            {
                                var Adminmsgbody="<html><div style='background-color:lightgray;padding:5%;width:50%;margin:20px 20%;'><h2>Hello "+AdminEmailID+",</h2><h3>Thanks for contacting regarding to forgot password,</h3><h3>Click here to <a href='https://www.test.acquiscent.com//Questions/ResetPassword?AdminID="+EncrAdminID+"'><b>Reset Password</b></a></h3></div></html>";
                                
                                $.ajax({
                                type: "post",
                                url:"http://autokattawebapi.us-east-2.elasticbeanstalk.com//api/AutoKattaWebService/MailCode?ToMail="+AdminEmailID+"&Subject=Reset Password&msgBody="+Adminmsgbody+"&temp=&fileName=&Keyword=", //the page containing php script

                                    success:function()
                                    {
                                     $.confirm({
                                       title: '',
                                        content: 'Please check your mail to reset password!',
                                        buttons: {
                                        Ok: function () {
                                             window.location.href = 'http://www.test.acquiscent.com/Questions/Login';
                                          }
                                          }
                                         });
                                   },
                                     error:function()
                                      {
                                    $.confirm({
                                       title: '',
                                        content: 'Please check your mail to reset password!',
                                        buttons: {
                                        Ok: function () {
                                             window.location.href = 'http://www.test.acquiscent.com/Questions/Login';
                                          }
                                          }
                                         });
                                     }
                                });
                            }
                            
                            if(UserCount==1)
                            {
                                var Usermsgbody="<html><div style='background-color:lightgray;padding:5%;width:50%;margin:20px 20%;'><h2>Hello "+UserEmailID+",</h2><h3>Thanks for contacting regarding to forgot password,</h3><h3>Click here to <a href='https://www.test.acquiscent.com//Questions/ResetPassword?UserID="+EncrUserID+"'><b>Reset Password</b></a></h3></div></html>";
                                
                                $.ajax({
                                type: "post",
                                url:"http://autokattawebapi.us-east-2.elasticbeanstalk.com//api/AutoKattaWebService/MailCode?ToMail="+UserEmailID+"&Subject=Reset Password&msgBody="+Usermsgbody+"&temp=&fileName=&Keyword=", //the page containing php script

                                    success:function()
                                    {
                                     $.confirm({
                                       title: '',
                                        content: 'Please check your mail to reset password!',
                                        buttons: {
                                        Ok: function () {
                                             window.location.href = 'http://www.test.acquiscent.com/Questions/Login';
                                          }
                                          }
                                         });
                                   },
                                     error:function()
                                      {
                                    $.confirm({
                                       title: '',
                                        content: 'Please check your mail to reset password!',
                                        buttons: {
                                        Ok: function () {
                                             window.location.href = 'http://www.test.acquiscent.com/Questions/Login';
                                          }
                                          }
                                         });
                                     }
                                });
                            }
                            
                            if(ExamCoCount==1)
                            {
                                var ExamComsgbody="<html><div style='background-color:lightgray;padding:5%;width:50%;margin:20px 20%;'><h2>Hello "+ExamcoEmailID+",</h2><h3>Thanks for contacting regarding to forgot password,</h3><h3>Click here to <a href='https://www.test.acquiscent.com//Questions/ResetPassword?ExamCoordinatorID="+EncrExamCoID+"'><b>Reset Password</b></a></h3></div></html>";
                                
                                $.ajax({
                                type: "post",
                                url:"http://autokattawebapi.us-east-2.elasticbeanstalk.com//api/AutoKattaWebService/MailCode?ToMail="+ExamcoEmailID+"&Subject=Reset Password&msgBody="+ExamComsgbody+"&temp=&fileName=&Keyword=", //the page containing php script

                                    success:function()
                                    {
                                     $.confirm({
                                       title: '',
                                        content: 'Please check your mail to reset password!',
                                        buttons: {
                                        Ok: function () {
                                             window.location.href = 'http://www.test.acquiscent.com/Questions/Login';
                                          }
                                          }
                                         });
                                   },
                                     error:function()
                                      {
                                    $.confirm({
                                       title: '',
                                        content: 'Please check your mail to reset password!',
                                        buttons: {
                                        Ok: function () {
                                             window.location.href = 'http://www.test.acquiscent.com/Questions/Login';
                                          }
                                          }
                                         });
                                     }
                                });
                            }
                            
                            if(SuperAdminCount==1)
                            {
                                var SuperAdminmsgbody="<html><div style='background-color:lightgray;padding:5%;width:50%;margin:20px 20%;'><h2>Hello "+SuperAdminEmailID+",</h2><h3>Thanks for contacting regarding to forgot password,</h3><h3>Click here to <a href='https://www.test.acquiscent.com//Questions/ResetPassword?SuperAdminID="+EncrSuperAdminID+"'><b>Reset Password</b></a></h3></div></html>";
                                
                                $.ajax({
                                type: "post",
                                url:"http://autokattawebapi.us-east-2.elasticbeanstalk.com//api/AutoKattaWebService/MailCode?ToMail="+SuperAdminEmailID+"&Subject=Reset Password&msgBody="+SuperAdminmsgbody+"&temp=&fileName=&Keyword=", //the page containing php script

                                    success:function()
                                    {
                                     $.confirm({
                                       title: '',
                                        content: 'Please check your mail to reset password!',
                                        buttons: {
                                        Ok: function () {
                                             window.location.href = 'http://www.test.acquiscent.com/Questions/Login';
                                          }
                                          }
                                         });
                                   },
                                     error:function()
                                      {
                                    $.confirm({
                                       title: '',
                                        content: 'Please check your mail to reset password!',
                                        buttons: {
                                        Ok: function () {
                                             window.location.href = 'http://www.test.acquiscent.com/Questions/Login';
                                          }
                                          }
                                         });
                                     }
                                });
                            }
                    
                     if(AdminCount==0 && UserCount==0 && ExamCoCount==0 && SuperAdminCount==0)
                            {
                             
                                $('#emailid').focus();   
                                $.alert({
					                 title: '',
                                     content: 'Please re enter email!',
                                    });
                                         
                                         $('#emailid').val('');
                                         return false;
                                
                            }
                	},
                    error:function()
                    {
                        alert('fail');
                    }
                   });
            }
	    }
	    
	        //reset user password
	        
	        function ResetPassword(btn)
		    {
		        var btnid=btn.id;
		        var UserID=$('#userid').val();
		        var ExamCoID=$('#ExamCoID').val();
		        var AdminID=$('#AdminID').val();
		        var SuperAdminID=$('#SuperAdminID').val();
		        var pass=$('#pass').val();
		        
		      //  alert(UserID);
		        if($('#pass').val()=="")
		        {
		                           $('#pass').focus();
                                     $.alert({
					                 title: '',
                                     content: 'Please enter password!',
                                    });
                    return false;
		        }
		        else if($('#pass1').val()=="")
		        {
		             $('#pass1').focus();
                                     $.alert({
					                 title: '',
                                     content: 'Please enter confirm password!',
                                    });
                    return false;
		        }
		       else if($('#pass').val() != $('#pass1').val())
		        {
		             $('#pass1').focus();
                                     $.alert({
					                 title: '',
                                     content: 'Please enter correct password!',
                                    });
                    return false;   
		        }
		        else
		        {
		             if(UserID!="")
		             {
		            $.ajax({
					type: "post",
         				url:"https://www.test.acquiscent.com/Questions/ResetUserPassword", //the page containing php script
           				data: {btnid:btnid,UserID:UserID,pass:pass},
            				success:function(data)
				        	{
				        	 //   alert(data);
				        	    
					           $.confirm({
                                title: '',
                             content: 'Your password has been reset successfully!',
                              buttons: {
                                 Ok: function () {
                                     window.location.href = 'http://www.test.acquiscent.com/Questions/Login';
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
		             
		             if(ExamCoID!=null)
		             {
		                    $.ajax({
			        		type: "post",
         		    		url:"https://www.test.acquiscent.com/Questions/ResetExamCoPassword", //the page containing php script
           		    		data: {btnid:btnid,ExamCoID:ExamCoID,pass:pass},
            				success:function(data)
				        	{
				        	 //   alert(data);
				        	    
					           $.confirm({
                                title: '',
                             content: 'Your password has been reset successfully!',
                              buttons: {
                                 Ok: function () {
                                     window.location.href = 'http://www.test.acquiscent.com/Questions/Login';
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
		             if(AdminID!=null)
		             {
		                    $.ajax({
			        		type: "post",
         		    		url:"https://www.test.acquiscent.com/Questions/ResetAdminPassword", //the page containing php script
           		    		data: {btnid:btnid,AdminID:AdminID,pass:pass},
            				success:function(data)
				        	{
				        	 //   alert(data);
				        	    
					           $.confirm({
                                title: '',
                             content: 'Your password has been reset successfully!',
                              buttons: {
                                 Ok: function () {
                                     window.location.href = 'http://www.test.acquiscent.com/Questions/Login';
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
		             if(SuperAdminID!=null)
		             {
		                 $.ajax({
			        		type: "post",
         		    		url:"https://www.test.acquiscent.com/Questions/ResetSuperAdminPassword", //the page containing php script
           		    		data: {btnid:btnid,SuperAdminID:SuperAdminID,pass:pass},
            				success:function(data)
				        	{
				        	 //   alert(data);
				        	    
					           $.confirm({
                                title: '',
                             content: 'Your password has been reset successfully!',
                              buttons: {
                                 Ok: function () {
                                     window.location.href = 'http://www.test.acquiscent.com/Questions/Login';
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
		        }
		    }
		    
		    
		    
		    //reset admin password
		    
		     function validateResetAdminPass(btn)
		    {
		        var btnid=btn.id;
		        var AdminID=$('#userid').val();
		        var pass=$('#pass').val();
		        
		      //  alert(UserID);
		        if($('#pass').val()=="")
		        {
		                           $('#pass').focus();
                                     $.alert({
					                 title: '',
                                     content: 'Please enter password!',
                                    });
                    return false;
		        }
		        else if($('#pass1').val()=="")
		        {
		             $('#pass1').focus();
                                     $.alert({
					                 title: '',
                                     content: 'Please enter confirm password!',
                                    });
                    return false;
		        }
		       else if($('#pass').val() != $('#pass1').val())
		        {
		             $('#pass1').focus();
                                     $.alert({
					                 title: '',
                                     content: 'Please enter correct password!',
                                    });
                    return false;   
		        }
		        else
		        {
		               
		            $.ajax({
					type: "post",
         				url:"http://www.test.acquiscent.com/Questions/ResetPasswordA", //the page containing php script
           				data: {btnid:btnid,AdminID:AdminID,pass:pass},
            				success:function(data)
				        	{
				        	 //   alert(data);
				        	    
					           $.confirm({
                                title: '',
                             content: 'Your password has been reset successfully!',
                              buttons: {
                                 Ok: function () {
                                     window.location.href = 'http://www.test.acquiscent.com/Questions/Login';
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
		    }
		    
		    
		    //super admin
		    
		    function validateNewAdmin()
            {
                    debugger;
                    
                if($('#email').val()=="")
                {
                    $('#email').focus();
                    $.alert({
				            title: '',
                            content: 'Please enter email!'
                    });
                    return false;
                }
                if($('#displayName').val()=="")
                {
                    $('#displayName').focus();
                    $.alert({
				            title: '',
                            content: 'Please enter display name!'
                    });
                    return false;
                }
                if($('#noOfUsers').val()=="")
                {
                    $('#noOfUsers').focus();
                    $.alert({
				            title: '',
                            content: 'Please enter number of users!'
                    });
                    return false;
                }
                if( !isValidEmailAddress($('#email').val() ) )
                { 
                    $('#email').focus();
                    $.alert({
				            title: '',
                            content: 'Please enter valid email!'
                    });
                    return false;
                    
                }
                else
                {
                   var Email=$('#email').val();
                    var DisplayName=$('#displayName').val();
                    var noOfUsers=$('#noOfUsers').val();
                    
                        $.ajax({
		    			type: "post",
         				url:"http://www.test.acquiscent.com/Questions/SaveAdminDetails", //the page containing php script
           				data: {Email:Email,DisplayName:DisplayName,noOfUsers:noOfUsers},
            				success:function(data)
				        	{
				        	   // alert(data);
				        	  var arr=JSON.parse(data);
				        	    
				        	    
				        	     var EmailCount = arr["count"];
				        	     var AdminID = arr["AdminID"];
				        	   
				        	     
				        	     if(EmailCount==1)
					              {
					                   $('#email').focus();
                                       $.alert({
				                          title: '',
                                         content: 'This email id is already present!'
                                    });
                                       //  return false;
					              }
					              else
					              {
					                  var msgbody="<html><div style='background-color:lightgray;padding:5%;width:50%;margin:20px 20%;'><h2>Hello "+Email+",</h2><h3>Thanks for contacting regarding to forgot password,</h3><h3>Click here to <a href='https://www.test.acquiscent.com//Questions/ResetPassword?AdminID="+AdminID+"'><b>Reset Password</b></a></h3></div></html>";
					                  
					                  $.ajax({
                                            type: "POST",
                                              url:"http://autokattawebapi.us-east-2.elasticbeanstalk.com//api/AutoKattaWebService/MailCode?ToMail="+Email+"&Subject=Reset Password&msgBody="+msgbody+"&temp=&fileName=&Keyword=", 
                                          //the page containing php script
                                             success:function()
                                            {
                                                $.confirm({
                                                 title: '',
                                                 content: 'You are register successfully please check your mail to reset password!',
                                                    buttons: {
                                                     Ok: function () {
                                                     window.location.href = 'http://www.test.acquiscent.com/Questions/SuperAdminHomePage';
                                                     }
                                                 }
                                                    });
                                            },
                                              error:function()
                                             {
                                                 $.confirm({
                                                 title: '',
                                                 content: 'You are register successfully please check your mail to reset password!',
                                                    buttons: {
                                                     Ok: function () {
                                                     window.location.href = 'http://www.test.acquiscent.com/Questions/SuperAdminHomePage';
                                                     }
                                                 }
                                                    });
                                             }
                                           });
					              }
				        	}
				        	,
				        	 error:function()
        			        {
        			         	 //alert('fail');
        			       	 }
					});
                }
            }
		    
		    
		    //exam coordinator
		    
		    function validateExamCoordinator()
		    {
		        
		        if($('#ExamCemail').val()=="")
                {
                    $('#ExamCemail').focus();
                    $.alert({
				            title: '',
                            content: 'Please enter email!'
                    });
                    return false;
                }
                else if( !isValidEmailAddress($('#ExamCemail').val()) )
                { 
                    $('#ExamCemail').focus();
                    $.alert({
				            title: '',
                            content: 'Please enter valid email!'
                    });
                    return false;
                    
                }
                else
                {
                    var email=$('#ExamCemail').val();
                    var adminid=$('#AdminID :selected').val();
                    var displayExamCoName=$('#displayExamCoName').val();
                    
                    $.ajax({
					type: "post",
         				url:"http://www.test.acquiscent.com/Questions/SaveExamCoordinatorData", //the page containing php script
           				data: {email:email,displayExamCoName:displayExamCoName,adminid:adminid},
            				success:function(data)
				        	{
					           //alert(data);
					           
					            var arr=JSON.parse(data);
					            
					            var count= arr["count"];
					            var ExamCoID=arr["ExamCoID"];
					            
					            if(count>=1)
					            {
					                      $.alert({
				                    	    title: '',
                                             content: 'This email id already exists'
                                          });
					            }
					            else
					            {
					                var msgbody="<html><div style='background-color:lightgray;padding:5%;width:50%;margin:20px 20%;'><h2>Hello "+email+",</h2><h3>Thanks for contacting regarding to forgot password,</h3><h3>Click here to <a href='https://www.test.acquiscent.com//Questions/ResetPassword?ExamCoordinatorID="+ExamCoID+"'><b>Reset Password</b></a></h3></div></html>";
					                  
					                  $.ajax({
                                            type: "POST",
                                              url:"http://autokattawebapi.us-east-2.elasticbeanstalk.com//api/AutoKattaWebService/MailCode?ToMail="+email+"&Subject=Reset Password&msgBody="+msgbody+"&temp=&fileName=&Keyword=", 
                                          //the page containing php script
                                             success:function()
                                            {
                                                $.confirm({
                                                 title: '',
                                                 content: 'You are register successfully please check your mail to reset password!',
                                                    buttons: {
                                                     Ok: function () {
                                                     window.location.href = 'http://www.test.acquiscent.com/Questions/SuperAdminHomePage';
                                                     }
                                                 }
                                                    });
                                            },
                                              error:function()
                                             {
                                                 $.confirm({
                                                 title: '',
                                                 content: 'You are register successfully please check your mail to reset password!',
                                                    buttons: {
                                                     Ok: function () {
                                                     window.location.href = 'http://www.test.acquiscent.com/Questions/SuperAdminHomePage';
                                                     }
                                                 }
                                                    });
                                             }
                                           });
					            }
					            
				        	},
					         error:function()
        			        {
        			         	 //alert('fail');
        			       	 }
					});
                }
		    }