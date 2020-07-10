<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Test_class {

	protected $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance(); 
		echo 'Jiten';
		
	}
	
	function get_record()
	{
		$this->CI -> db -> select('*');
   		$this->CI -> db -> from('membermaster');
   		$this->CI -> db -> where('username',''.$id.'');
   		$query = $this->CI -> db -> get();
		$the_content = $query->result_array();
		var_dump($the_content);
	}

	
	
}
