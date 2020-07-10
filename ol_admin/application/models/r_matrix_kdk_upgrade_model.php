<?php
Class r_matrix_kdk_upgrade_model extends CI_Model
{
 	
 

	function kdk_request_upgrade()
 	{	
		
		$aColumns = array('rm_member_upgrade_pay.usercode','membermaster.fname', 'membermaster.lname', 'membermaster.emailid','membermaster.mobileno');
		
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
			$sWhere = "WHERE rm_member_upgrade_pay.usercode NOT IN (select usercode from member_node_master)";
		}
		else
		{
			$sWhere .= " AND rm_member_upgrade_pay.usercode NOT IN (select usercode from member_node_master)";
		}
			
			
		$sOrder=' ORDER BY rm_member_upgrade_pay.id ASC';
		
			
		$sQuery='SELECT CONCAT(membermaster.fname,"  ",membermaster.lname) as name, membermaster.username, membermaster.emailid, membermaster.mobileno,
				rm_member_upgrade_pay.*
				FROM (rm_member_upgrade_pay) 
				LEFT JOIN membermaster ON membermaster.usercode = rm_member_upgrade_pay.usercode
				'.$sWhere.' '.$sOrder.' '.$sLimit.' ';
			

		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
		
 	}
	
	
	
	function get_tot_pif_report(){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('rm_member_upgrade_pay');
		$this -> db -> where('rm_member_upgrade_pay.usercode NOT IN (select usercode from member_node_master)');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	

	function get_rm_admin_email(){
		$this -> db -> select('membermaster.emailid');
   		$this -> db -> from('rm_matrix_admin');
		$this -> db -> join('membermaster','membermaster.usercode = rm_matrix_admin.usercode','left');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		$arr=array();
		for($i=0;$i<count($the_content);$i++){
			$arr[]=$the_content[$i]['emailid'];
		}
    	return implode(', ',$arr);;
	}
	
	function get_member_record($eid)
	{
		$this -> db -> select('rm_member_upgrade_pay.*');
		$this -> db -> select('CONCAT(user1.fname," ",user1.lname) as name, user1.username,user1.emailid,user1.mobileno',FALSE);
		$this -> db -> select('CONCAT(user2.fname," ",user2.lname) as name2, user2.usercode as ref_code',FALSE);
		
		$this -> db -> join('membermaster user1','user1.usercode = rm_member_upgrade_pay.usercode','left');
		$this -> db -> join('membermaster user2','user2.usercode = user1.referralid_free','left');
		
   		$this -> db -> from('rm_member_upgrade_pay');
		//$this -> db -> where('rm_member_upgrade_pay.usercode NOT IN (select usercode from member_node_master)');
		$this -> db -> where('rm_member_upgrade_pay.id',''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}	
	
	
	function get_all_active_member(){
		
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name, membermaster.usercode',FALSE);
		$this -> db -> select('member_node_master.usernode_code',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = member_node_master.usercode','left');
		$this -> db -> where('member_node_master.usercode  IN (select usercode from membermaster)');
   		$this -> db -> from('member_node_master');
		$this -> db -> order_by('member_node_master.usercode','asc');
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
	
	function get_upling_member($eid, $field){
		$this -> db -> select(''.$field.' as upling');
   		$this -> db -> from('member_node_master');
   		$this -> db -> where('usercode', ''.$eid.'');
		$this -> db -> where($field.' !=', '0');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
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
	
	
	function get_system_level($usercode, $field){
		$this -> db -> select(''.$field.' as level');
   		$this -> db -> from('member_level_track_master');
   		$this -> db -> where('usercode', ''.$usercode.'');
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
	
	function get_tree_upling($eid,$field){
		
		$this -> db -> select('IFNULL(NULLIF(member_node_master.'.$field.',""), 1) as lev1',FALSE);   
		$this -> db -> select('IFNULL(NULLIF(t1.'.$field.',""), 1) as lev2',FALSE);
		$this -> db -> select('IFNULL(NULLIF(t2.'.$field.',""), 1) as lev3',FALSE);
   		$this -> db -> from('member_node_master');
		
		$this -> db -> join('member_node_master t1','t1.usercode = member_node_master.'.$field.'','left');
		$this -> db -> join('member_node_master t2','t2.usercode = t1.'.$field.'','left');
		
		
   		$this -> db -> where('member_node_master.usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		if(isset($the_content[0])){
			$arr=array($the_content[0]['lev1'],$the_content[0]['lev2'],$the_content[0]['lev3']);
    		return $arr;	
		}else{
			return false;
		}
		
	}
	
	function get_setting_value_by_lable($value)
	{
		$this -> db -> select('*');
   		$this -> db -> from('site_settings');
   		$this -> db -> where('lable_acces_nm', ''.$value.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0]['setting_value'];
	}
	
	function get_setting_value_all($value)
	{
		$this -> db -> select('*');
   		$this -> db -> from('site_settings');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_coded_residual($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('coded_residual');
   		$this -> db -> where('usercode', ''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	
	function master_balance_update($field, $usercode, $amount, $opration){
		
			if($opration=='plus'){
				$this->db->set(''.$field.'', '`'.$field.'`+ '.$amount.'', FALSE);
			}
			if($opration=='minus'){
				$this->db->set(''.$field.'', '`'.$field.'`- '.$amount.'', FALSE);
			}
			$this->db->where('usercode',''.$usercode.'');
			$this->db->update('master_balance_sheet');
	}
	
	function get_user_reffral($usercode){
		$this -> db -> select('referralid');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('usercode', ''.$usercode.'');
		$this -> db -> where('status', 'Active');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_total_reffral($usercode){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('referralid', ''.$usercode.'');
		$this -> db -> where('status', 'Active');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_coded_residual_entry($usercode){
		$this -> db -> select('usercode_by as ucode, level, type');
   		$this -> db -> from('coded_residual');
   		$this -> db -> where('usercode', ''.$usercode.'');
		$this -> db -> where('(type="coded" or type="residual")');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_coded_match_residual_match($usercode){
		$this -> db -> select('usercode_by as ucode, level, type');
   		$this -> db -> from('coded_residual');
   		$this -> db -> where('usercode', ''.$usercode.'');
		$this -> db -> where('(type="coded_match" or type="residual_match")');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	
	
	
	
	
	
}
?>
