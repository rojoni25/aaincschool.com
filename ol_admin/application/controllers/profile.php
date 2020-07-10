<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profile extends CI_Controller {
	protected $table		=	'admin_login';
	protected $primary_key	=	'usercode';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('profile_model','',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library('form_validation');
 	}
	
	public function index()
	{
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
			
    		$data['fname']=$this->input->post('fname');	
			$data['lname']=$this->input->post('lname');	
			$data['username']=$this->input->post('username');
			$data['country_code']=$this->input->post('country_code');	
			$data['emailid']=$this->input->post('emailid');	
			$data['suffix']=$this->input->post('suffix');	
			$data['mobileno']=$this->input->post('mobileno');	
			$data['phone_no']=$this->input->post('phone_no');	
			$data['skype']=$this->input->post('skype');	
			$data['payzapay']=$this->input->post('payzapay');	
			$data['solidtrustpay']=$this->input->post('solidtrustpay');
			$data['gender']=$this->input->post('gender');	

			$data['paypal']			=	$this->input->post('paypal');
			$data['skrill']			=	$this->input->post('skrill');
			
			$data['twitter_link']	=	$this->input->post('twitter_link');	
			$data['linkedin_link']	=	$this->input->post('linkedin_link');	
			$data['googleplus_link']=	$this->input->post('googleplus_link');	
			$data['youtube_link']	=	$this->input->post('youtube_link');	
			$data['facebook_link']	=	$this->input->post('facebook_link');
			$data['btc']			=	$this->input->post('btc');
			
			//$data['profile_pri_code']=$this->input->post('profile_pri_code');
			
			$files = $_FILES;
			$config = array();
    		$config['upload_path'] = './upload/profile_flag';
    		$config['allowed_types'] = 'gif|jpg|png|jpeg';
    		$config['max_size']      = '0';
    		$config['overwrite']     = FALSE;
			
			if($files['post_img']['name']){
				
				$_FILES['userfile']['name'] 	= 	$files['post_img']['name'];
        		$_FILES['userfile']['type'] 	= 	$files['post_img']['type'];
        		$_FILES['userfile']['tmp_name']	= 	$files['post_img']['tmp_name'];
        		$_FILES['userfile']['error']	= 	$files['post_img']['error'];
        		$_FILES['userfile']['size']		= 	$files['post_img']['size']; 
				$image_info 	= getimagesize($_FILES['userfile']['tmp_name']);
				$image_width 	= $image_info[0];
				$image_height 	= $image_info[1];
				
				//if($image_width < 500 || $image_height < 550){
					//header('Location: '.base_url().'index.php/product_master/addnew/Add/er');
					//exit;
				//}
				
				$rand=rand(100000,100000000);
				$fileName=$rand.$_FILES['post_img']['name'];
				$fileName = str_replace(" ","",$fileName);
        		$config['file_name'] = $fileName;
    			$this->upload->initialize($config);
    			$this->upload->do_upload();
				$data['profile_flag']	=	$fileName;
			
			}	
			
				
			if($this->input->post('mode')=="Add"){
				
				$data['create_date']	=	$nowdt;	
				$profile_code=$this->profile_model->addItem($data,$this->table);
			}
			if($this->input->post('mode')=="Edit"){
				$data['update_date']	=	$nowdt;	
				$this->profile_model->update($data,$this->table,$this->primary_key,$this->input->post('eid'));	
				
			}
		}
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}
	
	
	function record_update(){
		$data=array();
		$data['status']=$this->uri->segment(3);
		$code=explode('M',$this->uri->segment(4));
		for($i=0;$i<count($code);$i++){
			if($code[$i]!=''){
				$this->profile_model->update($data,$this->table,$this->primary_key,$code[$i]);	
			}
		}
	}
	
	function member_profile($eid){
		
		$data['result']	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$eid));
		$data['country']=	$this->comman_fun->get_table_data('country_master',array('status'=>'Active'));
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('member_profile_add',$data);
		$this->load->view('comman/footer');
	}
	
	function insert_member_profile(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			
			$this->form_validation->set_rules('fname', 'First Name', 'required|trim');
			$this->form_validation->set_rules('lname', 'Last Name', 'required|trim');
			$this->form_validation->set_rules('emailid', 'Email Id', 'required|trim');
			$this->form_validation->set_rules('mobileno', 'Mobile Number', 'required|trim');
			$this->form_validation->set_rules('username', 'Username', 'required|trim|callback_handle_username|min_length[5]');
			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]');
			
			
			if($this->form_validation->run() == FALSE)
        	{
            	$this->member_profile($_POST['eid']);
        	}
        	else
        	{
            	$this->_insert_member_profile();
				header('Location: '.base_url().'index.php/'.$this->uri->segment(1).'/member_profile/'.$_POST['eid'].'');
				exit;
       	 	}
				
		}
	}
	
	protected function _insert_member_profile()
	{
		$data = array();
		$data['fname']			=	$this->input->post('fname');	
		$data['lname']			=	$this->input->post('lname');	
		$data['country_code']	=	$this->input->post('country_code');	
		$data['emailid']		=	$this->input->post('emailid');	
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
		$data['btc']			=	$this->input->post('btc');
		$data['username']		=	$this->input->post('username');
		$data['password']		=	$this->input->post('password');

		$data['paypal']			=	$this->input->post('paypal');
		$data['skrill']			=	$this->input->post('skrill');

		$this->comman_fun->update($data,'membermaster',array('usercode'=>$_POST['eid']));	
		$this->session->set_flashdata('show_msg', 'Member Profile Update Successfully');
	}
	
	function handle_username(){
		
		if($this->comman_fun->check_record('membermaster',array('usercode !='=>$_POST['eid'],'username'=>$_POST['username'])))
   		{
      		$this->form_validation->set_message('handle_username', 'Username Already Exist');
      		return FALSE;
   		} 
		
		return true;
		
	}
	
	
	
	
}

