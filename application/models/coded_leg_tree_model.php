<?php
Class coded_leg_tree_model extends CI_Model
{
 	function get_all_referral($eid)
 	{	
   		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.usercode');
   		$this -> db -> from('coded_residual');
		$this -> db -> join('membermaster','membermaster.usercode = coded_residual.usercode','left');
		$this -> db -> where('coded_residual.usercode_by',''.$eid.'');
		$this -> db -> where('coded_residual.type','coded_match');
		$this -> db -> where('coded_residual.level','1');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	function get_all_referral_next($eid)
	{
		$this -> db -> select('fname,lname,usercode');
   		$this -> db -> from('membermaster');
		$this -> db -> where('referralid',''.$eid.'');
		$this -> db -> where('usercode in(select usercode from coded_residual where usercode_by="'.$this->session->userdata['logged_ol_member']['usercode'].'" and type="coded_match")');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 
 	
  
	
}
?>
