	var m_m=0;
			var d_d=0;
			var f_f=0;
			var tf_tf=0;

		function close_multiple(node)
		{		

		
			var formNo = node.parentNode.id.split('form')[1];
		
	
		   
		
			var n=$('#cnt_multi').val();
			n=n-1;
			
			$('#cnt_multi').val(n);
	
			$('#total_questions').val(n);
			
			$('#marks_multiple').val(n);			
	
			$('#total_marks').val(n);
			
			var cc1=parseInt(n);

			var cnt2=$('#cnt_desc').val();
			if(cnt2==0)
			{	cnt2=0;	
			}

			var cntt2=parseInt(cnt2);
			

			var cnt3=$('#cnt_fill').val();
			if(cnt3==0)
			{	cnt3=0;	
			}
			var cntt3=parseInt(cnt3);
			

			var cnt4=$('#cnt_tf').val();
			if(cnt4==0)
			{	cnt4=0;	
			}
			var cntt4=parseInt(cnt4);
			


			main=cc1+cntt2+cntt3+cntt4;
			var mainn=parseInt(main);
			$('#total_questions').val(mainn);
		//	$('.counter1').val(mainn);

			
	        	var m1=0;
			    var tm = $('input[id^="m_marks"]');
                for(var i=0; i < tm.length; i++){
                   m1 =m1-(- parseInt(tm[i].value == "" ? "0" : tm[i].value)) ;
                }
    	        $("#marks_multiple").val(m1);
	
			
   			var multi_m=$("#marks_multiple").val();
			m_m=parseInt(multi_m);
		/*	if(m_m==0)
			{
			    m_m=0;
			}*/

			d_d=$('#marks_Desc').val();
			if(d_d==0)
			{
				d_d=0;
			}
			var d_dd=parseInt(d_d);

			f_f=$('#marks_Fills').val();
			if(f_f==0)
			{
				f_f=0;
			}
			var f_ff=parseInt(f_f);

			tf_tf=$('#marks_tf').val();
			if(tf_tf==0)
			{
				tf_tf=0;
			}
			var tf_tff=parseInt(tf_tf);

			var sub=0;
			sub=m_m + d_dd + f_ff + tf_tff;
       			
			$('#total_marks').val(sub);
			$('#total').val(sub);
	
	        	debugger;
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
	     
	         $("#"+node.parentNode.id.split('_')[0]+"_created"+ node.parentNode.id.split('form')[1]).remove();
			$("#"+node.parentNode.id).remove();
	       
		}
		
		function close_descriptive(node)
		{
			debugger;

            var formNo = node.parentNode.id.split('form')[1];

			var c2=$('.counter2').val();
			
			$("#"+node.parentNode.id.split('_')[0]+"_created"+ node.parentNode.id.split('form')[1]).remove();	
			$("#"+node.parentNode.id).remove();
			for(var j=1;j<=c2;j++)
			{
			    if($('#descriptive_created'+j).is(':visible'))
			    {
			       $('#descriptive_created'+j).remove();
			    }
			}
			
			var n1=$('#cnt_desc').val();
			n1=n1-1;
			
			$('#cnt_desc').val(n1);
				
			$('#total_questions').val(n1);

			$('#marks_Desc').val(n1);

	
			$('#total_marks').val(n1);
			
			
			var cc2=parseInt(n1);
			
			var cnt1=$('#cnt_multi').val();
			if(cnt1==0)
			{	cnt1=0;	
			}
			var cntt1=parseInt(cnt1);

			var cnt3=$('#cnt_fill').val();
			if(cnt3==0)
			{	cnt3=0;	
			}
			var cntt3=parseInt(cnt3);

			var cnt4=$('#cnt_tf').val();
			if(cnt4==0)
			{	cnt4=0;	
			}
			var cntt4=parseInt(cnt4);
			
			main=cntt1+cc2+cntt3+cntt4;
			var mainn=parseInt(main);
			$('#total_questions').val(mainn);


			var d=0;
	        
	        var td = $('input[id^="marks_d"]');
          for(var i=0; i < td.length; i++){
        d = d-(-parseInt(td[i].value == "" ? "0" : td[i].value)) ;
    }
    	$("#marks_Desc").val(d);
	
		
			var desc_d=$("#marks_Desc").val();
			d_d=parseInt(desc_d);


			m_m=$('#marks_multiple').val();
			if(m_m==0)
			{
				m_m=0;
			}
			var m_mm=parseInt(m_m);

			f_f=$('#marks_Fills').val();
			if(f_f==0)
			{
				f_f=0;
			}
			var f_ff=parseInt(f_f);

			tf_tf=$('#marks_tf').val();
			if(tf_tf==0)
			{
				tf_tf=0;
			}
			var tf_tff=parseInt(tf_tf);



			var sub=0;
			sub=m_mm + d_d + f_ff + tf_tff;
       			
			$('#total_marks').val(sub);
			$('#total').val(sub);
			
			
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


		function close_fill(node)
		{
			debugger;
			var c3=$('.counter3').val();
			
				var formNo = node.parentNode.id.split('form')[1];
			
			$("#"+node.parentNode.id.split('_')[0]+"_created"+ node.parentNode.id.split('form')[1]).remove();	
			$("#"+node.parentNode.id).remove();
			
			for(var a=1;a<=c3;a++)
			{
			    if($('#fillform_created'+a).is(':visible'))
			    {
			       $('#fillform_created'+a).remove();
			    }
			}
			
			var q=$('#cnt_fill').val();
			q=q-1;
			
			$('#cnt_fill').val(q);
			
			$('#total_questions').val(q);
			

			$('#marks_fills').val(q);


			$('#total_marks').val(q);	
			
			var cc3=parseInt(q);

			var cnt1=$('#cnt_multi').val();
			if(cnt1==0)
			{	cnt1=0;	
			}
			var cntt1=parseInt(cnt1);

			var cnt2=$('#cnt_desc').val();
			if(cnt2==0)
			{	cnt2=0;	
			}
			var cntt2=parseInt(cnt2);
			
			var cnt4=$('#cnt_tf').val();
			if(cnt4==0)
			{	cnt4=0;	
			}
			var cntt4=parseInt(cnt4);

			var main=cntt1+cntt2+cc3+cntt4;
			var mainn=parseInt(main);
			$('#total_questions').val(mainn);

		    	var f=0;
		    var tf = $('input[id^="marks_f"]');
               for(var i=0; i < tf.length; i++){
               f =f-(- parseInt(tf[i].value == "" ? "0" : tf[i].value)) ;
            }
    	$("#marks_Fills").val(f);
		
	
			fill_f=$("#marks_Fills").val();
			f_f=parseInt(fill_f);

			m_m=$('#marks_multiple').val();
			if(m_m==0)
			{
				m_m=0;
			}
			var m_mm=parseInt(m_m);

			d_d=$('#marks_Desc').val();
			if(d_d==0)
			{
				d_d=0;
			}
			var d_dd=parseInt(d_d);

			tf_tf=$('#marks_tf').val();
			if(tf_tf==0)
			{
				tf_tf=0;
			}
			var tf_tff=parseInt(tf_tf);
	

			var sub=0;
			sub=m_mm + d_dd + f_f + tf_tff;
       			
			$('#total_marks').val(sub);
			$('#total').val(sub);
			
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

		function close_truefalse(node)
		{
			debugger;
            	var c4=$('.counter3').val();
			var formNo = node.parentNode.id.split('form')[1];
			
			$("#"+node.parentNode.id.split('_')[0]+"_created"+ node.parentNode.id.split('form')[1]).remove();	
			$("#"+node.parentNode.id).remove();
			for(var b=1;b<=c4;b++)
			{
			    if($('#created_truefalse'+b).is(':visible'))
			    {
			      $('#created_truefalse'+b).remove();
			    }
			}
			
				
			$("#"+node.parentNode.id).remove();

			var q1=$('#cnt_tf').val();
			q1=q1-1;
			
			$('#cnt_tf').val(q1);
				
			$('#total_questions').val(q1);

			$('#marks_tf').val(q1);

			$('#total_marks').val(q1);

			var cc4=parseInt(q1);

			var cnt1=$('#cnt_multi').val();
			if(cnt1==0)
			{	cnt1=0;	
			}
			var cntt1=parseInt(cnt1);

			var cnt2=$('#cnt_desc').val();
			if(cnt2==0)
			{	cnt2=0;	
			}
			var cntt2=parseInt(cnt2);

			var cnt3=$('#cnt_fill').val();
			if(cnt3==0)
			{	cnt3=0;	
			}
			var cntt3=parseInt(cnt3);
			
			main=cntt1+cntt2+cntt3+cc4;
			var mainn=parseInt(main);
			$('#total_questions').val(mainn);
            $('.counter4').val(mainn);
            //count4=mainn+1;

			var tf=0;
	
	        	var tr = $('input[id^="m_tf"]');
         for(var i=0; i < tr.length; i++){
        tf =tf-(- parseInt(tr[i].value == "" ? "0" : tr[i].value)) ;
    }
    	$("#marks_tf").val(tf);
	
		
			tf_t=$("#marks_tf").val();
			tf_tf=parseInt(tf_t);


			m_m=$('#marks_multiple').val();
			if(m_m==0)
			{
				m_m=0;
			}
			var m_mm=parseInt(m_m);

			d_d=$('#marks_Desc').val();
			if(d_d==0)
			{
				d_d=0;
			}
			var d_dd=parseInt(d_d);

			f_f=$('#marks_Fills').val();
			if(f_f==0)
			{
				f_f=0;
			}
			var f_ff=parseInt(f_f);

				var sub=0;
			sub=m_mm + d_dd + f_ff + tf_tf;
       		
			$('#total_marks').val(sub);
			$('#total').val(sub);
			
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
			
		
