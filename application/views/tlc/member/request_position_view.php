<link rel="stylesheet" href="<?=base_url()?>asset/popover/jquery.webui-popover.min.css">
<script src="<?=base_url()?>asset/popover/jquery.webui-popover.min.js"></script>
<script>
	$(document).ready(function(e) {
         ///////////
			$('.show-pop-event').each(function(i,elem) {
			//webuiPopover
				var url=$(this).attr('href');
					$(this).webuiPopover({
					constrains: 'horizontal', 
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
</script>
<script>
	$(document).on('submit','#frequest',function(e){
		e.preventDefault();
		var con=confirm("Send To Admin");
		
		if(!con){
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
				$('#request_tbl tbody').html(data['html']);
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
<div class="row-fluid">
  <div class="span12">
    <h3 class="page-header">Request Position
      <div class="pull-right"> <a href="<?=base_url()?>index.php/monthly_payment_active_member/ltpay" class="temp-hide">
        <button class="btn btn-success btncustom" type="button">Online Payment</button>
        </a> <a href="<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/extra_position_popup" class="show-pop-event">
        <button class="btn btn-warning btncustom" type="button">Request Send For Extra Position</button>
        </a> <a href="<?=MATRIX_BASE?>martix/dashboard/">
        <button class="btn btn-danger btncustom" type="button">Dashboard</button>
        </a> </div>
    </h3>
    <table class="table table-striped table-bordered" id="request_tbl">
      <thead>
        <tr>
          <th width="10%">No</th>
          <th width="20%">Date</th>
          <th width="50%">Message</th>
          <th width="20%">Status</th>
        </tr>
      </thead>
      <tbody>
        <?=$pending_request?>
      </tbody>
    </table>
  </div>
</div>
<?php if(count($accept_result)>0) {?>
<div class="row-fluid">
  <div class="span12">
    <h3 class="page-header">Paid Extra Position</h3>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Request Date</th>
          <th>Position Date</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0;$i<count($accept_result);$i++){
			
				
				
				$no=$i+1;
				
				echo '<tr>
            			<th>'.$no.'</th>
            			<th>'.date('d-m-Y',$accept_result[$i]['request_time']).'</th>
						<th>'.date('d-m-Y',$accept_result[$i]['add_time']).'</th>
						<th><a href="'.MATRIX_BASE.'martix_position/position_detail/'.$accept_result[$i]['idcode'].'"><span class="label label-important">GO</span></a></th>
            		 </tr>';
			}?>
      </tbody>
    </table>
  </div>
</div>
<?php } ?>
<style>
	.tot_m_14{
		background-color:#80cbc4 !important;	
	}
	.incomplete{
		background-color:#ffecb3;
	}
	.con_td_2{
		background-color:#80cbc4 !important;	
	}
	.con_td_4{
		background-color:#80cbc4 !important;	
	}
	.con_td_8{
		background-color:#80cbc4 !important;	
	}
	#txtmsg{
	resize:none;
	width:90%;
	height:140px;
}
.verified{
	font-weight:bold;
	color:#060;
}
#show_msg{
	font-weight:bold;
	color:#090;
	font-size:18px;
}
.webui-popover {
	width:700px !important;
	min-height:100px;
}
.btncustom{
	font-weight:bold;
}
</style>
