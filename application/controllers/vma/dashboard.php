<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->library('vma_class');
		if(!$this->vma_class->check_in_tree()){
			header('Location: '.base_url().'/index.php/welcome');
			exit;	
		}
 	}
	
	public function view()
	{
		
		if($this->vma_class->check_unqulified($this->session->userdata['logged_ol_member']['usercode'])){
				
				if(!$this->session->userdata['vma_business_info']){
					$result  = $this->comman_fun->get_table_data('vma_business_info',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
					if(!isset($result[0])){
						header('Location: '.vma_base().'dashboard/business_info');
						exit;
					}
				}
				
				$data['payment']=$this->vma_class->main_balance();
				$this->load->view('comman/topheader',$data);
				$this->load->view('comman/header');
				$this->load->view(VMA_FOLDER.'dashboard_view',$data);
				$this->load->view('comman/footer');		
				
		}else{
		
				$data['result']		=	$this->comman_fun->get_table_data('cms_pages_master',array('pagelable'=>'vma_due_payment'));
				$data['dt']  		=   $this->comman_fun->get_table_data('vma_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
				$this->load->view('comman/topheader',$data);
				$this->load->view('comman/header');
				$this->load->view(VMA_FOLDER.'payment_due_view',$data);
				$this->load->view('comman/footer');	
		}
	}
	
	
	
	protected function check_due(){
		$timedt=strtotime(date('d-m-Y'));
		$result  = $this->comman_fun->get_table_data('vma_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
		
		if($result[0]['due_time']<$timedt){
			return false;	
		}else{
			return true;
		}
		
	}
	
	function business_info(){
		
		
		$this->session->set_userdata('vma_business_info',true);
	
		$data['result'] = $this->comman_fun->get_table_data('vma_business_info',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(VMA_FOLDER.'business_info_view',$data);
		$this->load->view('comman/footer');			
	}
	
	function insert_info_business(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			
			$result  = $this->comman_fun->get_table_data('vma_business_info',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
			
			$data['name']			=	$_POST['name'];
			$data['link']			=	$_POST['link'];
			$data['description']	=	$_POST['description'];
			$data['business_info']	=	$this->get_business_info();
			$data['timedt']			=	date('Y-m-d H:i:s');
			
			if(!isset($result[0])){
				$data['usercode']		=	$this->session->userdata['logged_ol_member']['usercode'];
				$this->comman_fun->addItem($data,'vma_business_info');
			}else{
				$this->comman_fun->update($data,'vma_business_info',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']));
					
			}
			
			header('Location: '.vma_base().'dashboard/view');
			exit;
		
		}
	}
	
	protected function get_business_info(){
			$business	=	$_POST['business'];
			$arr=array();
			for($i=0;$i<count($business);$i++){
				$arr[]=$business[$i];		
			}
			return json_encode($arr);
	}
	
	function test(){
		$arr['1'] = $this->vma_class->count_member_on_level1();
		$arr['2'] = $this->vma_class->count_member_on_level2();
		$arr['3'] = $this->vma_class->count_member_on_level3();
		
		var_dump($arr);
		
		
		
	}
 	
	
}

