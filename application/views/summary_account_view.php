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
          <h3 class="page-header">Account</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Account</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Summary</li>
        </ul>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
      		<?=$html?>
      </div>
    </div>

