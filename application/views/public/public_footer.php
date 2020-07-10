<!--FOOTER SECTION
	<footer id="colophon" class="site-footer clearfix">
		<div id="quaternary" class="sidebar-container " role="complementary">
			<div class="sidebar-inner">
				<div class="widget-area clearfix">
					<div id="azh_widget-2" class="widget widget_azh_widget">
						<div data-section="section" class="foot-sec2">
							<div class="container">
								<div class="row">
									<div class="col-sm-3">
										<h4>Payment Options</h4>
										<p class="hasimg"> <img src="<?=base_url();?>asset/img/payment.png" alt="payment"> </p>
									</div>
									<div class="col-sm-4">
										<h4>Address</h4>
										<p>28800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A. Landmark : Next To Airport</p>
										<p> <span class="strong">Phone: </span> <span class="highlighted"> <?=getconfigMeta('phone')?></span> </p>
									</div>
									<div class="col-sm-5 foot-social">
										<h4>Follow with us</h4>
										<p>Join the thousands of other There are many variations of passages of Lorem Ipsum available</p>
										<ul>
											<li><a href="<?=getconfigMeta('facebook_link')?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
								          	<li><a href="<?=getconfigMeta('googleplus_link')?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a> </li>
								          	<li><a href="<?=getconfigMeta('twitter_link')?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
								          	<li><a href="<?=getconfigMeta('linkedin_link')?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a> </li>
								          	<li><a href="<?=getconfigMeta('youtube_link')?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a> </li>
								          	<li><a href="<?=getconfigMeta('instagram_link')?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a> </li>
								          	<li><a href="<?=getconfigMeta('skype')?>" target="_blank"><i class="fa fa-skype" aria-hidden="true"></i></a> </li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		
		</div>
		
	</footer>-->
	
	<!--COPY RIGHTS-->
	<section class="copy">
		<div class="container">
			<p>copyrights © 2019  &nbsp;&nbsp;All rights reserved. </p>
		</div>
	</section>
	<!--QUOTS POPUP-->
	<section>
		<!-- GET QUOTES POPUP -->
		<div class="modal fade dir-pop-com" id="list-quo" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header dir-pop-head">
						<button type="button" class="close" data-dismiss="modal">×</button>
						<h4 class="modal-title">Get a Quotes</h4>
						<!--<i class="fa fa-pencil dir-pop-head-icon" aria-hidden="true"></i>-->
					</div>
					<div class="modal-body dir-pop-body">
						<form method="post" class="form-horizontal">
							<!--LISTING INFORMATION-->
							<div class="form-group has-feedback ak-field">
								<label class="col-md-4 control-label">Full Name *</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="fname" placeholder="" required> </div>
							</div>
							<!--LISTING INFORMATION-->
							<div class="form-group has-feedback ak-field">
								<label class="col-md-4 control-label">Mobile</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="mobile" placeholder=""> </div>
							</div>
							<!--LISTING INFORMATION-->
							<div class="form-group has-feedback ak-field">
								<label class="col-md-4 control-label">Email</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="email" placeholder=""> </div>
							</div>
							<!--LISTING INFORMATION-->
							<div class="form-group has-feedback ak-field">
								<label class="col-md-4 control-label">Message</label>
								<div class="col-md-8 get-quo">
									<textarea class="form-control"></textarea>
								</div>
							</div>
							<!--LISTING INFORMATION-->
							<div class="form-group has-feedback ak-field">
								<div class="col-md-6 col-md-offset-4">
									<input type="submit" value="SUBMIT" class="pop-btn"> </div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- GET QUOTES Popup END -->
	</section>
	<!--SCRIPT FILES-->
	<script src="<?=base_url();?>asset/js/jquery.min.js"></script>
	<script src="<?=base_url();?>asset/js/bootstrap.js" type="text/javascript"></script>
	<script src="<?=base_url();?>asset/js/materialize.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>asset/js/custom.js"></script>
	 <!-- SLIDER REVOLUTION SCRIPTS  -->
    <script type="text/javascript" src="<?=base_url();?>rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    
    <script type="text/javascript">
    	var revapi;

		jQuery(document).ready(function() {

			   revapi = jQuery('.tp-banner').revolution(
				{
					delay:15000,
					startwidth:1170,
					startheight:800,
					hideThumbs:10,
					fullWidth:"off",
					fullScreen:"on",
					fullScreenOffsetContainer: ""

				});

		});	//ready
		<?
		$mobile = checkdevice();
		if($mobile){
		?>
			$('.hom-top-menu').fadeIn();
	       	$('.cat-menu').hide();
	    <?
		}
	    ?>   	
    </script>  
</body>
</html>