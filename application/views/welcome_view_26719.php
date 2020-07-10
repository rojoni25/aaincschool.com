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
	<?
	if($this->session->userdata['logged_ol_member']['email_verification']=="N"){
	?>
		<br><br>
		<div class="alert alert-danger alert-dismissible">
	        <h4><i class="icon fa fa-ban"></i> Email verification required!</h4>
	    </div>		
	<?	
	}
	?>
</div>
<div class="tz-2 tz-2-admin">
	<div class="tz-2-com tz-2-main">
		<h4>
			Welcome <?=$this->session->userdata['logged_ol_member']['fullname']?>
			<?php
            	$loginusercode = $this->session->userdata['logged_ol_member']['usercode'];
            	$referralcount = countreferral($loginusercode);
	        	if($referralcount>=3){
	        ?>
					<!--<span class="pull-right">
						<a href="<?=base_url()?>index.php/enroll" class="" style="padding: 5px;height: 30px;background-color: darkgoldenrod;border-radius:5px;color: #fff;"><strong>Enroll Me</strong></a>
					</span>-->
					<span class="pull-right">
						<a href="#" class="btn btn-primary btn-sm" style="padding: 5px;height: 30px;"><strong> Qualified</strong></a>
					</span>
			<?
				}else{
			?>
					<span class="pull-right">
						<a href="#" class="btn btn-danger btn-sm" style="padding: 5px;height: 30px;"><strong>Not Qualified</strong></a>
					</span>
			<?		
				}
			?>
			<?
			if($this->session->userdata['tbl']['current_account']=='Pending')
		    {
			?>
				<span class="" style="color: #fff;padding-left: 10px;">
					<i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> 
					<span style="color: darkgoldenrod;font-size: 20px;">  Referral Wallet : </span>
					<span style="color: yellow;font-size: 20px;">$<?=$referralcount*5?></span>
				</span>
				<span class="" style="color: #fff;padding-left: 30px;">	
					<i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> 
					<span style="color: darkgoldenrod;font-size: 20px;"> Capture Page Wallet : </span>
					<span style="color: yellow;font-size: 20px;">$<?=$referralcount*5?> /per month</span>
				</span>
			<?
			}else{
				$loginusercode = $this->session->userdata['logged_ol_member']['usercode'];
			?>
				<span class="" style="color: #fff;padding-left: 10px;">
					<i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> 
					<span style="color: darkgoldenrod;font-size: 20px;">  Referral Wallet : </span>
					<span style="color: yellow;font-size: 20px;">$<?=GetPaidReferalWallet($loginusercode)?></span>
				</span>
				<span class="" style="color: #fff;padding-left: 30px;">	
					<i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> 
					<span style="color: darkgoldenrod;font-size: 20px;"> Capture Page Wallet : </span>
					<span style="color: yellow;font-size: 20px;">$0 /per month</span>
				</span>
			<?	
			}
			?>	
		</h4>
		<div class="">
			<div class="">
				<div class="tz-2-main-2 row"> 
					<div class="col-md-3">
						<a href="<?=base_url();?>index.php/capture_pages?page_section=main_page" class="btn btn-warning"><strong><?=getconfigMeta('comanyshortname')?> Pages</strong></a>
					</div>
					<?php
		            if($this->session->userdata['logged_ol_member']['status']=='Active')
		            { 
			        ?>
						<div class="col-md-3">
							<a href="<?=base_url();?>index.php/capture_pages?page_section=my_page" class="btn btn-info"><strong>My Pages View</strong></a>
						</div>
						<div class="col-md-3">
							<a href="<?=base_url();?>index.php/capture_pages/page_thum_list/Add" class="btn btn-success"><strong>Add New Page</strong></a>
						</div>
					<?
					}else{
						$result	 =	$this->upgrade_membership_model->check_request_send();
						if(!isset($result[0])){
					?>
							<div class="col-md-3">
								<a href="<?=base_url();?>index.php/upgrade_membership/view/" class="btn btn-primary"><strong>$15 Enroll</strong></a>
							</div>
					<?	
						}
					}
					?>	
					
				</div>	
			</div>
		</div>
	</div>
	<div class="tz-2-com tz-2-main">
		<div class="row">
	     	<div class="">
	  			 <div style="margin-top:30px;">
	        		<div class="txtdiv" style="overflow:hidden"><?=$cms[0]['textdt']?></div>
	            	<div style="clear:both;overflow:hidden;"></div>
	        	</div>
	      	</div> 
	      	<!-- WELCOME MESSAGE -->
	        <div class="span6" style="overflow:hidden;">
	           
	          	<?php
				$video_link = explode('||',$cms[0]['video_url']);
				for($i=0;$i<count($video_link);$i++){
					if($video_link[$i]!=''){
						$spep=$i+1;
						$cls=("margin_none");
						echo '<div class="step_div span12 '.$cls.'"><h2>Step '.$spep.'</h2>';
						echo '<div class="video_frm">';
						echo '<div class="inner_frm">';
						if (strpos($video_link[$i], 'youtube') !== false)
						{
								echo '<iframe width="100%" height="100%" src="'.$video_link[$i].'" frameborder="0" allowfullscreen></iframe>';
						}
						else{
								echo '<video width="100%" height="100%" controls="controls"><source src="'.$video_link[$i].'" type="video/mp4"></video>';
						}
						echo '</div>';
						echo '</div>';
						echo '</div>';
					}
				} 
				
				
	          ?>
	        </div>
	         <!-- VIDEO DISPLAY -->
		    <div class="" style="overflow:hidden">
	       
		        <div class="">
		  		   <div style="margin-top:30px;">
		        	 <div class="txtdiv" style="overflow:hidden"><?=$cms[0]['textdt2']?></div>
		             <div style="clear:both;overflow:hidden;"></div>
		           </div>
		        </div>
	          	<div style="clear:both;overflow:hidden;"></div>
			 	<div class="">
		  		   <div style="margin-top:30px;">
		        	 <div class="txtdiv" style="overflow:hidden"><?=$cms[0]['textdt3']?></div>
		             <div style="clear:both;overflow:hidden;"></div>
		           </div>
	         	</div>
		        <div class="">
		  			<div style="margin-top:30px;">
		        	  <div class="txtdiv" style="overflow:hidden"><?=$cms[0]['textdt4']?></div>
		              <div style="clear:both;overflow:hidden;"></div>
		        	</div>
		        </div>
	       	</div>
		    <div style="clear:both;overflow:hidden;"></div>
	    </div>
	</div>
</div>
<style>
	
	.btncls{
		border:none;
	}
	.step_div{
		
	}
	.step_div h2{
		font-size:16px;
		text-align:center;
		margin:0px;
		padding:0px;
		margin-top:10px;
		line-height:25px;
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
	.margin_none{
		margin:0px !important;
	}
	@media only screen and (max-width: 1200px) {
	.video_frm{
		width: 325px;
		height: 229px;
	}
	.inner_frm{
		height: 202px;
		width: 268px;
		margin-left: 28px;
		margin-top: 13px;
	}
	}
@media  only screen and (max-width: 535px){

.video_frm {
   width: 278px;
	height: 196px;
}

.inner_frm {
    height: 173px;
    width: 230px;
    margin-top: 12px;
    margin-left: 24px;
}
.txtdiv h2{
	font-size:20px !important;
	line-height:25px !important;
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
.txtdiv h2{
	font-size:15px !important;
}
}

.btnlist .btn {
    padding: 2px 12px !important;
}

</style>
