<?php
Class web_service_model extends CI_Model
{
 	function get_user()
 	{
   		$this -> db -> select('usercode,fname,lname');
   		$this -> db -> from('membermaster');
   		$this -> db -> order_by("usercode", "asc");
    	$this -> db -> limit(5,2);
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
 	}
}
?>
