<?php
Class withdrawal_request_module extends CI_Model
{
 	function get_pages_contain($pagelable)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable', ''.$pagelable.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	
	function get_all_withdrawal_request()
	{
		$this -> db -> select('*');
   		$this -> db -> from('withdrawal_request_master');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
	
		$this -> db  -> order_by("request_code","desc");
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_last_withdrawal_request(){
		$this -> db -> select('*');
   		$this -> db -> from('withdrawal_request_master');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('status !=','delete');
		$this -> db -> order_by("request_code", "DESC");
    	$this -> db -> limit(1);
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_all_withdrawal($type)
	{
		$this -> db -> select('*');
   		$this -> db -> from('withdrawal_balance');
   		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('type !=','5');
		$this -> db -> where('wallet_type',''.$type.'');
		$this -> db  -> order_by("withdrawal_code","desc");
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function get_current_balance()
	{
		$this -> db -> select('*');
   		$this -> db -> from('master_balance_sheet');
   		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function sum_withdrawal_balance($type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('withdrawal_balance');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('type !=','5');
		$this -> db -> where('wallet_type',''.$type.'');
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
	
	function get_admin_emailid()
	{
		$this -> db -> select('emailid');
   		$this -> db -> from('admin_login');
   		$this -> db -> where('usercode','1');
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
	function delete_record($data,$eid){
		$this->db->where('usercode',$this->session->userdata['logged_ol_member']['usercode']);
		$this->db->where('request_code',$eid);
		$this->db->where('status','pending');
		$this->db->update('withdrawal_request_master', $data);
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
	
}
?>
