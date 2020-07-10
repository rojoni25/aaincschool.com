<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('email_template_one'))
{
	function email_template_one( $q ) 
	{
		$html='<table bgcolor="#74bacf" width="100%" cellpadding="0" cellspacing="0" style="background: rgba(130,197,255,1);
background: -moz-linear-gradient(top, rgba(130,197,255,1) 0%, rgba(246,246,246,1) 35%, rgba(255,255,255,1) 100%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(130,197,255,1)), color-stop(35%, rgba(246,246,246,1)), color-stop(100%, rgba(255,255,255,1)));
background: -webkit-linear-gradient(top, rgba(130,197,255,1) 0%, rgba(246,246,246,1) 35%, rgba(255,255,255,1) 100%);
background: -o-linear-gradient(top, rgba(130,197,255,1) 0%, rgba(246,246,246,1) 35%, rgba(255,255,255,1) 100%);
background: -ms-linear-gradient(top, rgba(130,197,255,1) 0%, rgba(246,246,246,1) 35%, rgba(255,255,255,1) 100%);
background: linear-gradient(to bottom, rgba(130,197,255,1) 0%, rgba(246,246,246,1) 35%, rgba(255,255,255,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#82c5ff", endColorstr="#ffffff", GradientType=0 );">

  <tbody>
    <tr>
      <td><table width="590" cellpadding="0" cellspacing="0" align="center">
          <tbody>
            <tr>
              <td><table width="590" cellpadding="0" cellspacing="0" background="bg_header.gif">
                  <!-- Header table -->
                  <tbody>
                    <tr>
                      <td height="80" valign="middle"><font style="font-family: Tahoma, Arial, Helvetica, sans-serif; font-size:30px; color:#fff;">'.getconfigMeta("comanyname").'</font><br>
                       </td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td><table width="590" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
                  <tbody>
                    <tr>
                      <td width="590" height="10"></td>
                    </tr>
                    <tr>
                      <td><!-- Main content starts here -->
                        
                        <table width="590" cellpadding="0" cellspacing="0" align="left">
                          <tbody>
                            <tr>
                              <td width="10"></td>
                              <td width="570"><!-- Middle column starts -->
                                
                                <table width="570" cellpadding="0" cellspacing="0" bgcolor="#dff2f7">
                                  <!-- Top news item table -->
                                  <tbody>
                                    <tr>
                                      <td width="570" height="5"></td>
                                    </tr>
                                    <tr>
                                      <td width="570"><table cellpadding="10" cellspacing="0">
                                          <tbody>
                                            <tr>
                                              <td><h1 style="font-family: Tahoma, Arial, Helvetica, sans-serif; font-weight: normal; font-size:21px; color:#034285; margin:0 0 10px 0;">'.$q['heading'].'</h1>
                                                <p style="font-family: Tahoma, Arial, Helvetica, sans-serif; font-size:13px; color:#3d4448; margin:0 0 10px 0;">'.$q['msg'].'</p></td>
                                            </tr>
                                          </tbody>
                                        </table></td>
                                    </tr>
									<tr>
                                      <td width="570"><table cellpadding="10" cellspacing="0">
                                          <tbody>
                                            <tr>
                                              <td>
                                                <p style="font-family: Tahoma, Arial, Helvetica, sans-serif; font-size:13px; color:#3d4448; margin:0 0 10px 0;">'.$q['contain'].'</p></td>
                                            </tr>
                                          </tbody>
                                        </table></td>
                                    </tr>
                                    <tr>
                                      <td width="390" height="5"></td>
                                    </tr>
                                  </tbody>
                                </table>
                                <table cellpadding="0" cellspacing="0">
                                  <tbody>
                                    <tr>
                                      <td colspan="3" width="570" align="center"><!-- Footer --> 
                                        <font style="font-family: Tahoma, Arial, Helvetica, sans-serif; font-size:11px; color: #3d4448; margin:0 0 10px 0; line-height:15px;"> <br>
                                        '.getconfigMeta("comanyname").'<br>
                                        <br>
                                        </font></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                              <!-- Content column ends -->
                              
                              <td width="10"></td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
';
    return $html;	
	}
}



if ( ! function_exists('email_template_join'))
{
	function email_template_join( $q ) 
	{
		$html='<table bgcolor="#74bacf" width="100%" cellpadding="0" cellspacing="0" style="background: rgba(130,197,255,1);
background: -moz-linear-gradient(top, rgba(130,197,255,1) 0%, rgba(246,246,246,1) 35%, rgba(255,255,255,1) 100%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(130,197,255,1)), color-stop(35%, rgba(246,246,246,1)), color-stop(100%, rgba(255,255,255,1)));
background: -webkit-linear-gradient(top, rgba(130,197,255,1) 0%, rgba(246,246,246,1) 35%, rgba(255,255,255,1) 100%);
background: -o-linear-gradient(top, rgba(130,197,255,1) 0%, rgba(246,246,246,1) 35%, rgba(255,255,255,1) 100%);
background: -ms-linear-gradient(top, rgba(130,197,255,1) 0%, rgba(246,246,246,1) 35%, rgba(255,255,255,1) 100%);
background: linear-gradient(to bottom, rgba(130,197,255,1) 0%, rgba(246,246,246,1) 35%, rgba(255,255,255,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#82c5ff", endColorstr="#ffffff", GradientType=0 );">

  <tbody>
    <tr>
      <td><table width="590" cellpadding="0" cellspacing="0" align="center">
          <tbody>
            <tr>
              <td><table width="590" cellpadding="0" cellspacing="0" background="bg_header.gif">
                  <!-- Header table -->
                  <tbody>
                    <tr>
                      <td height="80" valign="middle"><font style="font-family: Tahoma, Arial, Helvetica, sans-serif; font-size:30px; color:#fff;">'.getconfigMeta("comanyname").'</font><br>
                       </td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td><table width="590" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
                  <tbody>
                    <tr>
                      <td width="590" height="10"></td>
                    </tr>
                    <tr>
                      <td><!-- Main content starts here -->
                        
                        <table width="590" cellpadding="0" cellspacing="0" align="left">
                          <tbody>
                            <tr>
                              <td width="10"></td>
                              <td width="570"><!-- Middle column starts -->
                                
                                <table width="570" cellpadding="0" cellspacing="0" bgcolor="#dff2f7">
                                  <!-- Top news item table -->
                                  <tbody>
                                    <tr>
                                      <td width="570" height="5"></td>
                                    </tr>
                                    <tr>
                                      <td width="570"><table cellpadding="10" cellspacing="0">
                                          <tbody>
                                            <tr>
                                              <td><h1 style="font-family: Tahoma, Arial, Helvetica, sans-serif; font-weight: normal; font-size:21px; color:#034285; margin:0 0 10px 0;">'.$q['heading'].'</h1>
                                                <p style="font-family: Tahoma, Arial, Helvetica, sans-serif; font-size:13px; color:#3d4448; margin:0 0 10px 0;">'.$q['msg'].'</p></td>
                                            </tr>
                                          </tbody>
                                        </table></td>
                                    </tr>
									 <tr>
                                      <td width="570" align="center">
                                      	<a href="'.$q['link'].'" style=""><button style="  background: #3498db;border-radius: 6px;font-family: Arial;color: #ffffff;font-size: 18px;padding: 9px 20px 10px 20px;text-decoration: none;">Click Hear To Join</button></a>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td width="390" height="5"></td>
                                    </tr>
                                  </tbody>
                                </table>
                                <table cellpadding="0" cellspacing="0">
                                  <tbody>
                                    <tr>
                                      <td colspan="3" width="570" align="center"><!-- Footer --> 
                                        <font style="font-family: Tahoma, Arial, Helvetica, sans-serif; font-size:11px; color: #3d4448; margin:0 0 10px 0; line-height:15px;"> <br>
                                        '.getconfigMeta("comanyname").'<br>
                                        <br>
                                        </font></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                              <!-- Content column ends -->
                              
                              <td width="10"></td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
';
    return $html;	
	}
}

if ( ! function_exists('ago_time'))
{
		function ago_time($timestamp)
		{
			$then = date_create($timestamp);
			
			// for anything over 1 day, make it rollover on midnight
			$today = date_create('tomorrow'); // ie end of today
			$diff = date_diff($then, $today);
			
			if ($diff->y > 0) return $diff->y.' year'.($diff->y>1?'s':'').' ago';
			if ($diff->m > 0) return $diff->m.' month'.($diff->m>1?'s':'').' ago';
			$diffW = floor($diff->d / 7);
			if ($diffW > 0) return $diffW.' week'.($diffW>1?'s':'').' ago';
			if ($diff->d > 1) return $diff->d.' day'.($diff->d>1?'s':'').' ago';
			
			// for anything less than 1 day, base it off 'now'
			$now = date_create();
			$diff = date_diff($then, $now);
			
			if ($diff->d > 0) return 'yesterday';
			if ($diff->h > 0) return $diff->h.' hour'.($diff->h>1?'s':'').' ago';
			if ($diff->i > 0) return $diff->i.' minute'.($diff->i>1?'s':'').' ago';
			return $diff->s.' second'.($diff->s==1?'':'s').' ago';
		}
}

	if ( ! function_exists('vma_base'))
	{
		function vma_base()
		{
			$url=base_url().'index.php/vma/';
			return $url;
		}
	}
	
	if ( ! function_exists('diamond_base'))
	{
		function diamond_base()
		{
			$url=base_url().'index.php/diamond/';
			return $url;
		}
	}


//------------------------tlc----------------------------------

	if ( ! function_exists('list_matrix_menu')){
		
		function list_matrix_menu($arr_segment){
			
			if($arr_segment[1]=='r_matrix'){
				if($arr_segment[2]=='dashboard'){$menu_dashboard='active';}
				elseif($arr_segment[2]=='access_code'){$menu_access_code='active';}
				elseif($arr_segment[2]=='request'){$menu_request='active';}
				elseif($arr_segment[2]=='pif'){$menu_pif='active';}
				elseif($arr_segment[2]=='request_extra'){$menu_request_extra='active';}	
			}
			elseif($arr_segment[1]=='r_matrix_request'){$menu_r_matrix_request='active';}
			elseif($arr_segment[1]=='r_matrix_tree'){$menu_r_matrix_tree='active';}
			elseif($arr_segment[1]=='r_matrix_member'){$menu_r_matrix_member='active';}
			elseif($arr_segment[1]=='r_matrix_message'){$menu_r_matrix_message='active';}
			
			
			if($arr_segment[1]=='r_matrix_upgrade_pay'){
				if($arr_segment[2]=='pif_remaining'){$menu_pif_remaining='active';}
				elseif($arr_segment[2]=='pif_send_report'){$menu_pif_send_report='active';}
			
			}
			
			
			$html='<div class="row-fluid">
			<div class="span12">
			<div class="navbar">
			<div class="navbar-inner">
			<div class="container"> <a href="#" class="brand" style="margin-top:10px;">'.MATRIX_CODE_LLB.'</a>
			<div class="nav-collapse collapse navbar-responsive-collapse">
			<ul class="nav sub-menu">
			<li class="'.$menu_dashboard.'"><a href="'.MATRIX_BASE.'r_matrix/dashboard">Dashboard</a></li>	
			<li class="'.$menu_access_code.'"><a href="'.MATRIX_BASE.'r_matrix/access_code">Join Code</a></li>
			<li class="'.$menu_request.'"><a href="'.MATRIX_BASE.'r_matrix/request">Member Request</a></li>
			<li class="'.$menu_r_matrix_request.'"><a href="'.MATRIX_BASE.'r_matrix_request/request">Join Code Request</a></li>
			<li class="'.$menu_pif.'"><a href="'.MATRIX_BASE.'r_matrix/pif">PIF Request</a></li>
			<li class="'.$menu_r_matrix_tree.'"><a href="'.MATRIX_BASE.'r_matrix_tree/view/1">Tree View</a></li>
			<li class="'.$menu_r_matrix_member.'"><a href="'.MATRIX_BASE.'r_matrix_member/view">Member</a></li>
			<li class="'.$menu_pif_remaining.'"><a href="'.MATRIX_BASE.'r_matrix_upgrade_pay/pif_remaining">PIF For Member</a></li>
			<li class="'.$menu_pif_send_report.'"><a href="'.MATRIX_BASE.'r_matrix_upgrade_pay/pif_send_report">PIF Report</a></li>
			<li class="'.$menu_request_extra.'"><a href="'.MATRIX_BASE.'r_matrix/request_extra">Extra Position Request</a></li>
			<li class="'.$menu_r_matrix_message.'"><a href="'.MATRIX_BASE.'r_matrix_message/inbox">Message</a></li>
			</ul>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>';
			return $html;	
		}
	
		
	}
	
	
	if ( ! function_exists('kdk_admin_menu'))
{
		function kdk_admin_menu()
		{
			$html='<div class="row-fluid">
			<div class="span12">
			<div class="navbar">
			<div class="navbar-inner">
			<div class="container"> <a href="#" class="brand" style="margin-top:10px;">KDK</a>
			<div class="nav-collapse collapse navbar-responsive-collapse">
			<ul class="nav sub-menu">
			<li><a href="'.base_url().'index.php/r_matrix/dashboard">Dashboard</a></li>	
			<li class="active"><a href="'.base_url().'index.php/r_matrix/kdk_code">Join Code</a></li>
			<li><a href="'.base_url().'index.php/r_matrix/request">Member Request</a></li>
			<li><a href="'.base_url().'index.php/r_matrix_kdk_request/request">Join Code Request</a></li>
			<li><a href="'.base_url().'index.php/r_matrix/kdk_pif">PIF Request</a></li>
			<li><a href="'.base_url().'index.php/r_matrix_tree/view/1">Tree View</a></li>
			<li><a href="'.base_url().'index.php/r_matrix_member/view">Member</a></li>
			<li><a href="'.base_url().'index.php/r_matrix_upgrade_pay/pif_remaining">PIF For Member</a></li>
			<li><a href="'.base_url().'index.php/r_matrix_upgrade_pay/pif_send_report">PIF Report</a></li>
			<li><a href="'.base_url().'index.php/r_matrix/request_extra">Extra Position Request</a></li>
			<li><a href="'.base_url().'index.php/r_matrix_message/inbox">Message</a></li>
			</ul>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>';
			
			return $html;
		}
}
//------------------------tlc----------------------------------


if ( ! function_exists('convertYoutube'))
    {
    function convertYoutube($string,$controls=false,$autoplay=true) {
     $youtube = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
      "//www.youtube.com/embed/$2",
      $string
     );
     $attr=array();
     if ($controls) {
       $attr[] = 'controls=1';
     } else{
      $attr[] = 'controls=0';
     }
     if($autoplay){
      $attr[] = 'autoplay=1';
     } else{
      $attr[] = 'autoplay=0';
     }
      if($mute){
      $attr[] = 'mute=1';
     } else{
      $attr[] = 'mute=0';
     }
     

     if(count($attr)){
      return $youtube.'?'.implode('&', $attr);
     } else{
      return $youtube;
     }
    }
  }

if ( ! function_exists('get_email_cms_page_master'))
    {
    function get_email_cms_page_master($string) {
      $CI =& get_instance();
      return $CI->db->select('textdt')->from('cms_pages_master')->where('pagelable',$string)->get();
    }
  }
if ( ! function_exists('checkconfigMeta'))
{
    function checkconfigMeta($field = '')
    {
        if($field!=''){
      $ci=& get_instance();
      $ci->load->database(); 
      $ci->db->select('setting_key'); 
      $ci->db->from('tbl_settings');   
      $rowArr =  $ci->db->get()->result();
      $checkrowArr = array();
      foreach($rowArr as $rw){
        $checkrowArr[] = $rw->setting_key;
      }
      if(in_array($field,$checkrowArr)){
        return true;
      }else{
        return false;
      }
    }else{
      return false;
    }
    } 
}

if ( ! function_exists('getconfigMeta'))
{ 
  function getconfigMeta($field = '')
    {
    $ci=& get_instance();
    $ci->load->database();
    $query = $ci->db->get_where('tbl_settings',array('setting_key'=>$field));
    $row = $query->row_array();
    if(count($row)>0){
      return $row['setting_value'];
    }else{
      return false;
    }
  }   
}
if ( ! function_exists('countreferral'))
{
  function countreferral($id){
    $ci=& get_instance();
    $ci->load->database();
    $query = $ci->db->query("SELECT count(*) as total FROM `membermaster` WHERE referralid_free=
".$id);
    $row = $query->row_array();
    return $row['total'];
  } 
}
if ( ! function_exists('countpaidreferral'))
{
  function countpaidreferral($id){
    $ci=& get_instance();
    $ci->load->database();
    $query = $ci->db->query("SELECT count(*) as total FROM `membermaster` WHERE referralid=
".$id);
    $row = $query->row_array();
    return $row['total'];
  } 
}

if ( ! function_exists('GetPaidReferalWallet'))
{
  function GetPaidReferalWallet($usercode){
    $ci=& get_instance();
    $ci->load->database();
//     $query = $ci->db->query("SELECT SUM(amount) as total FROM `tbl_visible_wallet` WHERE receiverid=
// ".$usercode);
//substract total withdrawal from referal wallet or smart wallet
  $query = $ci->db->query("SELECT SUM(amount)-(select sum(amount) from withdrawal_balance where usercode=".$usercode.") as total FROM `tbl_visible_wallet` WHERE receiverid=".$usercode);
    $row = $query->row_array();
    if($row['total']>0)
      return $row['total'];
    else
      return 0;
  } 
}