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
    
    
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
	<ul>
		<li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
		<li class="active-bre"><a href="#"> AAINC Unilevel</a> </li>
		<li class="page-back"> <a href="#"> <i class="fa fa-calendar" aria-hidden="true"></i> <?=date('F d, Y')?></a> </li>
		<li class="active-bre page-back"> Last Login Date & Time : <?=lastlogin($this->session->userdata['logged_ol_member']['usercode'])?></li>
		<li class="page-back materialize-red-text"> Your Username : <?=$this->session->userdata['logged_ol_member']['username']?></li>
	</ul>
</div>
<div class="tz-2 tz-2-admin">
	<div class="tz-2-com tz-2-main">
		<h4>
			AAINC Unilevel
		      <?php
		        $loginusercode = $this->session->userdata['logged_ol_member']['usercode'];
		        $referralcount = countreferral($loginusercode);
		        if($referralcount>=3){
		      ?>
		          <span class="pull-right">
		            <a href="#" class="btn btn-primary btn-sm" style="padding: 5px;height: 30px;"><strong> Qualified</strong></a>
		          </span>
		      <?
		        }else{
		      ?>
		          <span class="pull-right">
		            <a href="#" class="btn btn-danger btn-sm" style="padding: 5px;height: 30px;"><strong>Not Qualified</strong></a>
		          </span>
		      <?    
		        }
		      ?>
		      <?
		      if($this->session->userdata['tbl']['current_account']=='Pending')
		      {
		      ?>
		        <!--<span class="" style="color: #fff;padding-left: 10px;">-->
		        <!--  <i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> -->
		        <!--  <span style="color: darkgoldenrod;font-size: 20px;">  Smart Wallet : </span>-->
		        <!--  <span style="color: yellow;font-size: 20px;">$<?=$referralcount*5?></span>-->
		        <!--</span>-->
		        <span class="" style="color: #fff;padding-left: 30px;"> 
		          <i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> 
		          <span style="color: darkgoldenrod;font-size: 20px;"> Capture Page Wallet : </span>
		          <span style="color: yellow;font-size: 20px;">$<?=$referralcount*5?> /per month</span>
		        </span>
		      <?
		      }else{
			      $loginusercode = $this->session->userdata['logged_ol_member']['usercode'];
			  ?>
				<span class="" style="color: #fff;padding-left: 10px;">
					<i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> 
					<span style="color: darkgoldenrod;font-size: 20px;">  Referral Wallet : </span>
					<span style="color: yellow;font-size: 20px;">$<?=GetPaidReferalWallet($loginusercode)?></span>
				</span>
		        <span class="" style="color: #fff;padding-left: 30px;"> 
		          <i style="color: yellow;font-size: 20px;" class="fa fa-money" aria-hidden="true"></i> 
		          <span style="color: darkgoldenrod;font-size: 20px;"> Capture Page Wallet : </span>
		          <span style="color: yellow;font-size: 20px;">$<?=getCapturePageWalletTotal($loginusercode)?> /per month</span>
		        </span>
		      <?  
		      }
		      ?>
		</h4>
		<div class="tz-2-main-2 row"> 
			<div class="col-md-12">
			      <div class="text-center unilevel_main" style="overflow: auto;">
			       	<?=$result?>
			      </div>
			</div>
		</div>
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