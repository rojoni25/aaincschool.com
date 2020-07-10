<div class="page_title">

	<div class="container">
		<div class="title"><h1><?=$result[0]['pagename']?></h1></div>
        <?php /*?><div class="pagenation">&nbsp;<a href="index.html">Home</a> <i>/</i> <a href="#">Pages</a> <i>/</i> Full Width</div><?php */?>
	</div>
</div><!-- end page title --> 

<div class="container">
  <div class="content_fullwidth">
   		
         <?php
		 
	?>
    
        <!-------------------->
         <?php
	   if($result[0]['video_url']!=''){
			echo '<div class="video_frm">';
			echo '<div class="inner_frm">';
			if (strpos($result[0]['video_url'], 'youtube') !== false)
			{
				echo '<iframe width="100%" height="100%" src="'.$result[0]['video_url'].'" frameborder="0" allowfullscreen></iframe>';
			}
			else{
				echo '<video width="100%" height="100%" controls="controls"><source src="'.$result[0]['video_url'].'" type="video/mp4"></video>';
			}
			echo '</div>';
			echo '</div>';
		}
                    
	?>
    
        <!-------------------->
        <?php
        	if($result[0]['title']!=''){
				echo '<div class="big_text1"><i>'.$result[0]["title"].'</i></div>';
			}
		?>
        
        <div class="one_full">
        	<?=$result[0]['textdt']?>
        </div>
        <div style="clear:both;overflow:hidden;"></div>
  </div>
  <!-- end content_fullwidth area --> 
</div>
<!-- end content area -->

<style>
	.btncls{
		border:none;
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
	.txtdiv{
		width:90%;
		position:relative;
		margin:auto;
	}
	.content_fullwidth{
		padding-top:20px !important;
	}
	.big_text1{
		padding:10px 0px;
	}
</style>
