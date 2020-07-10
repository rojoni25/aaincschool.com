
<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">
       	Send Payment  
     </h3>
    </div>
  </div>
</div>

<div class="row-fluid ">
  <div class="">
    <?php
            if($contain[0]['video_url']!=''){
                echo '<div class="video_frm">';
                echo '<div class="inner_frm">';
                 if (strpos($contain[0]['video_url'], 'youtube') !== false || strpos($contain[0]['video_url'], 'slideshare') !== false)
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
  <div class="span12">
    	<form action="<?=base_url()?>index.php/d2v/<?=$this->uri->rsegment(1)?>/payment_insert/" method="post">
        	<input type="hidden" name="usercode" value="<?=$result[0]['usercode']?>" />
        
            <table class="table table-striped table-bordered">
                <tr>
                    <td width="19%">Paypal Account</td>
                    <td width="1%"></td>
                    <td width="80%"><input type="text" name="paypal_account" id="paypal_account" class="span12" value="" required="required" placeholder="Paypal Account" required="required" /></td>
                </tr>
                <tr>
                    <td width="19%">Paypal Email</td>
                    <td width="1%"></td>
                    <td width="80%"><input type="email" name="paypal_email" id="paypal_email" class="span12" value="" required="required" placeholder="Paypal Email" required="required" /></td>
                </tr>
                <tr>
                    <td width="19%">Transaction ID</td>
                    <td width="1%"></td>
                    <td width="80%"><input type="text" name="transaction_id" id="transaction_id" class="span12" value="" required="required" placeholder="Transaction ID" required="required" /></td>
                </tr>
                <tr>
                    <td width="19%">Amount</td>
                    <td width="1%"></td>
                    <td width="80%"><input type="number" name="amount" id="amount" class="span12" value="" required="required" placeholder="Amount" required="required" /></td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td></td>
                    <td><textarea id="notes" name="notes" class="span12" required="required" placeholder="Notes"></textarea></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td><button type="submit" class="btn btn-primary">Send Payment</button></td>
                </tr>   	
            </table>
        
        </form>    
        
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
	.cls_head_btn{
		font-family: Arial, Helvetica, sans-serif;
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
