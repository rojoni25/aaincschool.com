<script src="<?=base_url()?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url()?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url()?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>asset/js/TableTools.js"></script>
<link rel="stylesheet" href="<?=base_url()?>asset/popover/jquery.webui-popover.min.css">
<script src="<?=base_url()?>asset/popover/jquery.webui-popover.min.js"></script>
<script>
	$(document).ready(function(e) {
        get_popover();
    });
</script>
<script>
	$(document).on('submit','#frm_pay',function(e){
		e.preventDefault();
	
		var con=confirm("Are You Sure?");
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
					listing();
				}
				
			}
		});
			
	});
	
	
	
</script>
<script>
	$(document).ready(function() {
		listing();
	});
	
	
	
	function get_popover(){
		/////
		$('.show-pop-event').each(function(i,elem) {
		//webuiPopover
			var url=$(this).attr('href');
			$(this).webuiPopover({
			constrains: 'vertical', 
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
		////
	}

</script>
<script>
	$(document).on('click','.btn-delete',function(e){
		
		e.preventDefault();
		
		var value=$(this).attr('value');
		
		var url='<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/delete_inbox/'+value;
		
		$.ajax({url:url,success:function(result){
			
		}});
		
	});
	
	$(document).on('change','#current_panel',function(e){
	
		var value=$(this).val();
		
		var url='<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/'+value;
		
		window.location.href = url;

	});
	
	
</script>

<div class="row-fluid">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<?=kdk_admin_menu();?>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">
        <?=$title?>
        <span class="pull-right">
        	<select id="current_panel">
            	<?php
                	$sel_1=($this->uri->segment(2)=='inbox') ? "selected='selected'" : "";
					$sel_2=($this->uri->segment(2)=='outbox') ? "selected='selected'" : "";
					$sel_3=($this->uri->segment(2)=='compose') ? "selected='selected'" : "";
				?>
            	<option <?=$sel_1?> value="inbox">Inbox</option>
                <option <?=$sel_2?> value="outbox">Outbox</option>
                <option <?=$sel_3?> value="compose">Compose</option>
            </select>
        </span>
      </h3>
    </div>
    <span id="show_msg"></span>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">R-Matrix</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li>Message<span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">
        <?=$title?>
      </li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12 membertable">
    <?=$html?>
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
