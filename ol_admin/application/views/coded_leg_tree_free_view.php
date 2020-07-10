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
			
			var url='<?=base_url();?>index.php/<?=$this->uri->segment(1)?>/get_next_level/'+usercode+'/'+level+'/'+posi+'/'+main_margin+'';	
			$.ajax({url:url,success:function(result){
				$('.codedlevel_main').append(result);	
			}});
		
	   ////////////
	
		});
    </script>

   <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Coded Leg Listing</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Tree</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Coded Leg Listing</li>
        </ul>
      </div>
    </div>
    
    
    
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