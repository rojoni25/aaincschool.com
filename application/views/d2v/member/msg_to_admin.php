
<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header"> Message To Admin (D2V)</h3>
    </div>
  </div>
</div>

<?php if($this->session->flashdata('show_msg')){?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
</div>
<?php } ?>

<div class="row-fluid">
  <div class="span12">
    <form action="<?=base_url()?>index.php/d2v/<?=$this->uri->rsegment(1)?>/msg_to_admin_insert/" method="post">
      <input type="hidden" name="ref_url" value="<?=$ref_url?>" />
      <table class="table table-striped table-bordered">
        <tr>
          <td width="19%">Subject</td>
          <td width="1%"></td>
          <td width="80%"><input type="text" name="subject" id="subject" class="span12" value="" required="required" placeholder="Subject" required="required" /></td>
        </tr>
        
        <tr>
          <td>Message</td>
          <td></td>
          <td><textarea id="msg" name="msg" class="span12" required="required" placeholder="Message"></textarea></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td><button type="submit" class="btn btn-primary">Send</button></td>
        </tr>
      </table>
    </form>
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
	.cls_head_btn{
		font-family: Arial, Helvetica, sans-serif;
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
