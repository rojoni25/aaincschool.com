<?php

	//$balance		=	(float)$balance[0]['tot'];
    $balance=$balance;

	if($balance > CW_MIN){
		$max_withdrawal		=	$balance-CW_MIN;
	}
	else{
		$max_withdrawal		=	0;
	}	
	if(isset($result[0])){
		$last_limit_time 	= 	strtotime(date("Y-m-d", strtotime($result[0]['timedt'])) . " +1 week");
		$now_time_stam		=	time();
		if($result[0]['status']=='pending'){
			$no_request	=	true;
			$msg		=  'Your One Withdrawal Request Is Already Pending';
		}
		//if($last_limit_time > $now_time_stam){
			//$no_request	=	true;
			//$msg		=  'You can send new request after 7 days of previous request.';
		//}
	}
?>
<script>
	 var maxbalance=<?=$max_withdrawal?>;
	$(document).on('submit', '#form2', function (e) {
		var amount=$('#amount').val();
		var withdrawl_type=$('#withdrawl_type').val();
        var email =$('#email').val();
        var textdt=$('#textdt').val();
        var wallet_id=$('#wallet_id').val();    
        var acc_name =$('#acc_name').val();
        var bank_name =$('#bank_name').val();
        var city =$('#city').val();
        var routing =$('#routing').val();
        var account =$('#account').val();
		
		if(amount==''){
			alert('Enter Amount');
			$('#amount').focus();
			return false;
		}
		
		amount=parseFloat(amount);
		
		if (isNaN(amount)) {
    		alert('Enter Valid Amount');
			$('#amount').focus();
			return false;
		} 
		if(amount > maxbalance){
			alert('Max Withdrawal Amount $'+maxbalance +'');
			$('#amount').focus();
			return false;
		}

        if(amount > maxbalance){
            alert('Max Withdrawal Amount $'+maxbalance +'');
            $('#amount').focus();
            return false;
        }
        if(withdrawl_type==''){
            alert('Enter withdrawl type');
            $('#withdrawl_type').focus();
            return false;
        }
        
       // withdrawl_type=='paypal' || 
        if(withdrawl_type=='skrill')
        {   
            if(email==''){
            alert('Enter Your Email Id');
            $('#email').focus();
            return false;
            }
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(email)) {
                $('#email').val('')
                alert("Enter Vailed Email Address");
                return false;
            }
           
        } 
        // if(withdrawl_type=='bitcoin')
        // {   
        //     if (wallet_id=='') 
        //     {
        //      alert('Enter Your Wallet Id');
        //         $('#wallet_id').focus();
        //         return false;
        //     }
        // } 
        if(withdrawl_type=='direct_deposit')
        {
            if (acc_name=='') 
            {
             alert('Enter Your Account Name');
                $('#acc_name').focus();
                return false;
            }
            if (bank_name=='') 
            {
             alert('Enter Your Bank Name');
                $('#bank_name').focus();
                return false;
            }
            if (city=='') 
            {
             alert('Enter Your City');
                $('#city').focus();
                return false;
            }
            if (routing=='') 
            {
             alert('Enter Your Routing');
                $('#routing').focus();
                return false;
            }
            if (account=='') 
            {
             alert('Enter Your Account');
                $('#account').focus();
                return false;
            }
        }

        if(textdt==''){
            alert('Enter Your Comment');
            $('#textdt').focus();
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
      <h3 class="page-header">Withdrawal</h3>
    </div>
  </div>
</div>



<div class="row-fluid">
	<div class="span6">
    	<div class="primary-head"><h3 class="page-header">Withdrawal Request</h3></div>
        <div class="content-widgets white">
    		<?php if($max_withdrawal > 0) {?>
            	
                <?php if(!$no_request) {?>
                        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/withdrawal_insertrecord" enctype="multipart/form-data">
                            <table class="table">
                            <tr>
                            <th width="30%">Withdrawal Amount ($)</th>
                            <th width="1%">:</th>
                            <th><input type="number" name="amount" id="amount" class="span12" placeholder="$0.00" /></th>
                            </tr>

                            <tr>
                            <th width="30%">Withdrawal Type</th>
                            <th width="1%">:</th>
                            <th>
                                <select id="withdrawl_type" name="withdrawl_type" onchange="show_withdrawl_type()">
                                    <option value="">Select Type</option>
                                   <!--  <option value="bitcoin">Bitcoin</option> -->
                                   <!--  <option value="paypal">Paypal</option> -->
                                    <option value="skrill">Skrill</option>
                                    <option value="direct_deposit">Direct Deposit (USA Only)</option>
                                </select>
                                <div id="email_div" style="display: none">
                                    <br clear="all">
                                    <input type="text" class="span12" name="email" id="email" placeholder="Enter Email">
                                </div>
                                <div id="wallet_div" style="display: none">
                                    <br clear="all">
                                    <input type="text" class="span12" name="wallet_id" id="wallet_id" placeholder="Enter Wallet ID">
                                </div>
                                <div id="dd_div" style="display: none">
                                    <br clear="all">
                                    <input type="text" class="span12 dd-input" name="acc_name" id="acc_name" placeholder="Name On Account">
                                    <input type="text" class="span12 dd-input" name="bank_name" id="bank_name" placeholder="Bank Name">
                                    <input type="text" class="span12 dd-input" name="city" id="city" placeholder="City">
                                    <input type="text" class="span12 dd-input" name="routing" id="routing" placeholder="Routing #">
                                    <input type="text" class="span12 dd-input" name="account" id="account" placeholder="Account #">
                                </div>
                                
                            </th>
                            </tr>
                            
                            <tr>
                            <th width="30%">Comment</th>
                            <th width="1%">:</th>
                            <th><textarea id="textdt" name="textdt" placeholder="Comment" class="span12"></textarea></th>
                            </tr>
                            
                            <tr>
                            <th></th>
                            <th></th>
                            <th>
                            <button type="submit" class="btn btn-primary btnsubmit">Withdrawal Request</button>
                            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
                            </th>
                            </tr>
                            </table>
                    </form>
                <?php }else{ ?>
                	<p style="padding:5px 5px;font-weight:bold;"><?=$msg?></p>
                    	<table class="table">
                            <tr>
                                <th>Request Code</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            <tr>
                                <th><?=$result[0]['request_code']?></th>
                                <th>$<?=$result[0]['amount']?></th>
                                <th><?=date("d-m-Y", strtotime($result[0]['timedt']))?></th>
                                <th><?=$result[0]['status']?></th>
                            </tr>
                            </table>
                    
                 <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div class="span6">
    	<div class="primary-head"><h3 class="page-header">Withdrawal Amount</h3></div>
        <div class="content-widgets white">
    	<table class="table">
            	<tr>
                	<th width="30%">Total Balance</th>
                    <th width="1%">:</th>
                    <th><font style="font-weight:bold;color:#F00;"><?=$balance?></font></th>
                </tr>
                <tr>
                	<th width="30%">Product Purchase</th>
                    <th width="1%">:</th>
                    <th>$<?php echo CW_MIN; ?></th>
                </tr>
                <tr>
                	<th>Max Withdrawal Amount</th>
                    <th>:</th>
                    <th><font style="font-weight:bold;color:#F00;"><?=$max_withdrawal?></font></th>
                </tr>
               
        </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    function show_withdrawl_type(){
        var withdrawl_type=$('#withdrawl_type').val();
        $('#email_div').css('display', 'none');
        $('#wallet_div').css('display', 'none');
        $('#dd_div').css('display', 'none');
        if(withdrawl_type=='paypal' || withdrawl_type=='skrill'){
            $('#email_div').css('display', 'block');
        } else if(withdrawl_type=='bitcoin'){
            $('#wallet_div').css('display', 'block');
        } else if(withdrawl_type=='direct_deposit'){
            $('#dd_div').css('display', 'block');
        }
    }
</script>
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
	#textdt{
		width:90%;
		height:100px;
		resize:none;
	}

    .dd-input{
        margin-bottom: 10px !important;;
    }
</style>
