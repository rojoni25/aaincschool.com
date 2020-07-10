<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('hex2rgb'))
{
    function hex2rgb($hex) {
      $hex = str_replace("#", "", $hex);
      
      if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
      } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
      }
        $rgb = array($r, $g, $b);
      //return implode(",", $rgb); // returns the rgb values separated by commas
      return $rgb; // returns an array with the rgb values
    }
}
if ( ! function_exists('email_template_one'))
{
  function email_template_one( $q ) 
  {
    $ci=& get_instance();
    $data['q'] = $q;
    $html = $ci->load->view('email_template_join_view', $data, true);
    return $html; 
  }
}
//===============MOney Train Notification Email Template=================
if ( ! function_exists('email_template_money_train'))
{
  function email_template_money_train( $q ) 
  {
    $ci=& get_instance();
    $data['q'] = $q;
    $html = $ci->load->view('email_template_money_train', $data, true);
    return $html; 
  }
}



if ( ! function_exists('email_template_join'))
{
  function email_template_join( $q ) 
  {
    $ci=& get_instance();
    $data['q'] = $q;
    $html = $ci->load->view('email_template_join_view', $data, true);
    //email_template_view
    return $html; 
  }
}


if ( ! function_exists('send_email_template_join_ref'))
{
  function send_email_template_join_ref( $q ) 
  {
    $ci=& get_instance();
    $data['q'] = $q;
    $html = $ci->load->view('email_template_join_ref_view', $data, true);
    return $html; 
  }
}

if ( ! function_exists('email_template_join_visit_invitation_link'))
{
  function email_template_join_visit_invitation_link( $q ) 
  {
    
    $ci=& get_instance();
    $data['q'] = $q;
    $html = $ci->load->view('email_template_join_ref_view', $data, true);
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


if ( ! function_exists('pdl_admin_url'))
{
    function pdl_admin_url()
    {
      $url=base_url().'index.php/pdl/';
      return $url;
    }
}

if ( ! function_exists('base_cm'))
{
    function base_cm()
    {
      $url=base_url().'index.php/club/';
      return $url;
    }
}

if ( ! function_exists('base_tl'))
{
    function base_tl()
    {
      $url=base_url().'index.php/tl/';
      return $url;
    }
}
//----------------TLC----------------
if ( ! function_exists('base_tlc'))
{
    function base_tlc()
    {
      $url=base_url().'index.php/tlc/';
      return $url;
    }
}
//----------------TLC----------------

if ( ! function_exists('base_ang'))
{
    function base_ang()
    {
      $url=base_url().'index.php/ang/';
      return $url;
    }
}

if ( ! function_exists('base_matrix'))
{
    function base_matrix($seg)
    {
      $url=base_url().'index.php/'.$seg.'/';
      return $url;
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
  
  if ( ! function_exists('vma_ad'))
  {
    function vma_ad()
    {
      $url=base_url().'index.php/vma_ad/';
      return $url;
    }
  }
  
  if ( ! function_exists('smfund'))
  {
    function smfund()
    {
      $url=base_url().'index.php/smfund/';
      return $url;
    }
  }
  
   if ( ! function_exists('convertYoutube'))
    {
    function convertYoutube($string,$controls,$autoplay,$mute) {
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

  function convertYoutube2($result) {
    ?>

    <div class="bodyvideo">
  <div class="videoinner">
    <?php
    $autoplay_state = $result[0]['page_bg_video_autoplay'] == 'Y' ? '1' : '0';
    if($result[0]['video_url1']!=''){
      //$autoplay_state = $result[0]['page_bg_video_autoplay'] == 'Y' ? ture : false;
      if ($autoplay_state=='0' && strpos($result[0]['video_url1'], 'youtube') !== false){
        echo '<iframe width="100%" height="100%" src="'.convertYoutube($result[0]['video_url1'], false, $autoplay_state).'" frameborder="0" allowfullscreen></iframe>';
      }
      elseif($autoplay_state=='1' && strpos($result[0]['video_url1'], 'youtube') !== false){
        //echo '<video width="100%" height="100%" controls autolay><source src="'.$result[0]['video_url1'].'" type="video/mp4"></video>';
      $you_url = end(explode("/", $result[0]['video_url1']));


      //////////////////// FOR YOUTUBE ////////////////////
    if (strpos($result[0]['video_url1'], 'youtube') !== false){
      ?>
    <div id="player"></div>
    <script>
      // 1. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 2. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '100%',
          width: '100%',
          playerVars: {
            <?php echo $autoplay_state=='1'?"autoplay: 1,":""; ?>
            loop: 1,
            rel:0,
            iv_load_policy:3,
            controls: 0,
            showinfo: 0,
            autohide: 1,
            modestbranding: 1,
            vq: 'hd1080'},
          videoId: '<?php echo $you_url; ?>',
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 3. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
        //player.mute();
      }

      var done = false;
      function onPlayerStateChange(event) {
        
      }
      function stopVideo() {
        player.stopVideo();
      }
    </script>
    <?php  }
  } else{
    echo '<video id="vid" width="100%" height="100%" controls><source src="'.$result[0]['video_url1'].'" type="video/mp4" allow="autoplay"></video>';
    if($autoplay_state=='1'){ ?>
      <script>
        // var vid = document.getElementById("myVideo");
        // vid.oncanplay = function(){
        //   document.getElementById('vid').play();
        // }

        window.addEventListener('load', function() {
          var video = document.querySelector('#video');
          var preloader = document.querySelector('.preloader');

          function checkLoad() {
              if (video.readyState === 4) {
                  preloader.parentNode.removeChild(preloader);
                  document.getElementById('vid').play();
              } else {
                  setTimeout(checkLoad, 100);
              }
          }

          checkLoad();
        }, false);


      </script>
    <?php }

    ?>
    
    <?php 
    }
  } // blank check end
  ?>
    </div>  
</div> <?php
     
  }
  // end function


  function convertYoutube3($result){ ?>
    <div class="textbody iphone" id="textbody"> 
        <?php
    $autoplay_state = $result[0]['page_bg_video_autoplay_2'] == 'Y' ? '1' : '0';
    if($result[0]['video_url2']!=''){
      //$autoplay_state = $result[0]['page_bg_video_autoplay'] == 'Y' ? ture : false;
      if ($autoplay_state=='0' && strpos($result[0]['video_url2'], 'youtube') !== false){
        echo '<iframe width=100% height=100% src="'.convertYoutube($result[0]['video_url2'], false, $autoplay_state).'" frameborder="0" allowfullscreen></iframe>';
      }
      elseif($autoplay_state=='1' && strpos($result[0]['video_url2'], 'youtube') !== false){
        //echo '<video width="100%" height="100%" controls autolay><source src="'.$result[0]['video_url2'].'" type="video/mp4"></video>';
      $you_url = end(explode("/", $result[0]['video_url2']));


      //////////////////// FOR YOUTUBE ////////////////////
    if (strpos($result[0]['video_url2'], 'youtube') !== false){
      ?>
    <div id="player"></div>
    <script>
      // 1. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 2. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '100%',
          width: '100%',
          playerVars: {
            <?php echo $autoplay_state=='1'?"autoplay: 1,":""; ?>
            loop: 1,
            rel:0,
            iv_load_policy:3,
            controls: 0,
            showinfo: 0,
            autohide: 1,
            modestbranding: 1,
            vq: 'hd1080'},
          videoId: '<?php echo $you_url; ?>',
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 3. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
        //player.mute();
      }

      var done = false;
      function onPlayerStateChange(event) {
        
      }
      function stopVideo() {
        player.stopVideo();
      }
    </script>
    <?php  }
  } else{
    echo '<video id="vid" width=100% height=100% controls><source src="'.$result[0]['video_url2'].'" type="video/mp4" allow="autoplay"></video>';
    if($autoplay_state=='1'){ ?>
      <script>
        // var vid = document.getElementById("myVideo");
        // vid.oncanplay = function(){
        //   document.getElementById('vid').play();
        // }

        window.addEventListener('load', function() {
          var video = document.querySelector('#video');
          var preloader = document.querySelector('.preloader');

          function checkLoad() {
              if (video.readyState === 4) {
                  preloader.parentNode.removeChild(preloader);
                  document.getElementById('vid').play();
              } else {
                  setTimeout(checkLoad, 100);
              }
          }

          checkLoad();
        }, false);


      </script>
    <?php }

    ?>
    
    <?php 
    }
  } // blank check end
  ?>
    
    </div>
 <?php }
  
  function VideoPageBig($result)
  {
    
   $autoplay_state = $result[0]['page_bg_video_autoplay_2'] == 'Y' ? '1' : '0';
   $mute = $result[0]['page_bg_video_mute'] == 'Y' ? '1' : '0';
    if($result[0]['page_bg_video']!=''){
      //$autoplay_state = $result[0]['page_bg_video_autoplay'] == 'Y' ? ture : false;
      if ($autoplay_state=='0' && strpos($result[0]['page_bg_video'], 'youtube') !== false){
        echo '<iframe style="width:100%; height:100vh;" src="'.convertYoutube($result[0]['page_bg_video'], false, $autoplay_state,$mute).'&rel=0" frameborder="0" allowfullscreen></iframe>';
      }
      elseif($autoplay_state=='1' && strpos($result[0]['page_bg_video'], 'youtube') !== false){
        //echo '<video width="100%" height="100%" controls autolay><source src="'.$result[0]['page_bg_video'].'" type="video/mp4"></video>';
      $you_url = end(explode("/", $result[0]['page_bg_video']));


      //////////////////// FOR YOUTUBE ////////////////////
    if (strpos($result[0]['page_bg_video'], 'youtube') !== false){
      ?>
    <div id="player" style="width:100%; height:100vh;"></div>
    <script>
      // 1. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 2. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '100vh',
          width: '100%',
          playerVars: {
            <?php echo $autoplay_state=='1'?"autoplay: 1,":""; ?>
            <?php echo $mute=='1'?"mute: 1,":""; ?>
            loop: 1,
            rel:0,
            iv_load_policy:3,
            controls: 0,
            showinfo: 0,
            autohide: 1,
            modestbranding: 1,
            vq: 'hd1080'},
          videoId: '<?php echo $you_url; ?>',
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 3. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
        //player.mute();
      }

      var done = false;
      function onPlayerStateChange(event) {
        
      }
      function stopVideo() {
        player.stopVideo();
      }
    </script>
    <?php  }
  } else{
    echo '<video id="vid" style="width:100%; height:100vh;" controls><source src="'.$result[0]['page_bg_video'].'" type="video/mp4" allow="autoplay"></video>';
    if($autoplay_state=='1'){ ?>
      <script>
        // var vid = document.getElementById("myVideo");
        // vid.oncanplay = function(){
        //   document.getElementById('vid').play();
        // }

        window.addEventListener('load', function() {
          var video = document.querySelector('#video');
          var preloader = document.querySelector('.preloader');

          function checkLoad() {
              if (video.readyState === 4) {
                  preloader.parentNode.removeChild(preloader);
                  document.getElementById('vid').play();
              } else {
                  setTimeout(checkLoad, 100);
              }
          }

          checkLoad();
        }, false);


      </script>
    <?php }

  
    
   
    }
  } // blank check end
 
  
}

   
  if ( ! function_exists('get_hw_videoframe'))
{
    function get_hw_videoframe($type, $px='px')
    {
      if($type == "flat_monitor"){

        return array( 
                "width" => "486".$px, 
                "height" => "400".$px
            );
      }else if($type == "miphone"){

        return array( 
                "width" => "554".$px, 
                "height" => "276".$px
            );
      }else if($type == "mflat_screen"){

        return array( 
                "width" => "615".$px, 
                "height" => "400".$px
            );
      }else if($type == "mipad"){

        return array( 
                "width" => "560".$px, 
                "height" => "363".$px
            );
      }else if($type == "mimac"){

        return array( 
                "width" => "703".$px, 
                "height" => "560".$px
            );
      }else if($type == "macbook_pro"){

        return array( 
                "width" => "658".$px, 
                "height" => "389".$px
            );
      }
    }   
}
if ( ! function_exists('get_hw_videoframe_inner')){
     function get_hw_videoframe_inner($type, $px='px') {
         if($type == "flat_monitor"){
             return "width: calc(100% - 40px); height: calc(100% - 122px); margin-left: 21px; margin-top: 20px;";
        }
        else if($type == "miphone"){
             return "width: calc(100% - 129px); height: calc(100% - 36px); margin-left: 64px; margin-top: 17px;";
        }
        else if($type == "mflat_screen"){
             return "width: calc(100% - 23px); height: calc(100% - 66px); margin-left: 11px; margin-top: 9px;";
        }
        else if($type == "mipad"){
             return "width: calc(100% - 101px); height: calc(100% - 21px); margin-left: 49px; margin-top: 8px;";
        }
        else if($type == "mimac"){
             return "width: calc(100% - 69px); height: calc(100% - 200px); margin-left: 36px; margin-top: 27px;";
        }
        else if($type == "macbook_pro"){
             return "width: calc(100% - 172px); height: calc(100% - 85px); margin-left: 86px; margin-top: 28px;";
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


if(!function_exists('get_user_by_id')){
  function get_user_by_id($usercode) {
    $CI =& get_instance();
    return $CI->db->select('*')->from('membermaster')->where('usercode',$usercode)->get()->result_array();
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

if (!function_exists('lastlogin'))
{
  function lastlogin($usercode){
    $ci=& get_instance();
    $ci->load->database();
    $query = $ci -> db -> query("SELECT timedt FROM `login_info` WHERE `usercode` = ".$usercode." ORDER BY `login_code` DESC LIMIT 0,1");
    $row = $query->row_array();
    return date('m-d-Y H:i:s',strtotime($row['timedt']));
  }
}
if ( ! function_exists('checkdevice'))
{
  function checkdevice(){
    $ci=& get_instance();
    $ci->load->library('user_agent');
    $mobile=$ci->agent->is_mobile();
    return $mobile;
  } 
}
if ( ! function_exists('countreferral'))
{
  function countreferral($id){
    $ci=& get_instance();
    $ci->load->database();
    if($id>0){
      $query = $ci->db->query("SELECT count(*) as total FROM `membermaster` WHERE referralid_free=
".$id);
      $row = $query->row_array();
      return $row['total'];
    }else{
      return 0;
    }
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

	//========================Get capture page Subscription Status from "membermaster" table=================
	if ( ! function_exists('getSubscriptionStatus'))
{
	function getSubscriptionStatus($usercode){
	    $ci=& get_instance();
        $ci->load->database();
        $query = $ci->db->query("SELECT * from membermaster where usercode=".$usercode);
        $row = $query->row_array();
    	if( $row["subscription_status"]=="Active"){
    	    return true;
    	}else{
    	    return false;
    	}
    	
	}
}
	//========================Get capture page wallet total amount from "tbl_capture_page_wallet" table=================
	if ( ! function_exists('getCapturePageWalletTotal'))
{
	function getCapturePageWalletTotal($usercode){
	    $ci=& get_instance();
        $ci->load->database();
        $query = $ci->db->query("SELECT sum(amount) as totalAmount from tbl_capture_page_wallet where receiver_id=".$usercode);
        $row = $query->row_array();
        if($row["totalAmount"]==""){
            return 0;
        }
    return $row["totalAmount"];
    	
	}
}
	//========================check if the user is pro marketer subscriber=================
	if ( ! function_exists('is_pro_marketer_subscriber'))
{
	function is_pro_marketer_subscriber($usercode){
	    $ci=& get_instance();
        $ci->load->database();
        $query = $ci->db->query("select *,sub.status as pro_status from membermaster m RIGHT JOIN tbl_susbscribed_plans sub on m.usercode=sub.usercode where sub.usercode=".$usercode." and (sub.status='Active' OR sub.status='Pending')");
        $row = $query->row_array();
    	if( count($row)>0){
    	    return true;
    	}else{
    	    return false;
    	}
    	//
	}
}