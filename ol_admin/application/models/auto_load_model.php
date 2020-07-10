<?php
Class auto_load_model extends CI_Model
{
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
	
	function master_balance_update_free($field, $usercode, $amount, $opration){

			if($opration=='plus'){
				$this->db->set(''.$field.'', '`'.$field.'`+ '.$amount.'', FALSE);
			}
			if($opration=='minus'){
				$this->db->set(''.$field.'', '`'.$field.'`- '.$amount.'', FALSE);
			}
			$this->db->where('usercode',''.$usercode.'');
			$this->db->update('master_balance_sheet_free');
	}
	
	function master_balance_update_multi($field,$field2,$usercode,$amount){
		
			$this->db->set(''.$field.'', '`'.$field.'`+ '.$amount.'', FALSE);
			$this->db->set(''.$field2.'', '`'.$field2.'`+ '.$amount.'', FALSE);
			$this->db->where('usercode',''.$usercode.'');
			$this->db->update('master_balance_sheet_free');
	
	}
	
	function master_balance_update_paid($field,$field2,$usercode,$amount){
		
			$this->db->set(''.$field.'', '`'.$field.'`+ '.$amount.'', FALSE);
			$this->db->set(''.$field2.'', '`'.$field2.'`+ '.$amount.'', FALSE);
			$this->db->where('usercode',''.$usercode.'');
			$this->db->update('master_balance_sheet');
	
	}
	
	
	
	function get_media_for_popup($eid)
	{
		$this -> db -> select('*');
   		$this -> db -> from('media_gallery');
   		$this -> db -> where('status','Active');
		
		if($eid=='video'){
			$this -> db -> where('(type="mp4" or type="youtube")');
		}
		else if($eid=='ppt'){
			$this -> db -> where('type','ppt');
		}
		else if($eid=='audio'){
			$this -> db -> where('type','audio');
		}
		else{
			$this -> db -> where('type','image');
		}
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	
	

}
?>
