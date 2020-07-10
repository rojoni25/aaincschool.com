<?php
Class export_excel_model extends CI_Model
{
 	function get_member($eid)
	{
		$this -> db -> select("*");
   		$this -> db -> from('membermaster');
   		$this -> db -> where('status',''.$eid.'');
		$this -> db -> order_by("usercode", "asc");
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_member_all()
	{
		$this -> db -> select("*");
   		$this -> db -> from('membermaster');
		$this -> db -> order_by("usercode", "asc");
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member_request_send($eid)
	{
		$this -> db -> select("paid_request_master.payment,paid_request_master.timedt");
		$this -> db -> select("membermaster.*");
   		$this -> db -> from('paid_request_master');
		$this -> db -> join('membermaster','paid_request_master.usercode = membermaster.usercode','left');
   		$this -> db -> where('paid_request_master.status','Active');
		if($eid=='paid'){
			$this -> db -> where('paid_request_master.payment','Y');
		}
		$this -> db -> order_by("usercode", "asc");
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_unverification_member($eid)
	{
		$this -> db -> select("*");
   		$this -> db -> from('membermaster');
   		$this -> db -> where('status !=','Delete');
		$this -> db -> where('email_verification','N');
		$this -> db -> order_by("usercode", "asc");
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_total_reffral($usercode){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('referralid', ''.$usercode.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
 	
}
?>
