

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>

	<?php if(isset($permistion[0])) {?>
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header"><?=$contain[0]['title']?> </h3>
        </div>
      </div>
    </div>
    <div class="row-fluid ">
      <div class="">
		<?php
            if($contain[0]['video_url']!=''){
                echo '<div class="video_frm">';
                echo '<div class="inner_frm">';
                if (strpos($contain[0]['video_url'], 'youtube') !== false)
                {
                    echo '<iframe width="100%" height="100%" src="'.$contain[0]['video_url'].'" frameborder="0" allowfullscreen></iframe>';
                }
                else{
                    echo '<video width="100%" height="100%" controls="controls"><source src="'.$contain[0]['video_url'].'" type="video/mp4"></video>';
                }
                echo '</div>';
                echo '</div>';
            }
     ?>
               
         
      </div>
   
     <div style="margin-top:30px;">
        	<div class="txtdiv"><?=$contain[0]['textdt']?></div>
            <div style="clear:both;overflow:hidden;"></div>
        </div>
    </div>
    
    <?php } else { ?>
    		<div style="margin-top:30px;">
        	<div class="txtdiv"><?=$contain[0]['textdt2']?></div>
            <div style="clear:both;overflow:hidden;"></div>
        </div>
     <?php } ?>
    
  
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
	
@media  only screen and (max-width: 535px){
.video_frm {
   width: 284px;
height: 200px;
}

.inner_frm {
    height: 176px;
    width: 235px;
    margin-top: 12px;
    margin-left: 24px;
}
}
@media  only screen and (max-width: 310px){
.video_frm {
    width: 190px;
    height: 134px;
}

.inner_frm {
    height: 118px;
width: 157px;
margin-top: 8px;
margin-left: 16px;
}
}
</style>
