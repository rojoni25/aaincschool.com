<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class n_product extends CI_Controller {

	protected $loginname="3N6u5uK49HxD";
	protected $transactionkey="28e897sNj583NwS9";
	protected $host = "api.authorize.net";
	protected $path = "/xml/v1/request.api";
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		//---------------------smfund---------------------
		//if(($smfund_admin_valid)||($this->session->userdata['logged_smfund_member'])){header('Location: '.smfund().'welcome/view');exit;}
		//---------------------smfund---------------------
		
		$this->load->model('n_product_module','ObjM',TRUE);
		
 	}
	
	public function index()
	{
		if($this->asm_class->check_in_tree())
		{
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('n_product_dashboard',$data);
			$this->load->view('comman/footer');
		}
		else{	
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view(''.$this->uri->segment(1).'_view',$data);
			$this->load->view('comman/footer');	
		}
	}
	
	
	function subscription($product)
	{
		header('location: '.base_url().'index.php/auto_pages/page/ams_payment_info');
		exit;
		if($product=='2')
		{
			$data['product']		=	'2';
			$data['header_title']	=	'AMS Subscribe ($100)';
			$data['amount']			=	'100.00';
			$page_name='paid_product_detail2';
			
		}else
		{
			$data['product']		=	'1';
			$data['header_title']	=	'AMS Subscribe ($15)';
			$data['amount']			=	'15.00';
			$page_name='paid_product_detail1';
			
		}
		
		$data['result']=$this->ObjM->get_pages_contain($page_name);
	
	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('n_product_subscribe_add',$data);
		$this->load->view('comman/footer');
		
	}
	
	function detail($product)
	{
		if($product=='2')
		{
			$data['product']		=	'2';
			$data['header_title']	=	'AMS Subscribe ($100)';
			$data['amount']			=	'100.00';
			$page_name='paid_product_detail2';
			
		}else
		{
			$data['product']		=	'1';
			$data['header_title']	=	'AMS Subscribe ($15)';
			$data['amount']			=	'15.00';
			$page_name='paid_product_detail1';
			
		}
		
		$data['result']=$this->ObjM->get_pages_contain($page_name);
	
	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('n_product_subscribe_add',$data);
		$this->load->view('comman/footer');
		
	}
	
	
	function training($page){
		
		if($page=='1')
		{
			if($this->asm_class->check_product(1))
			{
				$data['result']=$this->ObjM->get_pages_contain('n_product_training_15');	
			}
		}
		if($page=='2')
		{
			if($this->asm_class->check_product(2))
			{
				$data['result']=$this->ObjM->get_pages_contain('n_product_training_100');	
			}
		}
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('n_product_detail',$data);
		$this->load->view('comman/footer');
	}
	
	
	function auto_camplate()
	{
		$filter = preg_replace('/\s\s+/', ' ',$_GET["term"]);
		$filter=explode(" ",$filter);
		$user=$this->ObjM->get_user_filter($filter);
	
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


