<script>
	$(document).on('click','#agree_btn',function(e){
		var con=confirm('Are You Agree');
		if(con){
			var url='<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/agree/';
			window.location.href=url;
		}
	});
</script>

<div class="row-fluid">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<div class="row-fluid ">
  <div class="span12">
    <div style="text-align:center;">
      <?php if($agree[0]){?>
      <span style="font-size:16px;font-weight:bold;margin-right:5px;">You are agreed with NDA</span>
      <?php } ?>
      <a class="payment_btn temp-hide" href="<?=base_url()?>index.php/monthly_payment_active_member/marketing_product/nda"><img src="<?=base_url()?>asset/images/credit_card_img.gif" alt="Payment" /></a> </div>
  </div>
</div>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">
        <?=$result[0]['page_name']?>
        <?php if(!$agree[0]){?>
        		<a class="pull-right" href="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/agree/?page_key=<?=$_REQUEST['page_key']?>"><button class="btn btn-success" id="agree_btn"><strong>YES I am Agree</strong></button></a>
        <?php } ?>
      </h3>
    </div>
  </div>
</div>
<div class="row-fluid">
  <div class="">
    <h4 style="margin-bottom:20px;">
      <?=$result[0]['page_title']?>
    </h4>
    <div class="">
      <?php
                    if($result[0]['video_link']!=''){
						echo '<div class="video_frm">';
						echo '<div class="inner_frm">';
						if (strpos($result[0]['video_link'], 'youtube') !== false)
						{
							echo '<iframe width="100%" height="100%" src="'.$result[0]['video_link'].'" frameborder="0" allowfullscreen></iframe>';
						}
						else{
							echo '<video width="100%" height="100%" controls="controls"><source src="'.$result[0]['video_link'].'" type="video/mp4"></video>';
						}
						echo '</div>';
						echo '</div>';
                    }
                    
                    ?>
    </div>
    <div style="margin-top:30px;">
      <div>
        <?=$result[0]['contain']?>
      </div>
    </div>
  </div>
</div>
<?php if(!$agree[0]){?>
<div class="row-fluid ">
  <div class="span12">
    <div class="pull-right" style="padding:10px;"> <a href="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/agree/?page_key=<?=$_REQUEST['page_key']?>">
      <button class="btn btn-success" id="agree_btn"><strong>YES I am Agree</strong></button>
      </a> </div>
  </div>
</div>
<?php } ?>
<style>
	.btncls{
		border:none;
	}
	.video_frm{
		width: 473px;
		height: 333px;
		overflow:hidden;
		margin:auto;
		background-image:url(<?=base_url();?>asset/images/cap_frm.png);
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	.inner_frm{
		height: 291px;
		width: 390px;
		margin-top: 20px;
		margin-left: 40px;
	}
	.txtdiv{
		width:90%;
		position:relative;
		margin:auto;
	}
	
	@media  only screen and (max-width: 500px){
.video_frm {
    width: 330px;
	height: 233px;
 
}
.inner_frm {
  	height: 205px;
	width: 273px;
	margin-top: 14px;
	margin-left: 28px;
}
}
@media  only screen and (max-width: 360px){
.video_frm {
    width: 225px;
	height: 159px;
 
}
.inner_frm {
  	height: 139px;
    width: 186px;
    margin-top: 10px;
    margin-left: 19px;
}
}

.payment_btn{
	padding:23px;
	background-color:#999;
}
</style>
