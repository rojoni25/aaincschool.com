<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class view_friends extends CI_Controller {
	protected $table		=	'country_master';
	protected $primary_key	=	'country_code';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
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
			
			$verification=($result[$i]['email_verification']=='N' ? "NO" : "YES");
			
			$html .='<tr class="'.$status.'">
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['mobileno'].'</td>
						<td>'.$result[$i]['emailid'].'</td>
						<td><strong>'.$verification.'</strong></td>
						<td>&nbsp;
							<a href="'.base_url().'index.php/comman_controler/member_details_view/'.$result[$i]['username'].'" class="edit_rcd">
								<i class="icon-eye-open"></i>
							</a>
						</td>
              		</tr>';
		}
		
			echo $html;
		
	}
	
	
		function invitefriends(){
		$data['result']=$this->view_friends_model->get_admin_dt();
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
			
			$data['invite_emailid']	=	$this->input->post('invite_emailid');	
			$data['subject']		=	$this->input->post('subject');
			$data['message']		=	$this->input->post('message');
			$data['usercode']		=	$this->session->userdata['logged_in_visa']['usercode'];
			$data['timedt']			=	$nowdt;	
			$data['status']			=	'Active';
			$id=$this->view_friends_model->addItem($data,'invite_friend_master');
			

			$emailid	=	'thecoachmark@gmail.com';
			$to 		= 	$this->input->post('invite_emailid');
			$subject 	= 	$this->input->post('subject');
			$message 	= 	'<p>'.$this->input->post('message').'</p>';
			$message   .= 	'<p><a href="'.$this->input->post('ref_link').'">Join Us</a></p>';
			$headers 	= 	"MIME-Version: 1.0" . "\r\n";
			$headers 	.= 	"Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers 	.= 'From: Test <'.$emailid.'>' . "\r\n";
			mail($to,$subject,$message,$headers);
			
	        	
		}
		header('Location: '.base_url().'index.php/view_friends/invitefriends/?success=true');
		exit;
	}
	
	function invite_friends_history()
	{
		$data['result']		=	$this->view_friends_model->invite_friends_history();
		$data1['table_list']=true;
		$this->load->view('comman/topheader',$data1);
		$this->load->view('comman/header');
		$this->load->view('invite_friends_history',$data);
		$this->load->view('comman/footer');
    
    }

		
	
}

