<?php  

	 $autoplay_state_3 = $result[0]['page_bg_video_autoplay_3'];
	 $autoplay_state = $result[0]['page_bg_video_autoplay'];
	
	if($result[0]['page_bg_img']==''){
		if($result[0]['page_bg_video']!=''){
			$page_bg_img = $result[0]['page_bg_video'];
		} else{
			$page_bg_img=''.base_url().'asset/capturepages/page6.jpg';
		}
	}
	else{
		$page_bg_img=$result[0]['page_bg_img'];
	}
	
	if($result[0]['page_bg_video_mute']=='Y'){$mute='true';}
	else{$mute='false';}
?>
<?php
      	
      	if($result[0]['page_bg_video']!=''){
			$autoplay_state_3 = $result[0]['page_bg_video_autoplay_3'] == 'Y' ? '1' : '0';
			
			$mute = $result[0]['page_bg_video_mute'] == 'Y' ? '1' : '0';
			
			if (strpos($result[0]['page_bg_video'], 'youtube') !== false){
				echo '<iframe style="width:100%; height:100vh;" src="'.convertYoutube($result[0]['page_bg_video'], false, $autoplay_state_3,$mute).'&rel=0&showinfo=0&controls=0&iv_load_policy=" frameborder="0" allowfullscreen></iframe>';
			}
			else{
				echo '<video style="width:100%; height:100vh;" controls autoplay><source src="'.$result[0]['page_bg_video'].'" type="video/mp4"></video>';
			}
	   }

		//var_dump($result[0]['video_url2']);
	?>
<style>
body{
	overflow:hidden;
	<?php if($result[0]['page_bg_video']!='') {?>
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
<title>Registration</title>

<meta property="og:title" content="Affiliworx" />
<meta property="og:image" content="<?=$page_bg_img?>" />
<?php if($result[0]['main_body_text']!=''){?>
	<meta property="og:description" content="" />
<?php } ?>

<!-- GOOGLE FONT -->
<link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:500,700" rel="stylesheet">
<!-- ALL CSS FILES -->
<link href="<?=base_url();?>asset/css/materialize.css" rel="stylesheet">
<link href="<?=base_url();?>asset/css/style.css" rel="stylesheet">
<link href="<?=base_url();?>asset/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>asset/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
<link href="<?=base_url();?>asset/css/responsive.css" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<!--SCRIPT FILES-->
<script src="<?=base_url();?>asset/js/jquery.min.js"></script>
<script src="<?=base_url();?>asset/js/bootstrap.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/js/materialize.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/js/custom.js"></script>

</head>
<body>
	<section class="">
		<?php  if($result[0]['scrolling']=='top'){?>
		<div class="marqdiv_top">
		    <h4>Just Joined</h4>
		     <marquee><h3><?=$current_join_mem?></h3></marquee>
		</div>
		<?php }?>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="wrapper"></div>
					<input type="hidden" id="videocode" value="<?=$videocode?>">
				   	<input type="hidden" id="mute" value="<?=$mute?>">
				  	<header class="clearfix">
				   
				    <?php if($result[0]['headline_text']!=''){
					  	$style_title=$result[0]['head_bg']=='Y'?'style="background:'.$result[0]['head_bg_col'].';color:#000;"':'';
					  	?>
					  	<h1 <?php echo $style_title; ?>><?=$result[0]['headline_text']?></h1>
					<?php } ?>

				  	</header>
				</div>
			</div>
		  	<div class="formmain hom-cre-acc-left hom-cre-acc-right">
		  
			   	<form class="form-signin" method="post" action="<?php echo base_url();?>index.php/rg/insertrecord">
				    <div class="textbody" id="textbody">
				    	<p style="text-align:justify;"><?=$result[0]['main_body_text']?></p>
				    </div>
				    <h3>Registration</h3>
		   			
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

		<!--<a href="#" class="tubular-mute">Mute</a> -->

		<?php if(strpos($page_bg_img, '.mp4')!==FALSE){ ?>
		<video autoplay <?php echo $result[0]['page_bg_video_mute']=='Y'?'muted':''; ?> loop id="myVideo">
		  <source src="<?php echo $page_bg_img; ?>" type="video/mp4">
		</video>
		<?php } ?>
	</section>
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
		// if(videocode==''){
		// 	return false;
		// }
		// if(vmute=='false'){
		// 	var options = { videoId: videocode, start: 3,mute:false };
		// }
		// else{
		// 	var options = { videoId: videocode, start: 3,mute:true };
		// }
		// $('#wrapper').tubular(options);
    });
</script>

<style>
.hom-cre-acc-right form input[type="submit"],.hom-cre-acc-right form input[type="submit"]:hover{
	background: none !important;
}
#myVideo {
    position: fixed;
    right: 0;
    bottom: 0;
    min-width: 100%; 
    min-height: 100%;
}



.marqdiv_top{
	  z-index:9999;
	  position:absolute;
	  margin-top:0px;
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
  .marquee h3{
	  color:#FFF;
	  text-align:center;
  }


.textbody{
	height:80px;
	overflow:hidden;
	position:relative;
	padding-right:10px;
	margin-top:30px;
}
.bodyvideo{
	width: <? echo get_hw_videoframe($result[0]['video_frame'])['width'];?>;
	height: <? echo get_hw_videoframe($result[0]['video_frame'])['height'];?>;
	position:absolute;
	top:158px;
	left:13%;
	background: url(<?=base_url()?>asset/capturepages/<?echo $result[0]['video_frame'];?>.png) no-repeat center center;
	background-position: center;
    background-size: cover;
}
.videoinner{
	<? echo get_hw_videoframe_inner($result[0]['video_frame']);?>
}
.llbinviter{
	color: #FFF;
}
.formmain {
	position: absolute;
	top: 0px;
	right: 2%;
	z-index: 999;
	
	padding: 20px;
	padding-top:20px;
	width: 420px;
	height: 400px;
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
.clearfix h1{
	padding:20px;
	float:left !important;
}
.hom-cre-acc-left h3,p{
	color: #FFF;
}
.hom-cre-acc-right form {
	border : none;
	background: none repeat scroll 0% 0% rgba(0, 33, 99, 0.7) !important;
}
@media  only screen and (max-width: 960px){
	body{
		background-size: 100% 100%;	
	}
	.bodyvideo {
   	width: 396px;
	height: 207px;
	margin-top:0px;
	margin-left:-70px;
	}
	.videoinner {
 margin-left: 30px;
margin-top: 10px;
height: 188px;
width: 332px;
}
}
@media  only screen and (max-width: 500px){
body{
overflow:visible;
}
.formmain {
	top:280px;
	min-height:550px;
	width: 350px;
}
.clearfix h1{
	padding:7px;
	float:right !important;
}
.bodyvideo {
  	width: 300px;
	height: 157px;
	margin-top:-40px;
	margin-left:-30px;
}
.videoinner {
 	margin-left: 23px;
	margin-top: 7px;
	height: 143px;
	width: 252px;
}
.textbody {
   
    margin-top:-5px;
}
.marqdiv_left{
	display:none;
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


<?php 
$status = trim($result[0]['page_bg_video_autoplay_3']); 
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