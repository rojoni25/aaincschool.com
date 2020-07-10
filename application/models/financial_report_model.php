<?php
Class financial_report_model extends CI_Model
{
	
	
	
 	function get_payment()
	{
		$this -> db -> select('*');
   		$this -> db -> from('payment_master');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_withdrawal($wallet_type)
	{
		$this -> db -> select('*');
   		$this -> db -> from('withdrawal_balance');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		if($_POST['month_name']!=''){
			if($_POST['month_name']!='all'){
				$date 		= date('01-m-Y',strtotime($_POST['month_name']));
   				$end_date 	= date('t-m-Y',strtotime($_POST['month_name']));
				
				$this -> db -> where('timedt >=',''.strtotime($date).'');
				$this -> db -> where('timedt <=',''.strtotime($end_date).'');
			}	
		}
		$this -> db -> where('type !=','5');
		$this -> db -> where('type !=','4');
		$this -> db -> where('wallet_type',''.$wallet_type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function sum_total_transfer($wallet_type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('withdrawal_balance');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('wallet_type',''.$wallet_type.'');
		$this -> db -> where('type','5');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	}
	
	function get_withdrawal_sum($wallet_type)
	{
		
		//$this -> db -> select('sum(amount) as tot_sum');
		$this -> db -> select('COALESCE(SUM(amount),0) AS tot_sum',false);
   		$this -> db -> from('withdrawal_balance');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		if($_POST['month_name']!=''){
			if($_POST['month_name']!='all'){
				$date 		= date('01-m-Y',strtotime($_POST['month_name']));
   				$end_date 	= date('t-m-Y',strtotime($_POST['month_name']));
				
				$this -> db -> where('timedt >=',''.strtotime($date).'');
				$this -> db -> where('timedt <=',''.strtotime($end_date).'');
			}	
		}
		$this -> db -> where('wallet_type',''.$wallet_type.'');
		$this -> db -> where('type !=','5');
		$this -> db -> where('type !=','4');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_active_dt()
	{
		$this -> db -> select('active_dt');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_earning_monthly()
	{
		$this -> db -> select('COALESCE(SUM(amount),0) AS tot_sum',false);
		$this -> db -> select('timestm');
   		$this -> db -> from('payment_daily');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('pay_type',''.$_POST['daily_earning'].'');
		if($_POST['month_name']!=''){
			if($_POST['month_name']!='all'){
				$date 		= date('01-m-Y',strtotime($_POST['month_name']));
   				$end_date 	= date('t-m-Y',strtotime($_POST['month_name']));
				
				$this -> db -> where('timestm >=',''.strtotime($date).'');
				$this -> db -> where('timestm <=',''.strtotime($end_date).'');
			}	
		}
		 $this -> db -> group_by('timestm'); 
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_earning_monthly_sum($month_name)
	{
		$this -> db -> select('COALESCE(SUM(amount),0) AS tot_sum',false);
   		$this -> db -> from('payment_daily');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('pay_type',''.$_POST['daily_earning'].'');
		if($_POST['month_name']!=''){
			if($_POST['month_name']!='all'){
				$date 		= date('01-m-Y',strtotime($_POST['month_name']));
   				$end_date 	= date('t-m-Y',strtotime($_POST['month_name']));
				
				$this -> db -> where('timestm >=',''.strtotime($date).'');
				$this -> db -> where('timestm <=',''.strtotime($end_date).'');
			}
			else{
				$date 		= date('01-m-Y',strtotime($month_name));
   				$end_date 	= date('t-m-Y',strtotime($month_name));
				
				$this -> db -> where('timestm >=',''.strtotime($date).'');
				$this -> db -> where('timestm <=',''.strtotime($end_date).'');
			}	
		}
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_earning_sum(){
		$this -> db -> select('COALESCE(SUM(amount),0) AS tot_sum',false);
   		$this -> db -> from('payment_daily');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('pay_type',''.$_POST['daily_earning'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	

}
?>
