<?php
	if($result[0]['page_bg_img']==''){
		$page_bg_img=''.base_url().'asset/capturepages/page1/Canvas_15.jpg';
	}
	else{
		$page_bg_img=$result[0]['page_bg_img'];
	}

	$audio=$result[0]['audio'];
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Now</title>

<meta property="og:title" content="Affiliworx" />
<meta property="og:image" content="<?=$page_bg_img?>" />
<?php if($result[0]['main_body_text']!=''){?>
	<meta property="og:description" content="" />
<?php } ?>

<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/capturepages/page1/default.css" />
<script src="<?=base_url();?>asset/js/jquery.js"></script>
<link href="<?=base_url();?>asset/capturepages/perfect-scrollbar.css" rel="stylesheet">
<script src="<?=base_url();?>asset/capturepages/perfect-scrollbar.js"></script>
<script src="<?=base_url();?>asset/js/capture_js.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/css/capture_css.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/css/capturepageresponsive.css" />

<style>
body {
	overflow: hidden;
	background: url('<?=$page_bg_img?>') no-repeat center center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}
</style>
</head>
<body  class="page-3">
<?php  if($result[0]['scrolling']=='top'){?>
<div class="marqdiv_top">
    <h4>Just Joined</h4>
     <marquee><h3><?=$current_join_mem?></h3></marquee>
</div>
<?php }?>

<div class="container">
  <div class="formmain" id="formmain">
    <form class="form-signin" method="post" action="<?php echo base_url();?>index.php/rg/insertrecord">
      
      <?php if($smfund){ echo '<input type="hidden" name="smfund" value="Y"/>'; } ?>
      <input  type="hidden" id="audio" name="audio" value="<?=$ref[0]['audio']?>"/>  
      <input  type="hidden" id="referralid" name="referralid" value="<?=$ref[0]['usercode']?>"/>
      <input  type="hidden" id="referralusername" name="referralusername" value="<?=$ref[0]['username']?>"/>
      <input  type="hidden"  id="baseurl" value="<?=base_url();?>"/>
      <input  type="hidden" id="pagecode" name="pagecode" value="<?=$pagecode?>"/>
            <input  type="hidden" name="redirect_url"  id="redirect_url" anme value="<?=$result[0]['redirect_url']?>"/>
      <table width="100%">
        <tr>
          <td valign="top" id="regtxt"><h3>Registration</h3>
          
              <p class="llbinviter" style="width:90%;">Your Inviter:<label>&nbsp;<?=$ref[0]['fname']?> <?=$ref[0]['lname']?></label></p>
            
            <p>
              <input type="text" name="fname" id="fname" placeholder="First Name" class="txt1" title="First Name">
            </p>
            <p>
              <input type="text" name="lname" id="lname" placeholder="Last Name" class="txt1" title="Last Name">
            </p>
            <p>
              <input type="text" name="emailid" id="emailid" placeholder="Email Id" class="txt1" title="Email Id">
            </p>
            <p>
              <input type="text" name="mobileno" id="mobileno" placeholder="Mobile Number" class="txt2" title="Mobile Number">
              <input type="text" name="skype" id="skype" placeholder="Skype" class="txt2" title="Skype">
            </p>
            <p>
              <input type="text" name="username" id="username" placeholder="Username" class="txt1" title="Username">
            </p>
            <p>
              <input type="password" name="password" id="password" placeholder="Password" class="txt2" title="Password">
              <input type="password" name="confirmpass" id="confirmpass" placeholder="Confirm Password" class="txt2" title="Confirm Password">
            </p>
            <?php if(isset($ref[0])){ ?>
	            <p><input type="submit" class="btnsubmit" value="<? if(!empty($result[0]['submit_button_title'])){
            			echo $result[0]['submit_button_title'];
            	}else{
            		echo "Take A Free Tour";
            	}?>"></p>
            <?php } ?>
            </td>
          <td valign="top" id="bltxt"></td>
          <td valign="top" width="33%">
              <div class="textdiv">
                <?php  if($result[0]['headline_text']!=''){
			  	$style_title=$result[0]['head_bg']=='Y'?'style="background:'.$result[0]['head_bg_col'].';color:#000;"':'';
			  	?>
			  		<h3 <?php echo $style_title; ?>><?=$result[0]['headline_text']?></h3>
			  <?php } ?>
                  <p><?php echo $result[0]['main_body_text']; ?></p>
              </div>
          </td>
        </tr>
      </table>
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
$(document).ready(function(){
   
     var audio = new Audio('<?php echo $audio; ?>');
	audio.play();
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
  }
  .marqdiv_left{
	width:20%;
	text-align:center;
	float:left;
	padding-left:10px;
	margin-top:-20px;
	z-index:9999;

}
.formmain p, .formmain h3 {
	text-align: left;
	margin-top:-5px;
}
.textdiv {
	color: #FFF;
	height: 300px;
	overflow: hidden;
}
.formmain {
	position: absolute;
	top: 15%;
	left: 0px;
	z-index: 999;
	color: #FFF;
	background: none repeat scroll 0% 0% rgba(0, 0, 0, 0.5);
	padding: 60px;
	padding-top:20px !important;
	height: 450px;
	width: 100%;
	text-align: center;
}
.txt1 {
	background: none;
	border: #FFF solid 1px;
	height: 27px;
	color: #FFF;
	padding: 3px;
	font-weight: bold;
	width: 90%;
}
.txt2 {
	background: none;
	border: #FFF solid 1px;
	height: 27px;
	color: #FFF;
	padding: 3px;
	font-weight: bold;
	width: 45%;
}
.btnsubmit {
	background: FFF;
	border: #FFF solid 1px;
	color: #F00;
	font-weight: bold;
	padding: 5px;
	cursor: pointer;
}
#regtxt{
	width:33%;
}
#bltxt{
	width:33%;
	}
@media  only screen and (max-width: 500px){

#regtxt{
	width:100%;
}
#bltxt{
	width:0%;
	}
.marqdiv_left{
	display:none;
}
	
}
</style>
<script>
	$(document).ready(function(e) {
		 $('.textdiv').perfectScrollbar({
			suppressScrollX: true,
			scrollYMarginOffset: 20
		});
       
	   $('#formmain').center();
    });
	jQuery.fn.center = function ()
	{
		this.css("position","fixed");
		var t=this.height();

		var top=($(window).height()-450)/2;
		if(top<1){
			top=0;
		}
		this.css("top",top);
		//this.css("left", ($(window).width() / 2) - (this.outerWidth() / 2));
		return this;
	}
	
	$(window).resize(function(){
		$('#formmain').center();
	}).resize();
</script>
