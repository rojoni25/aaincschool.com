<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_payment_level extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('user_payment_level_model','ObjM',TRUE);
		$this->load->library('upload');
		$this->load->library('image_lib');
		
 	}
	
	public function view($id)
	{
		$data['html']=$this->listing($id);
		$data['table_list']=true;
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_view');
		$this->load->view('comman/footer');
	}
	
	function listing($id){
		if($id==""){
			return;
		}
		$result	=	$this->ObjM->get_member_by_payment_level($id);
		
		$html='';
		for($i=0;$i<count($result);$i++){
			$html .='<tr>
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['username'].'</td>
						<td>'.$result[$i]['emailid'].'</td>
						<td>'.$result[$i]['pay_level'].'</td>
              		</tr>';
		}
		return $html;
		
	}
	
	
}

