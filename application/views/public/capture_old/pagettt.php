<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="<?=base_url();?>asset/js/jquery.js"></script>
<link href="<?=base_url();?>asset/capturepages/perfect-scrollbar.css" rel="stylesheet">
<script src="<?=base_url();?>asset/capturepages/perfect-scrollbar.js"></script>
<script src="<?=base_url();?>asset/capturepages/jquery.mb.YTPlayer.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>
	$(document).ready(function(e) {
	   resizediv();
	   $(window).resize(function(){
			resizediv();
		}).resize();
	
    });
	
	function resizediv(){
		 var wheight=$(window).height();
		 var wwidth=$(window).width();
		
	   	 var frmheight=wheight-100;
	   	$(".bodycontain").css("height", frmheight);
		//$(".bodycontain iframe").css("height", frmheight);
		//$(".bodycontain iframe").css("width", wwidth);
	}
</script>
<title>Untitled Document</title>
</head>
<body>
<div class="header">
	<h2>Your Page Title</h2>
</div>

<div class="bodycontain">
  <iframe width="1350" height="800" src="https://www.youtube.com/embed/CDW3v0FQr-8?autoplay=1&fs=1" frameborder="0" allowfullscreen></iframe>
</div>
<div class="footer">dd</div>

<div class="formmain">
    <h3>Registration</h3>
    <p>
      <input type="text" name="fname" id="fname" placeholder="First Name" class="txt1 req" title="First Name"></p>
    <p>
      <input type="text" name="lname" id="lname" placeholder="Last Name" class="txt1 req" title="Last Name"></p>
    <p>
      <input type="text" name="emailid" id="emailid" placeholder="Email Id" class="txt1 req" title="Email Id"></p>
    <p>
      <input type="text" name="mobileno" id="mobileno" placeholder="Mobile Number" class="txt1 req" title="Mobile Number"></p>
    <p>
      <input type="text" name="username" id="username" placeholder="Username" class="txt1 req" title="Username">
    </p>
    <p>
      <input type="password" name="password" id="password" placeholder="Password" class="txt2 req" title="Password">
      <input type="password" name="confirmpass" id="confirmpass" placeholder="Confirm Password" class="txt2 req" title="Confirm Password">
    </p>
    <p>
     <input type="submit" class="btnsubmit" value="Registration Now">
    </p>
  </div>
  
</body>
<style>
.bodycontain{
	width:100%;
	position:relative;
	z-index:-1;
	text-align:center;
	margin:auto;
}
.header h2
{
	font-size: 2.125em;
	line-height: 1.3;
	margin: 0px;
	font-weight: 400;
	text-align:center;
}
body {
	margin: 0px;
	padding: 0px;
	font-family: "Lato",Calibri,Arial,sans-serif;
	overflow: hidden;
}
html{
	margin: 0px;
	padding: 0px;
	height: 100%;
	width: 100%;
}
.header {
	width: 100%;
	height: 50px;
	background: #FFF;
	margin:auto;
	margin-top:0px !important;
	position:relative;
}
.footer {
	position: absolute;
	width: 100%;
	height: 50px;
	bottom: 0;
	background-color: #FFF;
}
.formmain {
	position: absolute;
	top: 15%;
	right: 2%;
	z-index: 9999;
	color: #FFF;
	background: none repeat scroll 0% 0% rgba(0, 0, 0, 0.7);
	padding: 60px;
	padding-top:30px !important;
	padding-bottom:30px !important;
	width: 400px;
	height: 400px;
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
	width: 47.5%;
}
.btnsubmit {
	background: FFF;
	border: #FFF solid 1px;
	color: #F00;
	font-weight: bold;
	padding: 5px;
	cursor: pointer;
}
</style>
</html>
