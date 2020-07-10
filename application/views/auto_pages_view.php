<link rel="stylesheet" href="<?=base_url();?>asset/popover/jquery.webui-popover.min.css">
<script src="<?=base_url();?>asset/popover/jquery.webui-popover.min.js"></script>
<!-- link to the SqPaymentForm library -->
  <script type="text/javascript" src="https://js.squareup.com/v2/paymentform"></script>
  <script>
  // Set the application ID
    var applicationId = "<?php echo $applicationId;?>";

    // Set the location ID
    var locationId = "<?php echo $locationId;?>";
  </script>
  <!-- link to the local SqPaymentForm initialization -->
  <script type="text/javascript" src="<?=base_url();?>asset/square/sqpaymentform.js"></script>

  <!-- link to the custom styles for SqPaymentForm -->
  <link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/square/sqpaymentform.css">
 
  
  <!-- link to the local SqPaymentForm initialization -->
 
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
<!-- <div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div> -->

    
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
      <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Square Payment</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">FINANCE</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Square Payment</li>
        </ul>
      </div>
    </div>

<?php if($this->session->flashdata('show_msg')!=''){?>
    <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('show_msg');?></strong>
    </div>
    <?php } ?>

 <div class="span12 thumbnails-videos">
  <table>
    <tr>
            <?php
      $video_link = explode('||',$cms[0]['video_url']);
      for($i=0;$i<count($video_link);$i++){
        if($video_link[$i]!=''){
          $spep=$i+1;
          $cls=("margin_none");
          echo '<td>';
          echo '<div class="step_div'.$cls.'"><h2>Step '.$spep.'</h2>';
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
         echo '</td>';
        }
      } 
      
      
          ?>
          </tr>
         </table>
         </div>
         
         <!-- VIDEO DISPLAY -->


<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
    	<?php 
		if($this->uri->segment(3)=='viral_marketing'){ 
			echo '<br><div style="text-align:center;">
         	   			<span style="font-size:16px;font-weight:bold;margin-right:5px;">Payment</span>	
	    	  			<a class="payment_btn" href="'.base_url().'index.php/monthly_payment_active_member/marketing_product/viral"><img src="'.base_url().'asset/images/credit_card_img.gif" alt="Payment" /></a> 
   				</div>';
				
				echo '<div class="pull-right">
							<a class="show-pop-event" href="'.base_url().'index.php/'.$this->uri->segment(1).'/send_msg_from/'.$this->uri->segment(3).'"><span class="label label-success">Message To Admin</span></a>
							<a class="show-pop-event" href="'.base_url().'index.php/'.$this->uri->segment(1).'/payment_confirm_from/viral_payment_confirmation"><span class="label label-important">Payment Confirmation</span></a>
					</div>';			
		}
		?>
     <!--  <h3 class="page-header">
        <?=$result[0]['pagename']?>
        
        <?php if($this->uri->segment(3)=='payment_info'){ ?>
        		<span class="pull-right"><a href="<?=base_url()?>index.php/payment_confirm"><span class="label label-success" style="font-family:Arial, Helvetica, sans-serif;">Payment Confirm</span></a></span>
        <?php } ?>
        
        	
      </h3> -->
    </div>
  </div>
</div>
<br>

<div class="row-fluid">
<div class="">
  <h4 style="margin-bottom:20px;">
    <?=$result[0]['title']?>
    
	
    
  </h4>

  <div style="margin-top:30px;">
    <div>
      <?=$result[0]['textdt']?>
    </div>
    

    <!-- squareUp code start -->
    <div id="sq-ccbox">
    <!--
      You should replace the action attribute of the form with the path of
      the URL you want to POST the nonce to (for example, "/process-card")
    -->
    <form id="nonce-form" novalidate action="<?=base_url();?>index.php/auto_pages/make/payment" method="post">
      <b style="font-size: 20px;">Pay with a Credit Card</b>
      <table>
      <tbody>

        <tr>
          <td>Card Number:</td>
          <td><div id="sq-card-number"></div></td>
        </tr>
        <tr>
          <td>CVV:</td>
          <td><div id="sq-cvv"></div></td>
        </tr>
        <tr>
          <td>Expiration Date: </td>
          <td><div id="sq-expiration-date"></div></td>
        </tr>
        <tr>
          <td>Postal Code:</td>
          <td><div id="sq-postal-code"></div></td>
        </tr>
        <tr>
          <td colspan="2">
            <button id="sq-creditcard" class="btn btn-primary btnsubmit" onclick="requestCardNonce(event)">
              Pay with card
            </button>
            &nbsp;&nbsp;
            <a href="<?php echo base_url(); ?>index.php/upgrade_membership/view"><button type="button" class="btn">Cancel</button></a>
          </td>
        </tr>
      </tbody>
      </table>

      <!--
        After a nonce is generated it will be assigned to this hidden input field.
      -->
      <input type="hidden" id="card-nonce" name="nonce">
    </form>
  </div>

  <div id="sq-walletbox">
    Pay with a Digital Wallet
    <div id="sq-apple-pay-label" class="wallet-not-enabled">Apple Pay for Web not enabled</div>
    <!-- Placeholder for Apple Pay for Web button -->
    <button id="sq-apple-pay" class="button-apple-pay"></button>

    <div id="sq-masterpass-label" class="wallet-not-enabled">Masterpass not enabled</div>
    <!-- Placeholder for Masterpass button -->
    <button id="sq-masterpass" class="button-masterpass"></button>
  </div>
  <!-- squareUp code start -->
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
  .step_div{
     width: 467px;
    display: inline-block;
  }
  .step_div h2{
    font-size:16px;
    text-align:center;
    margin:9px;
    padding:0px;
    margin-top:10px;
    line-height:25px;
  }
  .span12.thumbnails-videos {
    
    width: 900px;
    overflow-x: auto;
    white-space: nowrap;
   
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

</style>
