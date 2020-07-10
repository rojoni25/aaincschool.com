<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rg extends CI_Controller {
	protected $table		=	'membermaster';
	protected $primary_key	=	'usercode';
	
	
	protected $upling_user	=	'';
	protected $upling_posi	=	'';
	
	
	function __construct()
 	{
   		parent::__construct();
   		$this->file_setting();
		$this->load->model('rg_model','',TRUE); 
		$this->load->model('login_module','',TRUE); 
		$this->load->model('upgrade_membership_model','',TRUE); 
		$this->load->library('email');
		$this->load->helper('string');

 	}
	protected function file_setting()
	{
		if(file_exists(APPPATH. 'config/matrix_const/tlc/const.php')){
			include(APPPATH. 'config/matrix_const/tlc/const.php');	
			if(!defined('MATRIX_TABLE_PRE')){ 	echo 'Seting Not proper {1}'; exit;}
			if(!defined('MATRIX_CODE_LLB')){ 	echo 'Seting Not proper {2}'; exit;}
			if(!defined('MATRIX_LLB')){ 		echo 'Seting Not proper {3}'; exit;}
			if(!defined('MATRIX_SYSTEM_ADMIN')){ echo 'Seting Not proper {4}'; exit;}
		}
		else{
			echo 'File Not Set';
			exit;
		}
	}
	public function index()
	{
		//echo "<h1> Registration disabled temporarily</h1>"; exit;
		if(!isset($_REQUEST['r']) || $_REQUEST['r']==''){
			$ref='admin';
		}
		else{
			$ref=$_REQUEST['r'];
		}

		$data['ref']=$this->rg_model->get_user_by_username($ref);
		$data['result']=$this->rg_model->get_contain();
		if(isset($_GET['refer_friend']) && $_GET['refer_friend']=='true'){
			$this->send_refer_click($data['ref']);
			
		}
		$this->load->view('rg_view',$data);	
	}

	public function test(){
		echo FROM_EMAIL;
	}

	function send_refer_click($user){
		//$user[0]['usercode']
		$user = $this->rg_model->get_member_detail_by_code($user[0]['usercode']);
		$referal_email = $user[0]['emailid'];
		$admin_email = FROM_EMAIL;

		if(isset($_GET['id'])){
			$id=$_GET['id'];
		} else{
			return;
		}

		$refer_data = $this->rg_model->get_invite_friend_master($id);
		if($user[0]['usercode']!=$refer_data[0]['usercode']){
			return;
		}
		$name = $refer_data[0]['h_name'];
		$contact = $refer_data[0]['h_contact'];
		$notes = $refer_data[0]['h_notes'];

		$message = " Name: $name <br> Contact: $contact <br> Notes: $notes <br>";

		$e_array=array("heading"=>"Clicked on invite link","msg"=>$message,"contain"=>'');	
		$message=email_template_one($e_array);
		$list = array($admin_email,$user[0]['emailid']);

		$analytics_arr = array('invite_code'=>$id, 'created_at'=>date('Y-m-d H:i:s'));
		$this->rg_model->addItem($analytics_arr,'invite_analytics');

		sendemail(FROM_EMAIL,'Invite Link Clicked',$list,$message);
		$noti_msg = $name.' clicked on invite link.';
		//$this->send_notification(0,$noti_msg, $user[0]['usercode']);
	}
	
	
	
	
	
	function insertrecord(){
		//echo "<h1> Registration disabled temporarily</h1>"; exit;
		if($this->input->post('referralid')!=''){
			if ($this->input->server('REQUEST_METHOD') === 'POST')
			{
				$uname = $this->input->post('fname');
				$uname = preg_replace('/\s+/', '', $uname);
	    		$username = $uname.random_string('numeric', 4);
	    		$password = random_string('numeric', 6);
				$this->check_duplicate($username);
				
				$now = time();
				$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
				$data = array();
				
				if($this->input->post('referralid')==''){
					echo '<script>window.location.href="'.$_SERVER["HTTP_REFERER"].'"</script>';
					exit;
				}
				
				
	    		$data['fname']			 =	$this->input->post('fname');	
				$data['lname']			 =	$this->input->post('lname');	
				$data['username']		 =	$username;
				$data['password']		 =	$password;
				$data['emailid']		 =	$this->input->post('emailid');	
				$data['mobileno']		 =	$this->input->post('mobileno');	
				$data['referralid'] 	 =	$this->input->post('referralid');
				$data['referralid_free'] =	$this->input->post('referralid');
				$data['camefrom'] =	$this->input->post('camefrom');
				$data['add_time'] 		 =	strtotime(date('d-m-Y'));
				
				if($_POST['pagecode']!=''){
					$data['pagecode'] =	$_POST['pagecode'];
				}
				
				if(isset($_POST['skype'])){
					$data['skype'] =	$_POST['skype'];
				}
					
				$data['status'] 	=	'Pending';
				$referralid=$this->input->post('referralid');
				$data['create_date']	=	$nowdt;	
				$usercode=$this->rg_model->addItem($data,$this->table);
				
				
				
				////////////////
				$data2['usercode']=$usercode;
				
				
				$data2=$this->entry_in_tree($referralid,$usercode);
				
				$this->level_update($data2);
			
				$this->coded_residual($usercode);
				$this->free_daily_payment_level_update($data2);
				
				// Insert in Ad Multiplier Tree
					$upling_member=1;
					$this->tot_downline=0;
					$this->get_position($upling_member);

					$upling_dt=$this->rg_model->get_tree_record($this->upling_user);	
			
					$data=array();
					
					$data['usercode'] 		= 	$usercode;
					$data['upling_member']  = 	$upling_dt[0]['usercode'];
					$data['upling_id']  	= 	$this->upling_user;
					$data['side']  			= 	$this->upling_posi;
					$data['add_time']  		= 	time();
					$data['uby']  			= 	$usercode;
					$data['request_code']   = 	0;

					$idcode=$this->rg_model->addItem($data,''.MATRIX_TABLE_PRE.'matrix_free');
					$top_third_member	=	$this->get_top_third_member($idcode);
					$this->get_total_downline($top_third_member['idcode']);

					if($this->tot_downline==14){
							
						$arr_pay=array('usercode'=> $top_third_member['usercode'],'amount'=> '59','position'=> $top_third_member['idcode'],'wallet_type'=> 'RM');
							$this->payment_insert($arr_pay);						

							if($top_third_member['usercode'] == MATRIX_SYSTEM_ADMIN){
									
									$arr_pay=array('usercode'=> $top_third_member['usercode'],'amount'=>400,'position'=> $top_third_member['idcode'],'wallet_type'=> 'COIN');
							
									$this->payment_insert($arr_pay);
							
									$new_position['member_list']	=	array($top_third_member,$top_third_member,$top_third_member,$top_third_member);
									
								
							}else{
								
								$arr_pay=array('usercode'=> $top_third_member['usercode'],'amount'=>200,'position'=> $top_third_member['idcode'],'wallet_type'=> 'COIN');
							
								$this->payment_insert($arr_pay);
								
								$top_system=array('usercode'=>MATRIX_SYSTEM_ADMIN);
								
								$new_position['member_list']	=	array($top_third_member,$top_third_member,$top_system,$top_system);
						
							}
							
							$new_position['upling']				=	$top_third_member['idcode'];
							
							$this->insert_member_in_tree($new_position);
					}//end downline
				//
				
				if(isset($_POST['redirect_url']) && $_POST['redirect_url']!='')
				{
					$url=$_POST['redirect_url'];
				}
				else{
					//------------------------------------------dfsm-------------------------------
					//$url=base_url().'index.php/pages/reg/'.$_POST['pagecode'].'';
					
					$url=base_url().'index.php/pages/reg_new/'.$_POST['pagecode'].'';
					//------------------------------------------dfsm-------------------------------
				}
				$this->send_mail_after_registration(); // Send email to Admin and Referal Member
				
				
				if($_POST['m2m_page']=='Y'){
					$arr=array();
					$arr['usercode']	=	$usercode;
					$this->rg_model->addItem($arr,'m2m_registration');
				}
				
				//**Dreem Student Section Entry**//
				if($_POST['dreem_student']=='Y'){
					$arr=array();
					$arr['usercode']	=	$usercode;
					$this->rg_model->addItem($arr,'dreem_student_registration');
				}
				
				
				if($_POST['smfund']=='Y'){
					$this->smfund_insert($usercode);
				}

				$fullname = $this->input->post('fname').' '.$this->input->post('lname');
				$noti_msg=$fullname.' is Successfully Regsitered!';
				$this->send_notification($referralid,$noti_msg, $usercode);
				
				$this->send_member_registration_email($usercode);
				//$this->send_email_friend($usercode, $this->input->post('fname'), $this->input->post('lname'));
				////////////////
				header('Location: '.base_url().'index.php/welcome');
				exit;
			}
		}//check ref
		echo '<script>window.location.href="'.$_SERVER["HTTP_REFERER"].'"</script>';
		exit;
	}
	
	protected function insert_member_in_tree($new_position){	
		
		
		$member_list=$new_position['member_list'];
		
		$upling=$new_position['upling'];
		
		for($i=0;$i<count($member_list);$i++){
			
				$this->tot_downline=0; 
				
				$this->get_position($upling);
				
				$upling_dt	=	$this->rg_model->get_tree_record($this->upling_user);
				
				
				$data=array();
				$data['usercode'] 		=  $member_list[$i]['usercode'];
				$data['upling_member']  =  $upling_dt[0]['usercode'];
				$data['upling_id']  	=  $this->upling_user;
				$data['side']  			=  $this->upling_posi;
				$data['add_time']  		=  time();
				$data['uby']  			= 	0;
				// For Angel Position Member
					if($member_list[$i]['usercode'] == MATRIX_SYSTEM_ADMIN){
						//angel_position	
						$angel_pos_member = $this->get_top_third_member($this->upling_user);
						$data['angel_position'] = 	$angel_pos_member['idcode'];
					}else{
						$curusercode = $member_list[$i]['usercode'];
						$totalposition=$this->rg_model->get_multi_position($curusercode);
						if(count($totalposition)==7){
							$data['usercode'] = MATRIX_SYSTEM_ADMIN;
							//angel_position	
							$angel_pos_member = $this->get_top_third_member($this->upling_user);
							$data['angel_position'] = 	$angel_pos_member['idcode'];
						}
					}
				//
				$idcode=$this->rg_model->addItem($data,''.MATRIX_TABLE_PRE.'matrix_free');
				
				$top_third_member	=	$this->get_top_third_member($idcode);
				
				$this->get_total_downline($top_third_member['idcode']);
				
				
				
				if($this->tot_downline==14){
					
					$arr_pay=array('usercode'=> $top_third_member['usercode'],'amount'=> '59','position'=> $top_third_member['idcode'],'wallet_type'=> 'RM');
					$this->payment_insert($arr_pay);
				
					if($top_third_member['usercode'] == MATRIX_SYSTEM_ADMIN){
						
						$arr_pay=array('usercode'=> $top_third_member['usercode'],'amount'=>400,'position'=> $top_third_member['idcode'],'wallet_type'=> 'COIN');
						
						$this->payment_insert($arr_pay);
					
						$new_pos['member_list']		=	array($top_third_member,$top_third_member,$top_third_member,$top_third_member);
						
						
					}else{
						
						$arr_pay=array('usercode'=> $top_third_member['usercode'],'amount'=>200,'position'=> $top_third_member['idcode'],'wallet_type'=> 'COIN');
						
						$this->payment_insert($arr_pay);
						
						$top_system=array('usercode'=>MATRIX_SYSTEM_ADMIN);
						
						$new_pos['member_list']		=	array($top_third_member,$top_third_member,$top_system,$top_system);
						
					}
					
					$new_pos['upling']				=	$top_third_member['idcode'];
					
					$this->insert_member_in_tree($new_pos);
					
				}
				
		}
	}
	
	public function send_email_friend($usercode, $firstname, $lastname){
        $fullname= $firstname.' '.$lastname;
        $arr=array();
        $arr_code=array();
        $code=$usercode;
        while(1){
            $r=$this->upgrade_membership_model->get_upling_ref_member($code);
            if($r[0]['usercode']=='1'){
                $arr[]=$r[0]['emailid'];
                $arr_code[]=$r[0]['referralid_free'];
                break;	
            }
            if(!isset($r[0])){
                break;
            }
            if($r[0]['email_verification']=='Y' && $r[0]['subscribe']=='Y'){
                $arr[]=$r[0]['emailid'];
            }
            $arr_code[]=$r[0]['referralid_free'];
            $code=$r[0]['referralid_free'];
        }
        $refArr = $this->rg_model->get_member_detail_by_code($_POST['referralid']);
        $referalname = $refArr[0]['fname'].' '.$refArr[0]['lname'];        //$message = get_email_cms_page_master('upgrade-membership-request')->result()[0]->textdt;
        $message = 'Name : '.$fullname.' <br> Referred By : '.$referalname;
        $e_array=array("heading"=>"Congratulations New team member","msg"=>$message);
        $message=email_template_one($e_array);
        //$title	  =	'My planb marketing group Signup';
        //$subject  =	'Membership Signup Successfully';
        $noti_msg=$fullname.' is Successfully Regsitered!';
        // $this->email->from(FROM_EMAIL);
        // $this->email->subject('Upgrade Membership Request');
        // $this->email->message($message);
        for($i=0;$i<count($arr);$i++){
            // $this->email->to($arr[$i]);
            // $this->email->send();
            sendemail(FROM_EMAIL,'Membership Signup Successfully',$arr[$i],$message);
            $this->send_notification($arr_code[$i],$noti_msg, $usercode);
        }
    }	
    public function send_notification($code,$msg,$usercode){
        $data=array();
        $data['usercode']=$code;
        //$data['by_usercode']=$this->session->userdata['logged_ol_member']['usercode'];
        $data['by_usercode']=$usercode;
        $data['type']='notification';
        $data['contain']=$msg;
        $data['timedt']=time();
        $data['status']='Active';
        //print_r($data);
        $this->upgrade_membership_model->addItem($data,'notification_master');
    }

	function succes(){
	
		$this->load->view('rg_succes');	
	}
	
	function check_duplicate($username)
	{
		$result=$this->rg_model->check_duplicate($this->input->post('emailid'),'emailid');
		if(isset($result[0]))
		{
				$this->send_email_to_member($result);
				header('Location: '.base_url().'index.php/capture/existuser?r='.$_SERVER["HTTP_REFERER"].'&email='.$this->input->post('emailid'));
				exit;
		}
			
		$result=$this->rg_model->check_duplicate($username,'username');
		
		if(isset($result[0]))
		{
				$this->send_email_to_member($result);
				header('Location: '.base_url().'index.php/capture/existuser?r='.$_SERVER["HTTP_REFERER"].'&email='.$this->input->post('emailid'));
				exit;
		}
		return $result;
	}
	//////////////////////
	///**************************************************************************************************//
	function send_mail_after_registration()
	{
		
		$admin_email=$this->rg_model->get_admin_email();
		
		$ref_email=$this->rg_model->get_member_detail_by_code($_POST['referralid']);	
		// $message='<p>Name	:'.$_POST['fname'].' '.$_POST['lname'].'</p>';
		// $message.='<p>Email	:'.$_POST['emailid'].'</p>';
		// $message.='<p>Referral	:'.$ref_email[0]['fname'].' '.$ref_email[0]['lname'].'</p>';
		// $message.='<p>Date	:'.date('d-m-Y H:i:s').'</p>';

		$message = get_email_cms_page_master('new-member-registration-sucessfully')->result()[0]->textdt;
		$message = str_replace("[fname]",$_POST['fname'],$message);
		$message = str_replace("[lname]",$_POST['lname'],$message);
		$message = str_replace("[email]",$_POST['emailid'],$message);
		$message = str_replace("[ref-fname]",$ref_email[0]['fname'],$message);
		$message = str_replace("[ref-lname]",$ref_email[0]['lname'],$message);
		$message = str_replace("[date]",date('d-m-Y H:i:s'),$message);


		$e_array=array("heading"=>"New Member Registration","msg"=>$message,"contain"=>'');	
		$message=email_template_one($e_array);
		$list = array($admin_email[0]['emailid'],$ref_email[0]['emailid']);

		sendemail(FROM_EMAIL,getconfigMeta('comanyname').' New Member',$list,$message);
		// $this->email->from(FROM_EMAIL);
		// $this->email->to($list);
		// $this->email->subject('NLLSYS New Member');
		// $this->email->message($message);
		// $this->email->send();
	}

	function send_verify_code($usercode){
		$result = $this->rg_model->get_member_detail_by_code($usercode);
		$arr		=	array('access_name'=>'after_registration','usercode'=>$result[0]['referralid']);
		//$arr		=	array('pagelable'=>'after_registration','usercode'=>2);

		$email_html	=	$this->rg_model->get_email_html_by_access_name($arr);
		
		$ref_email=$this->rg_model->get_member_detail_by_code($result[0]['referralid']);
		
		$now 	= 	time();
		$nowdt	=	unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$key	=	rand(1000,100000000).time();
		
		$message = $email_html['html'];	
		$message = str_replace("[fname]",$result[0]['fname'],$message);
		$message = str_replace("[lname]",$result[0]['lname'],$message);
		$message = str_replace("[email]",$result[0]['emailid'],$message);
		$message = str_replace("[ref-fname]",$ref_email[0]['fname'],$message);
		$message = str_replace("[ref-lname]",$ref_email[0]['lname'],$message);
		$message = str_replace("[date]",date('m-d-Y H:i:s'),$message);
		$message = str_replace("[baseurl]",base_url(),$message);
		$message = str_replace("[key]",$key,$message);
		$message = str_replace("[username]",$result[0]['username'],$message);
		$message = str_replace("[password]",$result[0]['password'],$message);
		$message = str_replace("[loginurl]",base_url().'index.php/login',$message);
		//$text = $email_html['html'].'</br></br>';
		$message .= $email_html['admin_contain'];

		/*$e_array=array("heading"=>"Registration To ".getconfigMeta('comanyname'),"msg"=>$message,"contain"=>$text);	
		$message=email_template_one($e_array);*/
		sendemail(FROM_EMAIL,$email_html['subject'],$result[0]['emailid'],$message);

		 //---------------test--------------------
		$data=array();
		$data['usercode']	=	$usercode;
		$data['emailid']	=	$result[0]['emailid'];
		$data['v_key']		=	$key;
		$data['verification_send_date']	= $nowdt;
		$data['send_ip']    =   $_SERVER['REMOTE_ADDR'];
		
		$this->rg_model->addItem($data,'email_verification');

		//
		$arr =	array('access_name'=>'email_verification','usercode'=>$result[0]['referralid']);

		$email_html	=	$this->rg_model->get_email_html_by_access_name($arr);
		
		$ref_email=$this->rg_model->get_member_detail_by_code($result[0]['referralid']);
		
		$key	=	rand(1000,100000000).time();
		$message = $email_html['html'];	
		$message = str_replace("[baseurl]",base_url(),$message);
		$message = str_replace("[key]",$key,$message);
		$message .= $email_html['admin_contain'];
		sendemail(FROM_EMAIL,$email_html['subject'],$result[0]['emailid'],$message);		
	}
	
	
	protected function send_email_to_member($result){
			// $message='<p><h3>Your Login Detail</h3></p>';
			// $message.='<p>Username	:'.$result[0]['username'].'</p>';
			// $message.='<p>Password	:'.$result[0]['password'].'</p>';
			// $message.='<p><a href="'.base_url().'index.php/login" style="color:#00F;">Click Here To Login</a></p>';

			$message = get_email_cms_page_master('nllsys_login_detail')->result()[0]->textdt;
			
			$message = str_replace("[username]",$result[0]['username'],$message);
			$message = str_replace("[password]",$result[0]['password'],$message);
			$message = str_replace("[baseurl]",base_url(),$message);
				
			$e_array=array("heading"=>"Login","msg"=>$message,"msg"=>$message,"contain"=>'');
			$message=email_template_one($e_array);
			sendemail(FROM_EMAIL,getconfigMeta('comanyname').' Login Detail',$result[0]['emailid'],$message);
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($result[0]['emailid']);
			
			// $this->email->subject('NLLSYS Login Detail');
			// $this->email->message($message);
			// $this->email->send();
	}

	public function send_member_registration_email($usercode){
			$result = $this->rg_model->get_member_detail_by_code($usercode);
			$this->send_verify_code($usercode);
			/*$message = get_email_cms_page_master('nllsys_login_detail')->result()[0]->textdt;
			
			$message = str_replace("[username]",$result[0]['username'],$message);
			$message = str_replace("[password]",$result[0]['password'],$message);
			$message = str_replace("[baseurl]",base_url(),$message);
				
			$e_array=array("heading"=>"Login","msg"=>$message,"msg"=>$message,"contain"=>'');
			$message=email_template_one($e_array);
			sendemail(FROM_EMAIL,'Jet Stream Team Login Detail',$result[0]['emailid'],$message);*/

			$username 	= 	$result[0]['username'];
		 	$password	=	$result[0]['password'];
     	 	$result 	= 	$this->login_module->loginsub($username, $password);
     	 	$nowdt=unix_to_human($now, TRUE, 'eu');
			if(count($result)> 0){
				
				
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

	private function set_matrix_session($tbl,$usercode,$session_field, $session_val)
	{
		$result=$this->login_module->get_table_record($tbl,$usercode);
		if(isset($result[0])){
			$this->session->set_userdata($session_field,$session_val);
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
	protected function entry_in_tree($usercode,$uid){
		
			$data=array();
			$data['usercode']			=	$uid;
			
			$set_arr=array('field' => 'uplingmember3_3','position' => 3);
			$this->first_lavel_set($usercode,$set_arr);
			$data['uplingmember3_3']	=	$this->upling_user;
			$data['side_3_3']			=	$this->upling_posi;
			
			$set_arr=array('field' => 'uplingmember5_3','position' => 5);
			$this->first_lavel_set($usercode,$set_arr);
			$data['uplingmember5_3']	=	$this->upling_user;
			$data['side_5_3']			=	$this->upling_posi;
			
			$set_arr=array('field' => 'uplingmember10_3','position' => 10);
			$this->first_lavel_set($usercode,$set_arr);
			$data['uplingmember10_3']	=	$this->upling_user;
			$data['side_10_3']			=	$this->upling_posi;
			$this->rg_model->addItem($data,'member_node_master_free');
			return $data;
		
	}
	
	
    protected function first_lavel_set($eid,$type){
		
		$result	=	$this->rg_model->get_usercode_by_tree($eid,$type['field']);
		
		///level One Setting///
		if(count($result)<$type['position']){
			$this->upling_user = $eid;
			$this->upling_posi = count($result)+1;
			return;	
		}
		
		for($i=0;$i<count($result);$i++){
			
			$arr[]=$result[$i]['usercode'];
			
		}
		$this->tree_check_postion($arr,$type);
	}
	
	
	
	protected function tree_check_postion($arr_mem, $type){
		
		for($pos=0;$pos<$type['position'];$pos++){
			
			for($i=0;$i<count($arr_mem);$i++){
				
				$result=$this->rg_model->get_count_by_tree($arr_mem[$i],$type['field']);
				
				if($result[0]['tot']<$pos+1){
				
					$this->upling_user = $arr_mem[$i];
					$this->upling_posi = $result[0]['tot']+1;
					return;		
				}
			
			}
		}
		
		
		
		/////
		$child_mem=array();
		for($i=0;$i<count($arr_mem);$i++){
			
			$child_mem[]=$this->rg_model->get_usercode_by_tree($arr_mem[$i],$type['field']);			
			
		}
		
		
		$re_arr=array();
		for($pos=0;$pos<$type['position'];$pos++){
			
			for($i=0;$i<count($child_mem);$i++){
				
				$re_arr[]=$child_mem[$i][$pos]['usercode'];					
			
			}
		}
		
		$this->tree_check_postion($re_arr,$type);
		
	}
	
	

	/////////////////////
	
	function level_update($arr)
	{
		$data3['usercode']	=	$arr['usercode'];
		$this->rg_model->addItem($data3,'member_level_track_master_free');
		
		
		$level_two3		=	$this->rg_model->get_upling_member($arr['uplingmember3_3'],'uplingmember3_3');
		$level_three3	=	$this->rg_model->get_upling_member($level_two3[0]['upling'],'uplingmember3_3');
		
		$level_two5		=	$this->rg_model->get_upling_member($arr['uplingmember5_3'],'uplingmember5_3');
		
		$level_three5	=	$this->rg_model->get_upling_member($level_two5[0]['upling'],'uplingmember5_3');
		
		
		$level_two10	=	$this->rg_model->get_upling_member($arr['uplingmember10_3'],'uplingmember10_3');
		
		$level_three10	=	$this->rg_model->get_upling_member($level_two10[0]['upling'],'uplingmember10_3');
		
		//*****3by3 level update*****//
	
		$this->rg_model->member_level_track_update($arr['uplingmember3_3'],'level_one3','active_level_one3');
		$this->rg_model->member_level_track_update($level_two3[0]['upling'],'level_two3','active_level_two3');
		$this->rg_model->member_level_track_update($level_three3[0]['upling'],'level_three3','active_level_three3');
		
		//*****5by3 level update*****//
		$this->rg_model->member_level_track_update($arr['uplingmember5_3'],'level_one5','active_level_one5');
		$this->rg_model->member_level_track_update($level_two5[0]['upling'],'level_two5','active_level_two5');
		$this->rg_model->member_level_track_update($level_three5[0]['upling'],'level_three5','active_level_three5');
		
		//*****10by3 level update*****//
		$this->rg_model->member_level_track_update($arr['uplingmember10_3'],'level_one10','active_level_one10');
		$this->rg_model->member_level_track_update($level_two10[0]['upling'],'level_two10','active_level_two10');
		$this->rg_model->member_level_track_update($level_three10[0]['upling'],'level_three10','active_level_three10');
		
		//system level tree update
		$result		=		$this->rg_model->get_system_level($arr['uplingmember3_3'],'system_level_3');
		$level['system_level_3']=$result[0]['level']+1;
		$result		=		$this->rg_model->get_system_level($arr['uplingmember5_3'],'system_level_5');
		$level['system_level_5']=$result[0]['level']+1;
		$result		=		$this->rg_model->get_system_level($arr['uplingmember10_3'],'system_level_10');
		$level['system_level_10']=$result[0]['level']+1;
		$this->rg_model->update($level,'member_level_track_master_free','usercode',$arr['usercode']);	
		//exit;
	}
	
	function coded_residual($usercode)
	{	
		$ref_user		=	$this->rg_model->get_user_reffral($usercode);
		$referralid 	=	$ref_user[0]['referralid'];
		$tot=$this->rg_model->get_total_reffral($referralid);
		if($tot[0]['tot'] > 2)
		{
			$data['usercode']		=	$usercode;
			$data['type']			=	'coded';
			$data['usercode_by']	=	$referralid;
			$data['adminfee']		=	'0';
			$this->rg_model->addItem($data,'coded_residual_free');
			$coded_match_usercode	=	$this->rg_model->get_user_reffral($referralid);
			$coded_match_usercode 	=	$coded_match_usercode[0]['referralid'];
			$data['usercode']		=	$usercode;
			$data['type']			=	'coded_match';
			$data['usercode_by']	=	$coded_match_usercode;
			$this->rg_model->addItem($data,'coded_residual_free');
		}//end if
		else{
			$ref=$this->rg_model->get_coded_residual($referralid); 
			if(isset($ref[0])){
				if($ref[0]['type']=='residual'){
					$data['level']		=	$ref[0]['level']+1;
				}
				$data['usercode']		=	$usercode;
				$data['type']			=	'residual';
				$data['usercode_by']	=	$ref[0]['ucode'];
				$this->rg_model->addItem($data,'coded_residual_free');
			}
			
			$ref=$this->rg_model->get_coded_match_residual_match($referralid);
			if(isset($ref[0]))
			{
				if($ref[0]['type']=='residual_match'){
					$data['level']		=	$ref[0]['level']+1;
				}
				$data['usercode']		=	$usercode;
				$data['type']			=	'residual_match';
				$data['usercode_by']	=	$ref[0]['ucode'];
				
				$this->rg_model->addItem($data,'coded_residual_free');

			}
			//exit;
		}//end else
	}

	
	
	
	//**************************************************************************************************//
	
	
	function free_daily_payment_level_update($level)
	{
		
		$commission1	=	$this->rg_model->get_setting_value_by_lable('virtual_balance_level1');
		$commission2	=	$this->rg_model->get_setting_value_by_lable('virtual_balance_level2');
		$commission3	=	$this->rg_model->get_setting_value_by_lable('virtual_balance_level3');
		$pay=array($commission1[0]['setting_value'],$commission2[0]['setting_value'],$commission3[0]['setting_value']);	
		$pay_tree=array('3by3','5by3','10by3');
		$pay_real=array('exp3by3','exp5by3','exp10by3');
		
		$free['usercode']	=	$level['usercode'];
		$this->rg_model->addItem($free,'master_balance_sheet_free');
		
		//**Three By Three Level Update**//
		$ucode=$level['usercode'];
		for($i=1;$i<=3;$i++)
		{
			$p=$i-1;
			$result	=	$this->rg_model->get_upling_member($ucode,'uplingmember3_3');
			if(!isset($result[0]['upling'])){break;}
			
			$free['tree3_'.$i.'']=$result[0]['upling'];
			$ucode=$result[0]['upling'];
			$this->rg_model->member_free_dailypayment_update($result[0]['upling'],$pay_tree[$p],$pay_real[$p],$pay[$p]);
			
		}
		//**Five By Three Level Update**//
		$ucode=$level['usercode'];
		for($i=1;$i<=3;$i++)
		{
			$p=$i-1;
			$result	=	$this->rg_model->get_upling_member($ucode,'uplingmember5_3');
			if(!isset($result[0]['upling'])){	break;	}
			$free['tree5_'.$i.'']=$result[0]['upling'];
			$ucode=$result[0]['upling'];
			//$this->rg_model->member_free_dailypayment_update($result[0]['upling'],'5by3','exp5by3',$pay[$p]);
		}
		//**Ten By Three Level Update**//
		$ucode=$level['usercode'];
		for($i=1;$i<=3;$i++)
		{
			$p=$i-1;
			$result	=	$this->rg_model->get_upling_member($ucode,'uplingmember10_3');
			if(!isset($result[0]['upling'])){	break;	}
			$free['tree10_'.$i.'']=$result[0]['upling'];
			$ucode=$result[0]['upling'];
			//$this->rg_model->member_free_dailypayment_update($result[0]['upling'],'10by3','exp10by3',$pay[$p]);
		}
		$this->rg_model->addItem($free,'daily_payment_level_free');
	}
	
	function smfund_insert($usercode){
		$data	=	array();
		$data['usercode']	=	$usercode;
		$data['referralid']	=	$this->input->post('referralid');
		$data['date_dt']	=	date('Y-m-d');
		$this->rg_model->addItem($data,'smfund_member');
	}	
	function embed(){
		if(!isset($_REQUEST['r']) || $_REQUEST['r']==''){
			$ref='admin';
		}
		else{
			$ref=$_REQUEST['r'];
		}
		$data['ref']=$this->rg_model->get_user_by_username($ref);
		$data['result']=$this->rg_model->get_contain();
		$this->load->view('embed_view',$data);	
	}
	
//-------------All Function for Add Multiplier Free Tree.------------------------//

	protected function get_position($code){
		
		$result			=	$this->rg_model->get_downline_record($code);
		
		//****Level First Check****//
		if(count($result)< 2){
			
			$this->upling_user = $code;
			
			$this->upling_posi = count($result)+1;
			
			return;	
		}
		
		//****Set Member For Second Level****//
		for($i=0;$i<count($result);$i++){
			
			$arr[]=$result[$i]['idcode'];
			
		}
		//****Call Function To Check Next Level****//
		$this->tree_check_position($arr);
		
	}

	//****Check Position******//
	protected function tree_check_position($arr_mem){
		
		//****Check Position******//

		for($pos=0;$pos<2;$pos++){
			
			for($i=0;$i<count($arr_mem);$i++){
				
				
				
				$result=$this->rg_model->get_countdownline($arr_mem[$i]);
				
				if($result[0]['tot']<$pos+1){
				
					$this->upling_user = $arr_mem[$i];
					
					$this->upling_posi = $result[0]['tot']+1;
					
					return;		
					
				}
			
			}
		}
		
		
		//****Next Level Member Get******//
		$child_mem=array();
		
		for($i=0;$i<count($arr_mem);$i++){
			
			$child_mem[]=$this->rg_model->get_downline_record($arr_mem[$i]);			
			
		}
		
		
		//****Next Level Member Set By Position******//
		$re_arr=array();
		
		for($pos=0;$pos<2;$pos++){
			
			for($i=0;$i<count($child_mem);$i++){
				
				$re_arr[]=$child_mem[$i][$pos]['idcode'];					
			
			}
		}
		
		
		//****Function Call To Check Again******//
		$this->tree_check_position($re_arr);
		
	}

	//this function is use for get total downline member count//
	function get_total_downline($uid)
	{
		$result=$this->rg_model->get_downline_record($uid);
		
		for($i=0;$i<count($result);$i++){
			
			$this->tot_downline++;
			
			$this->get_total_downline($result[$i]['idcode']);
			
		}
	}
	function get_top_third_member($id)
	{
		$upling		=	$this->rg_model->get_tree_record($id);
		
		$upling		=	$this->rg_model->get_tree_record($upling[0]['upling_id']);
		
		$upling		=	$this->rg_model->get_tree_record($upling[0]['upling_id']);
		
		$upling		=	$this->rg_model->get_tree_record($upling[0]['upling_id']);
		
		
		if(isset($upling[0])){
			if($upling[0]['upling_id']!='0'){
				 $upling[0]['third']=true;		
			}	
			else {
				$upling[0]['third']=false;
			}
		}else{
			$upling[0]['third']=false;
		}
		
		return $upling[0];
		
	}
	protected function payment_insert($arr){
		$data=array();
		$data['usercode']		=	$arr['usercode'];
		$data['amount']			=	$arr['amount'];
		$data['position']		=	$arr['position'];
		$data['wallet_type']	=	$arr['wallet_type'];
		$data['timedt']			=	time();
		$this->rg_model->addItem($data,''.MATRIX_TABLE_PRE.'member_payment_free');
		
	}

	
}

