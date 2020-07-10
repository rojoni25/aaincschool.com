<?php

Class cmspages_module extends CI_Model
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

	function get_recent_monthly_members($usercode)
	{
		$this -> db -> select('*');
   		$this -> db -> from('membermaster');
   		$this -> db -> where('referralid', ''.$usercode.'');
   		$this -> db -> limit(10);
   		$query = $this -> db -> get();
		$the_content = $query->result_array();
    	return $the_content;
	}

  function get_top_referal_list($status=''){
    $where='';
    if($status!=''){
      $where=" where u.status='$status'" ;
    }
    $query = $this->db->query('SELECT
      u.usercode, u.fname, u.lname,
        COUNT(o.usercode) AS orders
    FROM
        `membermaster` AS u LEFT OUTER JOIN
        `membermaster` AS o on u.usercode=o.referralid
    '.$where.'
    GROUP BY
        u.usercode
    order by orders desc limit 10;');
    return $query->result();
  }

  function get_top_month_referal_list($status=''){
    $from = strtotime("first day of this month");
    $to =strtotime('last day of this month');
    $where='';
    if($status!=''){
      $where=" and u.status='$status'" ;
    }
    $query = $this->db->query('SELECT
      u.usercode, u.fname, u.lname,
        COUNT(o.usercode) AS orders
    FROM
        `membermaster` AS u LEFT OUTER JOIN
        `membermaster` AS o on u.usercode=o.referralid
    where o.add_time>="'.$from.'" and o.add_time<="'.$to.'" '.$where.'
    GROUP BY
        u.usercode
    order by orders desc limit 10;');
    return $query->result();
  }

  function get_top_week_referal_list($status=''){
    $from = strtotime('last Sunday'); //date("Y-m-d H:i:s", strtotime("-1 week"));
    $to = strtotime('next Sunday'); //date("Y-m-d H:i:s");

    $where='';
    if($status!=''){
      $where=" and u.status='$status'" ;
    }
    $query = $this->db->query('SELECT
      u.usercode, u.fname, u.lname,
        COUNT(o.usercode) AS orders
    FROM
        `membermaster` AS u LEFT OUTER JOIN
        `membermaster` AS o on u.usercode=o.referralid
    where o.add_time>="'.$from.'" and o.add_time<="'.$to.'" '.$where.'
    GROUP BY
        u.usercode
    order by orders desc limit 10;');
    return $query->result();
  }

}