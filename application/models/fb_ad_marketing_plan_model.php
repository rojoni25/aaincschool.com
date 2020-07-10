<?php
Class fb_ad_marketing_plan_model extends CI_Model
{
 	function get_pages_contain($pagelable)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable', ''.$pagelable.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
 	}
 	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
		function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
function get_setting_value_by_lable($value){
		$this -> db -> select('setting_value');
   		$this -> db -> from('site_settings');
   		$this -> db -> where('lable_acces_nm', ''.$value.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_reverse_tree_by_usercode($eid){
		$this -> db -> select('*');
   		$this -> db -> from('member_node_reverse');
   		$this -> db -> where('usercode',$eid);
    	$query = $this -> db -> get();
    	$the_content = $query->row_array();
    	return $the_content;
	}
	 	function get_usercode_by_reverse_tree($eid='',$type)
	{
		$this -> db -> select('*');
   		$this -> db -> from('member_node_reverse');
   		$this -> db -> where($type, ''.$eid.'');
   		$this -> db -> order_by('usercode', 'desc');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	//===== Get all users who are subscribed to fb marketing plan ======
	function get_all_pro_marketer_subscribers(){
	    $this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('referralid', $usercode);
   		$this -> db -> join('tbl_susbscribed_plans','membermaster.usercode = tbl_susbscribed_plans.usercode','left');
		$this -> db -> where('tbl_susbscribed_plans.status','Active');
   		$this -> db -> order_by('membermaster.usercode2','asc');
   	    $query = $this -> db -> get();
   		$the_content = $query->result_array();
    	return $the_content;
	}
	
	//-- get current user ------------------- 
	function get_user($usercode){
	  
	    $this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', $usercode);
   		$this -> db -> order_by('usercode','asc');
   		$query = $this -> db -> get();
   		$the_content = $query->result_array();
    	return $the_content;
	}

	
}
?>
