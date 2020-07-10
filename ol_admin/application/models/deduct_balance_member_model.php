<?php
Class deduct_balance_member_model extends CI_Model
{
 	function getAll()
 	{	
   		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.username');
		$this -> db -> select('withdrawal_balance.*');
   		$this -> db -> from('withdrawal_balance');
		$this -> db -> join('membermaster','membermaster.usercode = withdrawal_balance.usercode','left');
   		$this -> db -> where('withdrawal_balance.type','4');
		$this -> db -> order_by("withdrawal_balance.withdrawal_code","desc");
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_balance_dt($eid){
		$this -> db -> select('*');
   		$this -> db -> from('master_balance_sheet');
   		$this -> db -> where('usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 
 	function master_balance_update($field, $usercode, $amount, $opration){
		
		if($opration=='plus'){
			$this->db->set(''.$field.'', '`'.$field.'`+ '.$amount.'', FALSE);
		}
		if($opration=='minus'){
			$this->db->set(''.$field.'', '`'.$field.'`- '.$amount.'', FALSE);
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
