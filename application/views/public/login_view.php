<section class="tz-register" style="min-height: 800px;">
	<div class="log-in-pop">
		<div class="log-in-pop-right">
			<h4>Login</h4>
			<?php if($error!=''){?>
	        <div class="success">
	          <p style="color: red;"> 
	            <?=$error?>
	          </p>
	        </div>
	        <?php } ?>
			<?php 
				$attributes = array('id' => 'registerForm');
				echo form_open(base_url().'index.php/login/login_submit',$attributes); 
			?>
				<div>
					<div class="input-field s12">
						<input type="text" data-ng-model="username" class="validate" name="username" required autocomplete="new-password">
						<label>Username</label>
					</div>
					<div class="input-field s6">
						<input type="password" data-ng-model="password" class="validate" name="password" required autocomplete="new-password">
						<label>Password</label>
					</div>
				</div>
				<div>
					<div class="input-field s4">
						<input type="submit" value="Submit" class="waves-effect waves-light log-in-btn" name="login"> </div>
				</div>
				<div>
					<div class="input-field s12">  <a href="<?=base_url()?>index.php/login/forgate_password">Forgot Password ? </a> </div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</section>