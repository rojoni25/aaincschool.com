<?php
	if($result[0]['page_bg_img']==''){
		$page_bg_img=''.base_url().'asset/capturepages/page6/bg.jpg';
	}
	else{
		$page_bg_img=$result[0]['page_bg_img'];
	}
	
	if($result[0]['video_frame']=='mimac'){ $video_frame='mimac'; }
	else if($result[0]['video_frame']=='mflat_screen'){ $video_frame='mflat_screen'; }
	else if($result[0]['video_frame']=='miphone'){ $video_frame='miphone'; }
	else if($result[0]['video_frame']=='flat_monitor'){ $video_frame='flat_monitor'; }
	else if($result[0]['video_frame']=='macbook_pro'){ $video_frame='macbook_pro'; }
	else{ $video_frame='mipad';  }
	
	if($result[0]['form_align']=='L'){
		$formmain_aling		=	'formmain_left';
		$video_aling		=	'video_right';
		$heading_align		=	'right';
	}else{
		$formmain_aling		=	'formmain_right';
		$video_aling		=	'video_left';
		$heading_align		=	'left';
	}
	
?>
<style>
body, html {
	overflow: hidden;
	
	background: url('<?=$page_bg_img?>') no-repeat center center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
	background-color:#<?=$result[0]['bg_color']?>
}

</style>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration</title>
<meta property="og:title" content="NLLSYS" />
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
</head>
<body>

<?php
	$form_bg = hex2rgb($result[0]['form_bg_color']);
	
?>
<div class="container">
  <header class="clearfix">
    <?php  if($result[0]['headline_text']!=''){?>
    <h1 style="background:none repeat scroll 0% 0% rgba(<?=$form_bg[0]?>, <?=$form_bg[1]?>, <?=$form_bg[2]?>, 0.7);color:#002163;float:<?=$heading_align?>">
      <?=$result[0]['headline_text']?>
    </h1>
    <?php } ?>
  </header>
  <div class="formmain <?=$formmain_aling?>">
    <div class="textbody" id="textbody">
      <p style="text-align:justify;">
        <?=$result[0]['main_body_text']?>
      </p>
    </div>
    <h3>Registration</h3>
    <form class="form-signin" method="post" action="<?php echo base_url();?>index.php/rg/insertrecord">
      <?php if($smfund){ echo '<input type="hidden" name="smfund" value="Y"/>'; } ?>
      <input  type="hidden" id="referralid" name="referralid" value="<?=$ref[0]['usercode']?>"/>
      <input  type="hidden" id="referralusername" name="referralusername" value="<?=$ref[0]['username']?>"/>
      <input  type="hidden"  id="baseurl" value="<?=base_url();?>"/>
      <input  type="hidden" id="pagecode" name="pagecode" value="<?=$pagecode?>"/>
      <input  type="hidden" name="redirect_url"  id="redirect_url" anme value="<?=$result[0]['redirect_url']?>"/>
      <input type="hidden" name="m2m_page" value="Y">
      <p class="llbinviter">Your Inviter :
        <label>
          <?=$ref[0]['fname']?>
          <?=$ref[0]['lname']?>
        </label>
      </p>
      <p>
        <input type="text" name="fname" id="fname" placeholder="First Name" class="txt1" title="First Name">
      </p>
      <p>
        <input type="text" name="lname" id="lname" placeholder="Last Name" class="txt1" title="Last Name">
      </p>
      <p>
        <input type="text" name="emailid" id="emailid" placeholder="Email Id" class="txt1" title="Email Id">
      </p>
      <p>
        <input type="text" name="mobileno" id="mobileno" placeholder="Mobile Number" class="txt2" title="Mobile Number">
        <input type="text" name="skype" id="skype" placeholder="Skype" class="txt2" title="Skype">
      </p>
      <p>
        <input type="text" name="username" id="username" placeholder="Username" class="txt1" title="Username">
      </p>
      <p>
        <input type="password" name="password" id="password" placeholder="Password" class="txt2" title="Password">
        <input type="password" name="confirmpass" id="confirmpass" placeholder="Confirm Password" class="txt2" title="Confirm Password">
      </p>
      <?php if(isset($ref[0])){ ?>
      <p>
        <input type="submit" class="btnsubmit login-btn" value="Registration Now">
      </p>
      <?php } ?>
    </form>
  </div>
</div>

		<?php /*?><img src="<?=base_url()?>asset/capturepages/flat_monitor.png" width="600"><?php */?>

<?php 
if($result[0]['video_url']!='') { 
?>
<div class="main_video <?=$video_aling?>">
        <div class="<?=$video_frame?>">
          <div class="video_fram">
            <div class="video_inner">
              <?php if (preg_match("/(youtube|slideshare)/i", $result[0]['video_url'])){ ?>
            		<iframe width="100%" height="100%" src="<?=$result[0]['video_url']?>" frameborder="0" allowfullscreen></iframe>
              <?php } else {?>
              <video width="100%" height="100%" controls>
                <source src="<?=$result[0]['video_url']?>" type="video/mp4">
              </video>
              <?php } ?>
            </div>
          </div>
        </div>
</div>
<?php } ?>
</body>
</html><script>
	$(document).ready(function(e) {
        $('#textbody').perfectScrollbar({
			suppressScrollX: true,
			scrollYMarginOffset: 20
		});
    });
</script>


<style>
.main_video{
	float:left;
	margin-left:10%;
}
.marqdiv_top {
	z-index: 9999;
	position: absolute;
	margin-top: 0px;
	font-weight: 600;
	background: rgba(0, 0, 0, .5);
	width: 100%;
}
.marqdiv_top h4 {
	margin-bottom: 10px;
	margin-left: 10px;
	color: #FFF;
	position: absolute;
	background: rgb(0, 0, 0) none repeat scroll 0% 0%;
	padding: 18px;
	top: -19px;
	z-index: 9999;
}
marquee h3 {
	color: #FFF;
	text-align: center;
}
.textbody {
	height: 80px;
	overflow: hidden;
	position: relative;
	padding-right: 10px;
	margin-top: 30px;
}
.mimac .video_fram {
	position: relative;
	width: 500px;
	height: 398.238px;
	margin: auto;
 	background: url(<?=base_url()?>asset/capturepages/mimac.png) no-repeat center center;
	background-position: center;
	background-size: cover;
	margin-top: 20px;
}
.mimac .video_inner {
	width: 451px;
	height: 256px;
	position: relative;
	top: 19px;
	left: 25px;
}
.mflat_screen .video_fram {
	position: relative;
	width: 500px;
	height: 325.2px;
	margin: auto;
	background: url(<?=base_url()?>asset/capturepages/mflat_screen.png) no-repeat center center;
	background-position: center;
	background-size: cover;
	margin-top: 20px;
}
.mflat_screen .video_inner {
	width: 484px;
	height: 273px;
	position: relative;
	top: 8px;
	left: 8px;
}
.miphone .video_fram {
	position: relative;
	width: 580px;
	height: 277.5px;
	margin: auto;
 background: url(<?=base_url()?>asset/capturepages/miphone.png) no-repeat center center;
	background-position: center;
	background-size: cover;
	margin-top: 20px;
}
.miphone .video_inner {
	width: 415px;
	height: 235px;
	position: relative;
	top: 21px;
	left: 84px;
	
}
.mipad .video_fram {
	position: relative;
	width: 500px;
	height: 352.982px;
	margin: auto;
 background: url(<?=base_url()?>asset/capturepages/mipad.png) no-repeat center center;
	background-position: center;
	background-size: cover;
	margin-top: 20px;
}
.mipad .video_inner {
	width: 414px;
	height: 311px;
	position: relative;
	top: 21px;
	left: 42px;
	
}
.macbook_pro .video_fram {
	position: relative;
	width: 600px;
	height: 354.7px;
	margin: auto;
 background: url(<?=base_url()?>asset/capturepages/macbook_pro.png) no-repeat center center;
	background-position: center;
	background-size: cover;
	margin-top: 20px;
}
.macbook_pro .video_inner {
	width: 442px;
	height: 278px;
	position: relative;
	top: 25px;
	left: 79px;
	
}
.flat_monitor .video_fram {
	position: relative;
	width: 500px;
	height: 411.517px;
	margin: auto;
	background: url(<?=base_url()?>asset/capturepages/flat_monitor.png) no-repeat center center;
	background-position: center;
	background-size: cover;
	margin-top: 20px;
}
.flat_monitor .video_inner {
	width: 469px;
	height: 296px;
	position: relative;
	top: 16px;
	left: 16px;
	
}
.formmain {
	position: absolute;
	top: 0px;
	right: 2%;
	z-index: 999;
	color: #FFF;
	background: none repeat scroll 0% 0% rgba(<?=$form_bg[0]?>, <?=$form_bg[1]?>, <?=$form_bg[2]?>, 0.7);
	padding: 20px;
	padding-top: 20px;
	width: 300px;
	height: 400px;
	min-height: 3000px;
	text-align: center;
}
.formmain_left{
	left: 2%;
}
.formmain_right{
	right: 2%;
}

.video_left{
	float: left;
	margin-left: 10%;
}
.video_right{
	float: right;
	margin-right: 10%;	
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
.clearfix h1 {
	padding: 20px;
}

@media only screen and (max-width: 960px) {
body {
	background-size: 100% 100%;
}
.bodyvideo {
	width: 396px;
	height: 207px;
	margin-top: 0px;
	margin-left: -70px;
}
.videoinner {
	margin-left: 30px;
	margin-top: 10px;
	height: 188px;
	width: 332px;
}
}
@media only screen and (max-width: 500px) {
body {
	overflow: visible;
}
.formmain {
	top: 280px;
	min-height: 550px;
}
.clearfix h1 {
	padding: 7px;
	float: right !important;
}
.bodyvideo {
	width: 300px;
	height: 157px;
	margin-top: -40px;
	margin-left: -30px;
}
.videoinner {
	margin-left: 23px;
	margin-top: 7px;
	height: 143px;
	width: 252px;
}
.textbody {
	margin-top: -5px;
}
.marqdiv_left {
	display: none;
}
}
</style>


