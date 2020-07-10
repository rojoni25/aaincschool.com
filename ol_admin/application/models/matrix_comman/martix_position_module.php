<?php
Class martix_position_module extends CI_Model
{
 	
	
 
 	function position_id_check($eid){
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('idcode',''.$eid.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_position_member_count($eid){
			$sQuery="SELECT t2.idcode AS lev1, t3.idcode  AS lev2,
			t4.idcode  AS lev3
			FROM ".MATRIX_TABLE_PRE."matrix AS t1
			LEFT JOIN ".MATRIX_TABLE_PRE."matrix AS t2 ON t2.upling_id = t1.idcode
			LEFT JOIN ".MATRIX_TABLE_PRE."matrix AS t3 ON t3.upling_id = t2.idcode
			LEFT JOIN ".MATRIX_TABLE_PRE."matrix AS t4 ON t4.upling_id = t3.idcode
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

	
	
	
	function get_downline_member($id)
	{
		if($id==''){
			return;
		}
		$this -> db -> select('CONCAT(user1.fname," ",SUBSTRING(user1.lname,1,1)) as name, user1.username',FALSE);
		$this -> db -> select('CONCAT(user2.fname," ",SUBSTRING(user2.lname,1,1)) as name2, user2.username as username2',FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix.*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
		$this -> db -> join('membermaster user1','user1.usercode = '.MATRIX_TABLE_PRE.'matrix.usercode','left');
		$this -> db -> join('membermaster user2','user2.usercode = '.MATRIX_TABLE_PRE.'matrix.upling_member','left');
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix.upling_id IN('.$id.')');
		$this -> db -> order_by(''.MATRIX_TABLE_PRE.'matrix.idcode','asc');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	

	function count_tot_position($eid)
	{
		$this -> db -> select('count(*) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return ($the_content[0]['tot'] >1 ) ? $the_content[0]['tot'] : false;
	}
	
	
	
	
	function get_multi_position_detail($eid)
	{
		$this -> db -> select('CONCAT(user1.fname," ",SUBSTRING(user1.lname,1,1)) as name, user1.username',FALSE);
		$this -> db -> select('CONCAT(user2.fname," ",SUBSTRING(user2.lname,1,1)) as name2, user2.username as username2',FALSE);
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix.*');
		
		$this -> db -> select("IFNULL(NULLIF(pay_coin.amount, '' ), 0) as coin",FALSE);
		
		

   		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
		$this -> db -> join('membermaster user1','user1.usercode = '.MATRIX_TABLE_PRE.'matrix.usercode','left');
		$this -> db -> join('membermaster user2','user2.usercode = '.MATRIX_TABLE_PRE.'matrix.upling_member','left');
		
		$this -> db -> join(''.MATRIX_TABLE_PRE.'member_payment pay_coin','pay_coin.position = '.MATRIX_TABLE_PRE.'matrix.idcode and pay_coin.wallet_type="COIN"','left');
		
		
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix.usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> order_by(''.MATRIX_TABLE_PRE.'matrix.idcode','asc');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_payment_sum_by_type($wallet_type)
	{
		$this -> db -> select('SUM(amount) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_payment');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('wallet_type',''.$wallet_type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];
	}
	
	function get_withdrawal_sum_by_type($wallet_type)
	{
		$this -> db -> select('SUM(amount) as tot');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_withdrawal');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('wallet_type',''.$wallet_type.'');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return (float)$the_content[0]['tot'];
	}
	
	function get_withdrawal_record()
	{
		$this -> db -> select('*');
   		$this -> db -> from(''.MATRIX_TABLE_PRE.'member_withdrawal');
		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
		$this -> db -> where('wallet_type','COIN');
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
		return $the_content;
	}
	
	function get_multi_postion($id){
		
		$this -> db -> select("CONCAT(user1.fname,' ',user1.lname) AS name1", FALSE);
		$this -> db -> select("CONCAT(user2.fname,' ',user2.lname) AS name2", FALSE);
		
		$this -> db -> select(''.MATRIX_TABLE_PRE.'matrix.*',FALSE);
   		
		$this -> db -> from(''.MATRIX_TABLE_PRE.'matrix');
		$this -> db -> join('membermaster user1','user1.usercode = '.MATRIX_TABLE_PRE.'matrix.usercode','left');
		$this -> db -> join('membermaster user2','user2.usercode = '.MATRIX_TABLE_PRE.'matrix.upling_member','left');
		
		$this -> db -> where(''.MATRIX_TABLE_PRE.'matrix.usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
	
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
		
}
?>
