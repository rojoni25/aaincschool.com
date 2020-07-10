<script>
		$(document).on('click', '.coded_li_click', function (e) {
			var level=$(this).attr('level');
			var usercode=$(this).attr('usercode');
			var posi=$(this).attr('posi');
			var main_margin=$(this).attr('main_margin');
			$(this).siblings().removeClass('activeli');
			$(this).addClass('activeli');
			 ////////////
			 var i=parseInt(level)+1;
			 for(i;i<30;i++){
					$('.div'+i).remove()
				}
			
			var url='<?=base_url();?>index.php/dreem_student/<?=$this->uri->rsegment(1)?>/get_next_level/'+usercode+'/'+level+'/'+posi+'/'+main_margin+'';	
			$.ajax({url:url,success:function(result){
				$('.codedlevel_main').append(result);	
			}});
		
	   ////////////
	
		});
    </script>

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>



<?php if($this->session->flashdata('show_msg')!=''){?>
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <i class="icon-info-sign"></i><strong>
  <?=$this->session->flashdata('show_msg');?>
  </strong> </div>
<?php } ?>



<div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Your Friend (Dreem Student)
          		<span class="pull-right"><a href="<?=base_url()?>index.php/dreem_student/page/view/"><button class="btn btn-round-min" type="button"><span><i class="icon-home"></i></span></button></a></span>
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Dreem Student</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Your Friend (Dreem Student)</li>
        </ul>
      </div>
    </div>
    
    
    <div class="row-fluid ">
      <div class="">
       		
		<?php
            if($contain[0]['video_url']!=''){
                echo '<div class="video_frm">';
                echo '<div class="inner_frm">';
                 if (strpos($contain[0]['video_url'], 'youtube') !== false || strpos($contain[0]['video_url'], 'slideshare') !== false)
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
        	<div class="txtdiv"><?=$contain[0]['textdt']?></div>
            <div style="clear:both;overflow:hidden;"></div>
        </div>
    </div>
    <br />
    
    
    <div class="row-fluid">
      <div class="span12 codedlevel_main">
       	<?=$result?>
      </div>
    </div>


<style>
	.coded_first_node{
		height:120px;
		text-align:center;
		
	}
	.coded_first_node > div{
		width:100px;
		height:100px;
		margin:auto;
		text-align:center;
		border:#333 solid 1px;
		padding-top:5px;
		margin-bottom:5px;
	}
	.coded_first_node p{
		text-align:center;
	}
	.coded_ul{
		list-style:none;
	}
	.coded_ul:after{
		float:none;
		overflow:hidden;
	}
	.coded_ul li{
		float:left;
		margin:5px;
		padding:5px 0px;
		width:100px;
		height:100px;
		text-align:center;
		border:#333 solid 1px;
		position:relative;
		cursor:pointer;
	}
	.line_div{
		padding:5px 0px;
		height:1px;
	}
	.line_div hr{
		border-bottom:#000 solid 1px;
		margin:auto;
	}
	.vr_line{
		position:absolute;
		left:50%;
		top:-10px;
	}
	.activeli{
		border:#F00 solid 1px;
		font-weight:bold;
		background-color:#7FF57F;
	}
	.codedlevel_main{
		  	width: 100%;
			overflow-y: scroll;
			white-space: nowrap;
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
.cls_head_btn{
	font-family: Arial, Helvetica, sans-serif;
}

@media  only screen and (max-width: 535px){
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

.lev1{
	background-color: #7FF57F;
}
.lev2{
	background-color: #00CCFF;	
}
.lev3{
	background-color: #99CC99;	
}
.lev4{
	background-color: #996699;	
}
.lev5{

}
.lev6{

}
.lev7{

}
</style> 






