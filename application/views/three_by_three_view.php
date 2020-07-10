<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>

<script src="<?php echo base_url();?>asset/date_time_picker/js/bootstrap-datetimepicker.min.js"></script>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/date_time_picker/css/bootstrap-datetimepicker.min.css">

<!--<link href="<?=base_url();?>asset/tooltip/tooltip.css" rel="stylesheet">
<script src="<?php echo base_url();?>asset/tooltip/tooltip.js"></script>-->
<link href="<?=base_url();?>asset/tree/treecss.css" rel="stylesheet">

<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">

<script>

	function add_short_popup(){
		$('.payment_form').each(function(i,elem) {
		 		//webuiPopover
				var url=$(this).attr('href');
			
				$(this).webuiPopover({
					constrains: 'horizontal', 
					trigger:'click',
					multi: false,
					placement:'auto',
					type:'async',
					container: "body",
					url:url,
					cache:false,
						content: function(data){
						return data;
					}
				});
				
		 });
	}
	function change_lavel_summary(){
		var date_level=$('#date_level').val();
		if(date_level==''){
			var url2='<?php echo base_url()?>index.php/comman_controler/get_level_summary/?tree=3';
		} else{
			var url2='<?php echo base_url()?>index.php/comman_controler/get_level_summary/?tree=3&date='+date_level;
		}
		$.ajax({url:url2,success:function(result){
			$('.level_summary').html(result);
			add_short_popup();
		}});
	}

	$(document).ready(function(e) {

		var nowDate = new Date();
		var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate()+1, 0, 0, 0, 0);
	    $('#daily_date').datetimepicker({ pickTime: false,endDate: today});
		
        var url='<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/drow_dropdowntree/';
				
		$.ajax({url:url,success:function(result){
	
			$('.drowtree').html(result);
		
		}});
		
		 var url2='<?php echo base_url()?>index.php/comman_controler/get_level_summary/?tree=3';
				
		$.ajax({url:url2,success:function(result){
			$('.level_summary').html(result);
			add_short_popup();
		}});
		
		$(document).on('click', '.btngoto', function (e) {
			var value 		= $('#user_code').val();
			if(value==''){
				$('#membername').focus();
				return false;
			}
			else{
				window.location.href='<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/tree/'+value;
			}
		});
		  $(document).on('click', '.clsmemdt', function (e) {
				
				e.preventDefault();
				
				var value 		= $(this).attr('value');
				
				var url='<?php echo base_url()?>index.php/comman_controler/get_memberdt_by_id/'+value;
				
				$.ajax({url:url,success:function(result){
					
					$('.tblmemberdt').html(result);
				
				}});
		});
		
		//////////
	   $("#membername").autocomplete({
                        source:'<?php echo base_url();?>index.php/comman_controler/auto_camplate',
                        minLength:2,selectFirst: true,selectOnly: true,
						select: function(event, ui) {
						event.preventDefault();
							$(this).parent().children('#user_code').val(ui.item.value);
							//$('#category_code').val(ui.item.value);
							$('#name').val(ui.item.label);},
						
						focus: function(event, ui) {
							event.preventDefault();
							$(this).parent().children('#user_code').val(ui.item.value);
							$(this).val(ui.item.label);
							$(this).removeClass('loading');},
						change: function(event,ui){
							if(ui.item==null){
								$(this).val((ui.item ? ui.item.id : ""));
								$(this).parent().children('#user_code').val('');
								$(this).removeClass('loading');}
							else{
								$(this).removeClass('loading');}},
								search: function(){
								  $(this).addClass('loading');
									},
        				open: function(){
							$(this).removeClass('loading');
							}
              });
	   /////auto///////
    });
	
	
</script> 
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
	<ul>
		<li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
		<li class="active-bre"><a href="#"> Tree 3x3</a> </li>
		<li class="page-back"> <a href="#"> <i class="fa fa-calendar" aria-hidden="true"></i> <?=date('F d, Y')?></a> </li>
		<li class="active-bre page-back"> Last Login Date & Time : <?=lastlogin($this->session->userdata['logged_ol_member']['usercode'])?></li>
		<li class="page-back materialize-red-text"> Your Username : <?=$this->session->userdata['logged_ol_member']['username']?></li>
	</ul>
</div>
<div class="tz-2 tz-2-admin">
	<div class="tz-2-com tz-2-main">
		<h4>
			Tree 3x3
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
				<div class="row">
					<div class="col-md-4">
				    	<input type="text" id="membername" value="" placeholder="Search Member" class="form-control" />
				    	<input type="hidden" id="user_code" />
				    </div>
				    <div class="col-md-1">
				    	<button type="button" class="btn btn-info btngoto">Go</button>
				    </div>
				    <div class="col-md-7">
				        <ul class="colorcode pull-right">
				            <li><img src="<?=base_url();?>asset/images/multitree/coded.png" width="20" /><span>Qualified</span></li>
				            <li><img src="<?=base_url();?>asset/images/multitree/residual_match.png" width="20" /><span>Not Qualified</span></li>
				        </ul>
				    </div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
					    <ul class="breadcrumb">
					    	<?php
								$urltree=base_url().'index.php/'.$this->uri->segment(1).'/tree/';
								
					        	for($i=0;$i<count($breadcrumb);$i++){
									$name=$breadcrumb[$i][0]['fname'].' '.$breadcrumb[$i][0]['lname'];
									if($i==count($breadcrumb)-1){
										echo'<li class="active">'.$name.'</li>';
									}
									else{
										echo'<li><a href="'.$urltree.''.$breadcrumb[$i][0]['usercode'].'">'.$name.'</a><span class="divider "><i class="icon-angle-right"></i></span></li>';
									}		
								}
							?>
					      </ul>
					      <div style="clear:both;overflow:hidden;"></div>
					    </ul>
					</div>
				</div>
				<div class="treediv">
					<div class="treeinner">
						<div class="top" style="text-align:center;">
							<?=$tree['top_img']?><p><?=$tree['top_nm']?></p>
						</div>
						<div style="height:30px;"></div>
						<div class="level1">
							<ul class="child1">
							<img class="linehr1" src="<?=base_url();?>asset/images/multitree/44.png" />
							<li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['level_one_img1']?><p><?=$tree['level_one_nm1']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['level_one_img2']?><p><?=$tree['level_one_nm2']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['level_one_img3']?><p><?=$tree['level_one_nm3']?></p></li>
						    <div class="clear"></div>
						</ul>
						</div>
						<div class="clear"></div>
						<div style="height:30px;"></div>
						<div class="level2">
							<ul class="child2">
							<img class="linehr2" src="<?=base_url();?>asset/images/multitree/44.png" />
							<li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['level_two_img1']?><p><?=$tree['level_two_nm1']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['level_two_img2']?><p><?=$tree['level_two_nm2']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['level_two_img3']?><p><?=$tree['level_two_nm3']?></p></li>
						    <div class="clear"></div>
						</ul>
						<ul class="child2">
							<img class="linehr2" src="<?=base_url();?>asset/images/multitree/44.png" />
							<li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['level_two_img4']?><p><?=$tree['level_two_nm4']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['level_two_img5']?><p><?=$tree['level_two_nm5']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['level_two_img6']?><p><?=$tree['level_two_nm6']?></p></li>
						    <div class="clear"></div>
						</ul>
						<ul class="child2">
							<img class="linehr2" src="<?=base_url();?>asset/images/multitree/44.png" />
							<li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['level_two_img7']?><p><?=$tree['level_two_nm7']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['level_two_img8']?><p><?=$tree['level_two_nm8']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['level_two_img9']?><p><?=$tree['level_two_nm9']?></p></li>
						    <div class="clear"></div>
						</ul>
						</div>
						<div class="clear"></div>
						<div style="height:30px;"></div>

						<div class="level3">
							<ul class="child3">
							<img class="linehr" src="<?=base_url();?>asset/images/multitree/44.png" />
							<li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img1']?><p><?=$tree['lev3nm1']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img2']?><p><?=$tree['lev3nm2']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img3']?><p><?=$tree['lev3nm3']?></p></li>
						    <div class="clear"></div>
						</ul>
						<ul class="child3">
							<img class="linehr" src="<?=base_url();?>asset/images/multitree/44.png" />
							<li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img4']?><p><?=$tree['lev3nm4']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img5']?><p><?=$tree['lev3nm5']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img6']?><p><?=$tree['lev3nm6']?></p></li>
						    <div class="clear"></div>
						</ul>
						<ul class="child3 thirdchild">
						 	<img class="linehr" src="<?=base_url();?>asset/images/multitree/44.png" />
							<li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img7']?><p><?=$tree['lev3nm7']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img8']?><p><?=$tree['lev3nm8']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img9']?><p><?=$tree['lev3nm9']?></p></li>
						    <div class="clear"></div>
						</ul>
						<ul class="child3">
						 	<img class="linehr" src="<?=base_url();?>asset/images/multitree/44.png" />
							<li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img10']?><p><?=$tree['lev3nm10']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img11']?><p><?=$tree['lev3nm11']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img12']?><p><?=$tree['lev3nm12']?></p></li>
						    <div class="clear"></div>
						</ul>
						<ul class="child3">
						 	<img class="linehr" src="<?=base_url();?>asset/images/multitree/44.png" />
							<li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img13']?><p><?=$tree['lev3nm13']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img14']?><p><?=$tree['lev3nm14']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img15']?><p><?=$tree['lev3nm15']?></p></li>
						    <div class="clear"></div>
						</ul>
						<ul class="child3 thirdchild">
						 	<img class="linehr" src="<?=base_url();?>asset/images/multitree/44.png" />
							<li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img16']?><p><?=$tree['lev3nm16']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img17']?><p><?=$tree['lev3nm17']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img18']?><p><?=$tree['lev3nm18']?></p></li>
						    <div class="clear"></div>
						</ul>
						<ul class="child3">
						 	<img class="linehr" src="<?=base_url();?>asset/images/multitree/44.png" />
							<li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img19']?><p><?=$tree['lev3nm19']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img20']?><p><?=$tree['lev3nm20']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img21']?><p><?=$tree['lev3nm21']?></p></li>
						    <div class="clear"></div>
						</ul>
						<ul class="child3">
						 	<img class="linehr" src="<?=base_url();?>asset/images/multitree/44.png" />
							<li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img22']?><p><?=$tree['lev3nm22']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img23']?><p><?=$tree['lev3nm23']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img24']?><p><?=$tree['lev3nm24']?></p></li>
						    <div class="clear"></div>
						</ul>
						<ul class="child3">
						 	<img class="linehr" src="<?=base_url();?>asset/images/multitree/44.png" />
							<li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img25']?><p><?=$tree['lev3nm25']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img26']?><p><?=$tree['lev3nm26']?></p></li>
						    <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" /><?=$tree['lev3img27']?><p><?=$tree['lev3nm27']?></p></li>
						    <div class="clear"></div>
						</ul>
						<div class="clear"></div>
						</div>
					</div><!-- treeinner -->	
				</div><!-- treediv -->
				<br>
				<div class="row">
					<div class="col-md-6">
						<div class="content-widgets">
							<div>
								<div class="widget-header-block"><h4 class="widget-header"><i class="icon-group "></i> Tree</h4></div>
								<div class="content-box drowtree">
									
								</div>
							</div>
						</div><!-- content-widgets -->
					</div><!-- span6 -->
				    
				    <div class="col-md-6">
						<div class="content-widgets">
							<div>
								<div class="widget-header-block"><h4 class="widget-header"><i class=" icon-table"></i>Details</h4></div>
								<div class="content-box">
									<table class="table table-bordered tblmemberdt">
				                    	
				                    </table>
								</div>
							</div>
						</div><!-- content-widgets -->
					</div><!-- span6  -->
				</div><!---row-fluid -->

				<div class="row">
					<div class="col-md-12 level_summary">

					</div>
				</div>
 			</div>
 		</div>
 	</div>
</div>
<style>
.treeinner{
	width:1900px;
}
.treediv{
	width:100%;
	overflow:auto;
	direction:rtl;
}
.child3{
	width:200px;
	list-style:none;
	margin:0px;
	padding:0px;
	margin-left:5px;
	padding-top:10px;
	position:relative;
	float:left;
	background-image:url(<?=base_url();?>asset/images/multitree/130.png);
	background-repeat:no-repeat;
	background-position:48% 0px;
	
}
.thirdchild{
	margin-right:20px;
}
.child3 li{
	width:33%;
	float:left;
	text-align:center;
	position:relative;

}
.child3 li p{
	font-size:12px;
}
.child3 .line{
	position:absolute;
	top:-9px;
	left:49%;
}
.child2{
	width:33%;
	list-style:none;
	margin:0px;
	padding:0px;
	margin-left:5px;
	padding-top:10px;
	position:relative;
	float:left;
	background-image:url(<?=base_url();?>asset/images/multitree/412.png);
	background-repeat:no-repeat;
	background-position:49% 0px;
}
.child2 li{
	width:33%;
	float:left;
	text-align:center;
	position:relative;

}
.child2 li p{
	font-size:12px;
}
.child2 .line{
	position:absolute;
	top:-9px;
	left:50%;
}
.clear{
	clear:both;
	overflow:hidden;
}
.child1{
	background-image:url(<?=base_url();?>asset/images/multitree/1252.png);
	background-repeat:no-repeat;
	background-position:48.5% 0px;
	width:100%;
	list-style:none;
	margin:0px;
	padding:0px;
	margin-left:5px;
	padding-top:10px;
	position:relative;
}
.child1 li{
	width:33%;
	float:left;
	text-align:center;
	position:relative;

}
.child1 li p{
	font-size:12px;
}
.child1 .line{
	position:absolute;
	top:-9px;
	left:50%;
}
.linehr{
	position: absolute;
	left: 49%;
	top: -39px;
}
.linehr2{
	position: absolute;
	left: 49.5%;
	top: -39px;
}
.linehr1{
	position: absolute;
	left: 49.5%;
	top: -39px;
}
.colorcode{
	list-style:none;
	margin:0px;
}
.colorcode li{
	float:left;
	margin-right:15px;
}

.bootstrap-datetimepicker-widget.dropdown-menu{
	background-color: #fff !important;
}
</style>
