<?php

	if($result[0]['page_bg_img']==''){
		$page_bg_img=''.base_url().'asset/capturepages/small-bg.jpg';
	}
	else{
		$page_bg_img=$result[0]['page_bg_img'];
	}

	if($result[0]['video_frame']=='mimac'){ $mobile_frm='mimac'; }
	else if($result[0]['video_frame']=='mflat_screen'){ $mobile_frm='mflat_screen'; }
	else if($result[0]['video_frame']=='miphone'){ $mobile_frm='miphone'; }
	else if($result[0]['video_frame']=='flat_monitor'){ $mobile_frm='flat_monitor'; }
	else if($result[0]['video_frame']=='macbook_pro'){ $mobile_frm='macbook_pro'; }
	else{ $mobile_frm='mipad';  }
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Registration</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Mukta+Mahee" rel="stylesheet">
  <style type="text/css">
    body{
        font-family: 'Mukta Mahee', sans-serif;
        font-size: 14px;
        color: #454444;
        background:  url('https://affiliworx.com/asset/capturepages/page5.jpg') no-repeat center center fixed;
      }
      .page .myForm h1{
          color: #fff;
          text-transform: uppercase;
          font-size: 25px;
          border-right: 2px solid #fff;
          border-left: 2px solid #fff;
          margin-bottom: 20px;
      }
      .page .myForm .list-group .list-group-item{
        border: 2px solid #454444;
      }
      .page .myForm .video{
        padding-bottom:0;
        height: unset;
        margin-bottom: 20px;
      }
      .page .myForm .video .thumbnail{
        border:none;
        margin-bottom: 0;
        background: transparent;
      }
      .page .myForm .video.mflat_screen .embed-responsive-item{
        margin: 4%;
        height: 78%;
        width: 93%;
      }
      .page .myForm .video.miphone .embed-responsive-item{
          margin-top: 5%;
          margin-left: 13%;
          height: 81%;
          width: 74%;
      }
      .page .myForm .video.flat_monitor .embed-responsive-item{
          margin: 5%;
          height: 68%;
          width: 90%;
      }
      .page .myForm .video.mipad .embed-responsive-item{
          margin-top: 6%;
          margin-left: 10%;
          height: 83%;
          width: 79%;
      }
      .page .myForm .video.mimac .embed-responsive-item{
          margin: 4%;
          height: 64%;
          width: 92%;
      }
      .page .myForm .video.macbook_pro .embed-responsive-item{
          margin-top: 5%;
          margin-left: 14%;
          height: 78%;
          width: 72%;
      }
      .page .myForm .video img{
        width:100%;
      }
      .page .myForm .form-group .input-group span.input-group-addon{
          min-width: 50px;
          color: #fff;
          background: #454444;
          border: none;
      }
      .page .myForm .form-group input.form-control{
          box-shadow: none;
          border: 1px solid #454444;
      }
      .page .myForm .submit-btn{
          width: 100%;
          color: #fff;
          background: #454444;
      }
       /*==========  Mobile First Method  ==========*/

      /* Custom, iPhone Retina */ 
      @media only screen and (min-width : 320px) {
      }

      /* Extra Small Devices, Phones */ 
      @media only screen and (min-width : 480px) {
        .page .myForm .video.miphone .embed-responsive-item {
            margin-top: 4%;
            margin-left: 12%;
            height: 84%;
            width: 76%;
        }
      }

      /* Small Devices, Tablets */
      @media only screen and (min-width : 768px) {

      }

      /* Medium Devices, Desktops */
      @media only screen and (min-width : 992px) {

      }

      /* Large Devices, Wide Screens */
      @media only screen and (min-width : 1200px) {

      }
  </style>
</head>
<body>  
<div class="container page">
  <div class="row">
      <form  method="post" action="<?php echo base_url();?>index.php/rg/insertrecord" class="myForm">
        <?php if($smfund){ echo '<input type="hidden" name="smfund" value="Y"/>'; } ?>
            
        <input  type="hidden" id="referralid" name="referralid" value="<?=$ref[0]['usercode']?>"/>
        <input  type="hidden" id="referralusername" name="referralusername" value="<?=$ref[0]['username']?>"/>
        <input  type="hidden"  id="baseurl" value="<?=base_url();?>"/>
        <input  type="hidden" id="pagecode" name="pagecode" value="<?=$pagecode?>"/>
        <input  type="hidden" name="redirect_url"  id="redirect_url" anme value="<?=$result[0]['redirect_url']?>"/>


        <div class="col-xs-12 col-sm-12 col-md-12">
          <?php  if($result[0]['headline_text']!=''){?>
            <h1 class="text-center"><?=$result[0]['headline_text']?></h1>
          <?php } ?>
          <div class="well well-sm text-center">
            <h3>Registration</h3>
            <p style="text-align:justify;"><?=$result[0]['main_body_text']?></p>
          </div>
          <ul class="list-group">
            <li class="list-group-item">
              <span class="badge"><?=$ref[0]['fname']?>
            <?=$ref[0]['lname']?></span>
              Your Inviter:
            </li>
          </ul>
          <div class="embed-responsive embed-responsive-16by9 video <?php echo $mobile_frm;?>">
            <a class="thumbnail"><img src="https://affiliworx.com/asset/capturepages/<?php echo $mobile_frm;?>.png"/></a>
            <?php if (preg_match("/(youtube|slideshare)/i", $result[0]['video_url1'])){ ?>
	           <iframe class="embed-responsive-item" src="<?=convertYoutube($result[0]['video_url1'], false, $autoplay_state)?>"></iframe>
	          <?php } else {?>
	          <video width="100%" height="100%" controls="controls">
	            <source src="<?=convertYoutube($result[0]['video_url1'])?>" type="video/mp4">
	          </video>
	          <?php } ?>

          </div>
          <div class="form-group">
            <div class="input-group input-group-sm">
              <span class="input-group-addon" id="basic-addon1"><i class="fa fa-address-book" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="First Name" name="fname" id="fname" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group input-group-sm">
              <span class="input-group-addon" id="basic-addon1"><i class="fa fa-address-book" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Last Name" name="lname" id="lname" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group input-group-sm">
              <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope-open-o" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Email Id" name="emailid" id="emailid" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group input-group-sm">
              <span class="input-group-addon" id="basic-addon1"><i class="fa fa-mobile" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Mobile Number"  name="mobileno" id="mobileno" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group input-group-sm">
              <span class="input-group-addon" id="basic-addon1"><i class="fa fa-skype" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Skype" name="skype" id="skype" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group input-group-sm">
              <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Username" name="username" id="username" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group input-group-sm">
              <span class="input-group-addon" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Password" name="password" id="password" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group input-group-sm">
              <span class="input-group-addon" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Confirm Password" name="confirmpass" id="confirmpass" aria-describedby="basic-addon1">
            </div>
          </div>
          <?php if(isset($ref[0])){ ?>
            <button class="btn btn-default btn-sm submit-btn btnsubmit" type="submit" ><? if(!empty($result[0]['submit_button_title'])){
                  echo $result[0]['submit_button_title'];
              }else{
                echo "Take A Free Tour";
              }?></button>
            <?php } ?>
          
        </div>
      </form>
    </div>
</div>
<script src="<?=base_url();?>asset/js/capture_js.js"></script>
</body>
</html>

<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style></style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<link rel="stylesheet" href="<?=base_url()?>asset/css/mobile_width/rev-grid.css" media="all">
<link rel="stylesheet" href="<?=base_url()?>asset/css/mobile_width/font-awesome.min.css" media="all">
<link rel="stylesheet" href="<?=base_url()?>asset/css/mobile_width/base.css" media="all">
<link rel="stylesheet" href="<?=base_url()?>asset/css/mobile_width/first-demo.css" media="all">
<link rel="stylesheet" href="<?=base_url()?>asset/css/mobile_width/responsive.css" media="all">
<link href='//fonts.googleapis.com/css?family=Source+Sans+Pro%7cPT+Sans:300,400,600' rel='stylesheet' type='text/css'>
<script src="<?=base_url();?>asset/js/jquery.js"></script>
<script src="<?=base_url();?>asset/js/capture_js.js"></script>
<link rel="shortcut icon" href="favicon.ico">
</head>
<body>
<section class="intro">
  <div class="container">
    <div class="row">
      <div class="column-100 text-center intro-heading-block">

    <?php  if($result[0]['headline_text']!=''){
	  	$style_title=$result[0]['head_bg']=='Y'?'style="background:'.$result[0]['head_bg_col'].';color:#000;"':'';
	  	?>
	  		<h1 <?php echo $style_title; ?>><?=$result[0]['headline_text']?></h1>
	<?php } ?>

      </div>
    </div>
  </div>
</section>
<?php if($result[0]['video_url1']!='') { ?>

    <div class="<?=$mobile_frm?>">
      <div class="video_fram">
        <div class="video_inner">
          <?php if (preg_match("/(youtube|slideshare)/i", $result[0]['video_url1'])){ ?>
          <iframe width="100%" height="100%" src="<?=$result[0]['video_url1']?>" frameborder="0" allowfullscreen></iframe>
          <?php } else {?>
          <video width="100%" height="100%" controls="controls">
            <source src="<?=$result[0]['video_url1']?>" type="video/mp4">
          </video>
          <?php } ?>
        </div>
      </div>
    </div>

<?php } ?>
<div style="clear:both;overflow:hidden;"></div>
<section class="form-clients">
  <div class="container">
    <div class="row">
      <div class="column-40 form-column text-center form_div_1" style="margin:auto;">
        <form action="<?php echo base_url();?>index.php/rg/insertrecord" method="post" class="main-form" id="form-signin">
          <input  type="hidden" id="referralid" name="referralid" value="<?=$ref[0]['usercode']?>"/>
          <input  type="hidden" id="referralusername" name="referralusername" value="<?=$ref[0]['username']?>"/>
          <input  type="hidden"  id="baseurl" value="<?=base_url();?>"/>
          <input  type="hidden" id="pagecode" name="pagecode" value="<?=$pagecode?>"/>
          <input  type="hidden" name="redirect_url"  id="redirect_url" anme value="<?=$result[0]['redirect_url']?>"/>
          <p class="ref_title">Your Inviter :
            <?=$ref[0]['fname']?>
            <?=$ref[0]['lname']?>
          </p>
          <input type="text" name="fname" id="fname" required="required" placeholder="First Name" class="margin-b">
          <input type="text" name="lname" id="lname" required="required" placeholder="Last Name" class="margin-b">
          <input type="email" name="emailid" id="emailid" required="required" placeholder="Email Id" class="margin-b">
          <input type="number" name="mobileno" id="mobileno"  placeholder="Mobile No." class="txt2 pull-left margin-b">
          <input type="text" name="skype" id="skype" placeholder="Skype" class="txt2 pull-right margin-b">
          <div class="clear"></div>
          <input type="text" name="username" id="username" required="required" placeholder="Username" class="margin-b">
          <input type="password" name="password" id="password"  placeholder="Password" class="txt2 pull-left margin-b">
          <input type="password" name="confirmpass" id="confirmpass"  placeholder="Confirm Password" class="txt2 pull-right margin-b">
          <div class="clear"></div>
          <?php if(isset($ref[0])){ ?>
          <div class="submit-holder">
            <input type="submit" name="submit" id="submit" value="Submit" class="form-submit">
          </div>
          <?php } ?>
          <div class="clear"></div>
        </form>
      </div>
    </div>
    <div class="clear">&nbsp;</div>
  </div>
</section>
</body>
</html>
<style>
body {
	background: transparent url("<?=$page_bg_img?>") no-repeat fixed center center / cover;
	background-color: #CCC;
}
.mimac .video_fram {
	position: relative;
	width: 300px;
	height: 236px;
	margin: auto;
 background: url(<?=base_url()?>asset/capturepages/mimac.png) no-repeat center center;
	background-position: center;
	background-size: cover;
	margin-top: 20px;
}
.mimac .video_inner {
	width: 279px;
	height: 157px;
	position: relative;
	top: 10px;
	left: 11px;
}
.mflat_screen .video_fram {
	position: relative;
	width: 300px;
	height: 195px;
	margin: auto;
 background: url(<?=base_url()?>asset/capturepages/mflat_screen.png) no-repeat center center;
	background-position: center;
	background-size: cover;
	margin-top: 20px;
}
.mflat_screen .video_inner {
	width: 288px;
	height: 161px;
	position: relative;
	top: 6px;
	left: 7px;
}
.miphone .video_fram {
	position: relative;
	width: 320px;
	height: 151px;
	margin: auto;
 background: url(<?=base_url()?>asset/capturepages/miphone.png) no-repeat center center;
	background-position: center;
	background-size: cover;
	margin-top: 20px;
}
.miphone .video_inner {
	width: 229px;
	height: 130px;
	position: relative;
	top: 10px;
	left: 46px;
}
.mipad .video_fram {
	position: relative;
	width: 310px;
	height: 218.817px;
	margin: auto;
 background: url(<?=base_url()?>asset/capturepages/mipad.png) no-repeat center center;
	background-position: center;
	background-size: cover;
	margin-top: 20px;
}
.mipad .video_inner {
	width: 257px;
	height: 193px;
	position: relative;
	top: 13px;
	left: 26px;
}
.macbook_pro .video_fram {
	position: relative;
	width: 310px;
	height: 183.267px;
	margin: auto;
 background: url(<?=base_url()?>asset/capturepages/macbook_pro.png) no-repeat center center;
	background-position: center;
	background-size: cover;
	margin-top: 20px;
}
.macbook_pro .video_inner {
	width: 230px;
	height: 144px;
	position: relative;
	top: 11px;
	left: 41px;
}
.flat_monitor .video_fram {
	position: relative;
	width: 310px;
	height: 255.133px;
	margin: auto;
 background: url(<?=base_url()?>asset/capturepages/flat_monitor.png) no-repeat center center;
	background-position: center;
	background-size: cover;
	margin-top: 20px;
}
.flat_monitor .video_inner {
	width: 291px;
	height: 183px;
	position: relative;
	top: 11px;
	left: 10px;
}
.clear {
	clear: both;
	overflow: hidden;
}
.txt2 {
	width: 49% !important;
}
.pull-left {
	float: left;
}
.pull-right {
	float: right;
}
.margin-b {
	margin-top: 10px;
}
.form-clients {
	margin-top: 3%;
}
.ref_title {
	margin: 0px;
	color: #FFF;
	font-weight: bold;
}
</style> -->
