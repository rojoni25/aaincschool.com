<?php
Class diamond_wallet_model extends CI_Model
{
 
	function get_msg()
	{
		$this -> db -> select('diamond_payment_confirmation.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
   		$this -> db -> from('diamond_payment_confirmation');
		$this -> db -> join('membermaster','membermaster.usercode = diamond_payment_confirmation.usercode','left');
		$this -> db  -> where('diamond_payment_confirmation.type','admin_msg');
		$this -> db  -> where('diamond_payment_confirmation.status','Active');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;	
	}
	
	function get_payment_confirm()
	{
		$this -> db -> select('diamond_payment_confirmation.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
   		$this -> db -> from('diamond_payment_confirmation');
		$this -> db -> join('membermaster','membermaster.usercode = diamond_payment_confirmation.usercode','left');
		$this -> db  -> where('diamond_payment_confirmation.type','payment_confirm');
		$this -> db  -> where('diamond_payment_confirmation.status','Active');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;	
	}
	
	function withdrawal_request()
	{
		$this -> db -> select('diamond_withdrawal.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
   		$this -> db -> from('diamond_withdrawal');
		$this -> db -> join('membermaster','membermaster.usercode = diamond_withdrawal.usercode','left');
		$this -> db  -> where('diamond_withdrawal.status','Process');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;	
	}
	
	
	function withdrawal_report()
	{
		$this -> db -> select('diamond_withdrawal.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
   		$this -> db -> from('diamond_withdrawal');
		$this -> db -> join('membermaster','membermaster.usercode = diamond_withdrawal.usercode','left');
		$this -> db  -> where('diamond_withdrawal.status','Confirm');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;	
	}
	
	function payment_report(){
		$this -> db -> select('diamond_payment.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
   		$this -> db -> from('diamond_payment');
		$this -> db -> join('membermaster','membermaster.usercode = diamond_payment.usercode','left');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;
	}
	
	function get_member_list()
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db  -> where('usercode IN (select usercode from diamond_payment GROUP BY usercode)');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;	
	}
	
}
?>
