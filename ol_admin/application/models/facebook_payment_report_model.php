<?php
Class facebook_payment_report_model extends CI_Model
{
 // 	function getAll()
	// {
	// 	$this -> db -> select('membermaster.*');
		
	// 	$this -> db -> select('affiliate_confirm_message.usercode, affiliate_confirm_message.referralid, affiliate_confirm_message.subject, affiliate_confirm_message.msg, affiliate_confirm_message.timedt,affiliate_confirm_message.type,affiliate_confirm_message.admin_verify');

 //   		$this -> db -> from('affiliate_confirm_message');

	// 	$this -> db -> join('membermaster','membermaster.usercode = affiliate_confirm_message.usercode','left');
	// 	$this -> db -> where('affiliate_confirm_message.admin_verify','Pending');
	// 	//$this -> db -> where('membermaster.status','Pending');
	// 	// $this -> db -> where('affiliate_confirm_message.referralid','membermaster.usercode');
		
	// 	$query = $this -> db -> get();
 //    	$the_content = $query->result_array();
 //    	return $the_content;
	// }
	function getAll()
	{
		$this -> db -> select('membermaster.*');

		$this -> db -> select('facebook_payment_stripe.usercode, facebook_payment_stripe.email, facebook_payment_stripe.currency, facebook_payment_stripe.amount , facebook_payment_stripe.card_exp_month,facebook_payment_stripe.card_exp_year,facebook_payment_stripe.name,facebook_payment_stripe.address,facebook_payment_stripe.country,facebook_payment_stripe.status');

		$this -> db -> from('facebook_payment_stripe');

		$this -> db -> join('membermaster','membermaster.usercode = facebook_payment_stripe.usercode','left');

		//$this -> db -> where('affiliate_confirm_message.admin_verify','Pending');

		$query = $this -> db -> get();
 		$the_content = $query->result_array();
     	return $the_content;
	}
	function get_member_by_code($usercode){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode',$usercode);
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	function get_status(){
		$this -> db -> select('admin_verify');
   		$this -> db -> from('facebook_payment_stripe');
		$this -> db -> where('admin_verify',"Pending");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0];
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
	
	
	function delete_request($id)
	{
		$this->db->where('usercode',$id);
		$this->db->delete('paid_request_master');
	}
	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$usercode,$referralid){
		$this->db->where('usercode', $usercode);
		$this->db->where('referralid', $referralid);
		$this->db->update($table, $data); 
	}

 	
  
	
}
?>
