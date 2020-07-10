<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class email_inbox extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('email_inbox_model','',TRUE);
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
	
	function listing(){
		$result=$this->email_inbox_model->getAll();
		$html='';
		for($i=0;$i<count($result);$i++)
		{
			$html .='<tr class="'.$status.'">
						<td>'.$result[$i]['sender_code'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.ago_time($result[$i]['timedt']).'</td>
						<td>'.$result[$i]['subject'].'</td>
						<td><a href="'.base_url().'index.php/'.$this->uri->segment(1).'/view/'.$result[$i]['send_mail_dtcode'].'">
								<i class="icon-eye-open"></i>
							</a>
						</td>
              		</tr>';
		}
		
		echo $html;
	}
	
	function view()
	{
		
		$data['result']=$this->email_inbox_model->get_record($this->uri->segment(3));
		if(count($data['result'])!=1){ $this->go_to_back();}
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('email_detail_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	
	function record_update(){
		$data=array();
		$data['status']=$this->uri->segment(3);
		$code=explode('M',$this->uri->segment(4));
		for($i=0;$i<count($code);$i++){
			if($code[$i]!=''){
				$this->email_inbox_model->update($data,'send_mail_master','send_mail_code',$code[$i]);	
			}
		}
		
	}
	
	function go_to_back(){
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}
}

