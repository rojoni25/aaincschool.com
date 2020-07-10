<?php
Class report_model extends CI_Model
{
	function get_all_qualified()
 	{	
		
					
		$aColumns = array( 'usercode','fname', 'mobileno', 'emailid','mobileno','add_time');
		
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
			$sWhere = "AND";
			$filter = 	preg_replace('/\s\s+/', ' ',$_GET['sSearch']);
			$filter	=	explode(" ",$filter);
			
			
			if(isset($filter[1]))
			{
				$sWhere.='(fname="'.$filter[0].'" and lname  LIKE "%'.$filter[1].'%")';
			}
			else
			{
				if (ctype_digit($filter[0]))
				{
					$sWhere.='(usercode="'.$filter[0].'")';
				}
				else
				{
					
					$sWhere.='(fname  LIKE "%'.$filter[0].'%" or lname  LIKE "%'.$filter[0].'%")';
				}	
			}
		
			
		}
		
		
		
		if ( $sWhere == "" ){$sWhere = "";} //AND usercode!='1'
		else{$sWhere .= " AND status='Active' ";} //AND usercode!='1'
		
			
		$sQuery = "SELECT * FROM `membermaster` M WHERE (SELECT COUNT(referralid) as cnt FROM membermaster WHERE referralid=M.usercode AND status='Active') >= 3 
		$sWhere
		$sOrder
		$sLimit";
		//echo $sQuery;
		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
		
 	}
	function get_tot_count_qualified(){
		$sQuery = "SELECT count(*) as tot FROM `membermaster` M WHERE (SELECT COUNT(referralid) as cnt FROM membermaster WHERE referralid=M.usercode AND status='Active')>=3";
		$query = $this->db->query($sQuery);
    	$the_content = $query->result_array();
    	return $the_content;
	}

	//
	function get_all_unqualified_member()
 	{	
		
					
		$aColumns = array( 'usercode','fname', 'mobileno', 'emailid','mobileno','add_time');
		
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
			$sWhere = "AND";
			$filter = 	preg_replace('/\s\s+/', ' ',$_GET['sSearch']);
			$filter	=	explode(" ",$filter);
			
			
			if(isset($filter[1]))
			{
				$sWhere.='(fname="'.$filter[0].'" and lname  LIKE "%'.$filter[1].'%")';
			}
			else
			{
				if (ctype_digit($filter[0]))
				{
					$sWhere.='(usercode="'.$filter[0].'")';
				}
				else
				{
					
					$sWhere.='(fname  LIKE "%'.$filter[0].'%" or lname  LIKE "%'.$filter[0].'%")';
				}	
			}
		
			
		}
		
		
		
		if ( $sWhere == "" ){$sWhere = "";} //AND usercode!='1'
		else{$sWhere .= " AND status='Active' ";} //AND usercode!='1'
		
			
		$sQuery = "SELECT * FROM `membermaster` M WHERE (SELECT COUNT(referralid) as cnt FROM membermaster WHERE referralid=M.usercode AND status='Active') < 3 
		$sWhere
		$sOrder
		$sLimit";
		//echo $sQuery;
		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
		
 	}
	function get_tot_count_unqualified_member(){
		$sQuery = "SELECT count(*) as tot FROM `membermaster` M WHERE (SELECT COUNT(referralid) as cnt FROM membermaster WHERE referralid=M.usercode AND status='Active')<3";
		$query = $this->db->query($sQuery);
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function smartwtrasfer_all_record(){
		$sQuery = "SELECT * FROM `membermaster` M inner join tbl_remain_smart_transfer T on M.usercode=T.userid";
		$query = $this->db->query($sQuery);
    	$the_content = $query->result_array();
    	return $the_content;
	}
}
?>
