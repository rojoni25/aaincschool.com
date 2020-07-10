<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class loginsucess extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member_free')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('loginsucess_model','',TRUE);
   		
 	}
	public function index()
	{
		$this->load->view('public/public_header');
		$nav['title']='Welcome';
		$this->load->view('public/left_bar',$nav);
		$this->load->view('public/free_dashboard');
		$this->load->view('public/public_footer');
	}
	
	function capturepages()
	{
		$this->capturepages_set_frist_time_page();
		
		$data['result']=$this->loginsucess_model->getAll_capturepages();
		$data['result2']=$this->loginsucess_model->get_free_page();
		
		$this->load->view('public/public_header');
		$nav['title']='Capture Pages';
		$this->load->view('public/left_bar',$nav);
		$this->load->view('public/capturepages_view',$data);
		$this->load->view('public/public_footer');
	}
	
	function capturepages_set_frist_time_page(){
		
		$result=$this->loginsucess_model->get_page_code();
		
		for($i=0;$i<count($result);$i++){
			$data['usercode']				=	$this->session->userdata['logged_ol_member_free']['usercode'];
			$data['change']					=  'Y';
			$data['page_for']				=  $result[$i]['page_for'];
			$data['page_name']				=  $result[$i]['page_name'];
			$data['box_position']			=  $result[$i]['box_position'];
			$data['box_bg_color']			=  $result[$i]['box_bg_color'];
			$data['page_bg_color']			=  $result[$i]['page_bg_color'];
			$data['page_bg_img']			=  $result[$i]['page_bg_img'];
			$data['page_bg_video']			=  $result[$i]['page_bg_video'];
			$data['page_bg_video_mute']		=  $result[$i]['page_bg_video_mute'];
			$data['button_bg_color']		=  $result[$i]['button_bg_color'];
			$data['button_text_color']		=  $result[$i]['button_text_color'];
			$data['button_one_text']		=  $result[$i]['button_one_text'];
			$data['button_two_text']		=  $result[$i]['button_two_text'];
			$data['logo_url']				=  $result[$i]['logo_url'];
			$data['contain_video_url']		=  $result[$i]['contain_video_url'];
			$data['contain_video_type']		=  $result[$i]['contain_video_type'];
			$data['contain_video_autoplay']	=  $result[$i]['contain_video_autoplay'];
			$data['contain_video_position']	=  $result[$i]['contain_video_position'];
			$data['headline_color']			=  $result[$i]['headline_color'];
			$data['headline_text']			=  $result[$i]['headline_text'];
			$data['sub_headline_color']		=  $result[$i]['sub_headline_color'];
			$data['sub_headline_text']		=  $result[$i]['sub_headline_text'];
			$data['main_body_text']			=  $result[$i]['main_body_text'];
			$data['main_body_text_color']	=  $result[$i]['main_body_text_color'];
			$data['footer_text_color']		=  $result[$i]['footer_text_color'];
			$data['footer_text']			=  $result[$i]['footer_text'];
			$data['status']					=  'Active';
			$data['ref_page_code']			=	$result[$i]['capture_page_code'];
			
			$this->loginsucess_model->addItem($data,'capture_page_master');
			
			$data2['usercode']				=	$this->session->userdata['logged_ol_member_free']['usercode'];
			$data2['capture_page_code']		=	$result[$i]['capture_page_code'];
			$this->loginsucess_model->addItem($data2,'capture_page_detail');
			
			
		}
	}
	
}


