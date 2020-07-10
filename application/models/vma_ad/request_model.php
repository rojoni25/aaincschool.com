<?php
Class request_model extends CI_Model
{
 	function get_list()
 	{
   		$this -> db -> select('vma_request.*');
		$this -> db -> select('CONCAT(membermaster.fname, " ", SUBSTRING(membermaster.lname,1,1)) as name,membermaster.username',FALSE);
		$this -> db -> select('vma_monthly_payment.id as payment_code');
		$this -> db -> from('vma_request');
		$this -> db -> join('membermaster','membermaster.usercode = vma_request.usercode','left');
		$this -> db -> join('vma_monthly_payment','vma_monthly_payment.usercode = vma_request.usercode','left');
		$this -> db -> where('vma_request.usercode NOT IN (SELECT usercode from vma_member)');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	
	function get_request_by_id($eid){
		
		$this -> db -> select('vma_request.*');
		$this -> db -> select('CONCAT(membermaster.fname, " ",membermaster.lname) as name,membermaster.username',FALSE);
		$this -> db -> select('vma_monthly_payment.id as payment_code');
		$this -> db -> from('vma_request');
		$this -> db -> join('membermaster','membermaster.usercode = vma_request.usercode','left');
		$this -> db -> join('vma_monthly_payment','vma_monthly_payment.usercode = vma_request.usercode','left');
		$this -> db -> where('vma_request.usercode NOT IN (SELECT usercode from vma_member)');
		$this -> db -> where('vma_request.request_code', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member_list()
	{
		$this -> db -> select('vma_member.*');
		$this -> db -> select('CONCAT(membermaster.fname, " ",membermaster.lname) as name,membermaster.username',FALSE);
		$this -> db -> from('vma_member');
		$this -> db -> join('membermaster','membermaster.usercode = vma_member.usercode','left');
		$this -> db -> order_by('vma_member.id','ASC');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_downline($eid='')
	{
		$this -> db -> select('*');
   		$this -> db -> from('vma_member');
   		$this -> db -> where('upling',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_count_downline($eid=''){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('vma_member');
   		$this -> db -> where('upling',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function tree_upling_level($eid)
	{
		$this -> db -> select('t1.usercode as lv1');
		$this -> db -> select('t2.usercode as lv2');
		$this -> db -> select('t3.usercode as lv3');
   		$this -> db -> from('vma_member');
		$this -> db -> join('vma_member t1','vma_member.upling = t1.usercode','left');
		$this -> db -> join('vma_member t2','t1.upling = t2.usercode','left');
		$this -> db -> join('vma_member t3','t2.upling = t3.usercode','left');
   		$this -> db -> where('vma_member.usercode', ''.$eid.'');
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		
		if($the_content[0]['lv1']=='0'){	$the_content[0]['lv1']='1';	}
		if($the_content[0]['lv2']=='0'){	$the_content[0]['lv2']='1';	}
		if($the_content[0]['lv3']=='0'){	$the_content[0]['lv3']='1';	}
		
    	return $the_content[0];
	}
	
	
	
	
	
	
	
	
	
}
?>
