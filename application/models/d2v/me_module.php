<?php
Class me_module extends CI_Model
{
 	
	
	function under_process(){	
	
		$this -> db -> select('m2m_request.*');
		$this -> db -> select('COUNT(m2m_payment_confirmation.usercode) as tot_payment');
		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name,a.username as member_code',FALSE);
		$this -> db -> select('CONCAT(b.fname," ",b.lname) as upling_name,b.username as upling_code',FALSE);
		$this -> db -> select('CONCAT(c.fname," ",c.lname) as pay_name,c.username as pay_code',FALSE);
   		$this -> db -> from('m2m_request');
		$this -> db -> join('membermaster a','a.usercode = m2m_request.usercode','left');
		$this -> db -> join('membermaster b','b.usercode = m2m_request.upling','left');
		$this -> db -> join('membermaster c','c.usercode = m2m_request.payto','left');
		$this -> db -> join('m2m_payment_confirmation','m2m_payment_confirmation.usercode = m2m_request.usercode','left');
		$this -> db -> where('m2m_request.usercode NOT IN (SELECT usercode from m2m_member)');
		$this -> db -> where('m2m_request.payto',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> group_by('m2m_request.usercode');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function under_process_by_id($eid){	
	
		$this -> db -> select('m2m_request.*');
		$this -> db -> select('COUNT(m2m_payment_confirmation.usercode) as tot_payment');
		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name,a.username as member_code',FALSE);
		$this -> db -> select('CONCAT(b.fname," ",b.lname) as upling_name,b.username as upling_code',FALSE);
		$this -> db -> select('CONCAT(c.fname," ",c.lname) as pay_name,c.username as pay_code',FALSE);
		
   		$this -> db -> from('m2m_request');
		
		$this -> db -> join('membermaster a','a.usercode = m2m_request.usercode','left');
		$this -> db -> join('membermaster b','b.usercode = m2m_request.upling','left');
		$this -> db -> join('membermaster c','c.usercode = m2m_request.payto','left');
		$this -> db -> join('m2m_payment_confirmation','m2m_payment_confirmation.usercode = m2m_request.usercode','left');
		
		$this -> db -> where('m2m_request.usercode NOT IN (SELECT usercode from m2m_member)');
		$this -> db -> where('m2m_request.payto',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('m2m_request.usercode',''.$eid.'');
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_member(){
		$this -> db -> select('m2m_member.*');
		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name,a.username as member_code',FALSE);
		$this -> db -> select('CONCAT(c.fname," ",c.lname) as pay_name,c.username as pay_code',FALSE);
		
   		$this -> db -> from('m2m_member');
		
		$this -> db -> join('membermaster a','a.usercode = m2m_member.usercode','left');
		$this -> db -> join('membermaster c','c.usercode = m2m_member.payto','left');
		
		$this -> db -> where('m2m_member.upling',''.$this->session->userdata['logged_ol_member']['usercode'].'');
	
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function next_level_member($eid){
		$this -> db -> select('m2m_member.*');
		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name,a.username as member_code',FALSE);
		$this -> db -> select('CONCAT(c.fname," ",c.lname) as pay_name,c.username as pay_code',FALSE);
		
   		$this -> db -> from('m2m_member');
		
		$this -> db -> join('membermaster a','a.usercode = m2m_member.usercode','left');
		$this -> db -> join('membermaster c','c.usercode = m2m_member.payto','left');
		
		$this -> db -> where('m2m_member.upling',''.$eid.'');
	
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 
 	function count_under_process(){	
		$this -> db -> select('COUNT(*) as tot');
   		$this -> db -> from('m2m_request');
		$this -> db -> where('m2m_request.usercode NOT IN (SELECT usercode from m2m_member)');
		$this -> db -> where('m2m_request.payto',''.$this->session->userdata['logged_ol_member']['usercode'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
 	}
	
	function count_get_member(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('m2m_member');
		$this -> db -> where('m2m_member.upling',''.$this->session->userdata['logged_ol_member']['usercode'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function gift_earned(){	
	
		$this -> db -> select('m2m_member.*');
		
		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name',FALSE);
		$this -> db -> select('CONCAT(b.fname," ",b.lname) as upling_name',FALSE);
		$this -> db -> select('CONCAT(c.fname," ",c.lname) as pay_name',FALSE);
		
   		$this -> db -> from('m2m_member');
		
		$this -> db -> join('membermaster a','a.usercode = m2m_member.usercode','left');
		$this -> db -> join('membermaster b','b.usercode = m2m_member.upling','left');
		$this -> db -> join('membermaster c','c.usercode = m2m_member.payto','left');

		$this -> db -> where('m2m_member.payto',''.$this->session->userdata['logged_ol_member']['usercode'].'');

    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function gift_earned_detail($eid){	
	
		$this -> db -> select('m2m_request.*');
		$this -> db -> select('COUNT(m2m_payment_confirmation.usercode) as tot_payment');
		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name,a.username as member_code',FALSE);
		$this -> db -> select('CONCAT(b.fname," ",b.lname) as upling_name,b.username as upling_code',FALSE);
		$this -> db -> select('CONCAT(c.fname," ",c.lname) as pay_name,c.username as pay_code',FALSE);
		
   		$this -> db -> from('m2m_request');
		
		$this -> db -> join('membermaster a','a.usercode = m2m_request.usercode','left');
		$this -> db -> join('membermaster b','b.usercode = m2m_request.upling','left');
		$this -> db -> join('membermaster c','c.usercode = m2m_request.payto','left');
		$this -> db -> join('m2m_payment_confirmation','m2m_payment_confirmation.usercode = m2m_request.usercode','left');
		
		$this -> db -> where('m2m_request.usercode  IN (SELECT usercode from m2m_member)');
		$this -> db -> where('m2m_request.payto',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('m2m_request.usercode',''.$eid.'');
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function member_position_detail(){	
	
		$this -> db -> select('m2m_member.*');
		
		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name',FALSE);
		$this -> db -> select('CONCAT(b.fname," ",b.lname) as upling_name',FALSE);
		$this -> db -> select('CONCAT(c.fname," ",c.lname) as pay_name',FALSE);
		
   		$this -> db -> from('m2m_member');
		
		$this -> db -> join('membermaster a','a.usercode = m2m_member.usercode','left');
		$this -> db -> join('membermaster b','b.usercode = m2m_member.upling','left');
		$this -> db -> join('membermaster c','c.usercode = m2m_member.payto','left');

		$this -> db -> where('m2m_member.usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');

    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
 	
  
	
}
?>
