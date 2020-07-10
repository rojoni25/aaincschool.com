<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class auto_responder_email extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		//---------------------smfund---------------------
		//if(($smfund_admin_valid)||($this->session->userdata['logged_smfund_member'])){header('Location: '.smfund().'welcome/view');exit;}
		//---------------------smfund---------------------
		$this->load->model('auto_responder_email_model','ObjM',TRUE);
		$this->load->library('email');
		$this->load->library("asm_class");
		
 	}
	
	public function index()
	{
		$data['html']=$this->listing();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	function listing()
	{
		$result=$this->ObjM->getAll();
	//echo "<pre>";	print_r($result); exit();
		$html='';
		for($i=0;$i<count($result);$i++){
			
			
			$html .='<tr class="'.$status.'">
						<td>'.$result[$i]['dispaly_name'].'</td>
						<td>'.$result[$i]['email_subject'].'</td>
						<td>
						<a href="'.base_url().'index.php/'.$this->uri->segment(1).'/Addnew/Edit/'.$result[$i]['email_code'].'" class="edit_rcd"><button class="btn-warning btncls" type="button">Edit</button></a>
						</td>
              		</tr>';
		}
		
		return $html;
	}
	
	function addnew()
	{
		
		$data['result']=$this->ObjM->get_record($this->uri->segment(4));
	
		//print_r($data); exit();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add',$data);
		$this->load->view('comman/footer');
	}

	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			 
			$data['email_subject']			=	$_POST['email_subject'];
			$data['email_html']				=	$_POST['textdt'];	
			$data['email_code']				=	$this->input->post('eid');	
			$data['usercode']				=	$this->session->userdata['logged_ol_member']['usercode'];	
			
			$this->ObjM->delete_record($this->input->post('eid'));
			
			
			$this->ObjM->addItem($data,'email_html_auto_responder');
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
			exit;
			
		}
	}
	
	
	function record_update()
	{
		$data=array();
		$data['status']='Delete';	
		$this->ObjM->update($data,'capture_page_master','email_code',$this->uri->segment(3));	
	}

	
}

