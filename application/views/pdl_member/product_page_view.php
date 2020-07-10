
<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">
        <?=$contain[0]['title']?>
        <a href="<?=base_url()?>index.php/pdl/pdl_member_home/view" class="pull-right"><span class="label label-success llb-back">Dashboard</span></a>
      </h3>
    </div>
  </div>
</div>
<div class="row-fluid ">
  <div class="">
    <?php
		if($contain[0]['video_url']!=''){
			echo '<div class="video_frm">';
			echo '<div class="inner_frm">';
			if (strpos($contain[0]['video_url'], 'youtube') !== false)
			{
				echo '<iframe width="100%" height="100%" src="'.$contain[0]['video_url'].'" frameborder="0" allowfullscreen></iframe>';
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
	content: "Name";
}
.membertable td:nth-of-type(2):before {
	content: "Username";
}
.membertable td:nth-of-type(3):before {
	content: "Capture Page";
}
.membertable td:nth-of-type(4):before {
	content: "Phone No";
}
.membertable td:nth-of-type(5):before {
	content: "Email";
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
