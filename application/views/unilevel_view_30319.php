<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
	<script>
		$(document).ready(function(e) {
            
  
		$(document).on('click', '.uni_li_click', function (e) {
			var level=$(this).attr('level');
			var usercode=$(this).attr('usercode');
			var posi=$(this).attr('posi');
			var main_margin=$(this).attr('main_margin');
			$(this).siblings().removeClass('activeli');
			$(this).addClass('activeli');
			
			var i=parseInt(level)+1;
			for(i;i<30;i++){
				$('.div'+i).remove()
			}

			var url='<?=base_url();?>index.php/<?=$this->uri->segment(1)?>/get_next_level/'+usercode+'/'+level+'/'+posi+'/'+main_margin+'';	
			
			$.ajax({url:url,success:function(result){
				$('.unilevel_main').append(result);	
			},
      			error: function (xhr, ajaxOptions, thrownError) {
        		alert(xhr.status);
        		alert(thrownError);
      		}
			});
		});
		
		      });
    </script>
    
    

   <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Unilevel Listing</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Tree</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Unilevel Listing </li>
        </ul>
      </div>
    </div>
    
    
    
    <div class="row-fluid">
      <div class="span10 unilevel_main">
       	<?=$result?>
      </div>
      <div class="span2">
      	<ul class="ul_list">
        	<li><img src="<?=base_url();?>asset/images/multitree/member.png" width="20" /><span>No Commission</span></li>
            <li><img src="<?=base_url();?>asset/images/multitree/coded.png" width="20" /><span>Coded</span></li>
            <li><img src="<?=base_url();?>asset/images/multitree/coded_match.png" width="20" /><span>Coded Match</span></li>
            <li><img src="<?=base_url();?>asset/images/multitree/residual.png" width="20" /><span>Residual</span></li>
            <li><img src="<?=base_url();?>asset/images/multitree/residual_match.png" width="20" /><span>Residual Match</span></li>
        </ul>
      </div>
    </div>


<style>
	.ul_list{
		margin:0px;
		padding:0px;
		list-style:none;
	}
	.ul_list li{
		padding:4px 0px;
	}
	.uni_first_node{
		height:120px;
		text-align:center;
		
	}
	.uni_first_node > div{
		width:100px;
		height:100px;
		margin:auto;
		text-align:center;
		border:#333 solid 1px;
		padding-top:5px;
	}
	.uni_first_node p{
		text-align:center;
	}
	.uni_ul{
		list-style:none;
	}
	.uni_ul:after{
		float:none;
		overflow:hidden;
	}
	.uni_ul li{
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
	.unilevel_main{
		  	width: 100%;
			overflow-x: scroll;
			overflow-y: scroll;
			white-space: nowrap;
	}
	
	
</style>