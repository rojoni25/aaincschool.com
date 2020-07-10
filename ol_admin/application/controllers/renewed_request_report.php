<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class renewed_request_report extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('renewed_request_model','ObjM',TRUE);
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
		$result		=$this->ObjM->request_report();
		
		$html='';
		for($i=0;$i<count($result);$i++){
			$mem_by=''.$req_for[0]['fname'].' '.$req_for[0]['lname'].' ('.$req_for[0]['usercode'].')';
	
			$html .='<tr>
						<td>'.$result[$i]['rby_username'].' ('.$result[0]['usercode'].')</td>
						<td>'.$result[$i]['req_for_nm'].' ('.$result[0]['renewal_usercode'].')</td>
						<td>'.date('d-m-Y',$result[$i]['request_send_time']).'</td>
						<td>'.$result[$i]['request_status'].'</td>
              		</tr>';
		}
		echo $html;
		
	}
	
	
	
	
}

