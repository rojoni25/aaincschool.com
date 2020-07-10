<?php
Class dashboard_model extends CI_Model
{
 	function get_all_member_count()
 	{	
   		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
		$this -> db -> where(''.$this->session->userdata['tbl']['referralid'].'',''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$this -> db -> where('status !=', 'Delete');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	function get_level_summary($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from(''.$this->session->userdata['tbl']['member_level_track_master'].'');
   		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_level_summery_admin($field)
 	{	
		$this -> db -> select("count(".$this->session->userdata['tbl']['member_level_track_master'].".".$field.") as tot",false);
		$this -> db -> select("count(membermaster.usercode) as tot2",false);
   		$this -> db -> from(''.$this->session->userdata['tbl']['member_level_track_master'].'');
		$this -> db -> join('membermaster',''.$this->session->userdata['tbl']['member_level_track_master'].'.usercode = membermaster.usercode and membermaster.status="Active"','left');
		$this -> db -> where(''.$this->session->userdata['tbl']['member_level_track_master'].'.'.$field.' !=', '0');
		$this->db->group_by(''.$this->session->userdata['tbl']['member_level_track_master'].'.'.$field.'');
		$this->db->order_by("".$this->session->userdata['tbl']['member_level_track_master'].".".$field."","asc");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_setting_value_by_lable($value)
	{
		$this -> db -> select('*');
   		$this -> db -> from('site_settings');
   		$this -> db -> where('lable_acces_nm', ''.$value.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_coded_residual_id($eid)
	{
		$this -> db -> select('count(*) as tot');
		$this -> db -> from(''.$this->session->userdata['tbl']['coded_residual'].'');
		$this -> db -> where('type',''.$eid.'');
   		$this -> db -> where('usercode_by',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
		
 
 	
  	
  
	
}
?>
