<?php
Class r_matrix_model extends CI_Model
{
	

	function userdt_by_code($eid){
		$this -> db -> select('CONCAT(membermaster.fname," ",SUBSTRING(membermaster.lname,1,1)) as name',FALSE); 
		$this -> db -> select('rm_matrix.*');
   		$this -> db -> from('rm_matrix');
		$this -> db -> join('membermaster','membermaster.usercode = rm_matrix.usercode','left');
		$this -> db -> where('rm_matrix.idcode', ''.$eid.'');
		$this -> db -> order_by('rm_matrix.side', 'asc');
		
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
	function kdk_member_dt($eid){
		$this -> db -> select('*');
   		$this -> db -> from('rm_kdk_code');
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
	
	
	
	function get_kdkcode_list(){
		
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select('rm_kdk_code.*'); 
   		$this -> db -> from('rm_kdk_code');
		$this -> db -> join('membermaster','membermaster.usercode = rm_kdk_code.usercode','left');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	function get_kdk_code_by_usercode($eid){
		$this -> db -> select("membermaster.*", FALSE);
		$this -> db -> select('rm_kdk_code.*'); 
   		$this -> db -> from('rm_kdk_code');
		$this -> db -> join('membermaster','membermaster.usercode = rm_kdk_code.usercode','left');
		$this -> db -> where('rm_kdk_code.id',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_request_list()
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select('rm_matrix_request.*'); 
   		$this -> db -> from('rm_matrix_request');
		$this -> db -> join('membermaster','membermaster.usercode = rm_matrix_request.usercode','left');
		$this -> db -> where('rm_matrix_request.status !=','C');
		$this -> db -> where('rm_matrix_request.req_type','Request');
		$this -> db -> where('rm_matrix_request.usercode NOT IN (select usercode from rm_matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_kdk_pif_request_list()
	{
		$this -> db -> select("CONCAT(membermaster1.fname,' ',SUBSTRING(membermaster1.lname,1,1)) as name, membermaster1.username", FALSE);
		$this -> db -> select("CONCAT(membermaster2.fname,' ',SUBSTRING(membermaster2.lname,1,1)) as pif_by_u, membermaster2.username as by_username", FALSE);
		$this -> db -> select('rm_matrix_request.*'); 
   		$this -> db -> from('rm_matrix_request');
		$this -> db -> join('membermaster membermaster1','membermaster1.usercode = rm_matrix_request.usercode','left');
		$this -> db -> join('membermaster membermaster2','membermaster2.usercode = rm_matrix_request.pif_by','left');
		$this -> db -> where('rm_matrix_request.status !=','C');
		$this -> db -> where('rm_matrix_request.req_type','PIF');
		$this -> db -> where('rm_matrix_request.request_code NOT IN (select request_code from rm_matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_request_list_extra()
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select('rm_matrix_request.*'); 
   		$this -> db -> from('rm_matrix_request');
		$this -> db -> join('membermaster','membermaster.usercode = rm_matrix_request.usercode','left');
		$this -> db -> where('rm_matrix_request.status !=','C');
		$this -> db -> where('rm_matrix_request.request_code NOT IN (select request_code from rm_matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function remove_kdk_code($eid){
		$this -> db -> where('id', $eid);
		$this -> db -> delete('rm_kdk_code'); 
	}
	
	function check_kdk_code($eid){
		$this -> db -> select('*');
   		$this -> db -> from('rm_kdk_code');
   		$this -> db -> where('kdk_code',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_request_dt_by_id($eid)
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select('rm_matrix_request.*'); 
   		$this -> db -> from('rm_matrix_request');
		$this -> db -> join('membermaster','membermaster.usercode = rm_matrix_request.usercode','left');
		$this -> db -> where('rm_matrix_request.request_code',''.$eid.'');
		$this -> db -> where('rm_matrix_request.status','P');
		$this -> db -> where('rm_matrix_request.request_code NOT IN (select request_code from rm_matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_extra_request_dt_by_id($eid)
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select('rm_extra_position.*'); 
   		$this -> db -> from('rm_extra_position');
		$this -> db -> join('membermaster','membermaster.usercode = rm_extra_position.usercode','left');
		$this -> db -> where('rm_extra_position.request_code',''.$eid.'');
		$this -> db -> where('rm_extra_position.status','P');
		$this -> db -> where('rm_extra_position.request_code NOT IN (select extra_r_code from rm_matrix)');
		$this -> db -> where('rm_extra_position.usercode IN (select usercode from rm_matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_request_by_id($eid){
		
		$this -> db -> select("*");
   		$this -> db -> from('rm_matrix_request');
		$this -> db -> where('request_code',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0];
	}
	
	function get_tree_member_id($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('rm_matrix');
   		$this -> db -> where('idcode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function tree_member_list()
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select('rm_matrix.*'); 
   		$this -> db -> from('rm_matrix');
		$this -> db -> join('membermaster','membermaster.usercode = rm_matrix.usercode','left');
		$this -> db -> group_by('rm_matrix.usercode'); 
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_multi_postion($id){
		
		$this -> db -> select("CONCAT(user1.fname,' ',SUBSTRING(user1.lname,1,1)) as name1", FALSE); 
		$this -> db -> select("CONCAT(user2.fname,' ',SUBSTRING(user2.lname,1,1)) as name2", FALSE);
		
		$this -> db -> select('rm_matrix.*',FALSE);
   		
		$this -> db -> from('rm_matrix');
		$this -> db -> join('membermaster user1','user1.usercode = rm_matrix.usercode','left');
		$this -> db -> join('membermaster user2','user2.usercode = rm_matrix.upling_member','left');
		
	
		$this -> db -> where('rm_matrix.usercode',''.$id.'');
	
	
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	
	function get_downline_record($eid='')
	{
		$this -> db -> select('*');
   		$this -> db -> from('rm_matrix');
		$this -> db -> where('upling_id',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_countdownline($eid=''){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('rm_matrix');
   		$this -> db -> where('upling_id',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_tree_record($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('rm_matrix');
   		$this -> db -> where('idcode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_tot_count_active(){
		$this -> db -> select('count(DISTINCT usercode) as tot');
   		$this -> db -> from('rm_matrix');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function get_tot_count_request(){
		$this -> db -> select('count(DISTINCT usercode) as tot');
   		$this -> db -> from('rm_matrix_request');
		$this -> db -> where('req_type','Request');
		$this -> db -> where('usercode NOT IN (select usercode from rm_matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function get_tot_count_kdk_code_request()
	{

		$this -> db -> select('count(*) as tot'); 
   		$this -> db -> from('rm_kdk_code_request');
		$this -> db -> where('status','Active');
		$this -> db -> where('usercode NOT IN (select usercode from rm_kdk_code)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function unuse_kdk_code(){
		$this -> db -> select('count(kdk_code) as tot'); 
   		$this -> db -> from('rm_kdk_code');
		$this -> db -> where('kdk_code NOT IN (select kdk_code from rm_kdk_code_use group by kdk_code)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function get_tot_send_pif(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('rm_member_upgrade_pay');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function get_tot_remaining_pif(){
		$this -> db -> select('count(DISTINCT usercode) as tot');
   		$this -> db -> from('rm_matrix');
		$this -> db -> where('usercode NOT IN (select usercode from rm_member_upgrade_pay)');
		$this -> db -> where('usercode NOT IN (select usercode from member_node_master)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	
	function count_request_extra_position()
	{
		$this -> db -> select('count(*) as tot'); 
   		$this -> db -> from('rm_matrix_request');
		$this -> db -> where('status !=','C');
		$this -> db -> where('req_type','Multi');
		$this -> db -> where('request_code NOT IN (select request_code from rm_matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function get_tot_kdk_pif_request(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('rm_matrix_request');
		$this -> db -> where('req_type','PIF');
		$this -> db -> where('request_code NOT IN (select request_code from rm_matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function get_tot_pending_withdrawal(){
		
		$this -> db -> select('count(*) as tot'); 
   		$this -> db -> from('rm_member_withdrawal_request');
		$this -> db -> where('req_id NOT IN (select req_id from rm_member_withdrawal)');
		$this -> db -> where('status !=','C');	
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function get_tot_msg(){
		
		$this -> db -> select('count(*) as tot'); 
   		$this -> db -> from('rm_message');
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
	
	function check_recycle_payment($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('rm_member_payment');
		$this -> db -> where('position', ''.$eid.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return (!isset($the_content[0])) ? true : false; 
	}
	
	
	
	
	
	
	
}
?>
