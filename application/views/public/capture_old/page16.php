<?php

	if($result[0]['page_bg_img']==''){
		$page_bg_img=''.base_url().'asset/capturepages/page16.jpg';
	}
	else{
		$page_bg_img=$result[0]['page_bg_img'];
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration</title>

<meta property="og:title" content="Affiliworx" />
<meta property="og:image" content="<?=$page_bg_img?>" />
<?php if($result[0]['main_body_text']!=''){?>
	<meta property="og:description" content="" />
<?php } ?>

<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/capturepages/page1/default.css" />
<script src="<?=base_url();?>asset/js/jquery.js"></script>
<script src="<?=base_url();?>asset/capturepages/jquery.mb.YTPlayer.js"></script>
<script src="<?=base_url();?>asset/js/capture_js.js"></script>
</head>
<?php
	
	 
	///////////////
	if($result[0]['video_url1']!='')
	 {
		
			if (strpos($result[0]['video_url1'], 'youtube') !== false)
			{
				if (strpos($result[0]['video_url1'], 'embed') !== false)
				{
					$u=explode('/',$result[0]['video_url1']);
					$u=explode('?',$u[4]);
					$videocode=$u[0];
				}
				else
				{
					$u=explode('=',$result[0]['video_url1']);
					$videocode=$u[1];
				}	
				
			}
	   }
	
	
	if($videocode==''){
		$videocode='fdJc1_IBKJA';
	}
	///////////////
	
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
	width: 860px;
	margin: auto;
	height: 450px;
	position: relative;
	margin-top:30px;
}
.formdiv {
	width:1010px;
	margin:auto;
	background: none repeat scroll 0% 0% rgba(0, 0, 0, 0.7);
	-webkit-box-shadow: 9px 6px 19px -4px rgba(0,0,0,0.75);
	-moz-box-shadow: 9px 6px 19px -4px rgba(0,0,0,0.75);
	box-shadow: 9px 6px 19px -4px rgba(0,0,0,0.75);
	border-radius:10px;
	
	position:relative;
	z-index:9999;
	margin-top:40px;
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
.player{
            display:inline-block;
            vertical-align:top;
            position:relative;
            width:809px;
            height:455px;
            left:0;
            overflow: hidden;
           position:relative;
		   z-index:-1;
		   margin-top:35px;
            /*border: 5px solid #fff;*/
           
        }
</style>
<body>
<?php $autoplay_state = $result[0]['page_bg_video_autoplay']; ?>

<?php  if($result[0]['scrolling']=='top'){?>
<div class="marqdiv_top">
    <h4>Just Joined</h4>
     <marquee><h3><?=$current_join_mem?></h3></marquee>
</div>
<?php }?>

<div class="topmargindiv">
<div class="bodybackground">

<header class="clearfix">
    <?php  if($result[0]['headline_text']!=''){
	  	$style_title=$result[0]['head_bg']=='Y'?'style="background:'.$result[0]['head_bg_col'].';color:#000;"':'';
	  	?>
	  		<h1 <?php echo $style_title; ?>><?=$result[0]['headline_text']?></h1>
	<?php } ?>
  </header> 
  <!---------------------------->
  <section class="content-section video-section">
  
   
   <?php
	  if($result[0]['video_url1']!=''){
	  	$autoplay_state = $result[0]['page_bg_video_autoplay'] == 'Y' ? ture : false;
			if (strpos($result[0]['video_url1'], 'youtube') !== false){
				echo '<iframe width="809px" height="490px" src="'.convertYoutube($result[0]['video_url1'], false, $autoplay_state).'" frameborder="0" allowfullscreen></iframe>';
			}
			else{
				echo '<video width="809px" height="490px" controls="controls"><source src="'.$result[0]['video_url1'].'" type="video/mp4"></video>';
			}
	   }else{
	   		echo '<div id="howToVideo2" class="player"></div>';
	   }
      	
	?>
    
  </section>
  <!---------------------------->
 

</div>
<!------------------------>
<div class="formdiv">

	<div class="forminner">
   <form class="form-signin" method="post" action="<?php echo base_url();?>index.php/rg/insertrecord">
   			
            <?php if($smfund){ echo '<input type="hidden" name="smfund" value="Y"/>'; } ?>
            
    	 	<input  type="hidden" id="referralid" name="referralid" value="<?=$ref[0]['usercode']?>"/>
         	<input  type="hidden" id="referralusername" name="referralusername" value="<?=$ref[0]['username']?>"/>
         	<input  type="hidden"  id="baseurl" value="<?=base_url();?>"/>
            <input  type="hidden" id="pagecode" name="pagecode" value="<?=$pagecode?>"/>
            <input  type="hidden" name="redirect_url"  id="redirect_url" anme value="<?=$result[0]['redirect_url']?>"/>
           
    	<table width="100%">
        	<tr><td colspan="3"><h3 style="color:#FFF;padding:0px;margin:0px;">Your Inviter:<label>&nbsp;<?=$ref[0]['fname']?> <?=$ref[0]['lname']?></label></h3></td>
        		<td colspan="2" align="right"><h2 class="heading">Take a Free Tour</h2></td>    
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
                <td> <?php if(isset($ref[0])){ ?> <input type="submit" class="btnsubmit login-btn" value="<? if(!empty($result[0]['submit_button_title'])){
            			echo $result[0]['submit_button_title'];
            	}else{
            		echo "Take A Free Tour";
            	}?>"><?php } ?></td>
            </tr>        
        </table>
       </form>
    </div>
</div>
<!------------------------>
</div>

</body>
</html>
<script>
	$(document).ready(function(e) {
      	resetall();
	    
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
<script type="application/javascript">
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = false;
    ga.src = '//www.youtube.com/player_api';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
    var done = false;
    var player;
    function onYouTubePlayerAPIReady() {
        player = new YT.Player('howToVideo2', {
            height: '455',
            width: '809',
            videoId: '<?=$videocode?>',
      
		playerVars: {
			autoplay: 1,
            controls: 0,
            showinfo: 0,
			loop : 1,
           	modestbranding: 1,
            wmode: "opaque"
        }
        });
    }
</script>
<style>
.marqdiv_top{
	  z-index:9999;
	  position:absolute;
	  margin-top:-30px;
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
  }


.video-section .pattern-overlay {
	/*background-color: rgba(71, 71, 71, 0.59);*/
	padding: 110px 0 32px;
	min-height: 450px;/* Incase of overlay problems just increase the min-height*/
	z-index:-1;
	position:relative;
}

@media  only screen and (max-width: 960px){
body{
	background-size: 100% 100%;
}
.bodybackground {
	margin-left:0px;
}
.formdiv{
	width: 750px;
	margin-top: 150px;
}
}
@media  only screen and (max-width: 500px){
.player{
width: 320px;
height: 177px;
margin-top: 130px;
}
.formdiv{
	width: 320px;
margin-top: -135px;
}
.forminner {
    padding: 10px 0px;
}
}

</style>
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