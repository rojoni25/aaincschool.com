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

	
    
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">My Wallet</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Finance</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">My Wallet</li>
        </ul>
      </div>
    </div>
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
            </table>
      </div>
    </div>

