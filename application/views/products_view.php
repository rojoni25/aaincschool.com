<script>
	$(document).on('click', '.btn-delete', function (e) {
		var value=$(this).attr('value');
		var url='<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/record_update/'+value;
		$.ajax({url:url,success:function(result){
		}});
	});
</script>

<div class="row">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
   <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Home</a> </li>
    <li class="active-bre"><a href="#"> Products</a> </li>
    
  </ul>
</div>
<div class="tz-2 tz-2-admin">
    <div class="tz-2-com tz-2-main">
      <h4>Products</h4>
		<!------------>
		<br>
		<div class="row">
		  <div class="span6">
		    <?php
	            if($contain[0]['video_url']!=''){
					echo '<div class="video_frm">';
					echo '<div class="inner_frm">';
					if (strpos($contain[0]['video_url'], 'youtube') !== false)
					{
						echo '<iframe width="100%" height="100%" src="'.$contain[0]['video_url'].'" frameborder="0" allowfullscreen></iframe>';
					}
					else{
						echo '<video width="100%" height="100%" controls="controls"><source src="'.$contain[0]['video_url'].'" type="video/mp4"></video>';
					}
					echo '</div>';
					echo '</div>';
	            }
            
            ?>
		  </div>
		  <div style="span6 margin-top:30px;">
		    <div class="txtdiv">
		      <?=$contain[0]['textdt']?>
		    </div>
		    <div style="clear:both;overflow:hidden;"></div>
		  </div>
		</div>
		<!------------>

		<div class="col-md-12"><?=$noti?></div>
	</div>
</div>


<style>
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
</style>


