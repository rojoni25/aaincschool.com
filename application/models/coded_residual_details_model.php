<?php
Class coded_residual_details_model extends CI_Model
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
	
 	function get_coded_residual_by_type($type)
 	{	
   		$this -> db -> select('membermaster.fname,membermaster.lname');
		$this -> db -> select(''.$this->coded_residual.'.usercode, '.$this->coded_residual.'.level');
   		$this -> db -> from(''.$this->coded_residual.'');
		$this -> db -> join('membermaster','membermaster.usercode = '.$this->coded_residual.'.usercode','left');
		$this -> db -> where(''.$this->coded_residual.'.usercode_by', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where(''.$this->coded_residual.'.type', ''.$type.'');
		if($type=='residual'){
			 $this->db->order_by("".$this->coded_residual.".level","asc");
		}
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
 
 	
  
	
}
?>
