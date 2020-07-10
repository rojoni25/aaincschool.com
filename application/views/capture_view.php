<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title></title>
<meta name="viewport" content="width=device-width, user-scalable=no">
<meta name="description" content="">
<meta charset="utf-8">
</head>
<body>
<link rel="stylesheet" href="<?=base_url();?>asset/capturepages/animate.css">
<link href="<?=base_url();?>asset/capturepages/perfect-scrollbar.css" rel="stylesheet">
<link href="<?=base_url();?>asset/capturepages/css.css" rel="stylesheet" type="text/css">
<script src="<?=base_url();?>asset/capturepages/jquery_002.js" type="text/javascript"></script> 
<script src="<?=base_url();?>asset/capturepages/jquery.js"></script> 
<script src="<?=base_url();?>asset/capturepages/perfect-scrollbar.js"></script>



<?php if($result[0]['page_bg_video']!=''){
		if (strpos($result[0]['page_bg_video'], 'youtube.com') !== false){	
			$youtube=true;
		?>
    <script src="<?=base_url();?>asset/capturepages/jquery.mb.YTPlayer.js"></script>
				<script>$(document).ready(function () {   $(".player").mb_YTPlayer();});</script>
                <section class="content-section video-section">
                	<div class="pattern-overlay">
                		<a id="bgndVideo" class="player" data-property="{videoURL:'<?=$result[0]['page_bg_video']?>',containment:'.video-section', quality:'large', autoPlay:true, mute:true, opacity:1}">bg</a>
                		<div class="container"><div class="row"><div class="col-lg-12"></div></div></div>
                	</div>
                </section>		
    <?php } else { ?>
	<div id="container" style="position: fixed; width: 1348px; height: 657px;">
  		<video autoplay loop muted>
    		<source src="<?=$result[0]['page_bg_video']?>" type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;">
  		</video>
  		<div style="position:absolute; top:0; left:0;"> </div>
	</div>
<?php } } ?>

<style type="text/css">

<?php if($youtube){?>
	.video-section .pattern-overlay {
background-color: rgba(71, 71, 71, 0.59);
padding: 110px 0 32px;
min-height: 496px; 
/* Incase of overlay problems just increase the min-height*/
}
.video-section h1, .video-section h3{
text-align:center;
color:#fff;
}
.video-section h1{
font-size:110px;
font-family: 'Buenard', serif;
font-weight:bold;
text-transform: uppercase;
margin: 40px auto 0px;
text-shadow: 1px 1px 1px #000;
-webkit-text-shadow: 1px 1px 1px #000;
-moz-text-shadow: 1px 1px 1px #000;
}
.video-section h3{
font-size: 25px;
font-weight:lighter;
margin: 0px auto 15px;
}
.video-section .buttonBar{display:none;}
.player {font-size: 1px;}
<?php } 
	
?>
html{
	background-color:#<?=$result[0]['page_bg_color']?>;
	background:url(<?=base_url()?>asset/capturepages/bg.jpg);
	background-position: center top;
    background-size: 100% auto;
}
p{
	color:#FFF;
}
body{
	min-height:100%; 
	margin:0; padding:0; 
	background-color:#<?=$result[0]['page_bg_color']?>;
	background:url(<?=base_url()?>asset/capturepages/bg.jpg);
	background-position: center top;
    background-size: 100% auto;
}
.button { 
	display: inline-block; 
	-webkit-box-sizing: content-box; 
	-moz-box-sizing: content-box; 
	box-sizing: content-box; 
	cursor: pointer; 
	padding: 10px 20px; 
	border: 1px solid #d632d0; 
	-webkit-border-radius: 0px; 
	border-radius: 0px; 
	font-size:18px; 
	font-family:Oswald; 
	color: #FFFFFF; 
	-o-text-overflow: 
	clip; text-overflow: clip; 
	background: #d632d0;  
	text-shadow: -1px -1px 0 rgba(15,73,168,0.66) ; 
	-webkit-transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1); 
	-moz-transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1); 
	-o-transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1); 
	transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1); 
}
.button:hover {
	-webkit-box-shadow: inset 0 0 100px 100px rgba(255, 255, 255, 0.1); 
	box-shadow: inset 0 0 100px 100px rgba(255, 255, 255, 0.1); 
}

.divstyle{
		display:none;  position:fixed; 
		z-index: 100; 
		top:50%; 
		right:10%; 
		max-height:90%; 
		width:80%; 
		padding:10px; 
		border:1px solid #ffffff; 
		border-radius:3px; 
		overflow:hidden; 
		background: #<?=$result[0]['box_bg_color']?>; 
		background:url(<?=base_url()?>asset/capturepages/footer_lodyas.png);
	}
.divstyle2{
	display:none;  
	position:fixed; 
	z-index: 100; 
	top:50%; 
	right:10%; 
	max-height:90%; 
	width:80%; 
	padding:10px; 
	border:1px solid #ffffff; 
	border-radius:3px; 
	overflow:hidden; background: rgb(43, 201, 163); 
	background: #<?=$result[0]['box_bg_color']?>;  
	background:url(<?=base_url()?>asset/capturepages/footer_lodyas.png);
	color:#fff;
}
@media screen and ( max-width: 480px ), screen and (max-height: 360px) {
	.divstyle {
		left: 50%; 
		width: 70%; 
		margin-left:-37%;
	}  
	.divstyle {
		left:50%; 
		width: 70%; 
		margin-left:-37%;
	}
}
</style>
<div style="position: fixed; top: 58px; display: block;" id="maindiv" class="divstyle ps-container">
 	 <div id="hline" style="text-align:center; font-family:Open Sans; font-size:28px; color:#<?=$result[0]['headline_color']?>;"> 
     	<strong><?=$result[0]['headline_text']?></strong> 
      </div>
  	<div id="subhead" style=";padding-bottom:10px;text-align: center; font-family: Open Sans; font-size: 22px; padding-top: 10px; color:<?=$result[0]['sub_headline_color']?>;"> 
    	<strong style="color:#FF0;">your company name goes hear </strong> 
     </div>
 
  
   
  <div id="content" style="font-family:Open Sans; font-size:14px; color:#<?=$result[0]['main_body_text_color']?>; padding-left:30px; padding-right:30px;"> 
        <?=$contain?>
        <div style="clear:both;overflow:hidden;"></div>
    </div>
    <?php
    	if(count($ref)=='1'){
			echo '<div id="button" onclick="changeit();" style="text-align:center"><button class="button" type="button">Registration</button></div>';	
		}
	?>
  	 
  	<div id="footer" style="color:#fff; font-family:sans-serif; font-size:10px; text-align:center"><?=$result[0]['footer_text']?></div>
</div>
<!-------------------------------------------->
<div id="ardiv" class="divstyle2 ps-container" style="position: fixed; top: 167.5px;" >
  
  <div id="arhead" style="width:80%; margin-left:10%; font-family:Open Sans; font-size:16px; color:#000000">
    	<div style="text-align:center;color:#A6FF80;"><strong>Registration</strong></div>
  </div>
  <style>

	.txtbox{
		height:27px;
		padding:3px;
		width:60%;
		font-family:Open Sans; 
	}
	.formtbl{
		font-family:Open Sans;
		font-size:15px; 
	}
  </style>
  	<ul id="from_ul">
    <input  type="hidden" id="referralid" name="referralid" value="<?=$ref[0]['usercode']?>"/>
    <input  type="hidden" id="referralusername" name="referralusername" value="<?=$ref[0]['username']?>"/>
    <table width="100%" class="formtbl">
    	<tr>
        	<td width="19%">Your Referral</td>
            <td width="81%"><label>Jitendra</label>
            
            </td>
        </tr>
    	<tr>
        	<td width="19%">First Name</td>
            <td width="81%"><input type="text" id="fname" name="fname" placeholder="First Name" class="txtbox"></td>
        </tr>
        <tr>
        	<td>Last Name</td>
            <td><input type="text" id="lname" name="lname" placeholder="Last Name" class="txtbox"></td>
        </tr>
        <tr>
        	<td>Email</td>
            <td><input type="text" id="lname" name="lname" placeholder="Email" class="txtbox"></td>
        </tr>
        <tr>
        	<td>Mobile No</td>
            <td><input type="text" id="lname" name="lname" placeholder="Mobile No" class="txtbox"></td>
        </tr>
        <tr>
        	<td>Username </td>
            <td><input type="text" id="lname" name="lname" placeholder="Username" class="txtbox"></td>
        </tr>
        <tr>
        	<td>Password</td>
            <td><input type="password" id="lname" name="lname" placeholder="Password" class="txtbox"></td>
        </tr>
    </table>
    

	<?php if(count($ref)=='1'){ ?>
		<div style="text-align:center"><button class="button" type="submit">Registration Now</button></div>
	<?php } ?>
    
      
    

  <div id="footer" style="color:#fff; font-family:sans-serif; font-size:10px; text-align:center">Jet Stream Team</div>
 
  
</div>

<!-------------------------------------------->




<script>
var land_resized=0;

function changeit() {
	var fadeinBox = $("#ardiv");
	var fadeoutBox = $("#maindiv");

	function fade() {
		fadeinBox.stop(true, true).fadeIn(1000);
		fadeoutBox.stop(true, true).fadeOut(1000, function() {
			var temp = fadeinBox;
			fadeinBox = fadeoutBox;
			fadeoutBox = temp;
		   
		});
	}
	fade();
	$('#ardiv').center();
	$('#maindiv').remove();
}
//SICOM - Handle resizing for height of div

jQuery.fn.center = function ()
{
	this.css("position","fixed");
	this.css("top", ($(window).height() / 2) - (this.outerHeight() / 2));
	//this.css("left", ($(window).width() / 2) - (this.outerWidth() / 2));
	return this;
}

$(window).load(function(){
	document.title="";
	setTimeout( function(){ 
	$('#maindiv').show();
	$('#maindiv').center();
	$('#ardiv').center();
	$("#hline").fitText(1.0, { minFontSize: '14px', maxFontSize: '28px' });
	$("#subhead").fitText(1.0, { minFontSize: '14px', maxFontSize: '22px' });
	$("#content").fitText(1.0, { minFontSize: '6px', maxFontSize: '14px' });

	$('#maindiv').perfectScrollbar({
		suppressScrollX: true,
		scrollYMarginOffset: 20
		
	});
	$('#ardiv').perfectScrollbar({
		suppressScrollX: true,
		scrollYMarginOffset: 20
		
	});	
	$("#maindiv").addClass("animated rubberBand"); $("#maindiv").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function(){ $("#maindiv").removeClass("animated"); $("#maindiv").removeClass("rubberBand");  }); 
	},0);
	
});



$(window).resize(function(){
$('#ardiv').center();
$('#maindiv').center();

$('#ardiv').perfectScrollbar('update');
$('#maindiv').perfectScrollbar('update');
}).resize();

</script> 
<script>$(function() { function iedetect(v) { var r = RegExp("msie" + (!isNaN(v) ? ("\s" + v) : ""), "i");	return r.test(navigator.userAgent); } if(screen.width < 800 || iedetect(8) || iedetect(7) || "ontouchstart" in window) {(adjSize = function() { width = $(window).width(); height = $(window).height();  $("video").hide(); })(); $(window).resize(adjSize);	} else { $("#container video").on("loadedmetadata", function() { var width, height, vidwidth = this.videoWidth, vidheight = this.videoHeight, aspectRatio = vidwidth / vidheight; (adjSize = function() { width = $(window).width(); height = $(window).height(); boxRatio = width / height; adjRatio = aspectRatio / boxRatio; $("#container").css({"width" : width+"px", "height" : height+"px"}); if(boxRatio < aspectRatio) { vid = $("#container video").css({"width" : width*adjRatio+"px"}); } else { vid = $("#container video").css({"width" : width+"px"}); }	})(); $(window).resize(adjSize); }); } });</script>
</body>
</html>