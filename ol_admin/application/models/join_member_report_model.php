<?php
Class join_member_report_model extends CI_Model
{
 	function get_first_member_add_date()
 	{	
   		$this -> db -> select('MIN(add_time) as dt');
   		$this -> db -> from('membermaster');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function join_month_date_wise($dt)
	{
		
		$f_date		=	strtotime($_POST['month_name']);
   		$l_date 	=   strtotime(date('t-m-Y',$f_date));
		
		$get_time=($_POST['report_type']=='join') ? "add_time" : "active_date";
		
   		$this -> db -> select(''.$get_time.' as timedt, count(*) as tot');
		
   		$this -> db -> from('membermaster');
		if($_POST['report_type']=='join')
		{
			$this -> db -> where('add_time >=', ''.$f_date.'');
			$this -> db -> where('add_time <=', ''.$l_date.'');
			
			$this	->	db	->	group_by('add_time');
 		 	$this	->	db	->	order_by('add_time', 'ASC'); 
		}
		
		if($_POST['report_type']=='active')
		{
			$this -> db -> where('active_date >=', ''.$f_date.'');
			$this -> db -> where('active_date <=', ''.$l_date.'');
			
			$this	->	db	->	group_by('active_date');
	 	    $this	->	db	->	order_by('active_date', 'ASC'); 
		}
		
	
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function join_month_wise_tot(){
		$f_date		=	strtotime($_POST['month_name']);
   		$l_date 	=   strtotime(date('t-m-Y',$f_date));
		
   		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
		
		if($_POST['report_type']=='join')
		{
			$this -> db -> where('add_time >=', ''.$f_date.'');
			$this -> db -> where('add_time <=', ''.$l_date.'');
		}
		
		if($_POST['report_type']=='active')
		{
			$this -> db -> where('active_date >=', ''.$f_date.'');
			$this -> db -> where('active_date <=', ''.$l_date.'');
		}
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member_by_detail($arr){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		
		if($arr['report_type']=='join')
		{
			$this -> db -> where('add_time',''.$arr['dt'].'');
		}
		
		if($arr['report_type']=='active')
		{
			$this -> db -> where('active_date',''.$arr['dt'].'');
		}
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function report_renew()
	{
		$f_date		=	strtotime($_POST['month_name']);
   		$l_date 	=   strtotime(date('t-m-Y',$f_date));
		
		$sQuery='SELECT 
		payment_master.usercode,payment_master.timedt, COUNT(payment_master.usercode) AS tot_pay,
		membermaster.fname, membermaster.lname, membermaster.username
		FROM payment_master
		INNER JOIN  membermaster ON membermaster.usercode=payment_master.usercode
		WHERE payment_master.timedt>='.$f_date.' AND
		payment_master.timedt<='.$l_date.' AND
		payment_master.usercode IN(select usercode from payment_master GROUP BY usercode HAVING COUNT(usercode) > 1)
		GROUP BY payment_master.usercode ORDER BY payment_master.timedt ASC';
				
		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
	}
	
 	
  
	
}
?>
