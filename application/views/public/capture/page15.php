<?php
	
	$headercolor	=	hex2rgb($result[0]['headercolor']);
	$box_bg_color	=	hex2rgb($result[0]['box_bg_color']);
	$form_bg_color	=	hex2rgb($result[0]['form_bg_color']);
	$box_bg_color	=	hex2rgb($result[0]['box_bg_color']);
	$box_bg_color	=	hex2rgb($result[0]['box_bg_color']);
	
	
	if($result[0]['headerimg']!=''){$headercls='headerimg';}else{$headercls='headercolor';}
	if($result[0]['box_bg_img']!=''){$boxcls='boximg';}else{$boxcls='boxcolor';}
	if($result[0]['page_bg_img']==''){$page_bg_img=''.base_url().'asset/capturepages/page9.jpg';}
	else{$page_bg_img=$result[0]['page_bg_img'];}
	
	if($result[0]['page_bg_video_mute']=='Y'){$mute='true';}
	else{$mute='false';}
?>

<?php
    $autoplay_state = $result[0]['page_bg_video_autoplay'] == 'Y' ? '1' : '0';
    if($result[0]['video_url1']!=''){
      //$autoplay_state = $result[0]['page_bg_video_autoplay'] == 'Y' ? ture : false;
      if ($autoplay_state=='0' && strpos($result[0]['video_url1'], 'youtube') !== false){
        echo '<iframe style="width:100%; height:100vh;" src="'.convertYoutube($result[0]['video_url1'], false, $autoplay_state).'" frameborder="0" allowfullscreen></iframe>';
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
    echo '<video id="vid" style="width:100%; height:100vh;" controls><source src="'.$result[0]['video_url1'].'" type="video/mp4" allow="autoplay"></video>';
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
<style>
	body{
		<?php if($result[0]['video_url1']=='') {?>
		
				background: url('<?=$page_bg_img?>') no-repeat center center fixed; 
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
		<?php } ?>
		

	}
</style>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Registration Now</title>

<meta property="og:title" content="<?=getconfigMeta('comanyname')?>" />
<meta property="og:image" content="<?=$page_bg_img?>" />
<?php if($result[0]['main_body_text']!=''){?>
	<meta property="og:description" content="" />
<?php } ?>


<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/capturepages/page1/default.css" />
<script src="<?=base_url();?>asset/js/jquery.js"></script>
<link href="<?=base_url();?>asset/capturepages/perfect-scrollbar.css" rel="stylesheet">
<script src="<?=base_url();?>asset/capturepages/perfect-scrollbar.js"></script>

<script src="<?=base_url();?>asset/js/capture_js.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/css/capture_css.css" />
<script type="text/javascript" charset="utf-8" src="<?=base_url();?>asset/capturepages/video_bg/jquery.tubular.1.0.js"></script>
</head>
<body>
<?php  if($result[0]['scrolling']=='Y'){?>
<div class="marqdiv">
    <h4>Just Joined</h4>
     <marquee><h3><?=$current_join_mem?></h3></marquee>
</div>
<?php }?>
<!-- Header Section -->
<header class="clearfix header <?=$headercls?>">

    <?php  if($result[0]['headline_text']!=''){
	  	$style_title=$result[0]['head_bg']=='Y'?'style="background:'.$result[0]['head_bg_col'].';color:#000;"':'';
	  	?>
	  		<h1 <?php echo $style_title; ?>><?=$result[0]['headline_text']?></h1>
	<?php } ?>
</header>
<!-- Header Section -->

<div class="clearfix"></div>

<div class="container clearfix <?=$boxcls?>" id="main-contain">
  <div id="wrapper"></div>
  
  <input type="hidden" id="videocode" value="<?=$videocode?>">
  <input type="hidden" id="mute" value="<?=$mute?>">
  
  <?php if($result[0]['video_url2']!='') { 
 	echo  '<div class="videodiv '.$result[0]["video_frame"].'">
 		<div class="videoinner">';
			
            if($result[0]['video_url2']!=''){
	  	$autoplay_state = $result[0]['page_bg_video_autoplay'] == 'Y' ? ture : false;
				if (strpos($result[0]['video_url2'], 'youtube') !== false){
					echo '<iframe width="100%" height="100%" src="'.convertYoutube($result[0]['video_url2'], false, $autoplay_state).'" frameborder="0" allowfullscreen></iframe>';
				}
				else{
					echo '<video width="100%" height="100%" controls="controls"><source src="'.convertYoutube($result[0]['video_url2']).'" type="video/mp4"></video>';
				}
            }
            
        echo'</div>
  </div>';
   } else{
	 	$cls_min_height='min_height';
	 }?>
  <div class="containdiv <?=$cls_min_height?>">
	<p><?=$result[0]['main_body_text']?></p>  
  </div>
</div><!-----container------>

<?php if($result[0]['option_form']=='Y') {?>
<div class="formdiv" id="formdiv">
	<div class="forminner">
    <form class="form-signin" method="post" action="<?php echo base_url();?>index.php/rg/insertrecord">
    		
            <?php if($smfund){ echo '<input type="hidden" name="smfund" value="Y"/>'; } ?>
            
    	 	<input  type="hidden" id="referralid" name="referralid" value="<?=$ref[0]['usercode']?>"/>
         	<input  type="hidden" id="referralusername" name="referralusername" value="<?=$ref[0]['username']?>"/>
         	<input  type="hidden"  id="baseurl" value="<?=base_url();?>"/>
            <input  type="hidden" id="pagecode" name="pagecode" value="<?=$pagecode?>"/>
            <input  type="hidden" name="redirect_url"  id="redirect_url" anme value="<?=$result[0]['redirect_url']?>"/>
           
    	<table width="100%">
        	<tr>
            	<td width="48%"><input type="text" name="fname" id="fname" placeholder="First Name" class="txt1" title="First Name"></td>
                <td width="4%"></td>
                <td width="48%"><input type="text" name="lname" id="lname" placeholder="Last Name" class="txt1" title="Last Name"></td>
            </tr>
            <tr>
            	<td><input type="text" name="emailid" id="emailid" placeholder="Email Id" class="txt1" title="Email Id"></td>
                <td></td>
                <td><input type="text" name="mobileno" id="mobileno" placeholder="Mobile Number" class="txt1" title="Mobile Number"></td>
            </tr>
            <?php if(isset($ref[0])){ ?>
            <tr>
            	<td><input type="submit" class="btnsubmit login-btn" value="<? if(!empty($result[0]['submit_button_title'])){
            			echo $result[0]['submit_button_title'];
            	}else{
            		echo "Take A Free Tour";
            	}?>"></td>
                <td></td>
                <td></td>
            </tr>
            <?php } ?>
        </table>
        </form>
    </div>
</div>
<?php } ?>
<a href="#" class="tubular-mute">Mute</a> 
</body>
</html>
<script>
	$(document).ready(function(e) {
        $('#textbody').perfectScrollbar({
			suppressScrollX: true,
			scrollYMarginOffset: 20
		});
		var vmute=$('#mute').val();
		var videocode=$('#videocode').val();
		if(videocode==''){
			return false;
		}
		if(vmute=='false'){
			var options = { videoId: videocode, start: 3,mute:false };
		}
		else{
			var options = { videoId: videocode, start: 3,mute:true };
		}
		$('#wrapper').tubular(options);
    });
</script>
<style>
.marqdiv{
	  z-index:9999;
	  position:absolute;
	  margin-top:-120px;
	  font-weight:600;
	  background: rgba(0, 0, 0, .5);
	  width:100%;
  }
  .marqdiv h4{
	margin-bottom:10px;
	margin-left:10px;
	color:#FFF;
	position: absolute;
	background: rgb(0, 0, 0) none repeat scroll 0% 0%;
	padding: 18px;
	top: -19px;
	z-index:9999;
  }
  marquee h3{
	  color:#FFF;
  }
*{
	margin:0px;
	padding:0px;
}
.header{
	position:relative !important;
	z-index:9999 !important;
	position:fixed !important;
	width:100% !important;
	background-size: 100%;
}
.headerimg{
	  background: url(<?=$result[0]['headerimg']?>) no-repeat center center;
  	  background-size: 100%;
}
.headercolor{
	background:none repeat scroll 0% 0% rgba(<?=$headercolor[0]?>, <?=$headercolor[1]?>, <?=$headercolor[2]?>, 0.7);
}

.header > h1{
	padding:20px !important;
	color:#<?=$result[0]['headertxt_color']?> !important;
	text-align:center !important;
}
.tubular-mute{
	z-index: 9999;
	position:fixed;
	right: 0;
	bottom: 0;
	background:none repeat scroll 0% 0% rgba(255, 255, 255, 0.7);
	color:#000;
	padding:2px 3px;
	font-size:13px;
}
.tubular-mute:hover{
	color:#000;
}
.textbody{
	height:180px;
	overflow:hidden;
	position:relative;
	padding-right:10px;
}

.formmain {
	position: absolute;
	top: 0px;
	left: 2%;
	z-index: 999;
	color: #FFF;
	background: none repeat scroll 0% 0% rgba(0, 0, 0, 0.5);
	padding: 60px;
	padding-top:20px;
	width: 400px;
	height: 400px;
	min-height:3000px;
	text-align: center;
}
.txt1{
	background-color:<?=$result[0]['form_field_bg_color']?>;
	border:#FFF solid 1px;
	height:27px;
	color:<?=$result[0]['form_text_color']?>;
	padding:3px;
	font-weight:bold;
	width:99%;
	margin:5px 0px;
}
.txt2{
	background-color:#fff;
	border:#FFF solid 1px;
	height:27px;
	color:#000;
	padding:3px;
	font-weight:bold;
	width:48%;
	margin:5px 0px;
}
.btnsubmit{
	background:<?=$result[0]['form_btn_color']?>;
	border:#FFF solid 1px;
	color:#000;
	font-weight:bold;
	padding:5px 8px;
	cursor:pointer;
}
.container{
	width:960px;
	margin:auto;
	position:relative;
	margin-top:79px;
	z-index:1000;
	padding:20px;
}
.boximg{
	  background: url(<?=$result[0]['box_bg_img']?>) no-repeat center center;
  	  background-size: 100%;
}
.boxcolor{
	background:none repeat scroll 0% 0% rgba(<?=$box_bg_color[0]?>, <?=$box_bg_color[1]?>, <?=$box_bg_color[2]?>, 0.7);
}

.videodiv{
	position:relative;
	margin:auto;
	margin-top:20px;	
}
.mflat_screen
{
	width:615px;
	height:400px;
	background: url('<?=base_url();?>asset/capturepages/mflat_screen.png')no-repeat;
}
.mflat_screen .videoinner
{
	position: absolute !important;
	width: 596px !important;
	height: 335px !important;
	left: 10px !important;
	top: 10px !important;
}
.miphone
{
	width:627px;
	height:300px;
	background: url('<?=base_url();?>asset/capturepages/miphone.png')no-repeat;
}
.miphone .videoinner
{
	position: absolute !important;
	width: 450px !important;
	height: 251px !important;
	left: 89px !important;
	top: 24px !important;
}
.mipad
{
	width:680px;
	height:480px;
	background: url('<?=base_url();?>asset/capturepages/mipad.png')no-repeat;
}
.mipad .videoinner
{
	position: absolute !important;
	width: 562px !important;
	height: 422px !important;
	left: 58px !important;
	top: 29px !important;
	
}
.mimac
{
	width:703px;
	height:560px;
	background: url('<?=base_url();?>asset/capturepages/mimac.png')no-repeat;
}
.mimac .videoinner
{
    position: absolute !important;
    width: 631px !important;
    height: 358px !important;
    left: 37px !important;
    top: 28px !important;
}
.macbook_pro
{
	width:703px;
	height:560px;
	position: absolute;
	left: 10%;
	background-position: center;
	background: url('<?=base_url();?>asset/capturepages/macbook_pro.png')no-repeat;
	background-size: 80%;
}
.macbook_pro .videoinner
{
    position: absolute !important;
    width: 410px !important;
    height: 270px !important;
    left: 10px !important;
    top: 0px !important;
}

.samsung_white
{
	width:703px;
	height:560px;
	position: absolute;
	left: 10%;
	background-position: center;
	background: url('<?=base_url();?>asset/capturepages/samsung_white.png')no-repeat;
	background-size: 80%;
}
.samsung_white .videoinner
{
    position: absolute !important;
    width: 470px !important;
    height: 265px !important;
    left: 10px !important;
	left: -20px !important;
    top: 0px !important;
}
.iphone_black
{
	width:703px;
	height:560px;
	position: absolute;
	left: 10%;
	background-position: center;
	background: url('<?=base_url();?>asset/capturepages/IPhone6_black_front.png')no-repeat;
	background-size: 80%;
}
.iphone_black .videoinner
{
    position: absolute !important;
    width: 405px !important;
    height: 230px !important;
	left: 20px !important;
    top: 20px !important;
}
.formdiv{
	width:960px;
	margin:auto;
	background-color:#09F;
	position:relative;
	z-index:9999;
	
	background:none repeat scroll 0% 0% rgba(<?=$form_bg_color[0]?>, <?=$form_bg_color[1]?>, <?=$form_bg_color[2]?>, 0.7);
	bottom:0px;
	
}
.formdiv .forminner{
	margin:auto;
	padding:20px 10px;
}
.containdiv{
	margin-top:20px;
	position:relative;
}
.min_height{
	min-height:270px;
}
</style>
