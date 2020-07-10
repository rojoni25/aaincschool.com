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
	$(document).ready(function(e) {
    	$(document).on('keydown', '#username', function (event) {
			if(event.shiftKey)
				return false;
				var keyCode = event.which;
				if(keyCode==32){
				event.preventDefault();
			    }
		});   
		
		$('form#form2').on('submit', function (e) {
			e.preventDefault();
			
			if($('#txtpassword').val()==''){
				$('#txtpassword').focus();
				return false;
			}
			if($('#username').val()==''){
				$('#username').focus();
				return false;
			}
			if($('#username').val().length < 4){
				alert('Username Minimum Character 4');
				$('#username').focus();
				return false;
			}
			
			var con=confirm('Are You Sure You Want To Change Username');
			if(!con){
				return false;
			}
			
			$('.msg_show').html('<img src="<?=base_url()?>asset/images/loading.gif" /> Processing..');
			
			var form = $(this);
			var post_url = form.attr('action');	
			$.ajax({
					type: 'post',url: post_url,data: $(this).serialize(),
					success: function (result) {												
						var data = $.parseJSON(result);
						$('.msg_show').html(data[0]);
					}
			});
			
		}); 	
			 
    });
	
</script>
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
    <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Master</a> </li>
    <li class="active-bre"><a href="#"> Change Username</a> </li>
  </ul>
</div>    
<div class="tz-2 tz-2-admin">
  <div class="tz-2-com tz-2-main">
    <h4>Change Username</h4>

    <div class="hom-cre-acc-left hom-cre-acc-right">
      <div class="col-md-12">
         <br>
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
       		<input type="hidden" name="mode" id="mode" value="<?=$this->uri->segment(3)?>" />
        	<input type="hidden" name="eid" id="eid" 	 value="<?=$this->uri->segment(4)?>" />
               <p><h3 class="msg"><?=$msg?></h3></p>
          <div class="control-group">
            <label class="control-label">Enter Password</label>
            <div class="controls">
              <input id="txtpassword" name="txtpassword" value="" class="span12 {validate:{required:true}}" required type="password" autocomplete="new-password" placeholder="Enter Password"/>
            </div>
          </div>
          <!------------------>
          <div class="control-group">
            <label class="control-label">Enter New Username</label>
            <div class="controls">
              <input id="username" name="username" value="" class="span12 {validate:{required:true,minlength:4}}" autocomplete="new-password" required type="text" placeholder="Enter New Username"/>
            </div>
          </div>
          
           <div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
              <p class="msg_show"></p>
            </div>
          </div>
         
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
	.msg_show{
		font-weight:bold;
		color:#C00;
	}
</style>
