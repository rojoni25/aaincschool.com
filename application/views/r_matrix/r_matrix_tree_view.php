<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<?=kdk_admin_menu();?>

<link href="<?=base_url();?>asset/tooltip/tooltip.css" rel="stylesheet">
<script src="<?php echo base_url();?>asset/tooltip/tooltip.js"></script>
<link href="<?=base_url();?>asset/tree/treecss.css" rel="stylesheet">
<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url()?>asset/popover/jquery.webui-popover.min.css">
<script src="<?=base_url()?>asset/popover/jquery.webui-popover.min.js"></script> 
<script>
	$(document).ready(function(e) {
		
     
		
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
		
		$(document).on('change','#multi_position',function(e){
			var value	=	$(this).val();
			window.location.href='<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/view/'+value;
		});
		
		$(document).on('click', '.clsmemdt', function (e) {
				
				e.preventDefault();
				
				var value 		= $(this).attr('value');
				
				var url='<?php echo base_url()?>index.php/comman_controler/get_memberdt_by_id/'+value+'/3';
			
				$.ajax({url:url,success:function(result){
					
					$('.tblmemberdt').html(result);
				
				}});
		});
		
		
		
		
		
		//////////
	   $("#membername").autocomplete({
                        source:'<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1)?>/auto_camplate',
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
      <h3 class="page-header">Tree 2 x 3 </h3>
    </div>
    <div class="pull-left">
      <input type="text" id="membername" value="" placeholder="Search Member" />
      <input type="hidden" id="user_code" />
      <button type="button" class="btn btn-info btngoto" style="margin-top:-11px;">Go</button>
    </div>
    <div class="pull-right">
      <?php if(count($position)>1) {?>
      <select id="multi_position">
        <?php for($i=0;$i<count($position);$i++){
		   		$pos=$i+1;
				$sel=($position[$i]['idcode']==$this->uri->segment(3)) ? "selected='selected'" : "";
       			echo '<option '.$sel.' value="'.$position[$i]['idcode'].'">Position :'.$pos.'</option>';
        	} ?>
      </select>
      <?php } ?>
    </div>
    <div style="clear:both;overflow:hidden;"></div>
    <ul class="breadcrumb">
      <?php
			$urltree=base_url().'index.php/'.$this->uri->segment(1).'/tree/';
			
        	for($i=0;$i<count($breadcrumb);$i++){
				
				if($i==count($breadcrumb)-1){
					echo'<li class="active">'.$breadcrumb[$i][0]['name'].'</li>';
				}
				else{
					echo'<li><a href="'.$urltree.''.$breadcrumb[$i][0]['idcode'].'">'.$breadcrumb[$i][0]['name'].'</a><span class="divider "><i class="icon-angle-right"></i></span></li>';
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
    <div class="top" style="text-align:center;"> <img src="<?=base_url();?>asset/images/multitree/admin.png" />
      <p><a class='show-pop-event' href='<?php echo $this->uri->segment(3)?>'>
        <?=$top[0]['name']?>
        </a></p>
    </div>
    <div style="height:30px;"></div>
    <div class="level1">
      <ul class="child1">
        <img class="linehr1" src="<?=base_url();?>asset/images/multitree/44.png" />
        <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" />
          <?=$tree_elements[0]['img']?>
          <p><a class='show-pop-event' href='<?=$tree_elements[0]['idcode']?>'>
            <?=$tree_elements[0]['name']?>
            </a></p>
        </li>
        <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" />
          <?=$tree_elements[1]['img']?>
          <p><a class='show-pop-event' href='<?=$tree_elements[1]['idcode']?>'>
            <?=$tree_elements[1]['name']?>
            </a></p>
        </li>
        <div class="clear"></div>
      </ul>
    </div>
    <div class="clear"></div>
    <div style="height:30px;"></div>
    <div class="level2">
      <ul class="child2">
        <img class="linehr2" src="<?=base_url();?>asset/images/multitree/44.png" />
        <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" />
          <?=$tree_elements[2]['img']?>
          <p><a class='show-pop-event' href='<?=$tree_elements[2]['idcode']?>'>
            <?=$tree_elements[2]['name']?>
            </a></p>
        </li>
        <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" />
          <?=$tree_elements[3]['img']?>
          <p><a class='show-pop-event' href='<?=$tree_elements[3]['idcode']?>'>
            <?=$tree_elements[3]['name']?>
            </a></p>
        </li>
        <div class="clear"></div>
      </ul>
      <ul class="child2">
        <img class="linehr2" src="<?=base_url();?>asset/images/multitree/44.png" />
        <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" />
          <?=$tree_elements[4]['img']?>
          <p><a class='show-pop-event' href='<?=$tree_elements[4]['idcode']?>'>
            <?=$tree_elements[4]['name']?>
            </a></p>
        </li>
        <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" />
          <?=$tree_elements[5]['img']?>
          <p><a class='show-pop-event' href='<?=$tree_elements[5]['idcode']?>'>
            <?=$tree_elements[5]['name']?>
            </a></p>
        </li>
        <div class="clear"></div>
      </ul>
    </div>
    <div class="clear"></div>
    <div style="height:30px;"></div>
    <div class="level3">
      <ul class="child3">
        <img class="linehr2" src="<?=base_url();?>asset/images/multitree/44.png" />
        <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" />
          <?=$tree_elements[6]['img']?>
          <p><a class='show-pop-event' href='<?=$tree_elements[6]['idcode']?>'>
            <?=$tree_elements[6]['name']?>
            </a></p>
        </li>
        <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" />
          <?=$tree_elements[7]['img']?>
          <p><a class='show-pop-event' href='<?=$tree_elements[7]['idcode']?>'>
            <?=$tree_elements[7]['name']?>
            </a></p>
        </li>
        <div class="clear"></div>
      </ul>
      <ul class="child3">
        <img class="linehr2" src="<?=base_url();?>asset/images/multitree/44.png" />
        <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" />
          <?=$tree_elements[8]['img']?>
          <p><a class='show-pop-event' href='<?=$tree_elements[8]['idcode']?>'>
            <?=$tree_elements[8]['name']?>
            </a></p>
        </li>
        <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" />
          <?=$tree_elements[9]['img']?>
          <p><a class='show-pop-event' href='<?=$tree_elements[9]['idcode']?>'>
            <?=$tree_elements[9]['name']?>
            </a></p>
        </li>
        <div class="clear"></div>
      </ul>
      <ul class="child3">
        <img class="linehr2" src="<?=base_url();?>asset/images/multitree/44.png" />
        <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" />
          <?=$tree_elements[10]['img']?>
          <p><a class='show-pop-event' href='<?=$tree_elements[10]['idcode']?>'>
            <?=$tree_elements[10]['name']?>
            </a></p>
        </li>
        <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" />
          <?=$tree_elements[11]['img']?>
          <p><a class='show-pop-event' href='<?=$tree_elements[11]['idcode']?>'>
            <?=$tree_elements[11]['name']?>
            </a></p>
        </li>
        <div class="clear"></div>
      </ul>
      <ul class="child3">
        <img class="linehr2" src="<?=base_url();?>asset/images/multitree/44.png" />
        <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" />
          <?=$tree_elements[12]['img']?>
          <p><a class='show-pop-event' href='<?=$tree_elements[12]['idcode']?>'>
            <?=$tree_elements[12]['name']?>
            </a></p>
        </li>
        <li><img class="line" src="<?=base_url();?>asset/images/multitree/vr_line.jpg" />
          <?=$tree_elements[13]['img']?>
          <p><a class='show-pop-event' href='<?=$tree_elements[13]['idcode']?>'>
            <?=$tree_elements[13]['name']?>
            </a></p>
        </li>
        <div class="clear"></div>
      </ul>
    </div>
    <!-----------------------> 
    
  </div>
  <!----treeinner------> 
</div>
<!----treediv------> 

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head"><h3 class="page-header">Member View Third Level Of His Position</h3></div>
    <table class="table table-striped table-bordered dataTable">
    	<thead>
        	<tr>
            	<th>No.</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
    	<?php for($i=0;$i<count($third_level);$i++){
			$no=$i+1;
        	echo '<tr>
            		<td>'.$no.'</td>
                	<td>'.$third_level[$i]['name'].'</td>
            	</tr>';
         } ?>
        </tbody>
    </table>
  </div>
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
							url:'<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/get_memberdt_by_id/'+value+'',
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
.treeinner {
	width: 960px;
	margin: auto;
}
.treediv {
	width: 100%;
	overflow: auto;
	direction: rtl;
}
.child3 {
	width: 25%;
	list-style: none;
	margin: 0px;
	padding: 0px;
	padding-top: 10px;
	position: relative;
	float: left;
 background-image:url(<?=base_url();
?>asset/images/multitree/120.png);
	background-repeat: no-repeat;
	background-position: 49.2% 0px;
}
.thirdchild {
	margin-right: 20px;
}
.child3 li {
	width: 50%;
	float: left;
	text-align: center;
	position: relative;
}
.child3 li p {
	font-size: 12px;
}
.child3 .line {
	position: absolute;
	top: -9px;
	left: 49%;
}
.child2 {
	width: 50%;
	list-style: none;
	margin: 0px;
	padding: 0px;
	padding-top: 10px;
	position: relative;
	float: left;
 background-image:url(<?=base_url();
?>asset/images/multitree/240.png);
	background-repeat: no-repeat;
	background-position: 50% 0px;
}
.child2 li {
	width: 50%;
	float: left;
	text-align: center;
	position: relative;
}
.child2 li p {
	font-size: 12px;
}
.child2 .line {
	position: absolute;
	top: -9px;
	left: 50%;
}
.clear {
	clear: both;
	overflow: hidden;
}
.child1 {
 background-image:url(<?=base_url();
?>asset/images/multitree/480.png);
	background-repeat: no-repeat;
	background-position: 50% 0px;
	width: 100%;
	list-style: none;
	margin: 0px;
	padding: 0px;
	margin-left: 5px;
	padding-top: 10px;
	position: relative;
}
.child1 li {
	width: 50%;
	float: left;
	text-align: center;
	position: relative;
}
.child1 li p {
	font-size: 12px;
}
.child1 .line {
	position: absolute;
	top: -9px;
	left: 50%;
}
.linehr {
	position: absolute;
	left: 49%;
	top: -39px;
}
.linehr2 {
	position: absolute;
	left: 49.5%;
	top: -45px;
}
.linehr1 {
	position: absolute;
	left: 49.5%;
	top: -45px;
}
.colorcode {
	list-style: none;
	margin: 0px;
}
.colorcode li {
	float: left;
	margin-right: 15px;
}

.show_msg{
	color:#F00;
	text-align:center;
}
</style>
