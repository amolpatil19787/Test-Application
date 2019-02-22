function ValidateDraftedPaper()
{
	//alert('hello');
	debugger;
	MultiType=$('#QueType1').val();
	DescType=$('#QueType2').val();
	FillType=$('#QueType3').val();
	TFType=$('#QueType4').val();
	
	
	var count=$('.counter').val();
    var total = count.split(',');

        var TestTypeCount=$('#mycontainer').find('input[type=radio]:checked').length;
        var ExamCoordinator=$('#checkboxes').find('input[type=checkbox]:checked').length;

	var flag=false;	

	var CommonQesIDs = new Array();

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
	if($('#date').val()=="")
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
	if($('#Marks').val()=="")
	{
		//alert('Please enter total marks');
		$('#Marks').focus();
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
     if(TestTypeCount==0)
	{
			    $.alert({
				        	    title: '',
                         content: 'Please select test type!'
                    });
                    flag=true;
				return false;
	}
	if(MultiType=='Multiple choice questions')
	{
		CommonQesIDs = GetQuestionsIDsSameType("MultiQueID");
		for(var m=0;m<CommonQesIDs.length;m++)
		{
		    if($('#Multiple_Form'+CommonQesIDs[m]).is(':visible'))
			{
		    
			var MultiChKCount=$('#Multiple_Form'+CommonQesIDs[m]).find('input[type=checkbox]:checked').length;

				//$('#MultipleForm'+CommonQesIDs[m]).find('input[type=checkbox]:checked').length;

			if($("#Quemulti"+CommonQesIDs[m]).val() =="")
			{
				//alert('Question cannot be blank');
				$("#Quemulti"+CommonQesIDs[m]).focus();
					$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
				flag=true;
				return false;
			}
			else if($('#MarksMulti-'+CommonQesIDs[m]).val() =="")
			{
				//alert('Marks cannot be blank');
				$('#MarksMulti-'+CommonQesIDs[m]).focus();
				$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
				flag=true;
				return false;
			}
			else if($('#NegMarksMulti'+CommonQesIDs[m]).val() =="")
			{
				//alert('Negative marks cannot be blank');
				$('#NegMarksMulti'+CommonQesIDs[m]).focus();
				$.alert({
				        	    title: '',
                         content: 'Negative marks cannot be blank!'
                    });
				flag=true;
				return false;
			}
			
			    MultiansCount=$('input[id*="txtAnsMulti'+CommonQesIDs[m]+'"]').length;
			    //alert(MultiansCount);
				for(var i=1;i<=MultiansCount;i++)
				{
					if($('#txtAnsMulti'+CommonQesIDs[m]+'-'+i).val()=="")
					{
					//	alert('Answer cannot be blank');
						$('#txtAnsMulti'+CommonQesIDs[m]+'-'+i).focus();
						$.alert({
				        	    title: '',
                         content: 'Answer cannot be blank!'
                    });
						flag=true;
						return false;
					}
				}

			if(MultiChKCount<=0)
			{
				//alert('Please select atleast one correct answer');
				$.alert({
				        	    title: '',
                         content: 'Please select atleast one correct answer!'
                    });
				flag=true;	
				return false;
			}
		}
	}
	}
	if(DescType=='Descriptive questions')
	{
		CommonQesIDs = GetQuestionsIDsSameType("DescQueID");
		
		for(var d=0;d<CommonQesIDs.length;d++)
		{
		    if($('#Desc_Form'+CommonQesIDs[d]).is(':visible'))
			{
			if($("#QueDesc"+CommonQesIDs[d]).val() =="")
			{
				//alert('Question cannot be blank');
				$("#QueDesc"+CommonQesIDs[d]).focus();
				$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			else if($("#MarksDesc-"+CommonQesIDs[d]).val() =="")
			{
				//alert('Marks cannot be blank');
					$("#MarksDesc-"+CommonQesIDs[d]).focus();
				$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
				flag=true;
				return false;
			}
			else if($("#NegMarksDesc"+CommonQesIDs[d]).val() =="")
			{
				//alert('Negative Marks cannot be blank');
			    $("#NegMarksDesc"+CommonQesIDs[d]).focus();
					$.alert({
				        	    title: '',
                         content: 'Negative Marks cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			else if($("#AnsDesc"+CommonQesIDs[d]).val() =="")
			{
				//alert('Answer cannot be blank');
				$("#AnsDesc"+CommonQesIDs[d]).focus();
				$.alert({
				        	    title: '',
                         content: 'Answer cannot be blank!'
                    });
				flag=true;
				return false;
			}
			}
		}			
	}
	if(FillType=='Fill in the blanks')
	{
		CommonQesIDs = GetQuestionsIDsSameType("FillQueID");
		
		for(var f=0;f<CommonQesIDs.length;f++)
		{
		    if($('#Fill_Form'+CommonQesIDs[f]).is(':visible'))
			{
			var FillChKCount=$('#Fill_Form'+CommonQesIDs[f]).find('input[type=checkbox]:checked').length;

			//$('#FillForm'+CommonQesIDs[f]).find('input[type=checkbox]:checked').length;

			if($("#QueFill1"+CommonQesIDs[f]).val() =="")
			{
			//	alert('Question cannot be blank');
				$("#QueFill1"+CommonQesIDs[f]).focus();
				$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
				flag=true;	
				return false;
			}	
			else if($("#QueFill2"+CommonQesIDs[f]).val() =="")
			{
				//alert('Question cannot be blank');
				$("#QueFill2"+CommonQesIDs[f]).focus();
				$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
				flag=true;
				return false;
			}
			else if($("#MarksFill-"+CommonQesIDs[f]).val()=="")
			{
			//	alert('Marks cannot be blank');
				$("#MarksFill-"+CommonQesIDs[f]).focus();
				$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			else if($("#NegMarksFill"+CommonQesIDs[f]).val()=="")
			{
			//	alert('Negative Marks cannot be blank');
				$("#NegMarksFill"+CommonQesIDs[f]).focus();
				$.alert({
				        	    title: '',
                         content: 'Negative Marks cannot be blank!'
                    });
				flag=true;	
				return false;
			}
		        	FillAnsCount=$('input[id*="txtAnsFill'+CommonQesIDs[f]+'"]').length;	
				for(var j=1;j<=FillAnsCount;j++)
				{
					if($('#txtAnsFill'+CommonQesIDs[f]+'-'+j).val()=="")
					{
						//alert('Answer cannot be blank');
						$('#txtAnsFill'+CommonQesIDs[f]+'-'+j).focus();
							$.alert({
				        	    title: '',
                         content: 'Answer cannot be blank!'
                    });
						flag=true;	
						return false;
					}
				}
			if(FillChKCount<=0)
			{
			//	alert('Please select atleast one correct answer');
				$('#txtAnsFill'+CommonQesIDs[f]+'-'+j).focus();
							$.alert({
				        	    title: '',
                         content: 'Please select atleast one correct answer!'
                    });
				flag=true;	
			}
		}
		}
	}
	if(TFType=='True false')
	{
		CommonQesIDs = GetQuestionsIDsSameType("TFQueID");
		for(var t=0;t<CommonQesIDs.length;t++)
		{
		    if($('#Tf_Form'+CommonQesIDs[t]).is(':visible'))
			{
			var TFChKCount=$('#Tf_Form'+CommonQesIDs[t]).find('input[type=radio]:checked').length;
			//$("input:checkbox:checked").length;
            
			if($("#QueTF"+CommonQesIDs[t]).val() =="")
			{
			//	alert('Question cannot be blank');
				$("#QueTF"+CommonQesIDs[t]).focus();
				$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			else if($("#MarksTF-"+CommonQesIDs[t]).val()=="")
			{
			//	alert('Marks cannot be blank');
				$("#MarksTF-"+CommonQesIDs[t]).focus();
				$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			else if($("#NegMarksTF"+CommonQesIDs[t]).val()=="")
			{
			//	alert('Negative marks cannot be blank');
				$("#NegMarksTF"+CommonQesIDs[t]).focus();
				$.alert({
				        	    title: '',
                         content: 'Negative marks cannot be blank!'
                    });
				flag=true;
				return false;
			}
			else if(TFChKCount<=0)
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
	}

		for(var c=0;c<total.length;c++)
		{
		    if($('#multiple_Form'+total[c]).is(':visible'))
			{
		    
			var NewMultiChKCount=$('#multiple_Form'+total[c]).find('input[type=checkbox]:checked').length;
			if($("#que_multi"+total[c]).val() =="")
			{
				//alert('Question cannot be blank');
				$("#que_multi"+total[c]).focus();
				$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			else if($("#m_marks"+total[c]).val()=="")
			{
			//	alert('Marks cannot be blank');
				$("#m_marks"+total[c]).focus();
				$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
				flag=true;	
				return false;	
			}
			else if($("#neg_multi"+total[c]).val()=="")
			{
				//alert('Negative marks cannot be blank');
				$("#neg_multi"+total[c]).focus();
				$.alert({
				        	    title: '',
                         content: 'Negative marks cannot be blank!'
                    });
				flag=true;	
				return false;
			}	
			
			       NewMultiansCount=$('input[id*="NewtxtAnsMulti'+total[c]+'"]').length;
			
				for(var m=1;m<=NewMultiansCount;m++)
				{
					if($('#NewtxtAnsMulti'+total[c]+'-'+m).val()=="")
					{
						//alert('Answer cannot be blank');
						$('#NewtxtAnsMulti'+total[c]+'-'+m).focus();
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
			//	alert('Please select atleast one correct answer');
					$.alert({
				        	    title: '',
                         content: 'Please select atleast one correct answer!'
                    });
				flag=true;	
				return false;
			}
			}
		
		    if($('#descriptive_Form'+total[c]).is(':visible'))
			{
			if($("#que_desc"+total[c]).val() =="")
			{
			//	alert('Question cannot be blank');
				$("#que_desc"+total[c]).focus();
				$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			else if($("#marks_d"+total[c]).val()=="")
			{
				//alert('Marks cannot be blank');
				$("#marks_d"+total[c]).focus();
				$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			else if($("#neg_desc"+total[c]).val()=="")
			{
			//	alert('Negative marks cannot be blank');
				$("#neg_desc"+total[c]).focus();
				$.alert({
				        	    title: '',
                         content: 'Negative marks cannot be blank!'
                    });
				flag=true;
				return false;
			}
			else if($("#ans_desc"+total[c]).val()=="")
			{
			//	alert('Answer cannot be blank');
				$("#ans_desc"+total[c]).focus();
				$.alert({
				        	    title: '',
                         content: 'Answer cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			}
		
		    if($('#fill_Form'+total[c]).is(':visible'))
			{
			var NewFillChKCount=$('#fill_Form'+total[c]).find('input[type=checkbox]:checked').length;

			if($("#que1_fill"+total[c]).val() =="")
			{
			//	alert('Question cannot be blank');
				$("#que1_fill"+total[c]).focus();
				$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
				flag=true;	
				return false;	
			}
			else if($("#que2_fill"+total[c]).val() =="")
			{
				//alert('Question cannot be blank');
				$("#que2_fill"+total[c]).focus();
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
				$("#marks_f"+total[c]).focus();
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
				$("#neg_fill"+NewFillQueCount[fill]).focus();
					$.alert({
				        	    title: '',
                         content: 'Negative marks cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			
			    NewFillAnsCount=$('input[id*="NewtxtAnsfill'+total[c]+'"]').length;
			    
				for(f=1;f<=NewFillAnsCount;f++)
				{
					if($('#NewtxtAnsfill'+total[c]+'-'+f).val()=="")
					{
					//	alert('Answer cannot be blank');
						$('#NewtxtAnsfill'+total[c]+'-'+f).focus();
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
		
		    if($('#truefalse_Form'+total[c]).is(':visible'))
			{ 
			var NewTFChKCount=$('#truefalse_Form'+total[c]).find('input[type=radio]:checked').length;

			if($("#que_tf"+total[c]).val() =="")
			{
			//	alert('Question cannot be blank');
				$("#que_tf"+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
				flag=true;	
				return false;
			}		
			else if($("#m_tf"+total[c]).val()=="")
			{
				//alert('Marks cannot be blank');
				$("#m_tf"+total[c]).focus();
				$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
				flag=true;	
				return false;	
			}	
			else if($("#neg_tf"+total[c]).val()=="")
			{
			//	alert('Negative marks cannot be blank');
				$("#neg_tf"+total[c]).focus();
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

		if($('#total').val() != $('#Marks').val())
		{
				//alert('Total marks and out of marks should equal');
				$('#Marks').focus();
				$.alert({
				        	    title: '',
                         content: 'Total marks and out of marks should equal!'
                    });
				flag=true;
				return false;	
		}

		if(flag==false)
		{
			if($('#drafted').is(":visible"))
			{
				$('#drafted').hide();
				$('#Createddrafted').show();
				$('#edit').attr('value','Edit');	
				$('#submitbtn').show();
				$('#btnquetype').addClass("disabledbutton");
				$('#mycontainer').addClass("disabledbutton");
			}
			else
			{
				$('#Createddrafted').hide();
				$('#drafted').show();
				$('#btnquetype').removeClass("disabledbutton");
				$('#mycontainer').removeClass("disabledbutton");
			}
		}
}

function GetQuestionsIDsSameType(type){
	
	var Ids = new Array();
	var ques = $('input[name*="'+type+'"]');
	for(var i=0; i < ques.length; i++){
		Ids.push(ques[i].name.split(type)[1]);
	}
	return Ids;
}

function ValidateFiles(obj)
		{
			debugger;
			var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
			if(obj.value!="" && !allowedExtensions.exec(obj.value))
			{
				//alert('Please upload file having extensions .jpeg/.jpg/.png only.');
				$.alert({
				        	    title: '',
                         content: 'Please upload file having extensions .jpeg/.jpg/.png only.!'
                    });
				obj.value=null;
			}
		}

function ValidateDraftedPaperSubmit()
{
	//alert('hello');
	debugger;
	MultiType=$('#QueType1').val();
	DescType=$('#QueType2').val();
	FillType=$('#QueType3').val();
	TFType=$('#QueType4').val();
	
	NewMultiAnsCount=$('#NewMultiAnsCount').val();
	NewFillAnsCount=$('#NewFillAnsCount').val();
	
	var count=$('.counter').val();
    var total = count.split(',');
	
	var TestTypeCount=$('#mycontainer').find('input[type=radio]:checked').length;
    var ExamCoordinator=$('#checkboxes').find('input[type=checkbox]:checked').length;


	var flag=false;	

	var CommonQesIDs = new Array();

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
	if($('#date').val()=="")
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
	if($('#Marks').val()=="")
	{
		//alert('Please enter total marks');
		$('#Marks').focus();
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
	if(MultiType=='Multiple choice questions')
	{
		CommonQesIDs = GetQuestionsIDsSameType("MultiQueID");
		for(var m=0;m<CommonQesIDs.length;m++)
		{
		    if($('#Multiple_Form'+CommonQesIDs[m]).is(':visible'))
			{
		    
			var MultiChKCount=$('#Multiple_Form'+CommonQesIDs[m]).find('input[type=checkbox]:checked').length;

				//$('#MultipleForm'+CommonQesIDs[m]).find('input[type=checkbox]:checked').length;

			if($("#Quemulti"+CommonQesIDs[m]).val() =="")
			{
				//alert('Question cannot be blank');
				$("#Quemulti"+CommonQesIDs[m]).focus();
					$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
				flag=true;
				return false;
			}
			else if($('#MarksMulti-'+CommonQesIDs[m]).val() =="")
			{
				//alert('Marks cannot be blank');
				$('#MarksMulti-'+CommonQesIDs[m]).focus();
				$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
				flag=true;
				return false;
			}
			else if($('#NegMarksMulti'+CommonQesIDs[m]).val() =="")
			{
				//alert('Negative marks cannot be blank');
				$('#NegMarksMulti'+CommonQesIDs[m]).focus();
				$.alert({
				        	    title: '',
                         content: 'Negative marks cannot be blank!'
                    });
				flag=true;
				return false;
			}
			
			    MultiansCount=$('input[id*="txtAnsMulti'+CommonQesIDs[m]+'"]').length;
			    //alert(MultiansCount);
				for(var i=1;i<=MultiansCount;i++)
				{
					if($('#txtAnsMulti'+CommonQesIDs[m]+'-'+i).val()=="")
					{
					//	alert('Answer cannot be blank');
						$('#txtAnsMulti'+CommonQesIDs[m]+'-'+i).focus();
						$.alert({
				        	    title: '',
                         content: 'Answer cannot be blank!'
                    });
						flag=true;
						return false;
					}
				}

			if(MultiChKCount<=0)
			{
				//alert('Please select atleast one correct answer');
				$.alert({
				        	    title: '',
                         content: 'Please select atleast one correct answer!'
                    });
				flag=true;	
				return false;
			}
		}
	}
	}
	if(DescType=='Descriptive questions')
	{
		CommonQesIDs = GetQuestionsIDsSameType("DescQueID");
		
		for(var d=0;d<CommonQesIDs.length;d++)
		{
		    if($('#Desc_Form'+CommonQesIDs[d]).is(':visible'))
			{
			if($("#QueDesc"+CommonQesIDs[d]).val() =="")
			{
				//alert('Question cannot be blank');
				$("#QueDesc"+CommonQesIDs[d]).focus();
				$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			else if($("#MarksDesc-"+CommonQesIDs[d]).val() =="")
			{
				//alert('Marks cannot be blank');
					$("#MarksDesc-"+CommonQesIDs[d]).focus();
				$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
				flag=true;
				return false;
			}
			else if($("#NegMarksDesc"+CommonQesIDs[d]).val() =="")
			{
				//alert('Negative Marks cannot be blank');
			    $("#NegMarksDesc"+CommonQesIDs[d]).focus();
					$.alert({
				        	    title: '',
                         content: 'Negative Marks cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			else if($("#AnsDesc"+CommonQesIDs[d]).val() =="")
			{
				//alert('Answer cannot be blank');
				$("#AnsDesc"+CommonQesIDs[d]).focus();
				$.alert({
				        	    title: '',
                         content: 'Answer cannot be blank!'
                    });
				flag=true;
				return false;
			}
			}
		}			
	}
	if(FillType=='Fill in the blanks')
	{
		CommonQesIDs = GetQuestionsIDsSameType("FillQueID");
		
		for(var f=0;f<CommonQesIDs.length;f++)
		{
		    if($('#Fill_Form'+CommonQesIDs[f]).is(':visible'))
			{
			var FillChKCount=$('#Fill_Form'+CommonQesIDs[f]).find('input[type=checkbox]:checked').length;

			//$('#FillForm'+CommonQesIDs[f]).find('input[type=checkbox]:checked').length;

			if($("#QueFill1"+CommonQesIDs[f]).val() =="")
			{
			//	alert('Question cannot be blank');
				$("#QueFill1"+CommonQesIDs[f]).focus();
				$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
				flag=true;	
				return false;
			}	
			else if($("#QueFill2"+CommonQesIDs[f]).val() =="")
			{
				//alert('Question cannot be blank');
				$("#QueFill2"+CommonQesIDs[f]).focus();
				$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
				flag=true;
				return false;
			}
			else if($("#MarksFill-"+CommonQesIDs[f]).val()=="")
			{
			//	alert('Marks cannot be blank');
				$("#MarksFill-"+CommonQesIDs[f]).focus();
				$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			else if($("#NegMarksFill"+CommonQesIDs[f]).val()=="")
			{
			//	alert('Negative Marks cannot be blank');
				$("#NegMarksFill"+CommonQesIDs[f]).focus();
				$.alert({
				        	    title: '',
                         content: 'Negative Marks cannot be blank!'
                    });
				flag=true;	
				return false;
			}
		        	FillAnsCount=$('input[id*="txtAnsFill'+CommonQesIDs[f]+'"]').length;	
				for(var j=1;j<=FillAnsCount;j++)
				{
					if($('#txtAnsFill'+CommonQesIDs[f]+'-'+j).val()=="")
					{
						//alert('Answer cannot be blank');
						$('#txtAnsFill'+CommonQesIDs[f]+'-'+j).focus();
							$.alert({
				        	    title: '',
                         content: 'Answer cannot be blank!'
                    });
						flag=true;	
						return false;
					}
				}
			if(FillChKCount<=0)
			{
			//	alert('Please select atleast one correct answer');
				$('#txtAnsFill'+CommonQesIDs[f]+'-'+j).focus();
							$.alert({
				        	    title: '',
                         content: 'Please select atleast one correct answer!'
                    });
				flag=true;	
			}
		}
		}
	}
	if(TFType=='True false')
	{
		CommonQesIDs = GetQuestionsIDsSameType("TFQueID");
		for(var t=0;t<CommonQesIDs.length;t++)
		{
		    if($('#Tf_Form'+CommonQesIDs[t]).is(':visible'))
			{
			var TFChKCount=$('#Tf_Form'+CommonQesIDs[t]).find('input[type=radio]:checked').length;
			//$("input:checkbox:checked").length;
            
			if($("#QueTF"+CommonQesIDs[t]).val() =="")
			{
			//	alert('Question cannot be blank');
				$("#QueTF"+CommonQesIDs[t]).focus();
				$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			else if($("#MarksTF-"+CommonQesIDs[t]).val()=="")
			{
			//	alert('Marks cannot be blank');
				$("#MarksTF-"+CommonQesIDs[t]).focus();
				$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			else if($("#NegMarksTF"+CommonQesIDs[t]).val()=="")
			{
			//	alert('Negative marks cannot be blank');
				$("#NegMarksTF"+CommonQesIDs[t]).focus();
				$.alert({
				        	    title: '',
                         content: 'Negative marks cannot be blank!'
                    });
				flag=true;
				return false;
			}
			else if(TFChKCount<=0)
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
	}

    	for(var c=0;c<total.length;c++)
		{
		    if($('#multiple_Form'+total[c]).is(':visible'))
			{
		    
			var NewMultiChKCount=$('#multiple_Form'+total[c]).find('input[type=checkbox]:checked').length;
			if($("#que_multi"+total[c]).val() =="")
			{
				//alert('Question cannot be blank');
				$("#que_multi"+total[c]).focus();
				$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			else if($("#m_marks"+total[c]).val()=="")
			{
			//	alert('Marks cannot be blank');
				$("#m_marks"+total[c]).focus();
				$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
				flag=true;	
				return false;	
			}
			else if($("#neg_multi"+total[c]).val()=="")
			{
				//alert('Negative marks cannot be blank');
				$("#neg_multi"+total[c]).focus();
				$.alert({
				        	    title: '',
                         content: 'Negative marks cannot be blank!'
                    });
				flag=true;	
				return false;
			}	
			
				for(var m=1;m<=NewMultiAnsCount;m++)
				{
					if($('#NewtxtAnsMulti'+total[c]+'-'+m).val()=="")
					{
						//alert('Answer cannot be blank');
						$('#NewtxtAnsMulti'+total[c]+'-'+m).focus();
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
			//	alert('Please select atleast one correct answer');
					$.alert({
				        	    title: '',
                         content: 'Please select atleast one correct answer!'
                    });
				flag=true;	
				return false;
			}
			}
		
		    if($('#descriptive_Form'+total[c]).is(':visible'))
			{
			if($("#que_desc"+total[c]).val() =="")
			{
			//	alert('Question cannot be blank');
				$("#que_desc"+total[c]).focus();
				$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			else if($("#marks_d"+total[c]).val()=="")
			{
				//alert('Marks cannot be blank');
				$("#marks_d"+total[c]).focus();
				$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			else if($("#neg_desc"+total[c]).val()=="")
			{
			//	alert('Negative marks cannot be blank');
				$("#neg_desc"+total[c]).focus();
				$.alert({
				        	    title: '',
                         content: 'Negative marks cannot be blank!'
                    });
				flag=true;
				return false;
			}
			else if($("#ans_desc"+total[c]).val()=="")
			{
			//	alert('Answer cannot be blank');
				$("#ans_desc"+total[c]).focus();
				$.alert({
				        	    title: '',
                         content: 'Answer cannot be blank!'
                    });
				flag=true;	
				return false;
			}
			}
		
		    if($('#fill_Form'+total[c]).is(':visible'))
			{
			var NewFillChKCount=$('#fill_Form'+total[c]).find('input[type=checkbox]:checked').length;

			if($("#que1_fill"+total[c]).val() =="")
			{
			//	alert('Question cannot be blank');
				$("#que1_fill"+total[c]).focus();
				$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
				flag=true;	
				return false;	
			}
			else if($("#que2_fill"+total[c]).val() =="")
			{
				//alert('Question cannot be blank');
				$("#que2_fill"+total[c]).focus();
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
				$("#marks_f"+total[c]).focus();
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
				$("#neg_fill"+NewFillQueCount[fill]).focus();
					$.alert({
				        	    title: '',
                         content: 'Negative marks cannot be blank!'
                    });
				flag=true;	
				return false;
			}
				for(f=1;f<=NewFillAnsCount;f++)
				{
					if($('#NewtxtAnsfill'+total[c]+'-'+f).val()=="")
					{
					//	alert('Answer cannot be blank');
						$('#NewtxtAnsfill'+total[c]+'-'+f).focus();
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
		
		    if($('#truefalse_Form'+total[c]).is(':visible'))
			{ 
			var NewTFChKCount=$('#truefalse_Form'+total[c]).find('input[type=radio]:checked').length;

			if($("#que_tf"+total[c]).val() =="")
			{
			//	alert('Question cannot be blank');
				$("#que_tf"+total[c]).focus();
					$.alert({
				        	    title: '',
                         content: 'Question cannot be blank!'
                    });
				flag=true;	
				return false;
			}		
			else if($("#m_tf"+total[c]).val()=="")
			{
				//alert('Marks cannot be blank');
				$("#m_tf"+total[c]).focus();
				$.alert({
				        	    title: '',
                         content: 'Marks cannot be blank!'
                    });
				flag=true;	
				return false;	
			}	
			else if($("#neg_tf"+total[c]).val()=="")
			{
			//	alert('Negative marks cannot be blank');
				$("#neg_tf"+total[c]).focus();
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

		if($('#total').val() != $('#TotalMarks').val())
		{
				//alert('Total marks and out of marks should equal');
				$.alert({
				        	    title: '',
                         content: 'Total marks and out of marks should equal!'
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
            
			$('#draftedform').submit();
		}
}








 function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
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
     
    
           function onlyNumbersWithdash(e,txt) {
               
               debugger;
         var charCode;
          if (e.keyCode > 0) {
              charCode = e.which || e.keyCode;
          }
          else if (typeof (e.charCode) != "undefined") {
              charCode = e.which || e.keyCode;
          }
         /* if (charCode == 45)
          {
           if(txt.value.indexOf("-") >= 0)
           {
            return false
           }
           else
           {
              return true
            }
           }*/
          if (charCode > 31 && (charCode < 48 || charCode > 57))
              return false;
          return true;
      }
    
    
    	function MarksTotal()
		{
			var marks=$('#Marks').val();
			$('#TotalMarks').val(marks);
		}

		function MultiCheck(obj)
		{
			debugger;
			var value=obj.parentElement.childNodes[3].value;

			if(value=='1')
			{
				obj.parentElement.childNodes[3].value=0;
			}
			else
			{
				obj.parentElement.childNodes[3].value=1;
			}
		}
		function CheckedAns(e,count)
		{
			/*if(e.checked == true)
			{
				$('[name*="ChkAnsFill"]:hidden').prevAll().attr("checked",false);
				$('[name*="ChkAnsFill"]:hidden').attr("value","0");
				e.checked = true;
				e.nextElementSibling.value = "1";
			}
			else
			{
				e.nextElementSibling.value = "0";
			}*/
			var fill=document.querySelectorAll('[name*="ChkAnsFill'+count+'"]').length;
			

			for(var i=0; i<document.querySelectorAll('[name*="ChkAnsFill'+count+'"]').length; i++)
			{
					document.querySelectorAll('[name*="ChkAnsFill'+count+'"]')[i].value="0";
			}
		
			var val=e.parentElement.childNodes[3].value;
			if(val=="1")
			{
				e.parentElement.childNodes[3].value=0;
			}
			else
			{
				e.parentElement.childNodes[3].value=1;

			}	
			
		}
		function AddCheckedAns(e)
		{
			$('[name*="ChkAnsFill"]:hidden').prevAll().attr("checked",false);
			$('[name*="ChkAnsFill"]:hidden').attr("value","0");
		}
	
		function TrueFalseAnsCheck(t, id)
		{
			debugger;
			if(t.checked == true){
				$('input[name*="TrueAnsID'+id+'"]:hidden').attr("name", "FalseAnsID"+id+"");
				$(t.nextElementSibling).attr("name", "TrueAnsID"+id+"");
			}
			if(t.checked == true)
			{
				$('#AnsTF'+id).text(t.value);
			}
		}