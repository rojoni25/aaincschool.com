<?php
Class r_matrix_withdrawal_model extends CI_Model
{
 	
	
 
 	function get_all_pending_request($eid){
		
		$this -> db -> select(''.MATRIX_TABLE_PRE.'member_withdrawal_request.*');
		$this -> db -> select('CONCAT(membermaster.fname, " ", SUBSTRING(membermaster.lname,1,1)) as name',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'member_withdrawal_request.usercode','left');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_withdrawal_request');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'member_withdrawal_request.req_id NOT IN (select req_id from '.MATRIX_TABLE_PRE.'member_withdrawal)');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'member_withdrawal_request.status !=','C');	
		$this -> db -> order_by(''.MATRIX_TABLE_PRE.'member_withdrawal_request.time_dt', 'asc');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function get_pending_request_by_id($eid){
		
		$this -> db -> select(''.MATRIX_TABLE_PRE.'member_withdrawal_request.*');
		$this -> db -> select('CONCAT(membermaster.fname, " ", SUBSTRING(membermaster.lname,1,1)) as name, membermaster.emailid',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'member_withdrawal_request.usercode','left');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_withdrawal_request');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'member_withdrawal_request.req_id NOT IN (select req_id from '.MATRIX_TABLE_PRE.'member_withdrawal)');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'member_withdrawal_request.status !=','C');	
		$this -> db -> where(''.MATRIX_TABLE_PRE.'member_withdrawal_request.req_id',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function withdrawal_report()
	{
		$this -> db -> select(''.MATRIX_TABLE_PRE.'member_withdrawal.*');
		$this -> db -> select('CONCAT(membermaster.fname, " ", SUBSTRING(membermaster.lname,1,1)) as name, membermaster.emailid',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'member_withdrawal.usercode','left');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_withdrawal');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function count_withdrawal_report()
	{
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_withdrawal');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_member_email($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('email_verification','Y');	
		$this -> db -> where('subscribe','Y');
		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (isset($the_content[0])) ? true : false;	
	}
	
	function get_tot_pif_report(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_upgrade_pay');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	function get_admin_email(){
		$this -> db -> select('membermaster.emailid');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_admin');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix_admin.usercode','left');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		$arr=array();
		for($i=0;$i<count($the_content);$i++){
			$arr[]=$the_content[$i]['emailid'];
		}
    	return implode(', ',$arr);;
	}	

	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	
	function get_payment_sum_by_type($eid)
	{
		$this -> db -> select('SUM(amount) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_payment');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('wallet_type','COIN');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];
	}
	
	function get_withdrawal_sum_by_type($eid)
	{
		$this -> db -> select('SUM(amount) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_withdrawal');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('wallet_type','COIN');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];
	}	
	
	
	
	
	
	
	
	
	
}
?>
