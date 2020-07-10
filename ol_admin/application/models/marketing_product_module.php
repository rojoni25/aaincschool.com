<?php
Class marketing_product_module extends CI_Model
{
 	function one_time_payment($type)
 	{
   		$this -> db -> select('marketing_onetime_payment.*');
		$this -> db -> select('CONCAT(membermaster.fname, " ", SUBSTRING(membermaster.lname,1,1)) as name,membermaster.username',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = marketing_onetime_payment.usercode','left');
   		$this -> db -> from('marketing_onetime_payment');
		$this -> db -> where('marketing_onetime_payment.type',''.$type.'');
		$this -> db -> order_by('marketing_onetime_payment.id','DESC');
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	
	function nda_agree(){
		$this -> db -> select('nda_agree.*');
		$this -> db -> select('CONCAT(membermaster.fname, " ", SUBSTRING(membermaster.lname,1,1)) as name,membermaster.username',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = nda_agree.usercode','left');
   		$this -> db -> from('nda_agree');
		$this -> db -> order_by('nda_agree.id','DESC');
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
