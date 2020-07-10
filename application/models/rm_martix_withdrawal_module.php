<?php
Class rm_martix_withdrawal_module extends CI_Model
{
 	
 
 	function get_pending_request($eid){
		$this -> db -> select('*');
   		$this -> db -> from('rm_member_withdrawal_request');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('req_id NOT IN (select req_id from rm_member_withdrawal where req_id!="0")');
		$this -> db -> where('status','P');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	function get_payment_sum_by_type($wallet_type)
	{
		$this -> db -> select('SUM(amount) as tot');
   		$this -> db -> from('rm_member_payment');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('wallet_type','COIN');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];
	}
	
	function get_withdrawal_sum_by_type($wallet_type)
	{
		$this -> db -> select('SUM(amount) as tot');
   		$this -> db -> from('rm_member_withdrawal');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('wallet_type','COIN');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];
	}
	
	function get_withdrawal_record()
	{
		$this -> db -> select('*');
   		$this -> db -> from('rm_member_withdrawal');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('wallet_type','COIN');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;
	}
	
	function get_rm_admin_email(){
		$this -> db -> select('membermaster.emailid');
   		$this -> db -> from('rm_matrix_admin');
		$this -> db -> join('membermaster','membermaster.usercode = rm_matrix_admin.usercode','left');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		$arr=array();
		for($i=0;$i<count($the_content);$i++){
			$arr[]=$the_content[$i]['emailid'];
		}
    	return implode(', ',$arr);;
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
