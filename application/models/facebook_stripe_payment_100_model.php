<?php
Class facebook_stripe_payment_100_model extends CI_Model
{
 	function addItem($data,$table){
    	$this->db->insert($table ,$data);
    	return $this->db->insert_id();
	}

	function getFacebookAmount()
	{
		$this -> db -> select('*');
   		$this -> db -> from('site_settings');
		$this -> db -> where('lable_acces_nm','facebook_ads_payment');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0];
	}

	function get_pages_contain($pagelable)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable', ''.$pagelable.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}

}
?>