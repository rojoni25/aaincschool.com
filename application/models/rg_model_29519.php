<?php
Class rg_model extends CI_Model
{
 	
	function get_user_by_username($eid=''){
		$this -> db -> select('usercode,fname,lname,username');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('username', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	function get_invite_friend_master($id){
		$this->db->select('*');
		$this->db->from('invite_friend_master');
		$this->db->where('invite_friend_code', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function check_email_id($eid=''){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('emailid', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_duplicate($value, $field){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where(''.$field.'', ''.$value.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_dummy_data(){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster_dummy');
		$this->db->limit(50);
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_node($usercode)
	{
		$this -> db -> select('uplingmember3_3,uplingmember5_3,uplingmember10_3,usercode');
   		$this -> db -> from('member_node_master_free');
		$this->db->where('usercode', $usercode);
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_dummy_data_count(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster_dummy');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function delete_member($id)
	{
		$this->db->where('usercode', $id);
		$this->db->delete('membermaster_dummy');
	}
	
	function get_usercode_by_tree($eid='',$type)
	{
		$this -> db -> select('*');
   		$this -> db -> from('member_node_master_free');
   		$this -> db -> where($type, ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_count_by_tree($eid='',$type){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('member_node_master_free');
   		$this -> db -> where($type,''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_usercode($eid=''){
		$this -> db -> select('*');
   		$this -> db -> from('member_node_master_free');
   		$this -> db -> where('uplingmember3_3', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	function get_count_three($eid=''){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('member_node_master_free');
   		$this -> db -> where('uplingmember3_3', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function get_usercode_five($eid=''){
		$this -> db -> select('*');
   		$this -> db -> from('member_node_master_free');
   		$this -> db -> where('uplingmember5_3', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_count_five($eid=''){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('member_node_master_free');
   		$this -> db -> where('uplingmember5_3', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_count_chk($eid, $field){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('member_node_master_dummy');
   		$this -> db -> where(''.$field.'', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_usercode_ten($eid=''){
		$this -> db -> select('*');
   		$this -> db -> from('member_node_master_free');
   		$this -> db -> where('uplingmember10_3', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_count_ten($eid=''){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('member_node_master_free');
   		$this -> db -> where('uplingmember10_3', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_user_filter($eid){
		$this -> db -> 	select('fname,lname,usercode');
   		$this -> db -> 	from('membermaster');
		$this->db->where('(fname  LIKE "%'.$eid.'%" or lname  LIKE "%'.$eid.'%"  or usercode  LIKE "%'.$eid.'%")');
		$this -> db ->	order_by("fname", "asc");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_total_reffral($usercode){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('referralid_free', ''.$usercode.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_upling_member($eid, $field){
		$this -> db -> select(''.$field.' as upling');
   		$this -> db -> from('member_node_master_free');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function member_level_track_update($eid, $field, $field2)
	{
		if($eid!='' && isset($eid))
		{
			$this->db->set(''.$field.'', '`'.$field.'`+ 1', FALSE);
			$this->db->set(''.$field2.'', '`'.$field2.'`+ 1', FALSE);
			$this->db->where('usercode', $eid);
			$this->db->update('member_level_track_master_free');
		}
		
	}
	
	
	function member_free_dailypayment_update($eid,$field,$field2,$value)
	{
		if($eid!='' && isset($eid))
		{
			$this->db->set(''.$field.'', '`'.$field.'`+ '.$value.'', FALSE);
			$this->db->set(''.$field2.'', '`'.$field2.'`+ '.$value.'', FALSE);
			$this->db->where('usercode', $eid);
			$this->db->update('master_balance_sheet_free');
		}
		
	}

 	function get_system_level($usercode, $field){
		$this -> db -> select(''.$field.' as level');
   		$this -> db -> from('member_level_track_master_free');
   		$this -> db -> where('usercode', ''.$usercode.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_user_reffral($usercode){
		$this -> db -> select('referralid');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', ''.$usercode.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_coded_residual($usercode){
		$this -> db -> select('usercode_by as ucode, level, type');
   		$this -> db -> from('coded_residual_free');
   		$this -> db -> where('usercode', ''.$usercode.'');
		$this -> db -> where('(type="coded" or type="residual")');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_coded_match_residual_match($usercode){
		$this -> db -> select('usercode_by as ucode, level, type');
   		$this -> db -> from('coded_residual_free');
   		$this -> db -> where('usercode', ''.$usercode.'');
		$this -> db -> where('(type="coded_match" or type="residual_match")');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_setting_value_by_lable($value){
		$this -> db -> select('setting_value');
   		$this -> db -> from('site_settings');
   		$this -> db -> where('lable_acces_nm', ''.$value.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_admin_email()
	{
		$this -> db -> select('emailid');
   		$this -> db -> from('admin_login');
   		$this -> db -> where('usercode','2');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member_detail_by_code($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_contain()
	{
		$this -> db -> select('*');
   		$this -> db -> from('capture_page_master');
		$this -> db -> where('capture_page_code','1');
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
	
	function get_email_html_by_access_name($arr){
		
		$this -> db -> select('email_html.*');
		$this -> db -> select('IFNULL(email_html_auto_responder.id, 0) AS ref_email, email_html_auto_responder.email_html, email_html_auto_responder.email_subject as subject',FALSE);
   		$this -> db -> from('email_html');
		$this -> db -> join('email_html_auto_responder','email_html.email_code = email_html_auto_responder.email_code and email_html_auto_responder.usercode='.$arr['usercode'].'','left');
   		$this -> db -> where('email_html.access_name',''.$arr['access_name'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		$arr_return = array();
		$arr_return['subject'] = ($the_content[0]['ref_email']=='0') ? $the_content[0]['email_subject'] : $the_content[0]['email_subject'];
		$arr_return['html']    = ($the_content[0]['ref_email']=='0') ? $the_content[0]['email_text'] : $the_content[0]['email_text'];
		$arr_return['admin_contain']	=	$the_content[0]['admin_contain'];
    	return $arr_return;
	}
  	
 //  	function get_email_html_by_access_name($arr){
	// 	$this -> db -> select('cms_pages_master.*');
		
 //   		$this -> db -> from('cms_pages_master');
		
 //   		$this -> db -> where('cms_pages_master.pagelable',''.$arr['pagelable'].'');
	// 	$query = $this -> db -> get();
 //    	$the_content = $query->result_array();
	// 	$arr_return = array();
	// 	$arr_return['subject'] = ($the_content[0]['ref_email']=='0') ? $the_content[0]['title'] : $the_content[0]['title'];

	// 	$arr_return['html']    = ($the_content[0]['ref_email']=='0') ? $the_content[0]['textdt'] : $the_content[0]['textdt'];
	// 	// $arr_return['admin_contain']	=	$the_content[0]['admin_contain'];
 //    	return $arr_return;
		
	// }
  
//-------------All Function for Add Multiplier Free Tree.-------------------------//

	function get_downline_record($eid='')
	{
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_free');
		$this -> db -> where('upling_id',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_countdownline($eid=''){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_free');
   		$this -> db -> where('upling_id',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_tree_record($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_free');
   		$this -> db -> where('idcode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	// Find All Position of Member 
	
	function get_multi_position($eid)   
	{
		$this -> db -> select('CONCAT(user1.fname," ",SUBSTRING(user1.lname,1,1)) as name, user1.username,user1.password,user1.emailid,user1.mobileno,user1.phone_no,user1.status',FALSE);
		$this -> db -> select('CONCAT(user2.fname," ",SUBSTRING(user2.lname,1,1)) as name2, user2.username as username2',FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix_free.*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_free');
		$this -> db -> join('membermaster user1','user1.usercode = '.MATRIX_TABLE_PRE.'matrix_free.usercode','left');
		$this -> db -> join('membermaster user2','user2.usercode = '.MATRIX_TABLE_PRE.'matrix_free.upling_member','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_free.usercode',''.$eid.'');
		$this -> db -> order_by(''.MATRIX_TABLE_PRE.'matrix_free.idcode','asc');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
}
?>
