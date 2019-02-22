	submitcount=0;	
		function Validator()
		{ 
			debugger;
					
			var count=$('.counter').val();
            var total = count.split(',');
			
			var paper_name=$('#paper_name').val();

			var flag=false;	

			if(paper_name==undefined)
			{
				paper_name="";
			}

        	      
        	      var TestTypeCount=$('#headingpart').find('input[type=radio]:checked').length;
        	      var ExamCoordinator=$('#checkboxes').find('input[type=checkbox]:checked').length;
        	      
			if($('#paper_name').val()=="")
			{
			       	$('#paper_name').focus();
				$.alert({
				        	    title: '',
                         content: 'Please enter question paper name!'
                    });
				
				flag=true;
			
				return false;
			}
			else if($('#date').val()=="")
			{
				$('#date').focus();
				    	$.alert({
				        	    title: '',
                         content: 'Please enter question paper creation date!'
                    });
				flag=true;
				return false;
			}
			else if($('#markssss').val()=="")
			{
				
				$('#markssss').focus();
				$.alert({
				        	    title: '',
                         content: 'Please enter total marks!'
                    });
                    flag=true;
				return false;
			}
			else if($('#QPaperPercentage').val()=="")
			{
			    $('#QPaperPercentage').focus();
				$.alert({
				        	    title: '',
                         content: 'Please enter passing percentage!'
                    });
                    flag=true;
				return false;
			}
			else if(ExamCoordinator==0)
			{
			     $.alert({
				        	    title: '',
                         content: 'Please select Exam coordinator!'
                    });
                    flag=true;
				return false;
			}
			else if(TestTypeCount==0)
			{
			    $.alert({
				        	    title: '',
                         content: 'Please select test type!'
                    });
                    flag=true;
				return false;
			}
		
			for(var c=0;c<total.length;c++)
			{
			    if($('#multiple_form'+total[c]).is(':visible'))
			{
				var NewMultiChKCount=$('#multiple_form'+total[c]).find('input[type=checkbox]:checked').length;
				if($("#que_multi"+total[c]).val() =="")
				{
					$('#que_multi'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
					flag=true;
			    	return false;
				}
				else if($("#m_marks"+total[c]).val()=="")
				{
					
					$('#m_marks'+total[c]).focus();
						$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
					flag=true;
			    	return false;
				}
				else if($("#neg_multi"+total[c]).val()=="")
				{
					
					$('#neg_multi'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Negative marks cannot be blank!'
                    });
					flag=true;
			    	return false;
				}	
				
				    MultiansCount=$('input[id*="txtAnsMulti'+total[c]+'"]').length;
				
					for(var m=1;m<=MultiansCount;m++)
					{
						if($('#txtAnsMulti'+total[c]+'-'+m).val()=="")
						{
						
							$('#txtAnsMulti'+total[c]+'-'+m).focus();
							$.alert({
				        	    title: '',
                         content: 'Answer cannot be blank!'
                    });
								flag=true;
			            	return false;
						}
					}
				if(NewMultiChKCount<=0)
				{
					$.alert({
				        	    title: '',
                         content: 'Please select atleast one correct answer!'
                    });
					
					flag=true;
					return false;
				}
			}
			
			 if($('#descriptive_form'+total[c]).is(':visible'))
			{
				if($("#que_desc"+total[c]).val() =="")
				{
					
					$('#que_desc'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
                    flag=true;
			    	return false;
				}
				else if($("#marks_d"+total[c]).val()=="")
				{
					
					$('#marks_d'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
                    flag=true;
			    	return false;
				}
				else if($("#neg_desc"+total[c]).val()=="")
				{
					
					$('#neg_desc'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Negative marks cannot be blank!'
                    });
                    flag=true;
			    	return false;
				}
				else if($("#ans_desc"+total[c]).val()=="")
				{
				
					$('#ans_desc'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Answer cannot be blank!'
                    });
                    flag=true;
			    	return false;
				}
			}
	
			 if($('#fill_form'+total[c]).is(':visible'))
			{
				var NewFillChKCount=$('#fill_form'+total[c]).find('input[type=checkbox]:checked').length;
	
				if($("#que1_fill"+total[c]).val() =="")
				{
				//	alert('Question cannot be blank');
				
					$('#que1_fill'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
						flag=true;
			    	return false;
				}
				else if($("#que2_fill"+total[c]).val() =="")
				{
				//	alert('Question cannot be blank');
					
					$('#que2_fill'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
					flag=true;
			    	return false;
				}
				else if($("#marks_f"+total[c]).val()=="")
				{
				//	alert('Marks cannot be blank');
					
					$('#marks_f'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
                    flag=true;
			    	return false;
				}
				else if($("#neg_fill"+total[c]).val()=="")
				{
					//alert('Negative marks cannot be blank');
					
					$('#neg_fill'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Negative marks cannot be blank!'
                    });
                    flag=true;
			    	return false;
				}
				    
				    FillAnsCount=$('input[id*="txtAnsFill'+total[c]+'"]').length;
				
					for(f=1;f<=FillAnsCount;f++)
					{
						if($('#txtAnsFill'+total[c]+'-'+f).val()=="")
						{
						//	alert('Answer cannot be blank');
							
							$('#txtAnsFill'+total[c]+'-'+f).focus();
							$.alert({
				        	    title: '',
                         content: 'Answer cannot be blank!'
                    });
                            flag=true;
			             	return false;
						}
					}
				if(NewFillChKCount<=0)
				{
				//	alert('Please select atleast one correct answer');
					$.alert({
				        	    title: '',
                         content: 'Please select atleast one correct answer!'
                    });
					flag=true;
					return false;
				}
			}
			
			   if($('#truefalse_form'+total[c]).is(':visible'))
		    	{
				var NewTFChKCount=$('#truefalse_form'+total[c]).find('input[type=radio]:checked').length;
	
				if($("#que_tf"+total[c]).val() =="")
				{
				//	alert('Question cannot be blank');
					
					$('#que_tf'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
                    flag=true;
			    	return false;
				}		
				else if($("#m_tf"+total[c]).val()=="")
				{
				//	alert('Marks cannot be blank');
					$('#m_tf'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
                    flag=true;
			    	return false;
				}	
				else if($("#neg_tf"+total[c]).val()=="")
				{
					//alert('Negative marks cannot be blank');
					
					$('#neg_tf'+total[c]).focus();
						$.alert({
				        	    title: '',
                         content: 'Negative marks cannot be blank!'
                    });
                    flag=true;
			    	return false;
				}
				if(NewTFChKCount<=0)
				{
				//	alert('Please select atleast one correct answer');
				    $.alert({
				        	    title: '',
                         content: 'Please select atleast one correct answer!'
                    });
					flag=true;
					return false;
				}
			}
			}


			if($('#total').val() != $('#total_marksss').val())
			{
			//	alert('Total marks and out of marks should be equal');
				$.alert({
				        	    title: '',
                         content: 'Total marks and out of marks should be equal!'
                    });
				flag=true;
				return false;
		  	}

			if(flag==false)
			{
				if($('#NewQuestionPaper').is(":visible"))
				{
					$('#NewQuestionPaper').hide();
					$('#CreatedQuestionPaper').show();
					$('#edit').attr('value','Edit');	
					$('#submitbtn').show();
					$('.abcd').addClass("disabledbutton");
					$('#headingpart').addClass("disabledbutton");
				}
				else
				{
					$('#CreatedQuestionPaper').hide();
					$('#NewQuestionPaper').show();
						$('.abcd').removeClass("disabledbutton");
					$('#headingpart').removeClass("disabledbutton");
				}
			}
		}

        	function ValidateFiles(obj)
		{
			debugger;
			var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
			if(obj.value!="" && !allowedExtensions.exec(obj.value))
			{
			//	alert('Please upload file having extensions .jpeg/.jpg/.png only.');
				$.alert({
				        	    title: '',
                         content: 'Please upload file having extensions .jpeg/.jpg/.png only!'
                    });
				obj.value=null;
			}
		}
		function markssss_total()
		{
			var marks=$('#markssss').val();
			$('#total_marksss').val(marks);
		}
		
		
        $(document).on('click',function(){
	$('.collapse').collapse('hide');
	  /*  if($("#checkboxes").is(":visible")){
	        $('#sselect').show();
	         $('#checkboxes').hide();
	         
	    }*/
        
    })
   	
   	function ValidateSubmit()
   	{
   	       	var count=$('.counter').val();
            var total = count.split(',');
        
			var MultiAnsCount=$('#MultiAnsCount').val();
			var FillAnsCount=$('#FillAnsCount').val();
			
			var paper_name=$('#paper_name').val();
	
			var MultiAnsCount=$('#MultiAnsCount').val();
			var FillAnsCount=$('#FillAnsCount').val();

			var TestTypeCount=$('#headingpart').find('input[type=radio]:checked').length;
        	var ExamCoordinator=$('#checkboxes').find('input[type=checkbox]:checked').length;
			
			var paper_name=$('#paper_name').val();

			var flag=false;	

			if(paper_name==undefined)
			{
				paper_name="";
			}
			if($('#paper_name').val()=="")
			{
			//	alert('Please enter question paper name');
				
				$('#paper_name').focus();
				$.alert({
				        	    title: '',
                         content: 'Please enter question paper name!'
                    });
                    flag=true;
				return false;
			}
			else if($('#date').val()=="")
			{
			//	alert('Please enter question paper creation date');
			
				$('#date').focus();
				$.alert({
				        	    title: '',
                         content: 'Please enter question paper creation date!'
                    });
                flag=true;
				return false;
			}
			else if($('#markssss').val()=="")
			{
				//alert('Please enter total marks');
			
				$('#markssss').focus();
				$.alert({
				        	    title: '',
                         content: 'Please enter total marks!'
                    });
                flag=true;    
				return false;
			}
			else if($('#QPaperPercentage').val()=="")
			{
			    $('#QPaperPercentage').focus();
				$.alert({
				        	    title: '',
                         content: 'Please enter passing percentage!'
                    });
                    flag=true;
				return false;
			}
			else if(ExamCoordinator==0)
			{
			     $.alert({
				        	    title: '',
                         content: 'Please select Exam coordinator!'
                    });
                    flag=true;
				return false;
			}
			else if(TestTypeCount==0)
			{
			    $.alert({
				        	    title: '',
                         content: 'Please select test type!'
                    });
                    flag=true;
				return false;
			}
			
	    	for(var c=0;c<total.length;c++)
			{
			    if($('#multiple_form'+total[c]).is(':visible'))
			{
				var NewMultiChKCount=$('#multiple_form'+total[c]).find('input[type=checkbox]:checked').length;
				if($("#que_multi"+total[c]).val() =="")
				{
					$('#que_multi'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
					flag=true;
			    	return false;
				}
				else if($("#m_marks"+total[c]).val()=="")
				{
					
					$('#m_marks'+total[c]).focus();
						$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
					flag=true;
			    	return false;
				}
				else if($("#neg_multi"+total[c]).val()=="")
				{
					
					$('#neg_multi'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Negative marks cannot be blank!'
                    });
					flag=true;
			    	return false;
				}	
				
					for(var m=1;m<=MultiAnsCount;m++)
					{
						if($('#txtAnsMulti'+total[c]+'-'+m).val()=="")
						{
						
							$('#txtAnsMulti'+total[c]+'-'+m).focus();
							$.alert({
				        	    title: '',
                         content: 'Answer cannot be blank!'
                    });
								flag=true;
			            	return false;
						}
					}
				if(NewMultiChKCount<=0)
				{
					$.alert({
				        	    title: '',
                         content: 'Please select atleast one correct answer!'
                    });
					
					flag=true;
					return false;
				}
			}
			
			 if($('#descriptive_form'+total[c]).is(':visible'))
			{
				if($("#que_desc"+total[c]).val() =="")
				{
					
					$('#que_desc'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
                    flag=true;
			    	return false;
				}
				else if($("#marks_d"+total[c]).val()=="")
				{
					
					$('#marks_d'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
                    flag=true;
			    	return false;
				}
				else if($("#neg_desc"+total[c]).val()=="")
				{
					
					$('#neg_desc'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Negative marks cannot be blank!'
                    });
                    flag=true;
			    	return false;
				}
				else if($("#ans_desc"+total[c]).val()=="")
				{
				
					$('#ans_desc'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Answer cannot be blank!'
                    });
                    flag=true;
			    	return false;
				}
			}
	
			 if($('#fill_form'+total[c]).is(':visible'))
			{
				var NewFillChKCount=$('#fill_form'+total[c]).find('input[type=checkbox]:checked').length;
	
				if($("#que1_fill"+total[c]).val() =="")
				{
				//	alert('Question cannot be blank');
				
					$('#que1_fill'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
						flag=true;
			    	return false;
				}
				else if($("#que2_fill"+total[c]).val() =="")
				{
				//	alert('Question cannot be blank');
					
					$('#que2_fill'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
					flag=true;
			    	return false;
				}
				else if($("#marks_f"+total[c]).val()=="")
				{
				//	alert('Marks cannot be blank');
					
					$('#marks_f'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
                    flag=true;
			    	return false;
				}
				else if($("#neg_fill"+total[c]).val()=="")
				{
					//alert('Negative marks cannot be blank');
					
					$('#neg_fill'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Negative marks cannot be blank!'
                    });
                    flag=true;
			    	return false;
				}
					for(f=1;f<=FillAnsCount;f++)
					{
						if($('#txtAnsFill'+total[c]+'-'+f).val()=="")
						{
						//	alert('Answer cannot be blank');
							
							$('#txtAnsFill'+total[c]+'-'+f).focus();
							$.alert({
				        	    title: '',
                         content: 'Answer cannot be blank!'
                    });
                            flag=true;
			             	return false;
						}
					}
				if(NewFillChKCount<=0)
				{
				//	alert('Please select atleast one correct answer');
					$.alert({
				        	    title: '',
                         content: 'Please select atleast one correct answer!'
                    });
					flag=true;
					return false;
				}
			}
			
			   if($('#truefalse_form'+total[c]).is(':visible'))
		    	{
				var NewTFChKCount=$('#truefalse_form'+total[c]).find('input[type=radio]:checked').length;
	
				if($("#que_tf"+total[c]).val() =="")
				{
				//	alert('Question cannot be blank');
					
					$('#que_tf'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
                    flag=true;
			    	return false;
				}		
				else if($("#m_tf"+total[c]).val()=="")
				{
				//	alert('Marks cannot be blank');
					$('#m_tf'+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
                    flag=true;
			    	return false;
				}	
				else if($("#neg_tf"+total[c]).val()=="")
				{
					//alert('Negative marks cannot be blank');
					
					$('#neg_tf'+total[c]).focus();
						$.alert({
				        	    title: '',
                         content: 'Negative marks cannot be blank!'
                    });
                    flag=true;
			    	return false;
				}
				if(NewTFChKCount<=0)
				{
				//	alert('Please select atleast one correct answer');
				    $.alert({
				        	    title: '',
                         content: 'Please select atleast one correct answer!'
                    });
					flag=true;
					return false;
				}
			}
			}

			if($('#total').val() != $('#total_marksss').val())
			{
			//	alert('Total marks and out of marks should be equal');
				$.alert({
				        	    title: '',
                                content: 'Total marks and out of marks should be equal!'
                          });
				flag=true;
				return false;
		  	}

			if(flag==false)
			{
			    //    $('html, body').animate({ scrollTop: 0 }, 700);
		    $("#progress_By_JS")[0].style.display = "block";
            $("#mydiv").css("background-color", "#929292");
            $("#mydiv").css("opacity", "0.2");
            debugger;
				$('#myform').submit();
			}
   	
}

		function SameQuestionMultiple(txt)
		{
			var abc;
			for(var i=0; i<document.querySelectorAll("[id^='que_multi']").length; i++)
			{
				//abc=document.querySelectorAll("[id^='que_multi']")[0].value;
				if(document.querySelectorAll("[id^='que_multi']")[i].value==txt.value && document.querySelectorAll("[id^='que_multi']")[i].id !=txt.id)
				{
				//	alert("Same question is already exists");
				$.alert({
				        	    title: '',
                         content: 'Same question is already exists!'
                    });
					txt.value="";
					return;
				}
			}
		}
		function SameQuestionDescriptive(txt)
		{
			var abc;
			for(var i=0; i<document.querySelectorAll("[id^='que_desc']").length; i++)
			{
				//abc=document.querySelectorAll("[id^='que_multi']")[0].value;
				if(document.querySelectorAll("[id^='que_desc']")[i].value==txt.value && document.querySelectorAll("[id^='que_desc']")[i].id !=txt.id)
				{
				//	alert("Same question is already exists");
				$.alert({
				        	    title: '',
                         content: 'Same question is already exists!'
                    });
					txt.value="";
					return;
				}
			}
		}
		function SameQuestionFill(txt)
		{
			debugger;
			var abc;
			if(txt.value=="")
			{
			    
			}
			else
			{
			for(var i=0; i<document.querySelectorAll("[id^='que']").length; i++)
			{
				//abc=document.querySelectorAll("[id^='que_multi']")[0].value;
				if(document.querySelectorAll("[id^='que']")[i].value==txt.value && 	document.querySelectorAll("[id^='que']")[i].id !=txt.id)
				{
				//	alert("Same question is already exists");
					$.alert({
				        	    title: '',
                         content: 'Same question is already exists!'
                    });
					txt.value="";
					return;
				}
			}}
		}
		function SameQuestionTrueFalse(txt)
		{
			var abc;
			for(var i=0; i<document.querySelectorAll("[id^='que_tf']").length; i++)
			{
				//abc=document.querySelectorAll("[id^='que_multi']")[0].value;
				if(document.querySelectorAll("[id^='que_tf']")[i].value==txt.value && document.querySelectorAll("[id^='que_tf']")[i].id !=txt.id)
				{
					//alert("Same question is already exists");
					$.alert({
				        	    title: '',
                         content: 'Same question is already exists!'
                    });
					txt.value="";
					return;
				}
			}
		}
		
		  function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

            keyPressCount=1;
            function isNumberKeyNeg(evt){
                debugger;
    var charCode = (evt.which) ? evt.which : evt.keyCode
   // alert(charCode);
    if (charCode > 31 && (charCode < 32 || charCode > 57))
        //if (/(.)\1{3,}/.test(str)) 
       // evt.preventDefault();
        return false;
    return true;
        
}
    /*    function ab(obj)
        {
            var v=obj.value;alert(v);
            if(v.match(/,{2,}/g)) {
    // the user entered a duplicate comma
    alert('No duplicate commas allowed!');
  }
        }*/
        
         function onlyNumbersWithPercent(e,txt) {
               
               var charCode;
          if (e.keyCode > 0) {
              charCode = e.which || e.keyCode;
          }
          else if (typeof (e.charCode) != "undefined") {
              charCode = e.which || e.keyCode;
          }
               
               debugger;
         
          if (charCode == 37)
          {
           if(txt.value.indexOf("-") >= 0)
           {
            return false
           }
           else
           {
              return true
            }
           }
          if (charCode > 31 && (charCode < 48 || charCode > 57))
              return false;
          return true;
      }
      
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