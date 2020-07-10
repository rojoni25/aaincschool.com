<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		
		if(!$this->comman_fun->check_record('smfund_member',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode'],'admin'=>'Yes'))){
			header('Location: '.smfund().'welcome/view');
			exit;
		}
		
		$this->load->model('smfund/comman_modul','ObjM',TRUE);

 	}
		
	
	function view(){
		
		$data['result']	=	$this->ObjM->get_member_list();
				
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/member_view',$data);
		$this->load->view('comman/footer');	
		
	}
	
	function friend(){
		
		$data['result']	=	$this->ObjM->get_friend_list();	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/friend_view',$data);
		$this->load->view('comman/footer');	
		
	}
	
	function msg_to_member($eid){
		
		if($this->comman_fun->check_record('smfund_member',array('usercode'=>$eid))){
			$data['result']	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$eid));	
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('smfund/admin/msg_to_member',$data);
			$this->load->view('comman/footer');	
		}
		
	}
	
	function send_message(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			$data['send_by']		=	'0';
			$data['send_to']		=	$_POST['usercode'];
			$data['subject']		=	$_POST['subject'];
			$data['message']		=	$_POST['message'];
			$data['create_date']	=	date('Y-m-d h:i:s');
			$data['status']			=	'No_view'; 
			$this->comman_fun->addItem($data,'smfund_message');	
		}
		
		header('Location: '.smfund().$this->uri->rsegment(1).'/outbox/');
		exit;
	}
	
	function outbox(){
		$data['result']	=	$this->ObjM->get_outbox(0);	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/admin/outbox',$data);
		$this->load->view('comman/footer');
	}
	
	function inbox(){
		$data['result']	=	$this->ObjM->get_inbox(0);	
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('smfund/admin/inbox',$data);
		$this->load->view('comman/footer');
	}
	
	function delete_outbox($eid){
		$data	=	array();
		$data['status']	=	'Delete';
		$this->comman_fun->update($data,'smfund_message',array('id'=>$eid));	
	}
	
	function send_login_detail($eid){
		$this->load->library('email');
		if($this->comman_fun->check_record('smfund_member',array('usercode'=>$eid))){
			$result	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$eid));			
			$arr['heading']	=	'Smfund Your Login Detail';
			// $msg=	'Username : '.$result[0]['username'].' <br> Password : '.$result[0]['username'].'<br>';
			// $msg.=	'URL :<a href="'.base_url().'index.php/login">'.base_url().'index.php/login</a>';

			$msg = get_email_cms_page_master('smfund_your_login_detail')->result()[0]->textdt;
			$msg = str_replace("[username]",$result[0]['username'],$msg);
			$msg = str_replace("[password]",$result[0]['username'],$msg);
			$msg = str_replace("[baseurl]",base_url(),$msg);

			$arr['msg'] =	$msg;
			$message	=		$this->email_html($arr);
			
			// $this->email->from(FROM_EMAIL);
			// $this->email->to($result[0]['emailid']);
			// $this->email->subject('Smfund Your Login Detail');
			// $this->email->message($message);
			// $this->email->send();
			
			sendemail(FROM_EMAIL,'Smfund Your Login Detail',$result[0]['emailid'],$message);
			
		}
	}
	
	
	function email_html($arr){
		$html='<table class="body-wrap" bgcolor="#f6f6f6" style="font-family: Arial, Helvetica, sans-serif; font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 20px;">
		<tr style=" font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
		<td class="container" bgcolor="#FFFFFF" style=" font-size: 100%; line-height: 1.6em; clear: both !important; display: block !important; max-width: 600px !important; Margin: 0 auto; padding: 20px; border: 1px solid #f0f0f0;"><div class="content" style=" font-size: 100%; line-height: 1.6em; display: block; max-width: 600px; margin: 0 auto; padding: 0;">
		<table>
		<tr>
		<td><h2 style="font-family: Arial, Helvetica, sans-serif; font-size: 24px; line-height: 1.2em; color: #111111; font-weight: 200; margin: 5px 0 10px; padding: 0;">'.$arr['heading'].'</h2>
		<p style=" font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">'.$arr['msg'].'</p></td>
		</tr>
		</table>
		</div></td>
		</tr>
		</table>';
		return $html;
	}
	
	
	function edit_member_profile($eid){
		if($this->comman_fun->check_record('smfund_member',array('usercode'=>$eid))){
			$data['result']		=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$eid));	
			
			$this->load->view('comman/topheader');
			$this->load->view('comman/header');
			$this->load->view('smfund/admin/edit_member_profile',$data);
			$this->load->view('comman/footer');
		}
	}
	
	
	
	function insert_profile(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			if($this->comman_fun->check_record('smfund_member',array('usercode'=>$_POST['eid']))){
				$data = array();
	    		$data['fname']			=	$this->input->post('fname');	
				$data['lname']			=	$this->input->post('lname');	
				$data['country_code']	=	$this->input->post('country_code');	
				$data['suffix']			=	$this->input->post('suffix');	
				$data['mobileno']		=	$this->input->post('mobileno');	
				$data['phone_no']		=	$this->input->post('phone_no');	
				$data['skype']			=	$this->input->post('skype');	
				$data['payzapay']		=	$this->input->post('payzapay');	
				$data['solidtrustpay']	=	$this->input->post('solidtrustpay');
				$data['gender']			=	$this->input->post('gender');	
			
				$data['twitter_link']	=	$this->input->post('twitter_link');	
				$data['linkedin_link']	=	$this->input->post('linkedin_link');	
				$data['googleplus_link']=	$this->input->post('googleplus_link');	
				$data['youtube_link']	=	$this->input->post('youtube_link');	
				$data['facebook_link']	=	$this->input->post('facebook_link');
				$data['paypal']			=	$this->input->post('paypal');
				$data['btc']			=	$this->input->post('btc');				
				$data['update_date']	=	date('Y-m-d');	
				
				if($files['post_img']['name']){
						$files = $_FILES;
						$config = array();
						$config['upload_path'] = 'upload/user_img';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size']      = '0';
						$config['overwrite']     = TRUE;
						
						$url1='upload/user_img/'.$this->session->userdata['logged_ol_member']['user_img'];
						$url2='upload/user_thum/'.$this->session->userdata['logged_ol_member']['user_img'];
						unlink($url1);
						unlink($url2);
						$_FILES['userfile']['name'] 	= 	$files['post_img']['name'];
						$_FILES['userfile']['type'] 	= 	$files['post_img']['type'];
						$_FILES['userfile']['tmp_name']	= 	$files['post_img']['tmp_name'];
						$_FILES['userfile']['error']	= 	$files['post_img']['error'];
						$_FILES['userfile']['size']		= 	$files['post_img']['size']; 
						$image_info 	= getimagesize($_FILES['userfile']['tmp_name']);
						$image_width 	= $image_info[0];
						$image_height 	= $image_info[1];
						
						$rand=rand(100000,100000000);
						$fileName=$rand.$_FILES['post_img']['name'];
						$fileName = str_replace(" ","",$fileName);
						$config['file_name'] = $fileName;
						$this->upload->initialize($config);
						$this->upload->do_upload();
						$data['user_img']	=	$fileName;
						
						$upload_data = $this->upload->data();
						$image_config["image_library"] = "gd2";
						$image_config["source_image"] = $upload_data["full_path"];
						$image_config['create_thumb'] = FALSE;
						$image_config['maintain_ratio'] = TRUE;
						$image_config['new_image'] = 'upload/user_thum/'.$fileName;
						$image_config['quality'] = "65%";
						$image_config['width'] = 100;
						$image_config['height'] = 100;
						$this->load->library('image_lib');
						$this->image_lib->initialize($image_config);
						$this->image_lib->resize();			
				}
				
			   
			   $this->comman_fun->update($data,'membermaster',array('usercode'=>$_POST['eid']));		
				
				$this->session->set_flashdata('show_msg', 'Profile Update Successfully');
	
					
			}
			
		}
		header('Location: '.smfund().$this->uri->rsegment(1).'/edit_member_profile/'.$_POST['eid']);
		exit;
	}
	
	
	
	
}

