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
        $(document).on('submit','#form2',function(e){
			var val=$('#refill_amount').val();
			if (!$.isNumeric(val)) {
				$('#refill_amount').focus();
   			 	alert('Invalid Amount !');
			 	return false;
			}
			var val_f=parseFloat(val)
			if(val_f <= 0){
				$('#refill_amount').focus();
				alert('Invalid Amount !');
			 	return false;
			}
		});
    });
</script>
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
          <h3 class="page-header">Refill Account</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Account</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Refill Account</li>
        </ul>
      </div>
    </div>
    
    <div class="row-fluid">
      <div class="span12">
           <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
          <div class="control-group">
            <label class="control-label">Enter Refill Amount (<font style="color:#F00;font-weight:bold;">$</font>)</label>
            <div class="controls">
              <input id="refill_amount" name="refill_amount" value="" class="span12  {validate:{required:true}}" type="number" placeholder="Enter Amount"/>
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label">Select Account</label>
            <div class="controls">
            	<select name="account_type" id="account_type">
                	<option value="main_balance">Company Wallet</option>
                    <option value="personal_wallet">Personal Wallet</option>
                </select>
            </div>
          </div>
         
          
         <!-- <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Ok</button>
            
          </div>-->
        </form>
      </div>
    </div>

