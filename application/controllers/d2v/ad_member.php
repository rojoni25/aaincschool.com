<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ad_member extends CI_Controller {
	
	protected $upling_user	=	'';
	protected $upling_posi	=	'';
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 	
		$this->load->model('d2v/ad_module','ObjM',TRUE); 
		$this->load->library('email');
		
		if(!$this->comman_fun->check_record('d2v_admin',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){
			header('Location: '.base_url().'index.php/d2v/page/view/');
			exit;
		}
 	}
	
	
	function member_list(){
		
		$data['result']=$this->ObjM->get_member();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('d2v/admin/member_list',$data);
		$this->load->view('comman/footer');
		
	}
	

	function request(){
		
		$data['result']=$this->ObjM->request();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('d2v/admin/join_request',$data);
		$this->load->view('comman/footer');
	}
	
	function process($eid){
		$data['result']			=	$this->ObjM->request_by_id($eid);
		$data['member_list']	=	$this->ObjM->get_member_list();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view('d2v/admin/request_process',$data);
		$this->load->view('comman/footer');
	}
	
	function approve_member(){
		
		$result		=	$this->ObjM->request_by_id($_POST['usercode']);
		
		if(isset($result[0])){
			$this->first_lavel_set($_POST['downline_of']);
			$data=array();
			$data['usercode']	=	$result[0]['usercode'];
			$data['upling']		=	$this->upling_user;
			$data['side']		=	$this->upling_posi;
			$data['join_date']	=	date('Y-m-d H:i:s');
			
			$this->comman_fun->addItem($data,'d2v_member');
			$this->session->set_flashdata('show_msg', 'Insert Successfully');
			
			header('Location: '.base_url().'index.php/d2v/'.$this->uri->rsegment(1).'/request/');
			exit;
			
		}
		
	}
	
	protected function first_lavel_set($eid){
		
		$result	=	$this->ObjM->get_downline($eid);	
		///level One Setting///
		if(count($result)<3){
			$this->upling_user = $eid;
			$this->upling_posi = count($result)+1;
			return;	
		}
		
		for($i=0;$i<count($result);$i++){
			$arr[]=$result[$i]['usercode'];
		}
		$this->tree_check_postion($arr);
	}
	
	
	
	protected function tree_check_postion($arr_mem){
		for($pos=0;$pos<3;$pos++){
			for($i=0;$i<count($arr_mem);$i++){
				$result=$this->ObjM->get_count_downline($arr_mem[$i]);
				if($result[0]['tot']<$pos+1){			
					$this->upling_user = $arr_mem[$i];
					$this->upling_posi = $result[0]['tot']+1;
					return;		
				}
			
			}
		}
	
		$child_mem=array();
		for($i=0;$i<count($arr_mem);$i++){
			$child_mem[]=$this->ObjM->get_downline($arr_mem[$i]);				
		}
		
		$re_arr=array();
		for($pos=0;$pos<5;$pos++){
			for($i=0;$i<count($child_mem);$i++){			
				$re_arr[]=$child_mem[$i][$pos]['usercode'];					
			}
		}
		
		$this->tree_check_postion($re_arr);
		
	}
	
	
	
	
	
	
   
	
	
	
	
	
	
	
	
}


