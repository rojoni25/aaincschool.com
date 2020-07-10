<script>
	$(document).ready(function(e) {
        $(document).on('click', '.pageperview', function (e) {
			var pagecode=$(this).attr('value');
			//*********//
				params  = 'width='+screen.width;
				params += ', height='+screen.height;
				params += ', top=0, left=0'
				params += ', fullscreen=yes';
				var url='<?php echo base_url();?>index.php/capture/page/'+pagecode+'';
				url=url.replace('ol_admin/', '')
				
				newwin=window.open(url,'', params);
				if (window.focus) {newwin.focus()}
			//***********//
		});
		
		$(document).on('click', '.delete', function (e) {	
			var pagecode=$(this).attr('value');
			///////////
			var url='<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/record_update/'+pagecode+'';
			//alert(url);
			$(this).parent().parent().remove();
			
			$.ajax({url:url,success:function(result){
				
     		}});
			////////////
		});
    });
	$(document).on('change','#page_type',function(e){
			var page_type=$('#page_type').val();
			var url='<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/view/'+page_type;
			//alert(url);
			window.location.href=url;

		});
</script>
<div class="row">  
	<div class="span12">    
		<ul class="top-banner"></ul>
	</div>
</div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
    <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Master</a> </li>
    <li class="active-bre"><a href="#"> Capture Page</a> </li>
  </ul>
</div>

<div class="tz-2 tz-2-admin">
  	<div class="tz-2-com tz-2-main">
	    <h4>Capture Page Master</h4>
	    <div class="tz-2-main-com bot-sp-20">
	    	<div class="">
	    		<div class=""> 
	    			<form>
	    				<div class="row">
		    				<div class="input-field col-md-4 s12 col-md-offset-1">
					            <select id="page_type" name="page_type" class="">
				              		<option value="">All</option>
				                    <?php
				                    	for($i=0;$i<count($category);$i++)
										{
											$sel=($category[$i]['capture_filter_code']==''.$this->uri->segment(3).'')?"selected":"";
											echo '<option '.$sel.' value="'.$category[$i]['capture_filter_code'].'">'.$category[$i]['page_type'].'</option>';
										}
									?>
				             	</select>
				             </div>
				         </div>
	             	</form>
	    		</div>
	     	 </div>
	    </div>
	     <div class="tz-2-main-com bot-sp-20">
			<div class="row">
			  <div class="">
				<?php
					if($contain[0]['video_url']!=''){
						
						echo '<div class="video_frm">';
						echo '<div class="inner_frm">';
						if (strpos($contain[0]['video_url'], 'youtube') !== false)
						{
							echo '<iframe width="100%" height="100%" src="'.$contain[0]['video_url'].'"autoplay=0 frameborder="0" allowfullscreen></iframe>';
						}
						else{
							echo '<video width="100%" height="100%" controls="controls"><source src="'.$contain[0]['video_url'].'" type="video/mp4"></video>';
						}
						echo '</div>';
						echo '</div>';
					}
					
					?>
			  </div>
			  <div style="margin-top:30px;">
			    <div class="txtdiv">
			      <?=$contain[0]['textdt']?>
			    </div>
			    <div style="clear:both;overflow:hidden;"></div>
			  </div>
			</div>

			<br>
			<div class="tz-2-com" style="min-height:1250px;position:relative;">
				<div class="tz-2-main-com">
	        		<?php for($i=0;$i<count($result);$i++){	?>
	        			<div class="tz-2-main-1 tz-2-main-admin">
		                	<div class="tz-2-main-2 thumdiv">
		                    	<a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/add_new_page/Add/<?=$result[$i]['pagecode']?>">
									<div class="board-widgets green">
										<div class="board-widgets-head clearfix">
											<h4 class="pull-left"><? echo $i + 1;?>) <i class="icon-inbox"></i><?=$result[$i]['pagelable']?></h4>
										</div>
										<img src="<?php echo base_url();?>asset/capture_thum/<?=$result[$i]['thum_img']?>" class="img-responsive"/>
									</div>
		                    	</a>
							</div>
						</div>
	                <?php
	                	$num = $i+1;
	                	if($num%4==0){
	                		echo '</div><div class="tz-2-main-com">';
	                	} 
	            	} 
	            	?>
	            </div>
	            <div style="clear:both;overflow:hidden;"></div>
			</div>
		</div>
	</div>
</div>
<style>
	.tz-2-main-com{
		padding: 0;
	}
	.tz-2-main-com img{
		
		padding: 5px;
		border: none;
		margin: 0;
	}
	.btncls{
		border:none;
		margin-right:5px;
	}
	.thumdiv{
		padding: 0;
	}

</style>

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
#compnay_page{
	float:right;
}
#capture_page{
	float:right;
	margin-right:10px;
}
#view_page{
	float:right;
	margin-right:10px;

}
#add_page{
	float:right;
	margin-right:10px;
}
#request_page{
	float:right;
	margin-right:10px;
}
.linkbtn{
	padding:2px;
}
</style>
<style>
@media  only screen and (max-width: 500px){

.membertable table, .membertable thead, .membertable tbody, .membertable th, .membertable td, .membertable tr {
	display: block;
}
.membertable thead tr {
	position: absolute;
	top: -9999px;
	left: -9999px;
}
.membertable tr {
	border: 1px solid #ccc;
}
.membertable td {
	border: none;
	border-bottom: 1px solid #eee;
	position: relative;
	padding-left: 50% !important;
}
.membertable td:before {
	position: absolute;
	top: 6px;
	left: 6px;
	width: 45%;
	padding-right: 10px;
	white-space: nowrap;
}
.membertable td:nth-of-type(1):before {
	content: "Page Name";
}
.membertable td:nth-of-type(2):before {
	content: "Page Type";
}
.membertable td:nth-of-type(3):before {
	content: "URL";
}
.membertable td:nth-of-type(4):before {
	content: "Update";
}


}
@media  only screen and (max-width: 1110px){

.page-header{
	height: 75px;
}
#request_page{
	margin-top:7px;
	margin-left:18%;
}
}
@media  only screen and (max-width: 960px){
#add_page{
	margin-top:7px;
	margin-left:22%;

}

}
@media  only screen and (max-width: 840px){
#request_page{
	margin-top:-35px;
	margin-left:0%;
}
#add_page{
	margin-top:-35px;
	margin-left:0%;

}
#view_page{
	margin-top:10px;
	margin-right:50px;

}

}
@media  only screen and (max-width: 768px){
#request_page{
	margin-top:0px;
	margin-left:0%;
}
#add_page{
	margin-top:0px;
	margin-left:0%;

}
#view_page{
	margin-top:0px;
	margin-right:10px;

}

}
@media  only screen and (max-width: 660px){
#request_page{
	margin-top:5px;
	margin-left:5%;
	float:left;
}
#add_page{
	margin-top:5px;
	margin-left:18%;

}
#view_page{
	margin-top:0px;
	margin-right:10px;

}

}
@media  only screen and (max-width: 535px){
#request_page{
	margin-top:5px;
	margin-left:0%;
	float:right;

}
#add_page{
	margin-top:5px;
	margin-left:0%;

}
#view_page{
	margin-top:10px;
	margin-right:10px;
	float:left;

}

.video_frm {
   width: 284px;
height: 200px;
}

.inner_frm {
    height: 176px;
    width: 235px;
    margin-top: 12px;
    margin-left: 24px;
}
}
@media  only screen and (max-width: 476px){
.page-header{
	height: 160px;
}

#request_page{
	
	float:right;
	margin-top:5px;

}
#add_page{
	float:left;
}
#view_page{
	margin-top:5px;
	float:right;
}
#capture_page{
	float:left;
	margin-top:10px;
}
#compnay_page{
	float:right;
	margin-top:40px;
}

}
@media  only screen and (max-width: 310px){
.video_frm {
    width: 190px;
    height: 134px;
}

.inner_frm {
    height: 118px;
width: 157px;
margin-top: 8px;
margin-left: 16px;
}
}
</style>