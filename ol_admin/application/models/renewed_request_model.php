<?php
Class renewed_request_model extends CI_Model
{
 	
 
	function get_all_request()
	{
		$this -> db -> select('*');
   		$this -> db -> from('request_to_renewal');
		$this -> db -> where('request_status','Pending');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member_by_usercode($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_current_balance($eid)
	{
		$this -> db -> select('main_balance');
   		$this -> db -> from('master_balance_sheet');
   		$this -> db -> where('usercode',''.$eid.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return (float)$the_content[0]['main_balance'];
	}
	
	function get_payment_level($usercode){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('payment_master');
   		$this -> db -> where('usercode',''.$usercode.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_request_by_code($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('request_to_renewal');
		$this -> db -> where('request_status','Pending');
		$this -> db -> where('request_code',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_upgrade_request($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('paid_request_master');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('status','Active');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function master_balance_update($field, $usercode, $amount, $opration){

			if($opration=='plus'){
				$this->db->set(''.$field.'', '`'.$field.'`+ '.$amount.'', FALSE);
			}
			if($opration=='minus'){
				$this->db->set(''.$field.'', '`'.$field.'`- '.$amount.'', FALSE);
			}
			$this->db->where('usercode',''.$usercode.'');
			$this->db->update('master_balance_sheet');
	}
	
	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	
	function request_report()
	{
		$this -> db -> select('request_to_renewal.*');
		$this -> db -> select("CONCAT(rby.fname,' ',rby.lname) AS req_by_nm, rby.username as rby_username",FALSE);
		$this -> db -> select("CONCAT(rfor.fname,' ',rfor.lname) AS req_for_nm, rfor.username as rfor_username",FALSE);
   		$this -> db -> from('request_to_renewal');
		$this -> db -> join('membermaster rby','request_to_renewal.usercode = rby.usercode','left');
		$this -> db -> join('membermaster rfor','request_to_renewal.renewal_usercode = rfor.usercode','left');
		$this -> db -> where('request_to_renewal.request_status !=','Delete');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
}
?>
