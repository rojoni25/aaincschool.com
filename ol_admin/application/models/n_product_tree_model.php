<?php
Class n_product_tree_model extends CI_Model
{
	
 

	function userdt_by_code($eid){
		$this -> db -> select('fname,lname');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function member_paid_product_dt($eid){
		$this -> db -> select('membermaster.*');
		$this -> db -> select('n_product_member.wallet_balance');
   		$this -> db -> from('membermaster');
		$this -> db -> join('n_product_member','n_product_member.usercode = membermaster.usercode','left');
		$this -> db -> where('membermaster.usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function member_list()
	{
		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.username,membermaster.status');	
		$this -> db -> select('n_product_member.*');
		$this -> db -> from('n_product_member');
		$this -> db -> join('membermaster','membermaster.usercode = n_product_member.usercode','left');
		$this -> db -> where('n_product_member.usercode !=','1');	
		if($_GET['status']!=''){
			if($_GET['status']=='active'){
				$this -> db -> where('n_product_member.due_time >',''.time().'');	
			}
			if($_GET['status']=='due')
			{
				$this -> db -> where('n_product_member.due_time <',''.time().'');	
			}
		}
		
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
	
	
	//Get Member List Which Member Have No Bottom//
	function get_no_bottom_line_member()
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',membermaster.lname) AS name", FALSE);
		$this -> db -> select('n_product_member.*'); 
   		$this -> db -> from('n_product_member');
		$this -> db -> join('membermaster','membermaster.usercode = n_product_member.usercode','left');
		$this -> db -> where('n_product_member.usercode NOT IN(select upling from n_product_member group by upling)');
		$this -> db -> where('n_product_member.usercode !=','1');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	//Check Member Record Bottom//
	function check_bottom_member($eid){
		$this -> db -> select('*');
		$this -> db -> select('n_product_member.*');
   		$this -> db -> from('n_product_member');
		$this -> db -> where('upling',''.$eid.'');
		$this -> db -> where('usercode !=','1');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	//Get Product member record by usercode//
	function product_member_dt($eid){
		$this -> db -> select('n_product_member.*');
   		$this -> db -> from('n_product_member');
		$this -> db -> where('usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	//Get All Payment Of Upling Memebr//
	function get_upling_member_pay($eid){
		$this -> db -> select('*');
   		$this -> db -> from('n_product_member_payment');
		$this -> db -> where('ref_code',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	//Get Member Monthly Payment//
	function get_member_payment_monthly($eid){
		$this -> db -> select('*');
   		$this -> db -> from('n_product_monthly_payment');
		$this -> db -> where('usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	//delete upling member payment//
	function delete_upling_payment($eid)
	{
		$this -> db -> where('ref_code', $eid);
		$this -> db -> delete('n_product_member_payment'); 
	}
	
	//delete member Monthly payment//
	function delete_monthly_payment($eid)
	{
		$this -> db -> where('usercode', $eid);
		$this -> db -> delete('n_product_monthly_payment'); 
	}
	
	//delete member from tree//
	function delete_from_tree($eid)
	{
		$this -> db -> where('usercode', $eid);
		$this -> db -> delete('n_product_member'); 
	}
	
	//member balance update//
	function product_balance_update($usercode, $amount){
		$this->db->set('wallet_balance', 'wallet_balance - '.$amount.'', FALSE);
		$this->db->where('usercode',''.$usercode.'');
		$this->db->update('n_product_member');
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
	
	//Usercode In Permission//
	function get_usercode_in_permission($eid){
		
		$this -> db -> select('*');
   		$this -> db -> from('n_product_permission');
		$this -> db -> where('usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	function get_permition_member_list(){
		
		$this -> db -> select("CONCAT(membermaster.fname,' ',membermaster.lname) AS name, membermaster.username", FALSE);
		$this -> db -> select('n_product_permission.*'); 
   		$this -> db -> from('n_product_permission');
		$this -> db -> join('membermaster','membermaster.usercode = n_product_permission.usercode','left');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	function remove_permission($eid){
		$this -> db -> where('id', $eid);
		$this -> db -> delete('n_product_permission'); 
	}
	
	function remove_blog_permission($eid){
		$this -> db -> where('id', $eid);
		$this -> db -> delete('n_product_blog_permission'); 
	}
	
	
	function get_member_by_usercode($eid){
		
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	 
	function get_usercode_by_tree($eid='')
	{
		$this -> db -> select('*');
   		$this -> db -> from('n_product_member');
		$this -> db -> where('upling',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	} 
	
	function get_count_by_tree($eid='')
	{
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('n_product_member');
   		$this -> db -> where('upling',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member_by_blog($product_type,$eid='')
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',membermaster.lname) AS name, membermaster.usercode", FALSE);
   		$this -> db -> from('n_product_member');
		$this -> db -> join('membermaster','membermaster.usercode = n_product_member.usercode','left');
		$this -> db -> where('n_product_member.product_type',''.$product_type.'');
		if($eid!=''){
			$this -> db -> where('n_product_member.usercode !=',''.$eid.'');
			$this -> db -> where('n_product_member.usercode NOT IN (select permission_to from n_product_blog_permission WHERE usercode ="'.$eid.'")');
		}
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_ams_member($id)
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',membermaster.lname) AS name, membermaster.username", FALSE);
		$this -> db -> select("n_product_member.*");
   		$this -> db -> from('n_product_member');
		$this -> db -> join('membermaster','membermaster.usercode = n_product_member.usercode','left');
		$this -> db -> where('n_product_member.usercode',''.$id.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function get_all_payment($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('n_product_monthly_payment');
   		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> order_by('time_dt','ASC');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;		
	}
	
	function get_blog_permission($eid)
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',membermaster.lname) AS name, membermaster.usercode", FALSE);
		$this -> db -> select("n_product_blog_permission.*");
   		$this -> db -> from('n_product_blog_permission');
		$this -> db -> join('membermaster','membermaster.usercode = n_product_blog_permission.permission_to','left');
		$this -> db -> where('n_product_blog_permission.usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_under_member_list(){
		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.username');
		$this -> db -> select('n_product_subscription.*');
		$this -> db -> select('n_product_member.*');
   		$this -> db -> from('n_product_subscription');
		$this -> db -> join('membermaster','membermaster.usercode = n_product_subscription.usercode','left');
		$this -> db -> join('n_product_member','n_product_member.usercode = n_product_subscription.usercode','left');
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
	
	function count_member_by_status($status)
	{
		$this -> db -> select('count(*) as tot');	
		$this -> db -> from('n_product_member');
   		if($status=='active'){
			$this -> db -> where('due_time >',''.time().'');	
		}
		if($status=='due'){
			$this -> db -> where('due_time <',''.time().'');	
		}
		
		$this -> db -> where('usercode !=','1');	
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();	
    	return $the_content[0]['tot'];	
	}
	
	function get_all_active_member()
	{
		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.username');	
		$this -> db -> select('n_product_member.*');
		$this -> db -> from('n_product_member');
		$this -> db -> join('membermaster','membermaster.usercode = n_product_member.usercode','left');
   		$this -> db -> where('n_product_member.due_time >',''.time().'');	
		$this -> db -> where('n_product_member.usercode !=','1');	
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();	
    	return $the_content;	
	}
	
	function count_under_review()
	{
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('n_product_subscription');
		$this -> db -> where('usercode NOT IN (select usercode from pdl_member)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];	
		
	}
	
	
}
?>
