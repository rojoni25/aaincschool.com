<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
<script src="<?php echo base_url();?>/ckeditor/ckeditor.js"></script> 
<script>
	$(function () {
                var validator = $("#form2").validate({
                    meta: "validate"
                });
				$(".btnsubmit").click(function () {
                     var validator = $("#form2").validate({
                    	meta: "validate"
                	});
                });
                $(".cancel").click(function () {
                    validator.resetForm();
                });
            });
</script>

	
    <script>
	$(document).ready(function(e) {
		
		 $(document).on('change','#money_transfer',function(e){
			 var value=$(this).val();
			 if(value=='1'){
				$('.btnsubmit').html('Balance Transfer To Personal Wallet');
			  }
			 else if(value=='2'){
				$('.btnsubmit').html('Balance Transfer To Company Wallet');
			  }
			 else{
				$('.btnsubmit').html('Balance Transfer');
			 }
		 });
		
        $(document).on('submit','#form2',function(e){
			
			var money_transfer=$('#money_transfer').val();
			if(money_transfer==''){
				$('#money_transfer').focus();
				alert('Select Select Account');
				return false;
			}
			var val=$('#amount').val();
			if (!$.isNumeric(val)) {
				$('#amount').focus();
   			 	alert('Invalid Amount !');
			 	return false;
			}
			var val_f=parseFloat(val)
			if(val_f <= 0){
				$('#amount').focus();
				alert('Invalid Amount !');
			 	return false;
			}
		});
    });
</script>
    
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Money Transfer Request</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Finance</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Money Transfer Request</li>
        </ul>
      </div>
    </div>
    
    <?php if($this->session->flashdata('show_msg')!=''){?>
    <div class="alert <?=$this->session->flashdata('cls_class')?>">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('show_msg');?></strong>
	</div>
    <?php } ?>
	  
    <div class="row-fluid">
      <div class="span12">
      		<table class="table">
            	<tr>
                	<td width="15%"><strong>Company Wallet</strong></td>
                    <td width="1%">:</td>
                    <td width="84%"><font style="font-weight:bold;color:#F00;">$<?=$result[0]['main_balance']?></font></td>
                </tr>
                <tr>
                	<td><strong>Personal Wallet</strong></td>
                    <td>:</td>
                    <td><font style="font-weight:bold;color:#F00;">$<?=$result[0]['personal_wallet']?></font></td>
                </tr>
                <?php if(isset($withdrawal[0])){?>
                <tr>
                	<td></td>
                    <td></td>
                    <td><font style="font-weight:bold;color:#663;">Withdrawal request is pending. Can not transfer to personal wallet.</font></td>
                </tr>
                <?php } ?>
            </table>
      </div>
    </div>
    
    <div class="row-fluid">
      <div class="span12">
      	<?php if(!isset($pending_request[0])) {?>
      	 <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
      		<table class="table">
            	<tr>
                	<td width="24%"><h5>Money Transfer</h5></td>
                    <td width="1%"></td>
                    <td width="75%"></td>
                </tr>
                <tr>
                	<td><strong>Money Transfer To</strong></td>
                    <td>:</td>
                    <td><select id="money_transfer" name="money_transfer" style="width:80%">
                    		<option value="">Select</option>
                             <?php if(!isset($withdrawal[0])){?>
                             	<option value="1">Company Wallet to Personal Wallet</option>
                             <?php } ?>
                    		
                            <option value="2">Personal Wallet to Company Wallet</option>
                    	</select>
                    </td>
                </tr>
                 <tr>
                	<td><strong>Enter Transfer Amount ($) </strong></td>
                    <td>:</td>
                    <td><input type="number" name="amount" id="amount" style="width:80%" placeholder="Enter Amount" required/></td>
                </tr>
                </tr>
                 <tr>
                	<td>
                   
                    </td>
                    <td></td>
                    <td>  <button type="submit" class="btn btn-success btnsubmit"><strong>Transfer Amount</strong></button></td>
                </tr>
            </table>
           </form>
         <?php } else {?>  
         		<p class="ptitle">One Money Transfer Request is Pending</p>
         <?php } ?>
      </div>
    </div>
	
    <style>
    	.ptitle{
		font-weight:bold;
		color:#C53838;
		font-size:18px;
		}
    </style>
    
