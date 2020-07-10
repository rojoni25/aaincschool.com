<?php
Class online_payment_module extends CI_Model
{
 	
	
	function get_member_by_usercode($eid)
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_admin_email()
	{
		$this -> db -> select("emailid");
   		$this -> db -> from('admin_login');
		$this -> db -> where('usercode','1');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_setting_by_lable($eid){
		$this -> db -> select('*');
   		$this -> db -> from('site_settings');
		$this -> db -> where('lable_acces_nm',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['setting_value'];
	}
	
	function tree_upling($eid)
	{
		$this -> db -> select('uplingmember3_3 as ucode');
   		$this -> db -> from('member_node_master');
   		$this -> db -> where('usercode', ''.$eid.'');
		$this -> db -> where('uplingmember3_3 !=', '0');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_coded_residual($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('coded_residual');
   		$this -> db -> where('usercode', ''.$eid.'');
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
	
	function check_invoice_number($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('online_payment');
   		$this -> db -> where('txn_id',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_ams_member($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('n_product_member');
   		$this -> db -> where('usercode',''.$eid.'');
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
	
	function get_subscription_record($eid)
	{
   		$this -> db -> select('*');
   		$this -> db -> from('n_product_subscription');
		$this -> db -> where('subscription_id',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	
 
	
}
?>
