<?php
Class n_product_blog_module extends CI_Model
{
 	function get_my_blog()
 	{
   		$this -> db -> select('*');
   		$this -> db -> from('n_product_blog');
   		$this -> db -> where('usercode','-1');
		$this -> db -> where('status !=','Delete');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	
	function get_blog_by_id($eid){
		
		$this -> db -> select('*');
   		$this -> db -> from('n_product_blog');
   		$this -> db -> where('usercode','-1');
		$this -> db -> where('id',''.$eid.'');
		$this -> db -> where('status !=','Delete');
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
	
	function delete_blog($data,$eid)
	{
		$this->db->where('id',$eid);
		$this->db->update('n_product_blog',$data);
	}
	
}
?>
