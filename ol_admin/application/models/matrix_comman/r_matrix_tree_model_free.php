<?php
Class r_matrix_tree_model_free extends CI_Model
{
	
	
	
 	function getAll()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('country_master');
   		$this -> db -> where('status !=', 'Delete');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
 
	function get_downline_member($eid)
	{
		$this -> db -> select('CONCAT(membermaster.fname," ",SUBSTRING(membermaster.lname,1,1)) as name',FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix_free.*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_free');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix_free.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_free.upling_id', ''.$eid.'');
		$this -> db -> order_by(''.MATRIX_TABLE_PRE.'matrix_free.side', 'asc');
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_downline_member_count($eid)
	{
	
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_free');
		$this -> db -> where('upling_id', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	
	
	function userdt_by_code($eid){
		$this -> db -> select('CONCAT(membermaster.fname," ",SUBSTRING(membermaster.lname,1,1)) as name',FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix_free.*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_free');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix_free.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_free.idcode', ''.$eid.'');
		$this -> db -> order_by(''.MATRIX_TABLE_PRE.'matrix_free.side', 'asc');
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function get_user_filter($eid){
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix_free.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",SUBSTRING(membermaster.lname,1,1)) as name',FALSE);
		
   		$this -> db -> 	from(''.MATRIX_TABLE_PRE.'matrix_free');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix_free.usercode','left');
		if(isset($eid[1])){
			$this->db->where('(membermaster.fname="'.$eid[0].'" and membermaster.lname  LIKE "%'.$eid[1].'%")');
		}
		else{
			if (ctype_digit($eid[0])){
				$this -> db -> where('membermaster.usercode', ''.$eid[0].'');
			}
			else{
				$this->db->where('(fname  LIKE "%'.$eid[0].'%" or lname  LIKE "%'.$eid[0].'%")');
			}	
		}
		$this -> db ->	group_by("".MATRIX_TABLE_PRE."matrix_free.usercode");
		$this -> db ->	order_by("membermaster.fname", "asc");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function member_search($eid)
	{
		$this -> db -> select('DISTINCT  CONCAT(membermaster.fname," ",SUBSTRING(membermaster.lname,1,1)) as name',FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix_free.*');
   		$this -> db -> 	from(''.MATRIX_TABLE_PRE.'matrix_free');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix_free.usercode','left');
		if(isset($eid[1])){
			$this->db->where('(membermaster.fname="'.$eid[0].'" and membermaster.lname="'.$eid[1].'")');
		}
		else{
			if (ctype_digit($eid[0])){
				$this -> db -> where('membermaster.usercode',''.$eid[0].'');
			}
			else{
				$this->db->where('(fname  = "'.$eid[0].'" or lname = "'.$eid[0].'")');
			}	
		}
		
		$this -> db ->	order_by("membermaster.fname", "asc");
		$this -> db ->	group_by("".MATRIX_TABLE_PRE."matrix_free.usercode", "asc");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function member_all_dt_by_code($eid){
		$this -> db -> select('CONCAT(membermaster.fname," ",SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username, membermaster.mobileno, membermaster.phone_no',FALSE); 
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix_free.*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_free');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix_free.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_free.idcode', ''.$eid.'');
		$this -> db -> order_by(''.MATRIX_TABLE_PRE.'matrix_free.side', 'asc');
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_multi_position($eid)   
	{
		$this -> db -> select('CONCAT(user1.fname," ",SUBSTRING(user1.lname,1,1)) as name, user1.username,user1.password,user1.emailid,user1.mobileno,user1.phone_no,user1.status',FALSE);
		$this -> db -> select('CONCAT(user2.fname," ",SUBSTRING(user2.lname,1,1)) as name2, user2.username as username2',FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix_free.*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_free');
		$this -> db -> join('membermaster user1','user1.usercode = '.MATRIX_TABLE_PRE.'matrix_free.usercode','left');
		$this -> db -> join('membermaster user2','user2.usercode = '.MATRIX_TABLE_PRE.'matrix_free.upling_member','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_free.usercode',''.$eid.'');
		$this -> db -> order_by(''.MATRIX_TABLE_PRE.'matrix_free.idcode','asc');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_downline_one_level($id)
	{
		if($id==''){
			return;
		}
		$this -> db -> select('CONCAT(user1.fname," ",SUBSTRING(user1.lname,1,1)) as name, user1.username',FALSE);
		$this -> db -> select('CONCAT(user2.fname," ",SUBSTRING(user2.lname,1,1)) as name2, user2.username as username2',FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix_free.*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_free');
		$this -> db -> join('membermaster user1','user1.usercode = '.MATRIX_TABLE_PRE.'matrix_free.usercode','left');
		$this -> db -> join('membermaster user2','user2.usercode = '.MATRIX_TABLE_PRE.'matrix_free.upling_member','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_free.upling_id IN('.$id.')');
		$this -> db -> order_by(''.MATRIX_TABLE_PRE.'matrix_free.idcode','asc');
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
	
	function get_tree_record($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_free');
   		$this -> db -> where('idcode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	 //Member Serch//
	function search_member($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('(usercode="'.$eid.'")');
    	$query = $this -> db -> get();
    	$the_content = $query->row_array();
    	return $the_content;
	}
	function search_member_from_angel($aid){
		$this -> db -> select('*');
		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_free MT');
		$this -> db -> join('membermaster M','M.usercode = MT.usercode','left');
		$this -> db -> where('(MT.idcode="'.$aid.'")');
    	$query = $this -> db -> get();
    	$the_content = $query->row_array();
    	return $the_content;
	}
	function get_current_position($eid,$usercode){
		$this -> db -> select('COUNT(idcode) as cntno');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_free');
		$this -> db -> where('(idcode <='.$eid.' and usercode ='.$usercode.') ');
		$this->db->group_by('usercode');
    	$query = $this -> db -> get();
    	$the_content = $query->row_array();
    	return $the_content;
	}
}
?>
