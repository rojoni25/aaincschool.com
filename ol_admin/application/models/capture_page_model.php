<?php
Class capture_page_model extends CI_Model
{
 	function getAll()
 	{	
   		$this -> db -> select('capture_page_master.*');
		$this -> db -> select('capture_page_record.pagelable');
   		$this -> db -> from('capture_page_master');
		$this -> db -> join('capture_page_record','capture_page_master.pagecode = capture_page_record.pagename','left');
   		$this -> db -> where('capture_page_master.status !=', 'Delete');
		$this -> db -> where('capture_page_master.usercode', '0');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function get_member_pages()
	{
		$this -> db -> select('capture_page_master.page_name,capture_page_master.headline_text,capture_page_master.capture_page_code');
		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.usercode');
   		$this -> db -> from('capture_page_master');
		$this -> db -> join('membermaster','membermaster.usercode = capture_page_master.usercode','left');
   		$this -> db -> where('capture_page_master.status !=', 'Delete');
		$this -> db -> where('capture_page_master.page_section','member_page');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_page_record($id){
		$this -> db -> select('capture_page_record.*');
   		$this -> db -> from('capture_page_record');
		$this -> db -> where('capture_page_record.status','Active');
		
		if($id!=''){
			$this -> db -> where('capture_page_record.pagename IN (select pagename from capture_filter_detail where capture_filter_code='.$id.')');
		}
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_page_type(){
		$this -> db -> select('*');
   		$this -> db -> from('capture_filter_type');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_mester_page_record_by_id($eid){
		$this -> db -> select('*');
   		$this -> db -> from('capture_page_record');
		$this -> db -> where('pagecode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function delete_capture_page_preview()
	{
		$this->db->where('usercode','0');
		$this->db->delete('capture_page_preview');
	}
	function get_mester_page_record_by_name($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('capture_page_record');
		$this -> db -> where('pagename',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member_by_id($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_member(){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 
 	function get_record($eid){
		$this -> db -> select('capture_page_master.*');
   		$this -> db -> from('capture_page_master');
   		$this -> db -> where('capture_page_master.capture_page_code', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_media_gallery($eid){
		$this -> db -> select('*');
   		$this -> db -> from('media_gallery');
		$this -> db -> where('gallerycode', ''.$eid.'');
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
	
	function table_fildld_name($tbl)
	{
		$result = $this->db->list_fields($tbl);
		foreach($result as $field)
		{
			$data[] = $field;
			
		}
		return $data;
	}
	

	
	function get_capture_page_request()
	{
		$this -> db -> select('capture_page_request.*');
   		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.usercode,membermaster.username');
   		$this -> db -> from('capture_page_request');
		$this -> db -> join('membermaster','membermaster.usercode = capture_page_request.usercode','left');
   		$this -> db -> where('capture_page_request.status','Active');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;		
	}
	
	function get_capture_page_request_done()
	{
		$this -> db -> select('capture_page_request.*');
   		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.usercode,membermaster.username');
   		$this -> db -> from('capture_page_request');
		$this -> db -> join('membermaster','membermaster.usercode = capture_page_request.usercode','left');
   		$this -> db -> where('capture_page_request.status','Done');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;		
	}
	
	function get_capture_page_request_delete()
	{
		$this -> db -> select('capture_page_request.*');
   		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.usercode,membermaster.username');
   		$this -> db -> from('capture_page_request');
		$this -> db -> join('membermaster','membermaster.usercode = capture_page_request.usercode','left');
   		$this -> db -> where('capture_page_request.status','Delete');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;		
	}
	
	function get_capture_page_request_by_id($id)
	{
		$this -> db -> select('capture_page_request.*');
   		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.usercode,membermaster.emailid,membermaster.email_verification,membermaster.subscribe');
		$this -> db -> select('capture_page_record.thum_img,capture_page_record.pagelable');
   		$this -> db -> from('capture_page_request');
		$this -> db -> join('membermaster','membermaster.usercode = capture_page_request.usercode','left');
		$this -> db -> join('capture_page_record','capture_page_record.pagename = capture_page_request.pagecode','left');
   		$this -> db -> where('capture_page_request.request_code',''.$id.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;		
	}
  	
  function email_to_member($id)
	{
		$this -> db -> select('capture_page_request.*');
   		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.usercode,membermaster.emailid,membermaster.email_verification,membermaster.subscribe');
   		$this -> db -> from('capture_page_request');
		$this -> db -> join('membermaster','membermaster.usercode = capture_page_request.usercode','left');
   		$this -> db -> where('capture_page_request.request_code',''.$id.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;		
	}
	function email_verification()
	{
   		//$this -> db -> select('capture_page_request.*');
   		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.usercode,membermaster.emailid,membermaster.email_verification,membermaster.subscribe');
   		$this -> db -> from('membermaster');
		//$this -> db -> join('membermaster','membermaster.usercode = capture_page_request.usercode','left');
   		//$this -> db -> where('capture_page_request.request_code',''.$id.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;			
	}
	
	function get_capture_report()
 	{	
		
		$aColumns = array( 'capture_page_master.capture_page_code','capture_page_master.page_name', 'membermaster.fname');
		
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

		if ( $sWhere == "" ){$sWhere = "WHERE capture_page_master.status != 'Delete' AND capture_page_master.usercode != '0'";}
		
		else{$sWhere .= " AND capture_page_master.status != 'Delete' AND capture_page_master.usercode != '0'";	}
		
		
	
		
		if(isset($_REQUEST['page_type']) && $_REQUEST['page_type']!=''){
			$sWhere .= " AND capture_page_master.pagecode = '".$_REQUEST['page_type']."'";
		}
		if(isset($_REQUEST['user_code']) && $_REQUEST['user_code']!=''){
			$sWhere .= " AND capture_page_master.usercode = '".$_REQUEST['user_code']."'";
		}
			
		$sQuery = "
		SELECT capture_page_master.*, capture_page_record.pagelable, membermaster.fname, membermaster.lname, membermaster.usercode FROM (capture_page_master) 
		LEFT JOIN capture_page_record ON capture_page_master.pagecode = capture_page_record.pagename 
		LEFT JOIN membermaster ON membermaster.usercode = capture_page_master.usercode

		$sWhere
		$sOrder
		$sLimit";
		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
		
 	}
		
	
	
	function get_tot_count_active(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('capture_page_master');
		$this -> db -> where('status','Active');
		if(isset($_REQUEST['page_type']) && $_REQUEST['page_type']!=''){
			$this -> db -> where('pagecode',''.$_REQUEST['page_type'].'');
		}
		if(isset($_REQUEST['user_code']) && $_REQUEST['user_code']!=''){
			$this -> db -> where('usercode',''.$_REQUEST['user_code'].'');	
		}
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function get_report_issue_pages()
	{
		$this -> db -> select('*');
   		$this -> db -> from('report_issue_master');
   		$this -> db -> where('status !=', 'Delete');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
}
?>
