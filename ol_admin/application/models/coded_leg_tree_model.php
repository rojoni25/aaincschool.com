<?php
Class coded_leg_tree_model extends CI_Model
{
 	function get_all_referral($eid)
 	{	
   		$this -> db -> select('fname,lname,usercode');
   		$this -> db -> from('membermaster');
		$this -> db -> where('referralid', ''.$eid.'');
		$this -> db -> where('status', 'Active');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
		if(isset($the_content[0])){ unset($the_content[0]); }
		$the_content = array_values($the_content);

		if(isset($the_content[0])){ unset($the_content[0]); }
		$the_content = array_values($the_content);
		
		$the_content = array_values($the_content);
    	return $the_content;
 	}
 
 	
  
	
}