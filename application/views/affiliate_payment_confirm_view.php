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

<?php if($this->session->flashdata('show_msg')!=''){?>
    <div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('show_msg');?></strong>
	</div>
    <?php } ?>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Affiliate Payment Confirm</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Payment</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Affiliate Confirm Message</li>
    </ul>
  </div>
</div>
<form action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" method="post" id="frmlist">
  <div class="row-fluid">
    <div class="span12">
      <table width="100%">
      	<tr>
          <td><input type="text" name="subject" id="subject" class="txt" placeholder="Enter Subject" required="required" /></td>
        </tr>
        <tr>
          <td><textarea id="msg" name="msg" placeholder="Enter your payment transaction details To Affiliate" class="txtarea" value="" required="required"></textarea></td>
        </tr>
        <tr>
          <td><input type="submit" class="btn btn-success" value="Send" /></td>
        </tr>
      </table>
    </div>
  </div>
</form>


<div class="row-fluid">
<div class="">

  <div class="">
    <?php
                    if($result[0]['video_url']!=''){
						echo '<div class="video_frm">';
						echo '<div class="inner_frm">';
						if (strpos($result[0]['video_url'], 'youtube') !== false)
						{
							echo '<iframe width="100%" height="100%" src="'.$result[0]['video_url'].'" frameborder="0" allowfullscreen></iframe>';
						}
						else{
							echo '<video width="100%" height="100%" controls="controls"><source src="'.$result[0]['video_url'].'" type="video/mp4"></video>';
						}
						echo '</div>';
						echo '</div>';
                    }
                    
                    ?>
  </div>
  <div style="margin-top:30px;">
    <div>
      <?=$result[0]['textdt']?>
    </div>
  </div>
</div>
</div>

<style>
	.txtarea{
		width:90%;
		height:120px;
		resize:none;
	}
	.txt{
		width:90%;
	}
	
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
