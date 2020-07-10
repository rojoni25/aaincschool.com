<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Affiliworx-2018</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Admin Panel Template">
<meta name="author" content="Westilian: Kamrujaman Shohel">
<!-- styles -->
<link href="<?php echo base_url();?>asset/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>asset/css/bootstrap-responsive.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>asset/css/font-awesome.css">
<!--[if IE 7]>
            <link rel="stylesheet" href="css/font-awesome-ie7.min.css">
        <![endif]-->
<link href="<?php echo base_url();?>asset/css/styles.css" rel="stylesheet">
<link href="<?php echo base_url();?>asset/css/theme-blue.css" rel="stylesheet">

<style>
	.msg{
		color:#F00;
	}
</style>
<link href="<?php echo base_url();?>asset/css/aristo-ui.css" rel="stylesheet">
<link href="<?php echo base_url();?>asset/css/elfinder.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
<!--fav and touch icons -->

<!--============j avascript===========-->
<script src="<?php echo base_url();?>asset/js/jquery.js"></script>
<script src="<?php echo base_url();?>asset/js/jquery-ui-1.10.1.custom.min.js"></script>
<script src="<?php echo base_url();?>asset/js/bootstrap.js"></script>
</head>

<body>
<div class="layout">
	<!-- Navbar================================================== -->
	
	<div class="container">
		<form class="form-signin" method="post" action="">
           
			<h3 class="form-signin-heading">Registration Successfully</h3>
            <p>Your Registration Successfully</p>
             
         
		</form>
	</div>
</div>
</body>
</html>
<style>
	.txtrg{
		padding-left:5px !important;
		margin-bottom: 10px !important;
	}
	.form-signin{
		margin-top:15px !important;
	}
</style>