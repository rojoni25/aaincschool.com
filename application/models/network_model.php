<?php
Class network_model extends CI_Model
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
 	function getAll($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where(''.$this->referralid.'',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function count_friend($eid)
	{
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
   		$this -> db -> where(''.$this->referralid.'',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_capture_page_name($eid){
		$this -> db -> select('capture_page_master.page_name');
		$this -> db -> select('capture_page_record.pagelable');
   		$this -> db -> from('capture_page_master');
		$this -> db -> join('capture_page_record','capture_page_master.pagecode = capture_page_record.pagename','left');
   		$this -> db -> where('capture_page_master.capture_page_code',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function embed_member_getAll()
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('referralid',''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$this -> db -> where('camefrom !=', '');
   		 $this -> db -> where('camefrom !=', '0');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

}
?>
