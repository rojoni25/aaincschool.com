<?php
Class cornjob_send_email_model extends CI_Model
{
 	
 	function get_setting_value_by_lable($value){
		$this -> db -> select('*');
   		$this -> db -> from('site_settings');
   		$this -> db -> where('lable_acces_nm', ''.$value.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function total_by_type_free($eid,$pay_type)
	{
		$today_stam 	= 	strtotime(date('d-m-Y'));
		$this -> db -> select('sum(amount) as tot');
   		$this -> db -> from('payment_daily_free');
   		$this -> db -> where('timestm', ''.$today_stam.'');
		$this -> db -> where('usercode', ''.$eid.'');
		$this -> db -> where('pay_type', ''.$pay_type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function total_by_type_paid($eid,$pay_type)
	{
		$today_stam 	= 	strtotime(date('d-m-Y'));
		$this -> db -> select('sum(amount) as tot');
   		$this -> db -> from('payment_daily');
   		$this -> db -> where('timestm', ''.$today_stam.'');
		$this -> db -> where('usercode', ''.$eid.'');
		$this -> db -> where('pay_type', ''.$pay_type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	

	function get_free_member_by_add_time_old($add_time, $start){
		
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('status','Pending');
		$this -> db -> where('add_time',''.$add_time.'');
		//$this -> db -> where('add_time','1462386600');
		
		$this -> db -> where('subscribe','Y');
		$this -> db -> order_by('usercode','asc');
		$this -> db -> limit(3, $start);
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	
	function get_free_member_by_add_time($add_time, $start, $email_code){
		$this -> db -> select('user1.*');
		$this -> db -> select('user2.usercode as uid');
		$this -> db -> select('IFNULL(email_html_auto_responder.id, 0) AS ref_email, email_html_auto_responder.email_html, email_html_auto_responder.email_subject as subject',FALSE);
		
   		$this -> db -> from('membermaster user1');
		
		$this -> db -> join('membermaster user2','user1.referralid_free = user2.usercode','left');
		$this -> db -> join('email_html_auto_responder','email_html_auto_responder.usercode = user2.usercode and email_html_auto_responder.email_code="'.$email_code.'"','left');
		
		$this -> db -> where('user1.status','Pending');
		$this -> db -> where('user1.add_time',''.$add_time.'');
		
		$this -> db -> where('user1.subscribe','Y');
		
		$this -> db -> order_by('user1.usercode','asc');
		$this -> db -> limit(3, $start);
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
		
		
	}
	
	function get_daily_payment_paid_member($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode IN(select usercode from payment_daily where timestm="'.$eid.'" and send_email="0")');
		$this -> db -> where('membermaster.status','Active');
		$this -> db -> where('membermaster.subscribe','Y');
		$this -> db -> where('membermaster.email_verification','Y');
		$this -> db -> order_by('usercode', 'asc');
		$this->db->limit(6); 
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function last_payment_free()
	{
		$this -> db -> select_max('timestm');
   		$this -> db -> from('payment_daily_free'); 
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['timestm'];	
	}
	function last_payment_paid()
	{
		$this -> db -> select_max('timestm');
   		$this -> db -> from('payment_daily'); 
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['timestm'];	
	}
	
	
	
	function check_daily_record($eid,$type=''){
		$this -> db -> select('*');
   		$this -> db -> from('daily_email');
   		$this -> db -> where('timestm', ''.$eid.'');
		$this -> db -> where('type', ''.$type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function member_by_code($eid)
	{
		$this -> db -> select('fname,lname,emailid,username');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;		
	}
	
	function get_coded_residual_id($arr)
	{
		$this -> db -> select('count(*) as tot');
		$this -> db -> from(''.$arr[1].'');
		$this -> db -> where('type',''.$arr[0].'');
		$this -> db -> where('usercode_by',''.$arr[2].'');
		$query = $this -> db -> get();
		$the_content = $query->result_array();
		return $the_content;
	}
	
	function tot_ref($arr)
	{
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
		$this -> db -> where($arr[0],''.$arr[1].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_email_to_all_member()
	{
		$this -> db -> select('*');
   		$this -> db -> from('send_mail_master');
		$this -> db -> where('all_member','Yes');
		$this -> db -> where('total_send < ','total_member',false);
		$this -> db -> where('status','Active');
		$this -> db -> order_by("send_mail_code", "asc");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	function get_member($start)
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('status !=','Delete');
		$this -> db -> where('subscribe','Y');
		$this -> db -> where('email_verification','Y');
		$this -> db -> order_by("usercode", "asc");
		$this -> db -> limit(6, $start);
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function get_cms_page_by_lable($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
		$this -> db -> where('pagelable',''.$eid.'');
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
	function update_send_status($data,$table,$usercode,$today_stam){
		$this->db->where('timestm', $today_stam);
		$this->db->where('usercode', $usercode);
		$this->db->update($table, $data); 
	}
	
	function get_tot_ref($eid, $type)
	{
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
		$this -> db -> where($type,$eid);
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function get_email_type($type)
	{
		$this -> db -> select('*');
   		$this -> db -> from('email_html');
		$this -> db -> where('type',$type);
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function check_last_entry($email_code,$timedt){
		$this -> db -> select('*');
   		$this -> db -> from('email_daily_status');
		$this -> db -> where('email_code',$email_code);
		$this -> db -> where('timedt',$timedt);
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function all_send_email_update($id,$field)
	{
		$this->db->set(''.$field.'', '`'.$field.'`+ 1', FALSE);
		$this->db->where('send_mail_code',''.$id.'');
		$this->db->update('send_mail_master');	
	}
	
	function free_member_total_send($id,$field){
		$this->db->set(''.$field.'', '`'.$field.'`+ 1', FALSE);
		$this->db->where('idcode',''.$id.'');
		$this->db->update('email_daily_status');	
	}
	
	function get_email_varification_request(){
		$this -> db -> select('*');
		$this -> db -> from('send_email_verification_all');
		$this -> db -> where('status','Active');
		$this -> db -> order_by("id", "asc");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		$the_content = $query->result_array();
		return $the_content;
	}
	function get_member_varification($eid){
		$this -> db -> select('*');
		$this -> db -> from('membermaster');
		$this -> db -> where('status !=','Delete');
		$this -> db -> where('usercode NOT IN (select usercode from email_verification where send_to_all="'.$eid.'")');
		$this -> db -> where('email_verification','N');
		$this -> db -> order_by("usercode", "asc");
		$this -> db -> limit(10);
		$query = $this -> db -> get();
		$the_content = $query->result_array();
		return $the_content;
	}
	function varification_total_send($id,$field){
		$this->db->set(''.$field.'', '`'.$field.'`+ 1', FALSE);
		$this->db->where('id',''.$id.'');
		$this->db->update('send_email_verification_all');	
	}
	// function get_email_html_by_access_name($arr){
	// 	$this -> db -> select('email_html.*');
	// 	$this -> db -> select('IFNULL(email_html_auto_responder.id, 0) AS ref_email, email_html_auto_responder.email_html, email_html_auto_responder.email_subject as subject',FALSE);
		
 //   		$this -> db -> from('email_html');
	// 	$this -> db -> join('email_html_auto_responder','email_html.email_code = email_html_auto_responder.email_code and email_html_auto_responder.usercode='.$arr['usercode'].'','left');
		
 //   		$this -> db -> where('email_html.access_name',''.$arr['access_name'].'');
	// 	$query = $this -> db -> get();
 //    	$the_content = $query->result_array();
		
	// 	$arr_return = array();
	// 	$arr_return['subject'] = ($the_content[0]['ref_email']=='0') ? $the_content[0]['email_text'] : $the_content[0]['email_html'];
	// 	$arr_return['html']    = ($the_content[0]['ref_email']=='0') ? $the_content[0]['email_subject'] : $the_content[0]['subject'];
 //    	return $arr_return;
	// }

	function get_email_html_by_access_name($arr){
		$this -> db -> select('cms_pages_master.*');
		
   		$this -> db -> from('cms_pages_master');
		
   		$this -> db -> where('cms_pages_master.pagelable',''.$arr['pagelable'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		$arr_return = array();
		$arr_return['subject'] = ($the_content[0]['ref_email']=='0') ? $the_content[0]['title'] : $the_content[0]['title'];

		$arr_return['html']    = ($the_content[0]['ref_email']=='0') ? $the_content[0]['textdt'] : $the_content[0]['textdt'];
		// $arr_return['admin_contain']	=	$the_content[0]['admin_contain'];
    	return $arr_return;
		
	}
	
	function test_select($add_time, $start){
		$this -> db -> select('user1.*');
		$this -> db -> select('user2.usercode as uid');
		$this -> db -> select('IFNULL(email_html_auto_responder.id, 0) AS ref_email, email_html_auto_responder.email_html, email_html_auto_responder.email_subject as subject',FALSE);
   		$this -> db -> from('membermaster user1');
		$this -> db -> join('membermaster user2','user1.referralid_free = user2.usercode','left');
		$this -> db -> join('email_html_auto_responder','email_html_auto_responder.usercode = user2.usercode and email_html_auto_responder.email_code="1"','left');
		
		$this -> db -> where('user1.status','Pending');
		$this -> db -> where('user1.add_time',''.$add_time.'');
		$this -> db -> where('user1.subscribe','Y');
		$this -> db -> order_by('user1.usercode','asc');
		//$this -> db -> limit(3, $start);
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function get_send_all_member_email(){
		$this -> db -> select('*');
		$this -> db -> from('send_email_to_add');
		$this -> db -> where('status','Active');
		$this -> db -> order_by("email_code", "asc");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		$the_content = $query->result_array();
		return $the_content;	
	}
	
	function get_member_for_all($last_record){
		$this -> db -> select('*');
		$this -> db -> from('membermaster');
		$this -> db -> order_by("usercode", "ASC");
		$this -> db -> limit(10,$last_record);
		$query = $this -> db -> get();
		$the_content = $query->result_array();
		return $the_content;	
	}
	
	function update_for_all_email_member($id){
		$this->db->set('total_send', '`total_send`+ 1', FALSE);
		$this->db->where('email_code',''.$id.'');
		$this->db->update('send_email_to_add');	
	}
	
		
  	
	
  
	
}
?>
