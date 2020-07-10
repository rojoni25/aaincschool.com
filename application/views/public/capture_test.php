<style>
	@font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 100;
  src: local('Open Sans'), local('OpenSans'), url(http://fonts.gstatic.com/s/opensans/v10/cJZKeOuBrn4kERxqtaUH3VtXRa8TVwTICgirnJhmVJw.woff2) format('woff2'), url(http://fonts.gstatic.com/s/opensans/v10/cJZKeOuBrn4kERxqtaUH3T8E0i7KZn-EPnyo3HZu7kw.woff) format('woff');
}
</style>

<link rel="stylesheet" href="<?=base_url();?>asset/capturepages/animate.css">
<link href="<?=base_url();?>asset/capturepages/perfect-scrollbar.css" rel="stylesheet">

<script src="<?=base_url();?>asset/capturepages/jquery_002.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/capturepages/jquery.js"></script>
<script src="<?=base_url();?>asset/capturepages/perfect-scrollbar.js"></script>
<script>
	$(function() {
		var wheight = $(window).height();
		var vedioheight=wheight-453;
		$('.video-section .pattern-overlay').css("height", vedioheight); 
		
	});
	
	$(window).resize(function () {
   	 var wheight = $(window).height();
		var vedioheight=wheight-453;
		$('.video-section .pattern-overlay').css("height", vedioheight); 
});

</script>

<style>
html {
	background-image: -webkit-gradient(  linear,  left top,  left bottom,  color-stop(0, #008AE6),  color-stop(1, #FFFFFF) );
	background-image: -o-linear-gradient(bottom, #008AE6 0%, #FFFFFF 100%);
	background-image: -moz-linear-gradient(bottom, #008AE6 0%, #FFFFFF 100%);
	background-image: -webkit-linear-gradient(bottom, #008AE6 0%, #FFFFFF 100%);
	background-image: -ms-linear-gradient(bottom, #008AE6 0%, #FFFFFF 100%);
	background-image: linear-gradient(to bottom, #008AE6 0%, #FFFFFF 100%);
}
body {
	min-height: 100%;
	margin: 0;
	padding: 0;
	background-image: -webkit-gradient(  linear,  left top,  left bottom,  color-stop(0, #008AE6),  color-stop(1, #FFFFFF) );
	background-image: -o-linear-gradient(bottom, #008AE6 0%, #FFFFFF 100%);
	background-image: -moz-linear-gradient(bottom, #008AE6 0%, #FFFFFF 100%);
	background-image: -webkit-linear-gradient(bottom, #008AE6 0%, #FFFFFF 100%);
	background-image: -ms-linear-gradient(bottom, #008AE6 0%, #FFFFFF 100%);
	background-image: linear-gradient(to bottom, #008AE6 0%, #FFFFFF 100%);
	overflow:hidden;
	font-family:Open Sans; 
	
}
.main-body {
	width: 80%;
	margin: auto;
	height: 100%;
}
.header {
}
.headerinner {
	padding: 20px;
	text-align: center;
}
.videoinner{
	position:relative;
	overflow:hidden;
}
</style>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Capture Page</title>
</head>

<body>
<div class="main-body">
  <div class="header">
    <div class="headerinner"><img src="<?=base_url();?>asset/capturepages/logo.jpg" /></div>
    <!---header---->
    <div class="videodiv">
      <div class="videoinner"> 
        <script src="<?=base_url();?>asset/capturepages/jquery.mb.YTPlayer.js"></script> 
        <script>$(document).ready(function () {   $(".player").mb_YTPlayer();});</script>
        <section class="content-section video-section">
          <div class="pattern-overlay"> <a id="bgndVideo" class="player" data-property="{videoURL:'https://www.youtube.com/watch?v=8BuyhqfnH_c',containment:'.video-section', quality:'large', autoPlay:true, mute:true, opacity:1}">bg</a>
            <div class="container">
              <div class="row">
                <div class="col-lg-12"></div>
              </div>
            </div>
          </div>
        </section>
      </div><!-----inner ------>
    </div><!----videodiv----->
</div><!------main-body------->


<div class="formdiv">
	<div class="forminner">
		<table width="100%">
        	<tr>
            	<td width="50%" valign="top">
                	<table width="100%" cellspacing="5">
                    	<tr>
                        	<td align="right">Your Inviter</td>
                            <td><strong>Jitu Rajpurohit</strong></td>
                        </tr>
                        <tr>
                        	<td align="right">First Name</td>
                            <td><input type="text" name="fname" id="fname" class="txt1" placeholder="First Name" /></td>
                        </tr>
                        <tr>
                        	<td align="right">Email Id</td>
                            <td><input type="text" name="emailid" id="emailid" class="txt1" placeholder="Email" /></td>
                        </tr>
                        <tr>
                        	<td align="right">Username</td>
                            <td><input type="text" name="username" id="username" class="txt1" placeholder="Username" /></td>
                        </tr>
                    </table>
                </td>
                <td width="50%" valign="top">
                	<table width="100%" cellspacing="5">
                    	<tr>
                        	<td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                        	<td align="right">Last Name</td>
                            <td><input type="text" name="fname" id="fname" class="txt1" placeholder="First Name" /></td>
                        </tr>
                        <tr>
                        	<td align="right">Mobile No</td>
                            <td><input type="text" name="mobileno" id="mobileno" class="txt1" placeholder="Mobile No" /></td>
                        </tr>
                        <tr>
                        	<td align="right">Password</td>
                            <td><input type="password" name="password" id="password" class="txt2" placeholder="Password" />
                            	<input type="password" name="password" id="password" class="txt2" placeholder="Confirm Password" />
                                <img src="<?=base_url();?>asset/capturepages//btn-submit.png" width="70" />
                            </td>
                        </tr>
                        </table>
                </td>
            </tr>
            
        </table>    
    </div>
</div>

</body>
</html>
<style>
	.txt1{
		border:#03874e solid 1px;
		width:80%;
		height:27px;
		padding:3px;
	}
	.txt2{
		border:#03874e solid 1px;
		width:35%;
		height:27px;
		padding:3px;
	}
	.txt2{
	
	}
	.formdiv{
		position:fixed;
		width:70%;
		left:15%;
		top:70%;
		
		
	}
	.forminner{
		border-radius:10px 10px 0px 0px;
		background-image: -webkit-gradient(	linear,	left top,	left bottom,	color-stop(0, #FFF7C4),	color-stop(1, #FFFFFF));
		background-image: -o-linear-gradient(bottom, #FFF7C4 0%, #FFFFFF 100%);
		background-image: -moz-linear-gradient(bottom, #FFF7C4 0%, #FFFFFF 100%);
		background-image: -webkit-linear-gradient(bottom, #FFF7C4 0%, #FFFFFF 100%);
		background-image: -ms-linear-gradient(bottom, #FFF7C4 0%, #FFFFFF 100%);
		background-image: linear-gradient(to bottom, #FFF7C4 0%, #FFFFFF 100%);
		min-height:1500px;
		position:relative;
		z-index:9999;
		overflow:hidden;
		font-weight:lighter;
		
	}

	.video-section .pattern-overlay {
		background-color: rgba(71, 71, 71, 0.59);
		padding: 110px 0 32px;
		min-height: 250px; 
/* Incase of overlay problems just increase the min-height*/
}


.video-section .buttonBar{display:none;}
.player {font-size: 1px;}
</style>