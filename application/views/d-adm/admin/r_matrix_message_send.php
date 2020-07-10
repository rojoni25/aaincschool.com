<script>
	
	$(document).on('change','#current_panel',function(e){
	
		var value=$(this).val();
		
		var url='<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/'+value;
		
		window.location.href = url;

	});
	
	$(document).on('submit','#fsend',function(e){
		
		if($('#send_to').val()==''){
			$('#send_to').focus();
			return false;	
		}
		
		if($('#txtmsg').val()==''){
			$('#txtmsg').focus();
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

<?php
	$arr_segment=$this->uri->rsegment_array();
	echo list_matrix_menu($arr_segment);
?>

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
                <option>Select Option</option>
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
      <li><a href="#"><?=MATRIX_LLB?></a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li>Message<span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">
        <?=$title?>
      </li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12 membertable">
   		<form action="<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/message_insert" method="post" id="fsend">
        	<input type="hidden" name="send_form" value="compose" />
        	<table class="stat-table table table-stats table-striped table-sortable table-bordered">
            	<tr>
                	<td width="19%">Select Member</td>
                    <td width="1%"></td>
                    <td width="80%">
                    	<select name="send_to" id="send_to">
                        	<option value="">Select Member</option>
                            <?php
                            	for($i=0;$i<count($member);$i++){
									echo '<option value="'.$member[$i]['usercode'].'">'.$member[$i]['name'].' ( '.$member[$i]['usercode'].' )</option>';
								}
							?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                	<td>Message</td>
                    <td></td>
                    <td><textarea name="txtmsg" id="txtmsg" placeholder="Enter Message"></textarea></td>
                </tr>
                 <tr>
                	<td></td>
                    <td></td>
                    <td><button class="btn btn-success"><strong>Send</strong></button></td>
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
