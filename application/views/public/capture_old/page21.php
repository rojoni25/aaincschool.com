<?php
	if($result[0]['bg_iframe']!=''){
		$bg_iframe=$result[0]['bg_iframe'];
	}
	else{
		$bg_iframe=base_url();
	}
		$page_bg_iframe='<iframe width="100%" height="100%" src="'.$bg_iframe.'" frameborder="0" allowfullscreen></iframe>';

?>
<style>
	body{
		overflow:hidden;
		background: no-repeat center center fixed; 
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
<title>Registration</title>

<meta property="og:title" content="Affiliworx" />
<meta property="og:image" content="<?=$page_bg_img?>" />
<?php if($result[0]['main_body_text']!=''){?>
	<meta property="og:description" content="<?=$result[0]['main_body_text1']?>" />
<?php } ?>


<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/capturepages/page1/default.css" />
<script src="<?=base_url();?>asset/js/jquery.js"></script> 
<link href="<?=base_url();?>asset/capturepages/perfect-scrollbar.css" rel="stylesheet">
<script src="<?=base_url();?>asset/capturepages/perfect-scrollbar.js"></script>

<script src="<?=base_url();?>asset/js/capture_js.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/css/capture_css.css" />


</head>
<body>
<?php $autoplay_state = $result[0]['page_bg_video_autoplay']; ?>	
<?php  if($result[0]['scrolling']=='top'){?>
<div class="marqdiv_top">
    <h4>Just Joined</h4>
     <marquee><h3><?=$current_join_mem?></h3></marquee>
</div>
<?php }?>

<?=$page_bg_iframe?>
<div class="container">
  <header class="clearfix">

   <?php  if($result[0]['headline_text']!=''){
	  	$style_title=$result[0]['head_bg']=='Y'?'style="background:'.$result[0]['head_bg_col'].';color:#000;"':'';
	  	?>
	  		<h1 <?php echo $style_title; ?>><?=$result[0]['headline_text']?></h1>
	<?php } ?>
   
  </header>


  <div class="formmain">
  	 <div class="textbody" id="textbody">
    	<p style="text-align:justify;"><?=$result[0]['main_body_text']?></p>
    </div>
    <h3>Registration</h3>
        <form class="form-signin" method="post" action="<?php echo base_url();?>index.php/rg/insertrecord">
        
			<?php if($smfund){ echo '<input type="hidden" name="smfund" value="Y"/>'; } ?>
        
    	 	<input  type="hidden" id="referralid" name="referralid" value="<?=$ref[0]['usercode']?>"/>
         	<input  type="hidden" id="referralusername" name="referralusername" value="<?=$ref[0]['username']?>"/>
         	<input  type="hidden"  id="baseurl" value="<?=base_url();?>"/>
           <input  type="hidden" id="pagecode" name="pagecode" value="<?=$pagecode?>"/>
            <input  type="hidden" name="redirect_url"  id="redirect_url" anme value="<?=$result[0]['redirect_url']?>"/>
            
           
            
         	<p class="llbinviter">Your Inviter:<label>&nbsp;<?=$ref[0]['fname']?> <?=$ref[0]['lname']?></label></p>
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
        			<p><input type="submit" class="btnsubmit login-btn" value="<? if(!empty($result[0]['submit_button_title'])){
            			echo $result[0]['submit_button_title'];
            	}else{
            		echo "Take A Free Tour";
            	}?>"></p>
            <?php } ?>
        </form>
        <?php  if($result[0]['scrolling']=='left'){?>
        <div class="marqdiv_left">
            <h4>Just Joined</h4>
             <marquee loop="infinite" behavior="scroll" direction="up" scrollamount="3" height="630">
             <h3><?=$current_join?></h3>
             </marquee>
        </div> 
		<?php }?>
  </div>
</div>

<div class="bodyvideo">
	<div class="videoinner">
    	<?php
	  if($result[0]['video_url1']!=''){
	  	$autoplay_state = $result[0]['page_bg_video_autoplay'] == 'Y' ? ture : false;
			if (strpos($result[0]['video_url1'], 'youtube') !== false){
				echo '<iframe width="100%" height="100%" src="'.convertYoutube($result[0]['video_url1'], false, $autoplay_state).'" frameborder="0" allowfullscreen></iframe>';
			}
			else{
				echo '<video width="100%" height="100%" controls autoplay><source src="'.$result[0]['video_url1'].'" type="video/mp4"></video>';
			}
	   }
      	
	?>
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
.textbody{
	height:80px;
	overflow:hidden;
	position:relative;
	padding-right:10px;
	margin-top:30px;
}
.bodyvideo{
	width: <? echo get_hw_videoframe($result[0]['video_frame'])['width'];?>;
	height: <? echo get_hw_videoframe($result[0]['video_frame'])['height'];?>;
	position:absolute;
	top:158px;
	left:13%;
	background: url(<?=base_url()?>asset/capturepages/<?echo $result[0]['video_frame'];?>.png) no-repeat center center;
	background-position: center;
    background-size: cover;
}
.videoinner{
	<? echo get_hw_videoframe_inner($result[0]['video_frame']);?>	
	
}
.formmain {
	position: absolute;
	top: 0px;
	right: 2%;
	z-index: 999;
	color: #FFF;
	background: none repeat scroll 0% 0% rgba(0, 33, 99, 0.7);
	padding: 20px;
	padding-top:20px;
	width: 300px;
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
 @media  only screen and (max-width: 960px){
	body{
		  background-size: 100% 100%;
	}
	.bodyvideo {
  width: 400px;
height: 347px;
margin-top: 0px;
margin-left: -70px;
	}
	.videoinner {
	margin-left: 18px;
margin-top: 27px;
height: 227px;
width: 364px;
}
}
@media  only screen and (max-width: 500px){
body{
overflow:visible;
}
.formmain {
	top:350px;
	min-height:550px;
}
.clearfix h1{
	padding:7px;
	float:right !important;
}
.bodyvideo {
width: 347px;
height: 302px;
margin-top: -41px;
margin-left: -45px;
}
.videoinner {
margin-left: 15px;
margin-top: 23px;
height: 198px;
width: 317px;
}
.textbody {
   
    margin-top:-5px;
}
.marqdiv_left{
	display:none;
	}

}
 
</style>
<script>

</script>
<?php 
$status = trim($result[0]['page_bg_video_autoplay']); 
$string = preg_replace('/\s+/', '', $status);
$new = str_replace(" ", "", $string);
?>
<script type="text/javascript">
	// $(document).ready(function(){
		<?php 
			if ($new=="Y") { ?>
			$('video').get(0).play();
			<?php 	} else{ ?>
			$('video').get(0).pause();
			<?php } ?>
	// }); 

</script>