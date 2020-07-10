<?php
Class pdl_downline_tree_model extends CI_Model
{
	
 	
	
	function get_node_three_by_three_by_id($eid)
	{
		$this -> db -> select('membermaster.fname,membermaster.lname');
		$this -> db -> select('pdl_member.usercode,pdl_member.side');
   		$this -> db -> from('pdl_member');
		$this -> db -> join('membermaster','membermaster.usercode = pdl_member.usercode','left');
		$this -> db -> where('pdl_member.upling', ''.$eid.'');
		$this -> db -> order_by('pdl_member.side', 'asc');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function userdt_by_code($eid){
		$this -> db -> select('fname,lname');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function member_paid_product_dt($eid){
		$this -> db -> select('membermaster.*');
   		$this -> db -> from('membermaster');
		$this -> db -> join('pdl_member','pdl_member.usercode = membermaster.usercode','left');
		$this -> db -> where('membermaster.usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	
	
}
?>
