
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
		    	               if($('#multiple_Form'+total[c]).is(':visible'))
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
		    	            if($('#descriptive_Form'+total[c]).is(':visible'))
		                    {
                                $('#DescRefDoc'+total[c]).removeAttr("disabled");
                                $('#DescRefPageNo'+total[c]).removeAttr("disabled");
		                    }
		    	        }
                    }
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
		    	            if($('#fill_Form'+total[c]).is(':visible'))
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
		    	            if($('#truefalse_Form'+total[c]).is(':visible'))
		                    {
                                $('#TFRefDoc'+total[c]).removeAttr("disabled");
                                $('#TFRefPageNo'+total[c]).removeAttr("disabled");
		                    }
		    	        }
                    }
			}	
		}
		
		function AddReferece()
		{
		         $('#NewPaperRefDoc').removeAttr('disabled');
		         
	        	     var Count=$('#TotalCount').val();
                     var ExecCount = Count.split(','); 
		            
        	           for(var c=0;c<ExecCount.length;c++)
        	          {
        	                $('#RefDocMulti'+ExecCount[c]).removeAttr('disabled');
        	                $('#RefDocMultiPageNo'+ExecCount[c]).removeAttr('disabled');
        	                $('#RefDocDesc'+ExecCount[c]).removeAttr('disabled');
        	                $('#RefDocDescPageNo'+ExecCount[c]).removeAttr('disabled');
        	                $('#RefDocFill'+ExecCount[c]).removeAttr('disabled');
        	                $('#RefDocFillPageNo'+ExecCount[c]).removeAttr('disabled');
        	                $('#RefDocTF'+ExecCount[c]).removeAttr('disabled');
        	                $('#RefDocTFPageNo'+ExecCount[c]).removeAttr('disabled'); 
        	          }
        	          
        	  var count=$('.counter').val();
                var total = count.split(',');
                
                for(var c=0;c<total.length;c++)
		    	{
                    $('#MultiRefDoc'+total[c]).removeAttr("disabled");
                    $('#MultiRefPageNo'+total[c]).removeAttr("disabled");
                    $('#DescRefDoc'+total[c]).removeAttr("disabled");
                    $('#DescRefPageNo'+total[c]).removeAttr("disabled");
                    $('#FillRefDoc'+total[c]).removeAttr("disabled");
                    $('#FillRefPageNo'+total[c]).removeAttr("disabled");   
                    $('#TFRefDoc'+total[c]).removeAttr("disabled");
                    $('#TFRefPageNo'+total[c]).removeAttr("disabled");
		    	}
		}

        function RemoveReferece()
        {
                debugger;
                     $('#NewPaperRefDoc').attr('disabled','disabled');
                     
                    var Count=$('#TotalCount').val();
                     var ExecCount = Count.split(','); 
                        
        	           for(var c=0;c<ExecCount.length;c++)
        	          {
        	                $('#RefDocMulti'+ExecCount[c]).attr('disabled','disabled');
        	                $('#RefDocMultiPageNo'+ExecCount[c]).attr('disabled','disabled');
        	                $('#RefDocDesc'+ExecCount[c]).attr('disabled','disabled');
        	                $('#RefDocDescPageNo'+ExecCount[c]).attr('disabled','disabled');
        	                $('#RefDocFill'+ExecCount[c]).attr('disabled','disabled');
        	                $('#RefDocFillPageNo'+ExecCount[c]).attr('disabled','disabled');
        	                $('#RefDocTF'+ExecCount[c]).attr('disabled','disabled');
        	                $('#RefDocTFPageNo'+ExecCount[c]).attr('disabled','disabled');
        	          }
        	          
        	          var count=$('.counter').val();
                var total = count.split(',');
                
                for(var c=0;c<total.length;c++)
		    	{
                    $('#MultiRefDoc'+total[c]).attr('disabled','disabled');
                    $('#MultiRefPageNo'+total[c]).attr("disabled","disabled");
                    $('#DescRefDoc'+total[c]).attr('disabled','disabled');
                    $('#DescRefPageNo'+total[c]).attr("disabled","disabled");   
                    $('#FillRefDoc'+total[c]).attr('disabled','disabled');
                    $('#FillRefPageNo'+total[c]).attr("disabled","disabled");    
                    $('#TFRefDoc'+total[c]).attr('disabled','disabled');
                    $('#TFRefPageNo'+total[c]).attr("disabled","disabled");
		    	}
        }
        
            function DisablePageNo(count)
            {
               debugger;
               if($('#RefDocMulti'+count).val()!="")
               {
                   if($('#RefDocMultiPageNo'+count).val()!="")
                   {
                       $('#RefDocMultiPageNo'+count).val('');
                   }
                   $('#RefDocMultiPageNo'+count).attr("disabled","disabled");
                   $('#RefDocMulti'+count).removeAttr("disabled");
               }
               if($('#RefDocDesc'+count).val()!="")
               {
                   if($('#RefDocDescPageNo'+count).val()!="")
                   {
                       $('#RefDocDescPageNo'+count).val('');
                   }
                   $('#RefDocDescPageNo'+count).attr("disabled","disabled");
                   $('#RefDocDesc'+count).removeAttr("disabled");
               } 
               if($('#RefDocFill'+count).val()!="")
               {
                   if($('#RefDocFillPageNo'+count).val()!="")
                   {
                       $('#RefDocFillPageNo'+count).val('');
                   }
                   $('#RefDocFillPageNo'+count).attr("disabled","disabled");
                   $('#RefDocFill'+count).removeAttr("disabled");
               }
               if($('#RefDocTF'+count).val()!="")
               {
                   if($('#RefDocTFPageNo'+count).val()!="")
                   {
                       $('#RefDocTFPageNo'+count).val('');
                   }
                   $('#RefDocTFPageNo'+count).attr("disabled","disabled");
                   $('#RefDocTF'+count).removeAttr("disabled");
               }
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
                if($('#RefDocMulti'+count).val()!="")
                {
                   $('#RefDocMultiPageNo'+count).attr("disabled","disabled");
                   $('#RefDocMulti'+count).removeAttr("disabled");
                }
                else
                {
                   $('#RefDocMultiPageNo'+count).removeAttr("disabled");
                   $('#RefDocMulti'+count).attr("disabled","disabled");
                }
                if($('#RefDocDesc'+count).val()!="")
                {
                   $('#RefDocDescPageNo'+count).attr("disabled","disabled");
                   $('#RefDocDesc'+count).removeAttr("disabled");
                }
                else
                {
                   $('#RefDocDescPageNo'+count).removeAttr("disabled");
                   $('#RefDocDesc'+count).attr("disabled","disabled");
                }
                if($('#RefDocFill'+count).val()!="")
                {
                   $('#RefDocFillPageNo'+count).attr("disabled","disabled");
                   $('#RefDocFill'+count).removeAttr("disabled");
                }
                else
                {
                   $('#RefDocFillPageNo'+count).removeAttr("disabled");
                   $('#RefDocFill'+count).attr("disabled","disabled");
                }
                if($('#RefDocTF'+count).val()!="")
                {
                   $('#RefDocTFPageNo'+count).attr("disabled","disabled");
                   $('#RefDocTF'+count).removeAttr("disabled");
                }
                else
                {
                   $('#RefDocTFPageNo'+count).removeAttr("disabled");
                   $('#RefDocTF'+count).attr("disabled","disabled");
                }
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
        
//multiple choice questions

	           var count=1;
    
                var a= new Array();

				var Multi=0;
			function multiple_form()
			{debugger;		
	
			var multiple_que=$('<div class="container" id="multiple_Form'+count+'" style="margin-bottom:20px;border:0.5px solid lightgray;padding:10px 0px;width:100%" class="mm"><span class="cls" title="close" onclick="DeleteDraftedQuestion(this)">X</span><div class="col-md-12" style="display:flow-root" id="multiple_que'+count+'"><div class="form-group"><label class="col-md-2">Question:</label><div class="col-md-8"><input type="text" onkeyup="javascript:capitalize(this.id, this.value);" id="que_multi'+count+'" name="question_multi'+count+'" class="form-control" oninput="QuePaperData('+count+');"></div><div class="col-md-2"></div></div><div class="form-group"><label class="col-md-2">Image:</label><div class="col-md-4"><img id="MultiImage'+count+'" width="100" height="100" style="display:none;"><input type="file" name="img_multi'+count+'" onchange="ValidateFiles(this); NewImages(this,'+count+');" id="ImgMulti'+count+'"></div></div><div class="form-group"><div class="col-md-12"><label>Please select any one option for mock test:</label></div></div><div class="form-group"><label class="col-md-2">Reference Document:</label><div class="col-md-3"><input type="file" id="MultiRefDoc'+count+'" onchange="DisablePageNo('+count+');" name="MultiRefDoc'+count+'" disabled></div><label class="col-md-1">OR</label><label class="col-md-2">Page No:</label><div class="col-md-2"><input type="text" disabled onfocus="DisableRefDoc('+count+')" id="MultiRefPageNo'+count+'" name="MultiRefPageNo'+count+'" onkeypress="return isNumberKey(event)" class="form-control"></div></div><div class="form-group"><label class="col-md-2">Marks:</label><div class="col-md-3"><input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="m_marks'+count+'" name="marks_multi'+count+'" onblur="AddNewQuesMarks(this);" oninput="QuePaperData('+count+');"></div><label class="col-md-2">Negative Marks:</label><div class="col-md-3"><input type="text" class="form-control" onkeypress="return onlyNumbersWithdash(event,this);" id="neg_multi'+count+'" name="negative_marks_multi'+count+'" oninput="QuePaperData('+count+');"></div></div><div class="form-group"><div class="col-md-12"><input type="button" value="Add Answers" onclick="add_answer_click('+count+');" id="btnMulti'+count+'"/></div></div><div class ="col-md-offset-10 col-md-2"><label>Correct Answer:</label></div>'+add_answer(count) +'</div></div>');

		
				$('#drafted').append(multiple_que);

			var CreatedMultipleForm=$('<div class="container" id="multiple_created'+count+'" style="margin-bottom:20px;background-color:#F8F8F8;padding:20px 0px;width:100%;border:0.5px solid lightgray;"><div class="col-md-12" id="CreatedMultiQ'+count+'"><div class="form-group"><label class="col-md-2">Question:</label><div class="col-md-8"><b><p class="wrap" id="NewMultiQue'+count+'"></p></b></div><div class="col-md-2"></div></div><div class="form-group"><label class="col-md-2">Image:</label><div class="col-md-4"><b><img id="multiImg'+count+'" alt="no image selected"></b></div><div class="col-md-3"><label>Marks:</label>&nbsp;&nbsp;<b><span id="NewMultiMarks'+count+'"></b></div><div class="col-md-3"><label>Negative Marks:</label>&nbsp;&nbsp;<b><span id="NewMultiNegMarks'+count+'"></span></b></div></div><div class="form-group"><div class="col-md-2"><label>Answers:</label></div><div class="col-md-8 AllMultipleAns">'+AddLabelMulti(count) +'</div></div></div></div>');

				$('#Createddrafted').append(CreatedMultipleForm);

				//$('.counter1').val(count1);
			//	count1=count1+1;
				
			
			 var resultObj = $(".counter");
    	        
    	            var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
                 resultObj .val( stringToAppend + count );
			

    	 /*  var tm = $('input[id^="m_marks'+count+'"]');
             for(var i=0; i < tm.length; i++){
                  a.push(tm[i].id.split('m_marks')[1]);
             }
             var aa=JSON.stringify(a)
             $('.counter').val(JSON.parse(aa));*/
				
               			var cnt_multi=$('#cnt_multi').val();	 
				var cnt_desc=$('#cnt_desc').val();
				var cnt_fill=$('#cnt_fill').val();
				var cnt_tf=$('#cnt_tf').val();

				if($('#cnt_multi').val()=="")	{	cnt_multi=0;	}
				else{	cnt_multi=parseInt($('#cnt_multi').val());	}


				if($('#cnt_desc').val()=="")	{	cnt_desc=0;		}
				else{	cnt_desc=parseInt($('#cnt_desc').val());	}


				if($('#cnt_fill').val()=="")	{	cnt_fill=0;		}
				else{	cnt_fill=parseInt($('#cnt_fill').val());	}

				
				if($('#cnt_tf').val()=="")	{	cnt_tf=0;		}
				else{	cnt_tf=parseInt($('#cnt_tf').val());	}	

				cnt_multi=cnt_multi+1;
		
				$('#cnt_multi').val(cnt_multi);                      
				var sum=0;	
	                        sum=cnt_multi+cnt_desc+cnt_fill+cnt_tf;
				$('#total_questions').val(sum);
				
					count=count+1;
			}
			
			
			
			function add_answer(count)
			{	
					debugger;		
				var ansCountMulti=$('input[id*="NewtxtAnsMulti'+count+'"]').length+1;
				$('#NewMultiAnsCount').val(ansCountMulti);
				return '<div class="form-group" id="newMulti'+count+'-'+ansCountMulti+'"><label class="col-md-2">Answer  '+ansCountMulti+':</label><div class="col-md-8"><input type="text" onkeyup="javascript:capitalize(this.id, this.value);" id="NewtxtAnsMulti'+count+'-'+ansCountMulti+'" name="NewtxtAnsMulti'+count+'-'+ansCountMulti+'" class="form-control" oninput="AddAnswerMulti('+count+','+ansCountMulti+');"></div><div class="col-md-2"><input type="hidden" name="NewChkAnsMulti'+count+'-'+ansCountMulti+'" value="0" /><input type="checkbox" id="ChkAnsMulti'+count+'-'+ansCountMulti+'" name="NewChkAnsMulti'+count+'-'+ansCountMulti+'" value="1"></div></div>';
			
			}
			function AddLabelMulti(count)
			{
				var LabelCount=$('p[id*="NewLabelAnsMulti'+count+'"]').length+1;

				return '<b><p class="wrap" id="NewLabelAnsMulti'+count+'-'+LabelCount+'"></p></b>';
			}
			function AddAnswerMulti(count,anscount)
			{
				$('#NewLabelAnsMulti'+count+'-'+anscount).text($('#NewtxtAnsMulti'+count+'-'+anscount).val());
			}
			function add_answer_click(cnt1)
			{
				$("#multiple_que"+cnt1).append(add_answer(cnt1));
				$('.AllMultipleAns').append(AddLabelMulti(cnt1));
			}
			
			
			
			
			
			
			//descriptive
			
			function descriptive_form()
			{
					debugger;
				
					var descriptive_que=$('<div class="container" id="descriptive_Form'+count+'" style="margin-bottom:20px;border:0.5px solid lightgray;padding:10px 0px;width:100%;"><span class="cls" title="close" onclick="DeleteDraftedQuestion(this)">X</span><div class="col-md-12" style="display:flow-root"><div class="form-group"><label class="col-md-2">Question:</label><div class="col-md-8"><input type="text" onkeyup="javascript:capitalize(this.id, this.value);" id="que_desc'+count+'" name="question_desc'+count+'" class="form-control" oninput="QuePaperData('+count+');"></div><div class="col-md-2"></div></div><div class="form-group"><label class="col-md-2">Image:</label><div class="col-md-4"><img id="DescImage'+count+'" width="100" height="100" style="display:none;"><input type="file" id="ImgDesc'+count+'" name="img_desc'+count+'" onchange="ValidateFiles(this); NewImages(this,'+count+');"></div></div><div class="form-group"><label class="col-md-2">Reference Document:</label><div class="col-md-3"><input type="file" id="DescRefDoc'+count+'" onchange="DisablePageNo('+count+');" name="DescRefDoc'+count+'" disabled></div><label class="col-md-1">OR</label><label class="col-md-2">Page No:</label><div class="col-md-2"><input type="text" onfocus="DisableRefDoc('+count+')" id="DescRefPageNo'+count+'" name="DescRefPageNo'+count+'" disabled onkeypress="return isNumberKey(event)" class="form-control"></div></div><div class="form-group"><label class="col-md-2">Marks:</label><div class="col-md-3"><input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="marks_d'+count+'" name="marks_desc'+count+'" onblur="AddNewQuesMarks(this);" oninput="QuePaperData('+count+');"></div><label class="col-md-2">Negative Marks:</label><div class="col-md-3"><input type="text" class="form-control" onkeypress="return onlyNumbersWithdash(event,this);" id="neg_desc'+count+'" name="negative_marks_desc'+count+'" oninput="QuePaperData('+count+');"></div></div><div class="form-group"><label class="col-md-2">Answer:</label><div class="col-md-8"><textarea onkeyup="javascript:capitalize(this.id, this.value);" id="ans_desc'+count+'" name="ans_desc'+count+'" class="form-control" oninput="QuePaperData('+count+');"></textarea></div><div class="col-md-2"></div></div></div></div>');


			$('#drafted').append(descriptive_que);

					var CreatedDescriptive=$('<div class="container" id="descriptive_created'+count+'" style="margin-bottom:20px;background-color:#F8F8F8;padding:20px 0px;width:100%;border:0.5px solid lightgray;"><div class="col-md-12"><div class="form-group"><label class="col-md-2">Question:</label><div class="col-md-8"><b><p class="wrap" id="NewDescQue'+count+'"></p></b></div><div class="col-md-2"></div></div><div class="form-group"><label class="col-md-2">Image:</label><div class="col-md-4"><b><img id="descimg'+count+'" alt="no image selected"></b></div><div class="col-md-3"><label>Marks:</label>&nbsp;&nbsp;<b><span id="NewDescMarks'+count+'"></span></b></div><div class="col-md-3"><label>Negative Marks:</label>&nbsp;&nbsp;<b><span id="NewDescNegMarks'+count+'"></span></b></div></div><div class="form-group"><label class="col-md-2">Answer:</label><div class="col-md-8"><b><span class="wrap" id="NewDescAns'+count+'"></span></b></div><div class="col-md-2"></div></div></div></div>');

			$('#Createddrafted').append(CreatedDescriptive);
		
		//	$('.counter2').val(count2);
		//	count2=count2+1;
			
			 var resultObj = $(".counter");
    	        
    	            var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
                 resultObj .val( stringToAppend + count );
		
    	        debugger;
         /*       var tm = $('input[id^="marks_d'+count+'"]');
             for(var i=0; i < tm.length; i++){
                  a.push(tm[i].id.split('marks_d')[1]);
             }
             var aa=JSON.stringify(a)
             $('.counter').val(JSON.parse(aa));*/
			
			var cnt_multi=$('#cnt_multi').val();	 
			var cnt_desc=$('#cnt_desc').val();
			var cnt_fill=$('#cnt_fill').val();
			var cnt_tf=$('#cnt_tf').val();
 		
			if($('#cnt_multi').val()=="")	{	cnt_multi=0;	}
			else{	cnt_multi=parseInt($('#cnt_multi').val());	}


			if($('#cnt_desc').val()=="")	{	cnt_desc=0;		}
			else{	cnt_desc=parseInt($('#cnt_desc').val());	}


			if($('#cnt_fill').val()=="")	{	cnt_fill=0;		}
			else{	cnt_fill=parseInt($('#cnt_fill').val());	}


			if($('#cnt_tf').val()=="")	{	cnt_tf=0;		}
			else{	cnt_tf=parseInt($('#cnt_tf').val());	}	

			cnt_desc=cnt_desc+1;					
                      
			$('#cnt_desc').val(cnt_desc);
			var sum=0;	
	                        sum=cnt_multi+cnt_desc+cnt_fill+cnt_tf;
			 $('#total_questions').val(sum);

	             count=count+1;
			}
		
		
		    //fill in the blanks
		    function fill_form()
			{
				debugger;
					var fill=$('<div class="container" id="fill_Form'+count+'" style="margin-bottom:20px;border:0.5px solid lightgray;padding:10px 0px;width:100%;"><span class="cls" title="close" onclick="DeleteDraftedQuestion(this)" style="margin-bottom:10px;">X</span><div class="col-md-12" style="display:flow-root" id="fill_que'+count+'"><div class="form-group"><label class="col-md-2">Question:</label><div class="col-md-4"><input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onblur="SameQuestionFill(this)" id="que1_fill'+count+'" name="que1_fill'+count+'" class="form-control" oninput="QuePaperData('+count+');"></div><label class="col-md-2">_ _ _ _ _ _ _ _ _</label><div class="col-md-4"><input type="text"  id="que2_fill'+count+'" name="que2_fill'+count+'" class="form-control fill" oninput="QuePaperData('+count+');"></div></div><div class="form-group"><label class="col-md-2">Image:</label><div class="col-md-4"><img width="100" height="100" style="display:none;" id="FillImage'+count+'"><input type="file" name="img_fill'+count+'" onchange="ValidateFiles(this); NewImages(this,'+count+');" id="ImgFill'+count+'"></div></div><div class="form-group"><label class="col-md-2">Reference Document:</label><div class="col-md-3"><input type="file" id="FillRefDoc'+count+'" onchange="DisablePageNo('+count+');" name="FillRefDoc'+count+'" disabled></div><label class="col-md-1">OR</label><label class="col-md-2">Page No:</label><div class="col-md-2"><input type="text" id="FillRefPageNo'+count+'" name="FillRefPageNo'+count+'" onfocus="DisableRefDoc('+count+')" class="form-control" onkeypress="return isNumberKey(event)" disabled></div></div><div class="form-group"><label class="col-md-2">Marks:</label><div class="col-md-3"><input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="marks_f'+count+'" name="marks_fill'+count+'" onblur="AddNewQuesMarks(this);" oninput="QuePaperData('+count+');"></div><label class="col-md-2">Negative Marks:</label><div class="col-md-3"><input type="text" class="form-control" onkeypress="return onlyNumbersWithdash(event,this);" id="neg_fill'+count+'" name="negative_marks_fill'+count+'" oninput="QuePaperData('+count+');"></div></div><div class="form-group"><div class="col-md-12"><input type="button" value="Add Answers" onclick="add_answerFill_click('+count+');"/></div></div><div class ="col-md-offset-10 col-md-2"><label>Correct Answer:</label></div>'+add_answer_fill(count)+'</div></div>');

				
				$('#drafted').append(fill);

					var CreatedFill=$('<div class="container" id="fill_created'+count+'" style="margin-bottom:20px;border:0.5px solid lightgray;padding:20px 0px;width:100%;background-color:#F8F8F8;"><div class="col-md-12" id="NewFillQ'+count+'"><div class="form-group"><label class="col-md-2">Question:</label><div class="col-md-8"><b><span  class="wrap" id="NewFillQue1'+count+'"></span><span>_____</span><span  class="wrap" id="NewFillQue2'+count+'"></span></b></div></div><div class="form-group"><label class="col-md-2">Image:</label><div class="col-md-4"><b><img id="fillimg'+count+'" alt="no image selected"></b></div><div class="col-md-3"><label>Marks:</label>&nbsp;&nbsp;<b><span id="NewFillMarks'+count+'"></span></b></div><div class="col-md-3"><label>Negative Marks:</label>&nbsp;&nbsp;<b><span id="NewFillNegMarks'+count+'"></span></b></div></div><div class="form-group"><div class="col-md-2"><label>Answers:</label></div><div class="col-md-8 AllFillAns wrap">'+AddLabelFill(count)+'</div></div></div></div>');

				$('#Createddrafted').append(CreatedFill);

				//$('.counter3').val(count3);
			//	count3=count3+1;
				
				//	var a= new Array();
		/*		 var tf = $('input[id^="marks_f'+count+'"]');
               for(var i=0; i < tf.length; i++){
                     a.push(tf[i].id.split('marks_f')[1]);
              }
             var aa=JSON.stringify(a)
             $('.counter').val(JSON.parse(aa));*/
             
              var resultObj = $(".counter");
    	        
    	            var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
                 resultObj .val( stringToAppend + count );
			
				var cnt_multi=$('#cnt_multi').val();	 
				var cnt_desc=$('#cnt_desc').val();
				var cnt_fill=$('#cnt_fill').val();
				var cnt_tf=$('#cnt_tf').val();
 				
				if($('#cnt_multi').val()=="")	{	cnt_multi=0;		}
				else{	cnt_multi=parseInt($('#cnt_multi').val());	}


				if($('#cnt_desc').val()=="")	{	cnt_desc=0;		}
				else{	cnt_desc=parseInt($('#cnt_desc').val());	}


				if($('#cnt_fill').val()=="")	{	cnt_fill=0;		}
				else{	cnt_fill=parseInt($('#cnt_fill').val());	}


				if($('#cnt_tf').val()=="")	{	cnt_tf=0;		}
				else{	cnt_tf=parseInt($('#cnt_tf').val());	}	
					
				cnt_fill=cnt_fill+1;
				$('#cnt_fill').val(cnt_fill);
				var sum=0;	
	                        sum=cnt_multi+cnt_desc+cnt_fill+cnt_tf;
				$('#total_questions').val(sum);
				
				 count=count+1;
			}


            function AnsCheckedFillNew(obj,count,count1)
			{
					debugger;
	    				var checked = $(obj).is(':checked');
	    				$(".ChkkFill"+count).prop('checked',false);
	    				if(checked)
					 {
		        			$(obj).prop('checked',true);
	      				 }
			}
			
			function add_answer_fill(countFill)
			{	
				var ansCountFill=$('input[id*="NewtxtAnsfill'+countFill+'"]').length+1;
				$('#NewFillAnsCount').val(ansCountFill);			
				return '<div class="form-group" id="newFill'+countFill+'-'+ansCountFill+'"><label class="col-md-2">Answer  '+ansCountFill+':</label><div class="col-md-8"><input type="text" onkeyup="javascript:capitalize(this.id, this.value);" id="NewtxtAnsfill'+countFill+'-'+ansCountFill+'" name="NewtxtAnsfill'+countFill+'-'+ansCountFill+'" class="form-control" oninput="AddAnswerFill('+countFill+','+ansCountFill+');"></div><div class="col-md-2"><input type="hidden" name="NewChkAnsfill'+countFill+'-'+ansCountFill+'" value="0"><input type="checkbox" onchange="AnsCheckedFillNew(this,'+countFill+','+ansCountFill+');" class="ChkkFill'+countFill+'" name="NewChkAnsfill'+countFill+'-'+ansCountFill+'" id="chkk'+countFill+'-'+ansCountFill+'" value="1"></div></div>';
			}
			function AddLabelFill(count)
			{
				var LabelCount=$('p[id*="NewLabelAnsFill'+count+'"]').length+1;
				return '<b><p class="wrap" id="NewLabelAnsFill'+count+'-'+LabelCount+'"></p></b>';
			}
			function AddAnswerFill(count,anscount)
			{
				$('#NewLabelAnsFill'+count+'-'+anscount).text($('#NewtxtAnsfill'+count+'-'+anscount).val());
			}
			function add_answerFill_click(cntFill)
			{
				
				$('#fill_que'+cntFill).append(add_answer_fill(cntFill));
				$('.AllFillAns').append(AddLabelFill(cntFill));
			}

			
			//true false
			
			function trueFalse_form()
			{
					debugger;

					var true_false_qa=$('<div class="container" id="truefalse_Form'+count+'" style="margin-bottom:20px;border:0.5px solid lightgray;padding:10px 0px;width:100%"><span class="cls" title="close" onclick="DeleteDraftedQuestion(this)">X</span><div class="col-md-12" style="display:flow-root"><div class="form-group"><label class="col-md-2">Question:</label><div class="col-md-8"><input type="text" onkeyup="javascript:capitalize(this.id, this.value);" id="que_tf'+count+'" name="question_true_false'+count+'" class="form-control" oninput="QuePaperData('+count+');"></div><div class="col-md-2"></div></div><div class="form-group"><label class="col-md-2">Image:</label><div class="col-md-4"><img width="100" height="100" style="display:none;" id="TFImage'+count+'"><input type="file" name="img_true_false'+count+'" id="ImgTF'+count+'" onchange="ValidateFiles(this); NewImages(this,'+count+');"></div></div><div class="form-group"><label class="col-md-2">Reference Document:</label><div class="col-md-3"><input type="file" id="TFRefDoc'+count+'" onchange="DisablePageNo('+count+');" name="TFRefDoc'+count+'" disabled></div><label class="col-md-1">OR</label><label class="col-md-2">Page No:</label><div class="col-md-2"><input type="text" class="form-control" id="TFRefPageNo'+count+'" name="TFRefPageNo'+count+'" onfocus="DisableRefDoc('+count+')" onkeypress="return isNumberKey(event)" disabled></div></div><div class="form-group"><label class="col-md-2">Marks:</label><div class="col-md-3"><input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="m_tf'+count+'" name="marks_tf'+count+'" onblur="AddNewQuesMarks(this);" oninput="QuePaperData('+count+');"></div><label class="col-md-2">Negative Marks:</label><div class="col-md-3"><input type="text" class="form-control" onkeypress="return onlyNumbersWithdash(event,this);" id="neg_tf'+count+'" name="negative_marks_tf'+count+'" oninput="QuePaperData('+count+');"></div></div><div class="form-group"><label class="col-md-2">Answer:</label><div class="col-md-7" style="padding:0px;"><div class="radio"><label><input type="radio" id="true_val'+count+'" name="true_false'+count+'" value="True" onchange="QuePaperData('+count+');">True</label>&nbsp;&nbsp;<label><input type="radio" id="false_val'+count+'" name="true_false'+count+'" value="False" onchange="QuePaperData('+count+');">False</label></div></div><div class="col-md-3"></div></div></div></div>');

				$('#drafted').append(true_false_qa);

					var CreatedTF=$('<div class="container" id="truefalse_created'+count+'" style="margin-bottom:20px;border:0.5px solid lightgray;padding:10px 0px;width:100%;background-color:#F8F8F8;"><div class="col-md-12"><div class="form-group"><label class="col-md-2">Question:</label><div class="col-md-8"><b><span class="wrap" id="NewTFQue'+count+'"></span></b></div><div class="col-md-2"></div></div><div class="form-group"><label class="col-md-2">Image:</label><div class="col-md-4"><b><img id="tfimg'+count+'" alt="no image selected"></b></div><div class="col-md-3"><label>Marks:</label>&nbsp;&nbsp;<b><span id="NewTFMarks'+count+'"></span></b></div><div class="col-md-3"><label>Negative Marks:</label>&nbsp;&nbsp;<b><span id="NewTFNegMarks'+count+'"></span></b></div></div><div class="form-group"><label class="col-md-2">Answer:</label><div class="col-md-10"><b><p id="NewTFAns'+count+'"></p></b></div></div></div></div>');

				$('#Createddrafted').append(CreatedTF);
				
				 var resultObj = $(".counter");
    	        
    	            var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
                 resultObj .val( stringToAppend + count );
				
				//$('.counter4').val(count4);
			//	count4=count4+1;
				
				//	var a= new Array();
		/*		 var tr = $('input[id^="m_tf'+count+'"]');
               for(var i=0; i < tr.length; i++){
                     a.push(tr[i].id.split('m_tf')[1]);
              }
             var aa=JSON.stringify(a)
             $('.counter').val(JSON.parse(aa));*/
			
				var cnt_multi=$('#cnt_multi').val();	 
				var cnt_desc=$('#cnt_desc').val();
				var cnt_fill=$('#cnt_fill').val();
				var cnt_tf=$('#cnt_tf').val();

				if($('#cnt_multi').val()=="")	{	cnt_multi=0;	}
				else{	cnt_multi=parseInt($('#cnt_multi').val());	}


				if($('#cnt_desc').val()=="")	{	cnt_desc=0;		}
				else{	cnt_desc=parseInt($('#cnt_desc').val());	}


				if($('#cnt_fill').val()=="")	{	cnt_fill=0;		}
				else{	cnt_fill=parseInt($('#cnt_fill').val());	}


				if($('#cnt_tf').val()=="")	{	cnt_tf=0;		}
				else{	cnt_tf=parseInt($('#cnt_tf').val());	}		 	
				
				cnt_tf=cnt_tf+1;
			
			$('#cnt_tf').val(cnt_tf);
                       var sum=0;	
	                        sum=cnt_multi+cnt_desc+cnt_fill+cnt_tf;
				 $('#total_questions').val(sum);
				 
				  count=count+1;

			}


            //question types
            
        
		
		
		//existing multiple choice question
		
			function AddAnsMulti(count)
		{
				
				var ansCount=$('input[id*="txtAnsMulti'+count+'"]').length+1;
				$('#MultiansCount').val(ansCount);
				return '<div class="form-group" id="newMulti'+count+'"><label class="col-md-2">Answer  '+ansCount+':</label><div class="col-md-8"><input type="text" onkeyup="javascript:capitalize(this.id, this.value);" id="txtAnsMulti'+count+'-'+ansCount+'" name="AnsMulti'+count+'-'+ansCount+'" class="form-control" oninput="MutliExecAdditionalAns('+count+','+ansCount+');"></div><div class="col-md-2"><input type="hidden" name="AnsMultiChkk'+count+'-'+ansCount+'" value="0" /><input type="checkbox" id="ChkAnsMulti'+count+'-'+ansCount+'" name="AnsMultiChkk'+count+'-'+ansCount+'" value="1"></div></div>';


		}
		function AddNewAnsMulti(quecnt)
		{
			debugger;
			$("#MultipleQ"+quecnt).append(AddAnsMulti(quecnt));
			$('.ExecAllMuitipleAns').append(AddLabelMultiExec(quecnt));
			
		}
		function MutliExecAns(count,count1)
		{
			debugger;
			var txtAnsMulti=$('#txtAnsMulti'+count+'-'+count1).val();
			$('#AnsMulti'+count+'-'+count1).text(txtAnsMulti);
			
		}
		function MutliExecAdditionalAns(count,count1)
		{
			debugger;
			var txtAnsMulti1=$('#txtAnsMulti'+count+'-'+count1).val();
			$('#AnsLabel'+count+'-'+count1).text(txtAnsMulti1);
			
		}
		function AddLabelMultiExec(count)
		{
			
			var LabelCount=$('input[id*="txtAnsMulti'+count+'"]').length;
			return '<b><p class="wrap" id="AnsLabel'+count+'-'+LabelCount+'"></p></b>';
		}
		
		//existing fill in the blanks
		
			function AddAnsFill(countfill)
		{
				debugger;
				var anscount=$('input[id*="txtAnsFill'+countfill+'"]').length+1;
				$('#FillAnsCount').val(anscount);
				return '<div class="form-group" id="newMulti'+countfill+'"><label class="col-md-2">Answer  '+anscount+':</label><div class="col-md-8"><input type="text" onkeyup="javascript:capitalize(this.id, this.value);" id="txtAnsFill'+countfill+'-'+anscount+'" name="AnsFill'+countfill+'-'+anscount+'" class="form-control" oninput="FillExecAdditionalAns('+countfill+','+anscount+');"></div><div class="col-md-2"><input type="hidden" name="AddChkAnsFill'+countfill+'-'+anscount+'" value="0" /><input type="checkbox" id="ChkAnsFill'+countfill+'-'+anscount+'" class="chkfill'+countfill+'" onchange="AnsCheckedFillDB(this,'+countfill+','+anscount+'); AddCheckedAns(this);" name="AddChkAnsFill'+countfill+'-'+anscount+'" value="1" ></div></div>';


		}
		function AddLabelFillExec(count)
		{
			var ansfillcount=$('input[id*="txtAnsFill'+count+'"]').length;
			return '<b><p class="wrap" id="AnsFillLabel'+count+'-'+ansfillcount+'"></p></b>';
		}
		function FillExecAns(count,anscount)
		{
			debugger;
			var txtAnsFill=$('#txtAnsFill'+count+'-'+anscount).val();
			$('#FillAns'+count+'-'+anscount).text(txtAnsFill);
		}
		function FillExecAdditionalAns(count,count1)
		{
			var txtAnsFill=$('#txtAnsFill'+count+'-'+count1).val();
			$('#AnsFillLabel'+count+'-'+count1).text(txtAnsFill);
		}
		function AddNewAnsFill(quecntfill)
		{
			debugger;
			
				$("#FillQ"+quecntfill).append(AddAnsFill(quecntfill));
				$('.ExecAllFillAns').append(AddLabelFillExec(quecntfill));
		}
	
		function AnsCheckedFillDB(obj,count)
		 {
				debugger;
	    				var checked = $(obj).is(':checked');
	    				$(".chkfill"+count).prop('checked',false);
	    				if(checked)
					 {
		        			$(obj).prop('checked',true);
	      				 }
		}

	
	
	    //existing data
	    
	    function Data(cnt)
		{
			//multiple
			$('#MultiQue'+cnt).text($('#Quemulti'+cnt).val());
			$('#MultiMarks'+cnt).text($('#MarksMulti-'+cnt).val());
			$('#MultiNegMarks'+cnt).text($('#NegMarksMulti'+cnt).val());

			//descriptive
			$('#DescQue'+cnt).text($('#QueDesc'+cnt).val());
			$('#DescMarks'+cnt).text($('#MarksDesc-'+cnt).val());
			$('#DescNegMarks'+cnt).text($('#NegMarksDesc'+cnt).val());
			$('#DescAns'+cnt).text($('#AnsDesc'+cnt).val());

			//fill in the blanks
			$('#FillQue1'+cnt).text($('#QueFill1'+cnt).val());
			$('#FillQue2'+cnt).text($('#QueFill2'+cnt).val());
			$('#FillMarks'+cnt).text($('#MarksFill-'+cnt).val());
			$('#FillNegMarks'+cnt).text($('#NegMarksFill'+cnt).val());

			//true false
			$('#TFQue'+cnt).text($('#QueTF'+cnt).val());
			$('#TFMarks'+cnt).text($('#MarksTF-'+cnt).val());
		}
		
		//new data
		
		function QuePaperData(count)
			{
				//multiple
				$('#NewMultiQue'+count).text($('#que_multi'+count).val());
				$('#NewMultiMarks'+count).text($('#m_marks'+count).val());	
				$('#NewMultiNegMarks'+count).text($('#neg_multi'+count).val());

				//descriptive
				$('#NewDescQue'+count).text($('#que_desc'+count).val()); 
				$('#NewDescMarks'+count).text($('#marks_d'+count).val());  
				$('#NewDescNegMarks'+count).text($('#neg_desc'+count).val()); 
				$('#NewDescAns'+count).text($('#ans_desc'+count).val());

				//fill in the blanks
				$('#NewFillQue1'+count).text($('#que1_fill'+count).val());
				$('#NewFillQue2'+count).text($('#que2_fill'+count).val());
				$('#NewFillMarks'+count).text($('#marks_f'+count).val());  
				$('#NewFillNegMarks'+count).text($('#neg_fill'+count).val());   

				//true false
				$('#NewTFQue'+count).text($('#que_tf'+count).val()); 
				$('#NewTFMarks'+count).text($('#m_tf'+count).val());  
				$('#NewTFNegMarks'+count).text($('#neg_tf'+count).val());  

				if($('#true_val'+count).is(":checked")) 
				{
      				  var TFAns=$('#true_val'+count).val();
				  $("#NewTFAns"+count).text(TFAns);
    				}
   				if($('#false_val'+count).is(":checked"))  
				{
       				  var TFAns=$('#false_val'+count).val();
				  $("#NewTFAns"+count).text(TFAns);
    				}
			}
			
			
	/*	function GetPaperRefDoc(input)
		{
		    debugger;
		    var path=input.value;
		    $('#OldPaperDocRef').attr('href',path);
		    
		 if (input.files && input.files[0]) {            

                    var reader = new FileReader();              
                     reader.onload = function (e) {               
                        // alert('alert');
                            
                         //   $('#OldPaperDocRef').remove();
						     //$('#OldPaperDocRef').attr('visibility','hidden');
						    // $('#ShowReplPaperRefDoc').show();
                    };               
 reader.readAsDataURL(input.files[0]);        
 } 
		}*/
			
			
			//existing images
			
				function ShowImg(input,count)
		{
				debugger;
				if(input.id=='ImgMulti'+count)
				{	
					if(input.files && input.files[0])
					 {
						var reader = new FileReader();
   						 reader.onload = function(e)
						 {
     							$('#ImageMulti'+count).attr('src', e.target.result);
							$('#ImageMulti'+count).show();
							$('#ExistingImgMulti'+count).hide();
							var ImageMulti=$('#ImageMulti'+count).attr('src');
							if(ImageMulti!=null)
							{
								$('#CreatedImgMulti'+count).attr('src',ImageMulti);
								$('#CreatedImgMulti'+count).attr('width',100);
								$('#CreatedImgMulti'+count).attr('height',100);
							}
							else
							{
								$('#CreatedImageMulti'+count).attr('alt','no image selected');
							}
    						}
   						 reader.readAsDataURL(input.files[0]);
  					}
				}
				if(input.id=='ImgDesc'+count)
				{
					if(input.files && input.files[0])
					 {
   						var reader = new FileReader();
   						 reader.onload = function(e)
						 {
     							 $('#ImageDesc'+count).attr('src', e.target.result);
							 $('#ImageDesc'+count).show();
							 $('#ExistingImgDesc'+count).hide();
							 var ImageDesc=$('#ImageDesc'+count).attr('src');
							if(ImageDesc!=null)
							{
								$('#CreatedImageDesc'+count).attr('src',ImageDesc);
								$('#CreatedImageDesc'+count).attr('width',100);
								$('#CreatedImageDesc'+count).attr('height',100);
							}							 				 				else
							{
								$('#CreatedImageDesc'+count).attr('alt','no image selected');
							}
							
    						 }
   						 reader.readAsDataURL(input.files[0]);
  					}
				}
				if(input.id=='ImgFill'+count)
				{
					if(input.files && input.files[0])
					{
   						var reader = new FileReader();

   						 reader.onload = function(e)
						 {
     							 $('#ImageFill'+count).attr('src', e.target.result);
							 $('#ImageFill'+count).show();
							 $('#ExistingImgFill'+count).hide();
							 var ImageFill=$('#ImageFill'+count).attr('src');
							 if(ImageFill!=null)
							 {
							  	$('#CreatedImageFill'+count).attr('src',ImageFill);
								$('#CreatedImageFill'+count).attr('width',100);
								$('#CreatedImageFill'+count).attr('height',100);
							 }
							 else
							 {
								$('#CreatedImageFill'+count).attr('alt','no image selected');
							 }
							
    						 }
   						 reader.readAsDataURL(input.files[0]);
  					}
				}
				if(input.id=='ImgTF'+count)
				{
					if(input.files && input.files[0])
				 	{
   						var reader = new FileReader();
   						 reader.onload = function(e)
						 {
     							 $('#ImageTF'+count).attr('src', e.target.result);
							 $('#ImageTF'+count).show();
							 $('#ExistingImgTF'+count).hide();
							 var ImageTF=$('#ImageTF'+count).attr('src');
							 if(ImageTF!=null)
							 {
								$('#CreatedImageTF'+count).attr('src',ImageTF);
								$('#CreatedImageTF'+count).attr('width',100);
								$('#CreatedImageTF'+count).attr('width',100);
							 }	
							 else
							 {
								$('#CreatedImageTF'+count).attr('alt','no image selected');
							 }
    					       	 }
   						 reader.readAsDataURL(input.files[0]);
  					}
				}		
		}
		
		
		
		//new images
		
			function NewImages(input,count)
			{
				if(input.id=='ImgMulti'+count)
				{
					if (input.files && input.files[0])
					{
   						var reader = new FileReader();
   						reader.onload = function(e)
					 	{
     							 $('#MultiImage'+count).attr('src', e.target.result);
						   	 $('#MultiImage'+count).show();
					 		 var imagemulti=$("#MultiImage"+count).attr('src');
						       
							 if(imagemulti!=null)
							 {
								$("#multiImg"+count).attr('src',imagemulti);
								$("#multiImg"+count).attr('width','100');
								$("#multiImg"+count).attr('height','100');
							 }
							 else
							 {
								$("#multiImg"+count).attr('alt','no image selected');
							 }
    						}
   						 reader.readAsDataURL(input.files[0]);
  					}
			
				}
				if(input.id=='ImgDesc'+count)
				{
					if (input.files && input.files[0])
					{
   						var reader = new FileReader();
   						reader.onload = function(e)
					 	{
     							 $('#DescImage'+count).attr('src', e.target.result);
						   	 $('#DescImage'+count).show();
					 		 var imagedesc=$("#DescImage"+count).attr('src');
						       
							 if(imagedesc!=null)
							 {
								$("#descimg"+count).attr('src',imagedesc);
								$("#descimg"+count).attr('width','100');
								$("#descimg"+count).attr('height','100');
							 }
							 else
							 {
								$("#descimg"+count).attr('alt','no image selected');
							 }
    						}
   						 reader.readAsDataURL(input.files[0]);
  					}
			
				}
				if(input.id=='ImgFill'+count)
				{
					if (input.files && input.files[0])
					{
   						var reader = new FileReader();
   						reader.onload = function(e)
					 	{
     							 $('#FillImage'+count).attr('src', e.target.result);
						   	 $('#FillImage'+count).show();
					 		 var imagefill=$("#FillImage"+count).attr('src');
						       
							 if(imagefill!=null)
							 {
								$("#fillimg"+count).attr('src',imagefill);
								$("#fillimg"+count).attr('width','100');
								$("#fillimg"+count).attr('height','100');
							 }
							 else
							 {
								$("#fillimg"+count).attr('alt','no image selected');
							 }
    						}
   						 reader.readAsDataURL(input.files[0]);
  					}
			
				}   
				if(input.id=='ImgTF'+count)
				{
					if (input.files && input.files[0])
					{
   						var reader = new FileReader();
   						reader.onload = function(e)
					 	{
     							 $('#TFImage'+count).attr('src', e.target.result);
						   	 $('#TFImage'+count).show();
					 		 var imagetf=$("#TFImage"+count).attr('src');
						       
							 if(imagetf!=null)
							 {
								$("#tfimg"+count).attr('src',imagetf);
								$("#tfimg"+count).attr('width','100');
								$("#tfimg"+count).attr('height','100');
							 }
							 else
							 {
								$("#tfimg"+count).attr('alt','no image selected');
							 }
    						}
   						 reader.readAsDataURL(input.files[0]);
  					}
				}	  
			}