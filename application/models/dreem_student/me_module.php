<?php
Class me_module extends CI_Model
{
 	
	
	function under_process(){	
	
		$this -> db -> select('dreem_student_request.*');
		$this -> db -> select('COUNT(dreem_student_payment_confirmation.usercode) as tot_payment');
		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name,a.username as member_code',FALSE);
		$this -> db -> select('CONCAT(b.fname," ",b.lname) as upling_name,b.username as upling_code',FALSE);
		$this -> db -> select('CONCAT(c.fname," ",c.lname) as pay_name,c.username as pay_code',FALSE);
   		$this -> db -> from('dreem_student_request');
		$this -> db -> join('membermaster a','a.usercode = dreem_student_request.usercode','left');
		$this -> db -> join('membermaster b','b.usercode = dreem_student_request.upling','left');
		$this -> db -> join('membermaster c','c.usercode = dreem_student_request.payto','left');
		$this -> db -> join('dreem_student_payment_confirmation','dreem_student_payment_confirmation.usercode = dreem_student_request.usercode','left');
		$this -> db -> where('dreem_student_request.usercode NOT IN (SELECT usercode from dreem_student_member)');
		$this -> db -> where('dreem_student_request.payto',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> group_by('dreem_student_request.usercode');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function under_process_by_id($eid){	
	
		$this -> db -> select('dreem_student_request.*');
		$this -> db -> select('COUNT(dreem_student_payment_confirmation.usercode) as tot_payment');
		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name,a.username as member_code',FALSE);
		$this -> db -> select('CONCAT(b.fname," ",b.lname) as upling_name,b.username as upling_code',FALSE);
		$this -> db -> select('CONCAT(c.fname," ",c.lname) as pay_name,c.username as pay_code',FALSE);
		
   		$this -> db -> from('dreem_student_request');
		
		$this -> db -> join('membermaster a','a.usercode = dreem_student_request.usercode','left');
		$this -> db -> join('membermaster b','b.usercode = dreem_student_request.upling','left');
		$this -> db -> join('membermaster c','c.usercode = dreem_student_request.payto','left');
		$this -> db -> join('dreem_student_payment_confirmation','dreem_student_payment_confirmation.usercode = dreem_student_request.usercode','left');
		
		$this -> db -> where('dreem_student_request.usercode NOT IN (SELECT usercode from dreem_student_member)');
		$this -> db -> where('dreem_student_request.payto',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('dreem_student_request.usercode',''.$eid.'');
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_member(){
		$this -> db -> select('dreem_student_member.*');
		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name,a.username as member_code',FALSE);
		$this -> db -> select('CONCAT(c.fname," ",c.lname) as pay_name,c.username as pay_code',FALSE);
		
   		$this -> db -> from('dreem_student_member');
		
		$this -> db -> join('membermaster a','a.usercode = dreem_student_member.usercode','left');
		$this -> db -> join('membermaster c','c.usercode = dreem_student_member.payto','left');
		
		$this -> db -> where('dreem_student_member.upling',''.$this->session->userdata['logged_ol_member']['usercode'].'');
	
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function next_level_member($eid){
		$this -> db -> select('dreem_student_member.*');
		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name,a.username as member_code',FALSE);
		$this -> db -> select('CONCAT(c.fname," ",c.lname) as pay_name,c.username as pay_code',FALSE);
		
   		$this -> db -> from('dreem_student_member');
		
		$this -> db -> join('membermaster a','a.usercode = dreem_student_member.usercode','left');
		$this -> db -> join('membermaster c','c.usercode = dreem_student_member.payto','left');
		
		$this -> db -> where('dreem_student_member.upling',''.$eid.'');
	
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 
 	function count_under_process(){	
		$this -> db -> select('COUNT(*) as tot');
   		$this -> db -> from('dreem_student_request');
		$this -> db -> where('dreem_student_request.usercode NOT IN (SELECT usercode from dreem_student_member)');
		$this -> db -> where('dreem_student_request.payto',''.$this->session->userdata['logged_ol_member']['usercode'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
 	}
	
	function count_get_member(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('dreem_student_member');
		$this -> db -> where('dreem_student_member.upling',''.$this->session->userdata['logged_ol_member']['usercode'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function gift_earned(){	
	
		$this -> db -> select('dreem_student_member.*');
		
		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name',FALSE);
		$this -> db -> select('CONCAT(b.fname," ",b.lname) as upling_name',FALSE);
		$this -> db -> select('CONCAT(c.fname," ",c.lname) as pay_name',FALSE);
		
   		$this -> db -> from('dreem_student_member');
		
		$this -> db -> join('membermaster a','a.usercode = dreem_student_member.usercode','left');
		$this -> db -> join('membermaster b','b.usercode = dreem_student_member.upling','left');
		$this -> db -> join('membermaster c','c.usercode = dreem_student_member.payto','left');

		$this -> db -> where('dreem_student_member.payto',''.$this->session->userdata['logged_ol_member']['usercode'].'');

    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function gift_earned_detail($eid){	
	
		$this -> db -> select('dreem_student_request.*');
		$this -> db -> select('COUNT(dreem_student_payment_confirmation.usercode) as tot_payment');
		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name,a.username as member_code',FALSE);
		$this -> db -> select('CONCAT(b.fname," ",b.lname) as upling_name,b.username as upling_code',FALSE);
		$this -> db -> select('CONCAT(c.fname," ",c.lname) as pay_name,c.username as pay_code',FALSE);
		
   		$this -> db -> from('dreem_student_request');
		
		$this -> db -> join('membermaster a','a.usercode = dreem_student_request.usercode','left');
		$this -> db -> join('membermaster b','b.usercode = dreem_student_request.upling','left');
		$this -> db -> join('membermaster c','c.usercode = dreem_student_request.payto','left');
		$this -> db -> join('dreem_student_payment_confirmation','dreem_student_payment_confirmation.usercode = dreem_student_request.usercode','left');
		
		$this -> db -> where('dreem_student_request.usercode  IN (SELECT usercode from dreem_student_member)');
		$this -> db -> where('dreem_student_request.payto',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('dreem_student_request.usercode',''.$eid.'');
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function member_position_detail(){	
	
		$this -> db -> select('dreem_student_member.*');
		
		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name',FALSE);
		$this -> db -> select('CONCAT(b.fname," ",b.lname) as upling_name',FALSE);
		$this -> db -> select('CONCAT(c.fname," ",c.lname) as pay_name',FALSE);
		
   		$this -> db -> from('dreem_student_member');
		
		$this -> db -> join('membermaster a','a.usercode = dreem_student_member.usercode','left');
		$this -> db -> join('membermaster b','b.usercode = dreem_student_member.upling','left');
		$this -> db -> join('membermaster c','c.usercode = dreem_student_member.payto','left');

		$this -> db -> where('dreem_student_member.usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');

    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
 	
  
	
}
?>
