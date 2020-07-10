<?php
Class financial_report_model extends CI_Model
{
	
	
	
 	
	function get_earning_monthly_sum($month_name)
	{
		$this -> db -> select('COALESCE(SUM(amount),0) AS tot_sum',false);
   		$this -> db -> from('vma_daily_payment');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		
		if($_POST['month_name']!=''){
			if($_POST['month_name']!='all'){
				$date 		= date('01-m-Y',strtotime($_POST['month_name']));
   				$end_date 	= date('t-m-Y',strtotime($_POST['month_name']));
				
				$this -> db -> where('timedt >=',''.strtotime($date).'');
				$this -> db -> where('timedt <=',''.strtotime($end_date).'');
			}
			else{
				$date 		= date('01-m-Y',strtotime($month_name));
   				$end_date 	= date('t-m-Y',strtotime($month_name));
				
				$this -> db -> where('timedt >=',''.strtotime($date).'');
				$this -> db -> where('timedt <=',''.strtotime($end_date).'');
			}	
		}
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_earning_sum(){
		$this -> db -> select('COALESCE(SUM(amount),0) AS tot_sum',false);
   		$this -> db -> from('vma_daily_payment');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_earning_monthly()
	{
		$this -> db -> select('COALESCE(SUM(amount),0) AS tot_sum',false);
		$this -> db -> select('timedt');
   		$this -> db -> from('vma_daily_payment');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		if($_POST['month_name']!=''){
			if($_POST['month_name']!='all'){
				$date 		= date('01-m-Y',strtotime($_POST['month_name']));
   				$end_date 	= date('t-m-Y',strtotime($_POST['month_name']));
				
				$this -> db -> where('timedt >=',''.strtotime($date).'');
				$this -> db -> where('timedt <=',''.strtotime($end_date).'');
			}	
		}
		 $this -> db -> group_by('timedt'); 
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	

}
?>
