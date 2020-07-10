<?php
Class ad_dashboard_model extends CI_Model
{


	function getAll_active()
 	{	
		
		$aColumns = array('kdk1_matrix.idcode','kdk1_matrix.usercode','user1.fname', 'user1.lname', 'user1.emailid','user1.mobileno');
		
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
		
		
		$sQuery='SELECT CONCAT(user1.fname, " ", SUBSTRING(user1.lname,1,1)) as name, user1.username, user1.password, user1.emailid, user1.mobileno, user1.phone_no, user1.status,kdk1_matrix.* ,count(kdk1_matrix.usercode) as tot_pos
		FROM (kdk1_matrix) 
		LEFT JOIN membermaster user1 ON user1.usercode = kdk1_matrix.usercode 
		'.$sWhere.'
		GROUP BY kdk1_matrix.usercode '.$sOrder.'
		'.$sLimit.'';	

		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
		
 	}
	function get_tot_count_active(){
		$this -> db -> select('count(DISTINCT usercode) as tot');
   		$this -> db -> from('kdk1_matrix');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	} 
	
	function get_join_request()
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix_request.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_request');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix_request.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.status !=','C');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.req_type','Request');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.usercode NOT IN (select usercode from '.MATRIX_TABLE_PRE.'matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function check_request($eid)
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix_request.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_request');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix_request.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.status !=','C');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.request_code NOT IN (select request_code from '.MATRIX_TABLE_PRE.'matrix)');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.request_code',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function check_access_code($eid){
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code');
   		$this -> db -> where('access_code',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	//Get Product member record by usercode//
	function member_dt($eid){
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code');
		$this -> db -> where('usercode',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
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
	
	
	function get_access_code_by_usercode($eid){
		$this -> db -> select("membermaster.*", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'access_code.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'access_code.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'access_code.id',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function getcode_list(){
		
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'access_code.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'access_code.usercode','left');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	
	function count_member()
	{	
		$this -> db -> select('count(DISTINCT usercode) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function get_position($usercode)
	{
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
		$this -> db -> where('usercode',''.$usercode.'');
		$this -> db -> order_by('idcode','ASC');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_total_position()
	{
		$this -> db -> select("COUNT(*) as tot");
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function count_join_request()
	{	
		$this -> db -> select("COUNT(*) as tot");
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_request');
		$this -> db -> where('usercode NOT IN (select usercode from '.MATRIX_TABLE_PRE.'matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function count_code_request()
	{	
		$this -> db -> select("COUNT(*) as tot");
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'access_code_request');
		$this -> db -> where('usercode NOT IN (select usercode from '.MATRIX_TABLE_PRE.'access_code)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function count_unread_msg()
	{	
		$this -> db -> select("COUNT(*) as tot");
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'message');
		$this -> db -> where('send_to','-1');
		$this -> db -> where('read_status','0');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function count_extra_position()
	{	
		
		$this -> db -> select("COUNT(*) as tot");
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_request');
		$this -> db -> where('status !=','C');
		$this -> db -> where('req_type','Multi');
		$this -> db -> where('request_code NOT IN (select request_code from '.MATRIX_TABLE_PRE.'matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];
	}
	
	function get_request_list_extra()
	{
		$this -> db -> select("CONCAT(membermaster.fname,' ',SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username", FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix_request.*'); 
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_request');
		$this -> db -> join('membermaster','membermaster.usercode = '.MATRIX_TABLE_PRE.'matrix_request.usercode','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.status !=','C');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.req_type','Multi');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix_request.request_code NOT IN (select request_code from '.MATRIX_TABLE_PRE.'matrix)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function count_withdrawal_request()
	{
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'withdrawal_request');
		$this -> db -> where('status !=','C');
		$this -> db -> where('req_id NOT IN (SELECT request_code from '.MATRIX_TABLE_PRE.'member_account)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['tot'];	
	}
	
	function get_request_by_id($eid){
		
		$this -> db -> select("*");
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix_request');
		$this -> db -> where('request_code',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0];
	}
	
	function addItem($data,$table)
	{
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue)
	{
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
	 
}
?>
