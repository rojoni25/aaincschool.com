<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class message extends CI_Controller {
	
	
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		
		$this->load->library('email');
 	}
	
	public function send($eid)
	{
		$data['result'] = $this->comman_fun->get_table_data('membermaster',array('usercode'=>$eid));
		
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(VMA_FOLDER.'message_send',$data);
		$this->load->view('comman/footer');
	}
	
	function insert(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			
			$result 			= $this->comman_fun->get_table_data('membermaster',array('usercode'=>$_POST['usercode']));
			
			$data=array();
			$data['usercode']	=	$_POST['usercode'];
			$data['EndCode']	=	'0';
			$data['subject']	=	$_POST['subject'];
			$data['msg']		=	$_POST['msg'];
			$data['status']		=	'Active';
			$data['timedt']		=	date('Y-m-d H:i:s');
			$data['read']		=	'N';
			$this->comman_fun->addItem($data,'vma_send_message');
			
			
			if($result[0]['email_verification']){
				$e_array=array("heading"=>$_POST['subject'],"msg"=>$_POST['msg'],"contain"=>'');
				$message	=  	email_template_one($e_array);
				
				// $this->email->from(FROM_EMAIL);
				// $this->email->subject($_POST['subject']);
				// $this->email->message($message);
				// $this->email->to($result[0]['emailid']);
				// $this->email->send();
				sendemail(FROM_EMAIL,$_POST['subject'],$result[0]['emailid'],$message);

			}
			
			
			
			$this->session->set_flashdata('show_msg','Message Send Successfully');
		}
		header('Location: '.vma_base().$this->uri->rsegment(1).'/send/'.$_POST['usercode']);
		exit;		
	}
	
	
	
	
	
	
	
	
}

