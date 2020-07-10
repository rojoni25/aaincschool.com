<?php
Class auto_payment_model extends CI_Model
{
 	function get_online_payment_record()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('online_payment');
		$this -> db -> where('paycode',''.$this->session->userdata['ses_pay']['idcode'].'');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_setting_by_lable($eid){
		$this -> db -> select('*');
   		$this -> db -> from('site_settings');
		$this -> db -> where('lable_acces_nm',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['setting_value'];
	}
	
 	function get_active_member()
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('status','Active');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member_by_code($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_active_member_by_usercode($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('status','Active');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function tree_upling($eid)
	{
		$this -> db -> select('uplingmember3_3 as ucode');
   		$this -> db -> from('member_node_master');
   		$this -> db -> where('usercode', ''.$eid.'');
		$this -> db -> where('uplingmember3_3 !=', '0');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_coded_residual($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('coded_residual');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function get_admin_email()
	{
		$this -> db -> select('emailid');
   		$this -> db -> from('admin_login');
		$this -> db -> where('usercode','1');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function master_balance_update($field, $usercode, $amount, $opration){

			if($opration=='plus'){
				$this->db->set(''.$field.'', '`'.$field.'`+ '.$amount.'', FALSE);
			}
			if($opration=='minus'){
				$this->db->set(''.$field.'', '`'.$field.'`- '.$amount.'', FALSE);
			}
			$this->db->where('usercode',''.$usercode.'');
			$this->db->update('master_balance_sheet');
	}
	
	function product_balance_update($field, $usercode, $amount, $opration){

		if($opration=='plus'){
			$this->db->set(''.$field.'', '`'.$field.'`+ '.$amount.'', FALSE);
		}
		if($opration=='minus'){
			$this->db->set(''.$field.'', '`'.$field.'`- '.$amount.'', FALSE);
		}
		$this->db->where('usercode',''.$usercode.'');
		$this->db->update('n_product_member');
	}

	function addItem($data,$table)
	{
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue)
	{
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	
	function get_due_member()
	{
		$timestam	=	strtotime('+1 days',time());
		$this -> db -> select('membermaster.*');
		$this -> db -> select('master_balance_sheet.main_balance');
   		$this -> db -> from('master_balance_sheet');
		$this -> db -> join('membermaster','membermaster.usercode = master_balance_sheet.usercode','left');
   		$this -> db -> where('master_balance_sheet.main_balance >=',''.CW_MIN.'');
		$this -> db -> where('membermaster.due_time <',''.$timestam.'');
		$this -> db -> where('membermaster.usercode !=','1');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function payment_from_pp(){
		$timestam	=	strtotime('+1 days',time());
		
		$sQuery='SELECT membermaster.usercode,master_balance_sheet.main_balance as cp,n_product_member.wallet_balance as pp,
		SUM(master_balance_sheet.main_balance + n_product_member.wallet_balance) as total 
		FROM (n_product_member) 
		LEFT JOIN membermaster ON membermaster.usercode = n_product_member.usercode 
		LEFT JOIN master_balance_sheet ON n_product_member.usercode = master_balance_sheet.usercode 
		WHERE membermaster.status = "Active" AND 
		membermaster.usercode !="1" AND 
		master_balance_sheet.main_balance <'.CW_MIN.' AND 
		membermaster.due_time < "'.$timestam.'"
		GROUP BY membermaster.usercode HAVING SUM(master_balance_sheet.main_balance + n_product_member.wallet_balance) > '.CW_MIN.'';
				
		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;		
	}
	
	function payment_from_pp_member($eid){
		$timestam	=	strtotime('+1 days',time());
		$sQuery='SELECT membermaster.usercode,membermaster.due_time,master_balance_sheet.main_balance as cp,n_product_member.wallet_balance as pp,
		SUM(master_balance_sheet.main_balance + n_product_member.wallet_balance) as total 
		FROM (n_product_member) 
		LEFT JOIN membermaster ON membermaster.usercode = n_product_member.usercode 
		LEFT JOIN master_balance_sheet ON n_product_member.usercode = master_balance_sheet.usercode 
		WHERE membermaster.status = "Active" AND 
		membermaster.usercode !="1" AND 
		master_balance_sheet.main_balance <'.CW_MIN.' AND 
		membermaster.due_time < "'.$timestam.'" AND
		n_product_member.usercode="'.$eid.'"
		GROUP BY membermaster.usercode HAVING SUM(master_balance_sheet.main_balance + n_product_member.wallet_balance) > '.CW_MIN.'';
				
		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;		
	}
	
	function get_due_member_by_usercode($usercode)
	{
		$timestam	=	strtotime('+1 days',time());
		$this -> db -> select('membermaster.*');
		$this -> db -> select('master_balance_sheet.main_balance');
   		$this -> db -> from('master_balance_sheet');
		$this -> db -> join('membermaster','membermaster.usercode = master_balance_sheet.usercode','left');
   		$this -> db -> where('master_balance_sheet.main_balance >=',''.CW_MIN.'');
		$this -> db -> where('membermaster.due_time <',''.$timestam.'');
		$this -> db -> where('membermaster.usercode !=','1');
		$this -> db -> where('membermaster.usercode',''.$usercode.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_renewal_request($eid){
		$this -> db -> select('*');
   		$this -> db -> from('request_to_renewal');
		$this -> db -> where('request_code',''.$eid.'');
		$this -> db -> where('request_status','Pending');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_current_balance($eid){
		$this -> db -> select('main_balance');
   		$this -> db -> from('master_balance_sheet');
		$this -> db -> where('usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['main_balance'];	
	}
	
	
	function pdl_due_member()
	{
		$timestam	=	strtotime('-2 days',time());
		$this -> db -> select('membermaster.*');
		$this -> db -> select('master_balance_sheet.main_balance');
   		$this -> db -> from('master_balance_sheet');
		$this -> db -> join('membermaster','membermaster.usercode = master_balance_sheet.usercode','left');
   		$this -> db -> where('membermaster.due_time <',''.$timestam.'');
		$this -> db -> where('membermaster.usercode !=','1');
		$this -> db -> where('master_balance_sheet.usercode IN (select usercode from pdl_member)');
		
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function pdl_total_amount($eid)
	{
		$this->db-> select('SUM(amount) as tot');
   		$this->db-> from('pdl_member_payment');
		$this->db -> where('usercode',''.$eid.'');
		$this->	db ->where('wallet_type','pdl_2');
		$query = $this-> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];
	}
	
	function pdl_total_withdrawal($eid)
	{
		$this-> db -> select('SUM(amount) as tot');
   		$this-> db -> from('pdl_withdrawal');
		$this-> db -> where('usercode',''.$eid.'');
		$this-> db -> where('wallet_type','pdl_2');
		$query = $this-> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];
	}
	
	
  	
  
	
}
?>
