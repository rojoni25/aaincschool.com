<?php
Class daily_payment_by_member_model extends CI_Model
{
 	function getAll()
 	{	
		$time_stm=strtotime($_POST['daily_date']);
   		$this -> db -> select('master_withdrawal_sheet.*');
		$this -> db -> select('membermaster.fname, membermaster.lname');
   		$this -> db -> from('master_withdrawal_sheet');
		$this -> db -> join('membermaster','master_withdrawal_sheet.usercode = membermaster.usercode','left');
   		$this -> db -> where('master_withdrawal_sheet.time_stm',''.$time_stm.'');
		$this -> db -> where('master_withdrawal_sheet.balance_type',''.$_POST['report_type'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_payment_to($arr){
		$this -> db -> select('payment_daily.*');
		$this -> db -> select('membermaster.fname, membermaster.lname');
   		$this -> db -> from('payment_daily');
		$this -> db -> join('membermaster','payment_daily.usercode = membermaster.usercode','left');
   		$this -> db -> where('payment_daily.paymentcode',''.$arr['usercode'].'');
		$this -> db -> where('payment_daily.pay_type',''.$arr['pay_type'].'');
		$this -> db -> where('payment_daily.timestm',''.$arr['timestm'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_count()
 	{	
		$time_stm=strtotime($_POST['daily_date']);
   		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('master_withdrawal_sheet');
   		$this -> db -> where('time_stm',''.$time_stm.'');
		$this -> db -> where('balance_type',''.$_POST['report_type'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	

	function get_member_detail($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('status','Active');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function tree_upling($eid, $field)
	{
		$this -> db -> select('member_node_master.'.$field.' as upling');
   		$this -> db -> from('member_node_master');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content=($the_content[0]['upling']=='0') ? false : $the_content[0]['upling'];
	}
	
	
  	
  
	
}
?>
