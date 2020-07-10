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

	function get_upgrade_level($usercode){
		$this->db->select('current_level');
   		$this->db->from('membermaster');
   		$this->db->where('usercode',$usercode);
    	$query = $this->db->get();
    	$udata = $query->row_array();
    	$currentlevel = $udata['current_level'];
    	$nextlevel = $currentlevel + 1;

		$this->db->select('*');
   		$this->db->from('tbl_level');
   		$this->db->where('level_code',$nextlevel);
    	$query = $this->db->get();
    	$ldata = $query->row_array();
    	return $ldata;
	}

	function get_userdata($usercode){
		$this->db->select('*');
   		$this->db->from('membermaster');
   		$this->db->where('usercode',$usercode);
    	$query = $this->db->get();
    	$udata = $query->row_array();
    	return $udata;
    }
    function get_twoleveluplineid($usercode){
    	$twolevelupline = 0;
		$this -> db -> select('uplingmember3_3 as upling');
   		$this -> db -> from('member_node_master');
   		$this -> db -> where('usercode', ''.$usercode.'');
		$this -> db -> where('uplingmember3_3 !=', '0');
		$query = $this -> db -> get();
    	$the_content = $query->row_array();
    	$upline =  $the_content['upling'];
    	if($upline>0){
    		$this -> db -> select('uplingmember3_3 as upling');
	   		$this -> db -> from('member_node_master');
	   		$this -> db -> where('usercode', ''.$upline.'');
			$this -> db -> where('uplingmember3_3 !=', '0');
			$query = $this -> db -> get();
	    	$the_content = $query->row_array();
	    	$twolevelupline =  $the_content['upling'];
	    	if($twolevelupline>0){}else{$twolevelupline=0;}
    	}

    	return $twolevelupline;
    }

    function gethiddenwalletamount($usercode){
	    $ci=& get_instance();
	    $ci->load->database();
	    $query = $ci->db->query("SELECT SUM(amount) as total FROM `tbl_hidden_wallet` WHERE receiverid=
	".$usercode);
	    $row = $query->row_array();
	    if($row['total']>0)
	      return $row['total'];
	    else
	      return 0;
	}

	function getcompanylevelwallet($level){
	    $ci=& get_instance();
	    $ci->load->database();
	    $query = $ci->db->query("SELECT SUM(amount) as total FROM `tbl_hidden_wallet` WHERE receiverid=0 and plan=".$level);
	    $row = $query->row_array();
	    if($row['total']>0)
	      return $row['total'];
	    else
	      return 0;
	}
	function getmemberlevelwallet($usercode,$level){
	    $ci=& get_instance();
	    $ci->load->database();
	    $query = $ci->db->query("SELECT SUM(amount) as total FROM `tbl_hidden_wallet` WHERE receiverid=".$usercode." and plan=".$level);
	    $row = $query->row_array();
	    if($row['total']>0)
	      return $row['total'];
	    else
	      return 0;
	}
	function getmemberreferalwallet($usercode){
	    $ci=& get_instance();
	    $ci->load->database();
	    $query = $ci->db->query("SELECT SUM(amount) as total FROM `tbl_visible_wallet` WHERE receiverid=
	".$usercode);
	    $row = $query->row_array();
	    if($row['total']>0)
	      return $row['total'];
	    else
	      return 0;
	} 
	//free

	function getfreememberlevelwallet($usercode,$level){
	    $ci=& get_instance();
	    $ci->load->database();
	    $query = $ci->db->query("SELECT SUM(amount) as total FROM `tbl_free_hidden_wallet` WHERE receiverid=".$usercode." and plan=".$level);
	    $row = $query->row_array();
	   if($row['total']>0)
	      return $row['total'];
	    else
	      return 0;
	}
	function getfreememberreferalwallet($usercode){
	    $ci=& get_instance();
	    $ci->load->database();
	    $query = $ci->db->query("SELECT SUM(amount) as total FROM `tbl_free_visible_wallet` WHERE receiverid=
	".$usercode);
	    $row = $query->row_array();
	   if($row['total']>0)
	      return $row['total'];
	    else
	      return 0;
	} 
	function getcompanyfreelevelwallet($level){
	    $ci=& get_instance();
	    $ci->load->database();
	    $query = $ci->db->query("SELECT SUM(amount) as total FROM `tbl_free_hidden_wallet` WHERE receiverid=0 and plan=".$level);
	    $row = $query->row_array();
	    if($row['total']>0)
	      return $row['total'];
	    else
	      return 0;
	}

	function getfreememberbonuswallet($usercode,$type){
	    $ci=& get_instance();
	    $ci->load->database();
	    //echo '44';
	    $query = $ci->db->query("SELECT SUM(amount) as total FROM `tbl_free_bonus_wallet` WHERE receiverid=".$usercode." and type='".$type."'");
	    $row = $query->row_array();
	   // print_r($row);
	   if($row['total']>0)	
	      return $row['total'];
	    else
	      return 0;
	}

	function getpaidmemberbonuswallet($usercode,$type){
	    $ci=& get_instance();
	    $ci->load->database();
	    //echo '44';
	    $query = $ci->db->query("SELECT SUM(amount) as total FROM `tbl_bonus_wallet` WHERE receiverid=".$usercode." and type='".$type."'");
	    $row = $query->row_array();
	   // print_r($row);
	   if($row['total']>0)	
	      return $row['total'];
	    else
	      return 0;
	}
 	function get_usercode_by_reverse_tree($eid='',$type)
	{
		$this -> db -> select('*');
   		$this -> db -> from('member_node_reverse');
   		$this -> db -> where($type, ''.$eid.'');
   		$this -> db -> order_by('usercode', 'desc');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_count_by_reverse_tree($eid='',$type){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('member_node_reverse');
   		$this -> db -> where($type,''.$eid.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function get_reverse_tree_by_usercode($eid){
		$this -> db -> select('*');
   		$this -> db -> from('member_node_reverse');
   		$this -> db -> where('usercode',$eid);
    	$query = $this -> db -> get();
    	$the_content = $query->row_array();
    	return $the_content;
	}
	function get_setting_value_by_lable($value){
		$this -> db -> select('setting_value');
   		$this -> db -> from('site_settings');
   		$this -> db -> where('lable_acces_nm', ''.$value.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}

	function getremainwallettosmartamt($usercode,$wallet){
		 $ci=& get_instance();
	    $ci->load->database();
	    $query = $ci->db->query("SELECT SUM(amount) as total FROM `tbl_remain_smart_transfer` WHERE userid=".$usercode." and wallet=".$wallet);
	    $row = $query->row_array();
	    if($row['total']>0)
	      return $row['total'];
	    else
	      return 0;
	}
	function is_paid($member_id)
	{
		$this -> db -> select('*');
   		$this -> db -> from('paid_request_master');
		$this -> db -> where('usercode', ''.$member_id.'');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
		if(isset($the_content[0]['payment']) && $the_content[0]['payment']=="Y"){
			return true;
		}else{
			return false;
		}
	}
	function count_paid_members($memberid)
	{
		$this -> db -> select('count(membermaster.usercode) as total');
   		$this -> db -> from('membermaster');
		$this -> db -> join('paid_request_master','membermaster.usercode = paid_request_master.usercode','left');
		$this -> db -> where('paid_request_master.status','Active');
		$this -> db -> where('membermaster.referralid',$memberid);
		$this -> db -> where('paid_request_master.confirm','Y');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
	return $the_content[0]["total"];
	}
	///==================================================Reverse Wallet ==================================
	  	function get_paid_reverse_wallet($uid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('tbl_reverse_wallet');
   		$this -> db -> where('usercode', ''.$uid.'');
		$query = $this -> db -> get();
    	$the_content = $query->row_array();
    	return $the_content;
    
	}
	  function get_free_reverse_wallet($uid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('tbl_free_reverse_wallet');
   		$this -> db -> where('usercode', ''.$uid.'');
		$query = $this -> db -> get();
    	$the_content = $query->row_array();
    	return $the_content;
    
	}
	
		//to add amount in reverse wallet for existing user
// function addItemToReverseWallet($userCode){
//       $ci=& get_instance();
// 	   $ci->load->database();
// 	   $query = $ci->db->query("INSERT INTO `tbl_free_reverse_wallet`( `amt_5_3`, `amt_10_3`, `remain_5_3`, `remain_10_3`, `usercode`) VALUES (50,50,50,50,".$userCode.")");

// }

//====================================== Capture Pages Subscribers =======================================
function get_cp_members($status){
		
		$aColumns = array( 'usercode','fname', 'lname', 'emailid','mobileno','referralid','subscription_id','subscription_status');
		
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
		
		
		
		if ( $sWhere == "" ){$sWhere = " where subscription_status='".$status."'";} //AND usercode!='1'

		else{$sWhere .= " AND subscription_status='".$status."'  ";} //AND usercode!='1'
			
		////////////

		$sQuery = "Select * , 
		( select count(usercode) from membermaster  where subscription_status ='".$status."') as tot
		From membermaster 
		$sWhere
		$sOrder
		$sLimit";
		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
	}
	//Get total number subscribers for capture page  
		function get_tot_cp_members($status){
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('membermaster');
		$this -> db -> where('subscription_status',$status);
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	function update_cp_members_status($usercode,$status){
	    	$this->db->set('subscription_status',$status);
			$this->db->where('usercode', $usercode);
			$this->db->update('membermaster');
	}
	//=================================================Capture page Wallet====================================================
		  	function get_capture_page_wallet($uid)
	{
		$this -> db -> select('sum(amount) as amount');
   		$this -> db -> from('tbl_capture_page_wallet');
   		$this -> db -> where('receiver_id', ''.$uid.'');
		$query = $this -> db -> get();
    	$the_content = $query->row_array();
    	return $the_content;
    
	}

}
?>
