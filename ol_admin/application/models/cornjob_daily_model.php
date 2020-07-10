<?php
Class cornjob_daily_model extends CI_Model
{

	function getPaymentValue()
	{
		$this->db->select('*');
		$this->db->from('site_settings');
		$this->db->where('lable_acces_nm', 'software_license_referral_member');
		$query=$this->db->get();
		$res=$query->result_array();
		return $res[0]['setting_value'];
	}

 	function getDueDate()
	{
    	$this->db->select('due_time');
		$this->db->from('membermaster');
		$query=$this->db->get();
		$res=$query->result_array();
		return $res;
	}

	function check_date()
	{
		$date = strtotime(date("Y-m-d"));
	  	$query = $this->db->query("select * from membermaster where $date > due_time and due_time!=0 and status='Active'");
	    $res=$query->result_array();
		return $res;
	}

	function get_package_amt(){
		$this->db->select('*');
		$this->db->from('site_settings');
		$this->db->where('lable_acces_nm', 'package_amount');
		$query=$this->db->get();
		$res=$query->result_array();
		return $res[0]['setting_value'];
	}

	function get_ammount_master_balance_sheet($usercode)
	{
		$this->db->select('*');
		$this->db->from('master_balance_sheet');
		$this->db->where('usercode',''.$usercode.'');
		$query=$this->db->get();
		$res=$query->result_array();
		return $res;
	}
 
 function get_setting_value_by_lable($value){
		$this -> db -> select('*');
   		$this -> db -> from('site_settings');
   		$this -> db -> where('lable_acces_nm', ''.$value.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function referral_user($eid)
	{
		$this -> db -> select('referralid');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		if($the_content[0]['referralid']=='0'){
			$the_content[0]['referralid']='';
		}
    	return $the_content;
	}
	
	function tree_upling($eid, $field)
	{
		$this -> db -> select($field.' as upling');
   		$this -> db -> from('member_node_master');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content=(!isset($the_content[0]) || $the_content[0]['upling']=='0') ? "1" : $the_content[0]['upling'];
	}
	
	function get_upling_chain($eid, $field)
	{
		$this -> db  -> select('member_node_master.'.$field.' as lev1');
		$this -> db  -> select('tbl1.'.$field.' as lev2');
		$this -> db  -> select('tbl2.'.$field.' as lev3');
   		$this -> db  -> from('member_node_master');
		$this -> db  -> join('member_node_master tbl1','member_node_master.'.$field.' = tbl1.usercode','left');
		$this -> db  -> join('member_node_master tbl2','tbl1.'.$field.' = tbl2.usercode','left');
   		$this -> db  -> where('member_node_master.usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		
		$arr=array();
		$arr['lev1']=($the_content[0]['lev1']=='0')? "1" : $the_content[0]['lev1'];
		$arr['lev2']=($the_content[0]['lev2']=='0')? "1" : $the_content[0]['lev2'];
		$arr['lev3']=($the_content[0]['lev3']=='0')? "1" : $the_content[0]['lev3'];	
    	return $arr;
		
	}
	
	
	function tree_upling_level($eid, $field)
	{
		$this -> db -> select('member_node_master.'.$field.' as lv1');
		$this -> db -> select('t1.'.$field.' as lv2');
		$this -> db -> select('t2.'.$field.' as lv3');
   		$this -> db -> from('member_node_master');
		
		$this -> db -> join('member_node_master t1','member_node_master.'.$field.' = t1.usercode','left');
		$this -> db -> join('member_node_master t2','t1.'.$field.' = t2.usercode','left');
		
   		$this -> db -> where('member_node_master.usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		
		if($the_content[0]['lv1']=='0'){	$the_content[0]['lv1']='1';	}
		if($the_content[0]['lv2']=='0'){	$the_content[0]['lv2']='1';	}
		if($the_content[0]['lv3']=='0'){	$the_content[0]['lv3']='1';	}
		
    	return $the_content[0];
	}
	
	function get_payment_level($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('daily_payment_level');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_payment_level_free($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('daily_payment_level_free');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function check_payment_date($field, $type)
	{
		$this -> db -> select('*');
   		$this -> db -> from('payment_daily_date_entry');
   		$this -> db -> where('pay_type', ''.$field.'');
		$this -> db -> where('pay_day', ''.date('d').'');
		$this -> db -> where('pay_month', ''.date('m').'');
		$this -> db -> where('pay_year', ''.date('Y').'');
		$this -> db -> where('type', ''.$type.'');
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
	
	function get_all_payment($field)
	{
		$this -> db -> select('usercode');
   		$this -> db -> from('master_balance_sheet');
   		$this -> db -> where(''.$field.' >=', '1',FALSE);
		$this -> db -> where('usercode NOT IN (0,1)');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_all_payment_free($field)
	{
		$this -> db -> select('usercode');
   		$this -> db -> from('master_balance_sheet_free');
   		$this -> db -> where(''.$field.' >=', '1',FALSE);
		$this -> db -> where('usercode !=', '1');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_free_member_default_set()
	{
		$this -> db -> select('*');
   		$this -> db -> from('master_balance_sheet_free');
		$this -> db ->or_where('exp3by3 >=','1');
		$this -> db ->or_where('exp5by3 >=','1');
		$this -> db ->or_where('exp10by3 >=','1');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_paid_member_default_set()
	{
		$this -> db -> select('*');
   		$this -> db -> from('master_balance_sheet');
		$this -> db ->or_where('3by3_real >=','1');
		$this -> db ->or_where('5by3_real >=','1');
		$this -> db ->or_where('10by3_real >=','1');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function check_default_set_date($eid,$type)
	{
		$this -> db -> select('*');
   		$this -> db -> from('default_set_entry');
		$this -> db -> where('create_date',''.$eid.'');
		$this -> db -> where('type',''.$type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function row_delete()
  {

      $this->db->where('id', $id);
      $this->db->delete('testimonials'); 
  }
	
	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}	
  	
	function delete_pay_entry($time, $table)
	{
		$this->db->where('timestm <=',''.$time.'');
		$this->db->delete($table);
	}
  	
  	//Reverse Payment
  	function get_reverse_remain_wallet($uid,$type)
	{
		$this -> db -> select('*');
   		$this -> db -> from('tbl_free_reverse_wallet');
   		$this -> db -> where('usercode', ''.$uid.'');
		$query = $this -> db -> get();
    	$the_content = $query->row_array();
    	return $the_content['remain_'.$type];
	}
  	function check_reverse_payment_date($field, $type,$usercode)
	{
		$this -> db -> select('*');
   		$this -> db -> from('payment_reverse_daily_date_entry');
   		$this -> db -> where('pay_type', ''.$field.'');
		$this -> db -> where('pay_day', ''.date('d').'');
		$this -> db -> where('pay_month', ''.date('m').'');
		$this -> db -> where('pay_year', ''.date('Y').'');
		$this -> db -> where('type', ''.$type.'');
		$this -> db -> where('usercode', ''.$usercode.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_all_reverse_payment_free($field)
	{
		$this -> db -> select('*');
   		$this -> db -> from('tbl_free_reverse_wallet');
   		$this -> db -> where('remain_'.$field.' >', '0',FALSE);
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_reverse_upling_chain_free($eid, $field)
	{
		$this -> db  -> select('member_node_reverse_free.'.$field.' as lev1');
		$this -> db  -> select('tbl1.'.$field.' as lev2');
		$this -> db  -> select('tbl2.'.$field.' as lev3');
   		$this -> db  -> from('member_node_reverse_free');
		$this -> db  -> join('member_node_reverse_free tbl1','member_node_reverse_free.'.$field.' = tbl1.usercode','left');
		$this -> db  -> join('member_node_reverse_free tbl2','tbl1.'.$field.' = tbl2.usercode','left');
   		$this -> db  -> where('member_node_reverse_free.usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		
		$arr=array();
		$arr['lev1']=($the_content[0]['lev1']=='0' || $the_content[0]['lev1']=='')? "1" : $the_content[0]['lev1'];
		$arr['lev2']=($the_content[0]['lev2']=='0' || $the_content[0]['lev2']=='')? "1" : $the_content[0]['lev2'];
		$arr['lev3']=($the_content[0]['lev3']=='0' || $the_content[0]['lev3']=='')? "1" : $the_content[0]['lev3'];	
    	return $arr;
		
	}
	// P:aid
	  	function get_paid_reverse_remain_wallet($uid,$type)
	{
		$this -> db -> select('*');
   		$this -> db -> from('tbl_reverse_wallet');
   		$this -> db -> where('usercode', ''.$uid.'');
		$query = $this -> db -> get();
    	$the_content = $query->row_array();
    	return $the_content['remain_'.$type];
	}
  	function check_paid_reverse_payment_date($field, $type,$usercode)
	{
		$this -> db -> select('*');
   		$this -> db -> from('payment_paidreverse_daily_date_entry');
   		$this -> db -> where('pay_type', ''.$field.'');
		$this -> db -> where('pay_day', ''.date('d').'');
		$this -> db -> where('pay_month', ''.date('m').'');
		$this -> db -> where('pay_year', ''.date('Y').'');
		$this -> db -> where('type', ''.$type.'');
		$this -> db -> where('usercode', ''.$usercode.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_all_reverse_payment($field)
	{
		$this -> db -> select('*');
   		$this -> db -> from('tbl_reverse_wallet');
   		$this -> db -> where('remain_'.$field.' >', '0',FALSE);
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_reverse_upling_chain($eid, $field)
	{
		$this -> db  -> select('member_node_reverse.'.$field.' as lev1');
		$this -> db  -> select('tbl1.'.$field.' as lev2');
		$this -> db  -> select('tbl2.'.$field.' as lev3');
   		$this -> db  -> from('member_node_reverse');
		$this -> db  -> join('member_node_reverse tbl1','member_node_reverse.'.$field.' = tbl1.usercode','left');
		$this -> db  -> join('member_node_reverse tbl2','tbl1.'.$field.' = tbl2.usercode','left');
   		$this -> db  -> where('member_node_reverse.usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		
		$arr=array();
		$arr['lev1']=($the_content[0]['lev1']=='0' || $the_content[0]['lev1']=='')? "1" : $the_content[0]['lev1'];
		$arr['lev2']=($the_content[0]['lev2']=='0' || $the_content[0]['lev2']=='')? "1" : $the_content[0]['lev2'];
		$arr['lev3']=($the_content[0]['lev3']=='0' || $the_content[0]['lev3']=='')? "1" : $the_content[0]['lev3'];	
    	return $arr;
		
	}

}
?>
