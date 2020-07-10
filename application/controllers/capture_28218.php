<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class capture extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		$this->load->model('capture_model','ObjM',TRUE); 
 	}
		
	function page($pagecode='',$refcode='')
	{
		
		$data['result']			=	$this->ObjM->get_page_contain();
		if($refcode!='')
		{
			$data['ref']		=	$this->ObjM->get_user_by_username($refcode);
		}
		
		$data['current_join']=$this->get_currect_add_member();
		$data['current_join_mem']=$this->get_currect_join_member();
		$data['pagecode']	=	$this->uri->segment(3);
		if($this->is_page_vaild($data['result'][0],$data['ref'][0])){
			$page_list =  array("page4","page5","page6","page7","page8","page11","page12","page19","page20","page25","page26","page27","page28");
			if (in_array($data['result'][0]['pagecode'], $page_list)){
					$this->load->view('public/capture/check_width');
			}
			$this->load->view('public/capture/'.$data['result'][0]['pagecode'].'', $data);
			
		}else{
			$this->load->view('public/page_not_found');
		}

		$invite_data['created_at'] = date('Y-m-d H:i:s');
		$invite_data['invite_code'] = $_GET['id'];		
		$invite_analytics_id = $this->ObjM->addInviteAnalytics('invite_analytics',$invite_data);
		
		// get data  for sponsor and user email id
		$invite_data['analytics_list']		=$this->ObjM->invite_friends_analytics_list_emailId($invite_analytics_id);

			//send mail after click join url link
			$emailid	=	'thecoachmark@gmail.com';
			$to 		= 	$invite_data['analytics_list'][0]['emailId'];
			$subject 	= 	"Visit Invitation Link";
			$message 	= 	"User visite to your invitation link";
			$headers 	= 	"MIME-Version: 1.0" . "\r\n";
			$headers 	.= 	"Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers 	.=  'From: Test <'.$emailid.'>' . "\r\n";
			$email_contain	=	$this->ObjM->get_email_contain_visit_invitation_link();

			//sed mail to join user
			
			$e_array=array("heading"=>"Join Affiliworx",
				"msg"=>$message,
				"contain"=>$email_contain[0]['textdt'],
				"user_invite_emailid"=>$invite_data['analytics_list'][0]['invite_emailid'],
				"user_send_url"=>$invite_data['analytics_list'][0]['send_url'],
				"user_timedt"=>$invite_data['analytics_list'][0]['timedt']);

			$message=email_template_join_visit_invitation_link($e_array);

			sendemail(FROM_EMAIL,$subject,$to,$message);


		//print_r($invite_data['analytics_list'][0]['emailId']); exit();
		
	}
	
	// protected function is_page_vaild($page_info,$ref_info){
	
	// 	if($page_info['usercode']!='0'){
	// 		return ($page_info['usercode']==$ref_info['usercode']) ? true : false;
	// 	}
	// 	else{
	// 		if($page_info['page_for']=='registered'){
	// 			if($ref_info['status']!='Active'){
	// 				return $this->ObjM->get_product_access_permission($ref_info['usercode']);
	// 			}else{
	// 				return true;
	// 			}
				
	// 		}
	// 		if($page_info['page_for']=='both'){ return true; }
	// 	}
		
	// }


	protected function is_page_vaild($page_info,$ref_info){
		
		if($page_info['usercode']!='0'){
			return ($page_info['usercode']==$ref_info['usercode']) ? true : false;
		}
		else{
			if($page_info['page_for']=='registered'){
				if($ref_info['status']!='Active'){
					return $this->ObjM->get_product_access_permission($ref_info['usercode']);
				}else{
					return true;
				}
			}

			else if($page_info['page_for']=='inactive'){
				if($ref_info['status']!='Inactive'){
					return $this->ObjM->get_product_access_permission($ref_info['usercode']);
				}else{
					return true;
				}
			}

			else if($page_info['page_for']=='free'){
				if($ref_info['status']!='Pending'){
					return $this->ObjM->get_product_access_permission($ref_info['usercode']);
				}else{
					return true;
				}
			}

			else if($page_info['page_for']=='paid'){
				if($ref_info['status']!='Pending'){
					return $this->ObjM->get_product_access_permission($ref_info['usercode']);
				}else{
					return true;
				}
			}
			
			if($page_info['page_for']=='both'){ return true; }
		}
		
	}
	
	
	function request_page_view($pagecode='',$refcode=''){
		
		$data['result']		=	$this->ObjM->get_page_capture_request();
	
		if($refcode!='')
		{
			$data['ref']		=	$this->ObjM->get_user_by_username($refcode);
		}
		
		
		$data['after_reg_new_tab'] = isset($_POST['after_reg_new_tab']) ? $_POST['after_reg_new_tab'] : "N";

		$data['after_reg_new_tab_op'] = isset($_POST['after_reg_new_tab_op']) ? $_POST['after_reg_new_tab_op'] : "N";

		$data['pagecode']	=	$this->uri->segment(3);
		
		$this->load->view('public/capture/'.$data['result'][0]['pagecode'].'', $data);
		
	}
	
	function preview_after()
	{
		$data['result']			=	$this->ObjM->get_page_contain();

		$data['after_reg_new_tab'] = isset($_POST['after_reg_new_tab']) ? $_POST['after_reg_new_tab'] : "N";

		$data['after_reg_new_tab_op'] = isset($_POST['after_reg_new_tab_op']) ? $_POST['after_reg_new_tab_op'] : "N";

		
		$data['current_join']=$this->get_currect_add_member();
		$data['current_join_mem']=$this->get_currect_join_member();
		$data['pagecode']	=	$this->uri->segment(3);
		$this->load->view('public/capture/'.$data['result'][0]['pagecode'].'', $data);
		
	}
	
	
	function page_priview()
	{

		$data['after_reg_new_tab'] = isset($_POST['after_reg_new_tab']) ? $_POST['after_reg_new_tab'] : "N";

		$data['after_reg_new_tab_op'] = isset($_POST['after_reg_new_tab_op']) ? $_POST['after_reg_new_tab_op'] : "N";


		$data['current_join']		=	$this->get_currect_add_member();
		$data['current_join_mem']	=	$this->get_currect_join_member();
		$data['result']				=	$this->ObjM->get_page_contain_priview();
		$data['master']				=	$this->ObjM->get_master_page_recore($data['result'][0]['pagecode']);
	
		
		$this->load->view('public/capture/'.$data['result'][0]['pagecode'].'', $data);
		
	}
	
	function existuser()
	{
		$data['contain']	=	$this->ObjM->get_page_text('user_exist');
		$this->load->view('public/capture/user_exist', $data);
	}
	
	function mf($pagecode='',$refcode='')
	{

		$data['result']			=	$this->ObjM->get_page_contain();
		
		if($refcode!='')
		{
			$data['ref']		=	$this->ObjM->get_user_by_username($refcode);
		}
		
		$data['pagecode']	=	$pagecode;
		if($this->is_page_vaild($data['result'][0],$data['ref'][0])){
			$data['master']				=	$this->ObjM->get_master_page_by_name($data['result'][0]['pagecode']);
			$this->load->view('public/capture/mobile_form',$data);	
		}else{
			$this->load->view('public/page_not_found');
		}
		
		
	}
	
	function dummy($pagecode='',$refcode='')
	{
				$this->load->view('public/capture/'.$this->uri->segment(3));
	}
	
	
	
	protected function get_currect_add_member()
	{
		$result=$this->ObjM->get_currect_add_member();
		$list=array();	
		for($i=0;$i<count($result);$i++){
			$list[]=ucwords(strtolower($result[$i]['name']));
		}
		$p=implode(', ',$list);
		return $convert = str_replace(",", "<br>", $p);
	}
	
	protected function get_currect_join_member()
	{
		$result=$this->ObjM->get_currect_add_member();
		$list=array();	
		for($i=0;$i<count($result);$i++){
			$list[]=ucwords(strtolower($result[$i]['name']));
		}
		$p=implode(', ',$list);
		return $p=implode(', ',$list);
	}
	
	function m2m($page,$refcode){
		
		if($refcode!='')
		{
			$data['ref']		=	$this->ObjM->get_user_by_username($refcode);	
		}
		
		
		if($page=='1'){
			$page	=	'page1';	
		}
		else if($page=='2'){
			$page	=	'page2';	
		}
		else if($page=='4'){
			$page	=	'page4';	
		}
		else if($page=='5'){
			$page	=	'page5';	
		}
		//test
		else if($page=='6'){
			$page	=	'page6';	
		}
		else{
			$page	=	'page3';	
		}
	
		
		
		
		if($this->comman_fun->check_record('m2m_member',array('usercode'=>$data['ref'][0]['usercode']))){
				$data['pagecode']	=	$this->uri->segment(3);
				$data['current_join_mem']=$this->get_currect_join_member();
				$this->load->view('public/capture/check_width');
				$this->load->view('public/capture/m2m/'.$page.'', $data);	
		}else{
			echo 'Invaied Request';
		}
	
	
	}
	
	//------------------------dfsm---------------------------------------
	function m2m_new($eid,$refcode){
		if($refcode!='')
		{
			$data['ref']		=	$this->ObjM->get_user_by_username($refcode);	
		}
	
		$data['result'] = $this->comman_fun->get_table_data('m2m_capture_master',array('status !='=>'Delete','page_code'=>$eid));	
		if(!isset($data['result'][0])){
			echo 'Invalid Request !';
			exit;
		}
	
		if($this->comman_fun->check_record('m2m_member',array('usercode'=>$data['ref'][0]['usercode']))){
				$data['pagecode']	=	$this->uri->segment(3);
				$data['current_join_mem']=$this->get_currect_join_member();
				$this->load->view('public/capture/check_width');
				$this->load->view('public/capture/m2m/page6', $data);	
		}else{
			echo 'Invalid Request';
		}
	} 
	
	//------------------------dfsm---------------------------------------
	
	
}

