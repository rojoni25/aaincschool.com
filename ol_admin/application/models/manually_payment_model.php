<?php
Class manually_payment_model extends CI_Model
{
 	function get_free_request()
 	{	
		$this -> db -> select('paid_request_master.*');
   		$this -> db -> select('membermaster.fname, membermaster.lname, membermaster.status');
   		$this -> db -> from('paid_request_master');
		$this -> db -> join('membermaster','paid_request_master.usercode = membermaster.usercode');
   		$this -> db -> where('paid_request_master.status','Active');
		$this -> db -> where('paid_request_master.payment','N');
		$this -> db -> where('membermaster.status','Pending');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
 
 	function get_memeber_list_to_access()
	{
		$this -> db -> select('membermaster.*');
   		$this -> db -> select('product_access_permission.idcode');
   		$this -> db -> from('product_access_permission');
		$this -> db -> join('membermaster','membermaster.usercode = product_access_permission.usercode','left');
   		$this -> db -> where('membermaster.status','Pending');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_user_filter($eid){
		$this -> db -> 	select('fname,lname,usercode');
   		$this -> db -> 	from('membermaster');
		if(isset($eid[1])){
			$this->db->where('(fname="'.$eid[0].'" and lname  LIKE "%'.$eid[1].'%")');
		}
		else{
			
			$this->db->where('(fname  LIKE "%'.$eid[0].'%" or lname  LIKE "%'.$eid[0].'%"  or usercode  LIKE "%'.$eid[0].'%")');
		}
		
		$this -> db -> where('status','Pending');
		$this->db->where("usercode NOT IN (select usercode from product_access_permission)", NULL, FALSE);
		$this -> db ->	order_by("fname", "asc");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function deleterow($eid)
	{
		$this->db->where('idcode', $eid);
		$this->db->delete('product_access_permission');
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
