<?php
Class user_payment_level_model extends CI_Model
{
 	
 
	function get_member_by_payment_level($id)
	{
		$sQuery = "SELECT membermaster.*, 
		count(*) as pay_level 
		FROM (payment_master) LEFT JOIN membermaster ON membermaster.usercode = payment_master.usercode
		GROUP BY payment_master.usercode 
		HAVING COUNT(payment_master.usercode)=".$id."";
		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
	}
	
}
?>
