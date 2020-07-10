<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class membership_renewed extends CI_Controller {
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;} 
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		$this->load->model('membership_renewed_model','ObjM',TRUE);
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
	
	
	
	function renewed_auto(){
		$result		=$this->ObjM->get_due_member();
		$html='';
		for($i=0;$i<count($result);$i++){
			$html .='<tr>
						<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['username'].'</td>
						<td>'.$result[$i]['emailid'].'</td>
						<td>'.date('d-m-Y',$result[$i]['due_time']).'</td>
						<td><strong>$'.$result[$i]['main_balance'].'</strong></td>
						<td>
						<a href="'.base_url().'index.php/auto_payment/manually_pay/'.$result[$i]['usercode'].'"><span class="label label-success">Renewed Membership</span></a>
						&nbsp;
							<a href="'.base_url().'index.php/comman_controler/member_details_view/'.$result[$i]['username'].'" class="edit_rcd">
								<i class="icon-eye-open"></i>
							</a>
						</td>
              		</tr>';
		}
		echo $html;
		
	}
	
	function  renewed_manually()
	{
		$now=time();
		$result=$this->ObjM->get_due_member_no_pay();
		$html='';
		for($i=0;$i<count($result);$i++){
			$html.='<tr>
				  		<td>'.$result[$i]['usercode'].'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['username'].'</td>
						<td>'.$result[$i]['emailid'].'</td>
						<td>'.date('d-m-Y',$result[$i]['due_time']).'</td>
						<td><strong>$'.$result[$i]['main_balance'].'</strong></td>
						<td>-</td>
        			</tr>';
		}
		echo $html;
	}
	
	
}

