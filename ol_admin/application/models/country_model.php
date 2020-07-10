<?php
Class country_model extends CI_Model
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
 
 	function get_record($eid){
		$this -> db -> select('*');
   		$this -> db -> from('country_master');
   		$this -> db -> where('country_code', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member(){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('add_time','0');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_record_member(){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('status','Active');
		$this -> db -> where('usercode NOT IN (select usercode from master_balance_sheet)');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_member_code_in_table($arr){
		$this -> db -> select('*');
   		$this -> db -> from($arr['tbl']);
   		$this -> db -> where($arr['f'],''.$arr['v'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_upling_chain($eid, $field)
	{
		$this -> db  -> select('member_node_master.'.$field.' as lev1');
		$this -> db  -> select('tbl1.'.$field.' as lev2');
		$this -> db  -> select('tbl2.'.$field.' as lev3');
   		$this -> db  -> from('member_node_master');
		$this -> db -> join('member_node_master tbl1','member_node_master.'.$field.' = tbl1.usercode','left');
		$this -> db -> join('member_node_master tbl2','tbl1.'.$field.' = tbl2.usercode','left');
   		$this -> db  -> where('member_node_master.usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		$arr=array();
		$arr['lev1']=($the_content[0]['lev1']=='0')? "1" : $the_content[0]['lev1'];
		$arr['lev2']=($the_content[0]['lev2']=='0')? "1" : $the_content[0]['lev2'];
		$arr['lev3']=($the_content[0]['lev3']=='0')? "1" : $the_content[0]['lev3'];
		
    	return $arr;
	}
	
	function n_product_member(){
		$this -> db -> select('*');
   		$this -> db -> from('n_product_member');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function last_payment($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('n_product_monthly_payment');
   		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> limit(1);
		$this -> db -> order_by('time_dt','DESC');
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
