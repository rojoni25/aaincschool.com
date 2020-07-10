<script src="<?php echo base_url();?>asset/js/popup/js/lightbox.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/jquery.carouFredSel-5.5.0-packed.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/jquery.magnific-popup.js"></script>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/js/popup/css/lightbox.css">
<script>
	$(document).on('click', '.cls_msg_admin', function (e) {
		e.preventDefault();
		var url='<?php echo base_url();?>index.php/upgrade_membership/message_to_admin';
		$.magnificPopup.open({items: { src:url},type: 'ajax',modal: true,preloader: false}, 0);
	})
	
	$(document).on('click', '.popup-modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});
</script>
<div class="marquee_div">
    <span class="spm_llb">Just Joined</span>
    <marquee>
    	<h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3>
    </marquee>
</div> 
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
	<ul>
		<li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
		<li class="active-bre"><a href="#"> Welcome</a> </li>
		<li class="page-back"> <a href="#"> <i class="fa fa-calendar" aria-hidden="true"></i> <?=date('F d, Y')?></a> </li>
		<li class="active-bre page-back"> Last Login Date & Time : <?=lastlogin($this->session->userdata['logged_ol_member']['usercode'])?></li>
		<li class="page-back materialize-red-text"> Your Username : <?=$this->session->userdata['logged_ol_member']['username']?></li>
		
	</ul>
	
</div>
<div class="tz-2 tz-2-admin">
	<div class="tz-2-com tz-2-main">
		<h4 class="page-header">
			Payment Confirm
			<span class="pull-right">
				<!-- <a class="cls_msg_admin" href="#"><label class="label label-success">Message To Admin</label></a> -->
			</span>
			
		</h4>
		<div class="tz-2-main-2 row"> 
			<div class="col-md-12 hom-cre-acc-left hom-cre-acc-right">
			 	<form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord">
        	 
			          <div class="control-group">
			            <label class="control-label">Type <span style="color: #d9534f;">*</span></label>
			            <div class="controls">
			            	<select name="paytype" id="paytype" class="span12 {validate:{required:true}}" required>
			            		<option value="">--Select Payment Type--</option>
			            		<option value="cashapp">Cash App</option>
			            		<option value="paypal">Paypal</option>
			            		<option value="bitcoin">Bitcoin </option>
			            	</select>
			            </div>
			          </div>
			          <div class="control-group">
			            <label class="control-label">Amount  <span style="color: #d9534f;">*</span></label>
			            <div class="controls">
			              <input id="amount" name="amount" value="" class="span12 {validate:{required:true}}" required type="text" placeholder="Enter Amount"/>
			            </div>
			          </div>
			          
			          <div class="control-group">
			            <label class="control-label">Date  <span style="color: #d9534f;">*</span></label>
			            <div class="controls">
			              <input id="date" name="date" value="" class="span12 {validate:{required:true}}" required type="text" placeholder="MM-DD--YYYY"/>
			            </div>
			          </div>
			          <!------------------>
			          <div class="control-group">
			            <label class="control-label">Transaction ID <span style="color: #d9534f;">*</span></label>
			            <div class="controls">
			              <input id="transcode" name="transcode" value="" type="text" class="span12 {validate:{required:true}}" required placeholder="Enter Transaction ID"/>
			            </div>
			          </div>
			          <div class="control-group">
			            <label class="control-label">Terms and Conditions <span style="color: #d9534f;">*</span></label>
			            <div class="controls">
                            <input type="radio" name="term" id="ldis1" value="accept" class="with-gap" required> 
	                        <label for="ldis1">I agree to the <a href="<?php echo base_url();?>index.php/terms/" target="_blank">  Terms and Conditions</a></label>
                        </div>
			          </div>
			          <br>
			          <div class="form-actions">
			            <button type="submit" class="btn btn-primary btnsubmit">Send</button>
			          </div>
			    </form>
			</div>
		</div>
		<div class="tz-2-main-2 row"> 
			<div class="col-md-3"></div>
			<div class="col-md-6">
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
			    <div style="clear:both;overflow:hidden;"></div>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
 	<div class="tz-2-com tz-2-main">
		<div class="tz-2-main-2 row"> 
			<div class="col-md-12">
			  	<div style="margin-top:30px;">
				    <div class="txtdiv">
				      <?=$result[0]['textdt']?>
				    </div>
			    	<div style="clear:both;overflow:hidden;"></div>
			  	</div>
		  	</div>
		</div>
	</div>
		<!-------------------->
  	<div style="margin-top:30px;"></div>
</div>

<!-------------------------------->
<style>
	.div_hide{
		display: none;
	}
	.btncls{
		border:none;
	}
	.video_frm{
		width: 473px !important;
		height: 333px !important;
		overflow:hidden;
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
	.pay_div_cls .n-sources{
		font-size:23px !important;
		padding:15px 0px;
	}
	.pay_div_cls .board-widgets-botttom a{
		font-size:16px !important;
		padding:10px 10px;
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