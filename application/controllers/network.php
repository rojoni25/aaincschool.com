<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class network extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->load->model('network_model','',TRUE);
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
		$result		=$this->network_model->getAll();
		
		$html='';
		for($i=0;$i<count($result);$i++){
			$count			=	$this->network_model->count_friend($result[$i]['usercode']);
			if($result[$i]['pagecode']!=0){
				$cap_page_name	=	$this->network_model->get_capture_page_name($result[$i]['pagecode']);
				$page_name='<a target="_blank" href="'.base_url().'index.php/capture/page/'.$result[$i]['pagecode'].'/">'.$cap_page_name[0]['page_name'].'</a>';
			}
			else{
				$page_name='Default';
			}
			
			$verify=($result[$i]['email_verification']=='Y' ? "<strong>YES</strong>" : "<strong>NO</strong>");
			
			if($result[$i]['status']=='Active'){$status='Paid';	}
			else{$status='Free';}
			
			$html .='<tr class="'.$status.'">
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['username'].'</td>
						<td>'.$page_name.'</td>
						<td>'.$result[$i]['phone_no'].'</td>
						<td>'.$result[$i]['mobileno'].'</td>
						<td>'.$result[$i]['emailid'].'</td>
						<td>'.$result[$i]['skype'].'</td>
						<td>'.$count[0]['tot'].'</td>
						<td>'.$verify.'</td>
						<td>'.$status.'</td>
						
						
              		</tr>';
		}
		
			echo $html;
		
	}
	
	
}

