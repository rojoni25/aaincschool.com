<div class="row-fluid ">
 <div class="span12">    
	<ul class="top-banner"></ul>
	<!--<ul class="top-banner-free"></ul>-->
 </div>
</div>

<link href="<?=base_url();?>asset/tooltip/tooltip.css" rel="stylesheet">
<script src="<?php echo base_url();?>asset/tooltip/tooltip.js"></script>
<link href="<?=base_url();?>asset/tree/treecss.css" rel="stylesheet">
<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">

<link rel="stylesheet" href="<?=base_url()?>asset/popover/jquery.webui-popover.min.css">
<script src="<?=base_url()?>asset/popover/jquery.webui-popover.min.js"></script>	


<script>
	$(document).ready(function(e) {
		
    	var url='<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/drow_dropdowntree/<?php echo $this->uri->segment(3)?>';
		$.ajax({url:url,success:function(result){
			$('.drowtree').html(result);
		}});
		var url2='<?php echo base_url()?>index.php/comman_controler_free/get_level_summary/<?php echo $this->uri->segment(3)?>/?tree=3';
		$.ajax({url:url2,success:function(result){
			console.log(result);
			$('.level_summary').html(result);
		}});


		$(document).on('click', '.btngoto', function (e) {
			var value 		= $('#user_code').val();
			if(value==''){
				$('#membername').focus();
				return false;
			}
			else{
				window.location.href='<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/view/'+value;
			}
		});
		  $(document).on('click', '.clsmemdt', function (e) {
				
				e.preventDefault();
				
				var value 		= $(this).attr('value');
				
				var url='<?php echo base_url()?>index.php/comman_controler_free/get_memberdt_by_id/'+value+'/3';
			
				$.ajax({url:url,success:function(result){
					
					$('.tblmemberdt').html(result);
				
				}});
		});
		
		//////////
	   $("#membername").autocomplete({
                        source:'<?php echo base_url();?>index.php/comman_controler_free/auto_camplate',
                        minLength:1,selectFirst: true,selectOnly: true,
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
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Tree 3 x 3
      		
      </h3>
     
    </div>
    <div><input type="text" id="membername" value="" placeholder="Search Member" />
    	<input type="hidden" id="user_code" />
    	<button type="button" class="btn btn-info btngoto" style="margin-top:-11px;">Go</button>
        <ul class="colorcode pull-right">
        	<li><img src="<?=base_url();?>asset/images/multitree/member.png" width="20" /><span>Not Qualified</span></li>
            <li><img src="<?=base_url();?>asset/images/multitree/coded.png" width="20" /><span>Qualified</span></li>
        </ul>
    </div>
    
    <div style="clear:both;overflow:hidden;"></div>
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
 	<img src="<?=base_url();?>asset/images/multitree/admin.png" />
    <p><a class='show-pop-event' href='<?php echo $this->uri->segment(3)?>'><?=$tree['top_nm']?></a></p>
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


 <div class="row-fluid">
		<div class="span6">
			<div class="content-widgets">
				<div>
					<div class="widget-header-block"><h4 class="widget-header"><i class="icon-group "></i> Tree</h4></div>
					<div class="content-box drowtree">
						
					</div>
				</div>
			</div><!-- content-widgets -->
		</div><!-- span6 -->
        
        <div class="span6">
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
  
  <div class="row-fluid level_summary">
   
   </div>
 
   


<script>
	$(document).ready(function(e) {
             	////
		$('.show-pop-event').each(function(i,elem) {
				 		//webuiPopover
						var value=$(this).attr('href');
						$(this).webuiPopover({
							constrains: 'horizontal', 
							trigger:'click',
							multi: false,
							placement:'auto',
							type:'async',
							container: "body",
							url:'<?php echo base_url()?>index.php/comman_controler_free/get_memberdt_by_id/'+value+'/3',
							cache:false,
								content: function(data){
								return data;
							}
						});
						//end webuiPopover
				 });
				////   
            });
</script>

 
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
.table td {
    padding: 3px !important;
    line-height: 21px !important;
}
</style>
