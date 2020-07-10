<script>
	$(document).on('submit', '#frmsubmit', function(){
		if($('#page_key').val()==''){
			$('#page_key').focus();
			return false;	
		}
	});
</script>


<div class="row">    
  <ul class="top-banner"></ul>
</div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>
<?php } ?>
<div class="tz-2 tz-2-admin">
  <div class="tz-2-com tz-2-main">    
    <h4><?=$contain[0]['title']?></h4>
    <br>
    <div class="row">
      <?php if(isset($get_top_referal_list) && count($get_top_referal_list)){ ?>
      <div class="col-md-4">
      <div class="table-responsive" style="background-color: #b32c2c; color: #fff;">
        <h4>Top Recuriter of All Time</h4>
        <table class="table">
          <?php 
          $sr=1;
          foreach ($get_top_referal_list as $key => $value) { ?>
          <tr>
            <td><?php echo "#$sr"; $sr++; ?></td>
            <td><?php echo $value->fname.' '.strtoupper(substr($value->lname, 0, 1)); ?></td>
            <td><?php echo $value->orders; ?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
      </div>
      <?php } ?>

      <?php if(isset($get_top_month_referal_list) && count($get_top_month_referal_list)){ ?>
      <div class="col-md-4">
      <div class="table-responsive" style="background-color: #0d690d; color: #fff;">
        <h4>Top Referal Month</h4>
        <table class="table">
          <?php
          $sr=1;
          foreach ($get_top_month_referal_list as $key => $value) { ?>
          <tr>
            <td><?php echo "#$sr"; $sr++; ?></td>
            <td><?php echo $value->fname.' '.strtoupper(substr($value->lname, 0, 1)); ?></td>
            <td><?php echo $value->orders; ?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
      </div>
      <?php } ?>

      <?php if(isset($get_top_week_referal_list) && count($get_top_week_referal_list)){ ?>
      <div class="col-md-4">
      <div class="table-responsive" style="background-color: #0a2b86; color: #fff;">
        <h4>Top Referal of Week</h4>
        <table class="table">
          <?php
          $sr=1;
          foreach ($get_top_week_referal_list as $key => $value) { ?>
          <tr>
            <td><?php echo "#$sr"; $sr++; ?></td>
            <td><?php echo $value->fname.' '.strtoupper(substr($value->lname, 0, 1)); ?></td>
            <td><?php echo $value->orders; ?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
      </div>
      <?php } ?>
    </div>

    <div class="row">
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
        	<div class="txtdiv"><?=$contain[0]['textdt']?></div>
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
	
@media  only screen and (max-width: 535px){
.video_frm {
   width: 284px;
height: 200px;
}

.inner_frm {
    height: 176px;
    width: 235px;
    margin-top: 12px;
    margin-left: 24px;
}
}
@media  only screen and (max-width: 310px){
.video_frm {
    width: 190px;
    height: 134px;
}

.inner_frm {
    height: 118px;
width: 157px;
margin-top: 8px;
margin-left: 16px;
}
}
</style>
