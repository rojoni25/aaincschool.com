<?php
Class upgrade_request_model extends CI_Model
{
 	/*function getAll($eid)
	{
		$this -> db -> select('membermaster.*');
		// $this -> db -> select('paid_request_master.payment, paid_request_master.st_view, paid_request_master.payment_dt, paid_request_master.payment_dt, paid_request_master.timedt');
		$this -> db -> select('payment_gateway_stripe.paydate, payment_gateway_stripe.email, payment_gateway_stripe.card_exp_month, payment_gateway_stripe.card_exp_year, payment_gateway_stripe.status,payment_gateway_stripe.type');
   		$this -> db -> from('payment_gateway_stripe');
		$this -> db -> join('membermaster','membermaster.usercode = payment_gateway_stripe.usercode','left');
		
		$this->db->join('affiliate_confirm_message','affiliate_confirm_message.usercode = payment_gateway_stripe.usercode','left');

		$this->db->where('affiliate_confirm_message.type','Done');

		$this -> db -> where('payment_gateway_stripe.status','confirm');
		$this -> db -> where('membermaster.status','Pending');
		if($eid=='paid')
		{
			$this -> db -> where('payment_gateway_stripe.payment','Y');
		}
		if($eid=='unpaid')
		{
			$this -> db -> where('payment_gateway_stripe.payment','N');
		}
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}*/
	function getAll($eid)
	{
		$this -> db -> select('membermaster.*');
		$this -> db -> select('paid_request_master.payment, paid_request_master.st_view, paid_request_master.payment_dt, paid_request_master.payment_dt, paid_request_master.timedt');
   		$this -> db -> from('paid_request_master');
		$this -> db -> join('membermaster','membermaster.usercode = paid_request_master.usercode','left');
		$this -> db -> where('paid_request_master.status','Active');
		$this -> db -> where('membermaster.status','Pending');
		if($eid=='paid')
		{
			$this -> db -> where('paid_request_master.payment','Y');
		}
		if($eid=='unpaid')
		{
			$this -> db -> where('paid_request_master.payment','N');
		}
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_member_by_code($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	// function check_request($eid)
	// {
	// 	$this -> db -> select('membermaster.fname, membermaster.lname');
	// 	$this -> db -> select('paid_request_master.*');
 //   		$this -> db -> from('paid_request_master');
	// 	$this -> db -> join('membermaster','membermaster.usercode = paid_request_master.usercode','left');
	// 	$this -> db -> where('paid_request_master.status','Active');
	// 	$this -> db -> where('paid_request_master.payment','Y');
	// 	$this -> db -> where('membermaster.status','Pending');
	// 	$this -> db -> where('paid_request_master.usercode',''.$eid.'');
	// 	$query = $this -> db -> get();
 //    	$the_content = $query->result_array();
 //    	return $the_content;
	// }
	
	function check_request($eid)
	{
		$this -> db -> select('membermaster.fname, membermaster.lname');
		$this -> db -> select('paid_request_master.*');
   		$this -> db -> from('paid_request_master');
		$this -> db -> join('membermaster','membermaster.usercode = paid_request_master.usercode','left');
		$this -> db -> where('paid_request_master.status','Active');
		$this -> db -> where('paid_request_master.payment','Y');
		$this -> db -> where('membermaster.status','Pending');
		$this -> db -> where('paid_request_master.usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function delete_request($id)
	{
		$this->db->where('usercode',$id);
		$this->db->delete('paid_request_master');
	}
	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
 
 	function AffilatePayment()
 	{
 		$this->db->select('*');
 		$this->db->from('membermaster');
 		$this->db->where('usercode',''.$eid.'');
 		$query = $this->db->get();
 		$the_content = $query->result_array();
 		return $the_content;
 	}
  	
  
	
}
?>
