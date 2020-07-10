<?php
Class member_model extends CI_Model
{
 	
	
	function get_list()
	{
		$this -> db -> select('vma_member.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db -> select('membermaster.username,membermaster.emailid');
   		$this -> db -> from('vma_member');
		$this -> db -> join('membermaster','membermaster.usercode = vma_member.usercode','left');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;	
	}
	function get_member_by_code($eid)
	{
		$this -> db  -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db  -> select('membermaster.username,membermaster.emailid');
   		$this -> db  -> from('membermaster');
		$this -> db  -> where('membermaster.usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;	
	}
	function member_balance($eid)
	{
		$sQuery='SELECT  u.usercode,
		COALESCE(r.virtual_in, 0) virtual_in,
		COALESCE(n.virtual_out, 0) virtual_out,
		COALESCE(r.virtual_in, 0) -  COALESCE(n.virtual_out, 0) as virtual_balance,
		COALESCE(r1.main_in, 0) main_in,
		COALESCE(n1.main_out, 0) main_out,
		COALESCE(r1.main_in, 0) -  COALESCE(n1.main_out, 0) as main_balance,
		CONCAT(membermaster.fname," ",membermaster.lname) as name,membermaster.username,membermaster.emailid
		FROM  vma_member as u 
		LEFT JOIN
		(
		SELECT  usercode, SUM(amount) virtual_in
		FROM    vma_virtual_wallet
		GROUP   BY usercode
		) r ON  u.usercode = r.usercode
		LEFT JOIN
		(
		SELECT  EndCode, SUM(amount) virtual_out
		FROM    vma_daily_payment
		GROUP   BY EndCode
		) n ON u.usercode = n.EndCode
		
		LEFT JOIN
		(
		SELECT  usercode, SUM(amount) main_in
		FROM    vma_daily_payment
		GROUP   BY EndCode
		) r1 ON u.usercode = r1.usercode
		
		LEFT JOIN
		(
		SELECT  usercode, SUM(amount) main_out
		FROM    vma_withdrawal
		GROUP   BY usercode
		) n1 ON u.usercode = n1.usercode
		LEFT JOIN membermaster ON membermaster.usercode=u.usercode
		WHERE u.usercode="'.$eid.'"';	
		
		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	
	
	
}
?>
