<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Capture Page</title>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/capturepages/page1/default.css" />
<script src="<?=base_url();?>asset/js/jquery.js"></script>
<script src="<?=base_url();?>asset/capturepages/jquery.mb.YTPlayer.js"></script>
<script src="<?=base_url();?>asset/js/capture_js.js"></script>
</head>
<?php
	if($result[0]['page_bg_img']==''){
		$page_bg_img=''.base_url().'asset/capturepages/page16.jpg';
	}
	else{
		$page_bg_img=$result[0]['page_bg_img'];
	}
	if (strpos($result[0]['video_url1'], 'youtube') !== false){
		$videourl=str_replace('embed/','watch?v=',$result[0]['video_url1']);
	}
	else{
		$videourl='https://www.youtube.com/watch?v=fdJc1_IBKJA';
	}
	
	if($result[0]['page_bg_video_mute']=='Y'){$mute='true';}
	else{$mute='false';}
?>
<style>
body {
	background-color: #e0f5ec;
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
	width:1010px;
	margin:auto;
	background: none repeat scroll 0% 0% rgba(0, 0, 0, 0.7);
	-webkit-box-shadow: 9px 6px 19px -4px rgba(0,0,0,0.75);
	-moz-box-shadow: 9px 6px 19px -4px rgba(0,0,0,0.75);
	box-shadow: 9px 6px 19px -4px rgba(0,0,0,0.75);
	border-radius:10px;
}
.forminner{
	padding:10px 50px;
}


table {
	font-size: 14px;
	color: #000;
}
.txt1 {
	background: none;
	border: #c4d297 solid 1px;
	padding: 3px;
	width: 95%;
	margin: 3px;
	color:#FFF;
	font-weight:700;
}
.title{
	margin:0px;
	padding:0px;
	color:#FFF;
}
.heading{
	margin:0px;
	padding:0px;
	color:#FFF;
	font-size:16px;
	font-style:italic;
}
</style>
<body>
<div class="topmargindiv">
<div class="bodybackground"> 
  <!---------------------------->
  <section class="content-section video-section">
    <div class="pattern-overlay"> <a id="bgndVideo" class="player" data-property="{videoURL:'<?=$videourl?>',containment:'.video-section', quality:'large', autoPlay:true, mute:<?=$mute?>, opacity:1}">bg</a>
      <div class="container">
        <div class="row">
        
        </div>
      </div>
    </div>
  </section>
  <!---------------------------->
</div>
<!------------------------>
<div class="formdiv">
	<div class="forminner">
    	<table width="100%">
        	<tr><td colspan="3"><h2 class="title"><?=$result[0]['headline_text']?></h2></td>
        		<td colspan="2" align="right"><h2 class="heading">Registration Now</h2></td>    
            </tr>
        	<tr>
            	<td width="32.666%"><input type="text" name="fname" id="fname" placeholder="First Name" class="txt1" title="First Name"></td>
                <td width="1%"></td>
                <td width="32.666%"><input type="text" name="lname" id="lname" placeholder="Last Name" class="txt1" title="Last Name"></td>
                 <td width="1%"></td>
                  <td width="32.666%"><input type="text" name="emailid" id="emailid" placeholder="Email Id" class="txt1" title="Email Id"></td>
            </tr>
            <tr>
            	<td><input type="text" name="mobileno" id="mobileno" placeholder="Mobile Number" class="txt1" title="Mobile Number"></td>
            	<td></td>
            	<td><input type="text" name="skype" id="skype" placeholder="Skype" class="txt1" title="Skype"></td>
                <td></td>
                <td><input type="text" name="username" id="username" placeholder="Username" class="txt1" title="Username"></td>
            </tr>
            <tr>
            	<td><input type="password" name="password" id="password" placeholder="Password" class="txt1" title="Password"></td>
                <td></td>
                <td><input type="password" name="confirmpass" id="confirmpass" placeholder="Confirm Password" class="txt1" title="Confirm Password"></td>
                <td></td>
                <td><input type="submit" class="btnsubmit login-btn" value="Registration Now"></td>
            </tr>
             
        </table>
    </div>
</div>
<!------------------------>
</div>
</body>
</html>
<script>
	$(document).ready(function(e) {
      	resetall();
	    $(".player").mb_YTPlayer();
    });
	$(window).resize(function(){
		resetall();
	});
	function resetall(){
		var windowHeight = $(window).height();
		var wbodybackground = $('.topmargindiv').height();
		var backmargin=(windowHeight-wbodybackground)/2;
		$(".topmargindiv").css("margin-top",backmargin+"px");
	}
</script>
<style>
.video-section .pattern-overlay {
	/*background-color: rgba(71, 71, 71, 0.59);*/
	padding: 110px 0 32px;
	min-height: 450px;/* Incase of overlay problems just increase the min-height*/
}
.video-section h1, .video-section h3 {
	text-align: center;
	color: #fff;
}
.video-section h1 {
	font-size: 110px;
	font-family: 'Buenard', serif;
	font-weight: bold;
	text-transform: uppercase;
	margin: 40px auto 0px;
	text-shadow: 1px 1px 1px #000;
	-webkit-text-shadow: 1px 1px 1px #000;
	-moz-text-shadow: 1px 1px 1px #000;
}
.video-section h3 {
	font-size: 25px;
	font-weight: lighter;
	margin: 0px auto 15px;
}
.video-section .buttonBar {
	display: none;
}
.player {
	font-size: 1px;
}
</style>
