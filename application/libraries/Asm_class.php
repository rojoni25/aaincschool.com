<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Asm_class {

	protected $CI;
	
	public function __construct()
	{
		
		
	}
	
	function check_in_tree()
	{
		$this->CI =& get_instance();
		$this->CI -> db -> select('*');
   		$this->CI -> db -> from('n_product_member');
   		$this->CI -> db -> where('usercode',''.$this->CI->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this->CI -> db -> get();
		$the_content = $query->result_array();
    	return (isset($the_content[0]))? true : false;
	}
	
	function check_product($type)
	{
		$this->CI =& get_instance();
		$this->CI -> db -> select('*');
   		$this->CI -> db -> from('n_product_member');
   		$this->CI -> db -> where('usercode',''.$this->CI->session->userdata['logged_ol_member']['usercode'].'');
		$this->CI -> db -> where('product_type',''.$type.'');
   		$query = $this->CI -> db -> get();
		$the_content = $query->result_array();
		
		if(time() > $the_content[0]['due_time'])
		{
			return false;
			
		}else
		{
			return true;
		}
	}
	
	function get_pages_contain()
 	{
		$this->CI =& get_instance();
		
		if($this->check_product(2)){	$pagelable='n_product_joined_100'; }
		elseif($this->check_product(1)){$pagelable='n_product_joined_15';}
		else{$pagelable='n_product_not_join';}
		
   		$this->CI -> db -> select('*');
   		$this->CI -> db -> from('cms_pages_master');
   		$this->CI -> db -> where('pagelable', ''.$pagelable.'');
   		$query = $this->CI -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	
	function check_access_product($type){
		
		if($this->check_in_tree() || $this->check_manual_permission($type)){
			return true;
		}
		else{
			return false;
		}
		
	}
	
	function check_due_date()
	{
		$this->CI =& get_instance();
		
		$this->CI -> db -> select('*');
   		$this->CI -> db -> from('n_product_member');
   		$this->CI -> db -> where('usercode',''.$this->CI->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this->CI -> db -> get();
		$the_content = $query->result_array();
		
		if(time() > $the_content[0]['due_time'])
		{
			return false;
			
		}else{
			return true;
		}
	}
	
	
	
	function check_paid_product($type)
	{
		$this->CI =& get_instance();
		$this->CI -> db -> select('*');
   		$this->CI -> db -> from('n_product_member');
   		$this->CI -> db -> where('usercode',''.$this->CI->session->userdata['logged_ol_member']['usercode'].'');
		$this->CI -> db -> where('product_type',''.$type.'');
   		$query = $this->CI -> db -> get();
		$the_content = $query->result_array();

		if(isset($the_content[0])){
			return true;
		}else{
			return false;
		}
	}
	
	function check_manual_permission($type)
	{
		$this->CI =& get_instance();
		$this->CI -> db -> select('*');
   		$this->CI -> db -> from('n_product_permission');
   		$this->CI -> db -> where('usercode',''.$this->CI->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this->CI -> db -> get();
		$the_content = $query->result_array();
		
		if(isset($the_content[0])){
			return true;
		}else{
			return false;
		}
    	
	}
	
	
	

	
	
}
