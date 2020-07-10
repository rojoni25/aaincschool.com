<?php
Class unilevel_model extends CI_Model
{
	function get_downline($eid)
	{
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db -> select('vma_member.*');
   		$this -> db -> from('vma_member');
		$this -> db -> join('membermaster','membermaster.usercode = vma_member.usercode','left');
		$this -> db -> where('vma_member.usercode IN (SELECT usercode from membermaster where referralid_free="'.$eid.'")');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	

 
 	
  
	
}
?>
