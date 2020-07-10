<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Admin | Jet Stream Team-2018</title>
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
<script type="text/javascript" charset="utf-8">//
	$(document).ready(function() {
		
		<!---------This Method is use for change status-------------->
		$(document).on('click', '.login-btn', function (e) {
			if($('#username').val()==""){
				$("#username").focus();
				return false;
			}
			if($('#password').val()==""){
				$("#password").focus();
				return false;
			}
		});
		
	});		
</script>
<body>
<div class="layout">
	<!-- Navbar================================================== -->
	<div class="navbar navbar-inverse top-nav">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="#"><img src="<?php echo base_url();?>asset/images/opp2015-logo.png" width="200" height="100" alt="logo"></a>
				
			</div>
		</div>
	</div>
	<div class="container">
		<form class="form-signin" method="post" action="<?=base_url()?>index.php/login/login_submit">
			<h3 class="form-signin-heading">Please sign in</h3>
			<div class="controls input-icon">
				<i class=" icon-user-md"></i>
				<input type="text" class="input-block-level" placeholder="Username" name="username" id="username">
			</div>
			<div class="controls input-icon">
				<i class=" icon-key"></i><input type="password" class="input-block-level" placeholder="Password" name="password" id="password">
			</div>
			<label class="checkbox">
			<input type="checkbox" value="remember-me"> Remember me </label>
            <label class="msg"><?=$error?></label>
			<button class="btn btn-inverse btn-block login-btn" type="submit">Sign in</button>
			<h4>Forgot your password ?</h4>
		</form>
        
      
	</div>
</div>
</body>
</html>