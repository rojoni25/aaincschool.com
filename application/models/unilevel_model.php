<?php
Class unilevel_model extends CI_Model
{
	protected $coded_residual;
	protected $member_level_track_master;
	protected $member_node_master;
	protected $referralid;
	protected $current_account;
	
	
	function __construct()
 	{
   		$this->coded_residual				=	$this->session->userdata['tbl']['coded_residual'];
		$this->member_level_track_master	=	$this->session->userdata['tbl']['member_level_track_master'];
		$this->member_node_master			=	$this->session->userdata['tbl']['member_node_master'];
		$this->referralid					=	$this->session->userdata['tbl']['referralid'];
		$this->current_account				=	$this->session->userdata['tbl']['current_account'];
 	}
	
 	function get_all_referral($eid)
 	{	
   		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.usercode');
		$this -> db -> select(''.$this->coded_residual.'.type');
   		$this -> db -> from('membermaster');
		$this -> db -> join(''.$this->coded_residual.'',''.$this->coded_residual.'.usercode = membermaster.usercode and '.$this->coded_residual.'.usercode_by="'.$this->session->userdata['logged_ol_member']['usercode'].'"','left');
		$this -> db -> where('membermaster.'.$this->referralid.'', ''.$eid.'');
		
		//$this -> db ->order_by("".$this->coded_residual.".idcode", "asc");
		if($this->current_account=='Active'){
			$this -> db ->where("membermaster.status", "Active");
			$this -> db ->order_by("".$this->coded_residual.".idcode", "asc");
		}
		else{
			$this -> db ->order_by("membermaster.usercode", "asc");
		}
		
		
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}

 	function get_setting_value($label){
 		$this->db->select('setting_value');
 		$this->db->from('site_settings');
 		$this->db->where('lable_acces_nm', $label);
 		$query = $this->db->get();
 		$result = $query->result();
 		if(count($result)){
 			return $result[0]->setting_value;
 		} else{
 			return;
 		}
 	}
 
 	
  
	
}
?>
