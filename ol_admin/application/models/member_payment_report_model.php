<?php
Class member_payment_report_model extends CI_Model
{
 
	function count_all_paid_member(){
		
		$this -> db -> select("count(*) as tot");
   		$this -> db -> from('payment_master');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member_by_usercode($eid){
		
		$this -> db -> select("fname, lname, usercode, username");
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_pay_sum(){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_master');
		if($_POST['fromdate']!=''){
			$todate = strtotime($_POST['todate']);
			$fromdate = strtotime($_POST['fromdate']);
			$this -> db -> where('timedt >=',''.$todate.'');
			$this -> db -> where('timedt <=',''.$fromdate.'');
		}
		else{
			if($_POST['todate']!=''){
				$todate = strtotime($_POST['todate']);
				$this -> db -> where('timedt',''.$todate.'');
			}
		}
		
		if($_POST['usercode']!=''){
			$this -> db -> where('usercode',''.$_POST['usercode'].'');
		}
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_pay_member_list()
	{
		$this -> db -> select('payment_master.*');
		$this -> db -> select('membermaster.*');
   		$this -> db -> from('payment_master');
		$this -> db -> join('membermaster','payment_master.usercode = membermaster.usercode','left');
		
		if($_POST['fromdate']!=''){
			$todate = strtotime($_POST['todate']);
			$fromdate = strtotime($_POST['fromdate']);
			$this -> db -> where('payment_master.timedt >= ',''.$todate.'');
			$this -> db -> where('payment_master.timedt <=',''.$fromdate.'');
		}
		else{
			if($_POST['todate']!=''){
				$todate = strtotime($_POST['todate']);
				$this -> db -> where('payment_master.timedt',''.$todate.'');
			}
		}
		
		if($_POST['usercode']!=''){
			$this -> db -> where('payment_master.usercode',''.$_POST['usercode'].'');
		}
    	
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	
		return $the_content;
	}
	
	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	
	
 
 
	
}
?>
