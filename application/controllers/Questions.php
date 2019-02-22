<?php
class Questions extends CI_Controller
{
    function SuperAdminHomePage()
    {
        $this->SuperAdminSession();
        
        $data['AdminDetails']=array();
        
        $GetAdminDetails=$this->db->get('tblAdmins');
        $FetchAdminDetails=$GetAdminDetails->result();
        
        $data['AdminDetails']=$FetchAdminDetails;
        
        $this->load->view('SuperAdmin.php',$data);
    }
    function random_password( $length = 8 ) 
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }
    function SaveExamCoordinatorData()
    {
        $Email=$this->input->post('email');
        $AdminID=$this->input->post('adminid');
        $displayExamCoName=$this->input->post('displayExamCoName');
        $Password=$this->random_password(8);
        
        $GetExamCoordinatorEmail=$this->db->query("select * from tblExamCoordinator where EmailID='$Email'");
        $ExamCoCount=$GetExamCoordinatorEmail->num_rows();
        
        if($ExamCoCount==0)
        {
            $ExamCoordinatorDetails=array('EmailID'=>$Email,'Password'=>$Password,'DisplayName'=>$displayExamCoName,'AdminID'=>$AdminID);
            $this->db->insert('tblExamCoordinator',$ExamCoordinatorDetails);
        }
        
        $GetExamCoordinatorID=$this->db->query("select * from tblExamCoordinator where EmailID='$Email'");
        $FetchExamCoID=$GetExamCoordinatorID->row();
        $ExamCoID=$FetchExamCoID->ExamCoordinatorID;
        
        $encrypted_txt = $this->encrypt_decrypt('encrypt', $ExamCoID);
        
        echo json_encode(array("count" =>$ExamCoCount,"ExamCoID"=>$encrypted_txt));
    }
    function SaveAdminDetails()
    {
         $DisplayName=$this->input->post('DisplayName');
         $Email=$this->input->post('Email');
         $noOfUsers=$this->input->post('noOfUsers');
         $Password=$this->random_password(8);
         
        $GetAdminEmail=$this->db->query("select * from tblAdmins where EmailID='$Email'");
        $AdminCount=$GetAdminEmail->num_rows();
        
            if($AdminCount==0)
            {
                $AdminDetails=array('EmailID'=>$Email,'Password'=>$Password,'DisplayName'=>$DisplayName,'NumberOfUsers'=>$noOfUsers,'IsActive'=>'1');
                $this->db->insert('tblAdmins',$AdminDetails);
              //  redirect('Questions/SuperAdminHomePage');
            }
       
       $GetAdminID=$this->db->query("select * from tblAdmins where EmailID='$Email'");
       $FetchAdminID=$GetAdminID->row();
       //print_r($FetchAdminID);
       $AdminID=$FetchAdminID->Admin_id;
    
                       $encrypted_txt = $this->encrypt_decrypt('encrypt', $AdminID);
                       "Encrypted Text = " .$encrypted_txt. "\n";
       
       echo json_encode(array("count" =>$AdminCount,"AdminID"=>$encrypted_txt));
        
    }
    function SaveAdminStatus($AdminId,$Status)
    {   
        echo $AdminId;
        echo $Status;
        if($Status=='1')
        {
            $this->db->query("update tblAdmins set IsActive='0' where Admin_id='$AdminId'");
        }
        else
        {
            $this->db->query("update tblAdmins set IsActive='1' where Admin_id='$AdminId'");
        }
        redirect('Questions/SuperAdminHomePage');
    }
	function AdminHomePage()
	{
	    $this->AdminSession();

		$admin_id=$this->session->userdata('admin_id_session');
		$select_admin=$this->db->query("select * from tblQuestionPaper where UserID='$admin_id' order by Date desc");	
		$fetch_admin=$select_admin->result();

		$q_a['QuestionPaper']=$fetch_admin;

		$this->load->view('admin_home.php',$q_a);

	}
	
	function ExamCoOrdinatorHome()
	{
	    $this->ExamCoodinator();
	    
	    $e['Data']=array();
	    
	    $ExamCoID=$this->session->userdata('ExamCoOrdinatorID');
	   $GetQuePaperID=$this->db->query("select * FROM tblQuePaperAssocExamCoordinator where ExamCoordinatorID='$ExamCoID'");  
	   $FetchQuePaperID=$GetQuePaperID->result();
	  // print_r(count($FetchQuePaperID));
	   for($q=0;$q<count($FetchQuePaperID);$q++)
	   {
	         $QuePaperID=$FetchQuePaperID[$q]->QuePaperID;
	        
	        $GetDetails=$this->db->query("select DISTINCT uq.UserID,ur.EmailID,uq.QuePaperID,q.Title
FROM tblQuePaperAssocExamCoordinator ec
INNER JOIN tblQuestionPaper q ON ec.QuePaperID=q.QuePaperID
INNER JOIN tblUserAttemptQuePaperDetails uq ON ec.QuePaperID=uq.QuePaperID AND uq.QuePaperID='$QuePaperID'
INNER JOIN tblUserRegistration ur ON uq.UserID=ur.UserID
WHERE ec.ExamCoordinatorID='$ExamCoID' ORDER BY uq.UserAttemptQPdetails_ID");
        
            array_push($e['Data'],$GetDetails->result());
          //  print_r($GetDetails->result());
	   }    
	  
	    $this->load->view("ExamCoOrdinators.php",$e);
	}
	
	function DeleteLiveQuestionPaper()
	{	
	    $this->AdminSession();
	    
		echo $QuePaperID=$this->input->post('QuePaperID');
		$this->db->query("update tblQuestionPaper set IsDelete='1',IsLive='0' where QuePaperID='$QuePaperID'");
		$this->db->query("update tblTestDetails set IsDelete='1',IsLive='0' where TestID='$QuePaperID'");
		redirect('Questions/AdminHomePage');
		//$this->load->view('admin_home.php');
	}
	function DeletedQuestionPaperReport()
	{
	    $this->AdminSession();
		$qp_id=$this->input->post('qp_id');
		$this->session->set_userdata('QPID',$qp_id);	
	//	if($this->input->post('report'))
	//	{	

		$f_a['Questions']=array();	
		$f_a['Answers']=array();
		$f_a['AdminCorrectAns']=array();
		$f_a['UserAnswers']=array();

			$que_paper=$this->db->query("SELECT DISTINCT qp.QuePaperID,q.QuestionID,q.Question,q.Image,qt.QueTypeID,qt.QueType,qp.Title,qp.TotalMarks,q.Date,qpa.Marks,qpa.Negative_marks FROM tblQuestionPaper qp Inner JOIN tblQuePaperAssocQues qpa Inner JOIN tblQueAssocQueType qa inner JOIN tblQuestions q inner JOIN tblQuestionType qt inner JOIN tblUserAttemptQuestion utq inner JOIN tblUserRegistration ur ON utq.UserID=ur.UserID and qp.QuePaperID=qpa.QuePaperID AND qpa.QuestionID = q.QuestionID AND qa.QuestionID=q.QuestionID AND qa.QueTypeID = qt.QueTypeID Where qpa.QuePaperID = '$qp_id' ");
			$fetch=$que_paper->result();
			//print_r($fetch);
						
			$f_a['Questions']=$fetch;		

				$GetAdminAns=$this->db->query("SELECT DISTINCT q.QuestionID,a.AnswerID,q.Question,a.Answer FROM tblQuestions q JOIN tblQuestionPaper p JOIN tblQuePaperAssocQues qp JOIN tblQueAssocQueType qa JOIN tblAnswers a JOIN tblMultipleTypeQuesAssocAns mt ON qp.QuestionID=q.QuestionID AND q.QuestionID=mt.QuestionID AND a.AnswerID=mt.AnswerID WHERE p.QuePaperID='$qp_id' ORDER BY a.AnswerID");
				$FetchAdminAns=$GetAdminAns->result();
				$f_a['Answers']=$FetchAdminAns;
			//	print_r($FetchAdminAns);

				$AdminCorrectAns=$this->db->query("SELECT DISTINCT q.QuestionID,a.AnswerID,ca.AnswerID,q.Question,a.Answer FROM tblQuestions q JOIN tblQuestionPaper p JOIN tblQuePaperAssocQues qp JOIN tblQueAssocQueType qa JOIN tblAnswers a JOIN tblMultipleTypeQuesAssocAns mt JOIN tblQueCorrectAns ca ON ca.AnswerID=a.AnswerID AND qp.QuestionID=q.QuestionID AND q.QuestionID=mt.QuestionID AND a.AnswerID=mt.AnswerID WHERE p.QuePaperID='$qp_id'"); 
				$FetchCorrectAns=$AdminCorrectAns->result();
				$f_a['AdminCorrectAns']=$FetchCorrectAns;

			$GetUserAnswers=$this->db->query("Select DISTINCT utq.QuePaperID, utq.UserID,ur.EmailID,utq.QuestionID,
(SELECT GROUP_CONCAT(ans.Answer SEPARATOR '#')
FROM tblUserAttemptQuestion uAttQ JOIN tblUserRegistration uReg ON uAttQ.UserID = uReg.UserID JOIN tblUserAttemptAns uaAns on uAttQ.QueAttemptID = uaAns.UserAttemptQueID JOIN tblAnswers ans on ans.AnswerID = uaAns.AnswerID  WHERE uAttQ.QuestionID = utq.QuestionID AND uAttQ.UserID = utq.UserID GROUP BY uAttQ.QuestionID) AS AllAnswers FROM tblUserAttemptQuestion utq JOIN tblUserRegistration ur ON utq.UserID = ur.UserID
JOIN tblUserAttemptAns uta on utq.QueAttemptID = uta.UserAttemptQueID WHERE utq.QuePaperID = '$qp_id' and uta.IsDescriptive=0

UNION

Select DISTINCT utq.QuePaperID, utq.UserID,ur.EmailID,utq.QuestionID,
(SELECT GROUP_CONCAT(dans.DescAns SEPARATOR '#')
FROM tblUserAttemptQuestion uAttQ JOIN tblUserRegistration uReg ON uAttQ.UserID = uReg.UserID JOIN tblUserAttemptAns uaAns on uAttQ.QueAttemptID = uaAns.UserAttemptQueID JOIN tblDescriptiveAns dans on dans.DescAnsID = uaAns.AnswerID  WHERE uAttQ.QuestionID = utq.QuestionID AND uAttQ.UserID = utq.UserID GROUP BY uAttQ.QuestionID) AS AllAnswers FROM tblUserAttemptQuestion utq JOIN tblUserRegistration ur ON utq.UserID = ur.UserID
JOIN tblUserAttemptAns uta on utq.QueAttemptID = uta.UserAttemptQueID WHERE utq.QuePaperID = '$qp_id' and uta.IsDescriptive=1");			
	
			$FetchUserAnswers=$GetUserAnswers->result();
			$f_a['UserAnswers']=$FetchUserAnswers;
				//print_r($FetchUserAnswers);

		$this->load->view('deletedquepaper_details.php',$f_a);
	}
	function Report()
	{
	    
		$qp_id=$this->session->userdata('QPID',$qp_id);
		$this->session->set_userdata("data","true");	
		
	//	echo "<script type='text/javascript'>";
	//	echo "window.onbeforeunload = function() {
     //    alert('Dude, are you sure you want to leave? Think of the kittens!')}";
	//	echo "</script>";
		
		if($this->input->post('pdf'))
		{	

		$f_a['Questions']=array();	
		$f_a['Answers']=array();
		$f_a['AdminCorrectAns']=array();
		$f_a['UserAnswers']=array();

			$que_paper=$this->db->query("SELECT DISTINCT qp.QuePaperID,q.QuestionID,q.Question,q.Image,qt.QueTypeID,qt.QueType,qp.Title,qp.TotalMarks,q.Date,qpa.Marks,qpa.Negative_marks FROM tblQuestionPaper qp Inner JOIN tblQuePaperAssocQues qpa Inner JOIN tblQueAssocQueType qa inner JOIN tblQuestions q inner JOIN tblQuestionType qt inner JOIN tblUserAttemptQuestion utq inner JOIN tblUserRegistration ur ON utq.UserID=ur.UserID and qp.QuePaperID=qpa.QuePaperID AND qpa.QuestionID = q.QuestionID AND qa.QuestionID=q.QuestionID AND qa.QueTypeID = qt.QueTypeID Where qpa.QuePaperID = '$qp_id' ");
			$fetch=$que_paper->result();
			//print_r($fetch);
						
			$f_a['Questions']=$fetch;		

				$GetAdminAns=$this->db->query("SELECT DISTINCT q.QuestionID,a.AnswerID,q.Question,a.Answer FROM tblQuestions q JOIN tblQuestionPaper p JOIN tblQuePaperAssocQues qp JOIN tblQueAssocQueType qa JOIN tblAnswers a JOIN tblMultipleTypeQuesAssocAns mt ON qp.QuestionID=q.QuestionID AND q.QuestionID=mt.QuestionID AND a.AnswerID=mt.AnswerID WHERE p.QuePaperID='$qp_id' ORDER BY a.AnswerID");
				$FetchAdminAns=$GetAdminAns->result();
				$f_a['Answers']=$FetchAdminAns;
			//	print_r($FetchAdminAns);

				$AdminCorrectAns=$this->db->query("SELECT DISTINCT q.QuestionID,a.AnswerID,ca.AnswerID,q.Question,a.Answer FROM tblQuestions q JOIN tblQuestionPaper p JOIN tblQuePaperAssocQues qp JOIN tblQueAssocQueType qa JOIN tblAnswers a JOIN tblMultipleTypeQuesAssocAns mt JOIN tblQueCorrectAns ca ON ca.AnswerID=a.AnswerID AND qp.QuestionID=q.QuestionID AND q.QuestionID=mt.QuestionID AND a.AnswerID=mt.AnswerID WHERE p.QuePaperID='$qp_id'"); 
				$FetchCorrectAns=$AdminCorrectAns->result();
				$f_a['AdminCorrectAns']=$FetchCorrectAns;

			$GetUserAnswers=$this->db->query("Select DISTINCT utq.QuePaperID, utq.UserID,ur.EmailID,utq.QuestionID,
(SELECT GROUP_CONCAT(ans.Answer SEPARATOR '#')
FROM tblUserAttemptQuestion uAttQ JOIN tblUserRegistration uReg ON uAttQ.UserID = uReg.UserID JOIN tblUserAttemptAns uaAns on uAttQ.QueAttemptID = uaAns.UserAttemptQueID JOIN tblAnswers ans on ans.AnswerID = uaAns.AnswerID  WHERE uAttQ.QuestionID = utq.QuestionID AND uAttQ.UserID = utq.UserID GROUP BY uAttQ.QuestionID) AS AllAnswers FROM tblUserAttemptQuestion utq JOIN tblUserRegistration ur ON utq.UserID = ur.UserID
JOIN tblUserAttemptAns uta on utq.QueAttemptID = uta.UserAttemptQueID WHERE utq.QuePaperID = '$qp_id' and uta.IsDescriptive=0

UNION

Select DISTINCT utq.QuePaperID, utq.UserID,ur.EmailID,utq.QuestionID,
(SELECT GROUP_CONCAT(dans.DescAns SEPARATOR '#')
FROM tblUserAttemptQuestion uAttQ JOIN tblUserRegistration uReg ON uAttQ.UserID = uReg.UserID JOIN tblUserAttemptAns uaAns on uAttQ.QueAttemptID = uaAns.UserAttemptQueID JOIN tblDescriptiveAns dans on dans.DescAnsID = uaAns.AnswerID  WHERE uAttQ.QuestionID = utq.QuestionID AND uAttQ.UserID = utq.UserID GROUP BY uAttQ.QuestionID) AS AllAnswers FROM tblUserAttemptQuestion utq JOIN tblUserRegistration ur ON utq.UserID = ur.UserID
JOIN tblUserAttemptAns uta on utq.QueAttemptID = uta.UserAttemptQueID WHERE utq.QuePaperID = '$qp_id' and uta.IsDescriptive=1");			
	
			$FetchUserAnswers=$GetUserAnswers->result();
			$f_a['UserAnswers']=$FetchUserAnswers;
				//print_r($FetchUserAnswers);

		}
			require_once APPPATH.'/third_party/vendor/autoload.php';
					$pdf=new \Mpdf\Mpdf(['margin_left' => -2,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 0,'margin_header' => 0,'margin_footer' => 0]);
					$html=$this->load->view('deletedquepaper_details.php',$f_a,true);
					$this->session->set_userdata("data","false");
					$pdfFilePath ="webpreparations-".time().".pdf";
					//<link rel="icon" type="image/ico" href="'.base_url().'/assets/images/logo.png">
					$pdf->SetTitle('QUESTION & ANSWER');
					$pdf->WriteHTML($html,2);
					$pdf->Output('Report.pdf','D');
					exit;


	}
	function UserList()
	{
	    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	   
	   $parameters=parse_url($actual_link, PHP_URL_QUERY);
	   parse_str($parameters);
	   
        $qp_name1=null;
        if(isset($QPName))
        {
	        $qp_name1=str_replace('%20',' ',$QPName);
        }
	    $this->AdminSession();
		$user['users']=array();
		$user['UserMarks']=array();
		$user['QuePaper']=array();

	        if($qp_name1!=null)
	        {
	            $qp_name=$qp_name1;
	        }
	        else
	        {
		    	$qp_name=$this->input->post('qp_name');
	        }
	        
			$select_qp=$this->db->query("select * from tblQuestionPaper where Title='$qp_name'");
			$fetch_qp=$select_qp->result();
			$user['QuePaper']=$fetch_qp;
			for($qp=0;$qp<count($fetch_qp);$qp++)
			{
				$qp_id=$fetch_qp[$qp]->QuePaperID;
				$this->session->set_userdata('qp_id_session',$qp_id);
				
				$select_user_qp=$this->db->query("select distinct UserID,QuePaperSubmissionDate from tblUserAttemptQuePaperDetails where QuePaperID='$qp_id'");
				$fetch_user_qp=$select_user_qp->result();
				$user['question_paper']=$fetch_user_qp;
				for($q_a=0;$q_a<count($fetch_user_qp);$q_a++)
				{
					$user_qp_id=$fetch_user_qp[$q_a]->UserID;
			
					$select_user=$this->db->query("select * from tblUserRegistration where UserID='$user_qp_id'");
					$fetch_user=$select_user->result();
					
					$GetUserMarks=$this->db->query("select * from tblUserAttemptQuePaperDetails where UserID='$user_qp_id' and QuePaperID='$qp_id'");
					$FetchUserMarks=$GetUserMarks->result();
					array_push($user['UserMarks'],$FetchUserMarks);
					array_push($user['users'],$fetch_user);
				}
		
		}
		$this->load->view('user_list_admin.php',$user);
	}
	function DraftedQuestionPapers()
	{
	    $this->AdminSession();
    
		$qp_id=$this->input->post('qp_id');
		$qp_name=$this->input->post('qp_name');

		$a['Questions']=array();
		$a['Answers']=array();
		$a['AdminCorrectAns']=array();		

		$a['QuestionType']=array();
		$a['$QuePaperDate']=array();
		$a['QuePaperRefDoc']=array();
		$a['ExamCoordinator']=array();
		$a['ExamCoordinatorAssocQuePaper']=array();
		
		$GetQueType=$this->db->query("select * from tblQuestionType");
		$FetchQueType=$GetQueType->result();
				
		$a['QuestionType']=$FetchQueType;
		
		$QuePaperDate=$this->db->query("select Date from tblQuestionPaper where
		Title='$qp_name'");
		$FetchQuePaper=$QuePaperDate->result();
			$a['QuePaperDate']=$FetchQuePaper;
			
				$QuePaperRefDoc=$this->db->query("select ReferenceDoc from tblQuestionPaper where
		QuePaperID='$qp_id'");
		$FetchQuePaperRefDoc=$QuePaperRefDoc->result();
			$a['QuePaperRefDoc']=$FetchQuePaperRefDoc;
			
	    $AdminID=$this->session->userdata('admin_id_session');
		
		$ExamCoDetails=$this->db->query("select * from tblExamCoordinator where AdminID='$AdminID'");
		$FetchExamCoDetails=$ExamCoDetails->result();
		$a['ExamCoordinator']=$FetchExamCoDetails;	
		
		$ExamCoAssocQPDetails=$this->db->query("select * from tblQuePaperAssocExamCoordinator where QuePaperID='$qp_id'");
		$FetchExamCoAssocQPDetails=$ExamCoAssocQPDetails->result();
		$a['ExamCoordinatorAssocQuePaper']=$FetchExamCoAssocQPDetails;	

		$Getquestions=$this->db->query("SELECT DISTINCT qp.QuePaperID,
q.QuestionID,q.Question,q.Image,q.RefDocPageNo,q.ReferenceDoc,
qt.QueTypeID,qt.QueType,
qp.Title,qp.TotalMarks,qp.IsMockTest,qp.PassingPercentage,
q.Date,
qpa.Marks,qpa.Negative_marks 
FROM tblQuestionPaper qp 
Inner JOIN tblQuePaperAssocQues qpa ON qp.QuePaperID = qpa.QuePaperID 
inner JOIN tblQuestions q ON qpa.QuestionID = q.QuestionID
Inner JOIN tblQueAssocQueType qa ON qa.QuestionID=q.QuestionID 
inner JOIN tblQuestionType qt ON qa.QueTypeID = qt.QueTypeID 


Where qpa.QuePaperID = '$qp_id' ORDER by q.QuestionID");
	
		$Fetchquestions=$Getquestions->result();
		$a['Questions']=$Fetchquestions;
	 

		$GetAdminAns=$this->db->query("SELECT DISTINCT q.QuestionID,a.AnswerID,q.Question,a.Answer FROM tblQuestions q JOIN tblQuestionPaper p JOIN tblQuePaperAssocQues qp JOIN tblQueAssocQueType qa JOIN tblAnswers a JOIN tblMultipleTypeQuesAssocAns mt ON qp.QuestionID=q.QuestionID AND q.QuestionID=mt.QuestionID AND a.AnswerID=mt.AnswerID WHERE p.QuePaperID='$qp_id' ORDER BY a.AnswerID");
				$FetchAdminAns=$GetAdminAns->result();
				$a['Answers']=$FetchAdminAns;	

		$AdminCorrectAns=$this->db->query("SELECT DISTINCT q.QuestionID,a.AnswerID,ca.AnswerID,q.Question,a.Answer FROM tblQuestions q JOIN tblQuestionPaper p JOIN tblQuePaperAssocQues qp JOIN tblQueAssocQueType qa JOIN tblAnswers a JOIN tblMultipleTypeQuesAssocAns mt JOIN tblQueCorrectAns ca ON ca.AnswerID=a.AnswerID AND qp.QuestionID=q.QuestionID AND q.QuestionID=mt.QuestionID AND a.AnswerID=mt.AnswerID WHERE p.QuePaperID='$qp_id'"); 
				$FetchCorrectAns=$AdminCorrectAns->result();
				$a['AdminCorrectAns']=$FetchCorrectAns;


		$this->load->view('draftedquepaper.php',$a);
		
    	
	}
	function DraftedQuestionPaperData()
	{
	    $this->AdminSession();
	    
		$ImgFill=null;
		$ImgMulti=null;
		$ImgDesc=null;
		$ImgTF=null;			

		 
		 $count=$this->input->post('countt');
	     $cnt=explode(',',$count);
		 
		 $paper_name=ucfirst($this->input->post('paper_name'));
		 $date=date("Y-m-d",strtotime($this->input->post('date')));
		 $paper_marks=$this->input->post('paper_marks');
		 $TestType=$this->input->post('test');
		 $QPaperPercentage=$this->input->post('QPaperPercentage');
		 $ExamCoordinators=$this->input->post('ExamCoordinators');
		 $ExecPaperRefDoc=$this->input->post('ExecPaperRefDoc');
		 $NewPaperRefDoc=null;
		 
		 	$totalcount=$this->input->post('hdn1');
		$Count=explode(',',$totalcount);
	
	    $DeletedQues=$this->input->post('DeletedQues');
	    
		$QuePaperID=$this->input->post('QuePaperID');
		 
		 $a['DraftedData']=array();
		 $a['NewData']=array();
		 $a['PaperInfo']=array();
		 
	        	    	$config['allowed_types']="*";
						$config['upload_path']="./assets/uploads";
	
						$this->load->library('upload',$config);
		 
		 if($ExecPaperRefDoc!=null)
		 {
		     $NewPaperRefDoc=$ExecPaperRefDoc;
		 }
		 else
		 {
						if($this->upload->do_upload('NewPaperRefDoc'))
						{
							 $ResNewPaperDoc=$this->upload->data();
							 $NewPaperRefDoc=$ResNewPaperDoc['file_name'];
						}
						else
						{
							 $this->upload->display_errors();
						}
		 }
		 
		 $PaperInfo=array('DeletedQues'=>$DeletedQues,'QuePaperID'=>$QuePaperID,'TestType'=>$TestType,'PaperName'=>$paper_name,'Date'=>$date,'PaperMarks'=>$paper_marks,'NewPaperRefDoc'=>$NewPaperRefDoc,'QPaperPercentage'=>$QPaperPercentage,'ExamCoordinators'=>$ExamCoordinators);
		 array_push($a['PaperInfo'],$PaperInfo);
		

		//if($this->input->post('save'))
	//	{
	        if(empty($cnt) || $count==null)
	        {   }
	        else
	        {
	
			for($i=0;$i<count($cnt);$i++)
			{	
				$ImgFill=null;
				$ImgMulti=null;
				$ImgDesc=null;
				$ImgTF=null;

				$MultiQueType=$this->input->post('MultiQueType'.$cnt[$i]);
				$DescQueType=$this->input->post('DescQueType'.$cnt[$i]);
				$FillQueType=$this->input->post('FillQueType'.$cnt[$i]);
				$TFQueType=$this->input->post('TFQueType'.$cnt[$i]);
			
					//multiple

					$MultiAnsID=$this->input->post('MultiAnsID'.$cnt[$i]);
					//print_r($MultiAnsID);
					$MultiQueID=$this->input->post('MultiQueID'.$cnt[$i]);
					$Quemulti=ucfirst($this->input->post('Quemulti'.$cnt[$i]));
					$ExistingImgMulti=$this->input->post('ExistingImgMulti'.$cnt[$i]);
					$RefDocMulti=null;
					$RefDocMultiPageNo=null;
					$RefDocMultiPageNo=$this->input->post('RefDocMultiPageNo'.$cnt[$i]);
				
						
						if($this->upload->do_upload('ImgMulti'.$cnt[$i]))
						{
							 $ResultMultiImg=$this->upload->data();
							 $ImgMulti=$ResultMultiImg['file_name'];
						}
						else
						{
							 $this->upload->display_errors();
						}
						
	 
					if($ExistingImgMulti==null && $ImgMulti==null)
					{
						$ImgMulti=null; 
					}
					elseif($ImgMulti==null && $ExistingImgMulti!=null)
					{
						$ImgMulti=$ExistingImgMulti;
					}
					

						if($this->upload->do_upload('RefDocMulti'.$cnt[$i]))
						{
							 $ResRefDocMulti=$this->upload->data();
							 $RefDocMulti=$ResRefDocMulti['file_name'];
						}
						else
						{
							 $this->upload->display_errors();
						}
					
				
					$MarksMulti=$this->input->post('MarksMulti'.$cnt[$i]);
					$NegMarksMulti=$this->input->post('NegMarksMulti'.$cnt[$i]);
					$txtAnsMulti=$this->input->post('txtAnsMulti'.$cnt[$i]);
					$ChkAnsMulti=$this->input->post('ChkAnsMulti'.$cnt[$i]);
					
					$AddtxtAnsMulti=array();
					$AddChkAnsMulti=array();
					
					foreach($_POST as $key => $value)
					{
						if(strpos($key,'AnsMulti'.$cnt[$i].'-') === 0)
						{
								array_push($AddtxtAnsMulti,$this->input->post($key));
						}
						if(strpos($key,'AnsMultiChkk'.$cnt[$i].'-') === 0)
						{
								array_push($AddChkAnsMulti,$this->input->post($key));
						}
					}
					//print_r($AddtxtAnsMulti);	
					//descriptive

					$DescQueID=$this->input->post('DescQueID'.$cnt[$i]);
					$QueDesc=ucfirst($this->input->post('QueDesc'.$cnt[$i]));
					$ExistingImgDesc=$this->input->post('ExistingImgDesc'.$cnt[$i]);
					$RefDocDesc=null;
				

						if($this->upload->do_upload('ImgDesc'.$cnt[$i]))
						{
							 $ResultDescImg=$this->upload->data();
							 $ImgDesc=$ResultDescImg['file_name'];
						}
						else
						{
							 $this->upload->display_errors();
						}
						if($ExistingImgDesc==null && $ImgDesc==null)
						{	
							$ImgDesc=null; 
						}
						elseif($ImgDesc==null && $ExistingImgDesc!=null)
						{
							$ImgDesc=$ExistingImgDesc;
						}
						
						if($this->upload->do_upload('RefDocDesc'.$cnt[$i]))
						{
							 $ResRefDocDesc=$this->upload->data();
							 $RefDocDesc=$ResRefDocDesc['file_name'];
						}
						else
						{
							 $this->upload->display_errors();
						}
					
						$MarksDesc=$this->input->post('MarksDesc'.$cnt[$i]);
						$NegMarksDesc=$this->input->post('NegMarksDesc'.$cnt[$i]);
						$AnsDesc=ucfirst($this->input->post('AnsDesc'.$cnt[$i]));
						$DescAnsID=$this->input->post('DescAnsID'.$cnt[$i]);	
						$RefDocDescPageNo=null;
				    	$RefDocDescPageNo=$this->input->post('RefDocDescPageNo'.$cnt[$i]);
				
					//fill in the blanks

					$FillQueID=$this->input->post('FillQueID'.$cnt[$i]);
					$QueFill=ucfirst($this->input->post('QueFill1'.$cnt[$i])).'_____'.$this->input->post('QueFill2'.$cnt[$i]);
					$ExistingImgFill=$this->input->post('ExistingImgFill'.$cnt[$i]);
					$RefDocFill=null;
	
							if($this->upload->do_upload('ImgFill'.$cnt[$i]))
							{
								 $ResultFillImg=$this->upload->data();
								 $ImgFill=$ResultFillImg['file_name'];
							}
							else
							{
								 $this->upload->display_errors();
							}
				
						if($ExistingImgFill==null && $ImgFill==null)
						{
							$ImgFill=null; 
						}
						elseif($ImgFill==null && $ExistingImgFill!=null)
						{
							$ImgFill=$ExistingImgFill;
						}
						
							if($this->upload->do_upload('RefDocFill'.$cnt[$i]))
							{
								 $ResRefDocFill=$this->upload->data();
								 $RefDocFill=$ResRefDocFill['file_name'];
							}
							else
							{
								 $this->upload->display_errors();
							}
						
						$FillAnsID=$this->input->post('FillAnsID'.$cnt[$i]);
						//print_r($FillAnsID);
						$MarksFill=$this->input->post('MarksFill'.$cnt[$i]);
						$NegMarksFill=$this->input->post('NegMarksFill'.$cnt[$i]);	
						$txtAnsFill=$this->input->post('txtAnsFill'.$cnt[$i]);
						$ChkAnsFill=$this->input->post('ChkAnsFill'.$cnt[$i]);
						$RefDocFillPageNo=null;
						$RefDocFillPageNo=$this->input->post('RefDocFillPageNo'.$cnt[$i]);
						//print_r($ChkAnsFill);

						$AddtxtAnsFill=array();
						$AddChkAnsFill=array();
		
						foreach($_POST as $key => $value)
						{
							if(strpos($key,'AnsFill'.$cnt[$i].'-') === 0)
							{
								array_push($AddtxtAnsFill,$this->input->post($key));
							}
							if(strpos($key,'AddChkAnsFill'.$cnt[$i].'-') === 0)
							{
								array_push($AddChkAnsFill,$this->input->post($key));
							}
						}
					//	print_r($AddChkAnsFill);
					//true false

					$TFQueID=$this->input->post('TFQueID'.$cnt[$i]);
					$QueTF=ucfirst($this->input->post('QueTF'.$cnt[$i]));
					$ExistingImgTF=$this->input->post('ExistingImgTF'.$cnt[$i]);
					$RefDocTF=null;


						if($this->upload->do_upload('ImgTF'.$cnt[$i]))
						{
							 $ResultTFImg=$this->upload->data();
							 $ImgTF=$ResultTFImg['file_name'];
						}
						else
						{
							 $this->upload->display_errors();
						}
	
					if($ExistingImgTF==null && $ImgTF==null)
					{
						$ImgTF=null; 
					}
					elseif($ImgTF==null && $ExistingImgTF!=null)
					{
						$ImgTF=$ExistingImgTF;
					}
					
						if($this->upload->do_upload('RefDocTF'.$cnt[$i]))
						{
							 $ResRefDocTF=$this->upload->data();
							 $RefDocTF=$ResRefDocTF['file_name'];
						}
						else
						{
							 $this->upload->display_errors();
						}

					$MarksTF=$this->input->post('MarksTF'.$cnt[$i]);
					$NegMarksTF=$this->input->post('NegMarksTF'.$cnt[$i]);
					$TFAns1='True';
					$TFAns2='False';
					$TFAnsChk1=$this->input->post('TFAns'.$cnt[$i]);
					$TFAnsChk2=$this->input->post('TFAns'.$cnt[$i]);
					$TrueAnsID=$this->input->post('TrueAnsID'.$cnt[$i]);
					$FalseAnsID=$this->input->post('FalseAnsID'.$cnt[$i]);
					$RefDocTFPageNo=null;
					$RefDocTFPageNo=$this->input->post('RefDocTFPageNo'.$cnt[$i]);
				
	
$data=array('MultiQueID'=>$MultiQueID,'Qtypemulti'=>$MultiQueType,'Qtypedesc'=>$DescQueType,'Qtypefill'=>$FillQueType,'Qtypetf'=>$TFQueType,'Quemulti'=>$Quemulti,'ImageMulti'=>$ImgMulti,'MarksMulti'=>$MarksMulti,'NegMarksMulti'=>$NegMarksMulti,'RefDocMulti'=>$RefDocMulti,'RefDocMultiPageNo'=>$RefDocMultiPageNo,'txtAnsMulti'=>$txtAnsMulti,'ChkAnsMulti'=>$ChkAnsMulti,'AddtxtAnsMulti'=>$AddtxtAnsMulti,'AddChkAnsMulti'=>$AddChkAnsMulti,'MultiAnsID'=>$MultiAnsID,'DescQueID'=>$DescQueID,'DescAnsID'=>$DescAnsID,'QueDesc'=>$QueDesc,'ImageDesc'=>$ImgDesc,'MarksDesc'=>$MarksDesc,'NegMarksDesc'=>$NegMarksDesc,'RefDocDesc'=>$RefDocDesc,'RefDocDescPageNo'=>$RefDocDescPageNo,'AnsDesc'=>$AnsDesc,'FillQueID'=>$FillQueID,'FillAnsID'=>$FillAnsID,'QueFill'=>$QueFill,'ImageFill'=>$ImgFill,'MarksFill'=>$MarksFill,'NegMarksFill'=>$NegMarksFill,'RefDocFill'=>$RefDocFill,'RefDocFillPageNo'=>$RefDocFillPageNo,'txtAnsFill'=>$txtAnsFill,'ChkAnsFill'=>$ChkAnsFill,'AddtxtAnsFill'=>$AddtxtAnsFill,'AddChkAnsFill'=>$AddChkAnsFill,'TFQueID'=>$TFQueID,'QueTF'=>$QueTF,'ImageTF'=>$ImgTF,'MarksTF'=>$MarksTF,'NegMarksTF'=>$NegMarksTF,'RefDocTF'=>$RefDocTF,'RefDocTFPageNo'=>$RefDocTFPageNo,'TFAns1'=>$TFAns1,'TFAns2'=>$TFAns2,'TFAnsChk1'=>$TFAnsChk1,'TFAnsChk2'=>$TFAnsChk2,'TrueAnsID'=>$TrueAnsID,'FalseAnsID'=>$FalseAnsID);            
		array_push($a['DraftedData'],$data);			
			
			}//for
	        }
			 if(empty($Count) || $totalcount==null)
	        {   }
	        else
	        {
	           for($j=0;$j<count($Count);$j++)
			    {
			        $FileMulti=null;
				$QueMulti=ucfirst($this->input->post('question_multi'.$Count[$j]));
				$MarksMulti=$this->input->post('marks_multi'.$Count[$j]);
				$NegMarksMulti=$this->input->post('negative_marks_multi'.$Count[$j]);
				$MultiRefDoc=null;
				$MultiRefPageNo=null;
		        $MultiRefPageNo=$this->input->post('MultiRefPageNo'.$Count[$j]);

						if($this->upload->do_upload('img_multi'.$Count[$j]))
						{
							 $res_multi=$this->upload->data();
							 $FileMulti=$res_multi['file_name'];
						}
						else
						{
							 $this->upload->display_errors();
						}
						
						if($this->upload->do_upload('MultiRefDoc'.$Count[$j]))
						{
							 $ResMultiRefDoc=$this->upload->data();
							 $MultiRefDoc=$ResMultiRefDoc['file_name'];
						}
						else
						{
							 $this->upload->display_errors();
						}
						
						
				$NewtxtAnsMulti=array();
				$NewChkAnsMulti=array();
				foreach($_POST as $key => $value) {
   					 if (strpos($key, 'NewtxtAnsMulti'.$Count[$j].'-') === 0)
					 {
						array_push($NewtxtAnsMulti,$this->input->post($key));
   					 }
					if(strpos($key, 'NewChkAnsMulti'.$Count[$j].'-') === 0)
					{
						array_push($NewChkAnsMulti,$this->input->post($key));
					}
			        }
			        
			        //descriptive
			        
			             $FileDesc=null;

			        	$QueDesc=ucfirst($this->input->post('question_desc'.$Count[$j]));	
			        	$MarksDesc=$this->input->post('marks_desc'.$Count[$j]);
			        	$NegMarksDesc=$this->input->post('negative_marks_desc'.$Count[$j]);
			        	$AnsDesc=ucfirst($this->input->post('ans_desc'.$Count[$j]));	
			        	
			        	$DescRefDoc=null;
			        	$DescRefPageNo=null;
						$DescRefPageNo=$this->input->post('DescRefPageNo'.$Count[$j]);

						if($this->upload->do_upload('img_desc'.$Count[$j]))
						{
							$res_desc=$this->upload->data();
							$FileDesc=$res_desc['file_name'];
						}
						else
						{
							$this->upload->display_errors();	
						}
						
						if($this->upload->do_upload('DescRefDoc'.$Count[$j]))
						{
							$ResDescRefDoc=$this->upload->data();
							$DescRefDoc=$ResDescRefDoc['file_name'];
						}
						else
						{
							$this->upload->display_errors();	
						}
						
						//fill in the blanks
						
						$FileFill=null;
						$FillRefDoc=null;
						$FillRefPageNo=null;
						$FillRefPageNo=$this->input->post('FillRefPageNo'.$Count[$j]);
								
				$QueFill=ucfirst($this->input->post('que1_fill'.$Count[$j])).' _____ '.$this->input->post('que2_fill'.$Count[$j]);
				$MarksFill=$this->input->post('marks_fill'.$Count[$j]);
				$NegMarksFill=$this->input->post('negative_marks_fill'.$Count[$j]);
				$NewtxtAnsFill=array();
				$NewChkAnsFill=array();
				
				foreach($_POST as $key => $value) {
   					 if (strpos($key, 'NewtxtAnsfill'.$Count[$j].'-') === 0)
					 {
						array_push($NewtxtAnsFill,$this->input->post($key));
						//print_r($txtAnsMulti);
   					 }
					
			        	 if(strpos($key,'NewChkAnsfill'.$Count[$j].'-') === 0)
				 	 {
						array_push($NewChkAnsFill,$this->input->post($key));
						//print_r($ChkAnsFill);	
					 }
				}
						
						if($this->upload->do_upload('img_fill'.$Count[$j]))
						{
							$res_fill=$this->upload->data();
							$FileFill=$res_fill['file_name'];
						}
						else
						{
							$this->upload->display_errors();
						}
						
						if($this->upload->do_upload('FillRefDoc'.$Count[$j]))
						{
							$ResFillRefDoc=$this->upload->data();
							$FillRefDoc=$ResFillRefDoc['file_name'];
						}
						else
						{
							$this->upload->display_errors();
						}
						
						//true false
						
						$FileTF=null;	
						$TFRefDoc=null;
						$TFRefPageNo=null;
						$TFRefPageNo=$this->input->post('TFRefPageNo'.$Count[$j]);
			
				$QueTF=ucfirst($this->input->post('question_true_false'.$Count[$j]));
				$Ans1Chkk='True';
				$Ans2Chkk='False';
				$Ans1TF=$this->input->post('true_false'.$Count[$j]);
				$Ans2TF=$this->input->post('true_false'.$Count[$j]);
				$MarksTF=$this->input->post('marks_tf'.$Count[$j]);
				$NegMarksTF=$this->input->post('negative_marks_tf'.$Count[$j]);
			

						if($this->upload->do_upload('img_true_false'.$Count[$j]))		
						{
							$res_tf=$this->upload->data();
							$FileTF=$res_tf['file_name'];
						}
						else
						{
							$this->upload->display_errors();			
						}
						
						if($this->upload->do_upload('TFRefDoc'.$Count[$j]))		
						{
							$ResTFRefDoc=$this->upload->data();
							$TFRefDoc=$ResTFRefDoc['file_name'];
						}
						else
						{
							$this->upload->display_errors();			
						}
						
	$data=array('QueMulti'=>$QueMulti,'MarksMulti'=>$MarksMulti,'NegMarksMulti'=>$NegMarksMulti,'FileMulti'=>$FileMulti,'MultiRefDoc'=>$MultiRefDoc,'MultiRefPageNo'=>$MultiRefPageNo,'NewtxtAnsMulti'=>$NewtxtAnsMulti,'NewChkAnsMulti'=>$NewChkAnsMulti,'QueDesc'=>$QueDesc,'MarksDesc'=>$MarksDesc,'NegMarksDesc'=>$NegMarksDesc,'FileDesc'=>$FileDesc,'DescRefDoc'=>$DescRefDoc,'DescRefPageNo'=>$DescRefPageNo,'AnsDesc'=>$AnsDesc,'QueFill'=>$QueFill,'MarksFill'=>$MarksFill,'NegMarksFill'=>$NegMarksFill,'FileFill'=>$FileFill,'FillRefDoc'=>$FillRefDoc,'FillRefPageNo'=>$FillRefPageNo,'NewtxtAnsFill'=>$NewtxtAnsFill,'NewChkAnsFill'=>$NewChkAnsFill,'QueTF'=>$QueTF,'MarksTF'=>$MarksTF,'NegMarksTF'=>$NegMarksTF,'FileTF'=>$FileTF,'TFRefDoc'=>$TFRefDoc,'TFRefPageNo'=>$TFRefPageNo,'Ans1Chkk'=>$Ans1Chkk,'Ans2Chkk'=>$Ans2Chkk,'Ans1TF'=>$Ans1TF,'Ans2TF'=>$Ans2TF);					
			      array_push($a['NewData'],$data);	  
			    }
	        }
			
		$this->load->view('new_drafted_quepaper.php',$a);
	}
	function SaveDraftedQuestionPaperData()
	{
		$count=$this->input->post('count');
		$PaperName=$this->input->post('PaperName');
		$Date=$this->input->post('Date');
		$PaperMarks=$this->input->post('PaperMarks');
		$CurrentDate=date('Y-m-d');
		$TestType=$this->input->post('TestType');
		$NewPaperRefDoc=$this->input->post('NewPaperRefDoc');
		$QPaperPercentage=$this->input->post('QPaperPercentage');

		$QuePaperId=$this->input->post('QuePaperID');
		
		$ExamCoordinators=explode(",",$this->input->post('ExamCoordinators'));
		
		$DeletedQues=$this->input->post('DeletedQues');
      $DeletedQues;
          $myArray = explode(',', $DeletedQues);
       
       if(empty($myArray) || $DeletedQues==null)
       {}
        else
        {
        for($q=0;$q<count($myArray);$q++)
        {
            $this->db->query("DELETE qc,m,qp,qa,a,q FROM 
tblQuePaperAssocQues qp JOIN tblQuestions q ON q.QuestionID=qp.QuestionID
JOIN tblQueAssocQueType qa ON q.QuestionID=qa.QuestionID 
JOIN tblMultipleTypeQuesAssocAns m ON q.QuestionID=m.QuestionID
JOIN tblQueCorrectAns qc ON q.QuestionID=qc.QuestionID
JOIN tblAnswers a ON m.AnswerID=a.AnswerID
WHERE q.QuestionID='$myArray[$q]' AND qp.QuePaperID='$QuePaperId'");
        }
        }
        
		$NewCount=$this->input->post('NewCount');
	
		$GetTestID=$this->db->query("select TestID from tblTestDetails where TestName='$PaperName'");
		$FetchTestID=$GetTestID->result();
	//	print_r($FetchTestID);
		$TestId=$FetchTestID[0]->TestID;
	
	    
		
		if($this->input->post('save'))
		{
			$Qtypemulti=$this->input->post('Qtypemulti');
			$Qtypedesc=$this->input->post('Qtypedesc');	
			$Qtypefill=$this->input->post('Qtypefill');
			$Qtypetf=$this->input->post('Qtypetf');	

            if($TestType=="Mock")
            {
                    if($NewPaperRefDoc==null)
                    {
                    	$this->db->query("update tblQuestionPaper set Title='$PaperName',TotalMarks='$PaperMarks',Date='$Date',IsLive='0',IsMockTest='1',PassingPercentage='$QPaperPercentage' where QuePaperID='$QuePaperId'");

                    }
                    else
                    {
                        $this->db->query("update tblQuestionPaper set Title='$PaperName',TotalMarks='$PaperMarks',Date='$Date',IsLive='0',IsMockTest='1',PassingPercentage='$QPaperPercentage',ReferenceDoc='$NewPaperRefDoc' where QuePaperID='$QuePaperId'");
                    }
            }
		    else
		    {
		        	$this->db->query("update tblQuestionPaper set Title='$PaperName',TotalMarks='$PaperMarks',Date='$Date',IsLive='0',IsMockTest='0',PassingPercentage='$QPaperPercentage' where QuePaperID='$QuePaperId'");

		    }
			$this->db->query("update tblTestDetails set TestName='$PaperName',Date='$Date',IsLive='0' where TestID='$QuePaperId'");
			
			    $GetExamCoID=$this->db->query("select * from tblQuePaperAssocExamCoordinator where QuePaperID='$QuePaperId'");
		        $FetchExamCoID=$GetExamCoID->result();
		        for($ec=0;$ec<count($FetchExamCoID);$ec++)
		        {
		            $ExamCoordinatorID=$FetchExamCoID[$ec]->ExamCoordinatorID;
		          $this->db->query("delete from tblQuePaperAssocExamCoordinator where ExamCoordinatorID='$ExamCoordinatorID'");
		        }
			
			for($e=0;$e<count($ExamCoordinators);$e++)
		    {
		       $ExamCoAssocQuePaper=array('QuePaperID'=>$QuePaperId,'ExamCoordinatorID'=>$ExamCoordinators[$e]);
		       $this->db->insert('tblQuePaperAssocExamCoordinator',$ExamCoAssocQuePaper);
	    	}
		
            if($count>0)
            {
			for($i=1;$i<=$count;$i++)
			{	
				
				$MultiQueID=$this->input->post('MultiQueID'.$i);
				$DescQueID=$this->input->post('DescQueID'.$i);
				$FillQueID=$this->input->post('FillQueID'.$i);
				$TFQueID=$this->input->post('TFQueID'.$i);

           
				
				//multiple
				if($Qtypemulti=='Multiple choice questions' && $DescQueID==null && $FillQueID==null && $TFQueID==null)
				{
					$Quemulti=$this->input->post('Quemulti'.$i);
					$MarksMulti=$this->input->post('MarksMulti'.$i);
					$NegMarksMulti=$this->input->post('NegMarksMulti'.$i);
					$ImgMulti=$this->input->post('ImgMulti'.$i);
					$AnsMultiExe=$this->input->post('AnsMulti'.$i);
					$AnsMultiAdd=$this->input->post('AnsMultiAdd'.$i);
					
					$CorrAnsMultiExe=$this->input->post('CorrAnsMultiExe'.$i);
					$CorrAnsMultiAdd=$this->input->post('CorrAnsMultiAdd'.$i);
					$MultiAnsID=$this->input->post('MultiAnsID'.$i);
					$RefDocMulti=$this->input->post('RefDocMulti'.$i);
					$RefDocMultiPageNo=$this->input->post('RefDocMultiPageNo'.$i);
					
				
                        $select=$this->db->query("select ReferenceDoc from tblQuestions where QuestionID='$MultiQueID'");
						$fetch=$select->row();
						$ReFDOC=$fetch->ReferenceDoc;
						
						if($RefDocMultiPageNo!=null)
						{
						    if($ReFDOC!=null)
						    {
						        $this->db->query("update tblQuestions set ReferenceDoc='' where QuestionID='$MultiQueID'");
						    }
						}

            if($RefDocMulti!=null)
            {
                    $arraymque = array(
        'Question' => $Quemulti,
        'Image' => $ImgMulti,
        'ReferenceDoc'=>$RefDocMulti,
        'RefDocPageNo'=>$RefDocMultiPageNo,
        'Date' => $CurrentDate
        );
        
                $this->db->set($arraymque);
                $this->db->where('QuestionID', $MultiQueID);
                $this->db->update('tblQuestions');

            }
            else
            {
                 $arraymque = array(
                'Question' => $Quemulti,
                 'Image' => $ImgMulti,
                 'RefDocPageNo'=>$RefDocMultiPageNo,
                  'Date' => $CurrentDate
                 );
                 
                 $this->db->set($arraymque);
                $this->db->where('QuestionID', $MultiQueID);
                $this->db->update('tblQuestions');
            }
                
                    
				//	$this->db->query("update tblQuestions set Question='$Quemulti',Image='$ImgMulti',Date='$CurrentDate' where QuestionID='$MultiQueID'");
					$this->db->query("update tblQuePaperAssocQues set Marks='$MarksMulti',Negative_marks='$NegMarksMulti' where QuePaperID='$QuePaperId' and QuestionID='$MultiQueID'");


					for($e=0;$e<count($AnsMultiExe);$e++)
					{
						$AnsID=$MultiAnsID[$e];	
						
						 $multiarray = array(
        'Answer' => $AnsMultiExe[$e]
);
                $this->db->set($multiarray);
                $this->db->where('AnswerID', $AnsID);
                $this->db->update('tblAnswers');
						
						
					//	$this->db->query("update tblAnswers set Answer='$AnsMultiExe[$e]' where AnswerID='$AnsID'");
					}
					$this->db->query("delete from tblQueCorrectAns where QuestionID='$MultiQueID'");

					for($CorrExe=0;$CorrExe<count($CorrAnsMultiExe);$CorrExe++)
					{
						$data=array('QuestionID'=>$MultiQueID,'AnswerID'=>$CorrAnsMultiExe[$CorrExe]);
						$this->db->insert('tblQueCorrectAns',$data);
					}
					if(empty($AnsMultiAdd))
					{	}
					else
					{
					for($am=0;$am<count($AnsMultiAdd);$am++)
					{
						$Answers=array('Answer'=>$AnsMultiAdd[$am],'Date'=>$CurrentDate);print_r($Answers);
						$this->db->insert('tblAnswers',$Answers);
						$AnswerId=$this->db->insert_id();
						$MultipleTypeQuesAssocAns=array('QuestionID'=>$MultiQueID,'AnswerID'=>$AnswerId);
						$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocAns);
					}}
					if(empty($AnsMultiAdd))
					{	}
					else
					{
					for($ca=0;$ca<count($CorrAnsMultiAdd);$ca++)
					{
					    $this->db->select('AnswerID');
                
                     $this->db->from('tblAnswers');

                     $this->db->where('Answer', $CorrAnsMultiAdd[$ca] );
                    $this->db->order_by("AnswerID", "desc");

                     $query = $this->db->get();
					    
					//	$GetAnswerId=$this->db->query("select AnswerID from tblAnswers where Answer='$CorrAnsMultiAdd[$ca]' order by AnswerID desc");
						$FetchAnsId=$query->row();
						$CorrectAnsId=$FetchAnsId->AnswerID;
						$QueCorrectAns=array('QuestionID'=>$MultiQueID,'AnswerID'=>$CorrectAnsId);
						$this->db->insert('tblQueCorrectAns',$QueCorrectAns);
					}}
           // }
				}

				//descriptive
				if($Qtypedesc=='Descriptive questions' && $MultiQueID==null && $FillQueID==null && $TFQueID==null)
				{
				
					$DescQue=$this->input->post('DescQue'.$i);
					$DescMarks=$this->input->post('DescMarks'.$i);
					$DescNegMarks=$this->input->post('DescNegMarks'.$i);
					$DescImg=$this->input->post('DescImg'.$i);
					$DesAns=$this->input->post('DesAns'.$i);
					$DescAnsID=$this->input->post('DescAnsID'.$i);
					$RefDocDesc=$this->input->post('RefDocDesc'.$i);
					$RefDocDescPageNo=$this->input->post('RefDocDescPageNo'.$i);
				
				   
						$select=$this->db->query("select ReferenceDoc from tblQuestions where QuestionID='$DescQueID'");
						$fetch=$select->row();
						$ReFDOC=$fetch->ReferenceDoc;
						
						if($RefDocDescPageNo!=null)
						{
						    if($ReFDOC!=null)
						    {
						        $this->db->query("update tblQuestions set ReferenceDoc='' where QuestionID='$DescQueID'");
						    }
						}
					
		if($RefDocDesc!=null)
		{
					 $array = array(
        'Question' => $DescQue,
        'Image' => $DescImg,
        'ReferenceDoc'=>$RefDocDesc,
        'RefDocPageNo'=>$RefDocDescPageNo,
        'Date' => $CurrentDate
);
                $this->db->set($array);
                $this->db->where('QuestionID', $DescQueID);
                $this->db->update('tblQuestions');
		}
		else
		{
		    $array = array(
        'Question' => $DescQue,
        'Image' => $DescImg,
        'RefDocPageNo'=>$RefDocDescPageNo,
        'Date' => $CurrentDate
            );
                $this->db->set($array);
                $this->db->where('QuestionID', $DescQueID);
                $this->db->update('tblQuestions');
		}

				//	$this->db->query("update tblQuestions set Question='$DescQue',Image='$DescImg',Date='$CurrentDate' where QuestionID='$DescQueID'");
					$this->db->query("update tblQuePaperAssocQues set Marks='$DescMarks',Negative_marks='$DescNegMarks' where QuePaperID='$QuePaperId' and QuestionID='$DescQueID'");
	
	           $ans = array(
        'Answer' => $DesAns
);
                $this->db->set($ans);
                $this->db->where('AnswerID', $DescAnsID);
                $this->db->update('tblAnswers');
	
				//	$this->db->query("update tblAnswers set Answer='$DesAns' where AnswerID='$DescAnsID'");
				}
				//fill in the blanks
				if($Qtypefill=='Fill in the blanks' && $MultiQueID==null && $DescQueID==null && $TFQueID==null)
				{
					$FillQue=$this->input->post('FillQue'.$i);
					$FillMarks=$this->input->post('FillMarks'.$i);
					$FillNegMarks=$this->input->post('FillNegMarks'.$i);
					$FillImg=$this->input->post('FillImg'.$i);

					$FillAnsExe=$this->input->post('FillAnsExe'.$i);
				//	print_r(count($FillAnsExe));
					$CorrAnsFillExe=$this->input->post('CorrAnsFillExe'.$i);
					$FillAnsAdd=$this->input->post('FillAnsAdd'.$i);
			//		print_r($FillAnsAdd);
					 $CorrAnsFillAdd=$this->input->post('CorrAnsFillAdd'.$i);
					//print_r($AddChkAnsFill);
					$FillAnsID=$this->input->post('FillAnsID'.$i);
				//	print_r(count($FillAnsID));
					
					$RefDocFill=$this->input->post('RefDocFill'.$i);
					$RefDocFillPageNo=$this->input->post('RefDocFillPageNo'.$i);
					
				    	$select=$this->db->query("select ReferenceDoc from tblQuestions where QuestionID='$FillQueID'");
						$fetch=$select->row();
						$ReFDOC=$fetch->ReferenceDoc;
						
						if($RefDocFillPageNo!=null)
						{
						    if($ReFDOC!=null)
						    {
						        $this->db->query("update tblQuestions set ReferenceDoc='' where QuestionID='$FillQueID'");
						    }
						}
		
		if($RefDocFill!=null)
		{
		    
		
					$arrayfque = array(
        'Question' => $FillQue,
        'Image' => $FillImg,
        'ReferenceDoc'=>$RefDocFill,
        'RefDocPageNo'=>$RefDocFillPageNo,
        'Date' => $CurrentDate
);
                $this->db->set($arrayfque);
                $this->db->where('QuestionID', $FillQueID);
                $this->db->update('tblQuestions');
        }   
        else
        {
            $arrayfque = array(
        'Question' => $FillQue,
        'Image' => $FillImg,
        'RefDocPageNo'=>$RefDocFillPageNo,
        'Date' => $CurrentDate
);
                $this->db->set($arrayfque);
                $this->db->where('QuestionID', $FillQueID);
                $this->db->update('tblQuestions');
        }
				//	$this->db->query("update tblQuestions set Question='$FillQue',Image='$FillImg',Date='$CurrentDate' where QuestionID='$FillQueID'");
					$this->db->query("update tblQuePaperAssocQues set Marks='$FillMarks',Negative_marks='$FillNegMarks' where QuePaperID='$QuePaperId' and QuestionID='$FillQueID'");

					for($fe=0;$fe<count($FillAnsExe);$fe++)
					{
					    $ansf = array(
                         'Answer' => $FillAnsExe[$fe]);
                $this->db->set($ansf);
                $this->db->where('AnswerID', $FillAnsID[$fe]);
                $this->db->update('tblAnswers');
					    
					//	$this->db->query("update tblAnswers set Answer='$FillAnsExe[$fe]' where AnswerID='$FillAnsID[$fe]'");
					}
					if($CorrAnsFillExe!=null)
					{
						$this->db->query("update tblQueCorrectAns set AnswerID='$CorrAnsFillExe' where QuestionID='$FillQueID'");
					}
					if(empty($FillAnsAdd))
					{	}
					else
					{
					for($fa=0;$fa<count($FillAnsAdd);$fa++)
					{
						$fillans=array('Answer'=>$FillAnsAdd[$fa],'Date'=>$CurrentDate);
						$this->db->insert('tblAnswers',$fillans);
						$AnswerId=$this->db->insert_id();
						$MultipleTypeQuesAssocAns=array('QuestionID'=>$FillQueID,'AnswerID'=>$AnswerId);
						$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocAns);
						
					}}
					if($CorrAnsFillAdd!=null)
					{
					       $this->db->select('AnswerID');
                
                     $this->db->from('tblAnswers');

                     $this->db->where('Answer', $CorrAnsFillAdd );
                    $this->db->order_by("AnswerID", "desc");

                     $query = $this->db->get();
					    
						//$GetAnsID=$this->db->query("select AnswerID from tblAnswers where Answer='$CorrAnsFillAdd' order by AnswerID desc");
						$FetchAnsID=$query->row();
						$AnsId=$FetchAnsID->AnswerID;

						$this->db->query("update tblQueCorrectAns set AnswerID='$AnsId' where QuestionID='$FillQueID'");
					}		
				}
				//true false
				if($Qtypetf=='True false' && $MultiQueID==null && $DescQueID==null && $FillQueID==null)
				{
					$TFQue=$this->input->post('TFQue'.$i);
					$MarksTF=$this->input->post('MarksTF'.$i);
					$NegMarksTF=$this->input->post('NegMarksTF'.$i);
					$ImgTF=$this->input->post('ImgTF'.$i);
					$CorrAnsT=$this->input->post('CorrAnsT'.$i);
					$CorrAnsF=$this->input->post('CorrAnsF'.$i);
					$RefDocTF=$this->input->post('RefDocTF'.$i);
					$RefDocTFPageNo=$this->input->post('RefDocTFPageNo'.$i);
					
					    $select=$this->db->query("select ReferenceDoc from tblQuestions where QuestionID='$TFQueID'");
						$fetch=$select->row();
					echo	$ReFDOC=$fetch->ReferenceDoc;
						
						if($RefDocTFPageNo!=null)
						{
						    if($ReFDOC!=null)
						    {
						        $this->db->query("update tblQuestions set ReferenceDoc='' where QuestionID='$TFQueID'");
						    }
						}
			
			if($RefDocTF!=null)
			{
					$array = array(
        'Question' => $TFQue,
        'Image' => $ImgTF,
        'ReferenceDoc'=>$RefDocTF,
        'RefDocPageNo'=>$RefDocTFPageNo,
        'Date' => $CurrentDate);
        
                $this->db->set($array);
                $this->db->where('QuestionID', $TFQueID);
                $this->db->update('tblQuestions');
			}
			else
			{
			    $array = array(
        'Question' => $TFQue,
        'Image' => $ImgTF,
        'RefDocPageNo'=>$RefDocTFPageNo,
        'Date' => $CurrentDate );
        
                $this->db->set($array);
                $this->db->where('QuestionID', $TFQueID);
                $this->db->update('tblQuestions');
			}
		
			//	$this->db->query("update tblQuestions set Question='$TFQue',Image='$ImgTF',Date='$CurrentDate' where QuestionID='$TFQueID'");
					$this->db->query("update tblQuePaperAssocQues set Marks='$MarksTF',Negative_marks='$NegMarksTF' where QuePaperID='$QuePaperId' and QuestionID='$TFQueID'");

					if($CorrAnsT!=null)
					{
						$this->db->query("update tblQueCorrectAns set AnswerID='$CorrAnsT' where QuestionID='$TFQueID'");
					}
					else
					{
						$this->db->query("update tblQueCorrectAns set AnswerID='$CorrAnsF' where QuestionID='$TFQueID'");
					}
				}			
			}
			
            }
			//multiple
			for($Cnt=1;$Cnt<=$NewCount;$Cnt++)
			{	
				$MultiQue=$this->input->post('MultiQue'.$Cnt);
				
				if($MultiQue!=null)
				{
				$MultiAns=$this->input->post('MultiAns'.$Cnt);
				$CorrectMultiAns=$this->input->post('CorrAnsMulti'.$Cnt);
			 	$MultiImg=$this->input->post('MultiImg'.$Cnt);
			 	$MultiMarks=$this->input->post('MultiMarks'.$Cnt);
				$MultiNegMarks=$this->input->post('MultiNegMarks'.$Cnt);
                $MultiRefDoc=$this->input->post('MultiRefDoc'.$Cnt);
                $MultiRefPageNo=$this->input->post('MultiRefPageNo'.$Cnt);
				
				$MultiQueDetails=array('Question'=>$MultiQue,'Image'=>$MultiImg,'ReferenceDoc'=>$MultiRefDoc,'RefDocPageNo'=>$MultiRefPageNo,'Date'=>$CurrentDate);
				$this->db->insert('tblQuestions',$MultiQueDetails);
				$MultiQuesId = $this->db->insert_id();
	$QuePaperAssocQues=array('TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$MultiQuesId,'Marks'=>$MultiMarks,'Negative_marks'=>$MultiNegMarks);
				$this->db->insert('tblQuePaperAssocQues',$QuePaperAssocQues);
			
			$GetQueTypeId=$this->db->query("select QueTypeID from tblQuestionType where QueType='Multiple choice questions'");
			$FetchQueTypeId=$GetQueTypeId->row();
			$QueTypeId=$FetchQueTypeId->QueTypeID;

			$QueAssocQueType=array('QuestionID'=>$MultiQuesId,'QueTypeID'=>$QueTypeId);
			$this->db->insert("tblQueAssocQueType",$QueAssocQueType);

				for($i=0;$i<count($MultiAns);$i++)
				{
					$Answers=array('Answer'=>$MultiAns[$i],'Date'=>$CurrentDate);
					$this->db->insert('tblAnswers',$Answers);
					$AnswerId=$this->db->insert_id();
					$MultipleTypeQuesAssocAns=array('QuestionID'=>$MultiQuesId,'AnswerID'=>$AnswerId);
					$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocAns);
				}
				for($i1=0;$i1<count($CorrectMultiAns);$i1++)
				{
				    $this->db->select('AnswerID');
                
                     $this->db->from('tblAnswers');

                     $this->db->where('Answer', $CorrectMultiAns[$i1] );
                    $this->db->order_by("AnswerID", "desc");

                     $query = $this->db->get();
				    
				//	$GetAnswerId=$this->db->query("select AnswerID from tblAnswers where Answer='$CorrectMultiAns[$i1]' order by AnswerID desc");
					$FetchAnsId=$query->row();
					$CorrectAnsId=$FetchAnsId->AnswerID;
					$QueCorrectAns=array('QuestionID'=>$MultiQuesId,'AnswerID'=>$CorrectAnsId);
					$this->db->insert('tblQueCorrectAns',$QueCorrectAns);
				}
			}//for multiple

			//descriptive
		  echo   $DescQue=$this->input->post('DescQue'.$Cnt);
		    if($DescQue!=null)
			{
				
				 $DescMarks=$this->input->post('DescMarks'.$Cnt);
				 $DescNegMarks=$this->input->post('DescNegMarks'.$Cnt);
				 $DescImg=$this->input->post('DescImg'.$Cnt);
				 $DescAns=$this->input->post('DescAns'.$Cnt);
				 $DescRefDoc=$this->input->post('DescRefDoc'.$Cnt);
				 $DescRefPageNo=$this->input->post('DescRefPageNo'.$Cnt);
				
				$DescQueDetails=array('Question'=>$DescQue,'Image'=>$DescImg,'ReferenceDoc'=>$DescRefDoc,'RefDocPageNo'=>$DescRefPageNo,'Date'=>$CurrentDate);
				$this->db->insert('tblQuestions',$DescQueDetails);
				$DescQueId=$this->db->insert_id();

				$QuePaperAssocQues=array('TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$DescQueId,'Marks'=>$DescMarks,'Negative_marks'=>$DescNegMarks);
				$this->db->insert('tblQuePaperAssocQues',$QuePaperAssocQues);

				$GetQueTypeId=$this->db->query("select QueTypeID from tblQuestionType where QueType='Descriptive questions'");
				$FetchQueTypeId=$GetQueTypeId->row();
				$QueTypeId=$FetchQueTypeId->QueTypeID;

				$QueAssocQueType=array('QuestionID'=>$DescQueId,'QueTypeID'=>$QueTypeId);
				$this->db->insert("tblQueAssocQueType",$QueAssocQueType);

				$AddDescAns=array('Answer'=>$DescAns,'Date'=>$CurrentDate);
				$this->db->insert('tblAnswers',$AddDescAns);
				$DescAnsId=$this->db->insert_id();

				$MultipleTypeQuesAssocAns=array('QuestionID'=>$DescQueId,'AnswerID'=>$DescAnsId);
				$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocAns);
	
				$CorrectAnsDesc=array('QuestionID'=>$DescQueId,'AnswerID'=>$DescAnsId);
				$this->db->insert('tblQueCorrectAns',$CorrectAnsDesc);

			}//for descriptive

			//fill in the blanks
			$FillQue=$this->input->post('FillQue'.$Cnt);
			if($FillQue!=null)
			{
				
				$FillMarks=$this->input->post('FillMarks'.$Cnt);
				$FillNegMarks=$this->input->post('FillNegMarks'.$Cnt);
				$FillImg=$this->input->post('FillImg'.$Cnt);
				$FillAns=$this->input->post('FillAns'.$Cnt);
				//print_r($FillAns);
				$FillAnsCorr=$this->input->post('FillAnsCorr'.$Cnt);
				$FillRefDoc=$this->input->post('FillRefDoc'.$Cnt);
				$FillRefPageNo=$this->input->post('FillRefPageNo'.$Cnt);
				
				$FillQueDetails=array('Question'=>$FillQue,'Image'=>$FillImg,'ReferenceDoc'=>$FillRefDoc,'RefDocPageNo'=>$FillRefPageNo,'Date'=>$CurrentDate);
				$this->db->insert('tblQuestions',$FillQueDetails);
				$FillQueId=$this->db->insert_id();

				$QuePaperAssocQues=array('TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$FillQueId,'Marks'=>$FillMarks,'Negative_marks'=>$FillNegMarks);
				$this->db->insert('tblQuePaperAssocQues',$QuePaperAssocQues);

				$GetQueTypeId=$this->db->query("select QueTypeID from tblQuestionType where QueType='Fill in the blanks'");
				$FetchQueTypeId=$GetQueTypeId->row();
				$QueTypeId=$FetchQueTypeId->QueTypeID;

				$tblQueAssocQueType=array('QuestionID'=>$FillQueId,'QueTypeID'=>$QueTypeId);
				$this->db->insert('tblQueAssocQueType',$tblQueAssocQueType);

				for($j=0;$j<count($FillAns);$j++)
				{
					$Answers=array('Answer'=>$FillAns[$j],'Date'=>$CurrentDate);
					$this->db->insert('tblAnswers',$Answers);
					$AnswerId=$this->db->insert_id();
					$MultipleTypeQuesAssocAns=array('QuestionID'=>$FillQueId,'AnswerID'=>$AnswerId);
					$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocAns);
				}

                 $this->db->select('AnswerID');
                
                     $this->db->from('tblAnswers');

                     $this->db->where('Answer', $FillAnsCorr );
                    $this->db->order_by("AnswerID", "desc");

                     $fillansid = $this->db->get();

			//	$AnsId=$this->db->query("select AnswerID from tblAnswers where Answer='$FillAnsCorr' order by AnswerID desc");
				$fetchAnsId=$fillansid->row();
				echo $CorrAnsId=$fetchAnsId->AnswerID;
				$QueCorrectAns=array('QuestionID'=>$FillQueId,'AnswerID'=>$CorrAnsId);
				$this->db->insert('tblQueCorrectAns',$QueCorrectAns);
			}//for fill in the blanks

			//True False
			 $TFQue=$this->input->post('TFQue'.$Cnt);
			if($TFQue!=null)
			{
				
				$TFMarks=$this->input->post('TFMarks'.$Cnt);
				$TFNegMarks=$this->input->post('TFNegMarks'.$Cnt);
			 	$TFImg=$this->input->post('TFImg'.$Cnt);
				$CorrTAns=$this->input->post('CorrTAns'.$Cnt);
				$CorrFAns=$this->input->post('CorrFAns'.$Cnt);
				$TFRefDoc=$this->input->post('TFRefDoc'.$Cnt);
				$TFRefPageNo=$this->input->post('TFRefPageNo'.$Cnt);

				$TFQueDetails=array('Question'=>$TFQue,'Image'=>$TFImg,'ReferenceDoc'=>$TFRefDoc,'Date'=>$CurrentDate);
				$this->db->insert('tblQuestions',$TFQueDetails);
				$TFQueId=$this->db->insert_id();
	
							$QuePaperAssocQues=array('TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$TFQueId,'Marks'=>$TFMarks,'Negative_marks'=>$TFNegMarks);
				$this->db->insert('tblQuePaperAssocQues',$QuePaperAssocQues);

				$GetQueTypeId=$this->db->query("select QueTypeID from tblQuestionType where QueType='True false'");
				$FetchQueTypeId=$GetQueTypeId->row();
				$QueTypeId=$FetchQueTypeId->QueTypeID;

				$QueAssocQueType=array('QuestionID'=>$TFQueId,'QueTypeID'=>$QueTypeId);
				$this->db->insert("tblQueAssocQueType",$QueAssocQueType);

				$AddTrueAns=array('Answer'=>'True','Date'=>$CurrentDate);
				$this->db->insert('tblAnswers',$AddTrueAns);
				$TrueAnsIdd=$this->db->insert_id();

				$AddFalseAns=array('Answer'=>'False','Date'=>$CurrentDate);
				$this->db->insert('tblAnswers',$AddFalseAns);
				$FalseAnsIdd=$this->db->insert_id();

				$MultipleTypeQuesAssocT=array('QuestionID'=>$TFQueId,'AnswerID'=>$TrueAnsIdd);
				$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocT);
				
				$MultipleTypeQuesAssocF=array('QuestionID'=>$TFQueId,'AnswerID'=>$FalseAnsIdd);
				$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocF);

				if($CorrTAns=='True')
				{
					$CorrectAnsTF=array('QuestionID'=>$TFQueId,'AnswerID'=>$TrueAnsIdd);
					$this->db->insert('tblQueCorrectAns',$CorrectAnsTF);
				}
				else		
				{
					$CorrectAnsTF=array('QuestionID'=>$TFQueId,'AnswerID'=>$FalseAnsIdd);
					$this->db->insert('tblQueCorrectAns',$CorrectAnsTF);
				}
			}
			}
	
		}//redirect('Questions/AdminHomePage');
		if($this->input->post('save_and_live'))
		{
			$Qtypemulti=$this->input->post('Qtypemulti');
			$Qtypedesc=$this->input->post('Qtypedesc');	
			$Qtypefill=$this->input->post('Qtypefill');
			$Qtypetf=$this->input->post('Qtypetf');	

            if($TestType=="Mock")
            {
                if($NewPaperRefDoc==null)
                {
		         	$this->db->query("update tblQuestionPaper set Title='$PaperName',TotalMarks='$PaperMarks',Date='$Date',IsLive='1',IsMockTest='1',PassingPercentage='$QPaperPercentage' where QuePaperID='$QuePaperId'");
                }
                else
                {
                    $this->db->query("update tblQuestionPaper set Title='$PaperName',TotalMarks='$PaperMarks',Date='$Date',IsLive='1',IsMockTest='1',PassingPercentage='$QPaperPercentage',ReferenceDoc='$NewPaperRefDoc' where QuePaperID='$QuePaperId'");
                }
                    
            }
            else
            {
                $this->db->query("update tblQuestionPaper set Title='$PaperName',TotalMarks='$PaperMarks',Date='$Date',IsLive='1',IsMockTest='0',PassingPercentage='$QPaperPercentage' where QuePaperID='$QuePaperId'");
            }
			$this->db->query("update tblTestDetails set TestName='$PaperName',Date='$Date',IsLive='1' where TestID='$QuePaperId'");
		
		    $GetExamCoID=$this->db->query("select * from tblQuePaperAssocExamCoordinator where QuePaperID='$QuePaperId'");
		        $FetchExamCoID=$GetExamCoID->result();
		        for($ec=0;$ec<count($FetchExamCoID);$ec++)
		        {
		            $ExamCoordinatorID=$FetchExamCoID[$ec]->ExamCoordinatorID;
		          $this->db->query("delete from tblQuePaperAssocExamCoordinator where ExamCoordinatorID='$ExamCoordinatorID'");
		        }
			
			for($e=0;$e<count($ExamCoordinators);$e++)
		    {
		       $ExamCoAssocQuePaper=array('QuePaperID'=>$QuePaperId,'ExamCoordinatorID'=>$ExamCoordinators[$e]);
		       $this->db->insert('tblQuePaperAssocExamCoordinator',$ExamCoAssocQuePaper);
	    	}
		        

			for($i=1;$i<=$count;$i++)
			{	
				
				$MultiQueID=$this->input->post('MultiQueID'.$i);
				$DescQueID=$this->input->post('DescQueID'.$i);
				$FillQueID=$this->input->post('FillQueID'.$i);
				$TFQueID=$this->input->post('TFQueID'.$i);

				
				//multiple
				if($Qtypemulti=='Multiple choice questions' && $DescQueID==null && $FillQueID==null && $TFQueID==null)
				{
					$Quemulti=$this->input->post('Quemulti'.$i);
					$MarksMulti=$this->input->post('MarksMulti'.$i);
					$NegMarksMulti=$this->input->post('NegMarksMulti'.$i);
					$ImgMulti=$this->input->post('ImgMulti'.$i);
					$AnsMultiExe=$this->input->post('AnsMulti'.$i);
					$AnsMultiAdd=$this->input->post('AnsMultiAdd'.$i);
					
					$CorrAnsMultiExe=$this->input->post('CorrAnsMultiExe'.$i);
					$CorrAnsMultiAdd=$this->input->post('CorrAnsMultiAdd'.$i);
					$MultiAnsID=$this->input->post('MultiAnsID'.$i);
					$RefDocMulti=$this->input->post('RefDocMulti'.$i);
					$RefDocMultiPageNo=$this->input->post('RefDocMultiPageNo'.$i);
					
					    $select=$this->db->query("select ReferenceDoc from tblQuestions where QuestionID='$MultiQueID'");
						$fetch=$select->row();
						$ReFDOC=$fetch->ReferenceDoc;
						
						if($RefDocMultiPageNo!=null)
						{
						    if($ReFDOC!=null)
						    {
						        $this->db->query("update tblQuestions set ReferenceDoc='' where QuestionID='$MultiQueID'");
						    }
						}
					
				if($RefDocMulti!=null)
				{
					$array = array(
        'Question' => $Quemulti,
        'Image' => $ImgMulti,
        'ReferenceDoc'=>$RefDocMulti,
        'RefDocPageNo'=>$RefDocMultiPageNo,
        'Date' => $CurrentDate
);
                $this->db->set($array);
                $this->db->where('QuestionID', $MultiQueID);
                $this->db->update('tblQuestions');

				}
				else
				{
				    $array = array(
                   'Question' => $Quemulti,
                   'Image' => $ImgMulti,
                   'RefDocPageNo'=>$RefDocMultiPageNo,
                   'Date' => $CurrentDate
);
                $this->db->set($array);
                $this->db->where('QuestionID', $MultiQueID);
                $this->db->update('tblQuestions');
				}
			//		$this->db->query("update tblQuestions set Question='$Quemulti',Image='$ImgMulti',Date='$CurrentDate' where QuestionID='$MultiQueID'");
					$this->db->query("update tblQuePaperAssocQues set Marks='$MarksMulti',Negative_marks='$NegMarksMulti' where QuePaperID='$QuePaperId' and QuestionID='$MultiQueID'");


					for($e=0;$e<count($AnsMultiExe);$e++)
					{
						$AnsID=$MultiAnsID[$e];	
						
						$multiarray = array(
                           'Answer' => $AnsMultiExe[$e]  );
                $this->db->set($multiarray);
                $this->db->where('AnswerID', $AnsID);
                $this->db->update('tblAnswers');
						

						
					//	$this->db->query("update tblAnswers set Answer='$AnsMultiExe[$e]' where AnswerID='$AnsID'");
					}
					$this->db->query("delete from tblQueCorrectAns where QuestionID='$MultiQueID'");

					for($CorrExe=0;$CorrExe<count($CorrAnsMultiExe);$CorrExe++)
					{
						$data=array('QuestionID'=>$MultiQueID,'AnswerID'=>$CorrAnsMultiExe[$CorrExe]);
						$this->db->insert('tblQueCorrectAns',$data);
					}
					if(empty($AnsMultiAdd))
					{	}
					else
					{
					for($am=0;$am<count($AnsMultiAdd);$am++)
					{
						$Answers=array('Answer'=>$AnsMultiAdd[$am],'Date'=>$CurrentDate);
						$this->db->insert('tblAnswers',$Answers);
						$AnswerId=$this->db->insert_id();
						$MultipleTypeQuesAssocAns=array('QuestionID'=>$MultiQueID,'AnswerID'=>$AnswerId);
						$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocAns);
					}}
					if(empty($AnsMultiAdd))
					{	}
					else
					{
					for($ca=0;$ca<count($CorrAnsMultiAdd);$ca++)
					{
					    $this->db->select('AnswerID');
                
                     $this->db->from('tblAnswers');

                     $this->db->where('Answer', $CorrAnsMultiAdd[$ca] );
                    $this->db->order_by("AnswerID", "desc");

                     $query = $this->db->get();
					    
					//	$GetAnswerId=$this->db->query("select AnswerID from tblAnswers where Answer='$CorrAnsMultiAdd[$ca]' order by AnswerID desc");
						$FetchAnsId=$query->row();
						$CorrectAnsId=$FetchAnsId->AnswerID;
						$QueCorrectAns=array('QuestionID'=>$MultiQueID,'AnswerID'=>$CorrectAnsId);
						$this->db->insert('tblQueCorrectAns',$QueCorrectAns);
					}}
				}

				//descriptive
				if($Qtypedesc=='Descriptive questions' && $MultiQueID==null && $FillQueID==null && $TFQueID==null)
				{
				
					$DescQue=$this->input->post('DescQue'.$i);
					$DescMarks=$this->input->post('DescMarks'.$i);
					$DescNegMarks=$this->input->post('DescNegMarks'.$i);
					$DescImg=$this->input->post('DescImg'.$i);
					$DesAns=$this->input->post('DesAns'.$i);
					$DescAnsID=$this->input->post('DescAnsID'.$i);
					$RefDocDesc=$this->input->post('RefDocDesc'.$i);
					$RefDocDescPageNo=$this->input->post('RefDocDescPageNo'.$i);
					
				    	$select=$this->db->query("select ReferenceDoc from tblQuestions where QuestionID='$DescQueID'");
						$fetch=$select->row();
						$ReFDOC=$fetch->ReferenceDoc;
						
						if($RefDocDescPageNo!=null)
						{
						    if($ReFDOC!=null)
						    {
						        $this->db->query("update tblQuestions set ReferenceDoc='' where QuestionID='$DescQueID'");
						    }
						}
					
			if($RefDocDesc!=null)
			{
						$array = array(
        'Question' => $DescQue,
        'Image' => $DescImg,
        'ReferenceDoc'=>$RefDocDesc,
        'RefDocPageNo'=>$RefDocDescPageNo,
        'Date' => $CurrentDate
);
                $this->db->set($array);
                $this->db->where('QuestionID', $DescQueID);
                $this->db->update('tblQuestions');
			}
			else
			{
			    $array = array(
        'Question' => $DescQue,
        'Image' => $DescImg,
        'RefDocPageNo'=>$RefDocDescPageNo,
        'Date' => $CurrentDate
);
                $this->db->set($array);
                $this->db->where('QuestionID', $DescQueID);
                $this->db->update('tblQuestions');
			}

				//	$this->db->query("update tblQuestions set Question='$DescQue',Image='$DescImg',Date='$CurrentDate' where QuestionID='$DescQueID'");
					$this->db->query("update tblQuePaperAssocQues set Marks='$DescMarks',Negative_marks='$DescNegMarks' where QuePaperID='$QuePaperId' and QuestionID='$DescQueID'");
	         
	            $ans = array(
                      'Answer' => $DesAns
                );
                $this->db->set($ans);
                $this->db->where('AnswerID', $DescAnsID);
                $this->db->update('tblAnswers');
	
	
				//	$this->db->query("update tblAnswers set Answer='$DesAns' where AnswerID='$DescAnsID'");
				}
				//fill in the blanks
				if($Qtypefill=='Fill in the blanks' && $MultiQueID==null && $DescQueID==null && $TFQueID==null)
				{
					$FillQue=$this->input->post('FillQue'.$i);
					$FillMarks=$this->input->post('FillMarks'.$i);
					$FillNegMarks=$this->input->post('FillNegMarks'.$i);
					$FillImg=$this->input->post('FillImg'.$i);

					$FillAnsExe=$this->input->post('FillAnsExe'.$i);
					print_r(count($FillAnsExe));
					$CorrAnsFillExe=$this->input->post('CorrAnsFillExe'.$i);
					$FillAnsAdd=$this->input->post('FillAnsAdd'.$i);
					print_r($FillAnsAdd);
					echo $CorrAnsFillAdd=$this->input->post('CorrAnsFillAdd'.$i);
					//print_r($AddChkAnsFill);
					$FillAnsID=$this->input->post('FillAnsID'.$i);
					print_r(count($FillAnsID));
					$RefDocFill=$this->input->post('RefDocFill'.$i);
					$RefDocFillPageNo=$this->input->post('RefDocFillPageNo'.$i);
					
					    $select=$this->db->query("select ReferenceDoc from tblQuestions where QuestionID='$FillQueID'");
						$fetch=$select->row();
						$ReFDOC=$fetch->ReferenceDoc;
						
						if($RefDocFillPageNo!=null)
						{
						    if($ReFDOC!=null)
						    {
						        $this->db->query("update tblQuestions set ReferenceDoc='' where QuestionID='$FillQueID'");
						    }
						}
					
			if($RefDocFill!=null)
			{
					
						$array = array(
                         'Question' => $FillQue,
                            'Image' => $FillImg,
                            'ReferenceDoc'=>$RefDocFill,
                            'RefDocPageNo'=>$RefDocFillPageNo,
                          'Date' => $CurrentDate
                        );
                $this->db->set($array);
                $this->db->where('QuestionID', $FillQueID);
                $this->db->update('tblQuestions');
			}
			else
			{
			            	$array = array(
                         'Question' => $FillQue,
                            'Image' => $FillImg,
                            'RefDocPageNo'=>$RefDocFillPageNo,
                          'Date' => $CurrentDate
                        );
                $this->db->set($array);
                $this->db->where('QuestionID', $FillQueID);
                $this->db->update('tblQuestions');
			}

			//		$this->db->query("update tblQuestions set Question='$FillQue',Image='$FillImg',Date='$CurrentDate' where QuestionID='$FillQueID'");
					$this->db->query("update tblQuePaperAssocQues set Marks='$FillMarks',Negative_marks='$FillNegMarks' where QuePaperID='$QuePaperId' and QuestionID='$FillQueID'");

					for($fe=0;$fe<count($FillAnsExe);$fe++)
					{
					    
					    $fillanss = array(    'Answer' => $FillAnsExe[$fe]);
                $this->db->set($fillanss);
                $this->db->where('AnswerID', $FillAnsID[$fe]);
                $this->db->update('tblAnswers');
				//		$this->db->query("update tblAnswers set Answer='$FillAnsExe[$fe]' where AnswerID='$FillAnsID[$fe]'");
					}
					if($CorrAnsFillExe!=null)
					{
						$this->db->query("update tblQueCorrectAns set AnswerID='$CorrAnsFillExe' where QuestionID='$FillQueID'");
					}
					if(empty($FillAnsAdd))
					{	}
					else
					{
					for($fa=0;$fa<count($FillAnsAdd);$fa++)
					{
						$fillans=array('Answer'=>$FillAnsAdd[$fa],'Date'=>$CurrentDate);
						$this->db->insert('tblAnswers',$fillans);
						$AnswerId=$this->db->insert_id();
						$MultipleTypeQuesAssocAns=array('QuestionID'=>$FillQueID,'AnswerID'=>$AnswerId);
						$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocAns);
						
					}}
					if($CorrAnsFillAdd!=null)
					{
					    $this->db->select('AnswerID');
                
                     $this->db->from('tblAnswers');

                     $this->db->where('Answer', $CorrAnsFillAdd );
                    $this->db->order_by("AnswerID", "desc");

                     $query = $this->db->get();
					    
					//	$GetAnsID=$this->db->query("select AnswerID from tblAnswers where Answer='$CorrAnsFillAdd' order by AnswerID desc");
						$FetchAnsID=$query->row();
						$AnsId=$FetchAnsID->AnswerID;

						$this->db->query("update tblQueCorrectAns set AnswerID='$AnsId' where QuestionID='$FillQueID'");
					}		
				}
				//true false
				if($Qtypetf=='True false' && $MultiQueID==null && $DescQueID==null && $FillQueID==null)
				{
					$TFQue=$this->input->post('TFQue'.$i);
					$MarksTF=$this->input->post('MarksTF'.$i);
					$NegMarksTF=$this->input->post('NegMarksTF'.$i);
					$ImgTF=$this->input->post('ImgTF'.$i);
					$CorrAnsT=$this->input->post('CorrAnsT'.$i);
					$CorrAnsF=$this->input->post('CorrAnsF'.$i);
					$RefDocTF=$this->input->post('RefDocTF'.$i);
					$RefDocTFPageNo=$this->input->post('RefDocTFPageNo'.$i);
					
				    	$select=$this->db->query("select ReferenceDoc from tblQuestions where QuestionID='$TFQueID'");
						$fetch=$select->row();
						$ReFDOC=$fetch->ReferenceDoc;
						
						if($RefDocTFPageNo!=null)
						{
						    if($ReFDOC!=null)
						    {
						        $this->db->query("update tblQuestions set ReferenceDoc='' where QuestionID='$TFQueID'");
						    }
						}
					
			if($RefDocTF!=null)
			{
					$array = array(
        'Question' => $TFQue,
        'Image' => $ImgTF,
        'ReferenceDoc'=>$RefDocTF,
        'RefDocPageNo'=>$RefDocTFPageNo,
        'Date' => $CurrentDate
);
                $this->db->set($array);
                $this->db->where('QuestionID', $TFQueID);
                $this->db->update('tblQuestions');
			}
			else
			{
			    $array = array(
               'Question' => $TFQue,
                 'Image' => $ImgTF,
                 'RefDocPageNo'=>$RefDocTFPageNo,
                     'Date' => $CurrentDate
                );
                $this->db->set($array);
                $this->db->where('QuestionID', $TFQueID);
                $this->db->update('tblQuestions');
			}
		
			//	$this->db->query("update tblQuestions set Question='$TFQue',Image='$ImgTF',Date='$CurrentDate' where QuestionID='$TFQueID'");
					$this->db->query("update tblQuePaperAssocQues set Marks='$MarksTF',Negative_marks='$NegMarksTF' where QuePaperID='$QuePaperId' and QuestionID='$TFQueID'");

					if($CorrAnsT!=null)
					{
						$this->db->query("update tblQueCorrectAns set AnswerID='$CorrAnsT' where QuestionID='$TFQueID'");
					}
					else
					{
						$this->db->query("update tblQueCorrectAns set AnswerID='$CorrAnsF' where QuestionID='$TFQueID'");
					}
				}			
			}
			

			//multiple
			for($Cnt=1;$Cnt<=$NewCount;$Cnt++)
			{	
				$MultiQue=$this->input->post('MultiQue'.$Cnt);
				if($MultiQue!=null)
				{
				$MultiAns=$this->input->post('MultiAns'.$Cnt);print_r($MultiAns);
				$CorrectMultiAns=$this->input->post('CorrAnsMulti'.$Cnt);print_r($CorrectMultiAns);
			 	$MultiImg=$this->input->post('MultiImg'.$Cnt);
			 	$MultiMarks=$this->input->post('MultiMarks'.$Cnt);
				$MultiNegMarks=$this->input->post('MultiNegMarks'.$Cnt);
                $MultiRefDoc=$this->input->post('MultiRefDoc'.$Cnt);
                $MultiRefPageNo=$this->input->post('MultiRefPageNo'.$Cnt);

				
				$MultiQueDetails=array('Question'=>$MultiQue,'Image'=>$MultiImg,'ReferenceDoc'=>$MultiRefDoc,'RefDocPageNo'=>$MultiRefPageNo,'Date'=>$CurrentDate);
				$this->db->insert('tblQuestions',$MultiQueDetails);
				$MultiQuesId = $this->db->insert_id();
	$QuePaperAssocQues=array('TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$MultiQuesId,'Marks'=>$MultiMarks,'Negative_marks'=>$MultiNegMarks);
				$this->db->insert('tblQuePaperAssocQues',$QuePaperAssocQues);
			
			$GetQueTypeId=$this->db->query("select QueTypeID from tblQuestionType where QueType='Multiple choice questions'");
			$FetchQueTypeId=$GetQueTypeId->row();
			$QueTypeId=$FetchQueTypeId->QueTypeID;

			$QueAssocQueType=array('QuestionID'=>$MultiQuesId,'QueTypeID'=>$QueTypeId);
			$this->db->insert("tblQueAssocQueType",$QueAssocQueType);

				for($i=0;$i<count($MultiAns);$i++)
				{
					$Answers=array('Answer'=>$MultiAns[$i],'Date'=>$CurrentDate);
					$this->db->insert('tblAnswers',$Answers);
					$AnswerId=$this->db->insert_id();
					$MultipleTypeQuesAssocAns=array('QuestionID'=>$MultiQuesId,'AnswerID'=>$AnswerId);
					$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocAns);
				}
				for($i1=0;$i1<count($CorrectMultiAns);$i1++)
				{
				     $this->db->select('AnswerID');
                
                     $this->db->from('tblAnswers');

                     $this->db->where('Answer', $CorrectMultiAns[$i1] );
                    $this->db->order_by("AnswerID", "desc");

                     $query = $this->db->get();
				    
				//	$GetAnswerId=$this->db->query("select AnswerID from tblAnswers where Answer='$CorrectMultiAns[$i1]' order by AnswerID desc");
					$FetchAnsId=$query->row();
					$CorrectAnsId=$FetchAnsId->AnswerID;
					$QueCorrectAns=array('QuestionID'=>$MultiQuesId,'AnswerID'=>$CorrectAnsId);
					$this->db->insert('tblQueCorrectAns',$QueCorrectAns);
				}
			}//for multiple

			//descriptive
			echo $DescQue=$this->input->post('DescQue'.$Cnt);
			if($DescQue!=null)
			{
				
				echo $DescMarks=$this->input->post('DescMarks'.$Cnt);
				echo $DescNegMarks=$this->input->post('DescNegMarks'.$Cnt);
				echo $DescImg=$this->input->post('DescImg'.$Cnt);
				echo $DescAns=$this->input->post('DescAns'.$Cnt);
				$DescRefDoc=$this->input->post('DescRefDoc'.$Cnt);
				$DescRefPageNo=$this->input->post('DescRefPageNo'.$Cnt);
				
				$DescQueDetails=array('Question'=>$DescQue,'Image'=>$DescImg,'ReferenceDoc'=>$DescRefDoc,'RefDocPageNo'=>$DescRefPageNo,'Date'=>$CurrentDate);
				$this->db->insert('tblQuestions',$DescQueDetails);
				$DescQueId=$this->db->insert_id();

				$QuePaperAssocQues=array('TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$DescQueId,'Marks'=>$DescMarks,'Negative_marks'=>$DescNegMarks);
				$this->db->insert('tblQuePaperAssocQues',$QuePaperAssocQues);

				$GetQueTypeId=$this->db->query("select QueTypeID from tblQuestionType where QueType='Descriptive questions'");
				$FetchQueTypeId=$GetQueTypeId->row();
				$QueTypeId=$FetchQueTypeId->QueTypeID;

				$QueAssocQueType=array('QuestionID'=>$DescQueId,'QueTypeID'=>$QueTypeId);
				$this->db->insert("tblQueAssocQueType",$QueAssocQueType);

				$AddDescAns=array('Answer'=>$DescAns,'Date'=>$CurrentDate);
				$this->db->insert('tblAnswers',$AddDescAns);
				$DescAnsId=$this->db->insert_id();

				$MultipleTypeQuesAssocAns=array('QuestionID'=>$DescQueId,'AnswerID'=>$DescAnsId);
				$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocAns);
	
				$CorrectAnsDesc=array('QuestionID'=>$DescQueId,'AnswerID'=>$DescAnsId);
				$this->db->insert('tblQueCorrectAns',$CorrectAnsDesc);

			}//for descriptive

			//fill in the blanks
			$FillQue=$this->input->post('FillQue'.$Cnt);
			if($FillQue!=null)
			{
				
				$FillMarks=$this->input->post('FillMarks'.$Cnt);
				$FillNegMarks=$this->input->post('FillNegMarks'.$Cnt);
				$FillImg=$this->input->post('FillImg'.$Cnt);
				$FillAns=$this->input->post('FillAns'.$Cnt);
				//print_r($FillAns);
				$FillAnsCorr=$this->input->post('FillAnsCorr'.$Cnt);
				$FillRefDoc=$this->input->post('FillRefDoc'.$Cnt);
				$FillRefPageNo=$this->input->post('FillRefPageNo'.$Cnt);
				
				$FillQueDetails=array('Question'=>$FillQue,'Image'=>$FillImg,'ReferenceDoc'=>$FillRefDoc,'RefDocPageNo'=>$FillRefPageNo,'Date'=>$CurrentDate);
				$this->db->insert('tblQuestions',$FillQueDetails);
				$FillQueId=$this->db->insert_id();

				$QuePaperAssocQues=array('TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$FillQueId,'Marks'=>$FillMarks,'Negative_marks'=>$FillNegMarks);
				$this->db->insert('tblQuePaperAssocQues',$QuePaperAssocQues);

				$GetQueTypeId=$this->db->query("select QueTypeID from tblQuestionType where QueType='Fill in the blanks'");
				$FetchQueTypeId=$GetQueTypeId->row();
				$QueTypeId=$FetchQueTypeId->QueTypeID;

				$tblQueAssocQueType=array('QuestionID'=>$FillQueId,'QueTypeID'=>$QueTypeId);
				$this->db->insert('tblQueAssocQueType',$tblQueAssocQueType);

				for($j=0;$j<count($FillAns);$j++)
				{
					$Answers=array('Answer'=>$FillAns[$j],'Date'=>$CurrentDate);
					$this->db->insert('tblAnswers',$Answers);
					$AnswerId=$this->db->insert_id();
					$MultipleTypeQuesAssocAns=array('QuestionID'=>$FillQueId,'AnswerID'=>$AnswerId);
					$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocAns);
				}

                     $this->db->select('AnswerID');
                
                     $this->db->from('tblAnswers');

                     $this->db->where('Answer', $FillAnsCorr );
                    $this->db->order_by("AnswerID", "desc");

                     $query = $this->db->get();

			//	$AnsId=$this->db->query("select AnswerID from tblAnswers where Answer='$FillAnsCorr' order by AnswerID desc");
				$fetchAnsId=$query->row();
				echo $CorrAnsId=$fetchAnsId->AnswerID;
				$QueCorrectAns=array('QuestionID'=>$FillQueId,'AnswerID'=>$CorrAnsId);
				$this->db->insert('tblQueCorrectAns',$QueCorrectAns);
			}//for fill in the blanks

			//True False
			echo $TFQue=$this->input->post('TFQue'.$Cnt);
			if($TFQue!=null)
			{
				
			echo	$TFMarks=$this->input->post('TFMarks'.$Cnt);
			echo	$TFNegMarks=$this->input->post('TFNegMarks'.$Cnt);
			echo 	$TFImg=$this->input->post('TFImg'.$Cnt);
			echo	$CorrTAns=$this->input->post('CorrTAns'.$Cnt);
			echo	$CorrFAns=$this->input->post('CorrFAns'.$Cnt);
			        $TFRefDoc=$this->input->post('TFRefDoc'.$Cnt);
			        $TFRefPageNo=$this->input->post('TFRefPageNo'.$Cnt);

				$TFQueDetails=array('Question'=>$TFQue,'Image'=>$TFImg,'ReferenceDoc'=>$TFRefDoc,'RefDocPageNo'=>$TFRefPageNo,'Date'=>$CurrentDate);
				$this->db->insert('tblQuestions',$TFQueDetails);
				$TFQueId=$this->db->insert_id();
	
							$QuePaperAssocQues=array('TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$TFQueId,'Marks'=>$TFMarks,'Negative_marks'=>$TFNegMarks);
				$this->db->insert('tblQuePaperAssocQues',$QuePaperAssocQues);

				$GetQueTypeId=$this->db->query("select QueTypeID from tblQuestionType where QueType='True false'");
				$FetchQueTypeId=$GetQueTypeId->row();
				$QueTypeId=$FetchQueTypeId->QueTypeID;

				$QueAssocQueType=array('QuestionID'=>$TFQueId,'QueTypeID'=>$QueTypeId);
				$this->db->insert("tblQueAssocQueType",$QueAssocQueType);

				$AddTrueAns=array('Answer'=>'True','Date'=>$CurrentDate);
				$this->db->insert('tblAnswers',$AddTrueAns);
				$TrueAnsIdd=$this->db->insert_id();

				$AddFalseAns=array('Answer'=>'False','Date'=>$CurrentDate);
				$this->db->insert('tblAnswers',$AddFalseAns);
				$FalseAnsIdd=$this->db->insert_id();

				$MultipleTypeQuesAssocT=array('QuestionID'=>$TFQueId,'AnswerID'=>$TrueAnsIdd);
				$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocT);
				
				$MultipleTypeQuesAssocF=array('QuestionID'=>$TFQueId,'AnswerID'=>$FalseAnsIdd);
				$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocF);

				if($CorrTAns=='True')
				{
					$CorrectAnsTF=array('QuestionID'=>$TFQueId,'AnswerID'=>$TrueAnsIdd);
					$this->db->insert('tblQueCorrectAns',$CorrectAnsTF);
				}
				else		
				{
					$CorrectAnsTF=array('QuestionID'=>$TFQueId,'AnswerID'=>$FalseAnsIdd);
					$this->db->insert('tblQueCorrectAns',$CorrectAnsTF);
				}
			}
			}
		}

		redirect('Questions/AdminHomePage');
	}
	function QuestionPapers()
	{
	    $this->AdminSession();
	    
		$qp_id=$this->session->userdata('qp_id_session');
	 	$userid=$this->input->post('userid');

		$f_a['Questions']=array();	
		$f_a['Answers']=array();
		$f_a['AdminCorrectAns']=array();

		$f_a['UserQuestions']=array();
		$f_a['UserAnswers']=array();
		
		if($this->input->post('open'))
		{
			//admin
			$que_paper=$this->db->query("SELECT DISTINCT ut.QueAttemptID,uq.UserID,ur.EmailID, qp.QuePaperID,q.QuestionID,q.Question,q.Image,q.ReferenceDoc,q.RefDocPageNo,qt.QueTypeID,qt.QueType,qp.Title,qp.TotalMarks,qp.Timer,q.Date,qpa.Marks,qpa.Negative_marks 
FROM tblQuePaperAssocQues qpa
Inner JOIN tblQuestionPaper qp ON qp.QuePaperID=qpa.QuePaperID 
INNER JOIN tblQuestions q ON qpa.QuestionID =q.QuestionID 
Inner JOIN tblQueAssocQueType qa ON q.QuestionID = qa.QuestionID
INNER JOIN tblQuestionType qt ON qa.QueTypeID = qt.QueTypeID
LEFT JOIN tblUserAttemptQuestion ut ON qpa.QuestionID=ut.QuestionID AND ut.UserID = '$userid' 
INNER JOIN tblUserRegistration ur ON ur.UserID ='$userid'
LEFT JOIN tblUserAttemptQuePaperDetails uq ON uq.QuePaperID = qp.QuePaperID AND uq.UserID = ur.UserID
Where qpa.QuePaperID = '$qp_id'
ORDER BY case when ut.QueAttemptID is null then 1 else 0 end, ut.QueAttemptID");
			$fetch=$que_paper->result();
						
			$f_a['Questions']=$fetch;		
			
				$GetAdminAns=$this->db->query("SELECT DISTINCT q.QuestionID,a.AnswerID,q.Question,a.Answer FROM tblQuestions q JOIN tblQuestionPaper p JOIN tblQuePaperAssocQues qp JOIN tblQueAssocQueType qa JOIN tblAnswers a JOIN tblMultipleTypeQuesAssocAns mt ON qp.QuestionID=q.QuestionID AND q.QuestionID=mt.QuestionID AND a.AnswerID=mt.AnswerID WHERE p.QuePaperID='$qp_id' ORDER BY a.AnswerID");
				$FetchAdminAns=$GetAdminAns->result();
				$f_a['Answers']=$FetchAdminAns;

				$AdminCorrectAns=$this->db->query("SELECT DISTINCT q.QuestionID,a.AnswerID,ca.AnswerID,q.Question,a.Answer FROM tblQuestions q JOIN tblQuestionPaper p JOIN tblQuePaperAssocQues qp JOIN tblQueAssocQueType qa JOIN tblAnswers a JOIN tblMultipleTypeQuesAssocAns mt JOIN tblQueCorrectAns ca ON ca.AnswerID=a.AnswerID AND qp.QuestionID=q.QuestionID AND q.QuestionID=mt.QuestionID AND a.AnswerID=mt.AnswerID WHERE p.QuePaperID='$qp_id'"); 
				$FetchCorrectAns=$AdminCorrectAns->result();
			//	print_r($fetch);
				$f_a['AdminCorrectAns']=$FetchCorrectAns;

			//user
		

			$GetUserAns=$this->db->query("select utq.QueAttemptID, utq.QuePaperID, utq.QuestionID, a.AnswerID, a.Answer, da.DescAnsID, da.DescAns, utq.UserID, uta.IsDescriptive, utq.SubmissionDate from tblUserAttemptQuestion utq JOIN tblUserAttemptAns uta ON utq.QueAttemptID=uta.UserAttemptQueID LEFT JOIN tblAnswers a ON a.AnswerID = uta.AnswerID AND uta.IsDescriptive = 0 LEFT JOIN tblDescriptiveAns da ON da.DescAnsID = uta.AnswerID AND uta.IsDescriptive = 1 WHERE utq.UserID='$userid' and utq.QuePaperID = '$qp_id' ");
				$FetchUserAns=$GetUserAns->result();
				$f_a['UserAnswers']=array_merge($f_a['UserAnswers'],$FetchUserAns);
			//	print_r($FetchUserAns);
			
		}	
			$this->load->view('show_question_paper.php',$f_a);
	}
	function UserMarks()
	{
		echo $marks=$_POST['marks'];
		$id=$_POST['id'];
		$buttonid=$_POST['buttonid'];

		if($buttonid=="correct")
		{
			$this->db->query("update tblUserAttemptQuestion set UserMarks='$marks' where QueAttemptID='$id'");
		}
		else if($buttonid=="incorrect")
		{
			$this->db->query("update tblUserAttemptQuestion set UserMarks='0' where QueAttemptID='$id'");
		}
		else if($buttonid=="partial")
		{
			$this->db->query("update tblUserAttemptQuestion set UserMarks='$marks' where QueAttemptID='$id'");
		}
	} 
	function CreateQuestionPaper($show='')
	{
	    
	    $this->AdminSession();
		$qp['QuestionType']=array();
		$qp['ExamCoordinator']=array();
		
		$quePaperDetails=$this->db->query("select * from tblQuestionType");
		$fetch_quePaperDetails=$quePaperDetails->result();
		//print_r(count($fetch_quePaperDetails));
		$qp['QuestionType']=$fetch_quePaperDetails;
		
		$AdminID=$this->session->userdata('admin_id_session');
		
		$ExamCoDetails=$this->db->query("select * from tblExamCoordinator where AdminID='$AdminID'");
		$FetchExamCoDetails=$ExamCoDetails->result();
		$qp['ExamCoordinator']=$FetchExamCoDetails;
		
		
		$this->load->view('questions_view.php',$qp);
	}
	
	function ValidateQuePaperName()
	{
	   $PaperName=$this->input->post('PaperName');
	   $GetPaperName=$this->db->query("select * from tblQuestionPaper where Title='$PaperName'");
	   $count=$GetPaperName->num_rows();
        echo $count;
	}
	function CreatedQuestionPaper()
	{
	    $this->AdminSession();
	    $count=$this->input->post('hdn1');
	    $cnt=explode(',',$count);
	  // print_r($cnt);
	   
	    
	    $quepaper_id=$this->input->post('quepaper_id');
		$quepaper_name=ucfirst($this->input->post('paper_name'));
	    $date=date("Y-m-d",strtotime($this->input->post('date')));
		$final_marks=$this->input->post('final_marks');
		$paper_marks=$this->input->post('paper_marks');
		$TestType=$this->input->post('test');
		$QPaperPercentage=$this->input->post('QPaperPercentage');
		$ExamCoordinators=$this->input->post('ExamCoordinators');
		$multicheckbox=$this->input->post('multicheckbox');
		print_r($multicheckbox);
		
		$RefDoc=null;
		
	                	$config['allowed_types']="*";
						$config['upload_path']="./assets/uploads";
	
						$this->load->library('upload',$config);

						if($this->upload->do_upload('RefDoc'))
						{
							 $ResRef=$this->upload->data();
							 $RefDoc=$ResRef['file_name'];
						}
						else
						{
							 $this->upload->display_errors();
						}
						
	                //echo $RefDoc;
		$paper_details=array('que_paper_name'=>$quepaper_name,'date'=>$date,'total_marks'=>$paper_marks,'TestType'=>$TestType,'RefDoc'=>$RefDoc,'PassingPercentage'=>$QPaperPercentage,'ExamCoordinators'=>$ExamCoordinators);
		$show['que_paper']=$paper_details;	
		
		$show['Data']=array();
		
		if(empty($cnt) || $count==null)
	        {   }
	        else
	        {
		
		for($i=0;$i<count($cnt);$i++)
		{
		    //multiple
		        $file_multi=null;	
		        $MultiRefDoc=null;
		        $MultiRefPageNo=null;
		        $QueTypeMulti='Multiple Choice Question';
		        $que_multi=ucfirst($this->input->post('question_multi'.$cnt[$i]));
				$txtAnsMulti=array();
				$ChkAnsMulti=array();
				$MultiRefPageNo=$this->input->post('MultiRefPageNo'.$cnt[$i]);
			//	echo $this->input->post('MultiRefDoc'.$cnt[$i]);
				
			     $ans1=$this->input->post('txtAnsMulti'.$cnt[$i]);
			     print_r($ans1);
			
				foreach($_POST as $key => $value) {
   					 if (strpos($key, 'txtAnsMulti'.$cnt[$i].'-') === 0)
					 {
					    // print_r($key);
						array_push($txtAnsMulti,$this->input->post($key));
   					 }
					if(strpos($key, 'ChkAnsMulti'.$cnt[$i].'-') === 0)
					{
						array_push($ChkAnsMulti,$this->input->post($key));
					}
				}
				//print_r($txtAnsMulti);
				$marks_multi=$this->input->post('marks_multi'.$cnt[$i]);
				$neg_marks_multi=$this->input->post('negative_marks_multi'.$cnt[$i]);

					//	$config['allowed_types']="jpg|png|jpeg";
					//	$config['upload_path']="./assets/uploads";
	
				//		$this->load->library('upload',$config);

						if($this->upload->do_upload('PicMulti'.$cnt[$i]))
						{
							 $res_multi=$this->upload->data();
							 $file_multi=$res_multi['file_name'];
						}
						else
						{
							 $this->upload->display_errors();
						}
						
				//		$config['allowed_types']="*";
				//		$config['upload_path']="./assets/uploads";
	
			//			$this->load->library('upload',$config);

						if($this->upload->do_upload('MultiRefDoc'.$cnt[$i]))
						{
							 $ResMultiRefDoc=$this->upload->data();
							 $MultiRefDoc=$ResMultiRefDoc['file_name'];
						}
						else
						{
							 $this->upload->display_errors();
						}
						
					//	echo $MultiRefDoc;
					//	echo $MultiRefPageNo;
					    
			//descriptive
						
		    	$file_desc=null;
		    	$DescRefDoc=null;
				$QueTypeDesc='Descriptive Questions';
                $DescRefPageNo=null;

				$que_desc=ucfirst($this->input->post('question_desc'.$cnt[$i]));	
				$marks_desc=$this->input->post('marks_desc'.$cnt[$i]);
				$neg_marks_desc=$this->input->post('negative_marks_desc'.$cnt[$i]);
				$ans_desc=ucfirst($this->input->post('ans_desc'.$cnt[$i]));	
				$DescRefPageNo=$this->input->post('DescRefPageNo'.$cnt[$i]);

						$config['allowed_types']="jpg|png|jpeg";
						$config['upload_path']="./assets/uploads";

						$this->load->library('upload',$config);
				
						if($this->upload->do_upload('PicDesc'.$cnt[$i]))
						{
							$res_desc=$this->upload->data();
							$file_desc=$res_desc['file_name'];
						}
						else
						{
							$this->upload->display_errors();	
						}
						
						$config['allowed_types']="*";
						$config['upload_path']="./assets/uploads";

						$this->load->library('upload',$config);
				
						if($this->upload->do_upload('DescRefDoc'.$cnt[$i]))
						{
							$ResDescRefDoc=$this->upload->data();
							$DescRefDoc=$ResDescRefDoc['file_name'];
						}
						else
						{
							$this->upload->display_errors();	
						}
					//	echo $DescRefDoc;
						
			//fill in the blanks
			
		    	$file_fill=null;
				$QueTypeFill='Fill in the blanks';
								
				$FillRefDoc=null;
				$FillRefPageNo=null;
								
				$que_fill=ucfirst($this->input->post('que1_fill'.$cnt[$i])).' _____ '.$this->input->post('que2_fill'.$cnt[$i]);
				$marks_fill=$this->input->post('marks_fill'.$cnt[$i]);
				$neg_marks_fill=$this->input->post('negative_marks_fill'.$cnt[$i]);
				$FillRefPageNo=$this->input->post('FillRefPageNo'.$cnt[$i]);
				
				$txtAnsFill=array();
				$ChkAnsFill=array();
				//print_r($_POST);
				
				foreach($_POST as $key => $value) {
   					 if (strpos($key, 'txtAnsFill'.$cnt[$i].'-') === 0)
					 {
						array_push($txtAnsFill,$this->input->post($key));
						//print_r($txtAnsMulti);
   					 }
					
			        	 if(strpos($key,'ChkAnsFill'.$cnt[$i].'-') === 0)
				 	 {
						array_push($ChkAnsFill,$this->input->post($key));
						//print_r($ChkAnsFill);	
					 }
				}
				if($que_fill==" _____ ")
				{
					$que_fill=null;
				}
						$config['allowed_types']="png|jpg|jpeg";
						$config['upload_path']="./assets/uploads";

						$this->load->library('upload',$config);
						
						if($this->upload->do_upload('PicFill'.$cnt[$i]))
						{
							$res_fill=$this->upload->data();
							$file_fill=$res_fill['file_name'];
						}
						else
						{
							$this->upload->display_errors();
						}
						
						$config['allowed_types']="*";
						$config['upload_path']="./assets/uploads";

						$this->load->library('upload',$config);
						
						if($this->upload->do_upload('FillRefDoc'.$cnt[$i]))
						{
							$ResFillRefDoc=$this->upload->data();
							$FillRefDoc=$ResFillRefDoc['file_name'];
						}
						else
						{
							$this->upload->display_errors();
						}
						
						echo $FillRefDoc;
		//true false
		
	        	$file_tf=null;						
				$QueTypeTF='True False';
				
		        $TFRefDoc=null;
		        $TFRefPageNo=null;

				$que_tf=ucfirst($this->input->post('question_true_false'.$cnt[$i]));
				$ans1_chkk='True';
				$ans2_chkk='False';
				$ans1_tf=$this->input->post('true_false'.$cnt[$i]);
				$ans2_tf=$this->input->post('true_false'.$cnt[$i]);
				$marks_tf=$this->input->post('marks_tf'.$cnt[$i]);
				$neg_marks_tf=$this->input->post('negative_marks_tf'.$cnt[$i]);
				$TFRefPageNo=$this->input->post('TFRefPageNo'.$cnt[$i]);
			
						$config['allowed_types']="jpg|png|jpeg";
						$config['upload_path']="./assets/uploads";
			
						$this->load->library('upload',$config);

						if($this->upload->do_upload('PicTF'.$cnt[$i]))		
						{
							$res_tf=$this->upload->data();
							$file_tf=$res_tf['file_name'];
						}
						else
						{
							$this->upload->display_errors();			
						}
						
						$config['allowed_types']="*";
						$config['upload_path']="./assets/uploads";
			
						$this->load->library('upload',$config);

						if($this->upload->do_upload('TFRefDoc'.$cnt[$i]))		
						{
							$ResTFRefDoc=$this->upload->data();
							$TFRefDoc=$ResTFRefDoc['file_name'];
						}
						else
						{
							$this->upload->display_errors();			
						}
			       // echo $TFRefDoc;
			
		$data=array('QueTypeMulti'=>$QueTypeMulti,'que_multi'=>$que_multi,'marks_multi'=>$marks_multi,'neg_marks_multi'=>$neg_marks_multi,'file_multi'=>$file_multi,'MultiRefDoc'=>$MultiRefDoc,'MultiRefPageNo'=>$MultiRefPageNo,'txtAnsMulti'=>$txtAnsMulti,'ChkAnsMulti'=>$ChkAnsMulti,'QueTypeDesc'=>$QueTypeDesc,'que_desc'=>$que_desc,'marks_desc'=>$marks_desc,'neg_marks_desc'=>$neg_marks_desc,'file_desc'=>$file_desc,'DescRefDoc'=>$DescRefDoc,'DescRefPageNo'=>$DescRefPageNo,'ans_desc'=>$ans_desc,'QueTypeFill'=>$QueTypeFill,'que_fill'=>$que_fill,'marks_fill'=>$marks_fill,'neg_marks_fill'=>$neg_marks_fill,'file_fill'=>$file_fill,'FillRefDoc'=>$FillRefDoc,'FillRefPageNo'=>$FillRefPageNo,'txtAnsFill'=>$txtAnsFill,'ChkAnsFill'=>$ChkAnsFill,'QueTypeTF'=>$QueTypeTF,'que_tf'=>$que_tf,'marks_tf'=>$marks_tf,'neg_marks_tf'=>$neg_marks_tf,'file_tf'=>$file_tf,'TFRefDoc'=>$TFRefDoc,'TFRefPageNo'=>$TFRefPageNo,'ans1_chkk'=>$ans1_chkk,'ans2_chkk'=>$ans2_chkk,'ans1_tf'=>$ans1_tf,'ans2_tf'=>$ans2_tf);				
	    array_push($show['Data'],$data);
		}}$this->load->view('admin_paper.php',$show);
	   
	}
	function SaveQuestionPaperData()
	{
	
	     $AdminId=$this->session->userdata('admin_id_session');
		if($this->input->post('save'))
		{
			$QuePaperName=$this->input->post('QuePaperName');
			$QuePaperDate=$this->input->post('QuePaperDate');
			$QPTotalMarks=$this->input->post('QPTotalMarks');
			$TestType=$this->input->post('TestType');
	        $RefDoc=$this->input->post('RefDoc');
	        $PassingPercentage=$this->input->post('PassingPercentage');
	        $ExamCoordinators=explode(",",$this->input->post('ExamCoordinators'));
	      
	        
			$Date=date('Y-m-d');
		
			
			if($TestType=="Mock")
			{
			$QuePaperDetails=array('Title'=>$QuePaperName,'TotalMarks'=>$QPTotalMarks,'Date'=>$QuePaperDate,'UserID'=>$AdminId,'IsDelete'=>'0','IsLive'=>'0','IsMockTest'=>'1','ReferenceDoc'=>$RefDoc,'PassingPercentage'=>$PassingPercentage);			
	     	$this->db->insert('tblQuestionPaper',$QuePaperDetails);
		    $QuePaperId = $this->db->insert_id();
			}
			else
			{
			    $QuePaperDetails=array('Title'=>$QuePaperName,'TotalMarks'=>$QPTotalMarks,'Date'=>$QuePaperDate,'UserID'=>$AdminId,'IsDelete'=>'0','IsLive'=>'0','IsMockTest'=>'0','ReferenceDoc'=>'','PassingPercentage'=>$PassingPercentage);			
	     	$this->db->insert('tblQuestionPaper',$QuePaperDetails);
		    $QuePaperId = $this->db->insert_id();
			}

		$this->db->insert('tblTestDetails',array('TestName'=>$QuePaperName,'Date'=>$QuePaperDate,'IsDelete'=>'0','IsLive'=>'0'));
		$TestId = $this->db->insert_id();
		
		//exam coordinators
		
		for($e=0;$e<count($ExamCoordinators);$e++)
		{
		    $ExamCoAssocQuePaper=array('QuePaperID'=>$QuePaperId,'ExamCoordinatorID'=>$ExamCoordinators[$e]);
		    $this->db->insert('tblQuePaperAssocExamCoordinator',$ExamCoAssocQuePaper);
		}
		
		//counts
		$Count=$this->input->post('count');

			//multiple
		for($Cnt=1;$Cnt<=$Count;$Cnt++)
			{	
			    $MultiQue=$this->input->post('MultiQue'.$Cnt);
			    if($MultiQue!=null)
			    {
			    
				
				$MultiAns=$this->input->post('MultiAns'.$Cnt);
				$CorrectMultiAns=$this->input->post('CorrectMultiAns'.$Cnt);
				$MultiImg=$this->input->post('MultiImg'.$Cnt);
				$MultiMarks=$this->input->post('MultiMarks'.$Cnt);
				$MultiNegMarks=$this->input->post('MultiNegMarks'.$Cnt);
				$MultiRefDoc=$this->input->post('MultiRefDoc'.$Cnt);
			    $MultiRefPageNo=$this->input->post('MultiRefPageNo'.$Cnt);
				
				$MultiQueDetails=array('Question'=>$MultiQue,'Image'=>$MultiImg,'ReferenceDoc'=>$MultiRefDoc,'RefDocPageNo'=>$MultiRefPageNo,'Date'=>$Date);
				$this->db->insert('tblQuestions',$MultiQueDetails);
				$MultiQuesId = $this->db->insert_id();
	$QuePaperAssocQues=array('TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$MultiQuesId,'Marks'=>$MultiMarks,'Negative_marks'=>$MultiNegMarks);
				$this->db->insert('tblQuePaperAssocQues',$QuePaperAssocQues);
			
			$GetQueTypeId=$this->db->query("select QueTypeID from tblQuestionType where QueType='Multiple choice questions'");
			$FetchQueTypeId=$GetQueTypeId->row();
			$QueTypeId=$FetchQueTypeId->QueTypeID;

			$QueAssocQueType=array('QuestionID'=>$MultiQuesId,'QueTypeID'=>$QueTypeId);
			$this->db->insert("tblQueAssocQueType",$QueAssocQueType);

				for($i=0;$i<count($MultiAns);$i++)
				{
					$Answers=array('Answer'=>$MultiAns[$i],'Date'=>$Date);
					$this->db->insert('tblAnswers',$Answers);
					$AnswerId=$this->db->insert_id();
					$MultipleTypeQuesAssocAns=array('QuestionID'=>$MultiQuesId,'AnswerID'=>$AnswerId);
					$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocAns);
				}
					print_r($CorrectMultiAns);
				
				for($i1=0;$i1<count($CorrectMultiAns);$i1++)
				{
				    $this->db->select('AnswerID');
                
                     $this->db->from('tblAnswers');

                     $this->db->where('Answer', $CorrectMultiAns[$i1] );
                       $this->db->order_by("AnswerID", "desc");
                    
               //     $this->db->query('ALTER TABLE tblAnswers CONVERT TO CHARACTER SET utf8');

                     $query = $this->db->get();
				    
			//		$GetAnswerId=$this->db->query("select AnswerID from tblAnswers where Answer='$CorrectMultiAns[$i1]' order by AnswerID desc");
					$FetchAnsId=$query->row();
					print_r($FetchAnsId);
				echo	$CorrectAnsId=$FetchAnsId->AnswerID;
					$QueCorrectAns=array('QuestionID'=>$MultiQuesId,'AnswerID'=>$CorrectAnsId);
					$this->db->insert('tblQueCorrectAns',$QueCorrectAns);
				}
		    	}//for multiple
			
		
				$DescQue=$this->input->post('DescQue'.$Cnt);
				
				if($DescQue!=null)
				{
				$DescMarks=$this->input->post('DescMarks'.$Cnt);
				$DescNegMarks=$this->input->post('DescNegMarks'.$Cnt);
				$DescImg=$this->input->post('DescImg'.$Cnt);
				$DescAns=$this->input->post('DescAns'.$Cnt);
				$DescRefDoc=$this->input->post('DescRefDoc'.$Cnt);
				$DescRefPageNo=$this->input->post('DescRefPageNo'.$Cnt);
				
				$DescQueDetails=array('Question'=>$DescQue,'Image'=>$DescImg,'ReferenceDoc'=>$DescRefDoc,'RefDocPageNo'=>$DescRefPageNo,'Date'=>$Date);
				$this->db->insert('tblQuestions',$DescQueDetails);
				$DescQueId=$this->db->insert_id();

				$QuePaperAssocQues=array('TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$DescQueId,'Marks'=>$DescMarks,'Negative_marks'=>$DescNegMarks);
				$this->db->insert('tblQuePaperAssocQues',$QuePaperAssocQues);

				$GetQueTypeId=$this->db->query("select QueTypeID from tblQuestionType where QueType='Descriptive questions'");
				$FetchQueTypeId=$GetQueTypeId->row();
				$QueTypeId=$FetchQueTypeId->QueTypeID;

				$QueAssocQueType=array('QuestionID'=>$DescQueId,'QueTypeID'=>$QueTypeId);
				$this->db->insert("tblQueAssocQueType",$QueAssocQueType);

				$AddDescAns=array('Answer'=>$DescAns,'Date'=>$Date);
				$this->db->insert('tblAnswers',$AddDescAns);
			echo	$DescAnsId=$this->db->insert_id();

				$MultipleTypeQuesAssocAns=array('QuestionID'=>$DescQueId,'AnswerID'=>$DescAnsId);
				$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocAns);
	
	        
				$CorrectAnsDesc=array('QuestionID'=>$DescQueId,'AnswerID'=>$DescAnsId);
				$this->db->insert('tblQueCorrectAns',$CorrectAnsDesc);
		
				}
				
				$FillQue=$this->input->post('FillQue'.$Cnt);
				
		        if($FillQue!=null)
				 {
				 $FillMarks=$this->input->post('FillMarks'.$Cnt);
				 $FillNegMarks=$this->input->post('FillNegMarks'.$Cnt);
				 $FillImg=$this->input->post('FillImg'.$Cnt);
				 $FillAns=$this->input->post('FillAns'.$Cnt);
			     $FillRefDoc=$this->input->post('FillRefDoc'.$Cnt);
			     $FillRefPageNo=$this->input->post('FillRefPageNo'.$Cnt);
			
				echo $FillAnsCorr=$this->input->post('FillAnsCorr'.$Cnt);
				
				$FillQueDetails=array('Question'=>$FillQue,'Image'=>$FillImg,'ReferenceDoc'=>$FillRefDoc,'RefDocPageNo'=>$FillRefPageNo,'Date'=>$Date);
				$this->db->insert('tblQuestions',$FillQueDetails);
				$FillQueId=$this->db->insert_id();

				$QuePaperAssocQues=array('TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$FillQueId,'Marks'=>$FillMarks,'Negative_marks'=>$FillNegMarks);
				$this->db->insert('tblQuePaperAssocQues',$QuePaperAssocQues);

				$GetQueTypeId=$this->db->query("select QueTypeID from tblQuestionType where QueType='Fill in the blanks'");
				$FetchQueTypeId=$GetQueTypeId->row();
				$QueTypeId=$FetchQueTypeId->QueTypeID;

				$tblQueAssocQueType=array('QuestionID'=>$FillQueId,'QueTypeID'=>$QueTypeId);
				$this->db->insert('tblQueAssocQueType',$tblQueAssocQueType);

				for($j=0;$j<count($FillAns);$j++)
				{
					$Answers=array('Answer'=>$FillAns[$j],'Date'=>$Date);
					$this->db->insert('tblAnswers',$Answers);
					$AnswerId=$this->db->insert_id();
					$MultipleTypeQuesAssocAns=array('QuestionID'=>$FillQueId,'AnswerID'=>$AnswerId);
					$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocAns);
				}
				
				  $this->db->select('AnswerID');
                
                     $this->db->from('tblAnswers');

                     $this->db->where('Answer', $FillAnsCorr );
                    $this->db->order_by("AnswerID", "desc");
                    
                     $query = $this->db->get();
				
			//	$AnsId=$this->db->query("select AnswerID from tblAnswers where Answer='$FillAnsCorr' order by AnswerID desc");
				$fetchAnsId=$query->row();
				 echo $CorrAnsId=$fetchAnsId->AnswerID;
				$QueCorrectAns=array('QuestionID'=>$FillQueId,'AnswerID'=>$CorrAnsId);
				$this->db->insert('tblQueCorrectAns',$QueCorrectAns);
			}
	
			//True False
				$TFQue=$this->input->post('TFQue'.$Cnt);
			
			if($TFQue!=null)
			{
			
				$TFMarks=$this->input->post('TFMarks'.$Cnt);
				$TFNegMarks=$this->input->post('TFNegMarks'.$Cnt);
				$TFImg=$this->input->post('TFImg'.$Cnt);
				$CorrTAns=$this->input->post('CorrTAns'.$Cnt);
				$CorrFAns=$this->input->post('CorrFAns'.$Cnt);
				$TFRefDoc=$this->input->post('TFRefDoc'.$Cnt);
				$TFRefPageNo=$this->input->post('TFRefPageNo'.$Cnt);

				$TFQueDetails=array('Question'=>$TFQue,'Image'=>$TFImg,'ReferenceDoc'=>$TFRefDoc,'RefDocPageNo'=>$TFRefPageNo,'Date'=>$Date);
				$this->db->insert('tblQuestions',$TFQueDetails);
				$TFQueId=$this->db->insert_id();
	
							$QuePaperAssocQues=array('TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$TFQueId,'Marks'=>$TFMarks,'Negative_marks'=>$TFNegMarks);
				$this->db->insert('tblQuePaperAssocQues',$QuePaperAssocQues);

				$GetQueTypeId=$this->db->query("select QueTypeID from tblQuestionType where QueType='True false'");
				$FetchQueTypeId=$GetQueTypeId->row();
				$QueTypeId=$FetchQueTypeId->QueTypeID;

				$QueAssocQueType=array('QuestionID'=>$TFQueId,'QueTypeID'=>$QueTypeId);
				$this->db->insert("tblQueAssocQueType",$QueAssocQueType);

				$AddTrueAns=array('Answer'=>'True','Date'=>$Date);
				$this->db->insert('tblAnswers',$AddTrueAns);
				$TrueAnsIdd=$this->db->insert_id();

				$AddFalseAns=array('Answer'=>'False','Date'=>$Date);
				$this->db->insert('tblAnswers',$AddFalseAns);
				$FalseAnsIdd=$this->db->insert_id();

				$MultipleTypeQuesAssocT=array('QuestionID'=>$TFQueId,'AnswerID'=>$TrueAnsIdd);
				$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocT);
				
				$MultipleTypeQuesAssocF=array('QuestionID'=>$TFQueId,'AnswerID'=>$FalseAnsIdd);
				$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocF);

			

				if($CorrTAns=='True')
				{
					$CorrectAnsTF=array('QuestionID'=>$TFQueId,'AnswerID'=>$TrueAnsIdd);
					$this->db->insert('tblQueCorrectAns',$CorrectAnsTF);
				}
				else		
				{
					$CorrectAnsTF=array('QuestionID'=>$TFQueId,'AnswerID'=>$FalseAnsIdd);
					$this->db->insert('tblQueCorrectAns',$CorrectAnsTF);
				}
			}
			}
						
	
		}
		if($this->input->post('save_and_live'))
		{
			echo "hello";
			$QuePaperName=$this->input->post('QuePaperName');
			$QuePaperDate=$this->input->post('QuePaperDate');
			$QPTotalMarks=$this->input->post('QPTotalMarks');
			$TestType=$this->input->post('TestType');
			$RefDoc=$this->input->post('RefDoc');
			$PassingPercentage=$this->input->post('PassingPercentage');
			$ExamCoordinators=explode(",",$this->input->post('ExamCoordinators'));
			
			$AdminId=$this->session->userdata('admin_id_session');
			$Date=date('Y-m-d');
			
			if($TestType=="Mock")
			{
			$QuePaperDetails=array('Title'=>$QuePaperName,'TotalMarks'=>$QPTotalMarks,'Date'=>$QuePaperDate,'UserID'=>$AdminId,'IsDelete'=>'0','IsLive'=>'1','IsMockTest'=>'1','ReferenceDoc'=>$RefDoc,'PassingPercentage'=>$PassingPercentage);			
	     	$this->db->insert('tblQuestionPaper',$QuePaperDetails);
		    $QuePaperId = $this->db->insert_id();
			}
			else
			{
			    $QuePaperDetails=array('Title'=>$QuePaperName,'TotalMarks'=>$QPTotalMarks,'Date'=>$QuePaperDate,'UserID'=>$AdminId,'IsDelete'=>'0','IsLive'=>'1','IsMockTest'=>'0','ReferenceDoc'=>'','PassingPercentage'=>$PassingPercentage);			
	     	$this->db->insert('tblQuestionPaper',$QuePaperDetails);
		    $QuePaperId = $this->db->insert_id();
			}

		$this->db->insert('tblTestDetails',array('TestName'=>$QuePaperName,'Date'=>$QuePaperDate,'IsDelete'=>'0','IsLive'=>'1'));
		$TestId = $this->db->insert_id();
		
		//exam coordinators
		
		for($e=0;$e<count($ExamCoordinators);$e++)
		{
		    $ExamCoAssocQuePaper=array('QuePaperID'=>$QuePaperId,'ExamCoordinatorID'=>$ExamCoordinators[$e]);
		    $this->db->insert('tblQuePaperAssocExamCoordinator',$ExamCoAssocQuePaper);
		}
		
		$Count=$this->input->post('count');
	

			//multiple
			for($Cnt=1;$Cnt<=$Count;$Cnt++)
			{	
				$MultiQue=$this->input->post('MultiQue'.$Cnt);
				if($MultiQue!=null)
				{
				$MultiAns=$this->input->post('MultiAns'.$Cnt);
				$CorrectMultiAns=$this->input->post('CorrectMultiAns'.$Cnt);
				$MultiImg=$this->input->post('MultiImg'.$Cnt);
				$MultiMarks=$this->input->post('MultiMarks'.$Cnt);
				$MultiNegMarks=$this->input->post('MultiNegMarks'.$Cnt);
				$MultiRefDoc=$this->input->post('MultiRefDoc'.$Cnt);
				$MultiRefPageNo=$this->input->post('MultiRefPageNo'.$Cnt);
				
				$MultiQueDetails=array('Question'=>$MultiQue,'Image'=>$MultiImg,'ReferenceDoc'=>$MultiRefDoc,'RefDocPageNo'=>$MultiRefPageNo,'Date'=>$Date);
				$this->db->insert('tblQuestions',$MultiQueDetails);
				$MultiQuesId = $this->db->insert_id();
	$QuePaperAssocQues=array('TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$MultiQuesId,'Marks'=>$MultiMarks,'Negative_marks'=>$MultiNegMarks);
				$this->db->insert('tblQuePaperAssocQues',$QuePaperAssocQues);
			
			$GetQueTypeId=$this->db->query("select QueTypeID from tblQuestionType where QueType='Multiple choice questions'");
			$FetchQueTypeId=$GetQueTypeId->row();
			$QueTypeId=$FetchQueTypeId->QueTypeID;

			$QueAssocQueType=array('QuestionID'=>$MultiQuesId,'QueTypeID'=>$QueTypeId);
			$this->db->insert("tblQueAssocQueType",$QueAssocQueType);

				for($i=0;$i<count($MultiAns);$i++)
				{
					$Answers=array('Answer'=>$MultiAns[$i],'Date'=>$Date);
					$this->db->insert('tblAnswers',$Answers);
					$AnswerId=$this->db->insert_id();
					$MultipleTypeQuesAssocAns=array('QuestionID'=>$MultiQuesId,'AnswerID'=>$AnswerId);
					$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocAns);
				}
				for($i1=0;$i1<count($CorrectMultiAns);$i1++)
				{
				    $this->db->select('AnswerID');
                
                     $this->db->from('tblAnswers');

                     $this->db->where('Answer', $CorrectMultiAns[$i1] );
                    $this->db->order_by("AnswerID", "desc");
                    
                     $query = $this->db->get();
				    
				//	$GetAnswerId=$this->db->query("select AnswerID from tblAnswers where Answer='$CorrectMultiAns[$i1]' order by AnswerID desc");
					$FetchAnsId=$query->row();
					$CorrectAnsId=$FetchAnsId->AnswerID;
					$QueCorrectAns=array('QuestionID'=>$MultiQuesId,'AnswerID'=>$CorrectAnsId);
					$this->db->insert('tblQueCorrectAns',$QueCorrectAns);
				}
		    	}//for multiple
			
			//descriptive
			$DescQue=$this->input->post('DescQue'.$Cnt);
			if($DescQue!=null)
			{
				
				$DescMarks=$this->input->post('DescMarks'.$Cnt);
				$DescNegMarks=$this->input->post('DescNegMarks'.$Cnt);
				$DescImg=$this->input->post('DescImg'.$Cnt);
				$DescAns=$this->input->post('DescAns'.$Cnt);
				$DescRefDoc=$this->input->post('DescRefDoc'.$Cnt);
				$DescRefPageNo=$this->input->post('DescRefPageNo'.$Cnt);
				
				$DescQueDetails=array('Question'=>$DescQue,'Image'=>$DescImg,'ReferenceDoc'=>$DescRefDoc,'RefDocPageNo'=>$DescRefPageNo,'Date'=>$Date);
				$this->db->insert('tblQuestions',$DescQueDetails);
				$DescQueId=$this->db->insert_id();

				$QuePaperAssocQues=array('TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$DescQueId,'Marks'=>$DescMarks,'Negative_marks'=>$DescNegMarks);
				$this->db->insert('tblQuePaperAssocQues',$QuePaperAssocQues);

				$GetQueTypeId=$this->db->query("select QueTypeID from tblQuestionType where QueType='Descriptive questions'");
				$FetchQueTypeId=$GetQueTypeId->row();
				$QueTypeId=$FetchQueTypeId->QueTypeID;

				$QueAssocQueType=array('QuestionID'=>$DescQueId,'QueTypeID'=>$QueTypeId);
				$this->db->insert("tblQueAssocQueType",$QueAssocQueType);

				$AddDescAns=array('Answer'=>$DescAns,'Date'=>$Date);
				$this->db->insert('tblAnswers',$AddDescAns);
				$DescAnsId=$this->db->insert_id();

				$MultipleTypeQuesAssocAns=array('QuestionID'=>$DescQueId,'AnswerID'=>$DescAnsId);
				$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocAns);
				
			  /*  $this->db->select('AnswerID');
                
                     $this->db->from('tblAnswers');

                     $this->db->where('Answer', $DescAns );
                    $this->db->order_by("AnswerID", "desc");
                    
                     $query = $this->db->get();*/
		
			//	$GetAnswerId=$this->db->query("select AnswerID from tblAnswers where Answer='$DescAns' order by AnswerID desc");
			//	$FetchAnsId=$query->row();
			//	$CorrectAnsId=$FetchAnsId->AnswerID;
				$CorrectAnsDesc=array('QuestionID'=>$DescQueId,'AnswerID'=>$DescAnsId);
				$this->db->insert('tblQueCorrectAns',$CorrectAnsDesc);
			}//for descriptive
			
			//Fill in the blanks
			echo $FillQue=$this->input->post('FillQue'.$Cnt);
			if($FillQue!=null)
			{
				
				echo $FillMarks=$this->input->post('FillMarks'.$Cnt);
				echo $FillNegMarks=$this->input->post('FillNegMarks'.$Cnt);
				echo $FillImg=$this->input->post('FillImg'.$Cnt);
				$FillAns=$this->input->post('FillAns'.$Cnt);
				print_r($FillAns);
				echo $FillAnsCorr=$this->input->post('FillAnsCorr'.$Cnt);
				$FillRefDoc=$this->input->post('FillRefDoc'.$Cnt);
				$FillRefPageNo=$this->input->post('FillRefPageNo'.$Cnt);
				
				$FillQueDetails=array('Question'=>$FillQue,'Image'=>$FillImg,'ReferenceDoc'=>$FillRefDoc,'RefDocPageNo'=>$FillRefPageNo,'Date'=>$Date);
				$this->db->insert('tblQuestions',$FillQueDetails);
				$FillQueId=$this->db->insert_id();

				$QuePaperAssocQues=array('TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$FillQueId,'Marks'=>$FillMarks,'Negative_marks'=>$FillNegMarks);
				$this->db->insert('tblQuePaperAssocQues',$QuePaperAssocQues);

				$GetQueTypeId=$this->db->query("select QueTypeID from tblQuestionType where QueType='Fill in the blanks'");
				$FetchQueTypeId=$GetQueTypeId->row();
				$QueTypeId=$FetchQueTypeId->QueTypeID;

				$tblQueAssocQueType=array('QuestionID'=>$FillQueId,'QueTypeID'=>$QueTypeId);
				$this->db->insert('tblQueAssocQueType',$tblQueAssocQueType);

				for($j=0;$j<count($FillAns);$j++)
				{
					$Answers=array('Answer'=>$FillAns[$j],'Date'=>$Date);
					$this->db->insert('tblAnswers',$Answers);
					$AnswerId=$this->db->insert_id();
					$MultipleTypeQuesAssocAns=array('QuestionID'=>$FillQueId,'AnswerID'=>$AnswerId);
					$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocAns);
				}

                    $this->db->select('AnswerID');
                
                     $this->db->from('tblAnswers');

                     $this->db->where('Answer', $FillAnsCorr );
                    $this->db->order_by("AnswerID", "desc");
                    
                     $query = $this->db->get();

			//	$AnsId=$this->db->query("select AnswerID from tblAnswers where Answer='$FillAnsCorr' order by AnswerID desc");
				$fetchAnsId=$query->row();
				echo $CorrAnsId=$fetchAnsId->AnswerID;
				$QueCorrectAns=array('QuestionID'=>$FillQueId,'AnswerID'=>$CorrAnsId);
				$this->db->insert('tblQueCorrectAns',$QueCorrectAns);
			}
	
			//True False
			$TFQue=$this->input->post('TFQue'.$Cnt);
		    if($TFQue!=null)
			{
				
				$TFMarks=$this->input->post('TFMarks'.$Cnt);
				$TFNegMarks=$this->input->post('TFNegMarks'.$Cnt);
				$TFImg=$this->input->post('TFImg'.$Cnt);
				$CorrTAns=$this->input->post('CorrTAns'.$Cnt);
				$CorrFAns=$this->input->post('CorrFAns'.$Cnt);
				$TFRefDoc=$this->input->post('TFRefDoc'.$Cnt);
				$TFRefPageNo=$this->input->post('TFRefPageNo'.$Cnt);

				$TFQueDetails=array('Question'=>$TFQue,'Image'=>$TFImg,'ReferenceDoc'=>$TFRefDoc,'RefDocPageNo'=>$TFRefPageNo,'Date'=>$Date);
				$this->db->insert('tblQuestions',$TFQueDetails);
				$TFQueId=$this->db->insert_id();
	
							$QuePaperAssocQues=array('TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$TFQueId,'Marks'=>$TFMarks,'Negative_marks'=>$TFNegMarks);
				$this->db->insert('tblQuePaperAssocQues',$QuePaperAssocQues);

				$GetQueTypeId=$this->db->query("select QueTypeID from tblQuestionType where QueType='True false'");
				$FetchQueTypeId=$GetQueTypeId->row();
				$QueTypeId=$FetchQueTypeId->QueTypeID;

				$QueAssocQueType=array('QuestionID'=>$TFQueId,'QueTypeID'=>$QueTypeId);
				$this->db->insert("tblQueAssocQueType",$QueAssocQueType);

				$AddTrueAns=array('Answer'=>'True','Date'=>$Date);
				$this->db->insert('tblAnswers',$AddTrueAns);
				$TrueAnsIdd=$this->db->insert_id();

				$AddFalseAns=array('Answer'=>'False','Date'=>$Date);
				$this->db->insert('tblAnswers',$AddFalseAns);
				$FalseAnsIdd=$this->db->insert_id();

				$MultipleTypeQuesAssocT=array('QuestionID'=>$TFQueId,'AnswerID'=>$TrueAnsIdd);
				$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocT);
				
				$MultipleTypeQuesAssocF=array('QuestionID'=>$TFQueId,'AnswerID'=>$FalseAnsIdd);
				$this->db->insert('tblMultipleTypeQuesAssocAns',$MultipleTypeQuesAssocF);

				/*if($CorrTAns!=null)
				{	
					$GetTrueAns=$this->db->query("SELECT * FROM `tblAnswers` WHERE Answer='$CorrTAns' ORDER BY AnswerID DESC ");
					$FetchTrueAns=$GetTrueAns->row();
					print_r($FetchTrueAns);
				}
				if($CorrFAns!=null)
				{
					$GetTrueAns=$this->db->query("SELECT * FROM `tblAnswers` WHERE Answer='$CorrFAns' ORDER BY AnswerID DESC ");
					$FetchTrueAns=$GetTrueAns->row();
					print_r($FetchTrueAns);
				}*/
				//$CorrTrueAnsId=$FetchTrueAns->AnswerID;
				//$CorrTrueAns=$FetchTrueAns->Answer;

			/*	$GetFalseAns=$this->db->query("select * from tblAnswers where Answer='$FalseAns'");
				$FetchFalseAnsId=$GetFalseAns->row();
				$CorrFalseAnsId=$FetchFalseAnsId->AnswerID;*/
			//	$CorrFalseAns=$FetchFalseAnsId->Answer;

				if($CorrTAns=='True')
				{
					$CorrectAnsTF=array('QuestionID'=>$TFQueId,'AnswerID'=>$TrueAnsIdd);
					$this->db->insert('tblQueCorrectAns',$CorrectAnsTF);
				}
				else		
				{
					$CorrectAnsTF=array('QuestionID'=>$TFQueId,'AnswerID'=>$FalseAnsIdd);
					$this->db->insert('tblQueCorrectAns',$CorrectAnsTF);
				}
			}
			}
			
		}redirect('Questions/AdminHomePage');
	}
	function ShowQuestionPaper()
	{		
	    $this->UserSession();
	    
		$q['date']=array();
		$q['UserQuePaperDetails']=array();

        $AdminID=$this->session->userdata('AdminID');

		$select_qp=$this->db->query("select * from tblQuestionPaper where UserID='$AdminID' order by Date desc");
		
		$fetch_qp=$select_qp->result();	
		$q['question_papers']=$fetch_qp;

		$userid=$this->session->userdata('session_userid');
		
			$select_user_qp=$this->db->query("SELECT DISTINCT u.SubmissionDate,q.Title,q.Date,u.UserID,u.QuePaperID FROM tblUserAttemptQuestion u JOIN tblQuestionPaper q ON u.QuePaperID=q.QuePaperID where u.UserID='$userid'");
			$fetch_user_qp=$select_user_qp->result();
			array_push($q['date'],$fetch_user_qp);
			
			$GetUserPaperDetails=$this->db->query("select * from tblUserAttemptQuePaperDetails where UserID=$userid");
			$FetchUserPaperDetails=$GetUserPaperDetails->result();
			$q['UserQuePaperDetails']=$FetchUserPaperDetails;
				
		$this->load->view('show_data.php',$q);
	}
	
	function UserQuePaperDetails()
	{
	    $QuePaperID=$this->input->post('QuePaperID');
	    $userid=$this->session->userdata('session_userid');
	    date_default_timezone_set('Asia/Kolkata');
	    $time =  Date('Y-m-d H:i:s');
	    
	    $count1=null;
	    
	     $GetUserPaperDetails=$this->db->query("select * from tblUserAttemptQuePaperDetails where UserID='$userid' and QuePaperID='$QuePaperID'");
	     $count=$GetUserPaperDetails->num_rows();
	    if($count==0)
	    {
	       $Details=array('UserID'=>$userid,'QuePaperID'=>$QuePaperID,'QuePaperAttemptDate'=>$time);
	       $this->db->insert('tblUserAttemptQuePaperDetails',$Details);
	       
	       $GetUserPaperDetails=$this->db->query("select * from tblUserAttemptQuePaperDetails where UserID='$userid' and QuePaperID='$QuePaperID'");
	       $count1=$GetUserPaperDetails->num_rows();
	    }
	    echo $count;
	}
	
	function SubmitUsersTotalMarks()
	{
	     $UserID=$this->input->post('UserID');
	     $QuePaperID=$this->input->post('QuePaperID');
	     
	     $GetUserMarks=$this->db->query("SELECT DISTINCT ut.QueAttemptID,qp.QuePaperID,q.QuestionID,q.Question,q.Image,q.ReferenceDoc,q.RefDocPageNo,qt.QueTypeID,qt.QueType,qp.Title,qp.TotalMarks,qp.Timer,q.Date,qpa.Marks,qpa.Negative_marks, IFNULL(ut.UserMarks, Null) as UserMarks FROM tblQuePaperAssocQues qpa
Inner JOIN tblQuestionPaper qp  ON qp.QuePaperID=qpa.QuePaperID
INNER JOIN tblQuestions q ON qpa.QuestionID =q.QuestionID 
Inner JOIN tblQueAssocQueType qa ON q.QuestionID = qa.QuestionID
INNER JOIN tblQuestionType qt ON  qa.QueTypeID = qt.QueTypeID 
LEFT JOIN tblUserAttemptQuestion ut ON qpa.QuestionID=ut.QuestionID AND ut.UserID = '$UserID'
Where qpa.QuePaperID = '$QuePaperID' ORDER BY case when ut.QueAttemptID is null then 1 else 0 end, ut.QueAttemptID");
	     
	 $FetchUserMarks=$GetUserMarks->result();
	//   print_r($FetchUserMarks);
	
	 $selectTotal=$this->db->query("select TotalMarks from tblQuestionPaper where QuePaperID='$QuePaperID'");
	   $fetchTotal=$selectTotal->row();
	    $TotalMarks=$fetchTotal->TotalMarks;
	  
	   $UserTotal=0;
	    $AdminTotal=0;   
	    
	    for($a=0;$a<count($FetchUserMarks);$a++)
		{
		    $UserMarks=$FetchUserMarks[$a]->UserMarks;
		    $AdminMarks=$FetchUserMarks[$a]->Marks;
		    $NegativeMarks=$FetchUserMarks[$a]->Negative_marks;
		    
		    $QueAttemptID=$FetchUserMarks[$a]->QueAttemptID;
		    
            if($UserMarks==null)
		    {
		        $this->db->query("update tblUserAttemptQuePaperDetails set UserTotalMarks='0',Percentage='0' where UserID='$UserID' and QuePaperID='$QuePaperID'");
		    }
		   // else
		   // {
		    if($AdminMarks==$UserMarks)
			{
		        $UserMarks;
			}
			else if($UserMarks=='0' || $UserMarks==null)
			{
			    $UserMarks-=$NegativeMarks;
			}
			else if($UserMarks>=1 && $UserMarks<$AdminMarks)
			{
			    $UserMarks;
			}
	            
		  //  }
		        	$AdminTotal+=$AdminMarks;
	        	$UserTotal+=$UserMarks; 
		}
         $UserTotal;
         $AdminTotal;
        
       $Percent= $UserTotal/$TotalMarks*100;
     $FinalPercentage=sprintf("%.2f",$Percent);
       
	 $this->db->query("update tblUserAttemptQuePaperDetails set UserTotalMarks='$UserTotal',Percentage='$FinalPercentage' where UserID='$UserID' and QuePaperID='$QuePaperID'");
	     
	}
	
	function QuestionPaper()
	{
	    $this->UserSession();
	        $qp_id=$this->input->post('que_paper_id');
		$this->session->set_userdata('qp_id',$qp_id);
		$userid=$this->session->userdata('session_userid');
		 $btnid=$this->input->post('btnid');
		 
	    $GetUserPaperDetails=$this->db->query("select * from tblUserAttemptQuePaperDetails where UserID='$userid' and QuePaperID='$qp_id'");
		$count=$GetUserPaperDetails->num_rows();
			
		$GetUserDetails=$this->db->query("select * from tblUserAttemptQuestion where UserID='$userid' and QuePaperID='$qp_id'");
		$FetchUserMarks=$GetUserDetails->result();
		 $Markscount=$GetUserDetails->num_rows();
		 $Marks=0;
		 
		 for($um=0;$um<count($FetchUserMarks);$um++)
		{	
			$Marks=$FetchUserMarks[$um]->UserMarks;
		}
		 
		 echo json_encode(array("count" => $count, "Marks" => $Marks,'Markscount'=>$Markscount,'QuePaperid'=>$qp_id));
		
		
	}
    function Test($qp_id)
    {
        $this->UserSession();
        
                    	$config['allowed_types']="*";
						$config['upload_path']="./assets/uploads";
	
						$this->load->library('upload',$config);

						if($this->upload->do_upload('video-filename'))
						{
							 $ResRef=$this->upload->data();
						echo	 $RefDoc=$ResRef['file_name'];
						}
						else
						{
							 $this->upload->display_errors();
						}
        
        
       /* $filePath = 'uploads/' . $_POST['video-filename'];

// path to ~/tmp directory
$tempName = $_FILES['video-blob']['tmp_name'];

// move file from ~/tmp to "uploads" directory
if (!move_uploaded_file($tempName, $filePath)) {
    // failure report
    echo 'Problem saving file: '.$tempName;
    die();
}

// success report
echo 'success';*/
        
        
        $f_a['Questions']=array();	
		$f_a['Answers']=array();
        
        $qp_id;
		$this->session->set_userdata('qp_id',$qp_id);
		$userid=$this->session->userdata('session_userid');
		
		$a=$this->db->query("select ReferenceDoc from tblQuestionPaper where QuePaperID='$qp_id'");
		$b=$a->result();
		$f_a['PaperRefDoc']=$b;
		
		
			$que_paper=$this->db->query("SELECT DISTINCT qp.QuePaperID,q.QuestionID,q.Question,q.Image,q.ReferenceDoc,q.RefDocPageNo,qt.QueTypeID,qt.QueType,qp.Title,qp.TotalMarks,qp.Timer,q.Date,qpa.Marks,qpa.Negative_marks FROM tblQuestionPaper qp Inner JOIN tblQuePaperAssocQues qpa Inner JOIN tblQueAssocQueType qa inner JOIN tblQuestions q inner JOIN tblQuestionType qt ON qp.QuePaperID=qpa.QuePaperID AND qpa.QuestionID = q.QuestionID AND qa.QuestionID=q.QuestionID AND qa.QueTypeID = qt.QueTypeID Where qpa.QuePaperID = '$qp_id' ORDER BY RAND() ");
			$fetch=$que_paper->result();
			$f_a['Questions']=$fetch;		
			//print_r($fetch);
			
				$GetAnsId=$this->db->query("SELECT DISTINCT q.QuestionID,a.AnswerID,q.Question,a.Answer FROM tblQuestions q JOIN tblQuestionPaper p JOIN tblQuePaperAssocQues qp JOIN tblQueAssocQueType qa JOIN tblAnswers a JOIN tblMultipleTypeQuesAssocAns mt ON qp.QuestionID=q.QuestionID AND q.QuestionID=mt.QuestionID AND a.AnswerID=mt.AnswerID WHERE p.QuePaperID='$qp_id' ORDER BY a.AnswerID");
				$FetchAnsId=$GetAnsId->result();
				$f_a['Answers']=array_merge($f_a['Answers'],$FetchAnsId);
				$this->load->view('question_paper.php',$f_a);
			
		
    }
    function UserResult($qp_id)
    {
         $this->UserSession();
        
		$userid=$this->session->userdata('session_userid');
		$f_a['UserAnswers']=array();
		$f_a['Questions']=array();
		$f_a['AdminAnswers']=array();
		$f_a['PaperRefDoc']=array();
		
		$a=$this->db->query("select ReferenceDoc from tblQuestionPaper where QuePaperID='$qp_id'");
		$b=$a->result();
		$f_a['PaperRefDoc']=$b;
		
		        $que_paper=$this->db->query("SELECT DISTINCT ut.QueAttemptID,qp.QuePaperID,q.QuestionID,q.Question,q.Image,q.ReferenceDoc,q.RefDocPageNo,qt.QueTypeID,qt.QueType,qp.Title,qp.TotalMarks,qp.Timer,q.Date,qpa.Marks,qpa.Negative_marks, IFNULL(ut.UserMarks, Null) as UserMarks FROM tblQuePaperAssocQues qpa
Inner JOIN tblQuestionPaper qp  ON qp.QuePaperID=qpa.QuePaperID
INNER JOIN tblQuestions q ON qpa.QuestionID =q.QuestionID 
Inner JOIN tblQueAssocQueType qa ON q.QuestionID = qa.QuestionID
INNER JOIN tblQuestionType qt ON  qa.QueTypeID = qt.QueTypeID 
LEFT JOIN tblUserAttemptQuestion ut ON qpa.QuestionID=ut.QuestionID AND ut.UserID = '$userid'
Where qpa.QuePaperID = '$qp_id' ORDER BY case when ut.QueAttemptID is null then 1 else 0 end, ut.QueAttemptID");
		    	$fetch=$que_paper->result();
		    	$f_a['Questions']=$fetch;
		
		  //      $que_paper_user=$this->db->query("SELECT DISTINCT ut.QueAttemptID,ut.UserMarks,qp.QuePaperID,q.QuestionID,q.Question,q.Image,q.ReferenceDoc,q.RefDocPageNo,qt.QueTypeID,qt.QueType,qp.Title,qp.TotalMarks,q.Date,qpa.Marks,qpa.Negative_marks FROM tblQuestionPaper qp Inner JOIN tblQuePaperAssocQues qpa Inner JOIN tblQueAssocQueType qa inner JOIN tblQuestions q inner JOIN tblQuestionType qt inner JOIN tblUserAttemptQuestion ut ON qp.QuePaperID=qpa.QuePaperID AND qpa.QuestionID = q.QuestionID AND qa.QuestionID=q.QuestionID AND q.QuestionID=ut.QuestionID AND qa.QueTypeID = qt.QueTypeID Where qpa.QuePaperID = '$qp_id' and ut.UserID='$userid'");

		//		$FetchQuesions=$que_paper_user->result();
		//		$f_a['UserQuestions']=$FetchQuesions;
				//print_r($FetchQuesions);

			
			$GetAdminAns=$this->db->query("SELECT DISTINCT q.QuestionID,a.AnswerID,q.Question,a.Answer FROM tblQuestions q JOIN tblQuestionPaper p JOIN tblQuePaperAssocQues qp JOIN tblQueAssocQueType qa JOIN tblAnswers a JOIN tblMultipleTypeQuesAssocAns mt ON qp.QuestionID=q.QuestionID AND q.QuestionID=mt.QuestionID AND a.AnswerID=mt.AnswerID WHERE p.QuePaperID='$qp_id' ORDER BY a.AnswerID");
				$FetchAdminAns=$GetAdminAns->result();
				$f_a['AdminAnswers']=array_merge($f_a['AdminAnswers'],$FetchAdminAns);


			$GetUserAns=$this->db->query("select utq.QueAttemptID, utq.QuePaperID, utq.QuestionID, a.AnswerID, a.Answer, da.DescAnsID, da.DescAns, utq.UserID, uta.IsDescriptive, utq.SubmissionDate from tblUserAttemptQuestion utq JOIN tblUserAttemptAns uta ON utq.QueAttemptID=uta.UserAttemptQueID LEFT JOIN tblAnswers a ON a.AnswerID = uta.AnswerID AND uta.IsDescriptive = 0 LEFT JOIN tblDescriptiveAns da ON da.DescAnsID = uta.AnswerID AND uta.IsDescriptive = 1 WHERE utq.QuePaperID = '$qp_id' and utq.UserID='$userid' ");
				$FetchUserAns=$GetUserAns->result();
				$f_a['UserAnswers']=array_merge($f_a['UserAnswers'],$FetchUserAns);
				$this->load->view('user_result.php',$f_a);
		
		
    }
	function SavePDF()
	{
		$qp_id=$this->session->userdata('qp_id');
		$userid=$this->session->userdata('session_userid');
		$this->session->set_userdata("data","true");
		

		$f_a['Questions']=array();
		$f_a['UserAnswers']=array();
		$f_a['AdminAnswers']=array();
		
		$f_a['PaperRefDoc']=array();
		
		$a=$this->db->query("select ReferenceDoc from tblQuestionPaper where QuePaperID='$qp_id'");
		$b=$a->result();
		$f_a['PaperRefDoc']=$b;
		
		if($this->input->post('pdf'))
		{
			$que_paper=$this->db->query("SELECT DISTINCT ut.QueAttemptID,qp.QuePaperID,q.QuestionID,q.Question,q.Image,q.ReferenceDoc,q.RefDocPageNo,qt.QueTypeID,qt.QueType,qp.Title,qp.TotalMarks,qp.Timer,q.Date,qpa.Marks,qpa.Negative_marks, IFNULL(ut.UserMarks, Null) as UserMarks FROM tblQuePaperAssocQues qpa
Inner JOIN tblQuestionPaper qp  ON qp.QuePaperID=qpa.QuePaperID
INNER JOIN tblQuestions q ON qpa.QuestionID =q.QuestionID 
Inner JOIN tblQueAssocQueType qa ON q.QuestionID = qa.QuestionID
INNER JOIN tblQuestionType qt ON  qa.QueTypeID = qt.QueTypeID 
LEFT JOIN tblUserAttemptQuestion ut ON qpa.QuestionID=ut.QuestionID AND ut.UserID = '$userid'
Where qpa.QuePaperID = '$qp_id' ORDER BY case when ut.QueAttemptID is null then 1 else 0 end, ut.QueAttemptID");
		    	$fetch=$que_paper->result();
		    	$f_a['Questions']=$fetch;
		
		  //      $que_paper_user=$this->db->query("SELECT DISTINCT ut.QueAttemptID,ut.UserMarks,qp.QuePaperID,q.QuestionID,q.Question,q.Image,q.ReferenceDoc,q.RefDocPageNo,qt.QueTypeID,qt.QueType,qp.Title,qp.TotalMarks,q.Date,qpa.Marks,qpa.Negative_marks FROM tblQuestionPaper qp Inner JOIN tblQuePaperAssocQues qpa Inner JOIN tblQueAssocQueType qa inner JOIN tblQuestions q inner JOIN tblQuestionType qt inner JOIN tblUserAttemptQuestion ut ON qp.QuePaperID=qpa.QuePaperID AND qpa.QuestionID = q.QuestionID AND qa.QuestionID=q.QuestionID AND q.QuestionID=ut.QuestionID AND qa.QueTypeID = qt.QueTypeID Where qpa.QuePaperID = '$qp_id' and ut.UserID='$userid'");

		//		$FetchQuesions=$que_paper_user->result();
		//		$f_a['UserQuestions']=$FetchQuesions;
				//print_r($FetchQuesions);

			
			$GetAdminAns=$this->db->query("SELECT DISTINCT q.QuestionID,a.AnswerID,q.Question,a.Answer FROM tblQuestions q JOIN tblQuestionPaper p JOIN tblQuePaperAssocQues qp JOIN tblQueAssocQueType qa JOIN tblAnswers a JOIN tblMultipleTypeQuesAssocAns mt ON qp.QuestionID=q.QuestionID AND q.QuestionID=mt.QuestionID AND a.AnswerID=mt.AnswerID WHERE p.QuePaperID='$qp_id' ORDER BY a.AnswerID");
				$FetchAdminAns=$GetAdminAns->result();
				$f_a['AdminAnswers']=array_merge($f_a['AdminAnswers'],$FetchAdminAns);


			$GetUserAns=$this->db->query("select utq.QueAttemptID, utq.QuePaperID, utq.QuestionID, a.AnswerID, a.Answer, da.DescAnsID, da.DescAns, utq.UserID, uta.IsDescriptive, utq.SubmissionDate from tblUserAttemptQuestion utq JOIN tblUserAttemptAns uta ON utq.QueAttemptID=uta.UserAttemptQueID LEFT JOIN tblAnswers a ON a.AnswerID = uta.AnswerID AND uta.IsDescriptive = 0 LEFT JOIN tblDescriptiveAns da ON da.DescAnsID = uta.AnswerID AND uta.IsDescriptive = 1 WHERE utq.QuePaperID = '$qp_id' and utq.UserID='$userid' ");
				$FetchUserAns=$GetUserAns->result();
				$f_a['UserAnswers']=array_merge($f_a['UserAnswers'],$FetchUserAns);
		}
				
				require_once APPPATH.'/third_party/vendor/autoload.php';
					$pdf=new \Mpdf\Mpdf(['margin_left' => -2,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 0,'margin_header' => 0,'margin_footer' => 0]);
					$html=$this->load->view('user_result.php',$f_a,true);
					$this->session->set_userdata("data","false");
					$pdfFilePath ="webpreparations-".time().".pdf";	
					$pdf->SetTitle('QUESTION & ANSWER');
					$pdf->WriteHTML($html,2);
					$pdf->Output('Result.pdf','D');
					exit;			
					
			
	}
	function Screenshots()
	{
	   
	 $imagedata = base64_decode($this->input->post('imgdata'));
	 
	 $QuePaperName=$this->input->post('QuePaperName');
	   $QuePaperDate=$this->input->post('QuePaperDate');
	 $pagecount=$this->input->post('pagecount');
	   
	 
       // $filename = md5(uniqid(rand(), true));
       
       $filename=$this->session->userdata('user_session').' - '.$QuePaperName.' - '.$QuePaperDate.' - '.$pagecount;
       
        //path where you want to upload image
        $file = $_SERVER['DOCUMENT_ROOT'] . '/assets/uploads/'.$filename.'.png';
      
      
        $imageurl  = 'http://www.test.acquiscent.com/assets/uploads/'.$filename.'.png';
        file_put_contents($file,$imagedata);
        echo $imageurl;
        
        
        
	}
	
	function BlankImg()
	{
	   $imagedata = base64_decode($this->input->post('imgdata'));
	   $blankpagecount=$this->input->post('blankpagecount');
	   $QuePaperName=$this->input->post('QuePaperName');
	   $QuePaperDate=$this->input->post('QuePaperDate');
	   
        $filename = $this->session->userdata('user_session').' - '.$QuePaperName.' - '.$QuePaperDate.' - blank'.$blankpagecount;
        //path where you want to upload image
        $file = $_SERVER['DOCUMENT_ROOT'] . '/assets/uploads/'.$filename.'.png';
      
      
        $imageurl  = 'http://www.test.acquiscent.com/assets/uploads/'.$filename.'.png';
        file_put_contents($file,$imagedata);
        echo $imageurl;
	    
	}
	
	function UserQuestionPaper()
	{	
    		$count=$this->input->post('count');
			$userid=$this->session->userdata('session_userid');
			$QuePaperName=$this->input->post('QuePaperName');
			
			$GetQuePaperID=$this->db->query("select QuePaperID from tblQuestionPaper where Title='$QuePaperName'");
			$FetchQuePaperID=$GetQuePaperID->row();
			$QuePaperId=$FetchQuePaperID->QuePaperID;	

			$GetTestId=$this->db->query("select TestID from tblTestDetails where TestName='$QuePaperName'");
			$FetchTestId=$GetTestId->row();
			$TestId=$FetchTestId->TestID;
			
			date_default_timezone_set('Asia/Kolkata');
	        $time =  Date('Y-m-d H:i:s');
	        
	        
	        $this->db->query("update tblUserAttemptQuePaperDetails set QuePaperSubmissionDate='$time' where UserID='$userid' and QuePaperID='$QuePaperId'");

			$Date=date('Y-m-d');
			
			$QueType1=$this->input->post('MCQ_QueType');
			$QueType2=$this->input->post('Desc_QueType');
			$QueType3=$this->input->post('Fill_QueType');
			$QueType4=$this->input->post('TF_QueType');
			for($c=1;$c<=$count;$c++)
			{
				
				$MultiQueID=$this->input->post('MultiQueID'.$c);
				$DescQueID=$this->input->post('DescQueID'.$c);
				$FillQueID=$this->input->post('FillQueID'.$c);
				$TFQueID=$this->input->post('TFQueID'.$c);
			
			if($QueType1=='Multiple choice questions' && $DescQueID==null && $FillQueID==null && $TFQueID==null)
			{
				$MultiAnsID=$this->input->post('MultiAnsID'.$c);
			
				//print_r($MultiAnsID);
				if(empty($MultiAnsID))
				{	}
				else
				{
				    //question
				    $MultiData=array('UserID'=>$userid,'TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$MultiQueID,'SubmissionDate'=>$Date);
			    	$this->db->insert('tblUserAttemptQuestion',$MultiData);
			    	$MultiAttemptQueID=$this->db->insert_id();
				    
				    //answer
			    	for($i=0;$i<count($MultiAnsID);$i++)
			    	{
			    	        $MultiAnsData=array('AnswerID'=>$MultiAnsID[$i],'UserAttemptQueID'=>$MultiAttemptQueID,'IsDescriptive'=>'0');
			    	    	$this->db->insert('tblUserAttemptAns',$MultiAnsData);
			    	}
				}
			}
			if($QueType2=='Descriptive questions' && $MultiQueID==null && $FillQueID==null && $TFQueID==null)
			{
				$DescAns=ucfirst($this->input->post('DescAns'.$c));
				if($DescAns==null)
				{
				 //   continue;
				}
				else
				{
				    //question
				    $DescData=array('UserID'=>$userid,'TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$DescQueID,'SubmissionDate'=>$Date);
			    	$this->db->insert('tblUserAttemptQuestion',$DescData);
			    	$DescAttemptQueID=$this->db->insert_id();
				    
				    //answer
		    		$this->db->insert('tblDescriptiveAns',array('DescAns'=>$DescAns));
		    		$DescAnsID=$this->db->insert_id();
		    		$DescAnsData=array('AnswerID'=>$DescAnsID,'UserAttemptQueID'=>$DescAttemptQueID,'IsDescriptive'=>'1');
			    	$this->db->insert('tblUserAttemptAns',$DescAnsData);
				}
			}
			if($QueType3=='Fill in the blanks' && $MultiQueID==null && $DescQueID==null && $TFQueID==null)
			{
			    $FillAnsID=$this->input->post('FillAnsID'.$c);
			    if($FillAnsID==null)
				{
				    //continue;
				}
				else
				{
				    //question
				    $FillData=array('UserID'=>$userid,'TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$FillQueID,'SubmissionDate'=>$Date);
			    	$this->db->insert('tblUserAttemptQuestion',$FillData);
			    	$FillAttemptQueID=$this->db->insert_id();
				    
				    //answer
		    		$FillAnsData=array('AnswerID'=>$FillAnsID,'UserAttemptQueID'=>$FillAttemptQueID,'IsDescriptive'=>'0');
			    	$this->db->insert('tblUserAttemptAns',$FillAnsData);
				}
			}
			if($QueType4=='True false' && $MultiQueID==null && $DescQueID==null && $FillQueID==null)
			{
				$TFAnsID=$this->input->post('TFAnsID'.$c);
				if($TFAnsID==null)
				{
				  //  continue;
				}
				else
				{
				    //question
				    $TFData=array('UserID'=>$userid,'TestID'=>$TestId,'QuePaperID'=>$QuePaperId,'QuestionID'=>$TFQueID,'SubmissionDate'=>$Date);
			    	$this->db->insert('tblUserAttemptQuestion',$TFData);
				    $TFAttemptQueID=$this->db->insert_id();
				    
				    //answer
			    	$TFAnsData=array('AnswerID'=>$TFAnsID,'UserAttemptQueID'=>$TFAttemptQueID,'IsDescriptive'=>'0');
				    $this->db->insert('tblUserAttemptAns',$TFAnsData);
				}
			}
		}
	}
	
	function GetUserDataForLogin()
	{
	     $email=$this->input->post('email');
		 $pass=$this->input->post('password');
		
		 //super admin
	     $GetSuperAdmin=$this->db->query("select * from tblUserRegistration where EmailID='$email' and Password='$pass' and UserTypeID='1'");
	     $SuperAdminCount=$GetSuperAdmin->num_rows();
	     if($SuperAdminCount==1)
		{
	     $FetchSuperAdmin=$GetSuperAdmin->row();
	     $SuperAdminEmail=$FetchSuperAdmin->EmailID;
		 $SuperAdminID=$FetchSuperAdmin->UserID;
		}
		else
		{
		    $SuperAdminEmail=null;
		   $SuperAdminID=null; 
		}
		 //admin
		$GetAdmin=$this->db->query("select * from tblAdmins where EmailID='$email' and Password='$pass'");
		$AdminCount=$GetAdmin->num_rows();
	    $GetActiveAdmin=$this->db->query("select * from tblAdmins where EmailID='$email' and Password='$pass' and IsActive='1'");
		$ActiveAdminCount=$GetActiveAdmin->num_rows();
		if($ActiveAdminCount==1)
		{
		$FetchAdmin=$GetAdmin->row();
		$AdminEmail=$FetchAdmin->EmailID;
		$AdminID=$FetchAdmin->Admin_id;
		$AdminPass=$FetchAdmin->Password;
		}
		else
		{
		    $AdminEmail=null;
		    $AdminID=null;
		    $AdminPass=null;
		}
	     
	     //user
		$GetUser=$this->db->query("select * from tblUserRegistration where EmailID='$email' and Password='$pass' and UserTypeID='2'");
		$UserCount=$GetUser->num_rows();
		 if($UserCount==1)
		{
		    $FetchUser=$GetUser->row();
			$UserEmail=$FetchUser->EmailID;
			$UserID=$FetchUser->UserID;
			$AdminIDUsertbl=$FetchUser->AdminID;
		}
		else
		{
		    $UserEmail=$UserID=$AdminIDUsertbl=null;
		}
		
		//exam coordinator
		$GetExamCoOrdinator=$this->db->query("select * from tblExamCoordinator where EmailID='$email' and Password='$pass'");
		$ExamCoOrdinatorCount=$GetExamCoOrdinator->num_rows();
		
		if($ExamCoOrdinatorCount==1)
		{
		    $FetchExamCoOrdinator=$GetExamCoOrdinator->row();
		    $ExamCoID=$FetchExamCoOrdinator->ExamCoordinatorID;
		    $ExamCoEmail=$FetchExamCoOrdinator->EmailID;
		}
		else
		{
		    $ExamCoID=$ExamCoEmail=null;
		}
			
	     echo json_encode(array("SuperAdminCount" => $SuperAdminCount,"SuperAdminEmail"=>$SuperAdminEmail,"SuperAdminID"=>$SuperAdminID,"AdminCount"=>$AdminCount,"ActiveAdminCount"=>$ActiveAdminCount,"AdminEmail"=>$AdminEmail,"AdminPass"=>$AdminPass,"AdminID"=>$AdminID,"UserCount"=>$UserCount,"UserEmail"=>$UserEmail,"UserID"=>$UserID,"AdminIDUsertbl"=>$AdminIDUsertbl,'ExamCoOrdinatorCount'=>$ExamCoOrdinatorCount,'ExamCoID'=>$ExamCoID,'ExamCoEmail'=>$ExamCoEmail));
	}
	
	function Login()
	{
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	   
	   $parameters=parse_url($actual_link, PHP_URL_QUERY);
	   parse_str($parameters);
		if(isset($btnid))	
		{	
			if($SuperAdminCount==1 && $ActiveAdminCount==0 && $UserCount==0)
			{
			    
			    $this->session->set_userdata('SuperAdminEmail',$SuperAdminEmail);
				$this->session->set_userdata('SuperAdminID',$SuperAdminID);
			    redirect('Questions/SuperAdminHomePage');
			}
			if($ActiveAdminCount==1 && $SuperAdminCount==0 && $UserCount==0)
			{
			    
			    $this->session->set_userdata('admin_session',$AdminEmail);
				$this->session->set_userdata('admin_id_session',$AdminID);
			    redirect('Questions/AdminHomePage');
			}
			if($UserCount==1 && $SuperAdminCount==0 && $ActiveAdminCount==0)
			{
			    
			    $this->session->set_userdata('user_session',$UserEmail);
				$this->session->set_userdata('session_userid',$UserID);
				$this->session->set_userdata('AdminID',$AdminIDUsertbl);
			    redirect('Questions/ShowQuestionPaper');
			}
			if($ExamCoOrdinatorCount==1 && $SuperAdminCount==0 && $ActiveAdminCount==0 && $UserCount==0)
			{
			    $this->session->set_userdata('ExamCoOrdinatorID',$ExamCoID);
				$this->session->set_userdata('ExamCoOrdinatorEmail',$ExamCoEmail);
				redirect('Questions/ExamCoOrdinatorHome');
			}
	    }	
		
		$this->load->view('user_login.php');
	}
	function Logout()
	{
		$this->session->sess_destroy();
		redirect('Questions/Login');
	}
	
	function AdminData()
	{
	      $email=$this->input->post('email');
	      $adminid=$this->input->post('adminid');
	    
	        $select=$this->db->query("select EmailID from tblUserRegistration where EmailID='$email'");
			$EmailCount=$select->num_rows();
			
			$selectUser=$this->db->query("select * from tblUserRegistration where AdminID='$adminid'");
			$UsersPerAdmin=$selectUser->num_rows();
			
			$SelectNoOfUsers=$this->db->query("select NumberOfUsers from tblAdmins where Admin_id='$adminid'");
			$FetchNoOfUsers=$SelectNoOfUsers->row();
			$NoOfUsers=$FetchNoOfUsers->NumberOfUsers;
			
			 echo json_encode(array("EmailCount"=>$EmailCount,"UsersPerAdmin"=>$UsersPerAdmin,"NoOfUsers"=>$NoOfUsers));
	}
	
	function UserRegistration()
	{	
	  //  $this->UserSession();
	    if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
          
            $secretKey = "6Ld-i30UAAAAACKsC07zJi24S_BBkb2cRRO_vvrH";
        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);
        if(intval($responseKeys["success"]) !== 1) {
          //echo '<h2>You are spammer ! Get the @$%K out</h2>';
        } else {
        //  echo '<h2>Thanks for posting comment.</h2>';
        }
        }
        $data['AdminDetails']=array();
        
         $GetAdminDetails=$this->db->get('tblAdmins');
        $FetchAdminDetails=$GetAdminDetails->result();
       // print_r($FetchAdminDetails);
        $data['AdminDetails']=$FetchAdminDetails;
        
        $Email=$this->input->post('email');
        $AdminID=$this->input->post('adminid');
        $btnid=$this->input->post('btnid');
        $pass=$this->random_password(8);
        
        $Password=null;
        $flag=false;
        
        if($btnid=='submit')
        {
		
				$user_details=array('EmailID'=>$Email,'Password'=>$pass,'UserTypeID'=>'2','AdminID'=>$AdminID);
				$this->db->insert('tblUserRegistration',$user_details);
				
				$GetPassword=$this->db->query("select Password from tblUserRegistration where EmailID='$Email'");
				$FetchPassword=$GetPassword->row();
				$Password=$FetchPassword->Password;
				
					$GetEmail=$this->db->query("select * from tblUserRegistration where EmailID='$Email'");
	            	$FetchEmail=$GetEmail->result();
	            	$count=$GetEmail->num_rows();
		
	            	$UserID=null;
	            	$EmailID=null;
		//echo $count;
		
		   // $EmailID=$FetchEmail[0]->EmailID;
		              if($count!=0)
		               {
		                   $UserID=$FetchEmail[0]->UserID;
		                  $EmailID=$FetchEmail[0]->EmailID;
		                 }
		              else
		                 {
		                       $UserID=null;
		                         $EmailID=null;
		                      }
		   
		             	$plain_txt = 	$UserID;
                        "Plain Text =" .$plain_txt. "\n";
                        $encrypted_txt = $this->encrypt_decrypt('encrypt', $plain_txt);
                        "Encrypted Text = " .$encrypted_txt. "\n";
				        echo $encrypted_txt;
				
				 $flag=true;
        }		
           
            if( $flag==false)
            {
	            $this->load->view('user_registration.php',$data);
                
            }
	}
	function ForgotPassword()
	{
		$this->load->view('forgot_password.php');
		
	}
	function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';
    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

    function ForgotPasswordMail()
    {
        
         if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
          
          
            $secretKey = "6Ld-i30UAAAAACKsC07zJi24S_BBkb2cRRO_vvrH";
        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);
        if(intval($responseKeys["success"]) !== 1) {
          //echo '<h2>You are spammer ! Get the @$%K out</h2>';
        } else {
         // echo '<h2>Thanks for posting comment.</h2>';
        }
        }
        
        
        $email=$this->input->post('email');

	    //admin
	    
	    $GetAdminEmail=$this->db->query("select * from tblAdmins where EmailID='$email'");
		$FetchAdminEmail=$GetAdminEmail->result();
		$AdminCount=$GetAdminEmail->num_rows();
	    
	    if($AdminCount==1)
	    {
	        $AdminID=$FetchAdminEmail[0]->Admin_id;
	        $AdminEmailID=$FetchAdminEmail[0]->EmailID;
	        
	        $EncrAdminID = $this->encrypt_decrypt('encrypt', $AdminID);
	    }
	    else
	    {
	        $AdminID=$AdminEmailID=$EncrAdminID=null;
	    }
	
	    //user
	    
	    $GetUserEmail=$this->db->query("select * from tblUserRegistration where EmailID='$email'");
		$FetchUserEmail=$GetUserEmail->result();
		$UserCount=$GetUserEmail->num_rows();
		
		if($UserCount==1)
		{
		    $UserID=$FetchUserEmail[0]->UserID;
		    $UserEmailID=$FetchUserEmail[0]->EmailID;
		    
		    $EncrUserID = $this->encrypt_decrypt('encrypt', $UserID);
		}
		else
		{
		    $UserID=$UserEmailID=$EncrUserID=null;
		}
		
		//exam co-ordinator
		
		$GetExamCoEmail=$this->db->query("select * from tblExamCoordinator where EmailID='$email'");
		$FetchExamCoEmail=$GetExamCoEmail->result();
		$ExamCoCount=$GetExamCoEmail->num_rows();
		
		if($ExamCoCount==1)
		{
		    $ExamCoID=$FetchExamCoEmail[0]->ExamCoordinatorID;
		    $ExamcoEmailID=$FetchExamCoEmail[0]->EmailID;
		    
		    $EncrExamCoID = $this->encrypt_decrypt('encrypt', $ExamCoID);
		}
		else
		{
		    $ExamCoID=$ExamcoEmailID=$EncrExamCoID=null;
		}
	
	    //super admin
	    
	    $GetSuperAdminEmail=$this->db->query("select * from tblUserRegistration where EmailID='$email' and UserTypeID='1'");
		$FetchSuperAdminEmail=$GetSuperAdminEmail->result();
		$SuperAdminCount=$GetSuperAdminEmail->num_rows();
		
		if($SuperAdminCount==1)
		{
		    $SuperAdminID=$FetchSuperAdminEmail[0]->UserID;
		    $SuperAdminEmailID=$FetchSuperAdminEmail[0]->EmailID;
		    
		    $EncrSuperAdminID = $this->encrypt_decrypt('encrypt', $SuperAdminID);
		}
		else
		{
		    $SuperAdminID=$SuperAdminEmailID=$EncrSuperAdminID=null;
		}
	
	    echo json_encode(array("AdminCount" => $AdminCount, "EncrAdminID" => $EncrAdminID,"AdminEmailID" => $AdminEmailID,"UserCount" => $UserCount, "EncrUserID" => $EncrUserID,"UserEmailID" => $UserEmailID,"ExamCoCount" => $ExamCoCount, "EncrExamCoID" => $EncrExamCoID, "ExamcoEmailID" => $ExamcoEmailID,"SuperAdminCount" => $SuperAdminCount, "EncrSuperAdminID" => $EncrSuperAdminID, "SuperAdminEmailID" => $SuperAdminEmailID));
	
    }
    
	function ResetPassword()
	{
	       
	    
	         $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	   
	         $parameters=parse_url($actual_link, PHP_URL_QUERY);
	          parse_str($parameters);
	    if(isset($UserID))
	    {
	        $user['userid']=array($UserID);
	        
	    }
	    if(isset($ExamCoordinatorID))
	    {
	        $user['ExamCoordinatorID']=array($ExamCoordinatorID);
	    }
	    if(isset($AdminID))
	    {
	        $user['AdminID']=array($AdminID);
	    }
	    if(isset($SuperAdminID))
	    {
	        $user['SuperAdminID']=array($SuperAdminID);
	    }
	    
            $this->load->view('ResetPassword.php',$user);
	}
	
	function ResetUserPassword()
	{
	    $UserID=$this->input->post('UserID');
	    $pass=$this->input->post('pass');
	    $UserID = $this->encrypt_decrypt('decrypt', $UserID);
	    $this->db->query("update tblUserRegistration set Password='$pass' where UserID='$UserID'");
	}
	function ResetExamCoPassword()
	{
	    $ExamCoID=$this->input->post('ExamCoID');
	    $pass=$this->input->post('pass');
	    $ExamCoIDD = $this->encrypt_decrypt('decrypt', $ExamCoID);
	    $this->db->query("update tblExamCoordinator set Password='$pass' where ExamCoordinatorID='$ExamCoIDD'");
	}
	
	function ResetAdminPassword()
	{
	    $AdminID=$this->input->post('AdminID');
	    $pass=$this->input->post('pass');
	    $AdminIDD = $this->encrypt_decrypt('decrypt', $AdminID);
	    $this->db->query("update tblAdmins set Password='$pass' where Admin_id='$AdminIDD'");
	}
	function ResetSuperAdminPassword()
	{
	    $SuperAdminID=$this->input->post('SuperAdminID');
	    $pass=$this->input->post('pass');
	    $SuperAdminIDD = $this->encrypt_decrypt('decrypt', $SuperAdminID);
	    $this->db->query("update tblUserRegistration set Password='$pass' where UserID='$SuperAdminIDD' and UserTypeID='1'");
	}
	
	function AdminSession()
	{
	    if(!$this->session->userdata('admin_id_session'))
	    {
	       redirect('Questions/Login');
	       return;
         }
        else{
        }
	}
	function UserSession()
	{
	    if(!$this->session->userdata('session_userid'))
	    {
	       redirect('Questions/Login');
	       return;
         }
        else{
        }
	}
	function SuperAdminSession()
	{
	    if(!$this->session->userdata('SuperAdminID'))
	    {
	       redirect('Questions/Login');
	       return;
         }
        else{
        }
	}
	
	function ExamCoodinator()
	{
	    if(!$this->session->userdata('ExamCoOrdinatorID'))
	    {
	       redirect('Questions/Login');
	       return;
         }
        else{
        }
	}
	
}	
?>
