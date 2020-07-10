<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>



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


<div class="row-fluid">
  <div class="span12">
    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/subscription_update">
    	<input type="hidden" name="update_card" value="true" />
      	<!------------------>
      	<div class="control-group">
        	<label class="control-label">Credit Card Number</label>
        	<div class="controls">
          		<input id="cardNumber" name="cardNumber" value="" required="required" class="span12 {validate:{required:true}}" type="text" placeholder="Credit Card Number"/>
        	</div>
      	</div>
      	<!------------------> 
      
      	<!------------------>
      	<div class="control-group">
        	<label class="control-label">Expiration Date</label>
        	<div class="controls">
          	<input id="expirationDate" name="expirationDate" value="" required="required" class="span12 {validate:{required:true}}" type="text" placeholder="YYYY-MM"/>
          	<br />
          	<span>YYYY-MM</span> </div>
      </div>
      
      <div class="form-actions">
        <button type="submit" class="btn btn-primary btnsubmit"><strong>Subscription</strong></button>
        <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">
        <button type="button" class="btn">Cancel</button>
        </a> </div>
    </form>
  </div>
</div>


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

