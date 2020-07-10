<link rel="stylesheet" href="<?=base_url();?>asset/popover/jquery.webui-popover.min.css">
<script src="<?=base_url();?>asset/popover/jquery.webui-popover.min.js"></script>
<script>

	$(document).ready(function(e) {
         ///////////
			$('.show-pop-event').each(function(i,elem) {
			//webuiPopover
				var url=$(this).attr('href');
					$(this).webuiPopover({
					constrains: 'bottom', 
					trigger:'click',
					multi: false,
					placement:'auto',
					type:'async',
					container: "body",
					url:url,
					cache:false,
					content: function(data){
						return data;
					}
				});
			//end webuiPopover
			});
		  //////////
    });
	
	$(document).on('submit','#send_msg_to_admin_from',function(e){
		e.preventDefault();
		
		if($('#noti_description').val()==''){
			$('#noti_description').focus();
			return false;
		}
		
		var form = $(this);
		var post_url = form.attr('action');
		$(".submit_process").html("<i class='icon-spinner icon-spin'></i> processing......");
		$('.tr_submit_tr').hide();
		$.ajax({
			type: 'post',url: post_url,data: $(this).serialize(),
			success: function (result) {							
				var data	=	$.parseJSON(result);
				$('.pop-div-main').html(data['msg']);	
			}
		});
			
	});


</script>

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Diamond Withdrawal Request
        <div class="pull-right"> <a href="<?=diamond_base()?>page/view">
          <button class="btn btn-round-min btn-success"><span><i class="icon-home"></i></span></button>
          </a> </div>
      </h3>
    </div>
  </div>
</div>
<?php if($this->session->flashdata('show_msg')!=''){?>
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <i class="icon-info-sign"></i><strong>
  <?=$this->session->flashdata('show_msg');?>
  </strong> </div>
<?php } ?>
<?php
	$pending=$this->comman_fun->get_table_data('diamond_withdrawal',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode'],'status'=>'process'));	
?>
<div class="row-fluid">
  <div class="span6">
    <?php if(isset($pending[0])){  ?>
    <h5>One Withdrawal Request Is Aleardy Pending </h5>
    <table class="table">
      <tr>
        <td width="19%">Amount</td>
        <td width="1%">:</td>
        <td width="80%">$
          <?=number_format($pending[0]['amount'],2)?></td>
      </tr>
      <tr>
        <td>Date</td>
        <td>:</td>
        <td><?=date('d-m-Y',strtotime($pending[0]['date_dt']))?></td>
      </tr>
      <tr>
        <td>Description</td>
        <td>:</td>
        <td><?=$pending[0]['text_dt']?></td>
      </tr>
    </table>
    <?php } else { ?>
    <form class="form-horizontal left-align" id="form2" method="post" action="<?=diamond_base()?><?=$this->uri->rsegment(1)?>/insert" enctype="multipart/form-data">
      <table class="table">
        <tr>
          <td width="15%">Balance</td>
          <td width="1%">:</td>
          <td width="84%"><input  value="$<?=number_format($payment['balance'],2)?>" class="span12" type="text" disabled="disabled"  /></td>
        </tr>
        <tr>
          <td width="15%">Amount</td>
          <td width="1%">:</td>
          <td width="84%"><input id="amount" name="amount" value="<?=$result[0]['amount']?>" class="span12" type="number" step="0.01" placeholder="Enter Amount"/></td>
        </tr>
        <tr>
          <td>Description</td>
          <td>:</td>
          <td><textarea id="text_dt" name="text_dt" class="span12"  placeholder="Enter Description"><?=$result[0]['text_dt']?>
</textarea></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td><button type="submit" class="btn btn-primary btnsubmit">Submit</button></td>
        </tr>
      </table>
    </form>
    <?php } ?>
  </div>
  <div class="span6">
    <table class="table">
      <tr>
        <td width="19%">Balance</td>
        <td width="1%">:</td>
        <td width="80%"><strong>$
          <?=number_format($payment['balance'],2)?>
          </strong></td>
      </tr>
    </table>
  </div>
</div>


<div class="row-fluid">
  <div class="span12">
    <h3 class="page-header">Withdrawal Report</h3>
    <table class="table">
      <thead>
        <tr>
          <th>Sr.No</th>
          <th>Date</th>
          <th>Amount</th>
          <th>Remark</th>
        </tr>
      </thead>
      <tbody>
        <?php  for($i=0;$i<count($withdrawal_list);$i++){
						$row_num=$i+1;
					echo '<tr>
							<td>'.$row_num.'</td>
							<td>'.date('d-m-Y',strtotime($withdrawal_list[$i]['date_dt'])).'</td>
							<td>'.$withdrawal_list[$i]['amount'].'</td>
							<td>'.$withdrawal_list[$i]['text_dt'].'</td>
		                </tr>';
				} ?>
      </tbody>
    </table>
  </div>
</div>


<style>
	.page-header{
		font-family: Arial, Helvetica, sans-serif;
	}
</style>
