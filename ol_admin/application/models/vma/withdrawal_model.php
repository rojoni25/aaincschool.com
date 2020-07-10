<?php
Class withdrawal_model extends CI_Model
{
 	

	function withdrawal_request($eid)
	{
		$this -> db -> select('vma_withdrawal.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db -> select('membermaster.username,membermaster.emailid');
   		$this -> db -> from('vma_withdrawal');
		$this -> db -> join('membermaster','membermaster.usercode = vma_withdrawal.usercode','left');
		$this -> db  -> where('vma_withdrawal.status','process');
		$this -> db  -> order_by('vma_withdrawal.id','ASC');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;	
	}
	
	
	
	
	
	
}
?>
