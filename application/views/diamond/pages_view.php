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
      <h3 class="page-header"><?=$result[0]['pagename']?>
      
      	<div class="pull-right">
        	<a class="show-pop-event" href="<?=diamond_base()?>page/payment_confirm_from/"><span class="label label-important">Payment Confirm</span></a>
            <a class="show-pop-event" href="<?=diamond_base()?>page/message_to_admin_from/"><span class="label label-info">Message To Admin</span></a>
            
            <?php if($this->comman_fun->check_record('diamond_payment',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode']))){ ?>
            <a  href="<?=diamond_base()?>withdrawal/request/"><span class="label label-success">Diamond Wallet</span></a>
            <?php } ?>
        </div>
      </h3>
    </div>
  </div>
</div>

<?php if($this->session->flashdata('show_msg')!=''){?>
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="icon-info-sign"></i><strong><?=$this->session->flashdata('show_msg');?></strong>
    </div>
<?php } ?> 

<div class="row-fluid">
  <div class="">
    <h4 style="margin-bottom:20px;">
      <?=$result[0]['title']?>
    </h4>
    <div class="">
      <?php
                    if($result[0]['video_url']!=''){
						echo '<div class="video_frm">';
						echo '<div class="inner_frm">';
						if (strpos($result[0]['video_url'], 'youtube') !== false)
						{
							echo '<iframe width="100%" height="100%" src="'.$result[0]['video_url'].'" frameborder="0" allowfullscreen></iframe>';
						}
						else{
							echo '<video width="100%" height="100%" controls="controls"><source src="'.$result[0]['video_url'].'" type="video/mp4"></video>';
						}
						echo '</div>';
						echo '</div>';
                    }
                    
                    ?>
    </div>
    <div style="margin-top:30px;">
      <div>
        <?=$result[0]['textdt']?>
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
	
	@media  only screen and (max-width: 500px){
.video_frm {
    width: 330px;
	height: 233px;
 
}
.inner_frm {
  	height: 205px;
	width: 273px;
	margin-top: 14px;
	margin-left: 28px;
}
}
@media  only screen and (max-width: 360px){
.video_frm {
    width: 225px;
	height: 159px;
 
}
.inner_frm {
  	height: 139px;
    width: 186px;
    margin-top: 10px;
    margin-left: 19px;
}
}

.payment_btn{
	padding:23px;
	background-color:#999;
}
.txtbox{
	width:90%;
}

.txtarea{
	width:90%;
	resize:none;
	height:180px;
}

.page-header{
	font-family: Arial, Helvetica, sans-serif;
}
</style>
