<?php
Class membership_renewed_model extends CI_Model
{
 	
 
	function get_due_member()
	{
		$timestam	=	strtotime('+1 days',time());
		$this -> db -> select('membermaster.*');
		$this -> db -> select('master_balance_sheet.main_balance');
   		$this -> db -> from('master_balance_sheet');
		$this -> db -> join('membermaster','membermaster.usercode = master_balance_sheet.usercode','left');
   		$this -> db -> where('master_balance_sheet.main_balance >=',''.CW_MIN.'');
		$this -> db -> where('membermaster.due_time <',''.$timestam.'');
		$this -> db -> where('membermaster.usercode !=','1');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_due_member_no_pay()
 	{	
		$timestam	=	time();
		$this -> db -> select('membermaster.*');
		$this -> db -> select('master_balance_sheet.main_balance');
   		$this -> db -> from('master_balance_sheet');
		$this -> db -> join('membermaster','membermaster.usercode = master_balance_sheet.usercode','left');
   		$this -> db -> where('master_balance_sheet.main_balance <',''.CW_MIN.'');
		$this -> db -> where('membermaster.due_time <',''.time().'');
		$this -> db -> where('membermaster.usercode !=','1');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
}
?>
