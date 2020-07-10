<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class smfund_capture extends CI_Controller {

	function __construct()
 	{
   		parent::__construct();
		$this->load->model('capture_model','ObjM',TRUE); 
 	}
		
	
	function page($pagecode='',$refcode='')
	{
		
		$data['smfund']				=	true;
		
		$data['result']				=	$this->comman_fun->get_table_data('smfund_capture_page_master',array('capture_page_code'=>$pagecode));
		
		if($refcode!='')
		{
			$data['ref']			=	$this->ObjM->get_user_by_username($refcode);
			//var_dump($data['ref']);
			//exit;
		
		}
		
		$data['current_join']		=	$this->get_currect_add_member();
		$data['current_join_mem']	=	$this->get_currect_join_member();
		$data['pagecode']			=	$pagecode;
		
		
		
		
		
		$this->load->view('public/capture/'.$data['result'][0]['pagecode'].'', $data);
			
		
		
	}
	
	function page_priview($eid)
	{
		$data['current_join']		=	$this->get_currect_add_member();
		$data['current_join_mem']	=	$this->get_currect_join_member();
		$data['result']				=	$this->comman_fun->get_table_data('smfund_capture_page_preview',array('capture_page_code'=>$eid));
		$data['master']				=	$this->comman_fun->get_table_data('capture_page_record',array('pagecode'=>$data['result'][0]['pagecode']));
	
		$this->load->view('public/capture/'.$data['result'][0]['pagecode'].'', $data);
		
	}
	
	protected function get_currect_add_member()
	{
		$result=$this->ObjM->get_currect_add_member();
		$list=array();	
		for($i=0;$i<count($result);$i++){
			$list[]=ucwords(strtolower($result[$i]['name']));
		}
		$p=implode(', ',$list);
		return $convert = str_replace(",", "<br>", $p);
	}
	
	protected function get_currect_join_member()
	{
		$result=$this->ObjM->get_currect_add_member();
		$list=array();	
		for($i=0;$i<count($result);$i++){
			$list[]=ucwords(strtolower($result[$i]['name']));
		}
		$p=implode(', ',$list);
		return $p=implode(', ',$list);
	}

}

