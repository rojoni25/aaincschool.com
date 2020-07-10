
<style>
	body{
		overflow:hidden;
		background: url('<?=base_url()?>asset/capturepages/page1/img3.jpg') no-repeat center center fixed; 
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
<meta name="viewport" content="width=500, initial-scale=1">
<title>Registration</title>

<meta property="og:title" content="NLLSYS" />
<meta property="og:image" content="<?=$page_bg_img?>" />


<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/capturepages/page1/default.css" />

<script src="<?=base_url();?>asset/js/jquery.js"></script>
<link href="<?=base_url();?>asset/capturepages/perfect-scrollbar.css" rel="stylesheet">
<script src="<?=base_url();?>asset/capturepages/perfect-scrollbar.js"></script>
<script src="<?=base_url();?>asset/js/capture_js.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/css/capture_css.css" />

</head>
<body>

<div class="container">
  <header class="clearfix">
  
  		<h1 style="background:none repeat scroll 0% 0% rgba(255, 255, 255, 0.7);color:#000;">M2M Membership</h1>
 
  </header>

  <div class="formmain">
  	<div class="textbody" id="textbody">
    	<p style="text-align:justify;">Dreem Student</p>
    </div>
    <h3>Registration</h3>
    	<form class="form-signin" method="post" action="<?php echo base_url();?>index.php/rg/insertrecord">
    	 	<input  type="hidden" id="referralid" name="referralid" value="<?=$ref[0]['usercode']?>"/>
         	<input  type="hidden" id="referralusername" name="referralusername" value="<?=$ref[0]['username']?>"/>
         	<input  type="hidden"  id="baseurl" value="<?=base_url();?>"/>
            <input  type="hidden" id="pagecode" name="pagecode" value="<?=$pagecode?>"/>
            <input  type="hidden" name="redirect_url"  id="redirect_url" anme value="<?=$result[0]['redirect_url']?>"/>
            <input  type="hidden" name="dreem_student" value="Y"/>
              
         	<p class="llbinviter">Your Inviter :<label><?=$ref[0]['fname']?> <?=$ref[0]['lname']?></label></p>
        	<p><input type="text" name="fname" id="fname" placeholder="First Name" class="txt1" title="First Name"></p>
        	<p><input type="text" name="lname" id="lname" placeholder="Last Name" class="txt1" title="Last Name"></p>
        	<p><input type="text" name="emailid" id="emailid" placeholder="Email Id" class="txt1" title="Email Id"></p>
        	<p><input type="text" name="mobileno" id="mobileno" placeholder="Mobile Number" class="txt2" title="Mobile Number">
           	<input type="text" name="skype" id="skype" placeholder="Skype" class="txt2" title="Skype">
        	</p>
        	<p><input type="text" name="username" id="username" placeholder="Username" class="txt1" title="Username"></p>
        	<p><input type="password" name="password" id="password" placeholder="Password" class="txt2" title="Password">
           	<input type="password" name="confirmpass" id="confirmpass" placeholder="Confirm Password" class="txt2" title="Confirm Password">
        	</p>
            <?php if(isset($ref[0])){ ?>
            	<p><input type="submit" class="btnsubmit login-btn" value="Registration Now"></p>
            <?php } ?>
        	<?php  if($result[0]['scrolling']=='left'){?>

<div class="marqdiv_left">
    <h4>Just Joined</h4>
     <marquee loop="infinite" behavior="scroll" direction="up" scrollamount="3" height="630">
     <h3><?=$current_join?></h3>
     </marquee>
</div> 
<?php }?>       


        </form>
  </div>
</div>

</body>
</html>
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
  marquee h3{
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
}

@media  only screen and (max-width: 960px){
	body{
		background-size: 100% 100%;
		
	}
	.textbody{
	margin-top:-20px;
	}

}
@media  only screen and (max-width: 500px){
	
	.formmain {
		top:120px;		
	}
	.container > header{
		padding: 2.875em 5em 1.875em;
	}
	.clearfix h1{
	padding:7px;
	float:right !important;
	}
	
	.marqdiv_left{
		display:none;
	}
}
@media only screen and (max-width: 768px){
	body{
		overflow:auto !important;
	}
	.formmain{
		min-height:100% !important;
	 }
}
</style>
