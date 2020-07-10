<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class test_c extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		$this->load->model('home_module','',TRUE);
		$this->load->library('email');
   		
 	}
	public function index()
	{
		$this->load->library('test_class');
		$this->test_class->get_record();
	}

	public function test(){
		$old=file_get_contents('test11.txt');
		file_put_contents('test11.txt', $old.'inserted: '.date('Y-m-d H:i:s')."\n\n");
	}

	public function get_time(){
		echo date_default_timezone_get();
	}
	
	
	
}


