<?php
Class ad_module extends CI_Model
{
 	function get_join_request()
 	{	

		$this -> db -> select('dreem_student_request.*');
		$this -> db -> select('membermaster.fname, membermaster.lname, membermaster.skype ,membermaster.mobileno, membermaster.phone_no, membermaster.email_verification');
		$this -> db -> select('CONCAT(ref.fname," ",ref.lname) as ref_name,ref.usercode as ref_code',FALSE);
   		$this -> db -> from('dreem_student_request');
		$this -> db -> join('membermaster','membermaster.usercode = dreem_student_request.usercode','left');
		$this -> db -> join('membermaster ref','ref.usercode = membermaster.referralid_free','left');
   		$this -> db -> where('dreem_student_request.upling IS NULL');
		$this -> db -> where('dreem_student_request.usercode NOT IN (SELECT usercode from dreem_student_member)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_join_request_by_id($eid)
 	{	

		$this -> db -> select('dreem_student_request.*');
		$this -> db -> select('membermaster.fname, membermaster.lname, membermaster.username, membermaster.username, membermaster.referralid, membermaster.emailid, membermaster.mobileno');
   		$this -> db -> from('dreem_student_request');
		$this -> db -> join('membermaster','membermaster.usercode = dreem_student_request.usercode','left');
   		$this -> db -> where('dreem_student_request.upling IS NULL');
		$this -> db -> where('dreem_student_request.usercode NOT IN (SELECT usercode from dreem_student_member)');
		$this -> db -> where('dreem_student_request.usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function member_list2(){	
	
		$this -> db -> select('dreem_student_member.*');
		$this -> db -> select('membermaster.fname, membermaster.lname, membermaster.username, membermaster.username, membermaster.referralid, membermaster.emailid, membermaster.mobileno');
   		$this -> db -> from('dreem_student_member');
		$this -> db -> join('membermaster','membermaster.usercode = dreem_student_member.usercode','left');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function under_process(){	
	
		$this -> db -> select('dreem_student_request.*');
		$this -> db -> select('COUNT(dreem_student_payment_confirmation.usercode) as tot_payment');
		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name,a.username as member_code,a.skype,a.mobileno,a.phone_no, a.email_verification',FALSE);
		$this -> db -> select('CONCAT(b.fname," ",b.lname) as upling_name,b.username as upling_code',FALSE);
		$this -> db -> select('CONCAT(c.fname," ",c.lname) as pay_name,c.username as pay_code',FALSE);
		
		$this -> db -> select('CONCAT(ref.fname," ",ref.lname) as ref_name,ref.usercode as ref_code',FALSE);
		
   		$this -> db -> from('dreem_student_request');
		$this -> db -> join('membermaster a','a.usercode = dreem_student_request.usercode','left');
		$this -> db -> join('membermaster b','b.usercode = dreem_student_request.upling','left');
		$this -> db -> join('membermaster c','c.usercode = dreem_student_request.payto','left');
		$this -> db -> join('membermaster ref','ref.usercode = a.referralid_free','left');
		
		$this -> db -> join('dreem_student_payment_confirmation','dreem_student_payment_confirmation.usercode = dreem_student_request.usercode','left');
		
		$this -> db -> where('dreem_student_request.usercode NOT IN (SELECT usercode from dreem_student_member)');
		$this -> db -> where('dreem_student_request.upling IS NOT NULL');
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
		$this -> db -> where('dreem_student_request.upling IS NOT NULL');
		$this -> db -> where('dreem_student_request.usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function member_list(){	
		$this -> db -> select('dreem_student_member.*');

		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name,a.username as member_username, a.skype,a.mobileno,a.phone_no, a.email_verification, a.password',FALSE);
		$this -> db -> select('CONCAT(b.fname," ",b.lname) as upling_name,b.username as upling_code',FALSE);
		$this -> db -> select('CONCAT(c.fname," ",c.lname) as pay_name,c.username as pay_code',FALSE);
		$this -> db -> select('CONCAT(ref.fname," ",ref.lname) as ref_name,ref.usercode as ref_code',FALSE);
			
   		$this -> db -> from('dreem_student_member');
		
		$this -> db -> join('membermaster a','a.usercode = dreem_student_member.usercode','left');
		$this -> db -> join('membermaster b','b.usercode = dreem_student_member.upling','left');
		$this -> db -> join('membermaster c','c.usercode = dreem_student_member.payto','left');
		$this -> db -> join('membermaster ref','ref.usercode = a.referralid_free','left');
			
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	
	
	function count_join_request()
 	{	
		$this -> db -> select('COUNT(*) as tot');
   		$this -> db -> from('dreem_student_request');
   		$this -> db -> where('upling IS NULL');
		$this -> db -> where('usercode NOT IN (SELECT usercode from dreem_student_member)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
 	}
	
	function count_under_process(){	
	
		$this -> db -> select('COUNT(*) as tot');
   		$this -> db -> from('dreem_student_request');
   		$this -> db -> where('upling IS NOT NULL');
		$this -> db -> where('usercode NOT IN (SELECT usercode from dreem_student_member)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
 	}
	function count_member(){	
	
		$this -> db -> select('COUNT(*) as tot');
   		$this -> db -> from('dreem_student_member');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
 	}
 
 	
  
	
}
?>
