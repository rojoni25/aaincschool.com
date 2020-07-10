<?php
Class general_model extends CI_Model
{
 
	function get_msg($eid)
	{
		$this -> db -> select('vma_message.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
   		$this -> db -> from('vma_message');
		$this -> db -> join('membermaster','membermaster.usercode = vma_message.usercode','left');
		$this -> db  -> where('vma_message.type',''.$eid.'');
		$this -> db  -> where('vma_message.status','Active');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;	
	}
	
	function get_payment_confirm()
	{
		$this -> db -> select('vma_message.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
   		$this -> db -> from('vma_message');
		$this -> db -> join('membermaster','membermaster.usercode = vma_message.usercode','left');
		$this -> db  -> where('vma_message.type','payment_confirm');
		$this -> db  -> where('vma_message.usercode NOT IN (select usercode from vma_monthly_payment)');
		$this -> db  -> where('vma_message.status','Active');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;	
	}
	
	function get_vma_admin()
	{
		$this -> db -> select('vma_admin.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name, membermaster.username, membermaster.emailid',FALSE);
   		$this -> db -> from('vma_admin');
		$this -> db -> join('membermaster','membermaster.usercode = vma_admin.usercode','left');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;	
	}
	
	
}
?>
