<?php
	
	if($_REQUEST['p']=='flase')
	{
		$message='invalid email id';
	}
?>
<script type="text/javascript" charset="utf-8">//
	$(document).ready(function() {
	
		<!---------This Method is use for change status-------------->
		$(document).on('click', '.login-btn', function (e) {
			
			if($('#emaild').val()==""){
				$("#emaild").focus();
				return false;
			}
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (!filter.test($('#emaild').val())) {
				$('#emaild').val('')
   		 		alert("Enter Vailed Email Address");
				$("#emaild").focus();
    			return false;
 			}
		});
		
	});		
</script>

<div class="container">
  <div class="content_fullwidth">
  
    <form action="<?=base_url()?>index.php/login/forgate_password_submit" method="post">
      <fieldset style="border:solid #333 1px;padding:15px;width:400px;margin:auto;">
        <legend style="margin-left:30px;">Forgot Password</legend>
        <label for="name" class="blocklabel">Enter Your Email Id</label>
        <input name="emaild" class="input_bg" type="text" id="emaild" value='' placeholder="Enter Your Email Id"/>
        
        <div class="clearfix"></div>
        <input name="Send" type="submit" value="SUBMIT" class="comment_submit login-btn" id="send"/>
        <?php if($_REQUEST['p']=='flase'){?>
        <div class="success">
          <div class="message-box-wrap"> <strong>
            <?=$message?>
          </div>
        </div>
        <?php } ?>
      </fieldset>
    </form>
    
  </div>
  <!-- end content_fullwidth area --> 
</div>
<!-- end content area -->

<style>
	.comment_submit{
		margin:20px 0px;
	}
	legend{
		font-size:20px;
		padding:0px 4px;
	}
</style>
