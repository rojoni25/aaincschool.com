<?php
Class member_payment_model extends CI_Model
{
 	function getAll()
 	{	
   		$this -> db -> select('payment_master.*');
		$this -> db -> select('membermaster.fname,membermaster.lname');
   		$this -> db -> from('payment_master');
		$this -> db -> join('membermaster','membermaster.usercode = payment_master.usercode','left');
	
		if($this->input->post('searchby')=='name'){
			$this->db->where('(membermaster.fname  LIKE "%'.$this->input->post('txtfilter').'%" or membermaster.lname  LIKE "%'.$this->input->post('txtfilter').'%")');	
		}
		if($this->input->post('searchby')=='date'){
			$todate=date("Y-m-d", strtotime($this->input->post('todate')));
			$fromdate=date("Y-m-d", strtotime($this->input->post('fromdate')));
			if($this->input->post('todate')!='' && $this->input->post('fromdate')!=''){
				$this -> db -> where('payment_master.paydate >=',$todate);
				$this -> db -> where('payment_master.paydate <=',$fromdate);
			}
			else{
				$this -> db -> where('payment_master.paydate',$todate);
			}
		}
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
 	function get_setting_value_by_lable($value){
		$this -> db -> select('*');
   		$this -> db -> from('site_settings');
   		$this -> db -> where('lable_acces_nm', ''.$value.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function referral_user($eid)
	{
		$this -> db -> select('referralid');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		if($the_content[0]['referralid']=='0'){
			$the_content[0]['referralid']='';
		}
    	return $the_content;
	}
	function tree_upling($eid, $field)
	{
		$this -> db -> select($field);
   		$this -> db -> from('member_node_master');
   		$this -> db -> where('usercode', ''.$eid.'');
		$this -> db -> where($field.' !=', '0');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 	function get_record($eid){
		$this -> db -> select('*');
   		$this -> db -> from('country_master');
   		$this -> db -> where('country_code', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_user_reffral($usercode){
		$this -> db -> select('referralid');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', ''.$usercode.'');
		$this -> db -> where('status', 'Active');
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
	function get_total_reffral($usercode){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('referralid', ''.$usercode.'');
		$this -> db -> where('status', 'Active');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_coded_by($usercode, $type){
		$this -> db -> select('usercode_by as ucode, level');
   		$this -> db -> from('coded_residual');
   		$this -> db -> where('usercode', ''.$usercode.'');
		$this -> db -> where('type', ''.$type.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_coded_residual($usercode){
		$this -> db -> select('usercode_by as ucode, level, type');
   		$this -> db -> from('coded_residual');
   		$this -> db -> where('usercode', ''.$usercode.'');
		$this -> db -> where('(type="coded" or type="residual")');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_coded_match_residual_match($usercode){
		$this -> db -> select('usercode_by as ucode, level, type');
   		$this -> db -> from('coded_residual');
   		$this -> db -> where('usercode', ''.$usercode.'');
		$this -> db -> where('(type="coded_match" or type="residual_match")');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
  	
  
	
}
?>
