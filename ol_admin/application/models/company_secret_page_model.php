<?php
Class company_secret_page_model extends CI_Model
{
 	function getAll()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('compay_secret_page');
   		$this -> db -> where('status !=', 'Delete');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
 
 	function get_record($eid){
		$this -> db -> select('*');
   		$this -> db -> from('compay_secret_page');
   		$this -> db -> where('secret_page_code', ''.$eid.'');
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
	
	function get_member_by_usercode($usercode){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode', ''.$usercode.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function check_permition($arr){
		$this -> db -> select('*');
   		$this -> db -> from('compay_secret_page_permission');
   		$this -> db -> where('secret_page_code', ''.$arr['secret_page_code'].'');
		$this -> db -> where('usercode', ''.$arr['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_permission_listing($pagecode){
		$this -> db -> select('compay_secret_page_permission.permission_code');
		$this -> db -> select('membermaster.*');
   		$this -> db -> from('compay_secret_page_permission');
		$this -> db -> join('membermaster','compay_secret_page_permission.usercode = membermaster.usercode','left');
   		$this -> db -> where('compay_secret_page_permission.secret_page_code',''.$pagecode.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function get_user_filter($eid,$pagecode){
		$this -> db -> 	select('fname,lname,usercode');
   		$this -> db -> 	from('membermaster');
		if(isset($eid[1])){
			$this->db->where('(fname="'.$eid[0].'" and lname  LIKE "%'.$eid[1].'%")');
		}
		else{
			if (ctype_digit($eid[0])){
				$this -> db -> where('usercode', ''.$eid[0].'');
			}
			else{
				$this->db->where('(fname  LIKE "%'.$eid[0].'%" or lname  LIKE "%'.$eid[0].'%")');
			}	
		}
		$this -> db -> where('usercode NOT IN (select usercode from compay_secret_page_permission where secret_page_code="'.$pagecode.'")');
		$this -> db ->	order_by("fname", "asc");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function row_delete($eid)
  	{
      $this->db->where('permission_code', $eid);
      $this->db->delete('compay_secret_page_permission'); 
  	}
  	
  
	
}
?>
