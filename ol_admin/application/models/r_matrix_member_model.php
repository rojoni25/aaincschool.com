<?php
Class r_matrix_member_model extends CI_Model
{
 	
 
 	function member_detail($eid){
		$this -> db -> select('rm_matrix.*');
		$this -> db -> select('CONCAT(membermaster.fname, " ", SUBSTRING(membermaster.lname,1,1)) as name, membermaster.emailid, membermaster.usercode, membermaster.phone_no, membermaster.status',FALSE);
		$this -> db -> join('membermaster','membermaster.usercode = rm_matrix.usercode','left');
   		$this -> db -> from('rm_matrix');
   		$this -> db -> where('rm_matrix.usercode',''.$eid.'');
		$this -> db -> order_by('rm_matrix.idcode', 'asc');
		$this -> db -> limit('1');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_position_dt($eid){
		$sQuery="SELECT t2.idcode AS lev1, t3.idcode  AS lev2,
				t4.idcode  AS lev3
				FROM rm_matrix AS t1
				LEFT JOIN rm_matrix AS t2 ON t2.upling_id = t1.idcode
				LEFT JOIN rm_matrix AS t3 ON t3.upling_id = t2.idcode
				LEFT JOIN rm_matrix AS t4 ON t4.upling_id = t3.idcode
				WHERE t1.idcode = '".$eid."'";
				
				$query = $this->db->query($sQuery);
				$pos = $query->result_array();
    		
			$lev1=array();
			$lev2=array();
			$lev3=array();
			for($i=0;$i<count($pos);$i++){
			
				if (!in_array($pos[$i]['lev1'], $lev1) && $pos[$i]['lev1']!="") 
				{
    				$lev1[]=$pos[$i]['lev1'];
				}
				if (!in_array($pos[$i]['lev2'], $lev2) && $pos[$i]['lev2']!="") 
				{
    				$lev2[]=$pos[$i]['lev2'];
				}
				if (!in_array($pos[$i]['lev3'], $lev3) && $pos[$i]['lev3']!="") 
				{
    				$lev3[]=$pos[$i]['lev3'];
				}
			}	
			
			$total = count($lev1) + count($lev2) + count($lev3);
			
			$status = ($total==14) ? "Y" : "N";
			
			$arr_data=array('level_1'=>count($lev1),'level_2'=>count($lev2),'level_3'=>count($lev3),'total'=> $total, 'status' => $status);
			return $arr_data;
				
	}

	function select_max(){
		$this -> db -> select('MAX(usercode) as maxu');
   		$this -> db -> from('membermaster');
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
		
		$aColumns = array('rm_matrix.idcode,rm_matrix.usercode','user1.fname', 'user1.lname', 'user1.emailid','user1.mobileno');
		
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
			//if ( $sWhere == "" ){$sWhere = "WHERE rm_matrix.usercode!='-1'";}
			//else{$sWhere .= " AND rm_matrix.usercode!='-1'";	}
			
			$sOrder=' ORDER BY rm_matrix.idcode ASC';
		
			$sQuery='SELECT CONCAT(user1.fname, " ", SUBSTRING(user1.lname,1,1)) as name, user1.username, user1.password, user1.emailid, user1.mobileno, user1.phone_no, user1.status, 
			CONCAT(user2.fname, " ", SUBSTRING(user2.lname,1,1)) as name2, user2.username as ref_username, user2.usercode as ref_code, rm_matrix.* 
			FROM (rm_matrix) 
			LEFT JOIN membermaster user1 ON user1.usercode = rm_matrix.usercode 
			LEFT JOIN membermaster user2 ON user2.usercode = rm_matrix.upling_member
			'.$sWhere.'
			 GROUP BY rm_matrix.usercode '.$sOrder.'
			'.$sLimit.'';	

		$query = $this->db->query($sQuery);
		$the_content = $query->result_array();
    	return $the_content;
		
 	}
	function get_tot_count_active(){
		$this -> db -> select('count(DISTINCT usercode) as tot');
   		$this -> db -> from('rm_matrix');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	function count_tot_position($eid)
	{
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from('rm_matrix');
		$this -> db -> where('usercode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return ($the_content[0]['tot'] >1 ) ? $the_content[0]['tot'] : false;
	}
	
	function get_multi_position($eid)
	{
		$this -> db -> select('CONCAT(user1.fname," ",SUBSTRING(user1.lname,1,1)) as name, user1.username',FALSE);
		$this -> db -> select('CONCAT(user2.fname," ",SUBSTRING(user2.lname,1,1)) as name2, user2.username as username2',FALSE);
		$this -> db -> select('rm_matrix.*');
   		$this -> db -> from('rm_matrix');
		$this -> db -> join('membermaster user1','user1.usercode = rm_matrix.usercode','left');
		$this -> db -> join('membermaster user2','user2.usercode = rm_matrix.upling_member','left');
		$this -> db -> where('rm_matrix.usercode',''.$eid.'');
		$this -> db -> order_by('rm_matrix.idcode','asc');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_multi_position_detail($eid)
	{
		$this -> db -> select('CONCAT(user1.fname," ",SUBSTRING(user1.lname,1,1)) as name, user1.username',FALSE);
		$this -> db -> select('CONCAT(user2.fname," ",SUBSTRING(user2.lname,1,1)) as name2, user2.username as username2',FALSE);
		$this -> db -> select('rm_matrix.*');
		
		$this -> db -> select("IFNULL(NULLIF(pay_coin.amount, '' ), 0) as coin",FALSE);
		$this -> db -> select("IFNULL(NULLIF(pay_rm.amount, '' ), 0) as rm",FALSE);
		
		$this -> db -> select('pay_rm.amount as rm');
		

   		$this -> db -> from('rm_matrix');
		$this -> db -> join('membermaster user1','user1.usercode = rm_matrix.usercode','left');
		$this -> db -> join('membermaster user2','user2.usercode = rm_matrix.upling_member','left');
		
		$this -> db -> join('rm_member_payment pay_coin','pay_coin.position = rm_matrix.idcode and pay_coin.wallet_type="COIN"','left');
		$this -> db -> join('rm_member_payment pay_rm','pay_rm.position = rm_matrix.idcode and pay_rm.wallet_type="RM"','left');
		
		$this -> db -> where('rm_matrix.usercode',''.$eid.'');
		$this -> db -> order_by('rm_matrix.idcode','asc');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_payment_sum_by_type($eid,$wallet_type)
	{
		$this -> db -> select('SUM(amount) as tot');
   		$this -> db -> from('rm_member_payment');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('wallet_type',''.$wallet_type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];
	}
	
	function get_withdrawal_sum_by_type($eid,$wallet_type)
	{
		$this -> db -> select('SUM(amount) as tot');
   		$this -> db -> from('rm_member_withdrawal');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('wallet_type',''.$wallet_type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];
	}
	
	function get_withdrawal_by_type($eid,$wallet_type)
	{
		$this -> db -> select('*');
   		$this -> db -> from('rm_member_withdrawal');
		$this -> db -> where('usercode',''.$eid.'');
		$this -> db -> where('wallet_type',''.$wallet_type.'');
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
	
	
	
	
	
	
	
}
?>
