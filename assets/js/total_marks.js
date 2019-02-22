
			var sum_m=0;
			var sum_d=0;
			var sum_f=0;
			var sum_tf=0;

function myFunction()
 {      var m1=0;

    	debugger;
    var tm = $('input[id^="m_marks"]');
    for(var i=0; i < tm.length; i++){
        m1 += parseInt(tm[i].value == "" ? "0" : tm[i].value) ;
    }
    	$("#marks_multiple").val(m1);
    	
	/*var c1=$('.counter1').val();
	for(var i=1;i<=c1;i++)
	{
		x = $("#m_marks"+i).val();
		r =parseInt(x);
	
		if(isNaN(x)|| x=='')
		{	
			r=0;
		}
	
			m1= m1 + r;
			$("#marks_multiple").val(m1);
	}*/

   	var multi_sum=$("#marks_multiple").val();
	sum_m=parseInt(multi_sum);
	if(sum_m==0){sum_m=0;}
	sum_d=$("#marks_Desc").val();
	
    if(sum_d==0)
    {
        sum_d=0;
    }
    
    sum_f=$("#marks_Fills").val();
	
    if(sum_f==0)
    {
        sum_f=0;
    }
    
    sum_tf=$("#marks_tf").val();
    
    if(sum_tf==0)
    {
        sum_tf=0;
    }
		
	var summ=0;
	summ=+sum_m + +sum_d + +sum_f + +sum_tf;
       
	$('#total_marks').val(summ);
	$('#total').val(summ);
}
		
function desc_mtotal()
{
    debugger;
	var d1=0;
	
	var td = $('input[id^="marks_d"]');
    for(var i=0; i < td.length; i++){
        d1 += parseInt(td[i].value == "" ? "0" : td[i].value) ;
    }
    	$("#marks_Desc").val(d1);
	
/*	var c2=$('.counter2').val();
	for(var j=1;j<=c2;j++)
	{
		var x1 = $("#marks_d"+j).val();
		var desc =parseInt(x1);
	
		if(isNaN(x1)|| x1=='')
		{	
			desc=0;
		}

		d1= d1 + desc;
	
	   	$("#marks_descc").val(d1);
	}*/
	desc_sum=$("#marks_Desc").val();
	sum_d=parseInt(desc_sum);
	
	sum_m=$("#marks_multiple").val();
	if(sum_m==0)
	{
	    sum_m=0;
	}
	
	sum_f=$("#marks_Fills").val();
	
    if(sum_f==0)
    {
        sum_f=0;
    }
    
    sum_tf=$("#marks_tf").val();
    
    if(sum_tf==0)
    {
        sum_tf=0;
    }
    
	var summ=0;
	var summ=+sum_m + +sum_d + +sum_f + +sum_tf;
	$('#total_marks').val(summ);
	$('#total').val(summ);

}
	
function fill_mtotal()
{
	var f1=0;
		var tf = $('input[id^="marks_f"]');
         for(var i=0; i < tf.length; i++){
        f1 += parseInt(tf[i].value == "" ? "0" : tf[i].value) ;
    }
    	$("#marks_Fills").val(f1);
	debugger;
	/*var c3=$('.counter3').val();
	for(var k=1;k<=c3;k++)
	{
		var x2 = $("#marks_f"+k).val();
		var fill =parseInt(x2);

		if(isNaN(x2)|| x2=='')
		{	
			fill=0;
		}


		f1= f1 + fill;
   		$("#marks_fills").val(f1);
	}*/
	
	fill_sum=$("#marks_Fills").val();
	sum_f=parseInt(fill_sum);
	
	sum_m=$("#marks_multiple").val();
	if(sum_m==0)
	{
	    sum_m=0;
	}
	
	sum_d=$("#marks_Desc").val();
	
    if(sum_d==0)
    {
        sum_d=0;
    }
    
    sum_tf=$("#marks_tf").val();
    
    if(sum_tf==0)
    {
        sum_tf=0;
    }

	var summ=0;
	var summ=+sum_m + +sum_d + +sum_f + +sum_tf;
	$('#total_marks').val(summ);
	$('#total').val(summ);
}
	
function tf_mtotal()
{
	var tf1=0;
	var tr = $('input[id^="m_tf"]');
         for(var i=0; i < tr.length; i++){
        tf1 += parseInt(tr[i].value == "" ? "0" : tr[i].value) ;
    }
    	$("#marks_tf").val(tf1);
	debugger;
/*	var c4=$('.counter4').val();
	for(var n=1;n<=c4;n++)
	{
		var x3 = $("#m_tf"+n).val();
		var true_false =parseInt(x3);

		if(isNaN(x3)|| x3=='')
		{	
			true_false=0;
		}


		tf1= tf1 + true_false;
	   	$("#marks_tf").val(tf1);
	}*/
	tf_sum=$("#marks_tf").val();
	sum_tf=parseInt(tf_sum);

    sum_m=$("#marks_multiple").val();
	if(sum_m==0)
	{
	    sum_m=0;
	}
	
	sum_d=$("#marks_Desc").val();
	
    if(sum_d==0)
    {
        sum_d=0;
    }
    
    sum_f=$("#marks_Fills").val();
    
    if(sum_f==0)
    {
        sum_f=0;
    }
    
	var summ=0;
	var summ=+sum_m + +sum_d + +sum_f + +sum_tf;
	$('#total_marks').val(summ);
	$('#total').val(summ);
}

			
		

//closing forms








