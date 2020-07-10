<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ad_email extends CI_Controller {

	protected $admin='123';
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 	
		if(!$this->comman_fun->check_record('dreem_student_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
			header('Location: '.base_url());exit;
		}
		$this->load->model('dreem_student/ad_module','ObjM',TRUE); 
		$this->load->library('email');
 	}
	
	
	function to_member($eid){
		
		$data['ref_url']	=	$_SERVER['HTTP_REFERER'];
		
		$data['result']=$this->comman_fun->get_table_data('membermaster',array('usercode'=>$eid));
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('dreem_student/admin/send_email_to_member',$data);
		$this->load->view('comman/footer');	
	}
	
	function send_to_member(){
		if($this->input->server('REQUEST_METHOD') === 'POST'){
			$result		=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$_POST['eid']));
			if(isset($result)){
				$e_array=array("heading"=>$_POST['subject'],"msg"=>$_POST['msg'],"contain"=>'');	
			    $message=email_template_one($e_array);
			
				// $this->email->from(FROM_EMAIL);
				// $this->email->to($result[0]['emailid']);
				// $this->email->subject('Dreem Student');
				// $this->email->message($message);
				// $this->email->send();
				sendemail(FROM_EMAIL,'Dreem Student',$result[0]['emailid'],$message);
			}
		}
		
		if($_POST['ref_url']!=''){
			header('Location: '.$_POST['ref_url']);
			exit;
		}else{
			header('Location: '.base_url().'index.php/dreem_student/ad_dashboard');
			exit;
		}
		
	}
	
	
	
	function send_all(){
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('dreem_student/admin/send_email_to_add',$data);
		$this->load->view('comman/footer');	
	}
	
	function send_to_all(){
		if($this->input->server('REQUEST_METHOD') === 'POST'){
			
			$e_array	=	array("heading"=>$_POST['subject'],"msg"=>$_POST['msg'],"contain"=>'');	
			$message	=	email_template_one($e_array);
			
			$email_list		=	$this->get_all_email_list();
			$email_list		=	array_chunk($email_list,10);
			
			for($i=0;$i<count($email_list);$i++){
				$list=implode(', ',$email_list[$i]);
				// $this->email->from(FROM_EMAIL);
				// $this->email->to($list);
				// $this->email->subject('Dreem Student');
				// $this->email->message($message);
				// $this->email->send();
				sendemail(FROM_EMAIL,'Dreem Student',$list,$message);
			}
		}
		
		header('Location: '.base_url().'index.php/dreem_student/ad_dashboard');
		exit;
	}
	
	function get_all_email_list(){
		$result	=	$this->ObjM->member_list2();
		$arr=array();
		for($i=0;$i<count($result);$i++){
			$arr[]=$result[$i]['emailid'];
		}
		return $arr;
	}
	
	
}


