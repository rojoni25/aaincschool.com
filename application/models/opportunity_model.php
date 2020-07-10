<?php
Class opportunity_model extends CI_Model
{
 	function get_all()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('company_master');
   		$this -> db -> where('status !=', 'Delete');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	
	function get_page($value)
	{
		$this -> db -> select('*');
   		$this -> db -> from('company_master');
   		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_record($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('company_master');
   		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('company_code', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function getJoined_pages($eid)
	{
		$this -> db -> select('company_master.*');
   		$this -> db -> from('company_join_dt');
		$this -> db -> join('company_master','company_master.company_code = company_join_dt.company_code','left');
   		$this -> db -> where('company_join_dt.usercode = '.$this->session->userdata['logged_ol_member']['referralid_free'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
		function getAll_pages()
	{
	    $referral_code=$this->session->userdata['logged_ol_member']['ref_by'];
		$this -> db -> select('*');
   		$this -> db -> from('company_master');
   		$this -> db -> where('usercode = '.$referral_code.'');
   		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_pages_contain_two($pagelable)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable', ''.$pagelable.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	function self_company()
	{
		$this -> db -> select('*');
		$this -> db -> from('company_master');
   		$this -> db -> where('usercode = '.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function get_pages_contain($eid)
	{
		$this -> db -> select('*');
		$this -> db -> from('company_master');
   		$this -> db -> where('company_code = '.$eid.'');
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
	
	function row_delete($eid)
  	{
	  $this->db->where('company_code',$eid);		
      $this->db->where('usercode',$this->session->userdata['logged_ol_member']['usercode']);
      $this->db->delete('company_join_dt'); 
 	}
 	//===============For counting number of opportunities created by uses==========================
 	function get_pages_count(){
 	    $this -> db -> select('count(*) as ccount');
   		$this -> db -> from('company_master');
   		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	
    	return $the_content[0]["ccount"];
 	}
  	
	
		
 
 	
  	
  
	
}
?>
