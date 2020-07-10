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
		<li class="active-bre"><a href="#"> Pro Maketers Subscription Plan</a> </li>
		<li class="page-back"> <a href="#"> <i class="fa fa-calendar" aria-hidden="true"></i> <?=date('F d, Y')?></a> </li>
		<li class="active-bre page-back"> Last Login Date & Time : <?=lastlogin($this->session->userdata['logged_ol_member']['usercode'])?></li>
		<li class="page-back materialize-red-text"> Your Username : <?=$this->session->userdata['logged_ol_member']['username']?></li>
	</ul>
</div>
	<div class="tz-2-com tz-2-main">
		<div class="row">
	     	<div class="col-md-12">
	     	  
	  			 <div style="margin-top:30px;">
	  			     <div class="txtdiv "><h2><?=$cms[0]['title']?></h2>
	  			        
                     </div>;
                     <div class="span6" style="overflow:hidden;">
                         <?php 
                         $login_usercode=$this->session->userdata['logged_ol_member']['usercode'];
                         if(!is_pro_marketer_subscriber($login_usercode)){?>
	             <center>
	  			              <form action="<?php echo base_url().'index.php/'.$this->uri->segment(1).'/create_subscription'?>" method="post" class="frmStripePayment">
                          <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                      data-key="<?php echo $stripe['publishable_key']; ?>"
                      data-description="Facebook Ads Marketing Plan"
                      data-amount="6900"
                    data-currency="usd"
                      data-locale="en"
                                 data-text="Hello world"
                                 data-billing-address="false"
                                 data-panel-label="Subscribe Now"
                                 data-label="Subscribe Now $69"
                                 ></script>
                     </center>
                    
                     <br> 
                     <?php } ?>
	          	<?php
				$video_link = explode('||',$cms[0]['video_url']);
				for($i=0;$i<count($video_link);$i++){
					if($video_link[$i]!=''){
						$spep=$i+1;
						$cls=("margin_none");
						
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
	        	     <br>
	        	     <br>
	        		<div class="txtdiv" style="overflow:hidden"><?=$cms[0]['textdt']?></div>
	            	<div style="clear:both;overflow:hidden;"></div>
	        	</div>
	        			<!-- WELCOME MESSAGE -->
	        
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