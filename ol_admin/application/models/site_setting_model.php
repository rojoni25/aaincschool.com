<?php
Class site_setting_model extends CI_Model
{
 	function getAll()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('site_settings');
   		$this -> db -> where('status', 'active');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
 
 	function get_record($eid){
		$this -> db -> select('*');
   		$this -> db -> from('site_settings');
   		$this -> db -> where('setting_id', ''.$eid.'');
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
  	
  	function updateSetting($data)
	{
		//$this->load->database();
		//print_r($data);
		foreach($data as $dk=>$dv){
			$check = checkconfigMeta($dk);
			if(!$check){
				$this->db->set('setting_key', $dk);
				$this->db->set('setting_value', $dv);
				$this->db->insert('tbl_settings');
			}else{
				$data = array('setting_value'=>$dv);
				$this->db->where('setting_key',$dk);
				$this->db->update('tbl_settings',$data);
			}
		}
	}
  
	
}
?>
