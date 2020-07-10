<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class renewed_request extends CI_Controller {
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
		$result		=$this->ObjM->get_all_request();
		$html='';
		for($i=0;$i<count($result);$i++){
			$req_by		=	$this->ObjM->get_member_by_usercode($result[$i]['usercode']);
			$req_for	=	$this->ObjM->get_member_by_usercode($result[$i]['renewal_usercode']);
			$balance	=	$this->ObjM->get_current_balance($result[$i]['usercode']);
			if($req_for[0]['status']=='Pending'){
				$mem_by='<span class="pen-member">'.$req_for[0]['fname'].' '.$req_for[0]['lname'].' ('.$req_for[0]['usercode'].')<span>';
			}
			else{
				$mem_by=''.$req_for[0]['fname'].' '.$req_for[0]['lname'].' ('.$req_for[0]['usercode'].')';
			}
			
			$html .='<tr>
						<td>'.$req_by[0]['fname'].' '.$req_by[0]['lname'].' ('.$req_by[0]['usercode'].')</td>
						<td>'.$mem_by.'</td>
						<td><span class="strong-font">$'.$balance.'</span></td>
						<td>'.date('d-m-Y',$result[$i]['request_send_time']).'  <span class="strong-font">('.ago_time(date('d-m-Y H:i:s',$result[$i]['request_send_time'])).')</span></td>
						<td>
						<a href="'.base_url().'index.php/'.$this->uri->segment(1).'/process/'.$result[$i]['request_code'].'"><span class="label label-success">Renewed Process</span></a>
						&nbsp;
							<a href="'.base_url().'index.php/comman_controler/member_details_view/'.$req_by[0]['username'].'" class="edit_rcd iconcls">
								<i class="icon-eye-open"></i>
							</a>
							
							&nbsp;
							<a href="'.base_url().'index.php/'.$this->uri->segment(1).'/remove_record/'.$result[$i]['request_code'].'" class="remove_record iconcls">
								<i class="icon-remove"></i>
							</a>
						</td>
              		</tr>';
		}
		echo $html;
		
	}
	
	function process($eid){
		
		$data['result']			=	$this->ObjM->get_request_by_code($eid);
		if(!isset($data['result'][0])){
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
			exit;
		}
		
		$data['req_by']			=	$this->ObjM->get_member_by_usercode($data['result'][0]['usercode']);
		$data['req_for']		=	$this->ObjM->get_member_by_usercode($data['result'][0]['renewal_usercode']);
		
		if(!isset($data['req_by'][0]) || !isset($data['req_for'][0])){
			header('Location: '.base_url().'index.php/'.$this->uri->segment(1));
			exit;
		}
		
		$data['req_by_balance']	=	$this->ObjM->get_current_balance($data['result'][0]['usercode']);
		$data['req_for_balance']=	$this->ObjM->get_current_balance($data['result'][0]['renewal_usercode']);
		
		$data['req_by_level']	=	$this->ObjM->get_payment_level($data['result'][0]['usercode']);
		$data['req_for_level']	=	$this->ObjM->get_payment_level($data['result'][0]['renewal_usercode']);
		
		$data['req_by_ref']		=	$this->ObjM->get_member_by_usercode($data['req_by'][0]['referralid']);
		$data['req_for_ref']	=	$this->ObjM->get_member_by_usercode($data['req_for'][0]['referralid']);
		
		
		
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.$this->uri->segment(1).'_add',$data);
		$this->load->view('comman/footer');
	}
	
	
	
	function remove_record($eid)
	{
		$data=array();
		$data['request_status']	=	'Delete';
		$data['update_time']	=	time();
		$this->ObjM->update($data,'request_to_renewal','request_code',$eid);
		
	}
	
	
}

