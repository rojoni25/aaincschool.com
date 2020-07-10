<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class web_setting extends CI_Controller {
	protected $table		=	'site_settings';
	protected $primary_key	=	'setting_id';
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('site_setting_model','',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
 	}
	
	public function index()
	{
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add');
		$this->load->view('comman/footer');
	}
	
	function listing(){
		$result=$this->site_setting_model->getAll();
		$html='';
		for($i=0;$i<count($result);$i++){
			if($result[$i]['status']=='Inactive'){
				$status='st_inactive';
			}
			else{
				$status='';
			}
			
			$html .='<tr class="'.$status.'">
					
						<td>'.$result[$i]['setting_id'].'</td>
						<td>'.$result[$i]['settint_label'].'</td>
						<td>'.$result[$i]['setting_value'].'</td>
						<td><a href="'.base_url().'index.php/'.$this->uri->segment(1).'/Addnew/Edit/'.$result[$i]['setting_id'].'" class="edit_rcd">
								<i class="icon-pencil"></i>
							</a>
						</td>
              		</tr>';
		}
		
			echo $html;
	}
	
	function addnew()
	{
		if($this->uri->segment(3)=='Edit'){
			$data['result']=$this->site_setting_model->get_record($this->uri->segment(4));
		}
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add',$data);
		$this->load->view('comman/footer');
	}
	
	function insertrecord(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$now = time();
			$nowdt=unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
			$data = array();
    		$data['comanyshortname']=$this->input->post('comanyshortname');	
    		$data['comanyname']=$this->input->post('comanyname');	
    		$data['email']=$this->input->post('email_id');	
    		$data['phone']=$this->input->post('phone_no');	
    		$data['skype']=$this->input->post('skype');	
    		$data['facebook_link']=$this->input->post('facebook_link');	
    		$data['instagram_link']=$this->input->post('instagram_link');	
    		$data['youtube_link']=$this->input->post('youtube_link');	
    		$data['googleplus_link']=$this->input->post('googleplus_link');	
    		$data['twitter_link']=$this->input->post('twitter_link');	
    		$data['linkedin_link']=$this->input->post('linkedin_link');	
			$this->site_setting_model->updateSetting($data);
		}
		header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
		exit;
	}
	
	
	
}