<?php
Class withdrawal_request_model extends CI_Model
{
 	function getAll()
 	{	
   		$this -> db -> select('withdrawal_request_master.*');
		$this -> db -> select('membermaster.fname, membermaster.lname, membermaster.username, membermaster.paypal');
   		$this -> db -> from('withdrawal_request_master');
		$this -> db -> join('membermaster','withdrawal_request_master.usercode = membermaster.usercode','left');
   		$this -> db -> where('membermaster.status','Active');
		$this -> db -> where('withdrawal_request_master.status','pending');
		$this -> db -> order_by("withdrawal_request_master.request_code","desc");
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
 
 	function get_record($eid){
		
		$this -> db -> select('withdrawal_request_master.*');
		$this -> db -> select('membermaster.*');
   		$this -> db -> from('withdrawal_request_master');
		$this -> db -> join('membermaster','withdrawal_request_master.usercode = membermaster.usercode','left');
   		$this -> db -> where('membermaster.status','Active');
		$this -> db -> where('withdrawal_request_master.status','pending');
		$this -> db -> where("withdrawal_request_master.request_code","".$eid."");
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_master_balance_sheet($eid){
		$this -> db -> select("*");
   		$this -> db -> from('master_balance_sheet');
		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function sum_monthly_pay_by_type($eid,$type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_monthly');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('type',''.$type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function sum_daily_pay_by_type($eid,$pay_type)
	{
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_daily');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('pay_type',''.$pay_type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function sum_monthly_pay_by_usercode($eid){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_monthly');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('type NOT IN("3by3","5by3","10by3")');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function sum_daily_payment($eid){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_daily');
		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function sum_withdrawal_balance($eid,$wallet_type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('withdrawal_balance');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('wallet_type',''.$wallet_type.'');
		$this -> db -> where('type !=','5');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['total'];
	}
	
	function sum_refill($eid,$type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('refill_account');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('ac_type',''.$type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	}
	
	function sum_total_transfer($eid,$wallet_type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('withdrawal_balance');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('wallet_type',''.$wallet_type.'');
		$this -> db -> where('type','5');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	}
	
	
	function get_money_transfer_request(){
		
		$this -> db -> select('money_transfer_request.*');
		$this -> db -> select('membermaster.fname, membermaster.lname, membermaster.username');
		$this -> db -> select('master_balance_sheet.main_balance, master_balance_sheet.personal_wallet');
   		$this -> db -> from('money_transfer_request');
		$this -> db -> join('membermaster','money_transfer_request.usercode = membermaster.usercode','left');
		$this -> db -> join('master_balance_sheet','money_transfer_request.usercode = master_balance_sheet.usercode','left');
		$this -> db -> where('money_transfer_request.id NOT IN (select request_code from withdrawal_balance where type="5")');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	function get_money_transfer_request_by_id($eid){
		
		$this -> db -> select('money_transfer_request.*');
		$this -> db -> select('membermaster.fname, membermaster.lname, membermaster.username');
		$this -> db -> select('master_balance_sheet.main_balance, master_balance_sheet.personal_wallet');
   		$this -> db -> from('money_transfer_request');
		$this -> db -> join('membermaster','money_transfer_request.usercode = membermaster.usercode','left');
		$this -> db -> join('master_balance_sheet','money_transfer_request.usercode = master_balance_sheet.usercode','left');
		$this -> db -> where('money_transfer_request.id NOT IN (select request_code from withdrawal_balance where type="5")');
		$this -> db -> where('money_transfer_request.id',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	function master_balance_update($field, $amount, $opration,$usercode){

			if($opration=='plus'){
				$this->db->set(''.$field.'', '`'.$field.'`+ '.$amount.'', FALSE);
			}
			if($opration=='minus'){
				$this->db->set(''.$field.'', '`'.$field.'`- '.$amount.'', FALSE);
			}
			$this->db->where('usercode',''.$usercode.'');
			$this->db->update('master_balance_sheet');
	}
	
	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	function delete($table,$where){
		$this->db->where($where);
		$this->db->delete($table); 
	}
  	
  	function get_withdrawal_request_master($eid){
		$this -> db -> select("*");
   		$this -> db -> from('withdrawal_request_master');
		$this -> db -> where('request_code',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
  
	
}
?>
