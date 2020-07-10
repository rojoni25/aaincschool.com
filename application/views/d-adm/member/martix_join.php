<link rel="stylesheet" href="<?=base_url()?>asset/popover/jquery.webui-popover.min.css">
<script src="<?=base_url()?>asset/popover/jquery.webui-popover.min.js"></script>
<script>
	$(document).on('submit', '#frmsubmit', function(){
		if($('#page_key').val()==''){
			$('#page_key').focus();
			return false;	
		}
	});
</script>
<script>
	$(document).on('submit', '#frmsubmit2', function(){
		if($('#sdk_code').val()==''){
			$('#sdk_code').focus();
			return false;	
		}
	});
</script>
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
	$(document).on('submit','#send_request_join',function(e){
		var con=confirm("Send Request");
		if(!con){
			e.preventDefault();
			return false;
		}
		$(".submit_process").html("<i class='icon-spinner icon-spin'></i> processing......");
		$('.tr_submit_tr').hide();	
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
      <h3 class="page-header"><?=MATRIX_LLB?></h3>
    </div>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <?php if(isset($result[0])){?>
    <div class="alert alert-success"> <i class="icon-ok-sign"></i><strong>Your Request Is Send</strong> </div>
    <?php }else{  ?>
    <a class="show-pop-event" href="<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/insert_request_pop">
    <button class="btn btn-success"><strong>Click Hear To Send Request</strong></button>
    </a>
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
	#txtmsg{
	resize:none;
	width:90%;
	height:140px;
}
	#show_msg{
	font-weight:bold;
	color:#090;
	font-size:18px;
}
.webui-popover {
	width:450px !important;
	min-height:100px;
}
</style>
