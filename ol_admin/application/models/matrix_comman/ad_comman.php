<?php
Class ad_comman extends CI_Model
{
	function get_diamond_report($eid)
	{	
		$this -> db -> select(''.MATRIX_TABLE_PRE.'diamond.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'diamond.usercode');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'diamond');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'diamond.status',''.$eid.'');
		$this -> db -> order_by(''.MATRIX_TABLE_PRE.'diamond.id','DESC');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function count_diamond_payment($eid)
	{
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'diamond');
		$this -> db -> where('status',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];	
	}
	
	
		
}
?>
