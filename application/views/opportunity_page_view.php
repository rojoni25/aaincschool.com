<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header"> <?=$contain[0]['company_name']?></h3>
    </div>
  </div>
</div>

<div class="row-fluid ">
  <div class="">
    <?php
                    if($contain[0]['video_link']!=''){
						echo '<div class="video_frm">';
						echo '<div class="inner_frm">';
						if (strpos($contain[0]['video_link'], 'youtube') !== false)
						{
							echo '<iframe width="100%" height="100%" src="'.$contain[0]['video_link'].'" frameborder="0" allowfullscreen></iframe>';
						}
						elseif (strpos($contain[0]['video_link'], 'slideshare') !== false)
						{
							echo '<iframe width="100%" height="100%" src="'.$contain[0]['video_link'].'" frameborder="0" allowfullscreen></iframe>';
						}
						else{
							echo '<video width="100%" height="100%" controls="controls"><source src="'.$contain[0]['video_link'].'" type="video/mp4"></video>';
						}
						echo '</div>';
						echo '</div>';
                    }
                    
                    ?>
  </div>
  <div style="margin-top:30px;">
    <div class="txtdiv">
      <?=$contain[0]['page_contain']?>
    </div>
    <div style="clear:both;overflow:hidden;"></div>
  </div>
</div>




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
</style>
