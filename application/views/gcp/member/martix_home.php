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
	$(document).on('submit','#fmsg',function(e){
		e.preventDefault();
		
		if($('#txtmsg').val()==""){ 
			$('#txtmsg').focus(); return;
		}
		
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
				if(data['vali']=='true'){
					$('.pop-div-main').html(data['msg']);
				}
				
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
      <h3 class="page-header"><?=MATRIX_CODE_LLB?></h3>
    </div>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray">
      <ul class="clearfix switch-item switch_item_custom">
        <li><a href="<?=MATRIX_BASE?>martix_position/view/" class="orange"><i class="icon-file-alt"></i><span>Position</span></a></li>
        <li><a href="<?=MATRIX_BASE?>martix_position/view/" class=" blue-violate"><i class="icon-lightbulb"></i><span>Position Details</span></a></li>
        <li><a href="<?=MATRIX_BASE?>martix_message/compose" class="dark-yellow"><i class="icon-share-alt"></i><span>Message To Admin</span></a></li>
        <li><a href="<?=MATRIX_BASE?>request_position/view" class="green"><i class="icon-share-alt"></i><span>Request Position </span></a></li>
       
      </ul>
    </div>
  </div>
</div>


<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray"> 
      <ul class="clearfix switch-item switch_item_custom">
      	 <li><a href="<?=MATRIX_BASE?>pif_friend/view" class="cls-color-1"><i class="icon-user"></i><span>PIF For Friend</span></a></li>
         <li><a href="<?=MATRIX_BASE?>martix_position/view" class="cls-color-6"><p>$<?=number_format($paymant['coin_balance'],2)?></p><span>Wallet</span></a></li>
         <li><a href="<?=MATRIX_BASE?>martix_withdrawal/view" class="bondi-blue"><i class="icon-money"></i><span>Withdrawal</span></a></li>
         <li><a href="<?=base_url()?>index.php/capture_pages" class="cls-color-7"><i class="icon-th"></i><span>Capture Pages</span></a></li>
      </ul>
    </div>
  </div>
</div>



<div class="row-fluid">
  <div class="span12">
    <div class="switch-board gray"> 
      <ul class="clearfix switch-item switch_item_custom">
         <li><a href="<?=MATRIX_BASE?>matrix_notification/view" class="cls-color-8"><p><?=$notification?></p><span>New Notification</span></a></li>
         <li><a href="<?=MATRIX_BASE?>company_pages/view/" class="cls-color-3"><i class="icon-book"></i><span>Benefits Pages</span></a></li>
      </ul>
    </div>
  </div>
</div>


<div class="row-fluid ">
  <div class="span6" style="overflow:hidden">
    <?php
			$video_link = explode('||',$cms[0]['video_url']);
			
			

			for($i=0;$i<count($video_link);$i++){
					
					if($video_link[$i]==''){
						continue;
					}
					
					$cls=("margin_none");
					echo '<div class="step_div span12 '.$cls.'">';
					echo '<div class="video_frm">';
					echo '<div class="inner_frm">';
					if (strpos($video_link[$i], 'youtube') !== false)
					{
							echo '<iframe width="100%" height="100%" src="'.$video_link[$i].'" frameborder="0" allowfullscreen></iframe>';
					}
					else{
							echo '<video width="100%" height="100%" controls="controls"><source src="'.$video_link[$i].'" type="video/mp4"></video>';
					}
					echo '</div>';
					echo '</div>';
					echo '</div>';
			} 
			
			
          ?>
  </div>
  <!---------VIDEO DISPLAY----------->
  <div class="span6" style="overflow:hidden">
    <div class="">
      <div class="txtdiv" style="overflow:hidden">
        <?=$cms[0]['textdt']?>
      </div>
    </div>
  </div>
  <div style="clear:both;overflow:hidden;"></div>
</div>

<style>
	.btncls{
		border:none;
	}
	.step_div{
		
	}
	.step_div h2{
		font-size:16px;
		text-align:center;
		margin:0px;
		padding:0px;
		margin-top:10px;
		line-height:25px;
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
	.margin_none{
		margin:0px !important;
	}
	.btncls{
		border:none;
	}
</style>
<style>
	.switch_item_custom li{
		width:150px;
		height:100px;
	}
	.switch_item_custom li a{
		width:150px;
		height:100px;
	}
	.switch_item_custom li p{
		font-size:20px !important;
		font-weight:bold;
		padding-top:20px;
		color:#FFF;
	}
	.switch_item_custom li a span {
		font-weight:bold;
		font-size:14px !important;
	}
	
	
</style>
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
	width:700px !important;
	min-height:100px;
}
</style>
