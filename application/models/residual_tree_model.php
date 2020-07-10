<?php
Class residual_tree_model extends CI_Model
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
	
 	function get_all_referral($eid)
 	{	
   		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.usercode');
   		$this -> db -> from(''.$this->coded_residual.'');
		$this -> db -> join('membermaster','membermaster.usercode = '.$this->coded_residual.'.usercode','left');
		$this -> db -> where(''.$this->coded_residual.'.usercode_by',''.$eid.'');
		$this -> db -> where(''.$this->coded_residual.'.type','residual');
		$this -> db -> where(''.$this->coded_residual.'.level','1');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	function get_all_referral_next($eid)
	{
		$this -> db -> select('fname,lname,usercode');
   		$this -> db -> from('membermaster');
		$this -> db -> where(''.$this->referralid.'',''.$eid.'');
		$this -> db -> where('usercode in(select usercode from '.$this->coded_residual.' where usercode_by="'.$this->session->userdata['logged_ol_member']['usercode'].'" and type="residual")');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 
 	
  
	
}
?>
