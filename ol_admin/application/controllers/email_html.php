<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class email_html extends CI_Controller {
	protected $table		=	'email_html';
	protected $primary_key	=	'email_code';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;}  
		$this->load->model('email_html_model','ObjM',TRUE);
 	}
	
	public function index()
	{
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view');
		$this->load->view('comman/footer');
	}
	
	
	function listing()
	{
		$result=$this->ObjM->getAll();
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
		
			echo $html;
	}
	
	function addnew()
	{
		if($this->uri->segment(3)=='Edit'){
			$data['result']=$this->ObjM->get_record($this->uri->segment(4));
		}

		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add',$data);
		$this->load->view('comman/footer');
	}

	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			 
			$data['email_subject']			=	$_POST['email_subject'];
			$data['email_text']				=	$_POST['textdt'];	
			$data['admin_contain']			=	$_POST['admin_contain'];	
			
			$this->ObjM->update($data,'email_html','email_code',$this->input->post('eid'));
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
			exit;
			
		}
	}
	
	
	
	function remove_ptag($contain){
		return str_replace(array('<p>','</p>'),'',$contain);
	}
	function make_safe($contain) 
	{
		$contain = strip_tags(mysql_real_escape_string(trim($contain)));
		return $contain; 
	}
	
	function record_update()
	{
		$data=array();
		$data['status']='Delete';	
		$this->ObjM->update($data,'capture_page_master','email_code',$this->uri->segment(3));	
	}
	
	
	
}

