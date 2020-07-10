<?php
Class member_login_model extends CI_Model
{
 	
	function getAll()
	{
		$timestamp= time();
		$timestamp=strtotime('-40 second', $timestamp);
		
		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.mobileno,membermaster.emailid,membermaster.status as sts');
		$this -> db -> select('login_info.*');
		
   		$this -> db -> from('login_info');
		$this -> db -> join('membermaster','membermaster.usercode = login_info.usercode','left');
		
		$this -> db -> where('login_info.last_event >',''.$timestamp.'');
		$this -> db -> where('login_info.availeble','Y');
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function login_in_day($eid)
	{
		$timestamp= time();
		$timestamp=strtotime('-1440 minute', $timestamp);
		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.mobileno,membermaster.emailid,membermaster.status as sts');
		$this -> db -> select('login_info.*');
   		$this -> db -> from('login_info');
		$this -> db -> join('membermaster','membermaster.usercode = login_info.usercode','left');
		$this -> db -> where('login_info.last_event >',''.$timestamp.'');
		$this -> db -> group_by('login_info.usercode'); 
		$this -> db -> where('login_info.usercode NOT IN (0,1)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	
		return $the_content;
	}
	function filder_date($to, $from)
	{
		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.mobileno,membermaster.emailid,membermaster.status as sts');
		$this -> db -> select('login_info.*');
   		$this -> db -> from('login_info');
		$this -> db -> join('membermaster','membermaster.usercode = login_info.usercode','left');
		$this -> db -> where('login_info.last_event >=',''.$to.'');
		$this -> db -> where('login_info.last_event <=',''.$from.''); 
		$this -> db -> where('login_info.usercode NOT IN (0,1)');
		$this -> db -> order_by("login_info.last_event","desc");
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;
	}
 
 	
	
	
	
  	
  
	
}
?>
