<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class martix_position extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!$this->session->userdata('logged_in_visa')){header('Location: '.base_url().'index.php/login');exit;}
		if($this->session->userdata['logged_in_visa']['user_type_id']!='1'){header('Location: '.base_url().'index.php/access_denied');exit;} 
		//if(!$this->session->userdata('logged_ol_member')){header('Location: '.base_url().'index.php/login');exit;} 
		$this->file_setting();
		//if($this->session->userdata[MATRIX_SESSION_MEMBER]['join']!='true'){header('Location: '.base_url().'index.php');exit;} 
		$this->load->model('matrix_comman/martix_position_module','ObjM',TRUE);
		
   		
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
	
	public function view()
	{

		$data['multi_position']=$this->get_all_position();
		$data['complated_level']=$this->get_complated_level($data['multi_position']);
		$data['payment']=$this->get_payment();
		
		$data['withdrawal_record']=$this->ObjM->get_withdrawal_record();
		
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/member/martix_position_view',$data);
		$this->load->view('comman/footer');
	}
	
	protected function get_all_position(){
		
		$multi_position=$this->ObjM->get_multi_position_detail($eid);	
		
		for($i=0;$i<count($multi_position);$i++)
		{
			
			$pos=$this->ObjM->get_position_member_count($multi_position[$i]['idcode']);
				
			$multi_position[$i]['level_1']	=	$pos['level_1'];
			$multi_position[$i]['level_2']	=	$pos['level_2'];
			$multi_position[$i]['level_3']	=	$pos['level_3'];
			$multi_position[$i]['total']	=	$pos['total'];
		}
		
		return $multi_position;	
	}
	
	function get_complated_level($result){
		$level=0;
		for($i=0;$i<count($result);$i++){
			
			if($result[$i]['total']==14){
				$level++;
			}	
			
		}
		return $level;
	}
	
	 protected function get_payment(){
		$coin_pay	=	$this->ObjM->get_payment_sum_by_type('COIN');
		$coin_withdrawal	=	$this->ObjM->get_withdrawal_sum_by_type('COIN');
		$arr=array(
			
			'coin_pay'			=>	$coin_pay,
			'coin_withdrawal'	=>	$coin_withdrawal,
			'coin_balance'		=>	$coin_pay	-	$coin_withdrawal,
		);
	
		return $arr;	
	
	}
	
	function position_detail($eid)
	{
		$data['position']=$this->ObjM->position_id_check($eid);
		if(isset($data['position'][0])){
			$data['member']=$this->position_downline_member_third_level($eid);
			
		}
		$data['position']	=	$this->ObjM->get_multi_postion();
		$this->load->view('comman/topheader');
		$this->load->view('comman/header');
		$this->load->view(''.MATRIX_FOLDER.'/member/martix_position_detail',$data);
		$this->load->view('comman/footer');	
	}
	
	protected function position_downline_member($code)
	{
		
		$arr=array();
		
		for($p=1;$p<=3;$p++)
		{
			$result	=	$this->ObjM->get_downline_member($code);
			$code=$this->set_idcode($result);
			
			for($i=0;$i<count($result);$i++){
				$result[$i]['level']=$p;
				array_push($arr,$result[$i]);
			}
			
			
		}
		return $arr;
		
	}
	
	protected function position_downline_member_third_level($code)
	{
		
		$arr=array();
		$result	=	$this->ObjM->get_downline_member($code);
		$result	=	$this->ObjM->get_downline_member($this->set_idcode($result));
		$result	=	$this->ObjM->get_downline_member($this->set_idcode($result));
	
		for($i=0;$i<count($result);$i++){
			$result[$i]['level']=$p;
			array_push($arr,$result[$i]);
		}
		return $arr;
		
	}
	
	protected  function set_idcode($result){
		
		$arr=array();
		
		for($i=0;$i<count($result);$i++){
			
			$arr[]=$result[$i]['idcode'];
			
		}
		
		return implode(",",$arr);
	}
	
	
	
	
	
	
}


