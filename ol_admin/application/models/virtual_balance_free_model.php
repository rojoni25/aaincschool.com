<?php
Class virtual_balance_free_model extends CI_Model
{
 	function getAll($eid,$balance)
 	{	
   		$aColumns = array( 'membermaster.fname', 'membermaster.lname', 'membermaster.emailid','membermaster.mobileno','membermaster.usercode');
		
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
		////////////
			if ( $sWhere == "" ){$sWhere = "WHERE master_balance_sheet_free.".$eid." >= '".$balance."' AND  membermaster.usercode!='1'";}
			else{$sWhere .= " AND master_balance_sheet_free.".$eid." >= '".$balance."' AND  membermaster.usercode!='1'";	}
			// membermaster.status = 'Active' AND
		$sQuery = "
				SELECT membermaster.*, master_balance_sheet_free.".$eid." as balance FROM (membermaster) 
				LEFT JOIN master_balance_sheet_free ON master_balance_sheet_free.usercode = membermaster.usercode 
				$sWhere
				$sOrder
				$sLimit";
				$query = $this->db->query($sQuery);
				$the_content = $query->result_array();
    			return $the_content;
 	}
	
	
	function get_inning_payment($eid,$type){
		
		$this -> db -> select('payment_monthly.*');
		$this -> db -> select('membermaster.fname, membermaster.lname');
   		$this -> db -> from('payment_monthly');
		$this -> db -> join('membermaster','payment_monthly.ref_code = membermaster.usercode','left');
   		$this -> db -> where('payment_monthly.usercode',''.$eid.'');
		$this -> db -> where('payment_monthly.type',''.$type.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	
	
	function get_daily_payment($eid,$type){
		$this -> db -> select('*');
   		$this -> db -> from('master_withdrawal_sheet');
   		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('balance_type',''.$type.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	function get_inning_payment_sum($eid,$type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('payment_monthly');
   		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('type',''.$type.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
		
	} 
	
	function get_daily_payment_sum($eid,$type){
		$this -> db -> select("IFNULL(SUM(amount),0) as total",false);
   		$this -> db -> from('master_withdrawal_sheet');
   		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('balance_type',''.$type.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return (float)$the_content[0]['total'];
	} 
	
	function get_tot_count_active($eid,$balance){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('master_balance_sheet_free');
		$this -> db -> where(''.$eid.' >=',$balance);
		$this -> db -> where('usercode !=','1');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member_detail($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('status','Active');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function tree_upling($eid, $field)
	{
		$this -> db -> select('member_node_master_free.'.$field.' as upling');
   		$this -> db -> from('member_node_master_free');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content=($the_content[0]['upling']=='0') ? false : $the_content[0]['upling'];
	}
	
	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
  	
  
	
}
?>
