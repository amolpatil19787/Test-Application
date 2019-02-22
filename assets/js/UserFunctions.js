    //user test
    
    function SubmitForm(btn)
	    {
	       
	        
	        var que_paper_id=btn.parentElement.parentElement.childNodes[3].value;
	        var qpname=btn.parentElement.parentElement.childNodes[7].value;
	        var btnid=btn.id;
	      $.ajax({
					type: "post",
         				url:"http://www.test.acquiscent.com/Questions/QuestionPaper", //the page containing php script
           				data:{que_paper_id:que_paper_id,btnid:btnid},
            				success:function(data)
				        	{
					       // alert(data);
					         debugger;
					       
					        var arr = JSON.parse( data );
                            var count = arr["count"];
                            var QuePaperid = arr["QuePaperid"];
					        if(count>=1)
					        {
					             //$('#test').focus();
					            $.confirm({title:"",content:"You have already solved this question paper",
                              buttons: {
                               Ok: function () {
                                       $(this).confirm("close");    
                           
                              }}});
                                       
					        }
					        else
					        {
					             $('#myform').attr('action','http://www.test.acquiscent.com/Questions/Test/'+QuePaperid+'');
					            $('#myform').submit();
					        }
					        
					},
					 error:function()
        			        {
        			         	 //alert('fail');
        			       	 }
					});
	    }
	    
	    
    //user result
    
    function SubmitFormResult(btn)
	    {
	        debugger;
	         var que_paper_id=btn.parentElement.parentElement.childNodes[3].value;
	        var qpname=btn.parentElement.parentElement.childNodes[7].value;
	        var btnid=btn.id;
	      $.ajax({
					type: "post",
         				url:"http://www.test.acquiscent.com/Questions/QuestionPaper", //the page containing php script
           				data:{que_paper_id:que_paper_id,btnid:btnid},
            				success:function(data)
				        	{
					       // alert(data);
					        
					        var arr = JSON.parse( data );
                            var count = arr["count"];
                            var marks=arr['Marks'];
                            var Markscount=arr['Markscount'];
                             var QuePaperid = arr["QuePaperid"];
					        if(count==0)
					        {
					            $.confirm({title:"",content:"Please solve question paper first",
                              buttons: {
                               Ok: function () {
                                    $(this).confirm("close");   
                           
                              }}});
					        }
					        else if(marks==null)
					        {
					            $.confirm({title:"",content:"Your question paper is not checked yet",
                              buttons: {
                               Ok: function () {
                                     $(this).confirm("close");   
                           
                              }}});
					        }
				            else
					        {
					             $('#myform').attr('action','http://www.test.acquiscent.com/Questions/UserResult/'+QuePaperid+'')
					            $('#myform').submit();
					        }
					        
					},
					 error:function()
        			        {
        			         	 //alert('fail');
        			       	 }
					});
	    }
	    
	    
	  
   