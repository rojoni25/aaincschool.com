<?php
Class pif_friend_module extends CI_Model
{
 	
 	
 	function get_all_pif($eid)
	{
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix_request.*'); 
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_request');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix_request.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.pif_by',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.req_type','PIF');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function member_search($eid)
	{
		$this -> db -> select('DISTINCT  CONCAT(fname," ",SUBSTRING(lname,1,1)) as name, usercode',FALSE);
		
   		$this -> db -> 	from('membermaster');
		
		if(isset($eid[1])){
			
			$this->db->where('(fname="'.$eid[0].'" and lname="'.$eid[1].'")');
			
		}
		else{
			
			if (ctype_digit($eid[0])){
				
				$this -> db -> where('usercode',''.$eid[0].'');
				
			}
			else{
				
				$this->db->where('(fname  = "'.$eid[0].'" or lname = "'.$eid[0].'")');
				
			}	
		}
		
		$this->db->where('usercode NOT IN (select usercode from '.MATRIX_TABLE_PRE.'matrix)');
		
		$this -> db ->	order_by("fname", "asc");
		
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
	
	function get_payment_sum_by_type($eid,$wallet_type)
	{
		$this -> db -> select('SUM(amount) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_payment');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('wallet_type','COIN');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];
	}
	
	function get_withdrawal_sum_by_type($eid,$wallet_type)
	{
		$this -> db -> select('SUM(amount) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_withdrawal');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('wallet_type','COIN');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];
	}
	
	function get_admin_email(){
		$this -> db -> select('membermaster.emailid');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_admin');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix_admin.usercode','left');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		$arr=array();
		for($i=0;$i<count($the_content);$i++){
			$arr[]=$the_content[$i]['emailid'];
		}
    	return implode(', ',$arr);;
	}	
	
	function get_member_by_code($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		
		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		return $the_content[0];
	}


	
	
	
	
		
}
?>
