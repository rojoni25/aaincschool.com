<?php
Class ad_report_model extends CI_Model
{
 	
 	function get_payment_flase(){
		
		$this -> db -> select('pdl_payment_false.*');
		$this -> db -> select('CONCAT(membermaster.fname, " ", SUBSTRING(membermaster.lname,1,1)) as name,membermaster.username',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = pdl_payment_false.usercode','left');
   		$this -> db -> from('pdl_payment_false');
		$this -> db -> order_by('pdl_payment_false.time_dt','DESC');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_payment_list()
	{
		$this -> db -> select('pdl_monthly_payment.*');
		$this -> db -> select('CONCAT(membermaster.fname, " ", SUBSTRING(membermaster.lname,1,1)) as name,membermaster.username',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = pdl_monthly_payment.usercode','left');
   		$this -> db -> from('pdl_monthly_payment');
		
		if($_REQUEST['fdate'])
		{
			$totime		=	(int)strtotime($_REQUEST['fdate']);
			$fromtime	=	(int)$totime+86399;	
			$this -> db -> where('pdl_monthly_payment.date_dt >=',''.$totime.'');
			$this -> db -> where('pdl_monthly_payment.date_dt <=',''.$fromtime.'');
		}
		
		$this -> db -> order_by('pdl_monthly_payment.id','DESC');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	
	
	
}
?>
