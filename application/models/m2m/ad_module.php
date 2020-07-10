<?php
Class ad_module extends CI_Model
{
 	function get_join_request()
 	{	

		$this -> db -> select('m2m_request.*');
		$this -> db -> select('membermaster.fname, membermaster.lname');
   		$this -> db -> from('m2m_request');
		$this -> db -> join('membermaster','membermaster.usercode = m2m_request.usercode','left');
   		$this -> db -> where('m2m_request.upling IS NULL');
		$this -> db -> where('m2m_request.usercode NOT IN (SELECT usercode from m2m_member)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_join_request_by_id($eid)
 	{	

		$this -> db -> select('m2m_request.*');
		$this -> db -> select('membermaster.fname, membermaster.lname, membermaster.username, membermaster.username, membermaster.referralid, membermaster.emailid, membermaster.mobileno');
   		$this -> db -> from('m2m_request');
		$this -> db -> join('membermaster','membermaster.usercode = m2m_request.usercode','left');
   		$this -> db -> where('m2m_request.upling IS NULL');
		$this -> db -> where('m2m_request.usercode NOT IN (SELECT usercode from m2m_member)');
		$this -> db -> where('m2m_request.usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function member_list(){	
	
		$this -> db -> select('m2m_member.*');
		$this -> db -> select('membermaster.fname, membermaster.lname, membermaster.username, membermaster.username, membermaster.referralid, membermaster.emailid, membermaster.mobileno');
   		$this -> db -> from('m2m_member');
		$this -> db -> join('membermaster','membermaster.usercode = m2m_member.usercode','left');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
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
		$this -> db -> where('m2m_request.upling IS NOT NULL');
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
		$this -> db -> where('m2m_request.upling IS NOT NULL');
		$this -> db -> where('m2m_request.usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function m2m_member(){	
		$this -> db -> select('m2m_member.*');

		$this -> db -> select('CONCAT(a.fname," ",a.lname) as member_name,a.username as member_code',FALSE);
		$this -> db -> select('CONCAT(b.fname," ",b.lname) as upling_name,b.username as upling_code',FALSE);
		$this -> db -> select('CONCAT(c.fname," ",c.lname) as pay_name,c.username as pay_code',FALSE);
			
   		$this -> db -> from('m2m_member');
		
		$this -> db -> join('membermaster a','a.usercode = m2m_member.usercode','left');
		$this -> db -> join('membermaster b','b.usercode = m2m_member.upling','left');
		$this -> db -> join('membermaster c','c.usercode = m2m_member.payto','left');
			
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function count_join_request()
 	{	
		$this -> db -> select('COUNT(*) as tot');
   		$this -> db -> from('m2m_request');
   		$this -> db -> where('upling IS NULL');
		$this -> db -> where('usercode NOT IN (SELECT usercode from m2m_member)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
 	}
	
	function count_under_process(){	
	
		$this -> db -> select('COUNT(*) as tot');
   		$this -> db -> from('m2m_request');
   		$this -> db -> where('upling IS NOT NULL');
		$this -> db -> where('usercode NOT IN (SELECT usercode from m2m_member)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
 	}
	function count_m2m_member(){	
	
		$this -> db -> select('COUNT(*) as tot');
   		$this -> db -> from('m2m_member');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
 	}
	
	function addItem($data,$table){
    	$this->db->insert($table,$data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	
 
 
 //-------------------------------------dfsm-------------------------------------
 	function get_capture_page_record_by_id($eid){
		$this -> db -> select('*');
   		$this -> db -> from('m2m_capture_master');
		$this -> db -> where('page_code',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function delete($table,$where){
		$this->db->where($where);
		$this->db->delete($table);
	}
	
  //-------------------------------------dfsm-------------------------------------
  
	
}
?>
