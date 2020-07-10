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
		$this -> db -> select('CONCAT(membermaster.fname," ",SUBSTRING(membermaster.lname,1,1)) as name',FALSE);
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
		$this -> db -> select('CONCAT(membermaster.fname," ",SUBSTRING(membermaster.lname,1,1)) as name',FALSE);
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
		$this -> db -> select('rm_matrix.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",SUBSTRING(membermaster.lname,1,1)) as name',FALSE);
		
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
		$this -> db ->	group_by("rm_matrix.usercode");
		$this -> db ->	order_by("membermaster.fname", "asc");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function member_search($eid)
	{
		$this -> db -> select('DISTINCT  CONCAT(membermaster.fname," ",SUBSTRING(membermaster.lname,1,1)) as name',FALSE);
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
		$this -> db -> select('CONCAT(membermaster.fname," ",SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username, membermaster.mobileno, membermaster.phone_no',FALSE); 
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
		$this -> db -> select('CONCAT(user1.fname," ",SUBSTRING(user1.lname,1,1)) as name, user1.username,user1.password,user1.emailid,user1.mobileno,user1.phone_no,user1.status',FALSE);
		$this -> db -> select('CONCAT(user2.fname," ",SUBSTRING(user2.lname,1,1)) as name2, user2.username as username2',FALSE);
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
	
	function get_downline_one_level($id)
	{
		if($id==''){
			return;
		}
		$this -> db -> select('CONCAT(user1.fname," ",SUBSTRING(user1.lname,1,1)) as name, user1.username',FALSE);
		$this -> db -> select('CONCAT(user2.fname," ",SUBSTRING(user2.lname,1,1)) as name2, user2.username as username2',FALSE);
		$this -> db -> select('rm_matrix.*');
   		$this -> db -> from('rm_matrix');
		$this -> db -> join('membermaster user1','user1.usercode = rm_matrix.usercode','left');
		$this -> db -> join('membermaster user2','user2.usercode = rm_matrix.upling_member','left');
		$this -> db -> where('rm_matrix.upling_id IN('.$id.')');
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
	
	function test_count($id)
	{
		$this -> db -> select('count(tb3.idcode) as tot');
   		$this -> db -> from('rm_matrix');
		$this -> db -> join('rm_matrix tb1','rm_matrix.idcode = tb1.upling_id','left');
		$this -> db -> join('rm_matrix tb2','tb1.idcode 	= tb2.upling_id','left');
		$this -> db -> join('rm_matrix tb3','tb2.idcode 	= tb3.upling_id','left');
		$this -> db -> where('rm_matrix.idcode',''.$id.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	
}
?>
