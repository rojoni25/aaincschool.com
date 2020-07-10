<?php

	if($result[0]['page_bg_img']==''){
		$page_bg_img=''.base_url().'asset/capturepages/page1/Canvas_15.jpg';
	}
	else{
		$page_bg_img=$result[0]['page_bg_img'];
	}
	$audio=$result[0]['audio'];
?>
<style>
	body{
		overflow:hidden;
		background: url('<?=$page_bg_img?>') no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
		background-size: cover;
		
	}
	label{
		
	}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration</title>

	<meta property="og:title" content="Affiliworx" />
	<meta property="og:image" content="<?=$page_bg_img?>" />
	<?php if($result[0]['main_body_text']!=''){?>
		<meta property="og:description" content="" />
	<?php } ?>
	<!-- GOOGLE FONT -->
	<link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:500,700" rel="stylesheet">
	<!-- ALL CSS FILES -->
	<link href="<?=base_url();?>asset/css/materialize.css" rel="stylesheet">
	<link href="<?=base_url();?>asset/css/style.css" rel="stylesheet">
	<link href="<?=base_url();?>asset/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
	<link href="<?=base_url();?>asset/css/responsive.css" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<!--SCRIPT FILES-->
	<script src="<?=base_url();?>asset/js/jquery.min.js"></script>
	<script src="<?=base_url();?>asset/js/bootstrap.js" type="text/javascript"></script>
	<script src="<?=base_url();?>asset/js/materialize.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>asset/js/custom.js"></script>
</head>
<body>
	<section class="">
		<?php  if($result[0]['scrolling']=='top'){?>
		<div class="marqdiv_top">
		    <h4>Just Joined</h4>
		     <marquee><h3><?=$current_join_mem?></h3></marquee>
		</div>
		<?php }?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					  <header class="clearfix" style="color: #fff">
					  <?php  if($result[0]['headline_text']!=''){
					  	$style_title=$result[0]['head_bg']=='Y'?'style="background:'.$result[0]['head_bg_col'].';color:#000;"':'';
					  	?>
					  		<h1 <?php echo $style_title; ?>><?=$result[0]['headline_text']?></h1>
					  <?php } ?>
					  </header>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="hom-cre-acc-left hom-cre-acc-right">
						<form class="form-signin" method="post" action="<?php echo base_url();?>index.php/rg/insertrecord">
					  		<div class="row">
								<div class="col-md-6">
						    		<h3 class="text-center">Registration</h3>
						        	<?php if($smfund){ echo '<input type="hidden" name="smfund" value="Y"/>'; } ?>
						        	<input  type="hidden" id="audio" name="audio" value="<?=$ref[0]['audio']?>"/>
						    	 	<input  type="hidden" id="referralid" name="referralid" value="<?=$ref[0]['usercode']?>"/>
						         	<input  type="hidden" id="referralusername" name="referralusername" value="<?=$ref[0]['username']?>"/>
						         	<input  type="hidden"  id="baseurl" value="<?=base_url();?>"/>
						            <input  type="hidden" id="pagecode" name="pagecode" value="<?=$pagecode?>"/>
						            <input  type="hidden" name="redirect_url"  id="redirect_url"  value="<?=$result[0]['redirect_url']?>"/>
						            
						         	<p class="text-center">Your Inviter:<label>&nbsp;<?=$ref[0]['fname']?> <?=$ref[0]['lname']?></label></p>

						        	<div class="row">
										<div class="input-field col s12">
											<input id="fname" type="text" name="fname" class="validate" required>
											<label for="fname">First Name</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<input id="lname" type="text" name="lname" class="validate" required>
											<label for="lname">Last Name</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<input id="emailid" type="email" name="emailid" class="validate" required>
											<label for="emailid">Email Id</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s6">
											<input id="mobileno" type="Number" name="mobileno" class="validate" required>
											<label for="mobileno">Mobile </label>
										</div>
										<div class="input-field col s6">
											<input id="skype" type="text" name="skype" class="validate">
											<label for="skype">Skype</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<input id="username" type="text" name="username" class="validate" required>
											<label for="username">Username</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s6">
											<input id="password" type="password" name="password" class="validate" required>
											<label for="password">Password</label>
										</div>
										<div class="input-field col s6">
											<input id="confirmpass" type="password" name="confirmpass" class="validate" required>
											<label for="confirmpass">Confirm Password</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12"> 
											<!--<a class="waves-effect waves-light btn-large full-btn" href="#!">Take A Free Tour</a> -->
											 <?php if(isset($ref[0])){ ?>
								            	<p><input type="submit" class="waves-effect waves-light btn-large full-btn" value="<? if(!empty($result[0]['submit_button_title'])){
								            			echo $result[0]['submit_button_title'];
								            	}else{
								            		echo "Take A Free Tour";
								            	}?>"></p>
								            <?php } ?>
										</div>
									</div>
					            </div>
					            <div class="col-md-6">
						    		<div class="textbody" id="textbody">
								    	<p style="text-align:justify;"><?=$result[0]['main_body_text']?></p>
								    </div>
								</div>
					        	<?php  if($result[0]['scrolling']=='left'){?>

									<div class="marqdiv_left">
									    <h4>Just Joined</h4>
									     <marquee loop="infinite" behavior="scroll" direction="up" scrollamount="3" height="630">
									     <h3><?=$current_join?></h3>
									     </marquee>
									</div> 
							<?php }?>       


					       
					  		</div>
					  	</form>	
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>

<script type="text/javascript">
	
	$(document).ready(function(){
		setTimeout(function(){
			console.log("audio is playing now");
			var audio = new Audio('<?php echo $audio; ?>');
			audio.play();
		}, 100);
	});
</script>
<script>
	$(document).ready(function(e) {
        $('#textbody').perfectScrollbar({
			suppressScrollX: true,
			scrollYMarginOffset: 20
		});
    });
</script>
<style>
.marqdiv_top{
	  z-index:9999;
	  position:absolute;
	  margin-top:0px;
	  font-weight:600;
	  background: rgba(0, 0, 0, .5);
	  width:100%;
  }
  .marqdiv_top h4{
	margin-bottom:10px;
	margin-left:10px;
	color:#FFF;
	position: absolute;
	background: rgb(0, 0, 0) none repeat scroll 0% 0%;
	padding: 18px;
	top: -19px;
	z-index:9999;
  }
  .marquee h3{
	  color:#FFF;
	  text-align:center;
  }
 

.textbody{
	height: 200px;
	width: 317px;
	overflow:hidden;
	position:relative;
	padding-right:10px;
	margin-top:30px;
}
.formmain {
	position: absolute;
	top: 0px;
	right: 2%;
	z-index: 999;
	color: #FFF;
	background: none repeat scroll 0% 0% rgba(0, 0, 0, 0.7);
	padding: 20px;
	padding-top:20px;
	width: 350px;
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
.clearfix h1{
	padding:20px;
	float:left !important;
	color:#FFF;
}
.hom-cre-acc-left h3,p{
	color: #FFF;
}
.hom-cre-acc-right form {
	border : none;
	background : none repeat scroll 0% 0% rgba(0, 0, 0, 0.7) !important;
}
@media  only screen and (max-width: 960px){
	body{
		background-size: 100% 100%;
		
	}
	.textbody{
	margin-top:-20px;
	}

}

</style>

