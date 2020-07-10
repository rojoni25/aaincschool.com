<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>

<script src="<?php echo base_url();?>asset/date_time_picker/js/bootstrap-datetimepicker.min.js"></script>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/date_time_picker/css/bootstrap-datetimepicker.min.css">

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
			var url2='<?php echo base_url()?>index.php/comman_controler/get_level_summary/?tree=10';
		} else{
			var url2='<?php echo base_url()?>index.php/comman_controler/get_level_summary/?tree=10&date='+date_level;
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
		
		 var url2='<?php echo base_url()?>index.php/comman_controler/get_level_summary/?tree=10';
				
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
				
				var url='<?php echo base_url()?>index.php/comman_controler/get_memberdt_by_id/'+value+'/10';
				
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
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Tree 10 x 3</h3>
    </div>
     <div><input type="text" id="membername" value="" placeholder="Search Member" />
    	<input type="hidden" id="user_code" />
    	<button type="button" class="btn btn-info btngoto" style="margin-top:-11px;">Go</button>
    </div>
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
  </div>
</div>
<div class="row-fluid">
  <div class="span12 list_status_div">
    <div class="tree">
    
     <div style="position:relative;"><div class="top_line">&nbsp;</div></div>
    
      <div style="position:relative;"><div class="line_one">&nbsp;</div></div>
      <div style="position:relative;"><div class="line_two">&nbsp;</div></div>
      <div style="position:relative;"><div class="line_three">&nbsp;</div></div>
      <div style="position:relative;"><div class="line_four">&nbsp;</div></div>
      <div style="position:relative;"><div class="line_five">&nbsp;</div></div>
      
      <div style="position:relative;"><div class="line_six">&nbsp;</div></div>
      <div style="position:relative;"><div class="line_seven">&nbsp;</div></div>
      <div style="position:relative;"><div class="line_eight">&nbsp;</div></div>
      <div style="position:relative;"><div class="line_nine">&nbsp;</div></div>
      <div style="position:relative;"><div class="line_ten">&nbsp;</div></div>
      	
    
      <div class="top_node"><?=$tree['top_img']?> <p><?=$tree['top_nm']?></p></div>
      <div class="node_line"></div>
      <div class="node_one node">
      		<?=$tree['node1_img']?>
             <p><?=$tree['node1_nm']?></p>
       </div>
      <div class="node_two node">
      		<?=$tree['node2_img']?>
              <p><?=$tree['node2_nm']?></p>
       </div>
      <div class="node_three node">
      		<?=$tree['node3_img']?>
              <p><?=$tree['node3_nm']?></p>
       </div>
      <div class="node_four node">
      		<?=$tree['node4_img']?>
              <p><?=$tree['node4_nm']?></p>
       </div>
      <div class="node_five node">
      		<?=$tree['node5_img']?>
              <p><?=$tree['node5_nm']?></p>
       </div>
       <div class="node_six node">
      		<?=$tree['node6_img']?>
             <p><?=$tree['node6_nm']?></p>
       </div>
      <div class="node_seven node">
      		<?=$tree['node7_img']?>
              <p><?=$tree['node7_nm']?></p>
       </div>
      <div class="node_eight node">
      		<?=$tree['node8_img']?>
              <p><?=$tree['node8_nm']?></p>
       </div>
      <div class="node_nine node">
      		<?=$tree['node9_img']?>
              <p><?=$tree['node9_nm']?></p>
       </div>
      <div class="node_ten node">
      		<?=$tree['node10_img']?>
              <p><?=$tree['node10_nm']?></p>
       </div>
      <div style="clear:both;overflow:hidden;"></div>
      
    </div>
  </div>
</div>



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
				</div><!-- span6 -->
  </div><!-- row-fluid -->

  <div class="row-fluid">
		<div class="span1"><label class="control-label">Select Date</label></div>
		<div class="span3">
	    	<div class="controls">
	    		<div id="daily_date" class="input-append">
	    			<input data-format="dd-MM-yyyy" type="text" name="daily_date" id="date_level" value="" class="{validate:{required:true}}" >
	    				<span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
	    		</div>
	    	</div>
		</div>
		<div class="span2">
			<input type="button" value="Refresh" class="btn btn-info" style="float: left;" onclick="change_lavel_summary()">
		</div>
	</div>
  
   <div class="row-fluid level_summary">
   
   </div>
<style>
		.tree{
		width:1000px;
		margin:auto;
	}
		.node{
		float:left;
		width:99px;
		position:relative;
		z-index:9999;
	
		text-align:center;
	}
	.top_node{
		text-align:center;
	}
	.node_line{
		border-top:#000 solid 1px;
		width:975px;
		margin:50px auto;
		
	}
	.top_line{
		position:absolute;
		left: 495px;
		top: 50px;
		height: 41px;
		width:2px;
		border-left:#000 solid 1px;
	}
	.line_one{
		position:absolute;
		left: 48px;
		top: 92px;
		height:50px;
		width:2px;
		border-left:#000 solid 1px;
	}
	.line_two{
		position:absolute;
		left: 148px;
		top: 92px;
		height:50px;
		width:2px;
		border-left:#000 solid 1px;
	}
	.line_three{
		position:absolute;
		left: 247px;
		top: 92px;
		height:50px;
		width:2px;
		border-left:#000 solid 1px;
	}
	.line_four{
		position:absolute;
		left: 345px;
		top: 92px;
		height:50px;
		width:2px;
		border-left:#000 solid 1px;
	}
	.line_five{
		position:absolute;
		left: 445px;
		top: 92px;
		height:50px;
		width:2px;
		border-left:#000 solid 1px;
	}
	.line_six{
		position:absolute;
		right: 453px;
		top: 92px;
		height:50px;
		width:2px;
		border-left:#000 solid 1px;
	}
	.line_seven{
		position:absolute;
		right: 355px;
		top: 92px;
		height:50px;
		width:2px;
		border-left:#000 solid 1px;
	}
	.line_eight{
		position:absolute;
		right: 255px;
		top: 92px;
		height:50px;
		width:2px;
		border-left:#000 solid 1px;
	}
	.line_nine{
		position:absolute;
		right: 157px;
		top: 92px;
		height:50px;
		width:2px;
		border-left:#000 solid 1px;
	}
	.line_ten{
		position:absolute;
		right: 57px;
		top: 92px;
		height:50px;
		width:2px;
		border-left:#000 solid 1px;
	}

	.bootstrap-datetimepicker-widget.dropdown-menu{
		background-color: #fff !important;
	}
</style>
