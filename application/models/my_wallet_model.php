<?php
Class my_wallet_model extends CI_Model
{
 	function get_balance()
	{
		$this -> db -> select('*');
   		$this -> db -> from('master_balance_sheet');
   		$this -> db -> where('usercode', ''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
 
	
}
?>
