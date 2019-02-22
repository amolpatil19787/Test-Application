var Sum_Multi=0;
var Sum_Desc=0;
var Sum_Fill=0;
var Sum_TF=0;

var sum_m=0;
var sum_d=0;
var sum_f=0;
var sum_tf=0;

	//function for database questions 
function DraftedPaperMarks(obj)
{
	MultiQueCount=$('#MultiQueCount').val();
	DescQueCount=$('#DescQueCount').val();
	FillQueCount=$('#FillQueCount').val();
	TFQueCount=$('#TFQueCount').val();
	MultiType=$('#QueType1').val();
	DescType=$('#QueType2').val();
	FillType=$('#QueType3').val();
	TFType=$('#QueType4').val();
		
	var M=$("#marks_multiple").val();
	if(M=="")
	{
		M=0;
	}
	var D=$("#marks_Desc").val();
	if(D=="")
	{
		D=0;
	} 
	var F=$("#marks_Fills").val();
	if(F=="")
	{
		F=0;
	}
	var T=$("#marks_tf").val();
	if(T=="")
	{
		T=0;
	}

		cnt_multi=$('#cnt_multi').val();	 
		cnt_desc=$('#cnt_desc').val();
		cnt_fill=$('#cnt_fill').val();
		cnt_tf=$('#cnt_tf').val();

	var sum=0;
	
	//alert('hello');
	
	var CommonQesIDs = new Array();
	if(MultiType=='Multiple choice questions')
	{
		CommonQesIDs = GetQuestionsIDsSameType("MultiQueID");

				if($('#cnt_multi').val()==""){	cnt_multi=0;	}
				else{	cnt_multi=parseInt($('#cnt_multi').val());	}


				if($('#cnt_desc').val()==""){	cnt_desc=0;	}
				else{	cnt_desc=parseInt($('#cnt_desc').val());	}


				if($('#cnt_fill').val()==""){	cnt_fill=0;	}
				else{	cnt_fill=parseInt($('#cnt_fill').val());	}


				if($('#cnt_tf').val()==""){	cnt_tf=0;	}
				else{	cnt_tf=parseInt($('#cnt_tf').val());		}

				cnt_multi=MultiQueCount;
				$('#cnt_multi').val(cnt_multi);                      
					
	                        sum=+cnt_multi + +cnt_desc+ +cnt_fill+ +cnt_tf;
				parseInt(sum);
				$('#total_questions').val(sum);

				for(var m=0;m<CommonQesIDs.length;m++)
				{
					marksmulti = $("#MarksMulti-"+CommonQesIDs[m]).val();
					MarksMulti =parseInt(marksmulti);

					if(isNaN(marksmulti)|| marksmulti=='')
					{	
						MarksMulti=0;
					}
						M= +M + +MarksMulti;
						$("#marks_multiple").val(M);
	
						var MultiSum=$("#marks_multiple").val();

						Sum_Multi=parseInt(MultiSum);		

				}
	}
	if(DescType=='Descriptive questions')
	{
		CommonQesIDs = GetQuestionsIDsSameType("DescQueID");
				if($('#cnt_multi').val()==""){	cnt_multi=0;	}
				else{	cnt_multi=parseInt($('#cnt_multi').val());	}


				if($('#cnt_desc').val()==""){	cnt_desc=0;	}
				else{	cnt_desc=parseInt($('#cnt_desc').val());	}


				if($('#cnt_fill').val()==""){	cnt_fill=0;	}
				else{	cnt_fill=parseInt($('#cnt_fill').val());	}


				if($('#cnt_tf').val()==""){	cnt_tf=0;	}
				else{	cnt_tf=parseInt($('#cnt_tf').val());		}

				cnt_desc=DescQueCount;				
				$('#cnt_desc').val(cnt_desc);                      
					
	                        sum=+cnt_multi + +cnt_desc+ +cnt_fill+ +cnt_tf;
				parseInt(sum);
				$('#total_questions').val(sum);

				for(var d=0;d<CommonQesIDs.length;d++)
				{
					var marksdesc = $("#MarksDesc-"+CommonQesIDs[d]).val();
					MarksDesc =parseInt(marksdesc);

					if(isNaN(marksdesc)|| marksdesc=='')
					{	
						MarksDesc=0;
					}
						D= +D + +MarksDesc;
						$("#marks_Desc").val(D);
	
						var DescSum=$("#marks_Desc").val();

						Sum_Desc=parseInt(DescSum);		

				}

	}
	if(FillType=='Fill in the blanks')
	{
		CommonQesIDs = GetQuestionsIDsSameType("FillQueID");
				if($('#cnt_multi').val()==""){	cnt_multi=0;	}
				else{	cnt_multi=parseInt($('#cnt_multi').val());	}


				if($('#cnt_desc').val()==""){	cnt_desc=0;	}
				else{	cnt_desc=parseInt($('#cnt_desc').val());	}


				if($('#cnt_fill').val()==""){	cnt_fill=0;	}
				else{	cnt_fill=parseInt($('#cnt_fill').val());	}


				if($('#cnt_tf').val()==""){	cnt_tf=0;	}
				else{	cnt_tf=parseInt($('#cnt_tf').val());		}

				cnt_fill=FillQueCount;
				$('#cnt_fill').val(cnt_fill);                      
					
	                        sum=+cnt_multi + +cnt_desc+ +cnt_fill+ +cnt_tf;
				parseInt(sum);
				$('#total_questions').val(sum);	

				for(var f=0;f<CommonQesIDs.length;f++)
				{
					var marksfill = $("#MarksFill-"+CommonQesIDs[f]).val();
					MarksFill =parseInt(marksfill);

					if(isNaN(marksfill)|| marksfill=='')
					{	
						MarksFill=0;
					}
						F= +F + +MarksFill;
						$("#marks_Fills").val(F);
	
						var FillSum=$("#marks_Fills").val();

						Sum_Fill=parseInt(FillSum);		

				}
	}
	if(TFType=='True false')
	{
		CommonQesIDs = GetQuestionsIDsSameType("TFQueID");
				if($('#cnt_multi').val()==""){	cnt_multi=0;	}
				else{	cnt_multi=parseInt($('#cnt_multi').val());	}


				if($('#cnt_desc').val()==""){	cnt_desc=0;	}
				else{	cnt_desc=parseInt($('#cnt_desc').val());	}


				if($('#cnt_fill').val()==""){	cnt_fill=0;	}
				else{	cnt_fill=parseInt($('#cnt_fill').val());	}


				if($('#cnt_tf').val()==""){	cnt_tf=0;	}
				else{	cnt_tf=parseInt($('#cnt_tf').val());		}

				cnt_tf=TFQueCount;
				$('#cnt_tf').val(cnt_tf);                      
					
	                        sum=+cnt_multi + +cnt_desc+ +cnt_fill+ +cnt_tf;
				parseInt(sum);
				$('#total_questions').val(sum);	

				for(var t=0;t<CommonQesIDs.length;t++)
				{
					var markstf = $("#MarksTF-"+CommonQesIDs[t]).val();
					MarksTF =parseInt(markstf);

					if(isNaN(markstf)|| markstf=='')
					{	
						MarksTF=0;
					}
						T= +T + +MarksTF;
						$("#marks_tf").val(T);
	
						var TFSum=$("#marks_tf").val();

						Sum_TF=parseInt(TFSum);		

				}
	}
	var summ=0;
	var summ=Sum_Multi+Sum_Desc+Sum_Fill+Sum_TF;
	$('#total_marks').val(summ);
	$('#total').val(summ);
}
function GetQuestionsIDsSameType(type){
	
	var Ids = new Array();
	var ques = $('input[name*="'+type+'"]');
	for(var i=0; i < ques.length; i++){
		Ids.push(ques[i].name.split(type)[1]);
	}
	return Ids;
}

function AddNewQuesMarks(markbox)
{
	debugger;
	if(markbox.value.trim() != "")
	{
		var name = markbox.name;
		if(name.indexOf("marks_multi") != -1)
		{
			$("#marks_multiple").val(GetNewAndPrevQuestioMarks("marks_multi", "MarksMulti"));
		}
		else if(name.indexOf("marks_tf") != -1)
		{
			$("#marks_tf").val(GetNewAndPrevQuestioMarks("marks_tf", "MarksTF"));
		}
		else if(name.indexOf("marks_fill") != -1)
		{
			$("#marks_Fills").val(GetNewAndPrevQuestioMarks("marks_fill", "MarksFill"));
		}
		else if(name.indexOf("marks_desc") != -1)
		{
			$("#marks_Desc").val(GetNewAndPrevQuestioMarks("marks_desc", "MarksDesc"));
		}
		else if(name.indexOf("MarksMulti") != -1)
		{
			$("#marks_multiple").val(GetNewAndPrevQuestioMarks("MarksMulti", "marks_multi"));
		}
		else if(name.indexOf("MarksTF") != -1)
		{
			$("#marks_tf").val(GetNewAndPrevQuestioMarks("MarksTF", "marks_tf"));
		}
		else if(name.indexOf("MarksFill") != -1)
		{
			$("#marks_Fills").val(GetNewAndPrevQuestioMarks("MarksFill", "marks_fill"));
		}
		else if(name.indexOf("MarksDesc") != -1)
		{
			$("#marks_Desc").val(GetNewAndPrevQuestioMarks("MarksDesc", "marks_desc"));
		}
				
		var Multiple=$("#marks_multiple").val();
		var Descriptive=$("#marks_Desc").val();
		var Fill=$("#marks_Fills").val();
		var TrueFalse=$("#marks_tf").val();
		$('#total_marks').val(+Multiple + +Descriptive + +Fill + +TrueFalse);
		$('#total').val(+Multiple + +Descriptive + +Fill + +TrueFalse);
		
	}
	
}

function GetNewAndPrevQuestioMarks(PrevName, NewName)
{
	debugger;
	var prevMarks = 0, newMarks = 0;
	var prveElement = $("input[name^='"+ PrevName +"']").map(function(){return ($(this).val() == "" ? "0" : $(this).val());}).get();
	var newElement = $("input[name^='"+ NewName +"']").map(function(){return ($(this).val() == "" ? "0" : $(this).val());}).get();

	if(prveElement.length == 1)
		prevMarks = parseInt(prveElement[0]);
	else if(prveElement.length > 1)
		prevMarks = prveElement.reduce(function (curr, prev) { return parseInt(curr) + parseInt(prev); });
			
	if(newElement.length == 1)
		newMarks = parseInt(newElement[0]);
	else if(newElement.length > 1)
		newMarks = newElement.reduce(function (curr, prev) { return parseInt((curr)) + parseInt(prev); });

	return (prevMarks + newMarks);
}

function DeleteDraftedQuestion(obj)
{
	debugger;
	var FormID=obj.parentNode.id;
	
	var QuestionID=obj.parentElement.childNodes[3].value;
	
                	 var resultObj = $("#DeletedQues");
    	        
    	            var stringToAppend = resultObj.val().length > 0 ? resultObj.val() + "," : "";
                      resultObj .val( stringToAppend + QuestionID );
	
	var formNo = obj.parentNode.id.split('Form')[1];
	
	if(FormID.indexOf("Multiple_Form")!= -1)
	{
		var Execmulti=DeleteNewOrPrevQuestion(FormID,"MarksMulti");
		if(Execmulti=="" || isNaN(Execmulti))
		{
			Execmulti=0;
		}
		$("#marks_multiple").val(parseInt($("#marks_multiple").val()) - Execmulti);
		$('#cnt_multi').val(parseInt($('#cnt_multi').val())-1);
	}
	else if(FormID.indexOf("Desc_Form")!= -1)
	{
		var Execdesc=DeleteNewOrPrevQuestion(FormID,"MarksDesc");
		if(Execdesc=="" || isNaN(Execdesc))
		{
			Execdesc=0;
		}
		$("#marks_Desc").val(parseInt($("#marks_Desc").val()) - Execdesc);
		$('#cnt_desc').val(parseInt($('#cnt_desc').val())-1);
	}
	else if(FormID.indexOf("Fill_Form")!= -1)
	{
		var Execfill=DeleteNewOrPrevQuestion(FormID,"MarksFill");
		if(Execfill=="" || isNaN(Execfill))
		{
			Execfill=0;
		}
		$("#marks_Fills").val(parseInt($("#marks_Fills").val()) - Execfill);
		$('#cnt_fill').val(parseInt($('#cnt_fill').val())-1);
	}
	else if(FormID.indexOf("Tf_Form")!= -1)
	{
		var Exectf=DeleteNewOrPrevQuestion(FormID,"MarksTF");
		if(Exectf=="" || isNaN(Exectf))
		{
			Exectf=0;
		}
		$("#marks_tf").val(parseInt($("#marks_tf").val()) - Exectf);
		$('#cnt_tf').val(parseInt($('#cnt_tf').val())-1);
	}
	else if(FormID.indexOf("multiple_Form")!= -1)
	{
		var NewMulti=DeleteNewOrPrevQuestion(FormID,"marks_multi");
		var Multiple=$('#marks_multiple').val();
		
		if(Multiple=="" || isNaN(Multiple))
		{
		    Multiple=0;
		}
		
		if(NewMulti=="" || isNaN(NewMulti))
		{
			NewMulti=0;
		}
		$("#marks_multiple").val(Multiple - NewMulti);
		$('#cnt_multi').val(parseInt($('#cnt_multi').val())-1);
		
	       
	}
	else if(FormID.indexOf("descriptive_Form")!= -1)
	{
		var Newdesc=DeleteNewOrPrevQuestion(FormID,"marks_desc");
		var Descriptive=$('#marks_Desc').val();
		
		if(Descriptive=="" || isNaN(Descriptive))
		{
		    Descriptive=0;
		}
		if(Newdesc=="" || isNaN(Newdesc))
		{
			Newdesc=0;
		}
		$("#marks_Desc").val(Descriptive - Newdesc);
		$('#cnt_desc').val(parseInt($('#cnt_desc').val())-1);
	}
	else if(FormID.indexOf("fill_Form")!= -1)
	{
		var NewFill=DeleteNewOrPrevQuestion(FormID,"marks_fill");
		var Fill=$("#marks_Fills").val();
		
		if(Fill=="" || isNaN(Fill))
		{
		    Fill=0;
		}
		if(NewFill=="" || isNaN(NewFill))
		{
			NewFill=0;
		}
		$("#marks_Fills").val(Fill - NewFill);
		$('#cnt_fill').val(parseInt($('#cnt_fill').val())-1);
	}
	else if(FormID.indexOf("truefalse_Form")!= -1)
	{
		var NewTF=DeleteNewOrPrevQuestion(FormID,"marks_tf");
		var TrueFalse=$("#marks_tf").val();
		if(TrueFalse=="" || isNaN(TrueFalse))
		{
		    TrueFalse=0;
		}
		if(NewTF=="" || isNaN(NewTF))
		{
			NewTF=0;
		}
		$("#marks_tf").val(TrueFalse - NewTF);
		$('#cnt_tf').val(parseInt($('#cnt_tf').val())-1);
	}

		var Multiple=$("#marks_multiple").val();
		var Descriptive=$("#marks_Desc").val();
		var Fill=$("#marks_Fills").val();
		var TrueFalse=$("#marks_tf").val();
		$('#total_marks').val(+Multiple + +Descriptive + +Fill + +TrueFalse);
		$('#total').val(+Multiple + +Descriptive + +Fill + +TrueFalse);
		
		var cnt_multi=$('#cnt_multi').val();
		var cnt_desc=$('#cnt_desc').val();
		var cnt_fill=$('#cnt_fill').val();
		var cnt_tf=$('#cnt_tf').val();
		
		$('#total_questions').val(+cnt_multi + +cnt_desc + +cnt_fill + +cnt_tf);
	//	$('#TotalCount').val(+cnt_multi + +cnt_desc + +cnt_fill + +cnt_tf);
		
		$("#"+obj.parentNode.id.split('_')[0]+"_created"+ obj.parentNode.id.split('Form')[1]).remove();
		$("#"+obj.parentNode.id).remove();
		
		//old 
		
		 var Count=$('#TotalCount').val();
	       Count=Count.replace(formNo,"");
	       $('#TotalCount').val(Count);
	       
	       Count=Count.replace(',,',',');
	       $('#TotalCount').val(Count);
	       
	       lastchar=Count.charAt(Count.length-1);
	       if(lastchar==",")
	       {
	           Count=Count.replace(/.$/,"");
	           $('#TotalCount').val(Count);
	       }
	       
	       firstchar=Count.charAt(0);
	       if(firstchar==",")
	       {
	           Count=Count.replace(firstchar,"");
	           $('#TotalCount').val(Count);
	       }
		
		    //new
		
		   var c=$('.counter').val();
	       c=c.replace(formNo,"");
	       $('.counter').val(c);
	       
	       c=c.replace(',,',',');
	       $('.counter').val(c);
	       
	       lastchar=c.charAt(c.length-1);
	       if(lastchar==",")
	       {
	           c=c.replace(/.$/,"");
	           $('.counter').val(c);
	       }
	       
	       firstchar=c.charAt(0);
	       if(firstchar==",")
	       {
	           c=c.replace(firstchar,"");
	           $('.counter').val(c);
	       }
}
function DeleteNewOrPrevQuestion(Form,Marks)
{
	var Marks=$('#'+Form+' input[name^="'+Marks+'"]')[0].value;

	return parseInt(Marks);	

	//$('#MultipleForm-1 input[name^="MarksMulti"]')[0].value
	//$('#MutipleForm2 input[name^="MarksMulti"]')[0].value
	//$("#aabb")[0].parentNode
}

