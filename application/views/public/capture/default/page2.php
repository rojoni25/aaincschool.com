<style>
	body{
		overflow:hidden;
		background: url('<?=base_url();?>asset/capturepages/page1/1.jpg') no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;

	}
</style>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Now</title>
<meta name="description" content="Blueprint: Background Slideshow" />
<meta name="keywords" content="blueprint, background image slideshow, fullscreen slideshow, jquery, fullscreen image, web development" />
<meta name="author" content="Codrops" />
<link rel="shortcut icon" href="../favicon.ico">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/capturepages/page1/default.css" />


</head>
<body>
<div class="container">
  <header class="clearfix">
      <h1 style="background:none repeat scroll 0% 0% rgba(255, 255, 255, 0.7);padding:20px;color:#000;float:right;">Company Name Goes Here</h1>
  </header>

  <div class="formmain">
  	<div>
    	<p style="text-align:justify;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
    </div>
    <h3>Registration</h3>
        <p><input type="text" name="fname" id="fname" placeholder="First Name" class="txt1" title="First Name"></p>
        <p><input type="text" name="lname" id="lname" placeholder="Last Name" class="txt1" title="Last Name"></p>
        <p><input type="text" name="emailid" id="emailid" placeholder="Email Id" class="txt1" title="Email Id"></p>
        <p><input type="text" name="mobileno" id="mobileno" placeholder="Mobile Number" class="txt1" title="Mobile Number"></p>
        <p><input type="text" name="username" id="username" placeholder="Username" class="txt1" title="Username"></p>
        <p><input type="password" name="password" id="password" placeholder="Password" class="txt2" title="Password">
           <input type="password" name="confirmpass" id="confirmpass" placeholder="Confirm Password" class="txt2" title="Confirm Password">
        </p>
       
        <p><input type="submit" class="btnsubmit" value="Registration Now"></p>
  </div>
</div>

</body>
</html>
<style>
.formmain {
	position: absolute;
	top: 0px;
	left: 2%;
	z-index: 999;
	color: #FFF;
	background: none repeat scroll 0% 0% rgba(0, 0, 0, 0.5);
	padding: 60px;
	width: 400px;
	height: 400px;
	min-height:3000px;
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
</style>
