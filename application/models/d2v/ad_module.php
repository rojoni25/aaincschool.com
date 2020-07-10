<?php
Class ad_module extends CI_Model
{
 	
	
	function request(){	
		$this -> db -> select('d2v_payment_send.*');
		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name,a.username as member_code',FALSE);
		$this -> db -> select('CONCAT(b.fname," ",b.lname) as ref_name,b.username as ref_code',FALSE);
   		$this -> db -> from('d2v_payment_send');
		$this -> db -> join('membermaster a','a.usercode = d2v_payment_send.usercode','left');
		$this -> db -> join('membermaster b','b.usercode = a.referralid_free','left');
		$this -> db -> where('d2v_payment_send.usercode NOT IN (SELECT usercode from d2v_member)');
		$this -> db -> group_by('d2v_payment_send.usercode');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function count_request(){	
		$this -> db -> select('count(distinct(usercode)) as tot');
		$this -> db -> from('d2v_payment_send');
		$this -> db -> where('usercode NOT IN (SELECT usercode from d2v_member)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
 	}
	
	function count_member(){	
		$this -> db -> select('count(usercode) as tot');
		$this -> db -> from('d2v_member');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
 	}
	
	function count_msg(){	
		$this -> db -> select('count(*) as tot');
		$this -> db -> from('d2v_message');
		
		$this -> db -> where('to_status','1');
		$this -> db -> where('send_to','0');
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
 	}
	
	function request_by_id($eid){
		$this -> db -> select('d2v_payment_send.*');
		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name,a.username as member_code',FALSE);
		$this -> db -> select('CONCAT(b.fname," ",b.lname) as ref_name,b.username as ref_code',FALSE);
   		$this -> db -> from('d2v_payment_send');
		$this -> db -> join('membermaster a','a.usercode = d2v_payment_send.usercode','left');
		$this -> db -> join('membermaster b','b.usercode = a.referralid_free','left');
		$this -> db -> where('d2v_payment_send.usercode NOT IN (SELECT usercode from d2v_member)');
		$this -> db -> where('d2v_payment_send.usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member_list(){
		$this -> db -> select('d2v_member.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name,membermaster.username',FALSE);
   		$this -> db -> from('d2v_member');
		$this -> db -> join('membermaster','membermaster.usercode = d2v_member.usercode','left');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_downline($eid=''){
		$this -> db -> select('*');
   		$this -> db -> from('d2v_member');
   		$this -> db -> where('upling',''.$eid.'');
		$this -> db -> order_by('side','ASC');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member(){
		$this -> db -> select('d2v_member.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name,membermaster.username,membermaster.emailid',FALSE);
   		$this -> db -> from('d2v_member');
		$this -> db -> join('membermaster','membermaster.usercode = d2v_member.usercode','left');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_admin_msg(){
		$this -> db -> select('d2v_message.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name,membermaster.username,membermaster.emailid,membermaster.usercode',FALSE);
   		$this -> db -> from('d2v_message');
		$this -> db -> join('membermaster','membermaster.usercode = d2v_message.send_from','left');
		$this -> db -> where('d2v_message.send_to','0');
		$this -> db -> where('d2v_message.to_status !=','0');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 
 	
  
	
}
?>
