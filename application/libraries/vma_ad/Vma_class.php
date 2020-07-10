<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Vma_class {


	
	function check_request()
	{
		$CI =& get_instance();
		$CI -> db -> select('*');
   		$CI -> db -> from('vma_request');
   		$CI -> db -> where('usercode',''.$CI->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $CI -> db -> get();
		$the_content = $query->result_array();
    	return (isset($the_content[0]))? true : false;
	}
	
	function check_payment()
	{
		$CI =& get_instance();
		$CI -> db -> select('*');
   		$CI -> db -> from('vma_monthly_payment');
   		$CI -> db -> where('usercode',''.$CI->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $CI -> db -> get();
		$the_content = $query->result_array();
    	return (isset($the_content[0]))? true : false;
	}
	
	function check_in_tree()
	{
		$CI =& get_instance();
		$CI -> db -> select('*');
   		$CI -> db -> from('vma_member');
   		$CI -> db -> where('usercode',''.$CI->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $CI -> db -> get();
		$the_content = $query->result_array();
    	return (isset($the_content[0]))? true : false;
	}
	
	function tree_upling_level($eid)
	{
		$CI =& get_instance();
		$CI -> db -> select('t1.usercode as lv1');
		$CI -> db -> select('t2.usercode as lv2');
		$CI -> db -> select('t3.usercode as lv3');
   		$CI -> db -> from('vma_member');
		$CI -> db -> join('vma_member t1','vma_member.upling = t1.usercode','left');
		$CI -> db -> join('vma_member t2','t1.upling = t2.usercode','left');
		$CI -> db -> join('vma_member t3','t2.upling = t3.usercode','left');
   		$CI -> db -> where('vma_member.usercode', ''.$eid.'');
		
		$query = $CI -> db -> get();
    	$the_content = $query->result_array();
		
		if(!isset($the_content[0]['lv1'])){	$the_content[0]['lv1']='1';	}
		if(!isset($the_content[0]['lv2'])){	$the_content[0]['lv2']='1';	}
		if(!isset($the_content[0]['lv3'])){	$the_content[0]['lv3']='1';	}
		
    	return $the_content[0];
	}
	
	function get_child($eid){
		$CI =& get_instance();
		$CI -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$CI -> db -> select('vma_member.*');
   		$CI -> db -> from('vma_member');
		$CI -> db -> join('membermaster','membermaster.usercode = vma_member.usercode','left');
   		$CI -> db -> where('vma_member.upling',''.$eid.'');
		$CI -> db -> order_by('vma_member.side','ASC');
   		$query = $CI -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member_by_code($eid){
		$CI =& get_instance();
		$CI -> db -> select('vma_member.*');
		$CI -> db -> select('CONCAT (membermaster.fname," ",membermaster.lname) as name, membermaster.emailid, membermaster.username',FALSE);
		$CI -> db -> from('vma_member');
		$CI -> db -> join('membermaster','membermaster.usercode = vma_member.usercode','left');
		$CI -> db -> where('vma_member.usercode',''.$eid.'');
		$query = $CI -> db -> get();
		$the_content = $query->result_array();
		return $the_content[0];
	}
	
	function upling_chain($eid){
		$arr    = array();
		
		$code=$eid;
		while(true){
			$result = $this->get_member_by_code($code);
			
			if(!is_array($result)){
				break;	
			}
			if($result['usercode']=='1'){
				$arr[]=$result;
				break;
			}
			
			$arr[]=$result;
			$code=$result['upling'];
		}
		
		$arr=array_reverse($arr);
		
		return $arr;
		
	}
	
	function count_member_on_level1($eid)
	{
		$CI =& get_instance();
		$sQuery = 'SELECT COUNT(level1.id) as tot FROM (vma_member) 
		LEFT JOIN vma_member as level1 ON level1.upling = vma_member.usercode
		WHERE vma_member.usercode = "'.$eid.'" ';
		$query = $CI->db->query($sQuery);
		$the_content = $query->result_array();
    	return (int)$the_content[0]['tot'];	
	}
	function get_member_on_level1($eid)
	{
		$CI =& get_instance();
		$sQuery = 'SELECT CONCAT(membermaster.fname, " ", membermaster.lname) as name,membermaster.usercode
		FROM (vma_member) 
		INNER JOIN vma_member as level1 ON level1.upling = vma_member.usercode
		INNER JOIN membermaster ON membermaster.usercode = level1.usercode
		WHERE vma_member.usercode = "'.$eid.'"';
		$query = $CI->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;		
	}
	
	
	function count_member_on_level2($eid){
		$CI =& get_instance();
		$sQuery = 'SELECT COUNT(level2.id) as tot, 
		vma_member.* FROM (vma_member) 
		LEFT JOIN vma_member as level1 ON level1.upling = vma_member.usercode
		LEFT JOIN vma_member as level2 ON level2.upling = level1.usercode
		WHERE vma_member.usercode = "'.$eid.'"';
		$query = $CI->db->query($sQuery);
		$the_content = $query->result_array();
    	return (int)$the_content[0]['tot'];	
	}
	function get_member_on_level2($eid)
	{
		$CI =& get_instance();
		$sQuery = 'SELECT CONCAT(membermaster.fname, " ", membermaster.lname) as name,membermaster.usercode
		FROM (vma_member) 
		INNER JOIN vma_member as level1 ON level1.upling = vma_member.usercode
		INNER JOIN vma_member as level2 ON level2.upling = level1.usercode
		INNER JOIN membermaster ON membermaster.usercode = level2.usercode
		WHERE vma_member.usercode = "'.$eid.'"';
		$query = $CI->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;		
	}
	
	function count_member_on_level3($eid){
		$CI =& get_instance();
		$sQuery = 'SELECT COUNT(level3.id) as tot, 
		vma_member.* FROM (vma_member) 
		LEFT JOIN vma_member as level1 ON level1.upling = vma_member.usercode
		LEFT JOIN vma_member as level2 ON level2.upling = level1.usercode
		LEFT JOIN vma_member as level3 ON level3.upling = level2.usercode
		WHERE vma_member.usercode = "'.$eid.'"';
		$query = $CI->db->query($sQuery);
		$the_content = $query->result_array();
    	return (int)$the_content[0]['tot'];	
	}
	function get_member_on_level3($eid)
	{
		$CI =& get_instance();
		$sQuery = 'SELECT CONCAT(membermaster.fname, " ", membermaster.lname) as name,membermaster.usercode
		FROM (vma_member)
		INNER JOIN vma_member as level1 ON level1.upling = vma_member.usercode
		INNER JOIN vma_member as level2 ON level2.upling = level1.usercode
		INNER JOIN vma_member as level3 ON level3.upling = level2.usercode
		INNER JOIN membermaster ON membermaster.usercode = level3.usercode
		WHERE vma_member.usercode = "'.$eid.'"';
		$query = $CI->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;		
	}
	
	function count_member_on_level4($eid){
		$CI =& get_instance();
		$sQuery = 'SELECT COUNT(level4.id) as tot, 
		vma_member.* FROM (vma_member) 
		LEFT JOIN vma_member as level1 ON level1.upling = vma_member.usercode
		LEFT JOIN vma_member as level2 ON level2.upling = level1.usercode
		LEFT JOIN vma_member as level3 ON level3.upling = level2.usercode
		LEFT JOIN vma_member as level4 ON level4.upling = level3.usercode
		WHERE vma_member.usercode = "'.$eid.'"';
		$query = $CI->db->query($sQuery);
		$the_content = $query->result_array();
    	return (int)$the_content[0]['tot'];	
	}
	function get_member_on_level4($eid)
	{
		$CI =& get_instance();
		$sQuery = 'SELECT CONCAT(membermaster.fname, " ", membermaster.lname) as name,membermaster.usercode
		FROM (vma_member)
		INNER JOIN vma_member as level1 ON level1.upling = vma_member.usercode
		INNER JOIN vma_member as level2 ON level2.upling = level1.usercode
		INNER JOIN vma_member as level3 ON level3.upling = level2.usercode
		INNER JOIN vma_member as level4 ON level4.upling = level3.usercode
		INNER JOIN membermaster ON membermaster.usercode = level4.usercode
		WHERE vma_member.usercode = "'.$eid.'"';
		$query = $CI->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;		
	}
	
	function virtual_balance($eid)
	{
	  $arr=array();		
	  $arr['in']		=	$this->virtual_income($eid);
	  $arr['out']		=	$this->virtual_payment($eid);
	  $arr['balance']	=	 $arr['in']-$arr['out'];
	  return $arr;
	}
	
	function virtual_income($eid)
	{
		$CI =& get_instance();
		$CI -> db -> select('SUM(amount) as tot');
   		$CI -> db -> from('vma_virtual_wallet');
		$CI -> db  -> where('usercode',''.$eid.'');
		$query = $CI -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];	
	}
	
	function virtual_payment($eid)
	{
		$CI =& get_instance();
		$CI -> db -> select('SUM(amount) as tot');
   		$CI -> db -> from('vma_daily_payment');
		$CI -> db  -> where('EndCode',''.$eid.'');
		$query = $CI -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];	
	}
	
	
	function main_balance($eid)
	{
	  $arr=array();		
	  $arr['in']		=	$this->main_income($eid);
	  $arr['out']		=	$this->main_payment($eid);
	  $arr['balance']	=	 $arr['in']-$arr['out'];
	  return $arr;
	}
	
	function main_income($eid)
	{
		$CI =& get_instance();
		$CI -> db -> select('SUM(amount) as tot');
   		$CI -> db -> from('vma_daily_payment');
		$CI -> db  -> where('usercode',''.$eid.'');
		$query = $CI -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];	
	}
	
	function main_payment($eid)
	{
		$CI =& get_instance();
		$CI -> db -> select('SUM(amount) as tot');
   		$CI -> db -> from('vma_withdrawal');
		$CI -> db  -> where('usercode',''.$eid.'');
		$query = $CI -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];	
	}
	
	//function 

	function check_due($eid){
		$time	=	strtotime(date('d-m-Y'));
		
		$CI =& get_instance();
		$CI -> db -> select('*');
   		$CI -> db -> from('vma_member');
		$CI -> db  -> where('usercode',''.$eid.'');
		$query = $CI -> db -> get();
    	$the_content = $query->result_array();
		$due_time = (int)$the_content[0]['due_time'];
		if($due_time >= $time ){
			return true;
		}
		else{
			return false;
		}
	}
	
	function manully_qulified($eid){
		
		$CI =& get_instance();
		$CI -> db -> select('*');
   		$CI -> db -> from('vma_member');
		$CI -> db  -> where('usercode',''.$eid.'');
		$query = $CI -> db -> get();
    	$the_content = $query->result_array();
		
		if($the_content[0]['qulified'] == 'Y' ){
			return true;
		}
		else{
			return false;
		}
	}
	
	function get_count_unilevel($eid)
	{
		$CI =& get_instance();
		$CI -> db -> select('COUNT(usercode) as tot');
   		$CI -> db -> from('vma_member');
		$CI -> db -> where('usercode IN (SELECT usercode from membermaster where referralid_free="'.$eid.'")');
		$query = $CI -> db -> get();
    	$the_content = $query->result_array();
    	return (int)$the_content[0]['tot'];
	}
	function get_count_unilevel_active($eid)
	{
		$time	=	strtotime(date('d-m-Y'));
		$CI =& get_instance();
		$CI -> db -> select('COUNT(usercode) as tot');
   		$CI -> db -> from('vma_member');
		$CI -> db -> where('usercode IN (SELECT usercode from membermaster where referralid_free="'.$eid.'")');
		$CI -> db -> where('due_time >=',$time);
		$query = $CI -> db -> get();
    	$the_content = $query->result_array();
    	return (int)$the_content[0]['tot'];
	}
	
	function check_unqulified($eid){
		
		if($eid=='1'){
			return true;
		}
		if(!$this->check_due($eid)){
			return false;
		}
		
		if($this->manully_qulified($eid)){
			return true;
		}
		
		$active_downline=$this->get_count_unilevel_active($eid);
		if($active_downline >=3){
			return true;
		}
		return false;
	}

	
	
	
	
	
	
	
	
	
	
	
	

	
	
}
