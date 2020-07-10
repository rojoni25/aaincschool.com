<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class r_matrix_report extends CI_Controller { 
		
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata["r_matrix_admin"]['access']!='true'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('r_matrix_report_model','ObjM',TRUE);
		
		
 	}
	
	function friend_pif()
	{
		$data['html']=$this->friend_pif_listing();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('r_matrix/r_matrix_report_pif',$data);
		$this->load->view('comman/footer');	
	}
	
	function friend_pif_listing(){
		
		$result=$this->ObjM->get_kdk_pif_report();
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

