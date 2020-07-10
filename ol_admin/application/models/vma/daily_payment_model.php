<?php
Class daily_payment_model extends CI_Model
{
 
	function get_list($eid)
	{
		$timedt = strtotime(date('d-m-Y'));
		
		$sQuery='SELECT  u.usercode,
		COALESCE(r.total_in, 0) total_in,
		COALESCE(n.total_out, 0) total_out,
		COALESCE(r.total_in, 0) -  COALESCE(n.total_out, 0) as balance
		FROM  vma_member as u 
		LEFT JOIN
		(
		SELECT  usercode, SUM(amount) as total_in
		FROM    vma_virtual_wallet
		GROUP   BY usercode
		) r ON  u.usercode = r.usercode
		LEFT JOIN
		(
		SELECT  EndCode, SUM(amount) as total_out
		FROM    vma_daily_payment
		GROUP   BY EndCode
		) n ON u.usercode = n.EndCode
		WHERE u.usercode NOT IN (select EndCode from vma_daily_payment where timedt="'.$timedt.'")
		GROUP BY u.usercode
		HAVING SUM(balance) >= 5';	
		
		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;	
	}
	
	
	
	
	function tree_upling_level($eid)
	{
		
		$this -> db -> select('t1.usercode as lv1, t1.due_time due1');
		$this -> db -> select('t2.usercode as lv2, t2.due_time due2');
		$this -> db -> select('t3.usercode as lv3, t3.due_time due3');
   		$this -> db -> from('vma_member');
		$this -> db -> join('vma_member t1','vma_member.upling = t1.usercode','left');
		$this -> db -> join('vma_member t2','t1.upling = t2.usercode','left');
		$this -> db -> join('vma_member t3','t2.upling = t3.usercode','left');
   		$this -> db -> where('vma_member.usercode', ''.$eid.'');
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		

    	return $the_content;
	}
	
	
	
	
}
?>
