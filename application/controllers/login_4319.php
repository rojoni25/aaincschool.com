<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {

	function __construct()
 	{
		ob_start();
	
   		parent::__construct(); 
		$this->load->model('login_module','',TRUE);
   		$this->load->library('form_validation');
   		$this->load->library('email');
 	}
	public function index()
	{
		if($this->session->userdata('logged_ol_member'))
   		{
			header('Location: '.base_url().'index.php/dashboard');
			exit;
   		}
		elseif($this->session->userdata('logged_ol_member_free'))
	 	{
	 		header('Location: '.base_url().'index.php/loginsucess');
			exit;
	    }
   		else
   		{
			$this->load->view('public/public_header');
     		$this->load->view('public/login_view');
			$this->load->view('public/public_footer');
   		}
	}

	public function login_submit()
	{
	//echo "<h1> Login disabled temporarily</h1>"; exit;
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds

		if($this->session->userdata('logged_ol_member'))
	 	{
	 		header('Location: '.base_url());
			exit;
	    }

		if($this->session->userdata('logged_ol_member_free'))
	 	{
	 		header('Location: '.base_url().'index.php/loginsucess');
			exit;
	    }
		
		$this->form_validation->set_rules('username', 'Username', 'required');
	 	$this->form_validation->set_rules('password', 'Password', 'required');
	 	
		if ($this->form_validation->run() == FALSE)
	 	{
		 	$data['error']='Invalid Username or password';
         	$this->load->view('login_view',$data);	
		}
		else{
			
			$username 	= 	$this->input->post('username');
		 	$password	=	$this->input->post('password');
     	 	$result 	= 	$this->login_module->loginsub($username, $password);

			if(count($result)> 0){
				
				$this->check_email($result);
				
				$admin_dt 		= 	$this->login_module->get_admin_email_id();
				//
				$refdt 	= 	$this->login_module->get_user_by_code($result[0]['referralid_free']);
				$message = 'Name: '.$result[0]['fname'].' '.$result[0]['lname'].'<br>Sponsor Name: '.$refdt[0]['fname'].' '.$refdt[0]['lname'].'<br>Login Time : '.date('m-d-Y H:i:s');
				$e_array=array("heading"=>"Member Login","msg"=>$message,"contain"=>'');
				
				$message=email_template_one($e_array);
				$to  = 	$record[0]['emailid'];
				//sendemail($result[0]['emailid'],'Member login sucessfully','thecoachmark@gmail.com',$message);
				//
				$sess_array = array();
				$sess_array['usercode']				=	$result[0]['usercode'];
				$sess_array['user_type_id']			=	$result[0]['user_type_id'];
				$sess_array['fullname']				=	$result[0]['fname'].' '.$result[0]['lname'];
				$sess_array['emailid']				=	$result[0]['emailid'];
				$sess_array['mobileno']				=	$result[0]['mobileno'];
				$sess_array['phone_no']				=	$result[0]['phone_no'];
				$sess_array['username']				=	$result[0]['username'];
				$sess_array['ref_by']				=	$result[0]['referralid'];
				$sess_array['referralid_free']		=	$result[0]['referralid_free'];
				$sess_array['status']				=	$result[0]['status'];
				$sess_array['due_time']				=	$result[0]['due_time'];
				$sess_array['email_verification']	=	$result[0]['email_verification'];
				$sess_array['admin_email']			=	$admin_dt[0]['emailid'];

				if($result[0]['user_img']!=''){
					$sess_array['user_img']				=	$result[0]['user_img'];
				}
				else{
					$sess_array['user_img']				=	'no.jpg';
				}
				
				$sess_array['product_access']		=	'No';
				
				if($result[0]['status']=='Active')
				{
					$payment_level 	= 	$this->login_module->get_payment_level($result[0]['usercode']);
					
					$sess_array['payment_level']		=	$payment_level[0]['tot'];
					$sess_array['product_access']		=	'Yes';
					$tbl['coded_residual']				=	'coded_residual';
					$tbl['member_level_track_master']	=	'member_level_track_master';
					$tbl['member_node_master']			=	'member_node_master';
					$tbl['payment_daily']				=	'payment_daily';
					$tbl['referralid']					=	'referralid';
					$tbl['current_account']				=	'Active';
					$refdt 	= 	$this->login_module->get_user_by_code($result[0]['referralid']);
					
					if($result[0]['popup_date']!=date('Y-m-d')){
						$this->login_module->update_today_popup($result[0]['usercode']);
						$pop_content=$this->login_module->get_master_page_by_pagecode('open_popup_paid');
						if($pop_content[0]['textdt']!=''){
							$this->session->set_flashdata('open_popup_paid', 'Yes');
						}
					}
					
				}
				if($result[0]['status']=='Pending')
				{
					$product_access  = 	$this->login_module->get_product_access($result[0]['usercode']);
					if(isset($product_access[0]))
					{
						$sess_array['product_access']	=	'Yes';
					}
					
					if($result[0]['email_verification']=='N'){
						$this->session->set_flashdata('open_popup', 'Yes');
					}
					
					$tbl['coded_residual']				=	'coded_residual_free';
					$tbl['member_level_track_master']	=	'member_level_track_master_free';
					$tbl['member_node_master']			=	'member_node_master_free';
					$tbl['payment_daily']				=	'payment_daily_free';
					$tbl['referralid']					=	'referralid_free';
					$tbl['current_account']				=	'Pending';
					$refdt 	= 	$this->login_module->get_user_by_code($result[0]['referralid_free']);

					if($result[0]['popup_date']!=date('Y-m-d')){
						$this->login_module->update_today_popup($result[0]['usercode']);

						$pop_content=$this->login_module->get_master_page_by_pagecode('open_popup_free');
						if($pop_content[0]['textdt']!=''){
							$this->session->set_flashdata('open_popup_free', 'Yes');
						}
					}
				}
				//var_dump($refdt);
				//exit;
				$ref['name']			=	$refdt[0]['fname'].''.$refdt[0]['lname'];
				$ref['emailid']			=	$refdt[0]['emailid'];
				$ref['skype']			=	$refdt[0]['skype'];
				$ref['twitter_link']	=	$refdt[0]['twitter_link'];
				$ref['linkedin_link']	=	$refdt[0]['linkedin_link'];
				$ref['googleplus_link']	=	$refdt[0]['googleplus_link'];
				$ref['youtube_link']	=	$refdt[0]['youtube_link'];
				$ref['facebook_link']	=	$refdt[0]['facebook_link'];
				$ref['currect_add']		=	$this->get_currect_add_member();
				
				$ref['mobileno']=$refdt[0]['mobileno'];
				$this->session->set_userdata('ref', $ref);
				
				$this->session->set_userdata('tbl', $tbl);
				
				$inac['availeble']			=	'N';
				$this->login_module->update($inac,'login_info','usercode',$result[0]['usercode']);
				
				$data['usercode']			=	$result[0]['usercode'];
				$data['ip']					=	$_SERVER['REMOTE_ADDR'];
				$data['browserdt']			=	$_SERVER["HTTP_USER_AGENT"];
				$data['timedt']				=	$nowdt;
				$data['status']				=	'Sucess';
				$data['availeble']			=	'Y';
				$data['last_event']			=	time();
				$data['logintime']			=	time();
				$login_code					=	$this->login_module->addItem($data,'login_info');
				$sess_array['login_code']	=	$login_code;
				
				
				
				
				$this->session->set_userdata('logged_ol_member',$sess_array);
			    $this->session->set_userdata('loggedolmember',$sess_array);
	
				//**KDK**//
				$this->set_matrix_session('rm_matrix_admin',$result[0]['usercode'],'r_matrix_admin',array('access'=>'true'));		
				$this->set_matrix_session('rm_matrix',$result[0]['usercode'],'r_matrix_join',array('join'=>'true'));
				
				
				
				
				//**CLUB**//
				$this->set_matrix_session('cm_matrix_admin',$result[0]['usercode'],'club_matrix_admin',array('access'=>'true'));		
				$this->set_matrix_session('cm_matrix',$result[0]['usercode'],'club_matrix_join',array('join'=>'true'));
				
				
				
				//**TL**//
				$this->set_matrix_session('tl_matrix_admin',$result[0]['usercode'],'tl_matrix_admin',array('access'=>'true'));		
				$this->set_matrix_session('tl_matrix',$result[0]['usercode'],'tl_matrix_join',array('join'=>'true'));	
				
				
				//--------TLC----------//
				//**TLC**//
				$this->set_matrix_session('tlc_matrix_admin',$result[0]['usercode'],'tlc_matrix_admin',array('access'=>'true'));		
				$this->set_matrix_session('tlc_matrix',$result[0]['usercode'],'tlc_matrix_join',array('join'=>'true'));	
				//--------TLC----------//
				
				//**ANG**//
				$this->set_matrix_session('ang_matrix_admin',$result[0]['usercode'],'ang_matrix_admin',array('access'=>'true'));		
				$this->set_matrix_session('ang_matrix',$result[0]['usercode'],'ang_matrix_join',array('join'=>'true'));	
				
				
				//**REC**//
				$this->set_matrix_session('rec_matrix_admin',$result[0]['usercode'],'rec_matrix_admin',array('access'=>'true'));		
				$this->set_matrix_session('rec_matrix',$result[0]['usercode'],'rec_matrix_join',array('join'=>'true'));	
				
				
				//**GCP**//
				$this->set_matrix_session('gcp_matrix_admin',$result[0]['usercode'],'gcp_matrix_admin',array('access'=>'true'));		
				$this->set_matrix_session('gcp_matrix',$result[0]['usercode'],'gcp_matrix_join',array('join'=>'true'));	
				
				//**GCP**//
				$this->set_matrix_session('kdk1_matrix_admin',$result[0]['usercode'],'kdk1_matrix_admin',array('access'=>'true'));		
				$this->set_matrix_session('kdk1_matrix',$result[0]['usercode'],'kdk1_matrix_join',array('join'=>'true'));
				
				
				//**PDL**//
				$this->set_matrix_session('pdl_member',$result[0]['usercode'],'pdl_matrix_join',array('join'=>'true'));	
				
				//**M2m2**//
				if($this->comman_fun->check_record('m2m_registration',array('usercode'=>$result[0]['usercode']))){
					if(!$this->comman_fun->check_record('m2m_request',array('usercode'=>$result[0]['usercode']))){
						$this->insert_request_m2m($result[0]);	
					}	
				}
				
				
				//**Dreem Student**//
				if($this->comman_fun->check_record('dreem_student_registration',array('usercode'=>$result[0]['usercode']))){
					if(!$this->comman_fun->check_record('dreem_student_request',array('usercode'=>$result[0]['usercode']))){
						$this->insert_request_dreem_student($result[0]);	
					}	
				}
				
				//--------D-ADM----------//
				//tablename,constant value
				$this->set_matrix_session('dadm_matrix_admin',$result[0]['usercode'],'d-adm_matrix_admin',array('access'=>'true'));		
				$this->set_matrix_session('dadm_matrix',$result[0]['usercode'],'d-adm_matrix_join',array('join'=>'true'));	
				//--------D-ADM----------//
				
			
				//--------smfund----------//
				if($this->comman_fun->check_record('smfund_member',array('usercode'=>$result[0]['usercode']))){
					$this->session->set_userdata('logged_smfund_member',true);
					header('Location: '.smfund().'welcome/view');
					
					exit;	
				}else{
					header('Location: '.base_url().'index.php/welcome');
					exit;	
				}
				//--------smfund----------//
				
					header('Location: '.base_url().'index.php/welcome');
				exit;
				
				
				
				
				
				
				
				
			}
			else{
				$data['username']		=	$this->input->post('username');
				$data['password']		=	$this->input->post('password');
				$data['timedt']			=	$nowdt;
				$data['status']			=	'Failed';
				$data['ip']				=	$_SERVER['REMOTE_ADDR'];
				$data['browserdt']		=	$_SERVER["HTTP_USER_AGENT"];
				$data['availeble']		=	'N';
				$login_code				=	$this->login_module->addItem($data,'login_info');
				
				$data['error']='Invalid Username or password';
				$this->load->view('public/public_header');
         		$this->load->view('public/login_view',$data);
				$this->load->view('public/public_footer');	
			}
			
		}
	
	}
	
	private function set_matrix_session($tbl,$usercode,$session_field, $session_val)
	{
		$result=$this->login_module->get_table_record($tbl,$usercode);
		if(isset($result[0])){
			$this->session->set_userdata($session_field,$session_val);
		}
		
	}
	
	
	protected function check_email($result)
	{
		if($result[0]['email_verification']!='Y'){
			$r_info=array();
			$r_info['status']	=	'true';
			$r_info['usercode']	=	$result[0]['usercode'];
			$this->session->set_userdata('email_verification', $r_info);	
			header('Location: '.base_url().'index.php/email_verification_from');
			exit;
		}
	}
	
	
	
	
	protected function get_currect_add_member()
	{
		$result=$this->login_module->get_currect_add_member();
		$list=array();	
		for($i=0;$i<count($result);$i++){
			$list[]=ucwords(strtolower($result[$i]['name']));
		}
		return $p=implode(', ',$list);
	}
	
	
	
	function logout()
 	{
		$this->load->driver('cache'); 
		$this->cache->clean();
		
		$now = time();
		$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$data['availeble']		=	'N';
		$data['logout_time']	=	$nowdt;
		$this->login_module->update($data,'login_info','login_code',$this->session->userdata['logged_ol_member']['login_code']);	
		$this->session->sess_destroy();
		header('Location: '.base_url().'index.php/login');
		exit;
    }
	

	function go_in_paid()
	{		
	
		$tbl['coded_residual']				=	'coded_residual';
		$tbl['member_level_track_master']	=	'member_level_track_master';
		$tbl['member_node_master']			=	'member_node_master';
		$tbl['referralid']					=	'referralid';
		$tbl['current_account']				=	'Active';
		$tbl['payment_daily']				=	'payment_daily';
		$this->session->set_userdata('tbl', $tbl);	
		
		$refdt 					= 	$this->login_module->get_user_by_code($this->session->userdata['logged_ol_member']['ref_by']);
		$ref['name']			=	$refdt[0]['fname'].''.$refdt[0]['lname'];
		$ref['emailid']			=	$refdt[0]['emailid'];
		$ref['skype']			=	$refdt[0]['skype'];
		$ref['twitter_link']	=	$refdt[0]['twitter_link'];
		$ref['linkedin_link']	=	$refdt[0]['linkedin_link'];
		$ref['googleplus_link']	=	$refdt[0]['googleplus_link'];
		$ref['youtube_link']	=	$refdt[0]['youtube_link'];
		$ref['facebook_link']	=	$refdt[0]['facebook_link'];
		$ref['mobileno']		=	$refdt[0]['mobileno'];
		$ref['currect_add']		=	$this->get_currect_add_member();
		$this->session->set_userdata('ref', $ref);
		
		if(isset($_GET['redirect']) && $_GET['redirect']!=''){
			header('Location: '.$_GET['redirect']);
			exit;
		} else{
			header('Location: '.base_url().'index.php/welcome');
			exit;
		}
	}
	
	function go_in_free()
	{
		$tbl['coded_residual']				=	'coded_residual_free';
		$tbl['member_level_track_master']	=	'member_level_track_master_free';
		$tbl['member_node_master']			=	'member_node_master_free';
		$tbl['referralid']					=	'referralid_free';
		$tbl['current_account']				=	'Pending';
		$tbl['payment_daily']				=	'payment_daily_free';
		$this->session->set_userdata('tbl', $tbl);
		
		$refdt 	= 	$this->login_module->get_user_by_code($this->session->userdata['logged_ol_member']['referralid_free']);
		$ref['name']			=	$refdt[0]['fname'].''.$refdt[0]['lname'];
		$ref['emailid']			=	$refdt[0]['emailid'];
		$ref['skype']			=	$refdt[0]['skype'];
		$ref['twitter_link']	=	$refdt[0]['twitter_link'];
		$ref['linkedin_link']	=	$refdt[0]['linkedin_link'];
		$ref['googleplus_link']	=	$refdt[0]['googleplus_link'];
		$ref['youtube_link']	=	$refdt[0]['youtube_link'];
		$ref['facebook_link']	=	$refdt[0]['facebook_link'];
		$ref['mobileno']		=	$refdt[0]['mobileno'];
		$ref['currect_add']		=	$this->get_currect_add_member();
		$this->session->set_userdata('ref', $ref);
		if(isset($_GET['redirect']) && $_GET['redirect']!=''){
			header('Location: '.$_GET['redirect']);
			exit;
		} else{
			header('Location: '.base_url().'index.php/welcome');
			exit;
		}
	}
	
	function forgate_password()
	{
		$this->load->view('public/public_header');
     	$this->load->view('public/forgate_password_view');
		$this->load->view('public/public_footer');
	}
	function password_reset()
	{
		$this->load->view('public/public_header');
     	$this->load->view('public/password_reset_view');
		$this->load->view('public/public_footer');
	}
	function forgate_password_submit()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			if($_POST['emaild']!='')
			{
				$record		=	$this->login_module->get_record_by_email($_POST['emaild']);
				
				if(count($record)>0){
					$randd=rand(10000,100000);
					$data['password']=$randd;
					$this->login_module->update($data,'membermaster','usercode',$record[0]['usercode']);
					// $message='<p><h3>Your password Reset sucessfully</h3></p>';
					// $message.='<p>Username	:'.$record[0]['username'].'</p>';
					// $message.='<p>Password	:'.$randd.'</p>';
					$message = get_email_cms_page_master('your-password-reset-sucessfully')->result()[0]->textdt;
					$message = str_replace("[username]",$record[0]['username'],$message);
					$message = str_replace("[password]",$randd,$message);
					
					$email_contain	=	$this->login_module->get_email_contain();
					$e_array=array("heading"=>"password Reset","msg"=>$message,"contain"=>$email_contain[0]['textdt']);
					
					$message=email_template_one($e_array);
					$to  = 	$record[0]['emailid'];
					// $this->email->from(FROM_EMAIL);
					// $this->email->to($to);
					// $this->email->subject('Your password Reset sucessfully');
					// $this->email->message($message);
					// $this->email->send();
					sendemail(FROM_EMAIL,'Your password Reset sucessfully',$to,$message);
		
		
					header('Location: '.base_url().'index.php/login/password_reset/?p=true'); 
				}
				else{
					header('Location: '.base_url().'index.php/login/forgate_password/?p=flase'); 
				}
				
			}
			else{
				header('Location: '.base_url().'index.php/login/forgate_password/?p=flase'); 
			}
		}
	}
	
	
	protected function insert_request_m2m($result){
			
		$ref_count=$this->comman_fun->count_record('m2m_member',array('upling'=>$result['referralid_free']));
		if($ref_count<2){
			$ref_record		=	$this->comman_fun->get_table_data('m2m_member',array('usercode'=>$result['referralid_free']));	
			if(isset($ref_record[0]) && $ref_record[0]['upling']!='0'){
				$payto			=	$ref_record[0]['upling'];
			}else{
				$payto			=	'123';
			}
			
		}else{
			$payto			=	$result['referralid_free'];
		}
		
		  $data['usercode']		=	$result['usercode']; 
		  $data['upling']		=	$result['referralid_free'];
		  $data['payto']  		=	$payto;
		  $data['type'] 		=	'Reg';
		  $data['status']		=	'Active';
		  $data['time_dt'] 		=	date('Y-m-d');
		  $this->comman_fun->addItem($data,'m2m_request');
		  
		  header('Location: '.base_url().'index.php/m2m/page/view/');
		  exit;
	}
	
	protected function insert_request_dreem_student($result){
			
		$ref_count=$this->comman_fun->count_record('dreem_student_member',array('upling'=>$result['referralid_free']));
		if($ref_count<2){
			$ref_record			=	$this->comman_fun->get_table_data('dreem_student_member',array('usercode'=>$result['referralid_free']));	
			if(isset($ref_record[0]) && $ref_record[0]['upling']!='0'){
				$payto			=	$ref_record[0]['upling'];
			}else{
				$ad				=	$this->comman_fun->get_table_data('dreem_student_admin');	
				$payto			=	$ad[0]['usercode'];
			}
			
		}else{
			$payto				=	$result['referralid_free'];
		}
		
		  $data['usercode']		=	$result['usercode']; 
		  $data['upling']		=	$result['referralid_free'];
		  $data['payto']  		=	$payto;
		  $data['type'] 		=	'Reg';
		  $data['status']		=	'Active';
		  $data['time_dt'] 		=	date('Y-m-d');
		  $this->comman_fun->addItem($data,'dreem_student_request');
		  
		  header('Location: '.base_url().'index.php/dreem_student/page/view/');
		  exit;
	}

	function test_email(){
		// $from = new SendGrid\Email(null, FROM_EMAIL);
  //       $subject = 'Test email from V';
  //       $to = new SendGrid\Email(null, 'vaibhav12321@gmail.com');
  //       $content = new SendGrid\Content("text/html", 'Hi Vaibhav,<br> Test');
  //       $mail = new SendGrid\Mail($from, $subject, $to, $content);
  //       $apiKey = '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';
  //       $sg = new \SendGrid($apiKey);
  //       $response = $sg->client->mail()->send()->post($mail);
		// echo $response->headers();
  //       echo $response->body();
	}
	
	
	function cron_job()
	{
		$this->load->model('welcome_model','ObjM',TRUE);

		
		// for day 1
		$data_1 = $this->ObjM->getmemberDetails_1();
		$email_html		=	$this->ObjM->get_email_html_day_1();
		$message = $email_html[0]['email_text'];

		foreach ($data_1 as $key => $value) {
			$emailid = $value['emailid'];
			sendemail(FROM_EMAIL,'Email after day1',$emailid,$message);
			$this->ObjM->update_member_email_status($value['usercode'], 'day_1');

		}


		// for day 7
		$data_7 = $this->ObjM->getmemberDetails_7();
		$email_html		=	$this->ObjM->get_email_html_day_7();
		$message = $email_html[0]['email_text'];

		foreach ($data_7 as $key => $value) {
			$emailid = $value['emailid'];
			sendemail(FROM_EMAIL,'Email after day7',$emailid,$message);
			$this->ObjM->update_member_email_status($value['usercode'], 'day_7');
		}


		// for day 14
		$data_14 = $this->ObjM->getmemberDetails_14();
		$email_html		=	$this->ObjM->get_email_html_day_14();
		$message = $email_html[0]['email_text'];

		foreach ($data_14 as $key => $value) {
			$emailid = $value['emailid'];
			sendemail(FROM_EMAIL,'Email after day14',$emailid,$message);
			$this->ObjM->update_member_email_status($value['usercode'], 'day_14');
		}


		// for day 21
		$data_21 = $this->ObjM->getmemberDetails_21();
		$email_html		=	$this->ObjM->get_email_html_day_21();
		$message = $email_html[0]['email_text'];

		foreach ($data_21 as $key => $value) {
			$emailid = $value['emailid'];
			sendemail(FROM_EMAIL,'Email after day21',$emailid,$message);
			$this->ObjM->update_member_email_status($value['usercode'], 'day_21');
		}
		
		
	}	
	
	
	

}


