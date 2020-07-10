<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profile extends CI_Controller {
	protected $table		=	'membermaster';
	protected $primary_key	=	'usercode';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('profile_model','',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
 	}
	
	public function index()
	{
		$data['contain']=$this->profile_model->get_pages_contain_two('member_profile_page');
		$data['result']=$this->profile_model->get_record();
		$data['country']=$this->profile_model->get_country();

		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add');
		$this->load->view('comman/footer');
	}
	
	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
			
    		$data['fname']			=	$this->input->post('fname');	
			$data['lname']			=	$this->input->post('lname');
			$data['dob']			=	$this->input->post('dob');	
			$data['gender']			=	$this->input->post('gender');	
			$data['addresslineone']			=	$this->input->post('addresslineone');	
			$data['addresslinetwo']			=	$this->input->post('addresslinetwo');	
			$data['city']			=	$this->input->post('city');			
			$data['state']			=	$this->input->post('state');			
			$data['zip_code']	=	$this->input->post('zip_code');	
			$data['emailid']	=	$this->input->post('emailid');		
			$data['mobileno']		=	$this->input->post('mobileno');	
			$data['phone_no']		=	$this->input->post('phone_no');	
			$data['bank_account_branchId']	=	$this->input->post('bank_account_branchId');	
			$data['country_code']	=	$this->input->post('country_code');
			$data['bank_account_bankAccountPurpose']	=	$this->input->post('bank_account_bankAccountPurpose');
			$data['wire_account_bankAccountId']	=	$this->input->post('wire_account_bankAccountId');
			$data['wire_account_bankId']	=	$this->input->post('wire_account_bankId');
			
			$data['twitter_link']	=	$this->input->post('twitter_link');	
			$data['linkedin_link']	=	$this->input->post('linkedin_link');	
			$data['googleplus_link']=	$this->input->post('googleplus_link');	
			$data['youtube_link']	=	$this->input->post('youtube_link');	
			$data['facebook_link']	=	$this->input->post('facebook_link');
			$data['paypal']			=	$this->input->post('paypal');
			$data['square']			=	$this->input->post('square');
			$data['google_wallet']	=	$this->input->post('google_wallet');
			$data['facebook']		=	$this->input->post('facebook');
			$data['stripe']			=	$this->input->post('stripe');
			$data['btc']			=	$this->input->post('btc');	
			$data['skype']			=	$this->input->post('skype');	
			$data['payzapay']		=	$this->input->post('payzapay');	
			$data['solidtrustpay']	=	$this->input->post('solidtrustpay');
			$data['suffix']			=	$this->input->post('suffix');
			$data['royaltie']			=	$this->input->post('royaltie');
			
			$data['update_date']	=	$nowdt;	
			
			$files = $_FILES;
			$config = array();
    		$config['upload_path'] = 'upload/user_img';
    		$config['allowed_types'] = 'gif|jpg|png|jpeg';
    		$config['max_size']      = '0';
    		$config['overwrite']     = TRUE;
			
			if($files['post_img']['name'])
			{
				
				
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
				
				$usersession=$this->session->userdata['logged_ol_member'];
				$usersession['user_img']=$fileName;
				
				$this->session->set_userdata('logged_ol_member', $usersession);  
			
			}	
			
			$this->profile_model->update($data,$this->table,$this->primary_key,$this->session->userdata['logged_ol_member']['usercode']);		
			
		}
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}


	
	function check_email(){
		
		if($this->uri->segment(3)==''){
			exit;
		}
		$rt=$this->profile_model->check_email($this->uri->segment(3));		
		if(isset($rt[0])){
			echo '1';
		}
	}
	
	
	
}

