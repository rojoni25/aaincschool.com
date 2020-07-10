<?php
Class withdrawal_monthly_report_model extends CI_Model
{
 	function get_first_member_add_date()
 	{	
   		$this -> db -> select('MIN(add_time) as dt');
   		$this -> db -> from('membermaster');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function report_month_date_wise($dt)
	{
		
		$f_date		=	strtotime($_POST['month_name']);
   		$l_date 	=   strtotime(date('t-m-Y',$f_date));
		

		
		$this -> db -> select('withdrawal_balance.*');
		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.username');
   		$this -> db -> from('withdrawal_balance');
		$this -> db -> join('membermaster','membermaster.usercode = withdrawal_balance.usercode','left');
		$this -> db -> where('withdrawal_balance.wallet_type','main_balance');
		$this -> db -> where('withdrawal_balance.type','1');
		
		if($_POST['month_name']!='-1'){
			$this -> db -> where('withdrawal_balance.timedt >=', ''.$f_date.'');
			$this -> db -> where('withdrawal_balance.timedt <=', ''.$l_date.'');
		}
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	function report_month_date_wise_tot(){
		
		$f_date		=	strtotime($_POST['month_name']);
   		$l_date 	=   strtotime(date('t-m-Y',$f_date));
		
		$this -> db -> select('sum(withdrawal_balance.amount) as sum');
   		$this -> db -> from('withdrawal_balance');
		$this -> db -> where('wallet_type','main_balance');
		$this -> db -> where('type','1');
		
		if($_POST['month_name']!='-1'){
			$this -> db -> where('withdrawal_balance.timedt >=', ''.$f_date.'');
			$this -> db -> where('withdrawal_balance.timedt <=', ''.$l_date.'');
		}
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	
	
 	
  
	
}
?>
