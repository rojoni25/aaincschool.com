
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
	function validation(){
		
		var new_pass	=	document.getElementById('new_pass');
		var confirm_pass=	document.getElementById('confirm_pass');
		if(new_pass.value==''){
			new_pass.focus();
			return;
		}
		if(confirm_pass.value==''){
			confirm_pass.focus();
			return;
		}
		if(new_pass.value!=confirm_pass.value){
			alert('confirm Password Not Match!');
			confirm_pass.focus();
			return false;
		}
	}
</script>

    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Change Password -<?=$result[0]['fname']?> <?=$result[0]['lname']?></h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Master</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Change Password</li>
        </ul>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/change_pass_insert" enctype="multipart/form-data">
        	<input type="hidden" name="eid" id="eid" 	 value="<?=$this->uri->segment(3)?>" />
               <p><h4 class="msg"><?=$msg?></h4></p>
         
          <!------------------>
          <div class="control-group">
            <label class="control-label">New Password</label>
            <div class="controls">
              <input id="new_pass" name="new_pass" value="" class="span12 {validate:{required:true,minlength:5}}" type="password" placeholder="Enter New Password"/>
            </div>
          </div>
          <!------------------->
          <div class="control-group">
            <label class="control-label">Confirm Password</label>
            <div class="controls">
              <input id="confirm_pass" name="confirm_pass" value="" class="span12 {validate:{required:true,equalTo:new_pass}}" type="password" placeholder="Enter Confirm Password"/>
            </div>
          </div>
       
          <!------------------->
         
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit" onclick="return validation();">Update</button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
          </div>
        </form>
      </div>
    </div>
<style>
	.msg{
		color:#F00;
		text-align:center;
	}
</style>
