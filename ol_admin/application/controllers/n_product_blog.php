<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class n_product_blog extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('n_product_blog_module','ObjM',TRUE);
		
 	}
	
	public function my_blog()
	{
	
		$data['result']=$this->ObjM->get_my_blog();	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('n_product_myblog',$data);
		$this->load->view('comman/footer');
	
	}
	
	function add_new($mode,$eid)
	{
		
			$data['seg_value']=array('mode'=>$mode,'eid'=>$eid);
			$data['result']=$this->ObjM->get_blog_by_id($eid);
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('n_product_myblog_add',$data);
			$this->load->view('comman/footer');	
		
		
	}
	
	function insert_blog()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			
    		$data['title']			=	$this->input->post('title');	
			$data['description']	=	$this->input->post('description');
			$data['status']			=	$this->input->post('status');
			
			if($this->input->post('mode')=='Add'){
				$data['usercode']			=	'-1';
				$data['create_date']		=	time();
				$this->ObjM->addItem($data,'n_product_blog');
				
				$this->session->set_flashdata('show_msg', 'Blog Add Successfully');
				
			}else{
				$data['update_date']		=	time();	
				$this->ObjM->update($data,'n_product_blog','id',$this->input->post('eid'));
				$this->session->set_flashdata('show_msg', 'Blog Update Successfully');
			}
		}
		
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/my_blog');
		exit;
		
	}
	
	function delete_blog($eid)
	{
		$data=array();
		$data['status']			=	'Delete';
		$data['update_date']	=	time();
		$this->ObjM->delete_blog($data,$eid);
	}
	 
	
	
	
	
	
	

	
}


