<!DOCTYPE html>
<html>
<head>
	<title>Affiliworx-2018</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Admin Panel Template">
	<meta name="author" content="Westilian: Kamrujaman Shohel">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
	<link href="/asset/css/embedview.css" rel="stylesheet">
<script src="<?php echo base_url();?>asset/js/jquery.js"></script>
</head>
<body>
	<script type="text/javascript" charset="utf-8">//
	$(document).ready(function() {
		
		<!---------This Method is use for change status-------------->
		$(document).on('click', '.login-btn', function (e) {
			if($('#fname').val()==""){
				$("#fname").focus();
				$('#errmsg').html('first name is require');
				return false;
			}
			if($('#lname').val()==""){
				$("#lname").focus();
				$('#errmsg').html('last name is require');
				return false;
			}
			if($('#emailid').val()==""){
				$("#emailid").focus();
				$('#errmsg').html('email id is require');
				return false;
			}
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (!filter.test($('#emailid').val())) {
				$('#emailid').val('')
   		 		alert("Enter Vailed Email Address");
    			return false;
 			}
			if($('#username').val()==""){
				$("#username").focus();
				$('#errmsg').html('username no. is require');
				return false;
			}
			if($('#password').val()==""){
				$("#password").focus();
				$('#errmsg').html('password no. is require');
				return false;
			}
			if($('#repeat_password').val()==""){
				$("#repeat_password").focus();
				$('#errmsg').html('enter repeat password');
				return false;
			}
			if($('#password').val()!=$('#repeat_password').val()){
				$('#password').val('');
				$('#repeat_password').val('');
				$('#errmsg').html('enter repeat is not match');
				return false;
			}
		});
		
	});		
</script>
<div class="container">
	<form class="form-signup" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord">
          <input  type="hidden" id="referralid" name="referralid" value="<?=$ref[0]['usercode']?>"/>
         <input  type="hidden" id="referralusername" name="referralusername" value="<?=$ref[0]['username']?>"/>
         <input  type="hidden" id="camefrom" name="camefrom" value=""/>
		<h3 class="form-signin-heading">Registration</h3>
        <label>
		<strong><?=$ref[0]['fname']?> <?=$ref[0]['lname']?></strong> Is Your Inviter</label>
       
		<div class="controls input-icon">
			<input type="text" class="input-block-level txtrg" placeholder="First Name" name="fname" id="fname">
		</div>
		<div class="controls input-icon">
			<input type="text" class="input-block-level txtrg" placeholder="Last Name" name="lname" id="lname">
		</div>
        <div class="controls input-icon">
			<input type="text" class="input-block-level txtrg" placeholder="Email Id" name="emailid" id="emailid">
		</div>
        <div class="controls input-icon">
			<input type="text" class="input-block-level txtrg" placeholder="Mobile No" name="mobileno" id="mobileno">
		</div>
         <div class="controls input-icon">
			<input type="text" class="input-block-level txtrg" placeholder="Username" name="username" id="username">
		</div>
         <div class="controls input-icon">
			<input type="password" class="input-block-level txtrg" placeholder="Password" name="password" id="password">
		</div>
         <div class="controls input-icon">
			<input type="password" class="input-block-level txtrg" placeholder="Repeat Password" name="repeat_password" id="repeat_password">
		</div>
		
        
        <?php if(isset($ref[0])){ ?>
			<button class="btn btn-inverse btn-block login-btn" type="submit">Registration</button>
        <?php } ?>
		<h4 id="errmsg"  class="msg"><?=$msg?></h4>
	</form>
</div>
<script type="text/javascript" charset="utf-8">//
	$(document).ready(function() {
		$("#camefrom").val(document.referrer);
	});
</script>
</body>
</html>