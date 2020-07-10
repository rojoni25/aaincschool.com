<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<script>
	$(document).ready(function(e) {
		/////////////////
		$("#membername").autocomplete({
                        source:'<?php echo base_url();?>index.php/comman_controler/auto_camplate_active',
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
	   
	   	$(document).on('click', '.btn-confirm', function (e) {
			var con=confirm('Are You Sure Payment ?');   
			if(!con){
				return false;
			}
			else{
				$('.btn-confirm').hide();
				$('.msg_div').html('processing..');
			}
		});
	});
	
</script>
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Member Monthly Payment
          <?php if(isset($result[0])) {?>
          		<a href="<?=base_url()?>index.php/monthly_payment_by_admin" class="pull-right"><span class="label label-important btn_back">Back</span></a>
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
    
    <?php if($_REQUEST['status']=='fail') {?>
    	<div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="icon-minus-sign"></i><strong><?=$_REQUEST['msg']?></strong>
        </div>
    <?php } ?>
        
	<?php if($_REQUEST['status']=='true') {?>
         <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="icon-ok-sign"></i><strong><?=$_REQUEST['msg']?></strong>
         </div>
    <?php } ?>
    
    <div class="row-fluid">
      <div class="span6">
        <?php if(isset($result[0])) {?>
        		<form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/auto_payment/admin_payment/<?=$result[0]['usercode']?>">
                	<input type="hidden" value="<?=$result[0]['usercode']?>" name="usercode" id="usercode" />
         		<table class="table" style="font-weight:bold;">
                	<tr>
                    	<td width="30%">Member Name</td>
                        <td width="1%">:</td>
                        <td width="69%"><?=$result[0]['fname']?> <?=$result[0]['lname']?></td>
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
                    <?php
                    	$curretn_time=time();
						$st=($curretn_time > $result[0]['due_time'] ? "Due" : "Active");
					?>
                     <tr>
                    	<td>Status</td>
                        <td>:</td>
                        <td>Paid (<?=$st?>)</td>
                    </tr>
                    <tr>
                    	<td>Due Date</td>
                        <td>:</td>
                        <td><?=date('d-m-Y',$result[0]['due_time'])?></td>
                    </tr>
                    <tr>
                    	<td>Current Balance</td>
                        <td>:</td>
                        <td><?=$current_balance[0]['main_balance']?></td>
                    </tr>
                    <tr>
                    	<td>Payment Level</td>
                        <td>:</td>
                        <td><?=$payment_level[0]['tot']?></td>
                    </tr>
                </table>
                
					<div class="form-actions"><button type="submit" class="btn btn-primary btnsubmit btn-confirm">Payment</button>
                    							
                    <p style="color:#F00;font-weight:bold;" class="msg_div">Click Once Only</p>
				
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