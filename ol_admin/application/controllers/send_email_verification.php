<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class send_email_verification extends CI_Controller {
	protected $table		=	'membermaster';
	protected $primary_key	=	'usercode';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1' && $this->session->userdata['logged_in_visa']['user_type_id']!='2' && $this->session->userdata['logged_in_visa']['user_type_id']!='3'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('send_email_verification_model','ObjM',TRUE);
		$this->load->library('email');
		
 	}
	
	public function index()
	{
		$data['send_result']=$this->ObjM->get_send_all_varification();
		
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view',$data);
		$this->load->view('comman/footer');
	}
	
	
	function listing_active(){
		$result=$this->ObjM->getAll_active();
		$count=$this->ObjM->get_tot_count();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		
		for($i=0;$i<count($result);$i++){
			
			$varification='';
			$varification='<a class="send_mail_cls" href="'.base_url().'index.php/'.$this->uri->segment(1).'/send_verification/'.$result[$i]['usercode'].'">Send Email Verification</a><span class="show_msg"></span>';
			
			$row = array(
					$result[$i]['usercode'],
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['username'],
					$result[$i]['password'],
					$result[$i]['emailid'],
					$varification
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );
	}
	
	
	
	
	
	
		function send_verification($usercode){
				$result = $this->ObjM->get_user_by_id($usercode);
				$email_html	=	$this->ObjM->get_email_html_by_access_name('after_registration');
			
				$b_url	= base_url();
				$b_url = str_replace("ol_admin/", "", $b_url);
				
				$now = time();
				$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
				$key=rand(1000,100000000).time();
				// $message='<p><h3>Email Verification</h3></p>';
				// $message.='<p>Name		:'.$result[0]['fname'].' '.$result[0]['lname'].'</p>';
				// $message.='<p>Username	:'.$result[0]['username'].'</p>';
				// $message.='<p>Email		:'.$result[0]['emailid'].'</p>';
				// $message.='<p><a href="'.$b_url.'index.php/home/email_verification/'.$key.'">Click here To Email Verify</a></p>';
				$message = get_email_cms_page_master('email_verification')->result()[0]->textdt;
				$message = str_replace("[fname]",$result[0]['fname'],$message);
				$message = str_replace("[lname]",$result[0]['lname'],$message);
				$message = str_replace("[email]",$result[0]['emailid'],$message);
				$message = str_replace("[username]",$result[0]['username'],$message);
				$message = str_replace("[baseurl]",str_replace('ol_admin/', '', base_url()),$message);
				$message = str_replace("[key]",$key,$message);
				
				$e_array=array("heading"=>"Email Verification","msg"=>$message,"contain"=>$email_html[0]['email_text']);
				$message=email_template_one($e_array);
				
				// $this->email->from(FROM_EMAIL);
				// $this->email->to($result[0]['emailid']);
				// $this->email->subject('Email Verification');
				// $this->email->message($message);
				$resp_code=sendemail(FROM_EMAIL, 'Email Verification', $result[0]['emailid'], $message);
				
				if($resp_code>=200 && $resp_code<=299) //$this->email->send()
				{
					$data=array();
					$data['usercode']	=	$usercode;
					$data['emailid']	=	$result[0]['emailid'];
					$data['v_key']		=	$key;
					$data['verification_send_date']	= $nowdt;
					$data['send_ip']    =   $_SERVER['REMOTE_ADDR'];
					$this->ObjM->addItem($data,'email_verification');
					$show_msg="Send Successfully";
				}
				else{
					$show_msg="Send Failed";
				}
				echo $show_msg;
								
		}
		
		function send_varification_to_all(){
			$check=$this->ObjM->check_varification_active();
			if(!$check[0]){
				$data=array();
				$data['time_dt']	=	time();
				$data['tot_send']	=	'0';
				$data['status']		=	'Active';
				$this->ObjM->addItem($data,'send_email_verification_all');
				$this->session->set_flashdata('show_msg', 'Record Insert Successfully');	
			}
			else{
				$this->session->set_flashdata('show_msg', 'Failed ! One Record Already Pending');	
			}
			
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
			exit;
		}
		
		function delele_record($id)
		{
			$data=array();
			$data['status']='Delete';
			$this->ObjM->update($data,'send_email_verification_all','id',$id);
		}

		// create by nikhil 2 15 18
		function listing_active_to_verify_all(){

			$result=$this->ObjM->getAll_unverified_member();
			foreach ($result as $key => $value) {
				$usercode= $value['usercode'];
				$email_html	=	$this->ObjM->get_email_html_by_access_name('after_registration');
			
				$b_url	= base_url();
				$b_url = str_replace("ol_admin/", "", $b_url);
				
				$now = time();
				$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
				$key=rand(1000,100000000).time();
				// $message='<p><h3>Email Verification</h3></p>';
				// $message.='<p>Name		:'.$result[0]['fname'].' '.$result[0]['lname'].'</p>';
				// $message.='<p>Username	:'.$result[0]['username'].'</p>';
				// $message.='<p>Email		:'.$result[0]['emailid'].'</p>';
				// $message.='<p><a href="'.$b_url.'index.php/home/email_verification/'.$key.'">Click here To Email Verify</a></p>';
				$message = get_email_cms_page_master('email_verification')->result()[0]->textdt;
				$message = str_replace("[fname]",$value['fname'],$message);
				$message = str_replace("[lname]",$value['lname'],$message);
				$message = str_replace("[email]",$value['emailid'],$message);
				$message = str_replace("[username]",$value['username'],$message);
				$message = str_replace("[baseurl]",str_replace('ol_admin/', '', base_url()),$message);
				$message = str_replace("[key]",$key,$message);
				
				$e_array=array("heading"=>"Email Verification","msg"=>$message,"contain"=>$email_html[0]['email_text']);
				$message=email_template_one($e_array);
				
				// $this->email->from(FROM_EMAIL);
				// $this->email->to($result[0]['emailid']);
				// $this->email->subject('Email Verification');
				// $this->email->message($message);
				$resp_code=sendemail(FROM_EMAIL, 'Email Verification', $value['emailid'], $message);
				if($resp_code>=200 && $resp_code<=299) //$this->email->send()
				{
					$data=array();
					$data['usercode']	=	$usercode;
					$data['emailid']	=	$value['emailid'];
					$data['v_key']		=	$key;
					$data['verification_send_date']	= $nowdt;
					$data['send_ip']    =   $_SERVER['REMOTE_ADDR'];
					$this->ObjM->addItem($data,'email_verification');
					$show_msg="Send Successfully";
				}
				else{
					$show_msg="Send Failed";
				}
			}
			echo $show_msg.' (Total: '.count($result).')';
		}
		
	
}

