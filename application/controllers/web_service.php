<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class web_service extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		$this->load->model('web_service_model','ObjM',TRUE);
 	}
	
	function get_user_list(){
		$result=$this->ObjM->get_user();
		$arr['success']='true';
		$arr['data']=$result;
		echo json_encode($arr);
	}
	
}


