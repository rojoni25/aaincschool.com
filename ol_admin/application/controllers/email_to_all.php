<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class email_to_all extends CI_Controller {
	protected $table		=	'country_master';
	protected $primary_key	=	'country_code';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('email_to_all_model','ObjM',TRUE);
		$this->load->library('email');
 	}
	
	public function index()
	{
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view');
		$this->load->view('comman/footer');
	}
	
	
	////////////////
	function listing()
	{
		$result=$this->email_outbox_model->getAll();
		$html='';
		for($i=0;$i<count($result);$i++)
		{
			$html .='<tr class="'.$status.'">
						<td><input type="checkbox" value="'.$result[$i]['send_mail_code'].'" class="recode_status_code"></td>
						<td>'.ago_time($result[$i]['timedt']).'</td>
						<td>'.$result[$i]['subject'].'</td>
						<td>'.$result[$i]['tot_send'].'</td>
						<td><a href="'.base_url().'index.php/'.$this->uri->segment(1).'/Addnew/Edit/'.$result[$i]['send_mail_code'].'" class="edit_rcd">
								<i class="icon-pencil"></i>
							</a>
						</td>
              		</tr>';
		}
		
		echo $html;
			
	}
	////////////////
	
	
	
	
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
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			$receiver_dt  = $this->input->post('emailid');
    		$data['subject']		=	$this->input->post('subject');	
			$data['msg']			=	$this->input->post('msg');
			$data['timedt']			=	$nowdt;	
			$data['sender_code']	=	'-1';
			$data['tot_send']=count($receiver_dt);
			$send_mail_code=$this->ObjM->addItem($data,'send_mail_master');
		
		}
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}
	
	
	function record_update(){
		$data=array();
		$data['status']=$this->uri->segment(3);
		$code=explode('M',$this->uri->segment(4));
		for($i=0;$i<count($code);$i++){
			if($code[$i]!=''){
				$this->ObjM->update($data,$this->table,$this->primary_key,$code[$i]);	
			}
		}
		
		
	}
}

