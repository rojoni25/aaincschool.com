<?php
Class dashboard_model extends CI_Model
{
	

	function count_all_member(){
		

		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('pdl_member');
		$this -> db -> where('usercode !=',''.PDL_SYSTEM_USER.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function sum_all_payment()
	{
		$this -> db -> select('SUM(amount) as tot');
   		$this -> db -> from('pdl_monthly_payment');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function count_under_review()
	{
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('pdl_subscription');
		$this -> db -> where('usercode NOT IN (select usercode from pdl_member)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function count_withdrawal_request()
	{
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('pdl_withdrawal_request');
		$this -> db -> where('status !=', 'delete');
		$this -> db -> where('request_code NOT IN (select request_code from pdl_withdrawal)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	
	function count_unread_message(){
		
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('pdl_message');
		$this -> db -> where('send_to', '-1');
		$this -> db -> where('read_status', '0');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
		
	}


	
	

	
	
	
	
	 
	 
	
	
	
	
	
}
?>
