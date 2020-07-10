<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
<div class="marquee_div"> <span class="spm_llb">Just Joined</span>
  <marquee>
  <h3 class="maq_h3">
    <?=$this->session->userdata["ref"]["currect_add"]?>
  </h3>
  </marquee>
</div>
<?php } ?>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">
        <?=$title?>
      </h3>
    </div>
  </div>
</div>
<?php if($this->session->flashdata('show_msg')!=''){?>
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <i class="icon-info-sign"></i><strong>
  <?=$this->session->flashdata('show_msg')?>
  </strong> </div>
<?php } ?>

<div style="clear:both;overflow:hidden;"></div>


<div class="row-fluid" style="margin-bottom:20px;">
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
    <div class="txtdiv">
      <?=$contain[0]['textdt']?>
    </div>
    <div style="clear:both;overflow:hidden;"></div>
  </div>
</div>

<style>
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
		width:95%;
		position:relative;
		margin:auto;
	}
</style>

