<?php
Class email_send_model extends CI_Model
{
 	function getAll()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('status !=', 'Delete');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	function getAll_panding(){
		$aColumns = array( 'fname', 'lname', 'emailid','usercode');
		
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
		$sQuery = "
		SELECT * FROM  	membermaster
		$sWhere
		$sOrder
		$sLimit";
		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
	}
	function get_count_member(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
		$this -> db -> where('status !=','Delete');
		$this -> db -> where('subscribe','Y');
		$this -> db -> where('email_verification','Y');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member_by_code($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_tot_ref($eid,$ref_type){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
		$this -> db -> where($ref_type, ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 	
 	function get_record($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('country_master');
   		$this -> db -> where('country_code', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
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
