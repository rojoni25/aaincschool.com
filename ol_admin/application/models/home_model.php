<?php
Class home_model extends CI_Model
{
 	function get_all_member_count()
 	{	
   		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('status !=', 'Delete');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}

  function get_all_paid_member_count()
  {
      $this -> db -> select('count(*) as tot');
      $this -> db -> from('membermaster');
      $this -> db -> where('status !=', 'Delete');
      $this -> db -> where('status', 'Active');
      $query = $this -> db -> get();
      $the_content = $query->result_array();
      return $the_content;
  }

  function get_all_free_member_count()
  {
      $this -> db -> select('count(*) as tot');
      $this -> db -> from('membermaster');
      $this -> db -> where('status !=', 'Delete');
      $this -> db -> where('status', 'Pending');
      $query = $this -> db -> get();
      $the_content = $query->result_array();
      return $the_content;
  }

  function get_all_withdrawal_request()
  {
      $this -> db -> select('count(*) as tot');
      $this -> db -> from('withdrawal_request_master');
      $this -> db -> where('status', 'pending');
      $query = $this -> db -> get();
      $the_content = $query->result_array();
      return $the_content;
  }

  function get_all_request_to_paid()
  {
      $this -> db -> select('count(*) as tot');
      $this -> db -> from('request_to_renewal');
      $this -> db -> where('request_status', 'Pending');
      $query = $this -> db -> get();
      $the_content = $query->result_array();
      return $the_content;
  }

	function get_level_summery($field)
 	{	
		$this -> db -> select("count(member_level_track_master.".$field.") as tot",false);
		$this -> db -> select("count(membermaster.usercode) as tot2",false);
   		$this -> db -> from('member_level_track_master');
		$this -> db -> join('membermaster','member_level_track_master.usercode = membermaster.usercode and membermaster.status="Active"','left');
		$this -> db -> where('member_level_track_master.'.$field.' !=', '0');
		$this->db->group_by('member_level_track_master.'.$field.'');
		$this->db->order_by("member_level_track_master.".$field."","asc");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}

  function get_level_summery_free($field)
  { 
    $this -> db -> select("count(member_level_track_master_free.".$field.") as tot",false);
    $this -> db -> select("count(membermaster.usercode) as tot2",false);
      $this -> db -> from('member_level_track_master_free');
    $this -> db -> join('membermaster','member_level_track_master_free.usercode = membermaster.usercode and membermaster.status="Active"','left');
    $this -> db -> where('member_level_track_master_free.'.$field.' !=', '0');
    $this->db->group_by('member_level_track_master_free.'.$field.'');
    $this->db->order_by("member_level_track_master_free.".$field."","asc");
    $query = $this -> db -> get();
      $the_content = $query->result_array();
      return $the_content;
  }

  function get_admin_fees(){
    $this->db->select('setting_value');
    $this->db->from('site_settings');
    $this->db->where('lable_acces_nm', 'default_commission_to_admin');
    $query = $this->db->get();
    $the_content = $query->result_array();
    return $the_content;
  }

  function get_surplus_balance(){
    $this->db->select('sum(main_balance) as total');
    $this->db->from('master_balance_sheet');
    $this->db->where('usercode !=','0');
    $query = $this->db->get();
    $the_content = $query->result_array();
    return $the_content;
  }
 
 	
  	
  
	
}
