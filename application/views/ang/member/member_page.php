<link rel="stylesheet" href="<?=base_url()?>asset/popover/jquery.webui-popover.min.css">
<script src="<?=base_url()?>asset/popover/jquery.webui-popover.min.js"></script>
<script>
	$(document).on('click','.request_for_access_code',function(e){
		 e.preventDefault()
		 var url=$(this).attr('href');
		 $('.show_msg_request').html('Request Sending..');
		 $.ajax({url:url,success:function(result){		 	
		 	var data=$.parseJSON(result)
			$('.show_msg_request').html(data['msg']);
         }});
		 
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
	$(document).on('submit','#send_request_frm',function(e){
		e.preventDefault();
		
		if($('#txtmsg').val()==""){ 
			$('#txtmsg').focus(); return;
		}
		
		var con=confirm("Send Request");
		
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
    <div class="pull-left">
      <?php if(!$check['in_tree'] && !$check['in_access']){?>
      <a class="show-pop-event" href="<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/request_access_popup/" class="btn-right"><span class="label label-important">Request For Code</span></a> <br />
      <span class="show_msg_request"></span>
      <?php } ?>
    </div>
    <?php if(!$check['in_tree']){?>
    	<div class="pull-right">
      <form action="<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/view" method="post" id="frmsubmit2" style="margin:0px;">
        <label style="margin-top:9px;float:left;margin-right:5px;"><strong>Enter <?=MATRIX_CODE_LLB?> Code</strong></label>
        <input type="text" name="access_code" id="access_code" value="<?=$check['code']?>" />
        <input type="hidden" name="page_key" id="page_key" value="<?=$_REQUEST['page_key']?>" />
        <button type="submit" class="btn btn-info btngoto" style="margin-top:-11px;">Go</button>
      </form>
      <?php if($page_msg!=''){?>
      <div class="alert" style="margin:0px;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="icon-exclamation-sign"></i><strong>
        <?=$page_msg?>
        </strong> </div>
      <?php } ?>
    </div>
    <?php } ?>
    
    
    
  
    
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">
        <?=$contain[0]['page_title']?>
        <?php if(isset($permission[0])) { ?>
        <a href="<?=base_url()?>index.php/scompany/edit_page/<?=$contain[0]['secret_page_code']?>" class="btn-right"><span class="label label-success">Edit Page</span></a>
        <?php } ?>
      </h3>
    </div>
  </div>
</div>
<div class="row-fluid ">
  <div class="">
    <?php
                    if($contain[0]['video_link']!=''){
						echo '<div class="video_frm">';
						echo '<div class="inner_frm">';
						if (strpos($contain[0]['video_link'], 'youtube') !== false)
						{
							echo '<iframe width="100%" height="100%" src="'.$contain[0]['video_link'].'" frameborder="0" allowfullscreen></iframe>';
						}
						else{
							echo '<video width="100%" height="100%" controls="controls"><source src="'.$contain[0]['video_link'].'" type="video/mp4"></video>';
						}
						echo '</div>';
						echo '</div>';
                    }
                    
                    ?>
  </div>
  <div style="margin-top:30px;">
    <div class="txtdiv">
      <?=$contain[0]['contain']?>
    </div>
    <div style="clear:both;overflow:hidden;"></div>
  </div>
</div>
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
	.btn-right{
		float:right;
	}
	.btn-right span{
		padding:4px 10px !important;
		letter-spacing:1px !important;
	}
	.show_msg_request{
		font-weight:bold;
		font-size:14px;
		color:#090;
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
	width:450px !important;
	min-height:100px;
}
</style>
