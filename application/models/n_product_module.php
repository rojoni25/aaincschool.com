<?php
Class n_product_module extends CI_Model
{
 	function get_pages_contain($pagelable)
 	{
		
   		$this -> db -> select('*');
   		$this -> db -> from('cms_pages_master');
   		$this -> db -> where('pagelable', ''.$pagelable.'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
   		
 	}
	
	function get_user_filter($eid){
		$this -> db -> 	select('fname,lname,usercode');
   		$this -> db -> 	from('membermaster');
		if(isset($eid[1])){
			$this->db->where('(fname="'.$eid[0].'" and lname  LIKE "%'.$eid[1].'%")');
		}
		else{
			if (ctype_digit($eid[0])){
				$this -> db -> where('usercode', ''.$eid[0].'');
			}
			else{
				$this->db->where('(fname  LIKE "%'.$eid[0].'%" or lname  LIKE "%'.$eid[0].'%")');
			}	
		}
		
		$this -> db ->	order_by("fname", "asc");
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	
	
	
	function check_in_true()
	{
		$this -> db -> select('*');
   		$this -> db -> from('n_product_member');
   		$this -> db -> where('usercode',''.$this->session->userdata['logged_ol_member']['usercode'].'');
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return (isset($the_content[0]))? true : false;
	}
	
	
	
	
	
	
}
?>
