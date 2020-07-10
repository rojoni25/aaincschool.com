<?php
Class pdl_online_payment_module extends CI_Model
{
 	
	
	function get_member_usercode($eid)
 	{	
   		$this -> db -> select('*');
		
   		$this -> db -> from('membermaster');
		
		$this -> db -> where('usercode', ''.$eid.'');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content[0];
 	}
	
	function get_admin_email()
	{
		$this -> db -> select("membermaster.emailid");
		
   		$this -> db -> from('pdl_admin');
		
		$this -> db -> join('membermaster','membermaster.usercode = pdl_admin.usercode','left');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	
	function check_member_in_tree($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('pdl_member');
   		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_child_member($eid='')
	{
		$this -> db -> select('*');
   		$this -> db -> from('pdl_member');
		$this -> db -> where('upling',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_count_child_member($eid=''){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('pdl_member');
   		$this -> db -> where('upling',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function tree_user_by_usercode($eid){
		$this -> db -> select('upling');
   		$this -> db -> from('pdl_member');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('upling !=','0');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
		$return_val	=	(isset($the_content[0]['upling'])) ? $the_content[0]['upling'] : PDL_SYSTEM_USER;
		return $return_val;
    		
	}
	
	function upling_member_email($eid)
	{
		$this -> db -> select("pdl_member.usercode");
		$this -> db -> select("tbl1.usercode as uid1");
		$this -> db -> select("tbl2.usercode as uid2");
		$this -> db -> select("tbl3.usercode as uid3");
   		$this -> db -> from('pdl_member');
		$this -> db -> join('pdl_member tbl1','pdl_member.upling = tbl1.usercode','left');
		$this -> db -> join('pdl_member tbl2','tbl1.upling = tbl2.usercode','left');
		$this -> db -> join('pdl_member tbl3','tbl2.upling = tbl3.usercode','left');
		$this -> db -> where('pdl_member.usercode',''.$eid.'');
		
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	
		$arr=array();
		
		if($the_content[0]['uid1']!=''){	$arr[]=$the_content[0]['uid1']; }	
		if($the_content[0]['uid2']!=''){	$arr[]=$the_content[0]['uid2'];	}
		if($the_content[0]['uid3']!=''){	$arr[]=$the_content[0]['uid3'];	}
		
		
		if(!isset($arr[0])){	return false;	}
		
		$usercode_list= implode(',',$arr);
		
		$this -> db -> distinct();
		$this -> db -> select('membermaster.emailid');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode IN ('.$usercode_list.')');
		$this -> db -> where('email_verification','Y');
		$this -> db -> where('subscribe','Y');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	
		$email_array	=	array();
		
		for($i=0;$i<count($the_content);$i++){
			$email_array[]=$the_content[$i]['emailid'];
		}
		
		if(isset($email_array[0])){
			$email_array	=	implode(',',$email_array);
			return $email_array;
		}else{
			return false;
		}
				
	}

	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	
	function get_subscription_record($eid)
	{
   		$this -> db -> select('*');
   		$this -> db -> from('pdl_subscription');
		$this -> db -> where('subscription_id',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function master_balance_update($field, $usercode, $amount, $opration){

		if($opration=='plus'){
			$this->db->set(''.$field.'', '`'.$field.'`+ '.$amount.'', FALSE);
		}
		if($opration=='minus'){
			$this->db->set(''.$field.'', '`'.$field.'`- '.$amount.'', FALSE);
		}
		$this->db->where('usercode',''.$usercode.'');
		$this->db->update('master_balance_sheet');
	}
	
	
 
	
}
?>
