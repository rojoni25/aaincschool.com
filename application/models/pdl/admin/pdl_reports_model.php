<?php
Class pdl_reports_model extends CI_Model
{
	
	
	
	
	function member_list($filter)
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
		
		$sWhere='';
	
		if($filter[0]!=''){
			$sWhere = "WHERE ";
			if(isset($filter[1])){
				$sWhere.='membermaster.fname="'.$filter[0].'" and membermaster.lname LIKE "%'.$filter[1].'%"';
			}
			else{
				if (ctype_digit($filter[0])){
					$sWhere.='membermaster.usercode="'.$filter[0].'"';
				}
				else{
					$sWhere.='(membermaster.fname LIKE "%'.$filter[0].'%" OR membermaster.lname LIKE "%'.$filter[0].'%")';
				}	
			}
		}
		
	
		$sQuery="SELECT membermaster.fname, membermaster.lname, membermaster.username,membermaster.status, 
				pdl_member.*
				FROM (pdl_member) 
				LEFT JOIN membermaster ON membermaster.usercode = pdl_member.usercode
			
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
	
	function get_downline_one_level($id)
	{
		if($id==''){
			return;
		}
		$this -> db -> select('CONCAT(user1.fname," ",SUBSTRING(user1.lname,1,1)) as name, user1.username',FALSE);
		$this -> db -> select('CONCAT(user2.fname," ",SUBSTRING(user2.lname,1,1)) as name2, user2.username as username2',FALSE);
		$this -> db -> select('pdl_member.*');
   		$this -> db -> from('pdl_member');
		$this -> db -> join('membermaster user1','user1.usercode = pdl_member.usercode','left');
		$this -> db -> join('membermaster user2','user2.usercode = pdl_member.upling','left');
		$this -> db -> where('pdl_member.upling IN('.$id.')');
		$this -> db -> order_by('pdl_member.id','asc');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function get_member_status($status)
	{
		
		$timestm=time();
		
		$this -> db -> select('CONCAT(membermaster.fname," ",SUBSTRING(membermaster.lname,1,1)) as name, membermaster.username',FALSE);
		$this -> db -> select('pdl_member.*');
   		$this -> db -> from('pdl_member');
		$this -> db -> join('membermaster','membermaster.usercode = pdl_member.usercode','left');
		
		if($status=='due'){
			$this -> db -> where('pdl_member.due_time <',''.$timestm.'');
		}
		
		if($status=='active'){
			$this -> db -> where('pdl_member.due_time >',''.$timestm.'');
		}
		
		$this -> db -> where('pdl_member.usercode !=',''.PDL_SYSTEM_USER.'');
		
		$this -> db -> order_by('pdl_member.id','asc');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	 

	

	
	
	
	
	
	
	
	
	

	
	
	
	
	 
	 
	
	
	
	
	
}
?>
