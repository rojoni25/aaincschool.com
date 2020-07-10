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

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Team Build</h3>
    </div>
    <div class="pull-left">
    	<form action="<?=base_url()?>index.php/scompany/view" method="get" id="frmsubmit" style="margin:0px;">
      		<label style="margin-top:9px;float:left;margin-right:5px;"><strong>Enter Page Key</strong></label>
      		<input type="text" name="page_key" id="page_key" />
           
      		<button type="submit" class="btn btn-info btngoto" style="margin-top:-11px;">Go</button>
    	</form>
     
	 <?php if($this->session->flashdata('show_msg')!=''){?>
            <div class="alert" style="margin:0px;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="icon-exclamation-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
            </div>
    <?php } ?>
    
    </div>
    
   
    
    <div style="clear:both;overflow:hidden;"></div>
   
  </div>
</div>
<div class="row-fluid ">
  <div class="">
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
  <div style="margin-top:30px;">
    <div class="txtdiv">
      <?=$contain[0]['textdt']?>
    </div>
    <div style="clear:both;overflow:hidden;"></div>
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
</style>
