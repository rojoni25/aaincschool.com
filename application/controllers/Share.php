<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Share extends CI_Controller {
	protected $table		=	'country_master';
	protected $primary_key	=	'country_code';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('view_friends_model','',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
		
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
		$result		=$this->view_friends_model->getAll();
		
		$html='';
		for($i=0;$i<count($result);$i++){
		
			if($result[$i]['status']=='Inactive'){ $status='st_inactive';}
			else{$status='';}
			$verification=($result[$i]['email_verification']=='N'? "NO" : "YES");
			
			$html .='<tr class="'.$status.'">
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['mobileno'].'</td>
						<td>'.$result[$i]['emailid'].'</td>
						<td><strong>'.$verification.'</strong></td>
              		</tr>';
		}
		
			echo $html;
		
	}

	function invitefriends()
	{
		if(isset($_REQUEST['page']))
		{
			$data['b_url']	= base_url().'index.php/capture/page/'.$_REQUEST['page'].'/'.$this->session->userdata['logged_ol_member']['username'].'';
		}
		else
		{
			$data['b_url']	= base_url().'index.php/rg/?r='.$this->session->userdata['logged_ol_member']['username'].'';
		}
		$data['current_url']=$this->get_the_current_url();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('invite_friend',$data);
		$this->load->view('comman/footer');
	}
	
	
	function invitefriends_insertrecord()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			
			$data['h_name']			=	$this->input->post('invite_name');
			$data['h_contact']		=	$this->input->post('invite_contact');
			$data['h_notes']		=	$this->input->post('invite_notes');

			$data['invite_emailid']	=	$this->input->post('invite_emailid');
			$data['subject']		=	$this->input->post('subject');
			$data['message']		=	$this->input->post('message');
			$data['usercode']		=	$this->session->userdata['logged_ol_member']['usercode'];
			$data['timedt']			=	$nowdt;	
			$data['status']			=	'Active';
			$data['pagecode']		=	$this->input->post('pagecode');
			$data['send_url']		=	$this->input->post('current_url');
	
			$id=$this->view_friends_model->addItem($data,'invite_friend_master');

			//get invite user data
			$invite_user_data = $this->view_friends_model->get_invite_friend_master($id);

		
			//$emailid	=	'thecoachmark@gmail.comy';
			$emailid	=	$this->session->userdata['logged_ol_member']['emailid'];
			$to 		= 	$this->input->post('invite_emailid');
			$subject 	= 	$this->input->post('subject');
			$message 	= 	$this->input->post('message');
			$headers 	= 	"MIME-Version: 1.0" . "\r\n";
			$headers 	.= 	"Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers 	.=  'From: Test <'.$emailid.'>' . "\r\n";
			$email_contain	=	$this->view_friends_model->get_email_contain();

			//sed mail to join user
			if (strpos($this->input->post('ref_link'), '?') !== false) {
				$appendstring = '&';
			}else{
				$appendstring = '?'; 
			}
			$e_array=array("heading"=>"Join Jet Stream Team","msg"=>$message,"link"=>$this->input->post('ref_link').$appendstring.'refer_friend=true&id='.$id,"contain"=>$email_contain[0]['textdt']);
			$message=email_template_join($e_array);

			sendemail($emailid,$subject,$to,$message);


			//send mail to invite user
			$to_emailid = $this->view_friends_model->getEmailId();
			$email_contain_ref	=	$this->view_friends_model->get_email_contain_ref();

			// $user_invite_emailid = $invite_user_data[0]['invite_emailid'];
			// $user_send_url = $invite_user_data[0]['send_url'];
			// $user_pagecode = $invite_user_data[0]['pagecode'];
			// $user_timedt = $invite_user_data[0]['timedt'];
			
			$e_array=array("heading"=>"Join Jet Stream Team-invite copy","msg"=>"Invitation To User","contain"=>$email_contain_ref[0]['textdt'],"user_invite_emailid"=>$invite_user_data[0]['invite_emailid'],"user_send_url"=>$invite_user_data[0]['send_url'],"user_timedt"=>$invite_user_data[0]['timedt']);
			

			$message2=send_email_template_join_ref($e_array);

			sendemail(FROM_EMAIL,'Copy: '."Join request",$to_emailid,$message2);		
				
		}
		header('Location: '.$_POST['current_url']);
		exit;
	}
	
	function remove_ptag($contain){
		return str_replace(array('<p>','</p>'),'',$contain);
	}
	
	// function invite_friends_status()
	// {
	// 	$result		= $this->view_friends_model->getAllByStatus();
	// 	$this->load->view('view_friends_view',$result);
	// }
	
	
	function invite_friends_history()
	{
		$data['result']		=	$this->view_friends_model->invite_friends_history();
		$data1['table_list']=true;
		$this->load->view('comman/topheader',$data1);
		$this->load->view('comman/header');
		$this->load->view('invite_friends_history',$data);
		$this->load->view('comman/footer');
    }

    function invite_analytics($id){
    	
    	$data['friend_view']		=	$this->view_friends_model->invite_friends_history_id($id);
    	
    	if(!isset($data['friend_view']['invite_friend_code'])){
    		exit;
    	}
    	$data['analytics_list']		=	$this->view_friends_model->invite_friends_analytics_list($id);
		$data1['table_list']=true;
		$this->load->view('comman/topheader',$data1);
		$this->load->view('comman/header');
		$this->load->view('invite_friends_analytics',$data);
		$this->load->view('comman/footer');
    }
	
	function get_the_current_url() 
	{
		$protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
		$complete_url =   $base_url . $_SERVER["REQUEST_URI"];    
		return $complete_url;
    }		
}