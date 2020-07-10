<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class email_inbox extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
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
			if($result[$i]['sender_code']=='-1' || $result[$i]['sender_code']=='0')
			{
				$sender_code='-';
				$sender_name='Admin';	
			}
			else
			{
				$sender_code	=	$result[$i]['sender_code'];
				$sender_name	=	$result[$i]['fname'].' '.$result[$i]['lname'];	
			}
			$dt = date('F d', strtotime($result[$i]['timedt']));
			$html .='<tr class="'.$status.'">
						<td>'.$sender_code.'</td>
						<td>'.$sender_name.'</td>
						<td>'.$dt.'  <sub>'.ago_time($result[$i]['timedt']).'</sub></td>
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
		
		if($data['result'][0]['receive_status']=='N')
		{
			$info['receive_status']='Y';
			$this->email_inbox_model->update($info,'send_mail_dt','send_mail_dtcode',$this->uri->segment(3));
		}
	
		if($data['result'][0]['sender_code']=='-1')
		{
			$admin_email=$this->email_inbox_model->get_admin_email();
			
			$data['sender_name']='Admin';
			$data['sender_email']=$admin_email[0]['emailid'];
		}
		else{
			$data['sender_code']='('.$data['result'][0]['sender_code'].')';
			$data['sender_name']=$data['result'][0]['fname'].' '.$data['result'][0]['lname'];
			$data['sender_email']=$data['result'][0]['emailid'];
		}
		
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

