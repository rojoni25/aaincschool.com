<?php
Class r_matrix_upgrade_pay_model extends CI_Model
{
 	
 
 	
 
 	function member_for_pif($eid){
		
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix.*');
		$this -> db -> select('CONCAT(membermaster.fname, " ", SUBSTRING(membermaster.lname,1,1)) as name',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix.usercode','left');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
   		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix.idcode',''.$eid.'');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix.usercode NOT IN (select usercode from '.MATRIX_TABLE_PRE.'member_upgrade_pay)');	
		$this -> db -> order_by(''.MATRIX_TABLE_PRE.'matrix.idcode', 'asc');
		$this -> db -> limit('1');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	

	function list_for_no_send()
 	{	
		
		$aColumns = array(''.MATRIX_TABLE_PRE.'matrix.idcode',''.MATRIX_TABLE_PRE.'matrix.usercode','membermaster.fname', 'membermaster.lname', 'membermaster.emailid','membermaster.mobileno');
		
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
		
		
			if ( $sWhere == "" )
			{
					$sWhere = "WHERE ".MATRIX_TABLE_PRE."matrix.usercode NOT IN (select usercode from ".MATRIX_TABLE_PRE."member_upgrade_pay)";
					$sWhere.= "AND ".MATRIX_TABLE_PRE."matrix.usercode NOT IN (select usercode from member_node_master)";
			}
			else
			{
					$sWhere .= " AND ".MATRIX_TABLE_PRE."matrix.usercode NOT IN (select usercode from ".MATRIX_TABLE_PRE."member_upgrade_pay)";
					$sWhere.= "AND ".MATRIX_TABLE_PRE."matrix.usercode NOT IN (select usercode from member_node_master)";
			}
			
			$sOrder=' ORDER BY '.MATRIX_TABLE_PRE.'matrix.idcode ASC';
		
			
			$sQuery='SELECT CONCAT(membermaster.fname,"  ", SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username, membermaster.emailid, membermaster.mobileno,
			'.MATRIX_TABLE_PRE.'matrix.* 
			FROM ('.MATRIX_TABLE_PRE.'matrix) 
			LEFT JOIN membermaster ON membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix.usercode
			'.$sWhere.'
			GROUP BY '.MATRIX_TABLE_PRE.'matrix.usercode '.$sOrder.'
			'.$sLimit.'
			';
			

		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
		
 	}
	
	
	function pif_report_get()
 	{	
		
		$aColumns = array(''.MATRIX_TABLE_PRE.'member_upgrade_pay.usercode','membermaster.fname', 'membermaster.lname', 'membermaster.emailid','membermaster.mobileno');
		
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
		
		
			
			
			$sOrder=' ORDER BY '.MATRIX_TABLE_PRE.'member_upgrade_pay.id ASC';
		
			
			$sQuery='SELECT CONCAT(membermaster.fname,"  ", SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username, membermaster.emailid, membermaster.mobileno,
					 '.MATRIX_TABLE_PRE.'member_upgrade_pay.*,
					 IFNULL(NULLIF(member_node_master.usernode_code,""), 0) as active_id
					
					 FROM ('.MATRIX_TABLE_PRE.'member_upgrade_pay) 
					 LEFT JOIN membermaster ON membermaster.usercode = '.MATRIX_TABLE_PRE.'member_upgrade_pay.usercode
					 LEFT JOIN member_node_master ON membermaster.usercode = member_node_master.usercode
					'.$sWhere.'
					'.$sOrder.'
					'.$sLimit.'
			';
			

		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
		
 	}
	
	
	
	function get_tot_pif_report(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_upgrade_pay');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_tot_count_no_send(){
		$this -> db -> select('count(DISTINCT usercode) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
		$this -> db -> where('usercode NOT IN (select usercode from '.MATRIX_TABLE_PRE.'member_upgrade_pay)');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix.usercode NOT IN (select usercode from member_node_master)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_admin_email(){
		$this -> db -> select('membermaster.emailid');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_admin');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix_admin.usercode','left');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		$arr=array();
		for($i=0;$i<count($the_content);$i++){
			$arr[]=$the_content[$i]['emailid'];
		}
    	return implode(', ',$arr);;
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
