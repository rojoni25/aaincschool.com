<?php
Class unilevel_model extends CI_Model
{
 	protected $coded_residual;
	protected $member_level_track_master;
	protected $member_node_master;
	protected $referralid;
	
	function __construct()
 	{
   		$this->coded_residual				=	'coded_residual';
		$this->member_level_track_master	=	'member_level_track_master';
		$this->member_node_master			=	'member_node_master';
		$this->referralid					=	'referralid';
 	}
	
 	function get_all_referral($eid)
 	{	
   		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.usercode');
		$this -> db -> select(''.$this->coded_residual.'.type');
   		$this -> db -> from('membermaster');
		$this -> db -> join(''.$this->coded_residual.'',''.$this->coded_residual.'.usercode = membermaster.usercode and '.$this->coded_residual.'.usercode_by="'.$this->session->userdata['logged_ol_member']['usercode'].'"','left');
		$this -> db -> where('membermaster.'.$this->referralid.'', ''.$eid.'');
		$this -> db -> where('membermaster.status', 'Active');
		$this -> db ->order_by("membermaster.usercode", "asc");
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
 
 	
  
	
}