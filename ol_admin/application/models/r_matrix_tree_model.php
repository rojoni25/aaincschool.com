<?php
Class r_matrix_tree_model extends CI_Model
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
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db -> select('rm_matrix.*');
   		$this -> db -> from('rm_matrix');
		$this -> db -> join('membermaster','membermaster.usercode = rm_matrix.usercode','left');
		$this -> db -> where('rm_matrix.upling_id', ''.$eid.'');
		$this -> db -> order_by('rm_matrix.side', 'asc');
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_downline_member_count($eid)
	{
	
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('rm_matrix');
		$this -> db -> where('upling_id', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	
	
	function userdt_by_code($eid){
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db -> select('rm_matrix.*');
   		$this -> db -> from('rm_matrix');
		$this -> db -> join('membermaster','membermaster.usercode = rm_matrix.usercode','left');
		$this -> db -> where('rm_matrix.idcode', ''.$eid.'');
		$this -> db -> order_by('rm_matrix.side', 'asc');
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function get_user_filter($eid){
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db -> select('rm_matrix.*');
   		$this -> db -> 	from('rm_matrix');
		$this -> db -> join('membermaster','membermaster.usercode = rm_matrix.usercode','left');
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
		
		$this -> db ->	order_by("membermaster.fname", "asc");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function member_search($eid)
	{
		$this -> db -> select('DISTINCT  CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db -> select('rm_matrix.*');
   		$this -> db -> 	from('rm_matrix');
		$this -> db -> join('membermaster','membermaster.usercode = rm_matrix.usercode','left');
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
		$this -> db ->	group_by("rm_matrix.usercode", "asc");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function member_all_dt_by_code($eid){
		$this -> db -> select('membermaster.*',FALSE);
		$this -> db -> select('rm_matrix.*');
   		$this -> db -> from('rm_matrix');
		$this -> db -> join('membermaster','membermaster.usercode = rm_matrix.usercode','left');
		$this -> db -> where('rm_matrix.idcode', ''.$eid.'');
		$this -> db -> order_by('rm_matrix.side', 'asc');
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_multi_position($eid)
	{
		$this -> db -> select('CONCAT(user1.fname," ",user1.lname) as name, user1.username,user1.password,user1.emailid,user1.mobileno,user1.phone_no,user1.status',FALSE);
		$this -> db -> select('CONCAT(user2.fname," ",user2.lname) as name2, user2.username as username2',FALSE);
		$this -> db -> select('rm_matrix.*');
   		$this -> db -> from('rm_matrix');
		$this -> db -> join('membermaster user1','user1.usercode = rm_matrix.usercode','left');
		$this -> db -> join('membermaster user2','user2.usercode = rm_matrix.upling_member','left');
		$this -> db -> where('rm_matrix.usercode',''.$eid.'');
		$this -> db -> order_by('rm_matrix.idcode','asc');
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
	
	
	
	
}
?>
