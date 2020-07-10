<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member extends CI_Controller {
	
	
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;}
		if(!$this->comman_fun->check_record('vma_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){header('Location: '.base_url().'index.php/vma/dashboard/view');exit;}
		$this->load->model('vma_ad/member_model','ObjM',TRUE);
		$this->load->library('vma_ad/vma_class');
 	}
	
	public function view($eid)
	{
		$data['html'] = $this->listing();
		$this->load->view('comman/topheader',$data);
		$this->load->view('comman/header');
		$this->load->view('vma_ad/member_view',$data);
		$this->load->view('comman/footer');
	}
	
	function listing(){
		$result = $this->ObjM->get_list();
		for($i=0;$i<count($result);$i++){
			$ref = $this->ObjM->get_member_by_code($result[$i]['upling']);
			$btn='&nbsp;&nbsp;&nbsp;<a href="'.vma_ad().'message/send/'.$result[$i]['usercode'].'"><span class="label label-info">Send Email</span></a>';
			
			if($this->vma_class->check_unqulified($result[$i]['usercode'])){
				$st='Qulified';
			}else{
				$st='Unqulified';
			}
			
			$html.='<tr>
					<td>'.$result[$i]['usercode'].'</td>
					<td>'.$result[$i]['name'].'</td>
					<td>'.$result[$i]['username'].'</td>
					<td>'.$result[$i]['emailid'].'</td>
					<td>'.$ref[0]['name'].'</td>
					<td>'.$st.'</td>
					
					<td>
						<a href="'.vma_ad().''.$this->uri->rsegment(1).'/detail/'.$result[$i]['usercode'].'"><i class="icon-eye-open"></i></a>
						'.$btn.'
					</td>
			</tr>';
		}
		return $html;
	}
	
	function detail($eid)
	{
		$data['member']			=	$this->vma_class->get_member_by_code($eid);
		$data['upling_chain']	=	$this->vma_class->upling_chain($eid);
		$data['ref']			=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$data['member']['referral']));
		$data['payment']		=	$this->comman_fun->get_table_data('vma_monthly_payment',array('usercode'=>$data['member']['usercode']));
		$data['member_balance'] =	$this->ObjM->member_balance($data['member']['usercode']);
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('vma_ad/member_profile',$data);
		$this->load->view('comman/footer');	
	}
	
	function unqulified($eid){
		$data				=	array();
		$data['qulified']	=	'N';
		$this->comman_fun->update($data,'vma_member',array('usercode'=>$eid));
		header('Location: '.vma_ad().$this->uri->rsegment(1).'/detail/'.$eid.'');
		exit;
	}
	function qulified($eid){
		$data				=	array();
		$data['qulified']	=	'Y';
		
		$this->comman_fun->update($data,'vma_member',array('usercode'=>$eid));
		
		header('Location: '.vma_ad().$this->uri->rsegment(1).'/detail/'.$eid.'');
		exit;
	}
	
	
	
	
	
	
}

