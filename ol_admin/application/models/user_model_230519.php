<?php
Class user_model extends CI_Model
{

	function getAll_paid_leader_wallet()
	{
		$this -> db -> select('master_balance_sheet.*,membermaster.fname,membermaster.lname');
   		$this -> db -> from('master_balance_sheet');
        $this -> db ->join('membermaster', 'master_balance_sheet.usercode = membermaster.usercode');
   		$this -> db -> order_by("master_balance_sheet.main_balance", "desc");
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
 	
 
 	function get_record($eid){
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_ref_name($eid){
		$this -> db -> select('fname,lname,usercode');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function get_country(){
		$this -> db -> select('*');
   		$this -> db -> from('country_master');
   		$this -> db -> where('status !=', 'Delete');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function select_max(){
		$this -> db -> select('MAX(usercode) as maxu');
   		$this -> db -> from('membermaster');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function getAll()
 	{	
   		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('status !=', 'Delete');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
 	}
	function ref_active_member()
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('status','Active');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	function getAll_active()
 	{	
		
					
		$aColumns = array( 'usercode','fname', 'lname', 'emailid','mobileno','mobileno','mobileno','active_dt');
		
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
			$sWhere = "WHERE";
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
		
		
		
		if ( $sWhere == "" ){$sWhere = "WHERE status='Active'";} //AND usercode!='1'
		else{$sWhere .= " AND status='Active' ";} //AND usercode!='1'
		
			
		$sQuery = "Select * , 
		( select count(referralid) from    membermaster a where a.referralid = b.referralid) as tot
		From membermaster b
		$sWhere
		$sOrder
		$sLimit";
		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
		
 	}
	function get_tot_count_active(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
		$this -> db -> where('status','Active');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_tot_count_panding(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
		$this -> db -> where('status','Pending');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function getAll_panding(){
		
		$aColumns = array( 'usercode','fname', 'lname', 'emailid','mobileno','mobileno','mobileno','fname','add_time');
		
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
		
		$sWhere = "";
		if ( $_GET['sSearch'] != "" )
		{
			$sWhere = "WHERE";
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
		
		
		
		if ( $sWhere == "" ){$sWhere = "WHERE status='Pending'";} //AND usercode!='1'
		else{$sWhere .= " AND status='Pending'";} //AND usercode!='1'
			
		////////////

		$sQuery = "Select * , 
		( select count(referralid) from    membermaster a where a.referralid = b.referralid) as tot
		From membermaster b
		$sWhere
		$sOrder
		$sLimit";
		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_record_panding_member($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('status','Pending');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_payment_status($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('paid_request_master');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('status','Active');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
		
	function delete_member($id)
	{
		$this->db->where('usercode', $id);
		$this->db->delete('member_pending');
	}
	
	function get_usercode($eid=''){
		$this -> db -> select('*');
   		$this -> db -> from('member_node_master');
   		$this -> db -> where('uplingmember3_3', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_count_three($eid=''){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('member_node_master');
   		$this -> db -> where('uplingmember3_3', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	function get_usercode_five($eid=''){
		$this -> db -> select('*');
   		$this -> db -> from('member_node_master');
   		$this -> db -> where('uplingmember5_3', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_count_five($eid=''){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('member_node_master');
   		$this -> db -> where('uplingmember5_3', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_usercode_ten($eid=''){
		$this -> db -> select('*');
   		$this -> db -> from('member_node_master');
   		$this -> db -> where('uplingmember10_3', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_count_ten($eid=''){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('member_node_master');
   		$this -> db -> where('uplingmember10_3', ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_user_filter($eid){
		$this -> db -> 	select('fname,lname,usercode');
   		$this -> db -> 	from('membermaster');
		$this->db->where('(fname  LIKE "%'.$eid.'%" or lname  LIKE "%'.$eid.'%"  or usercode  LIKE "%'.$eid.'%")');
		$this -> db ->	order_by("fname", "asc");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_total_reffral($usercode){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('referralid', ''.$usercode.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_upling_member($eid, $field){
		$this -> db -> select(''.$field.' as upling');
   		$this -> db -> from('member_node_master');
   		$this -> db -> where('usercode', ''.$eid.'');
		$this -> db -> where($field.' !=', '0');
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
	
	function member_level_track_update($eid, $field, $field2)
	{
		if($eid!='' && isset($eid))
		{
			$this->db->set(''.$field.'', '`'.$field.'`+ 1', FALSE);
			$this->db->set(''.$field2.'', '`'.$field2.'`+ 1', FALSE);
			$this->db->where('usercode', $eid);
			$this->db->update('member_level_track_master');
		}
		
	}


	function email_verify($id)
	{
		//	$this->db->set('status','Active');
			$this->db->set('email_verification','Y');
			$this->db->where('usercode', $id);
			$this->db->update('membermaster');
		
	}
	

 	function get_system_level($usercode, $field){
		$this -> db -> select(''.$field.' as level');
   		$this -> db -> from('member_level_track_master');
   		$this -> db -> where('usercode', ''.$usercode.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	} 
	
	function get_capture_page_name($eid){
		$this -> db -> select('capture_page_master.page_name');
		$this -> db -> select('capture_page_record.pagelable');
   		$this -> db -> from('capture_page_master');
		$this -> db -> join('capture_page_record','capture_page_master.pagecode = capture_page_record.pagename','left');
   		$this -> db -> where('capture_page_master.capture_page_code',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	} 
	
	
	function get_usercode_by_tree($eid='',$type)
	{
		$this -> db -> select('*');
   		$this -> db -> from('member_node_master');
   		$this -> db -> where($type, ''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_count_by_tree($eid='',$type){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('member_node_master');
   		$this -> db -> where($type,''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
		
	function get_tot_count_inactive(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
		$this -> db -> where('status','Inactive');
		$this -> db -> where("due_time !=", '0');

    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	
	function getAll_inactive(){
		
		$aColumns = array( 'usercode','fname', 'lname', 'emailid','mobileno','mobileno','mobileno','fname','add_time');
		
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
		
		$sWhere = "";
		if ( $_GET['sSearch'] != "" )
		{
			$sWhere = "WHERE";
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
		
		
		
		if ( $sWhere == "" ){$sWhere = "WHERE status='Inactive' and due_time!=0";} //AND usercode!='1'
		else{$sWhere .= " AND status='Inactive' and due_time!=0";} //AND usercode!='1'
			
		////////////
		
		$sQuery = "Select * , 
		( select count(referralid) from    membermaster a where a.referralid = b.referralid) as tot
		From membermaster b
		$sWhere
		$sOrder
		$sLimit";
		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
	}

	function get_tot_count_paid() {
		$this -> db -> select('count(membermaster.usercode) as tot');
   		$this -> db -> from('membermaster');
		$this -> db -> join('paid_request_master','membermaster.usercode = paid_request_master.usercode','left');
		$this -> db -> where('paid_request_master.status','Active');
		$this -> db -> where('membermaster.status','Pending');
		$this -> db -> where('paid_request_master.payment','Y');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	function getAll_paid(){
		
		$aColumns = array( 'b.usercode','fname', 'lname', 'emailid','mobileno','mobileno','mobileno','fname','add_time');
		
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
		
		$sWhere = "";
		if ( $_GET['sSearch'] != "" )
		{
			$sWhere = "WHERE";
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
					$sWhere.='(b.usercode="'.$filter[0].'")';
				}
				else
				{
					
					$sWhere.='(fname  LIKE "%'.$filter[0].'%" or lname  LIKE "%'.$filter[0].'%")';
				}	
			}
		
			
		}
		
		
		
		if ( $sWhere == "" ){$sWhere = " where paid_request_master.status='Active' and
		b.status='Pending' and 
		paid_request_master.payment='Y' ";} //AND usercode!='1'

		else{$sWhere .= " AND paid_request_master.status='Active' and
		b.status='Pending' and 
		paid_request_master.payment='Y' ";} //AND usercode!='1'
			
		////////////

		$sQuery = "Select * , 
		( select count(referralid) from    membermaster a where a.referralid = b.referralid) as tot
		From membermaster b
		left join paid_request_master on b.usercode = paid_request_master.usercode
		$sWhere
		$sOrder
		$sLimit";
		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
	}
}
?>
