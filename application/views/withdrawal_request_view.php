<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Withdrawal
     		<span style="float:right;">
            	<a href="<?=base_url()?>index.php/withdrawal_request/add_withdrawal">
                	<button class="btn btn-success"><strong>Withdrawal Amount</strong></button>
                </a>
            </span>
      </h3>
    </div>
  </div>
</div>

<div class="row-fluid">
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

<div class="row-fluid">
	<div class="span6">
    	<div class="primary-head"><h3 class="page-header">Withdrawal Request</h3></div>
        <div class="content-widgets white">
    	<table class="table">
        	<thead>
            	<tr>
                	<th>Request Code</th>
                    <th>Request Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            	<tbody>
            		<?=$request?>
            	</tbody>
        	</table>
        </div>
    </div>
    <div class="span6">
    	<div class="primary-head"><h3 class="page-header">Withdrawal Amount</h3></div>
        <div class="content-widgets white">
        <table class="table">
        	<thead>
            	<tr>
                	<th width="40%">CW To PW Transfer</th>
                    <th>$<?=number_format($cw_transfer,2)?></th>
                 
                </tr>
                <tr>
                	<th>PW To CW Transfer</th>
                    <th>$<?=number_format($pw_transfer,2)?></th>
                   
                </tr>
                 <tr>
                	<th>Total (<?=($cw_tot_transfer<0) ? "Minus" : "Plus" ;?>)</th>
                    <th>$<?=number_format($cw_tot_transfer,2)?></th>
                </tr>
            	
            </thead>
        </table>  
        <hr />  
    	<table class="table">
        	<thead>
            	<tr>
                	<th>Withdrawal Code</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            	<?=$withdrawal?>
            </tbody>
        </table>
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
	.btn_rem{
		color:#333;
		font-size:14px;
	}
	.btn_rem:hover{
		color:#333;
		font-size:14px;
		text-decoration:none;
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
</style>
