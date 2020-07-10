<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class r_matrix_report extends CI_Controller { 
		
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		//if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		$this->file_setting();
		//if($this->session->userdata[MATRIX_SESSION_ADMIN]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('matrix_comman/r_matrix_report_model','ObjM',TRUE);
		
		
 	}
	
	protected function file_setting()
	{
		if(file_exists(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php')){
			include(APPPATH. 'config/matrix_const/'.$this->uri->segment(1).'/const.php');	
			if(!defined('MATRIX_TABLE_PRE')){ 	echo 'Seting Not proper {1}'; exit;}
			if(!defined('MATRIX_CODE_LLB')){ 	echo 'Seting Not proper {2}'; exit;}
			if(!defined('MATRIX_LLB')){ 		echo 'Seting Not proper {3}'; exit;}
			if(!defined('MATRIX_SYSTEM_ADMIN')){ echo 'Seting Not proper {4}'; exit;}
		}
		else{
			echo 'File Not Set';
			exit;
		}
	}
	
	function friend_pif()
	{
		$data['html']=$this->friend_pif_listing();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/admin/r_matrix_report_pif',$data);
		$this->load->view('comman/footer');	
	}
	
	function friend_pif_listing(){
		
		$result=$this->ObjM->get_pif_report();
		$html='';
		for($i=0;$i<count($result);$i++){
				$no=$i+1;
				$html.='<tr>
				<td>'.$no.'</td>
				<td>'.$result[$i]['pif_by_u'].'</td>
				<td>'.$result[$i]['name'].'</td>
				<td>'.date('M d, Y  i:j',$result[$i]['request_time']).'</td>
				</tr>';
        } 
		return $html;
	} 
	
	
	
	
	
	
	
	
	
	
	
		
	
	

	
	

	
	

	
	
	
	
	 
}

