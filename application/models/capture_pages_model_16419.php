<?php
Class capture_pages_model extends CI_Model
{
 	function getAll($page_section)
 	{	
   		$this -> db -> select('capture_page_master.*');
		$this -> db -> select('capture_page_record.pagelable');
		$this -> db -> select('membermaster.fname, membermaster.lname');
   		$this -> db -> from('capture_page_master');
		$this -> db -> join('membermaster','membermaster.usercode = capture_page_master.usercode','left');
		$this -> db -> join('capture_page_record','capture_page_master.pagecode = capture_page_record.pagename','left');
   		$this -> db -> where('capture_page_master.status !=', 'Delete');
		$this -> db -> where('capture_page_master.usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('capture_page_master.page_section',''.$page_section.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_free_page($field,$page_section){
		$this -> db -> select('capture_page_master.*');
		$this -> db -> select('capture_page_record.pagelable');
   		$this -> db -> from('capture_page_master');
		$this -> db -> join('capture_page_record','capture_page_master.pagecode = capture_page_record.pagename','left');
		$this -> db -> where("(capture_page_master.page_for='both' || capture_page_master.page_for='".$field."')");
   		$this -> db -> where('capture_page_master.status !=', 'Delete');
		$this -> db -> where('capture_page_master.change', 'N');
		$this -> db -> where('capture_page_master.page_section',''.$page_section.'');
		$this -> db -> where('capture_page_master.usercode', '0');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_page_code($field){
		$this -> db -> select('capture_page_master.*');
   		$this -> db -> from('capture_page_master');
		$this -> db -> where("capture_page_code NOT IN (select capture_page_code from capture_page_detail where usercode='".$this->session->userdata['logged_ol_member']['usercode']."')", NULL, FALSE);
   		$this -> db -> where('capture_page_master.change', 'Y');
		$this -> db -> where('capture_page_master.page_for !=', ''.$field.'');
		$this -> db -> where('capture_page_master.usercode', '0');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_mester_page_record_by_name($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('capture_page_record');
		$this -> db -> where('pagename',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
 	function delete_capture_page_preview()
	{
		$this->db->where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this->db->delete('capture_page_preview');
	}
	
	
	function get_page_record($id){
		$this -> db -> select('capture_page_record.*');
   		$this -> db -> from('capture_page_record');
		$this -> db -> where('capture_page_record.status','Active');
		
		if($id!=''){
			$this -> db -> where('capture_page_record.pagename IN (select pagename from capture_filter_detail where capture_filter_code='.$id.')');
		}
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	
	function get_page_type(){
		$this -> db -> select('*');
   		$this -> db -> from('capture_filter_type');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_mester_page_record_by_id($eid){
		$this -> db -> select('*');
   		$this -> db -> from('capture_page_record');
		$this -> db -> where('pagecode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
 	function get_record($eid){
		$this -> db -> select('capture_page_master.*');
		$this -> db -> select('membermaster.fname, membermaster.lname');
   		$this -> db -> from('capture_page_master');
		$this -> db -> join('membermaster','membermaster.usercode = capture_page_master.usercode','left');
   		$this -> db -> where('capture_page_master.capture_page_code', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function check_pageparmision($eid){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('capture_page_master');
   		$this -> db -> where('capture_page_code', ''.$eid.'');
		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('change', 'Y');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function get_pages_contain($pagelable)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable', ''.$pagelable.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	
	function get_media_gallery($eid){
		$this -> db -> select('*');
   		$this -> db -> from('media_gallery');
		$this -> db -> where('gallerycode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function addItem($data,$table){
    	$this->db->insert($table,$data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	
	
	function get_capture_page_category()
	{
		$this -> db -> select('*');
   		$this -> db -> from('capture_filter_type');
		
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;	
	}
	
	
	function get_capture_page_type($eid)
	{
		$this -> db -> select('capture_filter_detail.*');
		$this -> db -> select('capture_page_record.*');
   		$this -> db -> from('capture_filter_detail');
		$this -> db -> join('capture_page_record','capture_page_record.pagename = capture_filter_detail.pagename','left');
		$this -> db -> where('capture_filter_detail.capture_filter_code', ''.$eid.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function get_capture_page_type_dt($eid)
	{
		$this -> db -> select('capture_filter_detail.*');
		$this -> db -> select('capture_page_record.*');
   		$this -> db -> from('capture_filter_detail');
		$this -> db -> join('capture_page_record','capture_page_record.pagename = capture_filter_detail.pagename','left');
		$this -> db -> where('capture_filter_detail.capture_filter_code', ''.$eid.'');
		if($eid!=''){
			$this -> db -> where('capture_page_record.pagename', ''.$eid.'');
		}
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;	
	}
	function get_capture_page_type_dtdd()
	{
		$this -> db -> select('*');
   		$this -> db -> from('capture_page_record');
		if($eid!=''){
			$this -> db -> where('pagename', ''.$eid.'');
		}
   		
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function get_media_for_popup($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('media_gallery');
   		$this -> db -> where('status','Active');
		
		if($eid=='video'){
			$this -> db -> where('(type="mp4" or type="youtube")');
		}
		else if($eid=='ppt'){
			$this -> db -> where('type','ppt');
		}
		else if($eid=='audio'){
			$this -> db -> where('type','audio');
		}
		else {
			$this -> db -> where('type','image');
		}
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function table_fildld_name($tbl)
	{
		$result = $this->db->list_fields($tbl);
		foreach($result as $field)
		{
			$data[] = $field;
			
		}
		return $data;
	}
	
	function get_admin_email()
 	{	
   		$this -> db -> select('emailid');
   		$this -> db -> from('admin_login');
   		$this -> db -> where('usercode','1');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
 	
	
}
?>
