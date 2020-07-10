<?php
Class comman_modul extends CI_Model
{
	
	//function get_inbox($eid){
//		$this -> db -> select('smfund_message.*');
//		$this -> db -> select('membermaster.fname, membermaster.lname');
//   		$this -> db -> from('smfund_message');
//		$this -> db -> join('membermaster','membermaster.usercode = smfund_message.send_by','left');
//   		$this -> db -> where('smfund_message.send_to', ''.$eid.'');
//		$this -> db -> where('smfund_message.status !=', 'Delete');
//		$query = $this -> db -> get();
//    	$the_content = $query->result_array();
//    	return $the_content;
//	}
	
	//for smfund
	function get_smfund_adminname(){
		
		$this -> db -> select('*');
		$this -> db -> from('membermaster');
		$this -> db -> join('smfund_member','membermaster.usercode = smfund_member.usercode','left');
		$this -> db -> where('membermaster.usercode','21025');
		$this -> db -> where('smfund_member.admin','Yes');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;	
		
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
	
	
	
	function get_capture_page_list(){
		$this -> db -> select('smfund_capture_page_master.*');
		$this -> db -> select('capture_page_record.pagelable');
   		$this -> db -> from('smfund_capture_page_master');
		$this -> db -> join('capture_page_record','capture_page_record.pagename = smfund_capture_page_master.pagecode','left');
   		$this -> db -> where('smfund_capture_page_master.status !=', 'Delete');
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
	
	function cp_get_record($eid){
		$this -> db -> select('capture_page_master.*');
		$this -> db -> select('membermaster.fname, membermaster.lname');
   		$this -> db -> from('capture_page_master');
		$this -> db -> join('membermaster','membermaster.usercode = capture_page_master.usercode','left');
   		$this -> db -> where('capture_page_master.capture_page_code', ''.$eid.'');
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
	
	function cms_page_type(){
		
		$this -> db -> select('page_type');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> group_by('page_type'); 
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	function get_member_list(){
		
		$this -> db -> select('smfund_member.*');
   		$this -> db -> select('u1.*');
		$this -> db -> select('CONCAT(u2.fname," ",u2.lname) as ref_name,u2.username as ref_username, u2.usercode as ref_usercode, u1.password',FALSE);
		$this -> db -> from('smfund_member');
		$this -> db -> join('membermaster u1','u1.usercode = smfund_member.usercode','left');
		$this -> db -> join('membermaster u2','u2.usercode = smfund_member.referralid','left');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	function get_friend_list(){
		$this -> db -> select('smfund_member.*');
   		$this -> db -> select('u1.*');
		$this -> db -> from('smfund_member');
		$this -> db -> join('membermaster u1','u1.usercode = smfund_member.usercode','left');
		$this -> db -> where('smfund_member.referralid', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_outbox($eid){
		$this -> db -> select('smfund_message.*');
		$this -> db -> select('membermaster.fname, membermaster.lname');
   		$this -> db -> from('smfund_message');
		$this -> db -> join('membermaster','membermaster.usercode = smfund_message.send_to','left');
   		$this -> db -> where('smfund_message.send_by', ''.$eid.'');
		$this -> db -> where('smfund_message.status !=', 'Delete');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_inbox($eid){
		$this -> db -> select('smfund_message.*');
		$this -> db -> select('membermaster.fname, membermaster.lname');
   		$this -> db -> from('smfund_message');
		$this -> db -> join('membermaster','membermaster.usercode = smfund_message.send_by','left');
   		$this -> db -> where('smfund_message.send_to', ''.$eid.'');
		$this -> db -> where('smfund_message.status !=', 'Delete');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 	
	
}
?>
