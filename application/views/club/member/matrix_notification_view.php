<script>
	$(document).on('click', '.btn-delete', function (e) {
		var value=$(this).attr('value');
		var url='<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/record_update/'+value;
		alert(url);
		$.ajax({url:url,success:function(result){
		}});
	});
</script>

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<h3 class="page-header">Notification <a href="<?=MATRIX_BASE?>/martix/dashboard/" class="pull-right"><span class="label label-success"><font style="font-weight:bold;letter-spacing:1px;">Dashboard</font></span></a></h3>
<div class="row-fluid">
  <div class="span12">
    <?php for($i=0;$i<count($result);$i++){ 
			$cls=($result[$i]['status_receiver']=='Unread')	?	"noto-unread"	:	"noto-div";
	?>
    <div class="alert <?=$cls?>">
      <p class="noti-date">
        <?=$result[$i]['title']?>
        <sub>
        <?=date('jS F Y',$result[$i]['time_dt'])?>
        </sub></p>
      <button type="button" class="close btn-delete" data-dismiss="alert" value="<?=$result[$i]['id']?>">&times;</button>
      <?=$result[$i]['description']?>
    </div>
    <?php }?>
  </div>
</div>
<style>
	
	.noto-unread{
		background-color:#6EDDB2;
		color:#000;
	}
	.noto-div{
		background-color:#B6CDD2;
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
</style>
