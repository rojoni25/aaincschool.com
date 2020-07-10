<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class upgrade_request_send_by_admin extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('upgrade_request_send_by_admin_model','ObjM',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
 	}
	

	function index()
	{
		if($_POST['user_code']!=''){
			$data['result'] = $this->ObjM->get_member_by_id($_POST['user_code']);
			$data['request'] = $this->ObjM->check_request($_POST['user_code']);
		}
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('upgrade_request_send_by_admin_add',$data);
		$this->load->view('comman/footer');
	}
	
	function insert_request(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			$data['usercode']	=	$_POST['usercode'];
			$data['status']		=	'Active';
			$data['st_view']	=	"N";
			$data['timedt']		=	time();
			$data['option']		=	'By Admin';
			if($_POST['payment']=='Y'){
				$data['payment']		=	'Y';
				$data['payment_dt']		=	$nowdt;
			}
			else{
				$data['payment']		=	'N';
			}
			$this->ObjM->addItem($data,'paid_request_master');
			$this->session->set_flashdata('show_msg', 'Request Insert Successfully');
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
			exit;
			
		}
	}
	
	function auto_camplate_active(){
		$filter = preg_replace('/\s\s+/', ' ',$_GET["term"]);
		$filter=explode(" ",$filter);
		$user=$this->ObjM->get_user_filter_active($filter);
	
		$json=array();
		for($i=0;$i<count($user);$i++){
			$name=$user[$i]['fname'].' '.$user[$i]['lname'].' ('.$user[$i]['usercode'].')';
			$json[]=array(
				'label'=>$name,
				'value'=>$user[$i]['usercode']
        	);
		}
		echo json_encode($json);
	}
	
	
	
	
	
	
	
	
}

