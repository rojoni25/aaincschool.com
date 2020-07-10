<?php
Class media_upload_model extends CI_Model
{
 	function get_media_by_type($type)
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('media_gallery');
   		$this -> db -> where('status','Active');
		$this -> db -> where('type',''.$type.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	function get_youtube()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('media_gallery');
   		$this -> db -> where('status','Active');
		$this -> db -> where('type','youtube');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_record($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('media_gallery');
		$this -> db -> where('gallerycode',''.$eid.'');
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
	
	function delete_record($id)
	{
		$this->db->where('gallerycode', $id);
		$this->db->delete('media_gallery');
	}
	function get_slider()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('slider_gallery');
   		$this -> db -> where('status','Active');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
}
?>
