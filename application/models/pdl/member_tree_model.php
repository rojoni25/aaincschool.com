<?php
Class member_tree_model extends CI_Model
{
	
 	
	
	function get_node_three_by_three_by_id($eid)
	{
		$this -> db -> select('membermaster.fname,membermaster.lname');
		$this -> db -> select('pdl_member.usercode,pdl_member.side');
   		$this -> db -> from('pdl_member');
		$this -> db -> join('membermaster','membermaster.usercode = pdl_member.usercode','left');
		$this -> db -> where('pdl_member.upling', ''.$eid.'');
		$this -> db -> order_by('pdl_member.side', 'asc');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function userdt_by_code($eid){
		$this -> db -> select('fname,lname');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_breadcrumb_level($eid)
	{
		$this -> db -> select('membermaster.fname,membermaster.lname');
		$this -> db -> select('pdl_member.*');
   		$this -> db -> from('pdl_member');
		$this -> db -> join('membermaster','membermaster.usercode = pdl_member.usercode','left');
		$this -> db -> where('pdl_member.usercode', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function member_paid_product_dt($eid){
		$this -> db -> select('membermaster.*');
   		$this -> db -> from('membermaster');
		$this -> db -> join('pdl_member','pdl_member.usercode = membermaster.usercode','left');
		$this -> db -> where('membermaster.usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function member_list()
 	{	
		
		$aColumns = array('membermaster.usercode','membermaster.fname','membermaster.username','pdl_member.join_date','pdl_member.due_time');
		
   		$sLimit = "";
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
		}
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
				{
					$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
				}
			}
		
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "";
			}
		}
		////////////
		$sWhere = "";
		if ( $_GET['sSearch'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		
		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
			{
				if ( $sWhere == "" )
				{
					$sWhere = "WHERE ";
				}
				else
				{
					$sWhere .= " AND ";
				}
					$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			}
		}
	
	
		$sQuery="SELECT membermaster.fname, membermaster.lname, membermaster.username,membermaster.status, 
			pdl_member.*,
			count(pdl_monthly_payment.usercode) as tot_pay
			FROM (pdl_member) 
			LEFT JOIN membermaster ON membermaster.usercode = pdl_member.usercode
			LEFT JOIN pdl_monthly_payment ON pdl_monthly_payment.usercode = pdl_member.usercode
			$sWhere
			GROUP BY pdl_member.usercode
			$sOrder
			$sLimit";
			
			$query = $this->db->query($sQuery);
			$the_content = $query->result_array();
			return $the_content;
		
 	}
	
	
	function member_count(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('pdl_member');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	

	 
	 //Member Serch//
	function search_member($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('(usercode="'.$eid.'" OR username="'.$eid.'")');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_payment_sum_by_type($eid)
	{
		$this -> db -> select('SUM(amount) as tot');
   		$this -> db -> from('pdl_member_payment');
		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];
	}
	
	function get_withdrawal_sum_by_type($eid)
	{
		$this -> db -> select('SUM(amount) as tot');
   		$this -> db -> from('pdl_withdrawal');
		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];
	}
	
	function subscription_under_review($eid){
		
		$this -> db -> select('pdl_subscription.*');
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name, membermaster.username',FALSE);
   		$this -> db -> from('pdl_subscription');
		$this -> db -> join('membermaster','pdl_subscription.usercode = membermaster.usercode','left');
		$this -> db -> where('pdl_subscription.usercode NOT IN (select usercode from pdl_member)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	
	function get_subscribe_member($eid)
	{
		$this -> db -> select('pdl_member.*');
		
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name, membermaster.username, membermaster.emailid, membermaster.mobileno, membermaster.phone_no',FALSE);
		
   		$this -> db -> from('pdl_member');
		
		$this -> db -> join('membermaster','pdl_member.usercode = membermaster.usercode','left');
		
		$this -> db -> where('pdl_member.usercode',''.$eid.'');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function get_all_subscribe($eid){
		
		$this -> db -> select('*');
		
   		$this -> db -> from('pdl_monthly_payment');
		
		$this -> db -> where('usercode',''.$eid.'');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
		return $the_content;
		
	}
	
	
	function get_payment_record($eid){
		
		$this -> db -> select('pdl_member_payment.*');
		
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name, membermaster.username, membermaster.emailid, membermaster.mobileno, membermaster.phone_no',FALSE);
		
   		$this -> db -> from('pdl_member_payment');
		
		$this -> db -> join('membermaster','pdl_member_payment.ref_code = membermaster.usercode','left');
		
		$this -> db -> where('pdl_member_payment.usercode',''.$eid.'');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
		return $the_content;
		
	}
	
	
	function get_all_withdrawal($eid){
		
		$this -> db -> select('*');
		
   		$this -> db -> from('pdl_withdrawal');
		
		$this -> db -> where('usercode',''.$eid.'');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
		return $the_content;
		
	}
	
	
	
	
	 
	 
	
	
	
	
	
}
?>
