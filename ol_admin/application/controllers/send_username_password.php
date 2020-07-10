<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class send_username_password extends CI_Controller {
	protected $table		=	'membermaster';
	protected $primary_key	=	'usercode';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1' && $this->session->userdata['logged_in_visa']['user_type_id']!='2' && $this->session->userdata['logged_in_visa']['user_type_id']!='3'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('send_username_password_model','ObjM',TRUE);
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
	
	
	
	function listing_active(){
		$result=$this->ObjM->getAll_active();
		$count=$this->ObjM->get_tot_count_active();
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $count[0]['tot'],
			"iTotalDisplayRecords" => ''.$count[0]['tot'].'',
			"aaData" => array()
		);
		
		for($i=0;$i<count($result);$i++){
			
			if($result[$i]['email_verification']=='N'){
				$varification='<li><a class="send_mail_cls" href="'.base_url().'index.php/'.$this->uri->segment(1).'/send_verification/'.$result[$i]['usercode'].'">Send Email Verification</a></li>';
				$cls='btn-danger';
			}
			else{
				$varification='';
				$cls='btn-success';
			}
			
			$edit='<div class="btn-group">
							<button data-toggle="dropdown" class="btn '.$cls.' dropdown-toggle">Opration <span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a class="send_mail_cls" href="'.base_url().'index.php/'.$this->uri->segment(1).'/sendmail/'.$result[$i]['usercode'].'">Send</a></li>
								<li><a href="'.base_url().'index.php/'.$this->uri->segment(1).'/change_pass/'.$result[$i]['usercode'].'">Change Password</a></li>
								'.$varification.'
							</ul>
						</div><span class="show_msg"></span>';
			
			$row = array(
					$result[$i]['usercode'],
					$result[$i]['fname'].' '.$result[$i]['lname'],
					$result[$i]['username'],
					$result[$i]['password'],
					$result[$i]['emailid'],
					$edit
			);
			$output['aaData'][] = $row;
		}
		echo json_encode( $output );
	}
	
	function sendmail($eid)
	{
		$result=$this->ObjM->get_user_by_id($eid);
		
		$b_url	= base_url();
		$b_url = str_replace("ol_admin/", "", $b_url);
		
		$message='<p><h3>Login Details NLLSYS</h3></p>';
		$message.='<p>Username	:'.$result[0]['username'].'</p>';
		$message.='<p>Password	:'.$result[0]['password'].'</p>';
		$message.='<p><a href="'.$b_url.'">Click Hear</a></p>';
		
		$e_array=array("heading"=>"Login Details","msg"=>$message);
		$message=email_template_one($e_array);
		
		// $this->email->from(FROM_EMAIL);
		// $this->email->to($result[0]['emailid']);
		// $this->email->subject('Your password Reset sucessfully');
		// $this->email->message($message);
		// $this->email->send();
		//if($this->email->send()){
		//error_reporting(E_ALL);
		$resp_code=sendemail(FROM_EMAIL, 'Your password Reset sucessfully', $result[0]['emailid'], $message);
		if($resp_code>=200 && $resp_code<=299){
			$show_msg="Send Successfully";
		}
		else{
			$show_msg="Send Failed";
		}	
		
		echo $show_msg;
	}
	function change_pass()
	{
		$data['result'] = $this->ObjM->get_user_by_id($this->uri->segment(3));
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('member_change_password_add',$data);
		$this->load->view('comman/footer');
	}
	
	function change_pass_insert()
	{
		$data['password']=$this->input->post('new_pass');
		$this->ObjM->update($data,'membermaster','usercode',$this->input->post('eid'));
		header('Location: '.base_url().'index.php/send_username_password');
		exit;
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
				$message = str_replace("[key]",$key,$message);
				$message = str_replace("[baseurl]",str_replace('ol_admin/', '', base_url()),$message);
				
				$e_array=array("heading"=>"Email Verification","msg"=>$message,"contain"=>$email_html[0]['email_text']);
				$message=email_template_one($e_array);
				
				// $this->email->from(FROM_EMAIL);
				// $this->email->to($result[0]['emailid']);
				// $this->email->subject('Email Verification');
				// $this->email->message($message);
				$resp_code=sendemail(FROM_EMAIL, 'Email Verification', $result[0]['emailid'], $message);
				
				if($resp_code>=200 && $resp_code<=299)
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
		
	
}

