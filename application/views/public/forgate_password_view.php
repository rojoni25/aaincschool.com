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
<section class="tz-register" style="min-height: 800px;">
	<div class="log-in-pop">
		
		<div class="log-in-pop-right">
			<h4>Forgot Password</h4>
			<?php if($error!=''){?>
	        <div class="success">
	          <div class="message-box-wrap"> <strong>
	            <?=$error?>
	          </div>
	        </div>
	        <?php } ?>
			<?php 
				$attributes = array('id' => 'registerForm');
				echo form_open(base_url().'index.php/login/forgate_password_submit',$attributes); 
			?>
				<div>
					<div class="input-field s12">
						<input type="text" data-ng-model="emaild" class="validate" name="emaild" required autocomplete="new-password">
						<label>Enter Your Email Id</label>
					</div>
				</div>
				<div>
					<div class="input-field s4">
						<input type="submit" value="Submit" class="waves-effect waves-light log-in-btn login-btn" name="login"> </div>
				</div>
				<div>
					<div class="input-field s12">  <a href="<?=base_url()?>index.php/login">Click here to Login</a> </div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</section>
<!--<div class="container">
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
  
</div>
 end content area -->

<style>
	.comment_submit{
		margin:20px 0px;
	}
	legend{
		font-size:20px;
		padding:0px 4px;
	}
</style>
