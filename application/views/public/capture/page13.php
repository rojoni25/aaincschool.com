<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration</title>

<meta property="og:title" content="<?=getconfigMeta('comanyname')?>" />
<meta property="og:image" content="<?=$page_bg_img?>" />
<?php if($result[0]['main_body_text']!=''){?>
	<meta property="og:description" content="" />
<?php } ?>
<link href="<?=base_url();?>asset/css/materialize.css" rel="stylesheet">
<link href="<?=base_url();?>asset/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>asset/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/capturepages/page1/default.css" />
<!-- <script language="javascript" type="text/javascript" src="jquery-1.8.2.js"></script> -->
<script src="<?=base_url();?>asset/js/jquery.js"></script>

<link href="<?=base_url();?>asset/capturepages/perfect-scrollbar.css" rel="stylesheet">
<script src="<?=base_url();?>asset/capturepages/perfect-scrollbar.js"></script>
<script src="<?=base_url();?>asset/js/capture_js.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/css/capture_css.css" />
<!-- <script type="text/javascript" charset="utf-8" src="<?=base_url();?>asset/capturepages/video_bg/jquery.youtubebackground.js"></script> -->
<!-- <script type="text/javascript" charset="utf-8" src="<?=base_url();?>asset/capturepages/video_bg/jquery.tubular.1.0.js"></script> -->
</head>
<body>

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
    echo '<video id="vid" style="width:100%; height:100vh;" controls><source src="'.$result[0]['video_url1'].'" type="video/mp4"></video>';
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
body {
	overflow: hidden;
}
</style>
	
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
  <input type="hidden" id="autoplay" value="<?=$autoplay?>">
  <header class="clearfix" style="position:relative;z-index:9999;">
    <?php  if($result[0]['headline_text']!=''){
	  	$style_title=$result[0]['head_bg']=='Y'?'style="background:'.$result[0]['head_bg_col'].';color:#000;"':'';
	  	?>
	  		<h1 <?php echo $style_title; ?>><?=$result[0]['headline_text']?></h1>
	<?php } ?>
  </header>

    <div class="formmain hom-cre-acc-left hom-cre-acc-right">
        <form class="form-signin" method="post" action="<?php echo base_url();?>index.php/rg/insertrecord">
            <div class="textbody" id="textbody">
              <p style=""><?=$result[0]['main_body_text']?></p>
            </div>
                <?php if($smfund){ echo '<input type="hidden" name="smfund" value="Y"/>'; } ?>
                  
              <input  type="hidden" id="referralid" name="referralid" value="<?=$ref[0]['usercode']?>"/>
              <input  type="hidden" id="referralusername" name="referralusername" value="<?=$ref[0]['username']?>"/>
              <input  type="hidden"  id="baseurl" value="<?=base_url();?>"/>
                <input  type="hidden" id="pagecode" name="pagecode" value="<?=$pagecode?>"/>
                <input  type="hidden" name="redirect_url"  id="redirect_url" anme value="<?=$result[0]['redirect_url']?>"/>
                <br>
              <div class="row llbinviter">
                <div class="col s12">
                  <h4>Your Inviter:  <?=$ref[0]['fname']?> <?=$ref[0]['lname']?> </h4>
                </div>
              </div>
              <br>
            <div class="row">
              <div class="input-group input-field col s12">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input id="fname" type="text" name="fname" class="validate" required autocomplete="new-password">
                <label for="fname">First Name</label>
              </div>
            </div>
            <div class="row">
              <div class="input-group input-field col s12">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input id="lname" type="text" name="lname" class="validate" required autocomplete="new-password">
                <label for="lname">Last Name</label>
              </div>
            </div>
            <div class="row">
              <div class="input-group input-field col s12">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input id="emailid" type="email" name="emailid" class="validate" required autocomplete="new-password">
                <label for="emailid">Email Id</label>
              </div>
            </div>
            <div class="row">
              <div class="input-group input-field col s12">
                <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                <input id="mobileno" type="text" name="mobileno" class="validate" required autocomplete="new-password">
                <label for="mobileno">Mobile</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12"> 
                 <?php if(isset($ref[0])){ ?>
                        <p><input type="submit" class="waves-effect waves-light btn-large full-btn" value="<? if(!empty($result[0]['submit_button_title'])){
                            echo $result[0]['submit_button_title'];
                        }else{
                          echo "Take A Free Tour";
                        }?>"></p>
                      <?php } ?>
              </div>
            </div>
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
});

		// var vmute=$('#mute').val();
		// var autoplay=$('#autoplay').val();
		// var videocode=$('#videocode').val();


		// console.log(autoplay);
		// console.log(videocode);
		
		//alert(autoplay);

		// var options = { videoId: videocode, start: 3,mute:vmute, repeat: true, autoplay:0 };
		//  console.log(options);

		// if(vmute=='false'){
		// 	var options = { videoId: videocode, start: 3,mute:vmute, repeat: true, autoplay:autoplay };
		// }
		// else{
		// 	var options = { videoId: videocode, start: 3,mute:true, repeat: true };
		// }
		// if(autoplay=='true') {
		// 	var autoplay= { videoId: videocode, start: 3,autoplay:true, repeat: true };

		// }
		// else{
		// 	var autoplay = { videoId: videocode, start: 3,autoplay:false, repeat: true };

		// }
		// $('#wrapper').tubular(options);
		// 
    
</script>
<style>
   .hom-cre-acc-right form input[type="submit"],.hom-cre-acc-right form input[type="submit"]:hover{
    background: none !important;
  }
  .hom-cre-acc-right form input {
      height: 45px;
      position: relative;
      box-sizing: border-box;
      box-shadow: none;
      text-indent: 0px;
      line-height: 12px;
      width: 100%;
      font-size: 14px;
      padding: 5px 24px;
      border-width: 1px;
      border-style: solid;
      border-color: rgb(232, 232, 232);
      border-image: initial;
      transition: border-color 0.4s ease 0s, color 0.4s ease 0s;
      background: rgb(255, 255, 255);
  }
  .full-btn {
      height: 45px;
      line-height: 45px;
      background: #f74d40;
      background: linear-gradient(to top, #F44336, #fb5a4e);
      outline: none;
      font-size: 16px;
      display: block !important;
      color: #fff;
      font-weight: 600;
      font-family: 'Quicksand', sans-serif;
      text-transform: uppercase;
      text-align: center;
  }

  .btnsubmit{
  background:FFF;
  border:#FFF solid 1px;
  color:#F00;
  font-weight:bold;
  padding:5px;
  cursor:pointer;
}
.clearfix h1{
  padding:20px;
  float:left !important;
}
.hom-cre-acc-left h3,p{
  color: #FFF;
}
.hom-cre-acc-right form {
  border : none;
  /*background: none repeat scroll 0% 0% rgba(0, 33, 99, 0.7) !important;*/
  box-sizing: border-box;
    padding: 35px 50px 35px 50px;
}
.hom-cre-acc-right form input:focus ~ label {
}
 .cbox-res {
     width: auto !important;
}
 .hom-cre-acc-right form input:focus {
     outline: none;
}
.hom-cre-acc-right form input {
     height: 45px;
     position: relative;
     padding: 5px 24px;
     box-sizing: border-box;
     box-shadow: none;
     border: 1px solid #e8e8e8;
     text-indent: 0;
     line-height: 12px;
     -webkit-transition: border-color .4s, color .4s;
     transition: border-color .4s, color .4s;
    /* -webkit-appearance: none;
     */
     width: 100%;
     font-size: 14px;
     background: #fff;
}
.hom-cre-acc-right form select {
     height: 55px;
     position: relative;
     padding: 15px 24px;
     box-sizing: border-box;
     box-shadow: none;
     border: 1px solid #e8e8e8;
     text-indent: 0;
     line-height: 12px;
     -webkit-transition: border-color .4s, color .4s;
     transition: border-color .4s, color .4s;
    /* -webkit-appearance: none;
     */
     width: 100%;
     font-size: 15px;
     background: #fff;
}
.hom-cre-acc-right form textarea {
     height: 120px;
     position: relative;
     padding: 15px 24px;
     box-sizing: border-box;
     box-shadow: none;
     border: 1px solid #e8e8e8;
     text-indent: 0;
     line-height: 25px;
     -webkit-transition: border-color .4s, color .4s;
     transition: border-color .4s, color .4s;
    /* -webkit-appearance: none;
     */
     width: 100%;
     font-size: 15px;
     background: #fff;
}
 .hom-cre-acc-right form input[type="submit"] {
     font-size: 20px;
     border: none;
     width: 100%;
     padding: 18px;
     background: #31c6f5;
    /* color: #fff;
     */
    /* text-transform: uppercase;
     */
}
 .hom-cre-acc-right form input[type="submit"]:hover {
     background: #14addb;
}
 .blue-btn {
     color: #fff;
     background-color: #1ebef0;
     border: 1px solid #1ebef0;
     font-weight: 600;
     border-radius: 2px;
     -webkit-transition: all 0.5s ease;
     -moz-transition: all 0.5s ease;
     -o-transition: all 0.5s ease;
     transition: all 0.5s ease;
}
 .blue-btn:hover {
     background: #14addb;
     border: 1px solid #14addb;
     -webkit-transition: all 0.5s ease;
     -moz-transition: all 0.5s ease;
     -o-transition: all 0.5s ease;
     transition: all 0.5s ease;
}
 .hom-cre-acc-right form input[type="submit"] {
}
 .hom-cre-acc-right .checkbox {
     padding: 10px 0px;
}
 .hom-cre-acc-right .checkbox label {
}
.background-video {
  background-position: top center;
  background-repeat: no-repeat;
  bottom: 0;
  left: 0;
  overflow: hidden;
  position: fixed;
  right: 0;
  top: 0;
}

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
	left: 13%;
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
.textbody {
	height: 80px;
	overflow: hidden;
	position: relative;
	padding-right: 10px;
	margin-top:30px;
}
.container > header h1{
	margin-top:20px;
}
.bodyvideo {
	width: 560px;
	height: 363px;
	position: absolute;
	top: 158px;
	left: 10%;
 	background: url(<?=base_url()?>asset/capturepages/as/ipad-player.png) no-repeat center center;
	background-position: center;
	background-size: cover;
}
.videoinner {
	width: 381px;
	height: 287px;
	margin-left: 85px;
	margin-top: 36px;
}
.formmain {
	position: absolute;
	top: 0px;
	right: 2%;
	z-index: 999;
	color: #FFF;
	background: none repeat scroll 0% 0% rgba(0, 0, 0, 0.7);
	padding: 20px;
	padding-top: 20px;
	width: 420px;
	height: 400px;
	min-height: 3000px;
	text-align: center;
}
.txt1 {
	background: none;
	border: #FFF solid 1px;
	height: 27px;
	color: #FFF;
	padding: 3px;
	font-weight: bold;
	width: 99%;
}
.txt2 {
	background: none;
	border: #FFF solid 1px;
	height: 27px;
	color: #FFF;
	padding: 3px;
	font-weight: bold;
	width: 49%;
}
.btnsubmit {
	background: FFF;
	border: #FFF solid 1px;
	color: #F00;
	font-weight: bold;
	padding: 5px;
	cursor: pointer;
}
.container > header{
	left:1%;
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
	padding:7px !important;
}
.textbody{
	margin-top: -20px;
}
}
</style>


<!-- play and pause video -->
<script>
	// $(document).ready(function(e) {
	// 	localStorage.setItem("flag", true);
	// 	$("#overlay").click(function(){
	// 		console.log(localStorage.getItem("flag"));
	// 		if(localStorage.getItem("flag") == "true"){
	// 			$(".tubular-pause").click();
	// 			localStorage.setItem("flag", false);
	// 			console.log("if");

	// 		}else{
			
	// 		console.log("else");
	// 			$(".tubular-play").click();
	// 			localStorage.setItem("flag", true);
	// 		}
			
	// 	});
	// });
		</script>

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
		<!--End play and pause video -->