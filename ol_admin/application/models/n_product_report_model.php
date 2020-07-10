<?php
Class n_product_report_model extends CI_Model
{
	
	
	function under_review()
	{
		$this -> db -> select('n_product_subscription.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name, membermaster.username',FALSE);
		$this -> db -> select('CONCAT(tbl2.fname," ",tbl2.lname) as refname',FALSE);
		$this -> db -> select('n_product_payment_false.id as payment_false',FALSE);
   		$this -> db -> from('n_product_subscription');
		$this -> db -> join('membermaster','n_product_subscription.usercode = membermaster.usercode','left');
		$this -> db -> join('membermaster tbl2','tbl2.usercode = membermaster.referralid_free','left');
		$this -> db -> join('n_product_payment_false','n_product_payment_false.usercode = membermaster.usercode','left');
		$this -> db -> where('n_product_subscription.usercode NOT IN (select usercode from pdl_member)');
		$this->db->group_by('n_product_subscription.usercode');	
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
 
	function get_payment_flase()
	{	
		$this -> db -> select('n_product_payment_false.*');
		$this -> db -> select('CONCAT(membermaster.fname, " ", SUBSTRING(membermaster.lname,1,1)) as name,membermaster.username',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = n_product_payment_false.usercode','left');
   		$this -> db -> from('n_product_payment_false');
		$this -> db -> order_by('n_product_payment_false.time_dt','DESC');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_payment_list()
	{
		$this -> db -> select('n_product_monthly_payment.*');
		$this -> db -> select('CONCAT(membermaster.fname, " ", SUBSTRING(membermaster.lname,1,1)) as name,membermaster.username',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = n_product_monthly_payment.usercode','left');
   		$this -> db -> from('n_product_monthly_payment');
		$this -> db -> order_by('n_product_monthly_payment.time_dt','DESC');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
}
?>
