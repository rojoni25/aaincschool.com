<?php

Class r_matrix_model extends CI_Model
{
	
	
	
	function userdt_by_code($eid){
		$this -> db -> select('CONCAT(membermaster.fname," ",SUBSTRING(membermaster.lname,1,1)) as name',FALSE); 
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix.*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix.idcode', ''.$eid.'');
		$this -> db -> order_by(''.MATRIX_TABLE_PRE.'matrix.side', 'asc');
		
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
	
	
	
	
	//Get Product member record by usercode//
	function member_dt($eid){
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code');
		$this -> db -> where('usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	

	 //Member Serch//
	function search_member($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('(usercode="'.$eid.'" OR username="'.$eid.'")');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	function getcode_list(){
		
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'access_code.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'access_code.usercode','left');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	function get_access_code_by_usercode($eid){
		$this -> db -> select("membermaster.*", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'access_code.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'access_code.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'access_code.id',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_request_list()
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix_request.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_request');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix_request.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.status !=','C');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.req_type','Request');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.usercode NOT IN (select usercode from '.MATRIX_TABLE_PRE.'matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_pif_request_list()
	{
		$this -> db -> select("CONCAT(membermaster1.fname,' ',SUBSTRING(membermaster1.lname,1,1)) as name, membermaster1.username", FALSE);
		$this -> db -> select("CONCAT(membermaster2.fname,' ',SUBSTRING(membermaster2.lname,1,1)) as pif_by_u, membermaster2.username as by_username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix_request.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_request');
		$this -> db -> join('membermaster membermaster1','membermaster1.usercode = '.MATRIX_TABLE_PRE.'matrix_request.usercode','left');
		$this -> db -> join('membermaster membermaster2','membermaster2.usercode = '.MATRIX_TABLE_PRE.'matrix_request.pif_by','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.status !=','C');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.req_type','PIF');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.request_code NOT IN (select request_code from '.MATRIX_TABLE_PRE.'matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_request_list_extra()
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix_request.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_request');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix_request.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.status !=','C');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.request_code NOT IN (select request_code from '.MATRIX_TABLE_PRE.'matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function remove_access_code($eid){
		$this -> db -> where('id', $eid);
		$this -> db -> delete(''.MATRIX_TABLE_PRE.'access_code'); 
	}
	
	function check_access_code($eid){
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code');
   		$this -> db -> where('access_code',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_request_dt_by_id($eid)
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix_request.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_request');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix_request.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.request_code',''.$eid.'');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.status','P');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.request_code NOT IN (select request_code from '.MATRIX_TABLE_PRE.'matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_extra_request_dt_by_id($eid)
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'extra_position.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'extra_position');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'extra_position.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'extra_position.request_code',''.$eid.'');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'extra_position.status','P');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'extra_position.request_code NOT IN (select extra_r_code from '.MATRIX_TABLE_PRE.'matrix)');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'extra_position.usercode IN (select usercode from '.MATRIX_TABLE_PRE.'matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_request_by_id($eid){
		
		$this -> db -> select("*");
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_request');
		$this -> db -> where('request_code',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0];
	}
	
	function get_tree_member_id($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
   		$this -> db -> where('idcode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function tree_member_list()
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix.usercode','left');
		$this -> db -> group_by(''.MATRIX_TABLE_PRE.'matrix.usercode'); 
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_multi_postion($id){
		
		$this -> db -> select("CONCAT(user1.fname,' ',SUBSTRING(user1.lname,1,1)) as name1", FALSE); 
		$this -> db -> select("CONCAT(user2.fname,' ',SUBSTRING(user2.lname,1,1)) as name2", FALSE);
		
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix.*',FALSE);
   		
		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
		$this -> db -> join('membermaster user1','user1.usercode = '.MATRIX_TABLE_PRE.'matrix.usercode','left');
		$this -> db -> join('membermaster user2','user2.usercode = '.MATRIX_TABLE_PRE.'matrix.upling_member','left');
		
	
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix.usercode',''.$id.'');
	
	
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	
	function get_downline_record($eid='')
	{
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
		$this -> db -> where('upling_id',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_countdownline($eid=''){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
   		$this -> db -> where('upling_id',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_tree_record($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
   		$this -> db -> where('idcode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_tot_count_active(){
		
		$this -> db -> select('count(DISTINCT usercode) as tot');
		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function get_tot_count_request(){
		$this -> db -> select('count(DISTINCT usercode) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_request');
		$this -> db -> where('req_type','Request');
		$this -> db -> where('usercode NOT IN (select usercode from '.MATRIX_TABLE_PRE.'matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function get_tot_count_access_code_request()
	{

		$this -> db -> select('count(*) as tot'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code_request');
		$this -> db -> where('status','Active');
		$this -> db -> where('usercode NOT IN (select usercode from '.MATRIX_TABLE_PRE.'access_code)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function unuse_access_code(){
		$this -> db -> select('count(access_code) as tot'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code');
		$this -> db -> where('access_code NOT IN (select access_code from '.MATRIX_TABLE_PRE.'access_code_use group by access_code)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function get_tot_send_pif(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_upgrade_pay');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function get_tot_remaining_pif(){
		$this -> db -> select('count(DISTINCT usercode) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
		$this -> db -> where('usercode NOT IN (select usercode from '.MATRIX_TABLE_PRE.'member_upgrade_pay)');
		$this -> db -> where('usercode NOT IN (select usercode from member_node_master)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	
	function count_request_extra_position()
	{
		$this -> db -> select('count(*) as tot'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_request');
		$this -> db -> where('status !=','C');
		$this -> db -> where('req_type','Multi');
		$this -> db -> where('request_code NOT IN (select request_code from '.MATRIX_TABLE_PRE.'matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function get_tot_pif_request(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_request');
		$this -> db -> where('req_type','PIF');
		$this -> db -> where('request_code NOT IN (select request_code from '.MATRIX_TABLE_PRE.'matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function get_tot_pending_withdrawal(){
		
		$this -> db -> select('count(*) as tot'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_withdrawal_request');
		$this -> db -> where('req_id NOT IN (select req_id from '.MATRIX_TABLE_PRE.'member_withdrawal)');
		$this -> db -> where('status !=','C');	
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function get_tot_msg(){
		
		$this -> db -> select('count(*) as tot'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'message');
		$this -> db -> where('send_to','-1');	
		$this -> db -> where('status_to','Active');	
		$this -> db -> where('read_status','0');	
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function get_cms_page($eid){
		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
		$this -> db -> where('pagelable',''.$eid.'');
    	$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	} 
	 
	// Find All Position of Member 
	
	function get_multi_position($eid)   
	{
		$this -> db -> select('CONCAT(user1.fname," ",SUBSTRING(user1.lname,1,1)) as name, user1.username,user1.password,user1.emailid,user1.mobileno,user1.phone_no,user1.status',FALSE);
		$this -> db -> select('CONCAT(user2.fname," ",SUBSTRING(user2.lname,1,1)) as name2, user2.username as username2',FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix.*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
		$this -> db -> join('membermaster user1','user1.usercode = '.MATRIX_TABLE_PRE.'matrix.usercode','left');
		$this -> db -> join('membermaster user2','user2.usercode = '.MATRIX_TABLE_PRE.'matrix.upling_member','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix.usercode',''.$eid.'');
		$this -> db -> order_by(''.MATRIX_TABLE_PRE.'matrix.idcode','asc');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	
}
?>
