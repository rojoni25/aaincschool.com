<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rg2 extends CI_Controller {
	protected $table		=	'membermaster';
	protected $primary_key	=	'usercode';
	
	
	protected $upling_user	=	'';
	protected $upling_posi	=	'';
	
	
	function __construct()
 	{
   		parent::__construct();
		$this->load->model('rg_model','',TRUE); 
		$this->load->library('email');
		$this->load->library('form_validation');
 	}
	
	public function index()
	{
		if(!isset($_REQUEST['r']) || $_REQUEST['r']==''){
			$ref='admin';
		}
		else{
			$ref=$_REQUEST['r'];
		}
		$data['ref']=$this->rg_model->get_user_by_username($ref);
		$data['result']=$this->rg_model->get_contain();
		
		$this->load->view('rg_view',$data);	
	}
	
	
	
	
	
	function insertrecord(){
		
		if($this->input->post('referralid')!=''){
		
		
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			
			
			$this->check_duplicate();
			
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			
			if($this->input->post('referralid')==''){
				echo '<script>window.location.href="'.$_SERVER["HTTP_REFERER"].'"</script>';
				exit;
			}
			
			
			
			
    		$data['fname']			 =	$this->input->post('fname');	
			$data['lname']			 =	$this->input->post('lname');	
			$data['username']		 =	$this->input->post('username');
			$data['password']		 =	$this->input->post('password');
			$data['emailid']		 =	$this->input->post('emailid');	
			$data['mobileno']		 =	$this->input->post('mobileno');	
			$data['referralid'] 	 =	$this->input->post('referralid');
			$data['referralid_free'] =	$this->input->post('referralid');
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
				
				
				
				
				if(isset($_POST['redirect_url']) && $_POST['redirect_url']!='')
				{
					$url=$_POST['redirect_url'];
				}
				else{
					$url=base_url().'index.php/pages/reg/'.$_POST['pagecode'].'';
				}
				$this->send_mail_after_registration();
				$this->send_verify_code($usercode);
			////////////////
			header('Location: '.$url);
			exit;			
			
			
		}
	}//check ref
		echo '<script>window.location.href="'.$_SERVER["HTTP_REFERER"].'"</script>';
		exit;
	}
	
	
	
	function succes(){
		$this->load->view('rg_succes');	
	}
	
	function check_duplicate()
	{
		$result=$this->rg_model->check_duplicate($this->input->post('emailid'),'emailid');
		if(isset($result[0]))
		{
				$this->send_email_to_member($result);
				header('Location: '.base_url().'index.php/capture/existuser?r='.$_SERVER["HTTP_REFERER"].'&email='.$this->input->post('emailid'));
				exit;
		}
			
		$result=$this->rg_model->check_duplicate($this->input->post('username'),'username');
		
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
		
		$message='<p>Name	:'.$_POST['fname'].' '.$_POST['lname'].'</p>';
		$message.='<p>Email	:'.$_POST['emailid'].'</p>';
		$message.='<p>Referral	:'.$ref_email[0]['fname'].' '.$ref_email[0]['lname'].'</p>';
		$message.='<p>Date	:'.date('d-m-Y H:i:s').'</p>';
		$e_array=array("heading"=>"New Member Registration","msg"=>$message,"contain"=>'');	
		$message=email_template_one($e_array);
		
		$list = array($admin_email[0]['emailid'],$ref_email[0]['emailid']);
		
		// $this->email->from(FROM_EMAIL);
		// $this->email->to($list);
		// $this->email->subject('NLLSYS New Member');
		// $this->email->message($message);
		// $this->email->send();
		sendemail(FROM_EMAIL,'Jet Stream Team New Member',$list,$message);
	}
	
	function send_verify_code($usercode){
		
		//$arr		=	array('access_name'=>'after_registration','usercode'=>$_POST['referralid']);
		$arr		=	array('pagelable'=>'after_registration','usercode'=>2);

		$email_html	=	$this->rg_model->get_email_html_by_access_name($arr);
		
		$ref_email=$this->rg_model->get_member_detail_by_code($_POST['referralid']);
		
		$now 	= 	time();
		$nowdt	=	unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		$key	=	rand(1000,100000000).time();
			
					
		// $message='<p>Name	:'.$_POST['fname'].' '.$_POST['lname'].'</p>';
		// $message.='<p>Email	:'.$_POST['emailid'].'</p>';
		// $message.='<p>Referral	:'.$ref_email[0]['fname'].' '.$ref_email[0]['lname'].'</p>';
		// $message.='<p>Date	:'.date('d-m-Y H:i:s').'</p>';
		// $message.='<p><a href="'.base_url().'index.php/home/email_verification/'.$key.'">Click here To Email Verify</a></p>';
		$message = get_email_cms_page_master('registration_to_nllsys')->result()[0]->textdt;
		$message = str_replace("[fname]",$_POST['fname'],$message);
		$message = str_replace("[lname]",$_POST['lname'],$message);
		$message = str_replace("[email]",$_POST['emailid'],$message);
		$message = str_replace("[ref-fname]",$ref_email[0]['fname'],$message);
		$message = str_replace("[ref-lname]",$ref_email[0]['lname'],$message);
		$message = str_replace("[date]",date('d-m-Y H:i:s'),$message);
		$message = str_replace("[baseurl]",base_url(),$message);
		$message = str_replace("[key]",$key,$message);
		
		$text = $email_html['html'].'</br></br>';
		$text.= $email_html['admin_contain'];
		
		
		
		$e_array=array("heading"=>"Registration To Jet Stream Team","msg"=>$message,"contain"=>$text);	
		$message=email_template_one($e_array);
		sendemail(FROM_EMAIL,$email_html['subject'],$_POST['emailid'],$message);

		 // $this->email->from(FROM_EMAIL);
		 // $this->email->to($_POST['emailid']);
		 // $this->email->subject($email_html['subject']);
		 // $this->email->message($message);
	  //    $t=$this->email->send();
		 //---------------test--------------------
						//if($t)
				//		{
				//			echo 'mail send';
				//		}
				//		else
				//		{
				//			echo show_error($this->email->print_debugger());
				//		}
				//		exit;
		 //---------------test--------------------
		$data=array();
		$data['usercode']	=	$usercode;
		$data['emailid']	=	$_POST['emailid'];
		$data['v_key']		=	$key;
		$data['verification_send_date']	= $nowdt;
		$data['send_ip']    =   $_SERVER['REMOTE_ADDR'];
		
		$this->rg_model->addItem($data,'email_verification');
		
	}
	
	
	protected function send_email_to_member($result){
			$message='<p><h3>Your Login Detail</h3></p>';
			$message.='<p>Username	:'.$result[0]['username'].'</p>';
			$message.='<p>Password	:'.$result[0]['password'].'</p>';
			$message.='<p><a href="'.base_url().'index.php/login" style="color:#00F;">Click Here To Login</a></p>';
				
			$e_array=array("heading"=>"Login","msg"=>$message,"msg"=>$message,"contain"=>'');
			$message=email_template_one($e_array);
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($result[0]['emailid']);
			// $this->email->subject('NLLSYS Login Detail');
			// $this->email->message($message);
			// $this->email->send();
		sendemail(FROM_EMAIL,'Jet Stream Team Login Detail',$result[0]['emailid'],$message);
	}
	
	protected function entry_in_tree($usercode,$uid){
		
			$data=array();
			$data['usercode']			=	$uid;
			
			$set_arr=array('field' => 'uplingmember3_3','position' => 3);
			$this->first_lavel_set($usercode,$set_arr);
			$data['uplingmember3_3']	=	$this->upling_user;
			$data['side_3_3']			=	$this->upling_posi;;
			
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
	
	
	function rg_test()
	{
		$arr=array('access_name'=>'after_registration','usercode'=>'2');
		$result=$this->rg_model->get_email_html_by_access_name($arr);
		
	}	
}

