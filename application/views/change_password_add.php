<div class="row">    
  <ul class="top-banner"></ul>
</div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
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
		var old_pass	=	document.getElementById('old_pass');
		var new_pass	=	document.getElementById('new_pass');
		var confirm_pass=	document.getElementById('confirm_pass');
		if(old_pass.value==''){
			old_pass.focus();
			return;
		}
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
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
    <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Master</a> </li>
    <li class="active-bre"><a href="#"> Change Password</a> </li>
  </ul>
</div>    
<div class="tz-2 tz-2-admin">
  <div class="tz-2-com tz-2-main">
    <h4>Change Password</h4>
    
    <div class="hom-cre-acc-left hom-cre-acc-right">
      <div class="col-md-12">
        <br>
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
       		<input type="hidden" name="mode" id="mode" value="<?=$this->uri->segment(3)?>" />
        	<input type="hidden" name="eid" id="eid" 	 value="<?=$this->uri->segment(4)?>" />
               <p><h3 class="msg"><?=$msg?></h3></p>
          <div class="control-group">
            <label class="control-label">Old Password</label>
            <div class="controls">
              <input id="old_pass" name="old_pass" value="" class="span12 {validate:{required:true}}" required type="password" placeholder="Enter Old Password"/>
            </div>
          </div>
          <!------------------>
          <div class="control-group">
            <label class="control-label">New Password</label>
            <div class="controls">
              <input id="new_pass" name="new_pass" value="" class="span12 {validate:{required:true,minlength:5}}" required type="password" placeholder="Enter New Password"/>
            </div>
          </div>
          <!------------------->
          <div class="control-group">
            <label class="control-label">Confirm Password</label>
            <div class="controls">
              <input id="confirm_pass" name="confirm_pass" value="" class="span12 {validate:{required:true,equalTo:new_pass}}" required type="password" placeholder="Enter Confirm Password"/>
            </div>
          </div>
       
          <!------------------->
          <br>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit" onclick="return validation();">Update</button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/form"><button type="button" class="btn">Cancel</button></a>
          </div>
        </form>
         <br>
      </div>
    </div>
  </div>
</div>
<style>
	.msg{
		color:#F00;
		text-align:center;
	}
</style>
