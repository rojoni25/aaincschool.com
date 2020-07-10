<script>
	
	
	
	$(document).on('submit','#fsend',function(e){
		var amount=parseFloat($('#amount').val());
		if(amount <=0){
			alert('InVailed Amount');
			return false;
		}	
	});
</script>

<div class="row-fluid">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Diamond Purchase Program</h3>
    </div>
    <span id="show_msg"></span>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#"><?=MATRIX_LLB?></a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li>Message<span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Diamond Purchase Program</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12 membertable">
    <form action="<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/payment" method="post" id="fsend">
      <table class="stat-table table table-stats table-striped table-sortable table-bordered">
        <tr>
          <td width="19%">Amount</td>
          <td width="1%"></td>
          <td width="80%"><input type="number" id="amount" name="amount" placeholder="Enter Amount" required="required" /></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td><button class="btn btn-success"><strong>Payment</strong></button></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<style>

	
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
	width:500px !important;
}
</style>
<style>
	.read_status0{
		background-color:#87EDDB !important;
	}
	.noto-div{
		background-color:#C4E7FE;
		color:#000;
	}
	.noti-date
	{
		font-weight:bold;
		color:#30863D;
	}
	.noti-date sub{
		color:#F00;
	}
	
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
	.list_um{
		list-style:none;
		margin:0px;
		padding:0px;
		color:#369;
	}
	.list_um li{
		float:left;
		padding:2px 10px 10px 0px;
	}
	.alert i{
		font-size:16px !important;
	}
</style>
