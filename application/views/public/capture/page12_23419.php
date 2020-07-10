<?php
	if($result[0]['page_bg_img']==''){
		$page_bg_img=''.base_url().'asset/capturepages/page12.jpg';
	}
	else{
		$page_bg_img=$result[0]['page_bg_img'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration</title>

<meta property="og:title" content="Affiliworx" />
<meta property="og:image" content="<?=$page_bg_img?>" />
<?php if($result[0]['main_body_text']!=''){?>
	<meta property="og:description" content="" />
<?php } ?>

<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/capturepages/page1/default.css" />
<script src="<?=base_url();?>asset/js/jquery.js"></script>
<script src="<?=base_url();?>asset/js/capture_js.js"></script>
</head>

<style>
body {
	background-color: #e0f5ec;
	overflow: hidden;
	background: url('<?=$page_bg_img?>') no-repeat center center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}
.bodybackground {
	width: 960px;
	margin: auto;
	height: 450px;
	background: none repeat scroll 0% 0% rgba(0, 0, 0, 0.7);
	position: relative;
}
.formdiv {
	position: absolute;
	width: 350px;
	height: 550px;
	background-color: #fff;
	right:0px;
	margin-top:-50px;
	margin-right:40px;
	-webkit-box-shadow: 9px 6px 19px -4px rgba(0,0,0,0.75);
	-moz-box-shadow: 9px 6px 19px -4px rgba(0,0,0,0.75);
	box-shadow: 9px 6px 19px -4px rgba(0,0,0,0.75);
}
.videodiv {
	width: 50%;
	height: 370px;
	border: #CCC solid 1px;
	margin-top: 40px;
	margin-left: 40px;
	float:left;
}
.heading {
	background-color: #9a2119;
	margin: 0px;
	padding: 30px 0px;
	text-align: center;
	color: #FFF;
}
.mainform {
	margin-top: 20px;
}
table {
	font-size: 14px;
	color: #000;
}
.txt1 {
	background: none;
	border: #c4d297 solid 1px;
	padding: 3px;
	width: 90%;
	margin: 3px;
}
.title_comp {
	position: absolute;
	left: 5px;
	top: -70px;
	/*background: none repeat scroll 0% 0% rgba(255, 255, 255, 0.7);*/
	padding:3px 10px;
}
.login-btn
{
	background: url('<?=base_url()?>asset/capturepages/btn12.png');
	width:112px;
	height:37px;
	border:none;
	cursor:pointer;	
}
.marqdiv_top{
	  z-index:9999;
	  position:absolute;
	  margin-top:-113px;
	  font-weight:600;
	  background: rgba(0, 0, 0, .5);
	  width:100%;
  }
  .marqdiv_top h4{
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
  .marqdiv_left{
	width:12%;
	text-align:center;
	float:left;
	background: rgba(0, 0, 0, .5);
	padding-left:10px;
	margin-top:-120px;

}
</style>
<body>
<?php $autoplay_state = $result[0]['page_bg_video_autoplay']; ?>
<?php  if($result[0]['scrolling']=='top'){?>
<div class="marqdiv_top">
    <h4>Just Joined</h4>
     <marquee><h3><?=$current_join_mem?></h3></marquee>
</div>
<?php }?>
<?php  if($result[0]['scrolling']=='left'){?>

<!--<div class="marqdiv_left">
    <h4>Just Joined</h4>
     <marquee loop="infinite" behavior="scroll" direction="up" scrollamount="3" height="630">
     <h3><?=$current_join?></h3>
     </marquee>
</div> 
--><?php }?>
<div class="bodybackground">
	<?php  if($result[0]['headline_text']!=''){
	  	$style_title=$result[0]['head_bg']=='Y'?'style="background:'.$result[0]['head_bg_col'].';color:#000;"':'';
	  	?>
	  		<h2 class="title_comp" <?php echo $style_title; ?>><?=$result[0]['headline_text']?></h2>
	<?php } ?>
 
  <div class="formdiv">
    <h2 class="heading">REGISTRATION FORM</h2>
    <div class="mainform">
     <form class="form-signin" method="post" action="<?php echo base_url();?>index.php/rg/insertrecord">
     		
            <?php if($smfund){ echo '<input type="hidden" name="smfund" value="Y"/>'; } ?>
            
    	 	<input  type="hidden" id="referralid" name="referralid" value="<?=$ref[0]['usercode']?>"/>
         	<input  type="hidden" id="referralusername" name="referralusername" value="<?=$ref[0]['username']?>"/>
         	<input  type="hidden"  id="baseurl" value="<?=base_url();?>"/>
           <input  type="hidden" id="pagecode" name="pagecode" value="<?=$pagecode?>"/>
            <input  type="hidden" name="redirect_url"  id="redirect_url" anme value="<?=$result[0]['redirect_url']?>"/>
            
           
            
      <table width="100%" cellspacing="5" cellpadding="2">
        <tr>
          <td width="30%" align="right"><font style="color:#9a2119;font-weight:bold;">Your Inviter</font></td>
          <td width="2%"></td>
          <td width="68%"><font style="color:#9a2119;font-weight:bold;"><?=$ref[0]['fname']?> <?=$ref[0]['lname']?></font></strong></td>
        </tr>
        <tr>
          <td align="right">First Name</td>
          <td></td>
          <td><input type="text" name="fname" id="fname" placeholder="First Name" class="txt1" title="First Name"></td>
        </tr>
        <tr>
          <td align="right">Last Name</td>
          <td></td>
          <td><input type="text" name="lname" id="lname" placeholder="Last Name" class="txt1" title="Last Name"></td>
        </tr>
        <tr>
          <td align="right">Email Id</td>
          <td></td>
          <td><input type="text" name="emailid" id="emailid" placeholder="Email Id" class="txt1" title="Email Id"></td>
        </tr>
        <tr>
          <td align="right">Mobile Number</td>
          <td></td>
          <td><input type="text" name="mobileno" id="mobileno" placeholder="Mobile Number" class="txt1" title="Mobile Number"></td>
        </tr>
        <tr>
          <td align="right">Skype</td>
          <td></td>
          <td><input type="text" name="skype" id="skype" placeholder="Skype" class="txt1" title="Skype"></td>
        </tr>
        <tr>
          <td align="right">Username</td>
          <td></td>
          <td><input type="text" name="username" id="username" placeholder="Username" class="txt1" title="Username"></td>
        </tr>
        <tr>
          <td align="right">Password</td>
          <td></td>
          <td><input type="password" name="password" id="password" placeholder="Password" class="txt1" title="Password"></td>
        </tr>
        <tr>
          <td align="right">Confirm</td>
          <td></td>
          <td><input type="password" name="confirmpass" id="confirmpass" placeholder="Confirm Password" class="txt1" title="Confirm Password"></td>
        </tr>
         <?php if(isset($ref[0])){ ?>
        <tr>
          <td align="right"></td>
          <td></td>
          <td><input type="submit" class="btnsubmit login-btn" value="<? if(!empty($result[0]['submit_button_title'])){
            			echo $result[0]['submit_button_title'];
            	}else{
            		echo "Take A Free Tour";
            	}?>"></td>
        </tr>
        <?php } ?>
      </table>
      </form>
      <?php  if($result[0]['scrolling']=='left'){?>
	<div class="marqdiv_left">
    <h4>Just Joined</h4>
     <marquee loop="infinite" behavior="scroll" direction="up" scrollamount="3" height="630">
     <h3><?=$current_join?></h3>
     </marquee>
	</div> 
	<?php }?>

    </div>
  </div>
   <div class="videodiv">
   	
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
    echo '<video id="vid" width="100%" height="100%" controls ><source src="'.$result[0]['video_url1'].'" type="video/mp4" allow="autoplay"></video>';
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
</div>
</body>
</html>
<script>
	$(document).ready(function(e) {
       resetall();
    });
	$(window).resize(function(){
		resetall();
	});
	function resetall(){
		var windowHeight = $(window).height();
		var wbodybackground = $('.bodybackground').height();
		var backmargin=(windowHeight-wbodybackground)/2;
		$(".bodybackground").css("margin-top",backmargin+"px");
	}
</script>
<style>
@media  only screen and (max-width: 960px){
	body{
		  background-size: 100% 100%;
	}
	.videodiv {
		width: 370px;
		height: 274px;
		margin-top: 5px;
		margin-right: 196px;
	}
.title_comp{
	float:left;
	margin-top:-100px;
	margin-left:50px;
	}
	.formdiv {
		margin-right:195px;
	}

}
@media  only screen and (max-width: 500px){
body{
overflow:visible;
}
.formdiv{
margin-top: 250px !important;
margin-right:600px;
}
.formmain {
	top:340px;
	min-height:550px;
}
.videodiv {
	width: 310px;
height: 230px;
border: 1px solid #CCC;
float: none;
margin-top: 60px;
margin-left: 10px;
}
.title_comp{
	margin-top:30px;
	}
.formdiv{
	margin-top: 10px;
	margin-left:3px;
}
}

</style>
<?php 
$status = trim($result[0]['page_bg_video_autoplay']); 
$string = preg_replace('/\s+/', '', $status);
$new = str_replace(" ", "", $string);
?>
<script type="text/javascript">
	// $(document).ready(function(){
		<?php 
			if ($new=="Y") { ?>
			$('video').get(0).play();
			<?php 	} else{ ?>
			$('video').get(0).pause();
			<?php } ?>
	// }); 

</script>