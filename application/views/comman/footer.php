	</div>
</div>
	</div>
	<!--SCRIPT FILES-->
	<?
	if($this->session->userdata['logged_ol_member']['email_verification']=="N"){
	?>
		<div class="modal fade dir-pop-com" id="VerifyModal" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header dir-pop-head">
						<button type="button" class="close" data-dismiss="modal" onclick="$('#VerifyModal').modal('close');">×</button>
						<h4 class="modal-title">Email Verification</h4>
						<!--<i class="fa fa-pencil dir-pop-head-icon" aria-hidden="true"></i>-->
					</div>
					<div class="modal-body dir-pop-body">
						<p style="color: red;">Verification email sent to your given email address.so please verify email address for further access.</p>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				//alert(55);
				 $('.modal').modal({
			        dismissible: false, 
			        startingTop: '5%', // Starting top style attribute
			        endingTop: '20%', // Ending top style attribute
			    });
				$('#VerifyModal').modal('open');
			});
		</script>
	<?	
	}
	?>
	<!-- ManyChat -->
<script src="//widget.manychat.com/517781752093789.js" async="async"></script>
</body>
</html>