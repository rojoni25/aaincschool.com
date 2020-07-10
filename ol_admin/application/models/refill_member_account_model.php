<?php
Class refill_member_account_model extends CI_Model
{
 	function getAll()
 	{	
   		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.username');
		$this -> db -> select('refill_account.*');
   		$this -> db -> from('refill_account');
		$this -> db -> join('membermaster','membermaster.usercode = refill_account.usercode','left');
   		$this -> db -> where('refill_account.option','refill_by_admin');
		$this -> db -> order_by("refill_account.id","desc");
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
 
 	function master_balance_update($field, $usercode, $amount, $opration){
		
		if($opration=='plus'){
			$this->db->set(''.$field.'', '`'.$field.'`+ '.$amount.'', FALSE);
		}
			
		$this->db->where('usercode',''.$usercode.'');
		$this->db->update('master_balance_sheet');
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
