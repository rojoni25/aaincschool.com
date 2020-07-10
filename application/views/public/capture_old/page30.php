<?php
	if($result[0]['page_bg_img']==''){
		$page_bg_img=''.base_url().'asset/capturepages/page25/bg.jpg';
	}
	else{
		$page_bg_img=$result[0]['page_bg_img'];
	}
	if($result[0]['page_bg_video_mute']=='Y'){$mute='true';}
	else{$mute='false';}
?>

<style>

body{
	<?php if($result[0]['page_bg_video']=='') {?>
			background: url('<?=$page_bg_img?>') no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
	<?php } ?>
	

	}
</style>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Registration</title>
<link href="<?=base_url()?>asset/capturepages/page25/style.css" rel="stylesheet" type="text/css">
<script src="<?=base_url();?>asset/js/jquery.js"></script>
<script src="<?=base_url();?>asset/js/capture_js.js"></script>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<script type="text/javascript" charset="utf-8" src="<?=base_url();?>asset/capturepages/video_bg/jquery.tubular.1.0.js"></script>
<script src="<?=base_url();?>asset/capturepages/perfect-scrollbar.js"></script>

<meta name="description" content="Opp">
</head>
<body>
	<?php
	  // $videocode='';
	  // if($result[0]['page_bg_video']!='')
	  // {
			// if (strpos($result[0]['page_bg_video'], 'youtube') !== false)
			// {
			// 	if (strpos($result[0]['page_bg_video'], 'embed') !== false)
			// 	{
			// 		$u=explode('/',$result[0]['page_bg_video']);
			// 		$u=explode('?',$u[4]);
			// 		$videocode=$u[0];
			// 	}
			// 	else
			// 	{
			// 		$u=explode('=',$result[0]['page_bg_video']);
			// 		$videocode=$u[1];
			// 	}	
				
			// }
	  //  }


$autoplay_state = $result[0]['page_bg_video_autoplay'];

		if($result[0]['page_bg_video']!=''){
			$autoplay_state = $result[0]['page_bg_video_autoplay'] == 'Y' ? Y : N;
			if (strpos($result[0]['page_bg_video'], 'youtube') !== false){
				echo '<iframe style="width:100%; height:100vh;" src="'.convertYoutube($result[0]['page_bg_video'], N, $autoplay_state).'" frameborder="0" allowfullscreen></iframe>';
			}
			else{
				echo '<video style="width:100%; height:100vh;" controls autoplay><source src="'.$result[0]['page_bg_video'].'" type="video/mp4"></video>';
			}
	   }
      	
	?>
<?php  if($result[0]['scrolling']=='top'){?>
<div class="marqdiv_top">
    <h4>Just Joined</h4>
     <marquee><h3><?=$current_join_mem?></h3></marquee>
</div>
<?php }?>
<?php  if($result[0]['scrolling']=='left'){?>

<!--<div class="marqdiv_left">
    <h4>Just Joined</h4>
     <marquee loop="infinite" behavior="scroll" direction="up" scrollamount="3" height="650">
     <h3><?=$current_join?></h3>
     </marquee>
</div> 
--><?php }?>  

<div id="wrapper">
	
</div>

<input type="hidden" id="videocode" value="<?=$videocode?>">
<input type="hidden" id="mute" value="<?=$mute?>">

<form method="POST" style="position: fixed; top: 0;" action="<?php echo base_url();?>index.php/rg/insertrecord" id="form-signin">
	<?php if($smfund){ echo '<input type="hidden" name="smfund" value="Y"/>'; } ?>
    
  <input  type="hidden" id="referralid" name="referralid" value="<?=$ref[0]['usercode']?>"/>
  <input  type="hidden" id="referralusername" name="referralusername" value="<?=$ref[0]['username']?>"/>
  <input  type="hidden"  id="baseurl" value="<?=base_url();?>"/>
  <input  type="hidden" id="pagecode" name="pagecode" value="<?=$pagecode?>"/>
  <input  type="hidden" name="redirect_url"  id="redirect_url" anme value="<?=$result[0]['redirect_url']?>"/>
  
 
  
  <div id="main_area">
    <div id="main_area_content">

      <h1 class="mainHeadline"><img src="<?=base_url()?>asset/capturepages/page25/head_img.png" alt=""></h1>
      <br>

        <?php if($result[0]['headline_text']!=''){
	  	$style_title=$result[0]['head_bg']=='Y'?'style="background:'.$result[0]['head_bg_col'].';color:#000;"':'';
	  	?>
	  		<h2 class="subHeadline" <?php echo $style_title; ?>><?=$result[0]['headline_text']?></h2>
		<?php } ?>
    
      <div id="optinArea">
        <p class="optinHeadline">YOUR INVITOR:&nbsp;
          <?=$ref[0]['fname']?>
          <?=$ref[0]['lname']?>
        </p>
        <input  class="bg_name opst"  type="text" name="fname" id="fname" value="" placeholder="First Name">
        <input  class="bg_name opst"  type="text" name="lname" id="lname" value="" placeholder="Last Name">
        <input  class="emailtxt bg_email" type="text" name="emailid" id="emailid" value="" placeholder="Email">
        <input  class="mobiletxt bg_mobile" type="text" name="mobileno" id="mobileno" value="" placeholder="Mobile No">
        <input  class="skypetxt bg_sykpe" type="text" name="skype" id="skype" value="" placeholder="Skype">
        <input  class="unametxt bg_usename" type="text" name="username" id="username" value="" placeholder="Username">
        <input  class="passtxt" type="password" name="password" id="password" value="" placeholder="Password">
        <input  class="cpasstxt" type="password" name="confirmpass" id="confirmpass" value="" placeholder="Confirm Password">
        <?php if(isset($ref[0])){ ?>
        <div class="bg_sub_area"><img style="cursor: pointer;" class="btnsubmit" src="<?=base_url()?>asset/capturepages/page25/btn_sub.png" alt=""></div>
        <?php } ?>
      </div>
      <br>
    </div>
    <div id="main_area_bottom"> </div>
    <div id="footerLinks" style="margin-bottom: 30px;">© Copyright Affiliworx 2018 - All Rights Reserved</div>
  </div>
  <div style="display: none;"> </div>
</form>
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
#main_area{
	margin-left:422px;
}
.marqdiv_top{
	  z-index:9999;
	  position:absolute;
	  margin-top:0px;
	  font-weight:600;
	  background: rgba(0, 0, 0, .5);
	  width:100%;
	  padding:15px;
  }
  .marqdiv_top h4{
	margin-bottom:10px;
	margin-left:10px;
	color:#FFF;
	position: absolute;
	background: rgb(0, 0, 0) none repeat scroll 0% 0%;
	padding: 18px;
	top: 2px;
	z-index:9999;
  }
  .marquee h3{
	  color:#FFF;
  }
  .marqdiv_left{
	width:12%;
	text-align:center;
	float:left;
	background: rgba(0, 0, 0, .5);
	padding-left:10px;
	z-index:9999;
	  position:absolute;
	  margin-top:5px;

}

body{
	margin-top:-20px;
}
#main_area{
	margin-top:0px;
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
#main_area_content {
	background-image: url("<?=base_url()?>asset/capturepages/page25/bg25.png");
	background-repeat: repeat-y;
	padding: 20px 45px 5px;
    opacity: 0.8;
}
.bg_name {
	background-image: url("<?=base_url()?>asset/capturepages/page25/name.png");
	background-repeat: no-repeat;
	background-position: 100% 50%;
}
.bg_email {
	background-image: url("<?=base_url()?>asset/capturepages/page25/email.png");
	background-repeat: no-repeat;
	background-position: 99% 50%;
}
.bg_mobile {
	background-image: url("<?=base_url()?>asset/capturepages/page25/phone.png");
	background-repeat: no-repeat;
	background-position: 100% 50%;
}
.bg_sykpe {
	background-image: url("<?=base_url()?>asset/capturepages/page25/skype.png");
	background-repeat: no-repeat;
	background-position: 99% 50%;
}
.bg_usename {
	background-image: url("<?=base_url()?>asset/capturepages/page25/usename.png");
	background-repeat: no-repeat;
	background-position: 99% 50%;
}
.bg_sub_area {
	font-size: 18px !important;
	display: block;
	padding: 0px 20px 0px 20px;
	width: 333px;
	margin-top: 19px;
	text-align: center;
	
}
@media  only screen and (max-width: 960px){
	#main_area {
    margin-left: 150px;
}
}
@media  only screen and (max-width: 500px){
#main_area {
    margin-left: -63px;
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