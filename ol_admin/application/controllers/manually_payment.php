<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class manually_payment extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('manually_payment_model','',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
 	}
	
	public function index()
	{
		$data['requestcode']=$this->manually_payment_model->get_free_request();	
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add',$data);
		$this->load->view('comman/footer');
	}


	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
    		$data['payment'] 	= 	'Y';
			$data['payment_dt'] = 	time();	
			$this->manually_payment_model->update($data,'paid_request_master','requestcode',$this->uri->segment(3));	
				
		}
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}
	
	function product_access_view()
	{
		$data['member']=$this->manually_payment_model->get_memeber_list_to_access();	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('product_access_view_add',$data);
		$this->load->view('comman/footer');	
	}
	
	function product_access_insert()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$data = array();
    		$data['usercode'] 	= 	$_POST['user_code'];
			$data['timedt'] 	= 	time();	
			$this->manually_payment_model->addItem($data,'product_access_permission');
		}
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/product_access_view');
		exit;	
	}
	
	function delete_permition($eid)
	{	
		$this->manually_payment_model->deleterow($eid);
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/product_access_view');
		exit;
	}
	
	function auto_camplate(){
		$filter = preg_replace('/\s\s+/', ' ',$_GET["term"]);
		$filter=explode(" ",$filter);
		$user=$this->manually_payment_model->get_user_filter($filter);
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

