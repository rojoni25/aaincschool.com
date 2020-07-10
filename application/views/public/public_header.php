<!DOCTYPE html>
<html lang="en">
<head>
	<title><?=getconfigMeta('comanyname')?> - 2019</title>
	<!-- META TAGS -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="Financial education, financial planning, financial acquisition, investment education, investment opportunities, continued financial education, business development, business planning, business opportunity, philanthropy">
	<!-- FAV ICON(BROWSER TAB ICON) -->
	<!-- GOOGLE FONT -->
	<link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:500,700" rel="stylesheet">
	<!-- FONTAWESOME ICONS -->
	<link rel="stylesheet" href="<?=base_url();?>asset/css/font-awesome.min.css">
	<!-- ALL CSS FILES -->
	<link href="<?=base_url();?>asset/css/materialize.css" rel="stylesheet">
	<link href="<?=base_url();?>asset/css/style.css" rel="stylesheet">
	<link href="<?=base_url();?>asset/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
	<link href="<?=base_url();?>asset/css/responsive.css" rel="stylesheet">
	<!-- revolution slider -->
    <link rel="stylesheet" href="<?=base_url();?>rs-plugin/css/settings.css" type="text/css">
    <!-- <link href="<?=base_url();?>asset/css/rev-settings.css" rel="stylesheet">
	HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">
		.id-color{
			color: #fff;
		}
		/*#v3-mob-menu-btn {
			font-size: 15px;
		    color: #fff;
		    background-color: #01a0d8;
		    border: 1px solid #058ab9;
		    font-weight: 400;
		    border-radius: 4px;
		    padding: 6px 10px;
		    margin-left: 7px;
		}*/
	</style>
</head>

<body id="homepage" class="de_light"	>
	<!--PRE LOADING-->
	<div id="preloader">
		<div id="status">&nbsp;</div>
	</div>
	<!--BANNER AND SERACH BOX-->
	<?
		$mobile = checkdevice();
	?>
	<div class="">
		<div class="wrapper">
			<!-- header begin -->
        	<header class="de_header_2">
				<div class="container">
				  	<div class="row">
					    <div class="col-md-6 col-sm-6 col-xs-12">
					      <div class="dir-ho-tl">
					        <!--<ul>
					          <li style="padding-top: <?=$mobile?'65px':'20px'?>;">
					            <a href="<?=base_url();?>index.php" style="font-size: 40px;"><?=getconfigMeta('comanyname')?></a>
					          </li>
					          <li><a href="#" class="ts-menu-5" id="v3-mob-menu-btn"><i class="fa fa-bars" aria-hidden="true"></i>Menu</a> </li>
					        </ul>-->
					      </div>
					    </div>
					    <div class="col-md-6 col-sm-6">
					      	<div class="dir-ho-tr">
						        <ul>
									<li><a href="<?=base_url();?>index.php">Home</a> </li>
									<li><a href="<?=base_url();?>index.php/mission">Mission</a> </li>
						          	<?php if(!$this->session->userdata('logged_ol_member') && !$this->session->userdata('logged_ol_member_free')){ ?>
					            		<li><a href="<?=base_url();?>index.php/login">Login</a></li>
					               
					            	<?php }else{ ?>
					            		<li><a href="<?=base_url();?>index.php/welcome">Dashboard</a></li>
					                	<li><a href="<?=base_url();?>index.php/login/logout">Logout</a></li>
					            	<?php } ?>

						        </ul>
					      	</div>
					    </div>
				  	</div>
				</div>
				<!--TOP SEARCH SECTION-->
				<section id="myID" class="bottomMenu hom-top-menu">
					<div class="container top-search-main">
						<div class="row">
							<div class="ts-menu">
								<!--MOBILE MENU ICON:IT'S ONLY SHOW ON MOBILE & TABLET VIEW-->
								<div class="ts-menu-5"><span><i class="fa fa-bars" aria-hidden="true"></i></span> </div>
								<!--MOBILE MENU CONTAINER:IT'S ONLY SHOW ON MOBILE & TABLET VIEW-->
								<div class="mob-right-nav" data-wow-duration="0.5s">
									<div class="mob-right-nav-close"><i class="fa fa-times" aria-hidden="true"></i> </div>
									<h5><?=getconfigMeta('comanyname')?></h5>
									<ul class="mob-menu-icon">
										<li><a href="<?=base_url();?>">Home</a> </li>
										<li><a href="<?=base_url();?>index.php/mission">Mission</a> </li>
										<?php if(!$this->session->userdata('logged_ol_member') && !$this->session->userdata('logged_ol_member_free')){ ?>
					            			<li><a href="<?=base_url();?>index.php/login">Login</a></li>
					               
						            	<?php }else{ ?>
						            		<li><a href="<?=base_url();?>index.php/welcome">Dashboard</a></li>
						                	<li><a href="<?=base_url();?>index.php/login/logout">Logout</a></li>
						            	<?php } ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</section>
			</header>
			<div id="content" class="no-bottom no-top">
				<?
                if(isset($slider)){
           		?>
           		<!--<div class="tp-banner-container">
			        <div class="tp-banner" >
			            <ul>
						<?php foreach($slider as $s){ ?>
			            	<li data-transition="fade" data-slotamount="5" data-masterspeed="700" >

			            		<img src="<?=$s['media_link']?>" alt="Sky" class="img-responsive" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" >
				            </li>
			            <?php } ?>
				        </ul>
				        <div class="tp-bannertimer"></div>
				    </div>
				</div>-->
					<img src="<?=base_url();?>asset/img/intro.gif" alt="Sky" class="img-responsive" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" >
	            <?
	        	}else{
	        	?>
	        		<section class="dir3-home-head">
	        			<div class="container dir-ho-t-sp">
						  <div class="row">
						    <div class="dir-hr1 dir-cat-search">
						      <div class="dir-ho-t-tit">
						       
						      </div>
						    </div>
						  </div>
						</div>
	        		</section>
	        	<?	
	        	}
	        	?>
	            
	        </div>
		</div>
	</div>
	

	
