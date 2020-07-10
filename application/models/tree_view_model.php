<?php
Class tree_view_model extends CI_Model
{
	protected $coded_residual;
	protected $member_level_track_master;
	protected $member_node_master;
	protected $referralid;
	
	function __construct()
 	{
   		$this->coded_residual				=	$this->session->userdata['tbl']['coded_residual'];
		$this->member_level_track_master	=	$this->session->userdata['tbl']['member_level_track_master'];
		$this->member_node_master			=	$this->session->userdata['tbl']['member_node_master'];
		$this->referralid					=	$this->session->userdata['tbl']['referralid'];
 	}
 	function getAll()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('country_master');
   		$this -> db -> where('status !=', 'Delete');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
 
 	function get_record($eid){
		$this -> db -> select('*');
   		$this -> db -> from('country_master');
   		$this -> db -> where('country_code', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_node_three_by_three_by_id($eid)
	{
		$this -> db -> select('membermaster.fname,membermaster.lname');
		$this -> db -> select(''.$this->member_node_master.'.usercode,'.$this->member_node_master.'.side_3_3');
		$this -> db -> select("IFNULL(".$this->coded_residual.".type,'admin') as img",false);
   		$this -> db -> from(''.$this->member_node_master.'');
		$this -> db -> join('membermaster','membermaster.usercode = '.$this->member_node_master.'.usercode','left');
		$this -> db -> join(''.$this->coded_residual.'',''.$this->coded_residual.'.usercode = '.$this->member_node_master.'.usercode and '.$this->coded_residual.'.usercode_by="'.$this->session->userdata['logged_ol_member']['usercode'].'"','left');
		$this -> db -> where(''.$this->member_node_master.'.uplingmember3_3', ''.$eid.'');
		$this -> db -> order_by(''.$this->member_node_master.'.side_3_3', 'asc');
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_node_five_by_three_by_id($eid)
	{
		$this -> db -> select('membermaster.fname,membermaster.lname');
		$this -> db -> select(''.$this->member_node_master.'.usercode,'.$this->member_node_master.'.side_5_3');
   		$this -> db -> from(''.$this->member_node_master.'');
		$this -> db -> join('membermaster','membermaster.usercode = '.$this->member_node_master.'.usercode','left');
		$this -> db -> where(''.$this->member_node_master.'.uplingmember5_3', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_node_ten_by_three_by_id($eid)
	{
		$this -> db -> select('membermaster.fname,membermaster.lname');
		$this -> db -> select(''.$this->member_node_master.'.usercode,'.$this->member_node_master.'.side_10_3');
   		$this -> db -> from(''.$this->member_node_master.'');
		$this -> db -> join('membermaster','membermaster.usercode = '.$this->member_node_master.'.usercode','left');
		$this -> db -> where(''.$this->member_node_master.'.uplingmember10_3', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function userdt_by_code($eid){
		$this -> db -> select('fname,lname');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_breadcrumb_level($eid)
	{
		$this -> db -> select('membermaster.fname,membermaster.lname');
		$this -> db -> select(''.$this->member_node_master.'.*');
   		$this -> db -> from(''.$this->member_node_master.'');
		$this -> db -> join('membermaster','membermaster.usercode = '.$this->member_node_master.'.usercode','left');
		$this -> db -> where(''.$this->member_node_master.'.usercode', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	
}
?>
