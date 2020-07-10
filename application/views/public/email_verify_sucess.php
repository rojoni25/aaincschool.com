<section class="com-padd">
    <div class="container">
        <div class="rows">
            <div class="com-title">
             <h2>Email Verification</span></h2>
              <h4>Your email has been verified successfully. </h4>
                 <br><br>
              <?
              
					
						echo '<div class="video_frm">';
						echo '<div class="inner_frm">';
					
						if (strpos($video_url, 'youtube') !== false)
						{
								echo '<iframe width="100%" height="100%" src="'.$video_url.'" frameborder="0" allowfullscreen></iframe>';
						}
						else{
								echo '<video width="100%" height="100%" controls="controls"><source src="'.$video_url.'" type="video/mp4"></video>';
						}
						echo '</div>';
						echo '</div>';
						?>
            </div>
        </div>
    </div>
</section>
<style>
	.comment_submit{
		margin:20px 0px;
	}
	legend{
		font-size:20px;
		padding:0px 4px;
	}
	
			.video_frm{
		width: 473px;
		height: 333px;
		overflow:hidden;
		margin:auto;
		background-image:url(<?=base_url();?>asset/images/cap_frm.png);
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	.inner_frm{
		height: 291px;
		width: 390px;
		margin-top: 20px;
		margin-left: 40px;
	}
	
		@media only screen and (max-width: 1200px) {
	.video_frm{
		width: 325px;
		height: 229px;
	}
	.inner_frm{
		height: 202px;
		width: 268px;
		margin-left: 28px;
		margin-top: 13px;
	}
	}
@media  only screen and (max-width: 535px){

.video_frm {
   width: 278px;
	height: 196px;
}

.inner_frm {
    height: 173px;
    width: 230px;
    margin-top: 12px;
    margin-left: 24px;
}
}
</style>
