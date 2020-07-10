<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">
<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<script>
	$(document).ready(function(e) {
		/////////////////
		//
		$(document).on('change', '#payment', function (e) {
			 if(this.checked) {
        		$('.btn-confirm').html('Send Request With Payment Received');
    		}
			else{
				$('.btn-confirm').html('Send Request');
			}
		});
		$("#membername").autocomplete({
                        source:'<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/auto_camplate_active',
                        minLength:1,selectFirst: true,selectOnly: true,
						select: function(event, ui) {
						event.preventDefault();
							$(this).parent().children('#user_code').val(ui.item.value);
							//$('#category_code').val(ui.item.value);
							$('#name').val(ui.item.label);},
						
						focus: function(event, ui) {
							event.preventDefault();
							$(this).parent().children('#user_code').val(ui.item.value);
							$(this).val(ui.item.label);
							$(this).removeClass('loading');},
						change: function(event,ui){
							if(ui.item==null){
								$(this).val((ui.item ? ui.item.id : ""));
								$(this).parent().children('#user_code').val('');
								$(this).removeClass('loading');}
							else{
								$(this).removeClass('loading');}},
								search: function(){
								  $(this).addClass('loading');
									},
        				open: function(){
							$(this).removeClass('loading');
							}
              });
	   /////auto///////	
	   
	   
	});
	
</script>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Member Monthly Payment
        <?php if(isset($result[0])) {?>
        <a href="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>" class="pull-right"><span class="label label-important btn_back">Back</span></a>
        <?php } ?>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">System</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Member Monthly Payment</li>
    </ul>
  </div>
</div>


<?php if($this->session->flashdata('show_msg')){?>
<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <i class="icon-ok-sign"></i><strong>
  <?=$this->session->flashdata('show_msg')?>
  </strong> </div>
<?php } ?>

<div class="row-fluid">
  <div class="span6">
  
  <?php
  	
  ?>
    <?php if(isset($result[0])) {?>
    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insert_request/">
      <input type="hidden" value="<?=$result[0]['usercode']?>" name="usercode" id="usercode" />
      <table class="table" style="font-weight:bold;">
        <tr>
          <td width="30%">Member Name</td>
          <td width="1%">:</td>
          <td width="69%"><?=$result[0]['fname']?>
            <?=$result[0]['lname']?></td>
        </tr>
        <tr>
          <td>Usercode</td>
          <td>:</td>
          <td><?=$result[0]['usercode']?></td>
        </tr>
        <tr>
          <td>Username</td>
          <td>:</td>
          <td><?=$result[0]['username']?></td>
        </tr>
                           
        <?php  if(isset($request[0])){ ?>
        <tr>
          <td colspan="3"><?=$result[0]['fname']?> <?=$result[0]['lname']?> Is Already Send Request Of Upgrade Membership</td>
        </tr>
        <?php } else {?>
        	<tr>
          		<td>Check If Payment Received</td>
                <td></td>
                <td><input type="checkbox" value="Y" name="payment" id="payment" /></td>
        	</tr>
        	<tr>
          		<td></td>
                <td></td>
                <td><button type="submit" class="btn btn-primary btnsubmit btn-confirm">Send Request</button></td>
        	</tr>
        <?php } ?>
      </table>
    </form>
    <?php }else {?>
    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>" enctype="multipart/form-data">
      <div class="control-group">
        <label class="control-label">Search Member</label>
        <div class="controls">
          <input type="text" id="membername" value="" placeholder="Member Name, Code" class=" span12 {validate:{required:true}}" />
          <input type="hidden" id="user_code" name="user_code" />
        </div>
      </div>
      <!------------------>
      <div class="form-actions">
        <button type="submit" class="btn btn-primary btnsubmit">Check</button>
      </div>
    </form>
    <?php } ?>
  </div>
</div>
<style>
	.btn_back{
		padding:4px 11px;
	}
</style>
