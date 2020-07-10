<?php 
	if($result[0]['page_bg_img']==''){
		$page_bg_img=''.base_url().'asset/capturepages/page25/bg.jpg';
	}
	else{
		$page_bg_img=$result[0]['page_bg_img'];
	}
	$audio=$result[0]['audio'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Registration</title>
<link href="<?=base_url()?>asset/capturepages/page25/style.css" rel="stylesheet" type="text/css">
<script src="<?=base_url();?>asset/js/jquery.js"></script>
<script src="<?=base_url();?>asset/js/capture_js.js"></script>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<meta name="description" content="Opp">
</head>
<body>
<style>
	body{
		
		background: url('<?=$page_bg_img?>') no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;

	}
</style>
<?php  if($result[0]['scrolling']=='top'){?>
<div class="marqdiv_top">
    <h4>Just Joined</h4>
     <marquee><h3><?=$current_join_mem?></h3></marquee>
</div>
<?php }?>
<?php  if($result[0]['scrolling']=='left'){?>
<div class="marqdiv_left">
    <h4>Just Joined</h4>
     <marquee loop="infinite" behavior="scroll" direction="up" scrollamount="3" height="300">
     <h3><?=$current_join?></h3>
     </marquee>
</div> 
<?php }?>    
<form method="POST" action="<?php echo base_url();?>index.php/rg/insertrecord" id="form-signin">
	
      <?php if($smfund){ echo '<input type="hidden" name="smfund" value="Y"/>'; } ?>
     <input  type="hidden" id="audio" name="audio" value="<?=$ref[0]['audio']?>"/> 
  <input  type="hidden" id="referralid" name="referralid" value="<?=$ref[0]['usercode']?>"/>
  <input  type="hidden" id="referralusername" name="referralusername" value="<?=$ref[0]['username']?>"/>
  <input  type="hidden"  id="baseurl" value="<?=base_url();?>"/>
  <input  type="hidden" id="pagecode" name="pagecode" value="<?=$pagecode?>"/>
  <input  type="hidden" name="redirect_url"  id="redirect_url" anme value="<?=$result[0]['redirect_url']?>"/>
  
  
  
  <div id="main_area">
    <div id="main_area_content">
      <h1 class="mainHeadline"><img src="<?=base_url()?>asset/capturepages/page25/head_img.png" alt=""></h1>
      <br>

        <?php  if($result[0]['headline_text']!=''){
	  	$style_title=$result[0]['head_bg']=='Y'?'style="background:'.$result[0]['head_bg_col'].';color:#000;"':'';
	  	?>
	  		<h2 class="subHeadline" <?php echo $style_title; ?>><?=$result[0]['headline_text']?></h2>
		<?php } ?>
    
      <div id="optinArea">
        <p class="optinHeadline">YOUR INVITOR:
          &nbsp;<?=$ref[0]['fname']?>
          <?=$ref[0]['lname']?>
        </p>
        <input  class="bg_name opst"  type="text" name="fname" id="fname" value="" placeholder="First Name">
        <input  class="bg_name opst"  type="text" name="lname" id="lname" value="" placeholder="Last Name">
        <input  class="emailtxt bg_email" type="text" name="emailid" id="emailid" value="" placeholder="Email">
        <input  class="mobiletxt bg_mobile" type="text" name="mobileno" id="mobileno" value="" placeholder="Mobile No">
       
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

</body>
<script></script>
</html>
<script>
$(document).ready(function(){
   
     var audio = new Audio('<?php echo $audio; ?>');
	audio.play();
});
</script>
<style>
#main_area{
	margin-left: 422px;
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
.marqdiv_top{
	  z-index:9999;
	  position:absolute;
	  margin-top:-17px;
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
	top: 0px;
	z-index:9999;
  }
  marquee h3{
	  color:#FFF;
  }
 @media  only screen and (max-width: 960px){
	body{
		background-size: 100% 100%;	
	}
	#main_area{
	margin-left: 222px;
	}

}
@media  only screen and (max-width: 500px){
	
	
	.marqdiv_left{
		display:none;
	}

#main_area{
	margin-left: -60px;
	}
}

</style>