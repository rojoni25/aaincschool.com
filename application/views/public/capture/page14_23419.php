<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Now</title>

<meta property="og:title" content="Affiliworx" />
<meta property="og:image" content="<?=$page_bg_img?>" />
<?php if($result[0]['main_body_text']!=''){?>
	<meta property="og:description" content="" />
<?php } ?>

<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/capturepages/page1/default.css" />
<!-- <script language="javascript" type="text/javascript" src="jquery-1.8.2.js"></script> -->
<script src="<?=base_url();?>asset/js/jquery.js"></script>
<link href="<?=base_url();?>asset/capturepages/perfect-scrollbar.css" rel="stylesheet">
<script src="<?=base_url();?>asset/capturepages/perfect-scrollbar.js"></script>

<script src="<?=base_url();?>asset/js/capture_js.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/css/capture_css.css" />
<script type="text/javascript" charset="utf-8" src="<?=base_url();?>asset/capturepages/video_bg/jquery.tubular.1.0.js"></script>

	<?php
    $autoplay_state = $result[0]['page_bg_video_autoplay'] == 'Y' ? '1' : '0';
    $mute = $result[0]['page_bg_video_mute'] == 'Y' ? '1' : '0';

    if($result[0]['video_url1']!=''){
      //$autoplay_state = $result[0]['page_bg_video_autoplay'] == 'Y' ? ture : false;
      if ($autoplay_state=='0' && strpos($result[0]['video_url1'], 'youtube') !== false){
        echo '<iframe style="width:100%; height:100vh;" src="'.convertYoutube($result[0]['video_url1'], false, $autoplay_state,$mute).'" frameborder="0" allowfullscreen></iframe>';
      }
      elseif($autoplay_state=='1' && strpos($result[0]['video_url1'], 'youtube') !== false){
        //echo '<video width="100%" height="100%" controls autolay><source src="'.$result[0]['video_url1'].'" type="video/mp4"></video>';
      $you_url = end(explode("/", $result[0]['video_url1']));


      //////////////////// FOR YOUTUBE ////////////////////
    if (strpos($result[0]['video_url1'], 'youtube') !== false){
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
    echo '<video id="vid" style="width:100%; height:100vh;" controls><source src="'.$result[0]['video_url1'].'" type="video/mp4" allow="autoplay"></video>';
    if($autoplay_state=='1' && $mute=='1'){ ?>
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
		overflow:hidden;
		

	}
</style>


<!-- play and pause video -->
<!-- <script>
	$(document).ready(function(e) {
		localStorage.setItem("flag", true);
		$("#overlay").click(function(){
			console.log(localStorage.getItem("flag"));
			if(localStorage.getItem("flag") == "true"){
				$(".tubular-pause").click();
				localStorage.setItem("flag", false);
				console.log("if");

			}else{
			
			console.log("else");
				$(".tubular-play").click();
				localStorage.setItem("flag", true);

				
			}
			
		});
	});
		</script>
 -->


		<!--End play and pause video -->
</head>

<body>

<!-- play and pause video -->
	<!-- <div id="overlay" style="
    width: 100%;
    height: 100vh;
    position: fixed;
    z-index: 36;
"></div>


<a class="tubular-play"> play</a>
<a class="tubular-pause">pause</a> -->

<!--End play and pause video -->
<?php 
$status = trim($result[0]['page_bg_video_autoplay']); 
$string = preg_replace('/\s+/', '', $status);
$new = str_replace(" ", "", $string);
?>
<script type="text/javascript">
<?php 
	if ($new=="Y") { ?>
$('video').get(0).play();
<?php 	} else{ ?>
$('video').get(0).pause();
<?php } ?>
</script>

<?php  if($result[0]['scrolling']=='top'){?>

<div class="marqdiv_top">
    <h4>Just Joined</h4>
     <marquee><h3><?=$current_join_mem?></h3></marquee>
</div>
<?php }?>
<div class="container">
  <div id="wrapper"></div>
  <input type="hidden" id="videocode">
  <input type="hidden" id="mute" value="<?=$mute?>">
  <input type="hidden" id="page_bg_video_autoplay" name="page_bg_video_autoplay" value="<?=$autoplay_state?>">
  <header class="clearfix">
    <?php  if($result[0]['headline_text']!=''){
	  	$style_title=$result[0]['head_bg']=='Y'?'style="background:'.$result[0]['head_bg_col'].';color:#000;"':'';
	  	?>
	  		<h1 <?php echo $style_title; ?>><?=$result[0]['headline_text']?></h1>
	<?php } ?>
  </header>

  <div class="formmain">
  	<div class="textbody" id="textbody">
    	<p style="text-align:justify;"><?=$result[0]['main_body_text']?></p>
    </div>
    <h3>Registration</h3>
    	<form class="form-signin" method="post" action="<?php echo base_url();?>index.php/rg/insertrecord">
        	
            <?php if($smfund){ echo '<input type="hidden" name="smfund" value="Y"/>'; } ?>
            
    	 	<input  type="hidden" id="referralid" name="referralid" value="<?=$ref[0]['usercode']?>"/>
         	<input  type="hidden" id="referralusername" name="referralusername" value="<?=$ref[0]['username']?>"/>
         	<input  type="hidden"  id="baseurl" value="<?=base_url();?>"/>
            <input  type="hidden" id="pagecode" name="pagecode" value="<?=$pagecode?>"/>
            <input  type="hidden" name="redirect_url"  id="redirect_url" anme value="<?=$result[0]['redirect_url']?>"/>
           
        <p class="llbinviter">Your Inviter:<label>&nbsp;<?=$ref[0]['fname']?> <?=$ref[0]['lname']?></label></p>    
        <p><input type="text" name="fname" id="fname" placeholder="First Name" class="txt1" title="First Name"></p>
        <p><input type="text" name="lname" id="lname" placeholder="Last Name" class="txt1" title="Last Name"></p>
        <p><input type="text" name="emailid" id="emailid" placeholder="Email Id" class="txt1" title="Email Id"></p>
        <p><input type="text" name="mobileno" id="mobileno" placeholder="Mobile Number" class="txt2" title="Mobile Number">
        	<input type="text" name="skype" id="skype" placeholder="Skype" class="txt2" title="Skype">
        </p>
        <p><input type="text" name="username" id="username" placeholder="Username" class="txt1" title="Username"></p>
        <p><input type="password" name="password" id="password" placeholder="Password" class="txt2" title="Password">
           <input type="password" name="confirmpass" id="confirmpass" placeholder="Confirm Password" class="txt2" title="Confirm Password">
        </p>
        <?php if(isset($ref[0])){ ?>
        	<p><input type="submit" class="btnsubmit" value="<? if(!empty($result[0]['submit_button_title'])){
            			echo $result[0]['submit_button_title'];
            	}else{
            		echo "Take A Free Tour";
            	}?>"></p>
        <?php } ?>
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
<a href="#" class="tubular-mute">Mute</a> 
</body>
</html>
<script>
	$(document).ready(function(e) {
        $('#textbody').perfectScrollbar({
			suppressScrollX: true,
			scrollYMarginOffset: 20
		});
		
		
		// var vmute=$('#mute').val();
		// var videocode=$('#videocode').val();
		// if(vmute=='false'){
		// 	var options = { videoId: videocode, start: 3,mute:false,repeat: true };
		// }
		// else{
		// 	var options = { videoId: videocode, start: 3,mute:true,repeat: true };
		// }
		
		// $('#wrapper').tubular(options);
  //   });
</script>
<style>
.marqdiv_top{
	  z-index:9999;
	  position:absolute;
	  margin-top:0px;
	  font-weight:600;
	  background: rgba(255, 255, 255, 0.7);
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
.marquee h3{
	  color:#000;
	  text-align:center;
  }
  
 .marqdiv_left marquee h3{
	  color:#fff;
	  text-align:center;
  }
.tubular-mute{
	z-index: 9999;
	position: absolute;
	left: 20px;
	bottom: 20px;
	background: none repeat scroll 0% 0% rgba(255, 255, 255, 0.7);
	color: #000;
	padding: 5px 10px;
	font-size: 16px;
	font-weight: 700;
}
.tubular-mute:hover{
	color:#000;
}
.textbody{
	height:80px;
	overflow:hidden;
	position:relative;
	padding-right:10px;
	margin-top:30px;
}
.container > header{
	right:1%;
}
.container > header h1{
	margin-top:20px;
}
.formmain {
	position: absolute;
	top: 0px;
	left: 2%;
	z-index: 999;
	color: #FFF;
	background: none repeat scroll 0% 0% rgba(0, 0, 0, 0.5);
	padding: 20px;
	padding-top:20px;
	width: 300px;
	height: 400px;
	min-height:3000px;
	text-align: center;
}
.txt1{
	background:none;
	border:#FFF solid 1px;
	height:27px;
	color:#FFF;
	padding:3px;
	font-weight:bold;
	width:99%;
	
}
.txt2{
	background:none;
	border:#FFF solid 1px;
	height:27px;
	color:#FFF;
	padding:3px;
	font-weight:bold;
	width:49%;
}
.btnsubmit{
	background:FFF;
	border:#FFF solid 1px;
	color:#F00;
	font-weight:bold;
	padding:5px;
	cursor:pointer;
}
@media  only screen and (max-width: 500px){
body{
overflow:visible;
}
.formmain {
	top: 130px;
	min-height:550px;
	right: 5%;
}
.clearfix h1{
	float:left;
}
.textbody{
	margin-top: -20px;
}
}
</style>
