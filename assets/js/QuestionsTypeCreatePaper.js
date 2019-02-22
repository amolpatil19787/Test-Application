    var count=1;
    
    var a= new Array();
    
            function QuestionTypeClick(e)
	        {
	    	   
			    if(e.value=='Multiple choice questions')
		        {
				     multiple_form();
				     
	            	   var count=$('.counter').val();
                      var total = count.split(',');
				     if ($("#mock").is(":checked")) 
				     {
                       for(var c=0;c<total.length;c++)
		    	        {
		    	               if($('#multiple_form'+total[c]).is(':visible'))
		                       {
                                    $('#MultiRefDoc'+total[c]).removeAttr("disabled");
                                    $('#MultiRefPageNo'+total[c]).removeAttr("disabled");
		                       }
		    	        }
                    }
			    }
    			else if(e.value=='Descriptive questions')
	    		{
		    		 descriptive_form();
		    		 
		    		 var count=$('.counter').val();
                      var total = count.split(',');
				     if ($("#mock").is(":checked")) 
				     {
                        for(var c=0;c<total.length;c++)
		    	        {
		    	            if($('#descriptive_form'+total[c]).is(':visible'))
		                    {
                                $('#DescRefDoc'+total[c]).removeAttr("disabled");
                                $('#DescRefPageNo'+total[c]).removeAttr("disabled");
		                    }
		    	        }
                    }
                    
			    	//alert($('#qpid').val());
    			}
	    		else if(e.value=='Fill in the blanks')
		    	{
			    	 fill_form();
			    	 
			     var count=$('.counter').val();
                      var total = count.split(',');
				     if ($("#mock").is(":checked")) 
				     {
                        for(var c=0;c<total.length;c++)
		    	        {
		    	            if($('#fill_form'+total[c]).is(':visible'))
		                    {
                                $('#FillRefDoc'+total[c]).removeAttr("disabled");
                                $('#FillRefPageNo'+total[c]).removeAttr("disabled");
		                    }
		    	        }
                    }
                   
    			}
	    		else if(e.value=='True false')
	    		{
		    		 trueFalse_form();
		    	  var count=$('.counter').val();
                      var total = count.split(',');
				     if ($("#mock").is(":checked")) 
				     {
                        for(var c=0;c<total.length;c++)
		    	        {
		    	            if($('#truefalse_form'+total[c]).is(':visible'))
		                    {
                                $('#TFRefDoc'+total[c]).removeAttr("disabled");
                                $('#TFRefPageNo'+total[c]).removeAttr("disabled");
		                    }
		    	        }
                    }
	    		}      
		    }	
            
            function AddReference()
            {
                
                $('#reference').removeAttr("disabled");
                
                var count=$('.counter').val();
                var total = count.split(',');
                
                for(var c=0;c<total.length;c++)
		    	{
		    	   if($('#multiple_form'+total[c]).is(':visible'))
		    	   {
                        $('#MultiRefDoc'+total[c]).removeAttr("disabled");
                        $('#MultiRefPageNo'+total[c]).removeAttr("disabled");
		    	    }
		    	    if($('#descriptive_form'+total[c]).is(':visible'))
		            {
		                $('#DescRefDoc'+total[c]).removeAttr("disabled");
                        $('#DescRefPageNo'+total[c]).removeAttr("disabled");
		            }
		            if($('#fill_form'+total[c]).is(':visible'))
		            {
		                 $('#FillRefDoc'+total[c]).removeAttr("disabled");
                         $('#FillRefPageNo'+total[c]).removeAttr("disabled");   
		            }
		             if($('#truefalse_form'+total[c]).is(':visible'))
		             {
		                 $('#TFRefDoc'+total[c]).removeAttr("disabled");
                         $('#TFRefPageNo'+total[c]).removeAttr("disabled");
		             }
		    	}
            }
            
             function RemoveReference()
            {
                $('#reference').attr('disabled','disabled');
                
                 var count=$('.counter').val();
                var total = count.split(',');
                
                for(var c=0;c<total.length;c++)
		    	{
		    	    if($('#multiple_form'+total[c]).is(':visible'))
		    	    {
                         $('#MultiRefDoc'+total[c]).attr('disabled','disabled');
                         $('#MultiRefPageNo'+total[c]).attr("disabled","disabled");
		    	    }
		    	    if($('#descriptive_form'+total[c]).is(':visible'))
		            {
		                $('#DescRefDoc'+total[c]).attr('disabled','disabled');
                        $('#DescRefPageNo'+total[c]).attr("disabled","disabled");   
		            }
		            if($('#fill_form'+total[c]).is(':visible'))
		            {
		                $('#FillRefDoc'+total[c]).attr('disabled','disabled');
                        $('#FillRefPageNo'+total[c]).attr("disabled","disabled");    
		            }
		            if($('#truefalse_form'+total[c]).is(':visible'))
		            {
		                $('#TFRefDoc'+total[c]).attr('disabled','disabled');
                        $('#TFRefPageNo'+total[c]).attr("disabled","disabled");
		            }
		    	}
            }
            
            function AddPageNo()
            {
               
                var count=$('.counter').val();
                var total = count.split(',');
                
                for(var c=0;c<total.length;c++)
		    	{
		    	   if($('#multiple_form'+total[c]).is(':visible'))
		    	   {
                        $('#MultiRefPageNo'+total[c]).removeAttr("disabled");
		    	    }
		    	    if($('#descriptive_form'+total[c]).is(':visible'))
		    	   {
                        $('#DescRefPageNo'+total[c]).removeAttr("disabled");
		    	    }
		    	    if($('#fill_form'+total[c]).is(':visible'))
		    	   {
                        $('#FillRefPageNo'+total[c]).removeAttr("disabled");
		    	    }
		    	    if($('#truefalse_form'+total[c]).is(':visible'))
		    	   {
                        $('#TFRefPageNo'+total[c]).removeAttr("disabled");
		    	    }
		    	}
            }
    
            function DisablePageNo(count)
            {
               debugger;
               if($('#MultiRefDoc'+count).val()!="")
               {
                   $('#MultiRefPageNo'+count).attr("disabled","disabled");
                   $('#MultiRefDoc'+count).removeAttr("disabled");
               }
               if($('#DescRefDoc'+count).val()!="")
               {
                   $('#DescRefPageNo'+count).attr("disabled","disabled");
                   $('#DescRefDoc'+count).removeAttr("disabled");
               }
               if($('#FillRefDoc'+count).val()!="")
               {
                   $('#FillRefPageNo'+count).attr("disabled","disabled");
                   $('#FillRefDoc'+count).removeAttr("disabled");
               }
               if($('#TFRefDoc'+count).val()!="")
               {
                   $('#TFRefPageNo'+count).attr("disabled","disabled");
                   $('#TFRefDoc'+count).removeAttr("disabled");
               }
            }
   
            function DisableRefDoc(count)
            {
              
                if($('#MultiRefDoc'+count).val()!="")
               {
                   $('#MultiRefPageNo'+count).attr("disabled","disabled");
                   $('#MultiRefDoc'+count).removeAttr("disabled");
               }
               else
               {
                   $('#MultiRefPageNo'+count).removeAttr("disabled");
                   $('#MultiRefDoc'+count).attr("disabled","disabled");
               }
               if($('#DescRefDoc'+count).val()!="")
               {
                   $('#DescRefPageNo'+count).attr("disabled","disabled");
                   $('#DescRefDoc'+count).removeAttr("disabled");
               }
               else
               {
                   $('#DescRefPageNo'+count).removeAttr("disabled");
                   $('#DescRefDoc'+count).attr("disabled","disabled");
               }
               if($('#FillRefDoc'+count).val()!="")
               {
                   $('#FillRefPageNo'+count).attr("disabled","disabled");
                   $('#FillRefDoc'+count).removeAttr("disabled");
               }
               else
               {
                   $('#FillRefPageNo'+count).removeAttr("disabled");
                   $('#FillRefDoc'+count).attr("disabled","disabled");
               }
               if($('#TFRefDoc'+count).val()!="")
               {
                   $('#TFRefPageNo'+count).attr("disabled","disabled");
                   $('#TFRefDoc'+count).removeAttr("disabled");
               }
               else
               {
                   $('#TFRefPageNo'+count).removeAttr("disabled");
                   $('#TFRefDoc'+count).attr("disabled","disabled");
               }
            }
   
            function multiple_form()
			{
							
	
			var MultipleForm=$('<div class="container" id="multiple_form' +count+'" style="margin-bottom:20px;border:0.5px solid lightgray;padding:10px 0px;width:100%" class="mm"><span class="cls" title="close"  onclick="close_multiple(this)">X</span><div class="col-md-12" style="display:flow-root" id="multiple_que'+count+'"><div class="form-group"><label class="col-md-2">Question:</label><div class="col-md-8"><input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onblur="SameQuestionMultiple(this);" id="que_multi'+count+'" name="question_multi'+count+'" class="form-control ckeditor" oninput="QuestionPaperData('+count+')" /></div><div class="col-md-2"></div></div><div class="form-group"><label class="col-md-2">Image:</label><div class="col-md-3"><img id="ImageMulti'+count+'" width="100" height="100" style="display:none;"/><input type="file" id="img_multi'+count+'" name="PicMulti'+count+'" onchange="ValidateFiles(this); ShowImgMulti(this,'+count+'); QuestionPaperData('+count+');"></div></div><div class="form-group"><div class="col-md-12"><label>Please select any one option for mock test:</label></div></div><div class="form-group" id="MockMulti'+count+'"><label class="col-md-2">Reference Document:</label><div class="col-md-3"><input type="file" disabled onchange="DisablePageNo('+count+');" id="MultiRefDoc'+count+'" name="MultiRefDoc'+count+'"></div><label class="col-md-1">OR</label><label class="col-md-2">Page No:</label><div class="col-md-2"><input type="text" disabled onfocus="DisableRefDoc('+count+')" id="MultiRefPageNo'+count+'" name="MultiRefPageNo'+count+'" onkeypress="return isNumberKey(event)" class="form-control"></div></div><div class="form-group"><label class="col-md-2">Marks:</label><div class="col-md-3"><input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="m_marks'+count+'" name="marks_multi'+count+'" oninput="myFunction();QuestionPaperData('+count+')"></div><label class="col-md-2">Negative Marks:</label><div class="col-md-3"><input type="text" class="form-control" onkeypress="return onlyNumbersWithdash(event,this);" id="neg_multi'+count+'" name="negative_marks_multi'+count+'" oninput="QuestionPaperData('+count+')"></div></div><div class="form-group"><div class="col-md-12"><input type="button" value="Add Answers" onclick="add_answer_click('+count+');" id="btnMulti'+count+'"/></div></div><div class ="col-md-offset-10 col-md-2"><label>Correct Answer:</label></div>'+ add_answer(count)+'</div></div>');

          //   CKEDITOR.replace( 'question_multi1' );
			
			$('#NewQuestionPaper').append(MultipleForm);


			var CreatedMultipleForm=$('<div class="container" id="multiple_created'+count+'" style="margin-bottom:20px;background-color:#F8F8F8;padding:20px 0px;width:100%;border:0.5px solid lightgray;"><div class="col-md-12" id="multipleQBackend'+count+'"><div class="form-group"><label class="col-md-2">Question:</label><div class="col-md-8"><b><span class="wrap" id="MultiQue'+count+'"></span></b></div><div class="col-md-2"></div></div><div class="form-group"><label class="col-md-2">Image:</label><div class="col-md-4"><b><img id="ImgMulti'+count+'" alt="no image selected"></b></div><div class="col-md-3"><label>Marks:</label>&nbsp;&nbsp;<b><span id="MultiMarks'+count+'"></span></b></div><div class="col-md-3"><label>Negative Marks:</label>&nbsp;&nbsp;<b><span id="MultiNegMarks'+count+'"></span></b></div></div><div class="form-group"><div class="col-md-2"><label>Answers:</label></div><div class="col-md-8" id="AllMultipleAns'+count+'">'+add_label(count)+'</div></div></div></div>');

			$('#CreatedQuestionPaper').append(CreatedMultipleForm);

    	             var resultObj = $(".counter");
    	        
    	           var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
                 resultObj .val( stringToAppend + count );
    	    
    	  /*  if($('#multiple_form'+count).is(':visible'))
			{
                 var tm = $('input[id^="m_marks'+count+'"]');
                   for(var i=0; i < tm.length; i++){
                       a.push(tm[i].id.split('m_marks')[1]);
                  }
                    var aa=JSON.stringify(a)
                   $('.counter').val(JSON.parse(aa));*/
		//	}
          //  	$("#marks_multiple").val(m1);
			
            cnt_multi=$('#cnt_multi').val();	
			cnt_desc=$('#cnt_desc').val();
			cnt_fill=$('#cnt_fill').val();
			cnt_tf=$('#cnt_tf').val();
		
				if($('#cnt_multi').val()==""){	cnt_multi=0;	}
				else{	cnt_multi=parseInt($('#cnt_multi').val());	}


				if($('#cnt_desc').val()==""){	cnt_desc=0;	}
				else{	cnt_desc=parseInt($('#cnt_desc').val());	}


				if($('#cnt_fill').val()==""){	cnt_fill=0;	}
				else{	cnt_fill=parseInt($('#cnt_fill').val());	}


				if($('#cnt_tf').val()==""){	cnt_tf=0;	}
				else{	cnt_tf=parseInt($('#cnt_tf').val());		}	

				cnt_multi=cnt_multi+1;
				parseInt(cnt_multi);
				$('#cnt_multi').val(cnt_multi);                      
				var sum=0;	
	                        sum=cnt_multi+cnt_desc+cnt_fill+cnt_tf;
				$('#total_questions').val(sum);
			
			  //  $('.counter').val(count);
	    		count=count+1;
			
	    		
			}
			
			var arr=new Array();
			function add_answer(count)
			{	
			    debugger;
							
				var ansCountMulti=$('input[id*="txtAnsMulti'+count+'"]').length+1;
				$('#MultiAnsCount').val(ansCountMulti);
				return '<div class="form-group" id="newMulti'+count+'"><label class="col-md-2">Answer  '+ansCountMulti+':</label><div class="col-md-8"><input type="text" onkeyup="javascript:capitalize(this.id, this.value);" id="txtAnsMulti'+count+'-'+ansCountMulti+'" name="txtAnsMulti'+count+'-'+ansCountMulti+'" class="form-control" oninput="add_labelans('+count+','+ansCountMulti+')"></div><div class="col-md-2"><input type="hidden" name="ChkAnsMulti'+count+'-'+ansCountMulti+'" value="0" /><input type="checkbox" id="ChkAnsMulti'+count+'-'+ansCountMulti+'" name="ChkAnsMulti'+count+'-'+ansCountMulti+'" value="1"></div></div>';
	
	            
	            arr.push($("#txtAnsMulti"+count+'-'+ansCountMulti).val());
			}
			function add_label(Count)
			{
				
				var LabelCount=$('p[id*="ans'+Count+'"]').length+1;
				//alert(LabelCount);
				return '<b><p class="wrap" id="ans'+Count+'-'+LabelCount+'"></p></b>';
			}
			function add_labelans(cnt,cnt1)
			{
				debugger;
				var ans=$("#txtAnsMulti"+cnt+'-'+cnt1).val();
				$("#ans"+cnt+'-'+cnt1).text(ans);
				
			}
			function add_answer_click(cnt1)
			{
			    
				$("#multiple_que"+cnt1).append(add_answer(cnt1));
				$('#AllMultipleAns'+cnt1).append(add_label(cnt1));	
			}
			
			//descriptive
			
				function descriptive_form()
			{
					var DescriptiveForm=$('<div class="container" id="descriptive_form'+count+'" style="margin-bottom:20px;border:0.5px solid lightgray;padding:10px 0px;width:100%;"><span class="cls" title="close" onclick="close_descriptive(this)">X</span><div class="col-md-12" style="display:flow-root"><input type="hidden" value="'+count+'" name="seqnumber'+count+'"><div class="form-group"><label class="col-md-2">Question:</label><div class="col-md-8"><input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onblur="SameQuestionDescriptive(this);" id="que_desc'+count+'" name="question_desc'+count+'" class="form-control" oninput="QuestionPaperData('+count+')"></div><div class="col-md-2"></div></div><div class="form-group"><label class="col-md-2">Image:</label><div class="col-md-4"><img id="ImageDesc'+count+'" width="100" height="100" style="display:none;"/><input type="file" id="img_desc'+count+'" name="PicDesc'+count+'" onchange="ValidateFiles(this); ShowImgDesc(this,'+count+'); QuestionPaperData('+count+')"></div></div><div class="form-group"><div class="col-md-12"><label>Please select any one option for mock test:</label></div></div><div class="form-group"><label class="col-md-2">Reference Document:</label><div class="col-md-3"><input type="file" id="DescRefDoc'+count+'" name="DescRefDoc'+count+'" disabled onchange="DisablePageNo('+count+');"></div><label class="col-md-1">OR</label><label class="col-md-2">Page No:</label><div class="col-md-2"><input type="text" onfocus="DisableRefDoc('+count+')" id="DescRefPageNo'+count+'" name="DescRefPageNo'+count+'" disabled onkeypress="return isNumberKey(event)" class="form-control"></div></div><div class="form-group"><label class="col-md-2">Marks:</label><div class="col-md-3"><input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="marks_d'+count+'" name="marks_desc'+count+'" oninput="desc_mtotal(); QuestionPaperData('+count+')"></div><label class="col-md-2">Negative Marks:</label><div class="col-md-3"><input type="text" class="form-control" onkeypress="return onlyNumbersWithdash(event,this);" id="neg_desc'+count+'" name="negative_marks_desc'+count+'" oninput="QuestionPaperData('+count+')"></div></div><div class="form-group"><label class="col-md-2">Answer:</label><div class="col-md-8"><textarea onkeyup="javascript:capitalize(this.id, this.value);" id="ans_desc'+count+'" name="ans_desc'+count+'" class="form-control" oninput="QuestionPaperData('+count+')"></textarea></div><div class="col-md-2"></div></div></div></div>');


				$('#NewQuestionPaper').append(DescriptiveForm);

					var CreatedDescriptiveForm=$('<div class="container" id="descriptive_created'+count+'" style="margin-bottom:20px;background-color:#F8F8F8;padding:20px 0px;width:100%;border:0.5px solid lightgray;"><div class="col-md-12"><div class="form-group"><label class="col-md-2 ">Question:</label><div class="col-md-8"><b><p class="wrap" id="DescQue'+count+'"></p></b></div><div class="col-md-2"></div></div><div class="form-group"><label class="col-md-2">Image:</label><div class="col-md-4"><b><img id="DescImg'+count+'" alt="no image selected"></b></div><div class="col-md-3"><label>Marks:</label>&nbsp;&nbsp;<b><span class="wrap" id="DescMarks'+count+'"></span></b></div><div class="col-md-3"><label>Negative Marks:</label>&nbsp;&nbsp;<b><span class="wrap" id="DescNegMarks'+count+'"></span></b></div></div><div class="form-group"><label class="col-md-2">Answer:</label><div class="col-md-8"><b><p class="wrap" id="DescAns'+count+'"></p></b></div><div class="col-md-2"></div></div></div></div>');

				$('#CreatedQuestionPaper').append(CreatedDescriptiveForm);		
				
				//$('.counter2').val(count2);
		//		count2=count2+1;
				
				
				 var resultObj = $(".counter");
    	        
    	           var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
                 resultObj .val( stringToAppend + count );
				

    	  /*      debugger;
                var tm = $('input[id^="marks_d'+count+'"]');
             for(var i=0; i < tm.length; i++){
                  a.push(tm[i].id.split('marks_d')[1]);
             }
             var aa=JSON.stringify(a)
             $('.counter').val(JSON.parse(aa));*/
				
				cnt_multi=$('#cnt_multi').val();	 
				cnt_desc=$('#cnt_desc').val();
				cnt_fill=$('#cnt_fill').val();
				cnt_tf=$('#cnt_tf').val();
 		
				if($('#cnt_multi').val()==""){	cnt_multi=0;	}
				else{	cnt_multi=parseInt($('#cnt_multi').val());	}


				if($('#cnt_desc').val()==""){	cnt_desc=0;	}
				else{	cnt_desc=parseInt($('#cnt_desc').val());	}


				if($('#cnt_fill').val()==""){	cnt_fill=0;	}
				else{	cnt_fill=parseInt($('#cnt_fill').val());	}


				if($('#cnt_tf').val()==""){	cnt_tf=0;	}
				else{	cnt_tf=parseInt($('#cnt_tf').val());		}	

				cnt_desc=cnt_desc+1;					
                      
				$('#cnt_desc').val(cnt_desc);
				var sum=0;	
	                        sum=cnt_multi+cnt_desc+cnt_fill+cnt_tf;
				 $('#total_questions').val(sum);
                  // $('.counter2').val(sum);
               //   	$('.counter').val(count);
	            count=count+1;
	            
			}
			
			function fill_form()
			{
					var FillForm=$('<div class="container" id="fill_form'+count+'" style="margin-bottom:20px;border:0.5px solid lightgray;padding:10px 0px;width:100%;"><span class="cls" title="close" onclick="close_fill(this)" style="margin-bottom:10px;">X</span><div class="col-md-12" style="display:flow-root" id="fill_que'+count+'"><input type="hidden" value="'+count+'" name="seqnumber'+count+'"><div class="form-group"><label class="col-md-2">Question:</label><div class="col-md-4"><input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onblur="SameQuestionFill(this)" id="que1_fill'+count+'" name="que1_fill'+count+'" class="form-control" oninput="QuestionPaperData('+count+')"></div><label class="col-md-2">_ _ _ _ _ _ _ _</label><div class="col-md-4"><input type="text" onblur="SameQuestionFill(this)" id="que2_fill'+count+'" name="que2_fill'+count+'" class="form-control fill" oninput="QuestionPaperData('+count+')"></div></div><div class="form-group"><label class="col-md-2">Image:</label><div class="col-md-4"><img id="ImageFill'+count+'" width="100" height="100" style="display:none;"><input type="file" id="img_fill'+count+'" name="PicFill'+count+'" onchange="ValidateFiles(this); ShowImgFill(this,'+count+'); QuestionPaperData('+count+');"></div></div><div class="form-group"><div class="col-md-12"><label>Please select any one option for mock test:</label></div></div><div class="form-group"><label class="col-md-2">Reference Document:</label><div class="col-md-3"><input type="file" id="FillRefDoc'+count+'" name="FillRefDoc'+count+'" disabled onchange="DisablePageNo('+count+');"></div><label class="col-md-1">OR</label><label class="col-md-2">Page No:</label><div class="col-md-2"><input type="text" id="FillRefPageNo'+count+'" name="FillRefPageNo'+count+'" onfocus="DisableRefDoc('+count+')" class="form-control" onkeypress="return isNumberKey(event)" disabled></div></div><div class="form-group"><label class="col-md-2">Marks:</label><div class="col-md-3"><input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="marks_f'+count+'" name="marks_fill'+count+'" oninput="fill_mtotal(); QuestionPaperData('+count+');"></div><label class="col-md-2">Negative Marks:</label><div class="col-md-3"><input type="text" class="form-control" onkeypress="return onlyNumbersWithdash(event,this);" id="neg_fill'+count+'" name="negative_marks_fill'+count+'" oninput="QuestionPaperData('+count+')"></div></div><div class="form-group"><div class="col-md-12"><input type="button" value="Add Answers" onclick="add_answerFill_click('+count+');"/></div></div><div class ="col-md-offset-10 col-md-2"><label>Correct Answer:</label></div>'+add_answer_fill(count)+'</div></div>');

				
				$('#NewQuestionPaper').append(FillForm);
	
					var CreatedFillForm=$('<div class="container" id="fill_created'+count+'" style="margin-bottom:20px;border:0.5px solid lightgray;padding:20px 0px;width:100%;background-color:#F8F8F8;"><div class="col-md-12" id="FillQ'+count+'"><div class="form-group"><label class="col-md-2">Question:</label><div class="col-md-8"><b><span class="wrap" id="QueFill1'+count+'"></span><span>_______</span><span id="QueFill2'+count+'"></span></b></div><div class="col-md-2"></div></div><div class="form-group"><label class="col-md-2">Image:</label><div class="col-md-4"><b><img id="FillImg'+count+'" alt="no image selected"></b></div><div class="col-md-3"><label>Marks:</label>&nbsp;&nbsp;<b><span id="FillMarks'+count+'"></span></b></div><div class="col-md-3"><label>Negative Marks:</label>&nbsp;&nbsp;<b><span id="FillNegMarks'+count+'"></span></b></div></div><div class="form-group"><div class="col-md-2"><label>Answers:</label></div><div class="col-md-8" id="AllFillAnswers'+count+'">'+addLabelFill(count)+'</div><div class="col-md-2"></div></div></div></div>');				

				$('#CreatedQuestionPaper').append(CreatedFillForm);
				
				 var resultObj = $(".counter");
    	        
    	           var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
                 resultObj .val( stringToAppend + count );

		//		var a= new Array();
			/*	 var tf = $('input[id^="marks_f'+count+'"]');
               for(var i=0; i < tf.length; i++){
                     a.push(tf[i].id.split('marks_f')[1]);
              }
             var aa=JSON.stringify(a)
             $('.counter').val(JSON.parse(aa));*/
				
				cnt_multi=$('#cnt_multi').val();	 
				cnt_desc=$('#cnt_desc').val();
				cnt_fill=$('#cnt_fill').val();
				cnt_tf=$('#cnt_tf').val();
 			
				if($('#cnt_multi').val()==""){	cnt_multi=0;	}
				else{	cnt_multi=parseInt($('#cnt_multi').val());	}


				if($('#cnt_desc').val()==""){	cnt_desc=0;	}
				else{	cnt_desc=parseInt($('#cnt_desc').val());	}


				if($('#cnt_fill').val()==""){	cnt_fill=0;	}
				else{	cnt_fill=parseInt($('#cnt_fill').val());	}


				if($('#cnt_tf').val()==""){	cnt_tf=0;	}
				else{	cnt_tf=parseInt($('#cnt_tf').val());		}	
					
				cnt_fill=cnt_fill+1;
				$('#cnt_fill').val(cnt_fill);
				var sum=0;	
	                        sum=cnt_multi+cnt_desc+cnt_fill+cnt_tf;
				$('#total_questions').val(sum);
                //$('.counter3').val(sum);
                
              //  	$('.counter').val(count);
                 count=count+1;
             //   $('.counter1').val(c);
			}
			
				function add_answer_fill(countFill)
			{	
				var ansCountFill=$('input[id*="txtAnsFill'+countFill+'"]').length+1;
				$('#FillAnsCount').val(ansCountFill);			
				return '<div class="form-group" id="newFill'+countFill+'-'+ansCountFill+'"><label class="col-md-2">Answer  '+ansCountFill+':</label><div class="col-md-8"><input type="text" onkeyup="javascript:capitalize(this.id, this.value);" id="txtAnsFill'+countFill+'-'+ansCountFill+'" name="txtAnsFill'+countFill+'-'+ansCountFill+'" class="form-control" oninput="AddLabelAnsFill('+countFill+','+ansCountFill+')"></div><div class="col-md-2"><input type="hidden" name="ChkAnsFill'+countFill+'-'+ansCountFill+'" value="0"><input type="checkbox" onchange="AnsChecked(this,'+countFill+','+ansCountFill+');" class="chkkfill'+countFill+'" name="ChkAnsFill'+countFill+'-'+ansCountFill+'" id="chkk'+countFill+'-'+ansCountFill+'" value="1"></div></div>';
			}
			
			function addLabelFill(Count)
			{
				var LabelCount=$('p[id*="FillAns'+Count+'"]').length+1;
				return '<b><p class="wrap" id="FillAns'+Count+'-'+LabelCount+'"></p></b>';
			}
			function AddLabelAnsFill(count,anscount)
			{
				debugger;
				var ans=$("#txtAnsFill"+count+'-'+anscount).val();
				$("#FillAns"+count+'-'+anscount).text(ans);	

			}
			function add_answerFill_click(cntFill)
			{
				
				$('#fill_que'+cntFill).append(add_answer_fill(cntFill));
				$('#AllFillAnswers'+cntFill).append(addLabelFill(cntFill));
			}
			
			function ShowAllFillAns(count)
			{
				var ansCountFill=$('input[id*="txtAnsFill'+count+'"]').length-1;
				var FillAns=$("#txtAnsFill"+count+'-'+ansCountFill).val();
				$("#FillAns"+count+'-'+1).text($("#txtAnsFill"+count+'-'+1).val());
				$("#FillAns"+count+'-'+ansCountFill).text(FillAns);
				return '<div class="form-group"><div class="col-md-12"><p id="FillAns'+count+'-'+ansCountFill+'"></p></div></div>';
			}		

            function AnsChecked(obj,count,count1)
				 {
	    				var checked = $(obj).is(':checked');
	    				$(".chkkfill"+count).prop('checked',false);
	    				if(checked)
					 {
		        			$(obj).prop('checked',true);
	      				 }
				}
	

                function trueFalse_form()
			{
					var TrueFalseForm=$('<div class="container" id="truefalse_form'+count+'" style="margin-bottom:20px;border:0.5px solid lightgray;padding:10px 0px;width:100%"><span class="cls" title="close" onclick="close_truefalse(this)">X</span><div class="col-md-12" style="display:flow-root"><input type="hidden" value="'+count+'" name="seqnumber'+count+'"><div class="form-group"><label class="col-md-2">Question:</label><div class="col-md-8"><input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onblur="SameQuestionTrueFalse(this);" id="que_tf'+count+'" name="question_true_false'+count+'" class="form-control" oninput="QuestionPaperData('+count+')"></div><div class="col-md-2"></div></div><div class="form-group"><label class="col-md-2">Image:</label><div class="col-md-4"><img id="ImageTF'+count+'" width="100" height="100" style="display:none;"><input type="file" id="imgtf'+count+'" name="PicTF'+count+'" onchange="ValidateFiles(this); ShowImgTF(this,'+count+'); QuestionPaperData('+count+');"></div></div><div class="form-group"><div class="col-md-12"><label>Please select any one option for mock test:</label></div></div><div class="form-group"><label class="col-md-2">Reference Document:</label><div class="col-md-3"><input type="file" id="TFRefDoc'+count+'" onchange="DisablePageNo('+count+');" disabled name="TFRefDoc'+count+'"></div><label class="col-md-1">OR</label><label class="col-md-2">Page No:</label><div class="col-md-2"><input type="text" class="form-control" id="TFRefPageNo'+count+'" name="TFRefPageNo'+count+'" onfocus="DisableRefDoc('+count+')" onkeypress="return isNumberKey(event)" disabled></div></div><div class="form-group"><label class="col-md-2">Marks:</label><div class="col-md-3"><input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="m_tf'+count+'" name="marks_tf'+count+'" oninput="tf_mtotal(); QuestionPaperData('+count+')"></div><label class="col-md-2">Negative Marks:</label><div class="col-md-3"><input type="text" class="form-control" onkeypress="return onlyNumbersWithdash(event,this);" id="neg_tf'+count+'" name="negative_marks_tf'+count+'" oninput="QuestionPaperData('+count+')"></div></div><div class="form-group"><label class="col-md-2">Answer:</label><div class="col-md-7"><div class="radio"><label><input type="radio" id="true_val'+count+'" name="true_false'+count+'" value="True" onchange="QuestionPaperData('+count+')">True</label>&nbsp;&nbsp;<label><input type="radio" id="false_val'+count+'" name="true_false'+count+'" value="False" onchange="QuestionPaperData('+count+')">False</label></div></div><div class="col-md-3"></div></div></div></div>');

				$('#NewQuestionPaper').append(TrueFalseForm);

					var CreatedTrueFalseForm=$('<div class="container" id="truefalse_created'+count+'" style="margin-bottom:20px;border:0.5px solid lightgray;padding:10px 0px;width:100%;background-color:#F8F8F8;"><div class="col-md-12"><div class="form-group"><label class="col-md-2">Question:</label><div class="col-md-8"><b><span class="wrap" id="TFQue'+count+'"></span></b></div><div class="col-md-2"></div></div><div class="form-group"><label class="col-md-2">Image:</label><div class="col-md-4"><b><img id="TFImg'+count+'" alt="no image selected"></b></div><div class="col-md-3"><label>Marks:</label>&nbsp;&nbsp;<b><span id="TFMarks'+count+'"></span></b></div><div class="col-md-3"><label>Negative Marks:</label>&nbsp;&nbsp;<b><span id="TFNegMarks'+count+'"></span></b></div></div><div class="form-group"><label class="col-md-2">Answer:</label><div class="col-md-10"><b><p id="TFAns'+count+'"></p></b></div></div></div></div>');

				$('#CreatedQuestionPaper').append(CreatedTrueFalseForm);
				
				 var resultObj = $(".counter");
    	        
    	            var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
                 resultObj .val( stringToAppend + count );

			//	$('.counter4').val(count4);
		//		count4=count4+1;
				
			//		var a= new Array();
			/*	 var tr = $('input[id^="m_tf'+count+'"]');
               for(var i=0; i < tr.length; i++){
                     a.push(tr[i].id.split('m_tf')[1]);
              }
             var aa=JSON.stringify(a)
             $('.counter').val(JSON.parse(aa));*/
				
				cnt_multi=$('#cnt_multi').val();	 
				cnt_desc=$('#cnt_desc').val();
				cnt_fill=$('#cnt_fill').val();
				cnt_tf=$('#cnt_tf').val();
			
				if($('#cnt_multi').val()==""){	cnt_multi=0;	}
				else{	cnt_multi=parseInt($('#cnt_multi').val());	}


				if($('#cnt_desc').val()==""){	cnt_desc=0;	}
				else{	cnt_desc=parseInt($('#cnt_desc').val());	}


				if($('#cnt_fill').val()==""){	cnt_fill=0;	}
				else{	cnt_fill=parseInt($('#cnt_fill').val());	}


				if($('#cnt_tf').val()==""){	cnt_tf=0;	}
				else{	cnt_tf=parseInt($('#cnt_tf').val());	}		 	
				
				cnt_tf=cnt_tf+1;
			
				$('#cnt_tf').val(cnt_tf);
                	        var sum=0;	
	                        sum=cnt_multi+cnt_desc+cnt_fill+cnt_tf;
				$('#total_questions').val(sum);
			//	$('.counter4').val(sum);
		//	$('.counter').val(count);
                count=count+1;
               
			}
			//All data
			
				function QuestionPaperData(count)
			{		
				//multiple
				var MultiQue=$("#que_multi"+count).val();
				$("#MultiQue"+count).text(MultiQue);
				
				var MultiMarks=$("#m_marks"+count).val();
				$("#MultiMarks"+count).text(MultiMarks);
				var MultiNegMarks=$("#neg_multi"+count).val();
				$("#MultiNegMarks"+count).text(MultiNegMarks);
				
				//descriptive
				var DescQue=$("#que_desc"+count).val();
				$("#DescQue"+count).text(DescQue);

				
				var DescMarks=$("#marks_d"+count).val();
				$("#DescMarks"+count).text(DescMarks);
				var DescNegMarks=$("#neg_desc"+count).val();
				$("#DescNegMarks"+count).text(DescNegMarks);
				var DescAns=$("#ans_desc"+count).val();
				$("#DescAns"+count).text(DescAns);

				//fill in the blanks
				var QueFill1=$("#que1_fill"+count).val();
				$("#QueFill1"+count).text(QueFill1);
			
				var QueFill2=$("#que2_fill"+count).val();
				$("#QueFill2"+count).text(QueFill2);
				var FillMarks=$("#marks_f"+count).val();
				$("#FillMarks"+count).text(FillMarks);
				var FillNegMarks=$("#neg_fill"+count).val();
				$("#FillNegMarks"+count).text(FillNegMarks);
				
				
				//true false
				var TFQue=$("#que_tf"+count).val();
				$("#TFQue"+count).text(TFQue);
				var TFMarks=$("#m_tf"+count).val();
				$("#TFMarks"+count).text(TFMarks);
				var TFNegMarks=$("#neg_tf"+count).val();
				$("#TFNegMarks"+count).text(TFNegMarks);
				
			
				if($('#true_val'+count).is(":checked")) 
				{
      				  var TFAns=$('#true_val'+count).val();
				  $("#TFAns"+count).text(TFAns);
    				}
   				if($('#false_val'+count).is(":checked"))  
				{
       				  var TFAns=$('#false_val'+count).val();
				  $("#TFAns"+count).text(TFAns);
    				}
						
			}
			
			
			
			
			
			//Images
			
				function ShowImgMulti(input,count)
			{
				debugger;	
				if (input.files && input.files[0])
				 {
   					var reader = new FileReader();

   					 reader.onload = function(e)
					 {
     						 $('#ImageMulti'+count).attr('src', e.target.result);
				         	 $('#ImageMulti'+count).show();
				         	 
				         	var ImgMulti=$("#ImageMulti"+count).attr('src');
			            	var img_multi=$("#img_multi"+count).val();
			            	if(ImgMulti!=null)
			            	{
				            	$("#ImgMulti"+count).attr('src',ImgMulti);
				                $("#ImgMulti"+count).attr('width','100');
				            	$("#ImgMulti"+count).attr('height','100');
			            	}
			            	else
			            	{
			            		$("#ImgMulti"+count).attr('alt','no image selected');
			            	}
    					}

   					 reader.readAsDataURL(input.files[0]);
  				}
			}
			function ShowImgDesc(input,count)
			{
				debugger;
				if (input.files && input.files[0])
				 {
   					var reader = new FileReader();

   					 reader.onload = function(e)
					 {
     						 $('#ImageDesc'+count).attr('src', e.target.result);
						     $('#ImageDesc'+count).show();
						     var DescImg=$("#ImageDesc"+count).attr('src');
			            	var img_desc=$("#img_desc"+count).val();
			            	if(DescImg!=null)
			            	{
			            		$("#DescImg"+count).attr('src',DescImg);
            					$("#DescImg"+count).attr('width','100');
			            		$("#DescImg"+count).attr('height','100');
				            }
	            			else
		            		{
				            	$("#DescImg"+count).attr('alt','no image selected');
				            }
    					}

   					 reader.readAsDataURL(input.files[0]);
  				}
			}
			function ShowImgFill(input,cnt)
			{
				if(input.files && input.files[0])
				 {
   					var reader = new FileReader();

   					 reader.onload = function(e)
					 {
     						 $('#ImageFill'+cnt).attr('src', e.target.result);
				    		 $('#ImageFill'+cnt).show();
		   	    		 	 var FillImg=$("#ImageFill"+cnt).attr('src');
		               		 var img_fill=$("#img_fill"+cnt).val();
		                		if(FillImg!=null)
		                		{
		                			$("#FillImg"+cnt).attr('src',FillImg);
		                      		$("#FillImg"+cnt).attr('width','100');
		                			$("#FillImg"+cnt).attr('height','100');
			                	}
			                	else
			                	{
			                		$("#FillImg"+cnt).attr('alt','no image selected');
			                	}
    					}

   					 reader.readAsDataURL(input.files[0]);
  				}	
			}
			function ShowImgTF(input,cnt)
			{
				debugger;
				if(input.files && input.files[0])
				 {
   					var reader = new FileReader();

   					 reader.onload = function(e)
					 {
     						 $('#ImageTF'+cnt).attr('src', e.target.result);
					         $('#ImageTF'+cnt).show();
					         
					         	var TFImg=$("#ImageTF"+cnt).attr('src');
			                   	var imgtf=$("#imgtf"+cnt).val();
			                	if(TFImg!=null)
			                	{
	                				$("#TFImg"+cnt).attr('src',TFImg);
			                		$("#TFImg"+cnt).attr('width','100');
		                			$("#TFImg"+cnt).attr('height','100');
			                	}
	                			else
		                		{
			                		$("#TFImg"+cnt).attr('alt','no image selected');
			                	}
    					}

   					 reader.readAsDataURL(input.files[0]);
  				}
			}