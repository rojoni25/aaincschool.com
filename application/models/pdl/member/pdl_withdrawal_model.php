<?php
Class pdl_withdrawal_model extends CI_Model
{
	
	
	
	function check_pending_request($wallet_type)
 	{
   		$this -> db -> select('*');
   		$this -> db -> from('pdl_withdrawal_request');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('wallet_type',''.$wallet_type.'');
		$this -> db -> where('status !=','delete');
		$this -> db -> where('request_code	NOT IN (select request_code from pdl_withdrawal)');
		
		$query = $this -> db -> get();
		$the_content = $query->result_array();
		
    	return  isset($the_content[0]) ? true : false;	
 	}
	
	function get_pending_request($wallet_type)
 	{
   		$this -> db -> select('*');
   		$this -> db -> from('pdl_withdrawal_request');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('wallet_type',''.$wallet_type.'');
		$this -> db -> where('status !=','delete');
		$this -> db -> where('request_code	NOT IN (select request_code from pdl_withdrawal)');
		
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
		
		return $the_content;
 	}
	
	function get_withdrawal()
 	{
   		$this -> db -> select('*');
   		$this -> db -> from('pdl_withdrawal');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
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
	
	function request_delete($eid){
		
		$this->db->where('request_code',$eid);
		$this->db->where('usercode',$this->session->userdata['logged_ol_member']['usercode']);
		$this->db->where('status','pending');
		$this->db->delete('pdl_withdrawal_request'); 
	}
	
	function get_cms_page()
	{
		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable','pdl_product_page');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
		return $the_content;		
	}
	
	

}
?>
