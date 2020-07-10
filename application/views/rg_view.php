<?php  

	 $autoplay_state_3 = $result[0]['page_bg_video_autoplay_3'];
	 $autoplay_state = $result[0]['page_bg_video_autoplay'];
	
	if($result[0]['page_bg_img']==''){
		if($result[0]['page_bg_video']!=''){
			$page_bg_img = $result[0]['page_bg_video'];
		} else{
			$page_bg_img=''.base_url().'asset/capturepages/page6.jpg';
		}
	}
	else{
		$page_bg_img=$result[0]['page_bg_img'];
	}
	
	if($result[0]['page_bg_video_mute']=='Y'){$mute='true';}
	else{$mute='false';}
	$youtubeload = array();
?>
<?php
      	/*if($result[0]['page_bg_video']!=''){
			$autoplay_state_3 = $result[0]['page_bg_video_autoplay_3'] == 'Y' ? '1' : '0';
			
			$mute = $result[0]['page_bg_video_mute'] == 'Y' ? '1' : '0';
			
			if (strpos($result[0]['page_bg_video'], 'youtube') !== false){
				//echo '<iframe style="width:100%; height:100vh;" src="'.convertYoutube($result[0]['page_bg_video'], false, $autoplay_state_3,$mute).'&rel=0&showinfo=0&controls=0&iv_load_policy=" frameborder="0" allowfullscreen></iframe>';
			}
			else{
				//echo '<video style="width:100%; height:100vh;" controls autoplay><source src="'.$result[0]['page_bg_video'].'" type="video/mp4"></video>';
			}
	   }*/
	?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration</title>

<meta property="og:title" content="<?=getconfigMeta('comanyname')?>" />
<meta property="og:image" content="<?=$page_bg_img?>" />
<?php if($result[0]['main_body_text']!=''){?>
	<meta property="og:description" content="" />
<?php } ?>

<link href="http://fonts.googleapis.com/css?family=Abril+Fatface|Alegreya+Sans|Anton|Architects+Daughter|Arvo|Bevan|Boogaloo|Bowlby+One|Cabin|Cinzel:400,700,900|Codystar|Covered+By+Your+Grace|Crafty+Girl|Dancing+Script|Droid+Sans:400,700|Droid+Serif:400,400italic,700,700italic|Exo|Ewert|Flavors|Finger+Paint|Fira+Sans|Gloria+Hallelujah|Henny+Penny|Jacques+Francois+Shadow|Josefin+Slab|Just+Another+Hand|Kaushan+Script|Lato:300,300italic,400,400italic,700,700italic,900,900italic|Lobster|Monofett|Mountains+of+Christmas|Noto+Sans:400,400italic,700,700italic|Nova+Mono|Old+Standard+TT|Open+Sans:400,400italic,600,600italic,700,700italic,800,800italic|Open+Sans+Condensed|Permanent+Marker|PT+Sans:400,400italic,700,700italic|PT+Sans+Narrow:400,700|PT+Serif|Raleway|Roboto|Roboto+Slab|Rock+Salt|Rokkitt:400,700|Sansita+One|Shadows+Into+Light|Sirin+Stencil|Source+Sans+Pro|Source+Serif+Pro|Special+Elite|Ubuntu|VT323|Vollkorn" rel="stylesheet" type="text/css">

            <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">

            <script type="text/javascript">

               var ib2ajaxurl = '';

            </script>

            <script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>
<link rel='dns-prefetch' href='//fonts.googleapis.com' />

            <link rel='dns-prefetch' href='//s.w.org' />

            <link href='//fonts.gstatic.com' crossorigin rel='preconnect' />

         

            <style type="text/css">

               img.wp-smiley,

               img.emoji {

               display: inline !important;

               border: none !important;

               box-shadow: none !important;

               height: 1em !important;

               width: 1em !important;

               margin: 0 .07em !important;

               vertical-align: -0.1em !important;

               background: none !important;

               padding: 0 !important;

               }

			   
            </style>

            <link rel='stylesheet' id='twentyseventeen-fonts-css'  href='<?php echo base_url();?>asset/capturepages/page_31/css/font.css' type='text/css' media='all' />

            <link rel='stylesheet' id='twentyseventeen-style-css'  href='<?php echo base_url();?>asset/capturepages/page_31/css/style.css' type='text/css' media='all' />

         

            <link rel='stylesheet' id='bootstrap-css'  href='<?php echo base_url();?>asset/capturepages/page_31/css/bootstrap.min.css' type='text/css' media='all' />

            <link rel='stylesheet' id='font-awesome-css'  href='<?php echo base_url();?>asset/capturepages/page_31/css/font-awesome.min.css' type='text/css' media='all' />



            <link rel='stylesheet' id='animate-css'  href='<?php echo base_url();?>asset/capturepages/page_31/css/animate.css' type='text/css' media='all' />





            <link rel='stylesheet' id='prettyCheckable-css'  href='<?php echo base_url();?>asset/capturepages/page_31/css/prettyCheckable.css' type='text/css' media='all' />

            <link rel='stylesheet' id='instabuilder2-css'  href='<?php echo base_url();?>asset/capturepages/page_31/css/instabuilder2.css' type='text/css' media='all' />

       
           <?php 
				if($result[0]['background_bg'] == 'Y'){
					$bgcolor = $result[0]['background_bg_col']; 
					}else{
					$bgcolor = "rgba(255, 255, 255, 0.7)";
				}?>
            <style type="text/css" id="ib2-main-css">

               body { font-family: "Open Sans", sans-serif; font-size: 14px; color:#333; }

				   body a { color: #428bca; }

				   body a:hover, body a:focus { color: #2a6496; }
		  
				   <?php if($page_bg_img == ""){?>
				   body { min-height: auto; height: auto; background-color: <?=$bgcolor?> !important}
				   <?php } ?>
		
				   body{
					  background: url('<?=$page_bg_img?>') no-repeat center center fixed;
					  background-size:cover;
					}
			</style>

            <style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>

<!-- GOOGLE FONT -->
<link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:500,700" rel="stylesheet">
<!-- ALL CSS FILES -->
<link href="<?=base_url();?>asset/css/materialize.css" rel="stylesheet">
<!--<link href="<?=base_url();?>asset/css/style.css" rel="stylesheet">-->
<link href="<?=base_url();?>asset/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>asset/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
<link href="<?=base_url();?>asset/css/responsive.css" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<!--SCRIPT FILES-->
<script src="<?=base_url();?>asset/js/jquery.min.js"></script>
<script src="<?=base_url();?>asset/js/bootstrap.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/js/materialize.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/js/custom.js"></script>
<style>
	body{
		overflow:hidden;
		<?php if($result[0]['page_bg_video']!='') {?>
				background: url('<?=$page_bg_img?>') no-repeat center center fixed; 
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
		<?php } ?>
	}
</style>
           <!--////////////////// rg form css and style///////////////// -->
            <!-- styles -->
<link href="<?php echo base_url();?>asset/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>asset/css/bootstrap-responsive.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>asset/css/font-awesome.css">
<!--[if IE 7]>
            <link rel="stylesheet" href="css/font-awesome-ie7.min.css">
        <![endif]-->
<link href="<?php echo base_url();?>asset/css/styles.css" rel="stylesheet">


<style>
   .msg{
      color:#F00;
   }
</style>
<link href="<?php echo base_url();?>asset/css/aristo-ui.css" rel="stylesheet">
<link href="<?php echo base_url();?>asset/css/elfinder.css" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
<!--fav and touch icons -->

<!--============j avascript===========-->
<script src="<?php echo base_url();?>asset/js/jquery.js"></script>
<script src="<?php echo base_url();?>asset/js/jquery-ui-1.10.1.custom.min.js"></script>
<script src="<?php echo base_url();?>asset/js/bootstrap.js"></script>
<script src="<?=base_url();?>asset/capturepages/perfect-scrollbar.js"></script>
</head>
<body>
    
                <?php if($result[0]['after_reg_new_tab'] != ""){?>
<script type="text/javascript">
   window.open('<?PHP echo $result[0]['after_reg_new_tab'];?>', 
               'newwindow', 
               'width=800px,height=900px');
</script>
<?php }?>

                <?php  if($result[0]['scrolling']=='top'){?>
		<div class="marqdiv_top">
		    <h4>Just Joined</h4>
		     <marquee><h3><?=$current_join_mem?></h3></marquee>
		</div>
		<?php }?>
		
		<section>
		     <?php  if($result[0]['scrolling']=='left'){?>
		        <div class="marqdiv_left">
		            <h4>Just Joined</h4>
		             <marquee loop="infinite" behavior="scroll" direction="up" scrollamount="3" height="630">
		             <h3><?=$current_join?></h3>
		             </marquee>
		        </div> 
		        <?php }?>  

		</section>

    
    <div id="entire_wrapper" class="container-fluid">

               <div style="margin-top: 0px; margin-bottom: 0px; position: relative; z-index: 2; left: 0px; top: 0px;" id="ib2_el_DrBpTkct" class="ib2-wsection-el ib2-section-el" data-el="wsection" data-animation="none" data-delay="none" data-border-type="multi" data-img-mode="upload">

                  <div class="el-content" style="background-color: transparent; padding: 0px; opacity: 1; border-color: rgb(11, 77, 111) rgb(51, 51, 51) rgb(223, 172, 138); border-width: 0px 0px 2px; border-radius: 0px;">

                     <div class="el-content-inner" style="width: 816px; margin: 0px auto;">

                        <div class="el-cols" style="max-width:100%; width:100%;">

                           <div id="ib2_el_DrBpTkct-box" class="ib2-section-content" style="width: 816px; min-height: 65px; max-width: 100%; margin: 0px auto;">

                              <div data-animation="none" data-aspect-ratio="yes" id="ib2_el_41g1Kds7" class="ib2-content-el ib2-image-el" data-el="image" data-target="none" style="text-align: center;">

                                 <div class="el-content" style="display: inline-block; max-width: 100%; width: 0px; height: auto;"><img style="width: 0px; height: auto;" id="ib2_el_41g1Kds7-img" src="/images/logo2.png" alt="" class="img-responsive"></div>

                              </div>
							<?php  if($result[0]['headline_text']!=''){ ?>
							<div class="row">
								<div class="col-md-12">
									  <header class="clearfix" style="color: black">
									  <?php  if($result[0]['headline_text']!=''){
										$style_title=$result[0]['head_bg']=='Y'?'style="padding-left: 17px;padding-right: 17px;margin-bottom:-15px;background:'.$result[0]['head_bg_col'].';color:#000;"':'style="padding-left: 17px;padding-right: 17px;margin-bottom:-15px;"';
										?>
											<h3 <?php echo $style_title; ?>><?=$result[0]['headline_text']?></h3>
									  <?php } ?>
									  </header>
								</div>
							</div>
							<?php } ?>
							
                           </div>

                        </div>

                     </div>

                  </div>

               </div>

               <div id="ib2_el_section1" class="container ib2-section-el" style="width: 816px; max-width: 100%; margin: 25px auto 0px; position: relative; z-index: 2; left: 0px; top: 0px;" data-el="section" data-border-type="multi" data-img-mode="upload">
			   
					<?php 
					/*
					$video_bg = $result[0]['video_bg'];
					$video_bg_col = $result[0]['video_bg_col'];
					
					if($video_bg == "Y"){
							$color = $video_bg_col;
				   }else{
					   $color = 'rgb(255, 255, 255)';
				   }
				   */
				   ?>
				   
                  <div class="el-content el-cols" style="background-color: <?=$color?>; padding: 25px 35px 15px; opacity: 1; border-color: rgb(204, 204, 204) rgb(204, 204, 204) rgb(51, 51, 51); border-width: 1px 1px 0px; border-radius: 10px 10px 0px 0px; border-top: 1px solid rgb(204, 204, 204); border-right: 1px solid rgb(204, 204, 204); border-left: 1px solid rgb(204, 204, 204);">

                     <div id="ib2_el_section1-box" class="ib2-section-content" style="width: 100%; min-height: 677px;">
						<?php  if($result[0]['main_body_text']!=''){
										$style_title=$result[0]['head_bg']=='Y'?'style="background:'.$result[0]['head_bg_col'].';color:#000;"':'';
										?>
											<span><?=$result[0]['main_body_text']?></span>
									  <?php } ?>
                       
                        <div id="ib2_el_wG7UbwPR" class="ib2-content-el ib2-video-container" data-el="video" data-video-type="youtube" style="text-align: center; width: 764px; margin: 0px auto; ">

                           <div style="height: auto;width: 100%;" class="el-content ib2-video-responsive-class">
                              <div class="embed-responsive embed-responsive-16by9"> 

                                <?php

   if($result[0]['video_url1']!=''){

      $autoplay_state = $result[0]['page_bg_video_autoplay'] == 'Y' ? ture : false;

               if (strpos($result[0]['video_url1'], 'youtube') !== false){

                  echo '<iframe width:"100%" src="'.convertYoutube($result[0]['video_url1'],false,$autoplay_state).'" frameborder="0" allowfullscreen ></iframe>';

               }

               else{

                  echo '<video width:"100%"  controls="controls"><source src="'.$result[0]['video_url1'].'" type="video/mp4"></video>';

               }

           

   }

   

   else{

     

            echo '<iframe style="width:100%;display:block;margin-left: -11px;" name="video_5a87eb021d137ff468730acc62f8495bcb4bca0e5aa3413df20b5" class="embed-responsive-item" src="//www.youtube.com/embed/McDqt7MuiBM?wmode=transparent&rel=0&modestbranding=0&showinfo=0&ytid=McDqt7MuiBM&controls=0&enablejsapi=0&autoplay=1" scrolling="no" allowFullScreen webkitAllowFullScreen mozallowfullscreen></iframe>';

           

   }

?>
                               </div> 

                           </div>

                           <div class="clearfix"></div>

                        </div>
						 <?php if($result[0]['form_bg'] == 'Y'){
							 $formbg = $result[0]['form_bg_col'];
						 }else{
							 $formbg = '#323232';
						 }?>
	
      <form id="optinArea" class="form-signin" method="post" action="<?php echo base_url();?>index.php/rg/insertrecord">
           
		            <?php if($smfund){ echo '<input type="hidden" name="smfund" value="Y"/>'; } ?>
		              
		    	 	<input  type="hidden" id="referralid" name="referralid" value="<?=$ref[0]['usercode']?>"/>
		         	<input  type="hidden" id="referralusername" name="referralusername" value="<?=$ref[0]['username']?>"/>
		         	<input  type="hidden"  id="baseurl" value="<?=base_url();?>"/>
		            <input  type="hidden" id="pagecode" name="pagecode" value="<?=$pagecode?>"/>
		            <input  type="hidden" name="redirect_url"  id="redirect_url" anme value="<?=$result[0]['redirect_url']?>"/>
		            <br>
		         	<div class="row llbinviter">
		         		<div class="col s12">
		         		
		         			<h4 style="margin-left:5px;">Your Inviter:  <?=$ref[0]['fname']?> <?=$ref[0]['lname']?> </h4>
		         		</div>
		         	</div>
		         	<br>
		        	<div class="row">
						<div class="input-group input-field col s12">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input id="fname" type="text" name="fname" class="validate" required autocomplete="new-password">
							<label for="fname">First Name</label>
						</div>
					</div>
					<div class="row">
						<div class="input-group input-field col s12">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input id="lname" type="text" name="lname" class="validate" required autocomplete="new-password">
							<label for="lname">Last Name</label>
						</div>
					</div>
					<div class="row">
						<div class="input-group input-field col s12">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							<input id="emailid" type="email" name="emailid" class="validate" required autocomplete="new-password">
							<label for="emailid">Email Id</label>
						</div>
					</div>
					<div class="row">
						<div class="input-group input-field col s12">
							<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
							<input id="mobileno" type="text" name="mobileno" class="validate" required autocomplete="new-password">
							<label for="mobileno">Mobile</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12"> 
							 <?php if(isset($ref[0])){ ?>
				            	<p>
				            	<input type="submit" class="waves-effect waves-light btn-large full-btn" value="<? if(!empty($result[0]['submit_button_title'])){
				            			echo $result[0]['submit_button_title'];
				            	}else{
				            		echo "Take A Free Tour";
				            	}?>"></p>
				            <?php } ?>
						</div>
					</div>
      </form>
   </div>
						
                        </div>

                        <div class="sortable-line"></div>

                        <div spellcheck="false" style="padding: 0px; position: relative;" id="ib2_el_Oix0BmNA" class="ib2-content-el ib2-text-el" data-animation="none" data-shadow="none" data-el="text">

                           <!--<p style="text-align: center;" data-mce-style="text-align: center;"><span style="font-family: helvetica; font-size: 24px;" data-mce-style="font-family: helvetica; font-size: 24px;"></span><br><br></p>-->

                        </div>

                        <div id="ib2_el_MpG5iC20" class="ib2-content-el ib2-button-el" data-el="button" data-button-type="flat" data-target="url" style="text-align: center; max-width: 100%;">

                           
                        </div>

                     </div>

                  </div>
    
    
	<div class="video-background">
	    <div class="video-foreground">
	    	<?php
	    	
		      	if($result[0]['page_bg_video']!=''){
					$autoplay_state_3 = $result[0]['page_bg_video_autoplay_3'] == 'Y' ? '1' : '0';
					
					$mute = $result[0]['page_bg_video_mute'] == 'Y' ? '1' : '0';
					
			    	if($autoplay_state_3=='0' && strpos($result[0]['page_bg_video'], 'youtube') !== false){
			        	echo '<iframe width="100%" height="100%" src="'.convertYoutube($result[0]['page_bg_video'], false, $autoplay_state_3).'" frameborder="0" allowfullscreen></iframe>';
			      	}elseif($autoplay_state_3=='1' && strpos($result[0]['page_bg_video'], 'youtube') !== false){
			      		$you_url = end(explode("/", $result[0]['page_bg_video']));
					    //////////////////// FOR YOUTUBE ////////////////////
					    if (strpos($result[0]['page_bg_video'], 'youtube') !== false){
					    	$youtubeload[] = array('bgplayer',$you_url,$autoplay_state_3,$mute);
					      ?>
						    <div id="bgplayer"></div>
					    <?php  
						}
			  		}else{
				    	echo '<video id="bgvid" width="100%" height="100%" controls ><source src="'.$result[0]['page_bg_video'].'" type="video/mp4" allow="autoplay"></video>';
					    if($autoplay_state_3=='1'){ ?>
					      <script>
					        window.addEventListener('load', function() {
					          var video = document.querySelector('#video');
					          var preloader = document.querySelector('.preloader');

					          function checkLoad() {
					              if (video.readyState === 4) {
					                  preloader.parentNode.removeChild(preloader);
					                  document.getElementById('bgvid').play();
					              } else {
					                  setTimeout(checkLoad, 100);
					              }
					          }

					          checkLoad();
					        }, false);


					      </script>
					    <?php 
						}
				    }

					/*if (strpos($result[0]['page_bg_video'], 'youtube') !== false){
						echo '<iframe style="width:100%; height:100vh;" src="'.convertYoutube($result[0]['page_bg_video'], false, $autoplay_state_3,$mute).'&rel=0&showinfo=0&controls=0&iv_load_policy=" frameborder="0" allowfullscreen></iframe>';
					}
					else{
						echo '<video style="width:100%; height:100vh;" controls autoplay><source src="'.$result[0]['page_bg_video'].'" type="video/mp4"></video>';
					}*/
			   }
			?>
	      
	    </div>
	</div>
	<section class="">
		

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="wrapper"></div>
					<input type="hidden" id="videocode" value="<?=$videocode?>">
				   	<input type="hidden" id="mute" value="<?=$mute?>">
				  	<header class="clearfix">
				   
				    <?php if($result[0]['headline_text']!=''){
					  	$style_title=$result[0]['head_bg']=='Y'?'style="background:'.$result[0]['head_bg_col'].';color:#000;"':'';
					  	?>
					  	<h1 <?php echo $style_title; ?>><?=$result[0]['headline_text']?></h1>
					<?php } ?>

				  	</header>
				</div>
			</div>
		  
	

		<!--<a href="#" class="tubular-mute">Mute</a> -->

		<?php if(strpos($page_bg_img, '.mp4')!==FALSE){ ?>
			<video autoplay <?php echo $result[0]['page_bg_video_mute']=='Y'?'muted':''; ?> loop id="myVideo">
			  <source src="<?php echo $page_bg_img; ?>" type="video/mp4">
			</video>
		<?php } ?>
	</section>
</body>
</html>
<script type="text/javascript">
	// 1. This code loads the IFrame Player API code asynchronously.
	  var tag = document.createElement('script');

	  tag.src = "https://www.youtube.com/iframe_api";
	  var firstScriptTag = document.getElementsByTagName('script')[0];
	  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	  // 2. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      <?
      foreach ($youtubeload as $youtube) {
      ?>
      	var <?=$youtube[0]?>;
      <?	
      }
      ?>
      //var bgplayer;
      function onYouTubeIframeAPIReady() {
      	<?
	    foreach ($youtubeload as $youtube) {
	    ?>
	        <?=$youtube[0]?> = new YT.Player('<?=$youtube[0]?>', {
	          height: '100%',
	          width: '100%',
	          playerVars: {
	            autoplay: <?=$youtube[2]?>,
	            loop: 1,
	            mute: <?=$youtube[3]?>,
	            rel:0,
	            iv_load_policy:3,
	            controls: 0,
	            showinfo: 0,
	            autohide: 1,
	            modestbranding: 1,
	            vq: 'hd1080'},
	          videoId: '<?=$youtube[1]?>',
	          events: {
	            'onReady': onPlayerReady,
	            'onStateChange': onPlayerStateChange
	          }
	        });
	    <?
		}
	    ?>    
      }

      // 3. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
       	//bgplayer.playVideo();
       	<?
	    foreach ($youtubeload as $youtube) {
	    ?>
	    	<?=$youtube[0]?>.playVideo();
		<?	
		}
		?>
      }

      var done = false;
      function onPlayerStateChange(event) {
        
      }
      function stopVideo() {
        //bgplayer.stopVideo();
        <?
	    foreach ($youtubeload as $youtube) {
	    ?>
	    	<?=$youtube[0]?>.stopVideo();
		<?	
		}
		?>
      }
</script>
<style>
.video-background {
  background: #000;
  position: fixed;
  top: 0; right: 0; bottom: 0; left: 0;
  z-index: -99;
}
.video-foreground,
.video-background iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
}
.hom-cre-acc-right form input[type="submit"],.hom-cre-acc-right form input[type="submit"]:hover{
	background: none !important;
}
.hom-cre-acc-right form input {
    height: 45px;
    position: relative;
    box-sizing: border-box;
    box-shadow: none;
    text-indent: 0px;
    line-height: 12px;
    width: 100%;
    font-size: 14px;
    padding: 5px 24px;
    border-width: 1px;
    border-style: solid;
    border-color: rgb(232, 232, 232);
    border-image: initial;
    transition: border-color 0.4s ease 0s, color 0.4s ease 0s;
    background: rgb(255, 255, 255);
}
.full-btn {
    height: 45px;
    line-height: 45px;
    background: #f74d40;
    background: linear-gradient(to top, #F44336, #fb5a4e);
    outline: none;
    font-size: 16px;
    display: block !important;
    color: #fff;
    font-weight: 600;
    font-family: 'Quicksand', sans-serif;
    text-transform: uppercase;
    text-align: center;
}

.marqdiv_top{
	  z-index:9999;
	  position:absolute;
	  margin-top:0px;
	  font-weight:600;
	  background: rgba(0, 0, 0, .5);
	  width:100%;
	  color:#FFF;
  }
  .marqdiv_top h4{
	margin-bottom:10px;
	margin-left:10px;
	color:#FFF;
	position: absolute;
	background: rgb(0, 0, 0) none repeat scroll 0% 0%;
	padding: 18px;
	top: -19px;
	z-index:9999;
  }
  .marqdiv_top h3{
	  color:#FFF;
	  text-align:center;
	  font-size: 18px;
  }


.textbody{
	height:80px;
	overflow:hidden;
	position:relative;
	padding-right:10px;
	margin-top:30px;
}
.bodyvideo{
	width: <? echo get_hw_videoframe($result[0]['video_frame'])['width'];?>;
	height: <? echo get_hw_videoframe($result[0]['video_frame'])['height'];?>;
	position:absolute;
	top:158px;
	left:13%;
	background: url(<?=base_url()?>asset/capturepages/<?echo $result[0]['video_frame'];?>.png) no-repeat center center;
	background-position: center;
    background-size: cover;
}
.videoinner{
	<? echo get_hw_videoframe_inner($result[0]['video_frame']);?>
}
.llbinviter{
	color: #FFF;
}
.formmain {
	position: absolute;
	top: 0px;
	right: 2%;
	z-index: 999;
	padding: 20px;
	padding-top:35px;
	width: 420px;
	height: 400px;
	text-align: center;
}
.txt1{
	background:none;
	border:#FFF solid 1px;
	height:27px;
	color:#FFF;
	padding:3px;
	font-weight:bold;
	width:99%;
}
.txt2{
	background:none;
	border:#FFF solid 1px;
	height:27px;
	color:#FFF;
	padding:3px;
	font-weight:bold;
	width:49%;
}
.btnsubmit{
	background:FFF;
	border:#FFF solid 1px;
	color:#F00;
	font-weight:bold;
	padding:5px;
	cursor:pointer;
}
.clearfix h1{
	padding:20px;
	float:left !important;
}
.hom-cre-acc-left h3,p{
	color: #FFF;
}
.hom-cre-acc-right form {
	border : none;
	background: none repeat scroll 0% 0% rgba(0, 33, 99, 0.7) !important;
	box-sizing: border-box;
    padding: 35px 50px 35px 50px;
}
.hom-cre-acc-right form input:focus ~ label {
}
 .cbox-res {
     width: auto !important;
}
 .hom-cre-acc-right form input:focus {
     outline: none;
}
 .hom-cre-acc-right form input {
     height: 45px;
     position: relative;
     padding: 5px 24px;
     box-sizing: border-box;
     box-shadow: none;
     border: 1px solid #e8e8e8;
     text-indent: 0;
     line-height: 12px;
     -webkit-transition: border-color .4s, color .4s;
     transition: border-color .4s, color .4s;
    /* -webkit-appearance: none;
     */
     width: 100%;
     font-size: 14px;
     background: #fff;
}
 .hom-cre-acc-right form select {
     height: 55px;
     position: relative;
     padding: 15px 24px;
     box-sizing: border-box;
     box-shadow: none;
     border: 1px solid #e8e8e8;
     text-indent: 0;
     line-height: 12px;
     -webkit-transition: border-color .4s, color .4s;
     transition: border-color .4s, color .4s;
    /* -webkit-appearance: none;
     */
     width: 100%;
     font-size: 15px;
     background: #fff;
}
 .hom-cre-acc-right form textarea {
     height: 120px;
     position: relative;
     padding: 15px 24px;
     box-sizing: border-box;
     box-shadow: none;
     border: 1px solid #e8e8e8;
     text-indent: 0;
     line-height: 25px;
     -webkit-transition: border-color .4s, color .4s;
     transition: border-color .4s, color .4s;
    /* -webkit-appearance: none;
     */
     width: 100%;
     font-size: 15px;
     background: #fff;
}
 .hom-cre-acc-right form input[type="submit"] {
     font-size: 20px;
     border: none;
     width: 100%;
     padding: 18px;
     background: #31c6f5;
    /* color: #fff;
     */
    /* text-transform: uppercase;
     */
}
 .hom-cre-acc-right form input[type="submit"]:hover {
     background: #14addb;
}
 .blue-btn {
     color: #fff;
     background-color: #1ebef0;
     border: 1px solid #1ebef0;
     font-weight: 600;
     border-radius: 2px;
     -webkit-transition: all 0.5s ease;
     -moz-transition: all 0.5s ease;
     -o-transition: all 0.5s ease;
     transition: all 0.5s ease;
}
 .blue-btn:hover {
     background: #14addb;
     border: 1px solid #14addb;
     -webkit-transition: all 0.5s ease;
     -moz-transition: all 0.5s ease;
     -o-transition: all 0.5s ease;
     transition: all 0.5s ease;
}
 .hom-cre-acc-right form input[type="submit"] {
}
 .hom-cre-acc-right .checkbox {
     padding: 10px 0px;
}
 .hom-cre-acc-right .checkbox label {
}
@media  only screen and (max-width: 960px){
	body{
		background-size: 100% 100%;	
	}
	.bodyvideo {
   		width: 396px;
		height: 207px;
		margin-top:0px;
		margin-left:-70px;
	}
	.videoinner {
	 	margin-left: 30px;
		margin-top: 10px;
		height: 188px;
		width: 332px;
	}
}
@media  only screen and (max-width: 500px){
	body{
	overflow:visible;
	}
	.formmain {
		top:280px;
		min-height:550px;
		width: 350px;
	}
	.clearfix h1{
		padding:7px;
		float:right !important;
	}
	.bodyvideo {
	  	width: 300px;
		height: 157px;
		margin-top:-40px;
		margin-left:-30px;
	}
	.videoinner {
	 	margin-left: 23px;
		margin-top: 7px;
		height: 143px;
		width: 252px;
	}
	.textbody {
	   
	    margin-top:-5px;
	}
	.marqdiv_left{
		display:none;
	}
}
</style>
 <style>
.container{
   z-index:99999;
   position:relative;

}
.marquee_div {
    z-index: 99999;
    position:relative;
}
.form-signin{
    background: rgba(255, 255, 255, .5);
}

   .txtrg{
      padding-left:5px !important;
      margin-bottom: 10px !important;
   }
   .form-signin{
      margin-top:15px !important;
   }
   
   .marqdiv_top{
	  z-index:9999;
	  position:absolute;
	  margin-top:0px;
	  font-weight:600px;
	  background: rgba(0, 0, 0, .5);
	  width:100%;
	  color:#FFF;
	  height:60px;
  	}
  	.marqdiv_top h4{
  	    margin-top:19px;
		margin-bottom:10px;
		margin-left:10px;
		color:#FFF;
		position: absolute;
		background: rgb(0, 0, 0) none repeat scroll 0% 0%;
		padding: 18px;
		top: -19px;
		z-index:9999;
	  }
	  .marqdiv_top h3{
		  color:#FFF;
		  text-align:center;
		  font-size: 18px;
	  }
	  .marqdiv_left {
	      z-index:9999;
	   margin-top:75px;
	  margin-left:70px;
	  font-weight:600px;
	  background: rgba(0, 0, 0, .5);
	  width:20%;
	  color:#FFF;
 height: 700px;	
 overflow: hidden;
 position: absolute;
}
.marqdiv_left h4{
  	    margin-top:19px;
		margin-bottom:10px;
		margin-left:10px;
		color:#FFF;
		position: absolute;
		background: rgb(0, 0, 0) none repeat scroll 0% 0%;
		padding: 18px;
		top: -19px;
		z-index:9999;
	  }
.marqdiv_left h3 {
 position: absolute;
 width: 100%;
 height: 100%;
 margin: 0;
 line-height: 50px;
 text-align: center;
 color:#ffffff;
 /* Starting position */
 -moz-transform:translateY(-100%);
 -webkit-transform:translateY(-100%);	
 transform:translateY(-100%);
 /* Apply animation to this element */	
 -moz-animation: marqdiv_left 15s linear infinite;
 -webkit-animation: marqdiv_left 15s linear infinite;
 animation: marqdiv_left 15s linear infinite;
}
/* Move it (define the animation) */
@-moz-keyframes marqdiv_left {
 0%   { -moz-transform: translateY(-100%); }
 100% { -moz-transform: translateY(100%); }
}
@-webkit-keyframes marqdiv_left {
 0%   { -webkit-transform: translateY(-100%); }
 100% { -webkit-transform: translateY(100%); }
}
@keyframes marqdiv_left{
 0%   { 
 -moz-transform: translateY(-100%); /* Firefox bug fix */
 -webkit-transform: translateY(-100%); /* Firefox bug fix */
 transform: translateY(-100%); 		
 }
 100% { 
 -moz-transform: translateY(100%); /* Firefox bug fix */
 -webkit-transform: translateY(100%); /* Firefox bug fix */
 transform: translateY(100%); 
 }
}

</style>
