<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<script>
	$(document).ready(function(e) {
		/////////////////
		$("#membername").autocomplete({
                        source:'<?php echo base_url();?>index.php/comman_controler/auto_camplate_active',
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
	   
	   	$(document).on('click', '.btn-confirm', function (e) {
			var con=confirm('Are You Sure Remove From Paid  ?');   
			if(!con){
				return false;
			}
		});
	});
	
</script>
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Paid Member To Unpaid
            <?=$this->uri->segment(3)?>
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">System</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Paid Member To Unpaid</li>
        </ul>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span6">
        <?php if(isset($result[0])) {?>
        		<form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/remove_to_paid">
                	<input type="hidden" value="<?=$result[0]['usercode']?>" name="usercode" id="usercode" />
         		<table class="table">
                	<tr>
                    	<td width="30%">Member Name</td>
                        <td width="1%">:</td>
                        <td width="69%"><?=$result[0]['fname']?> <?=$result[0]['lname']?></td>
                    </tr>
                    <tr>
                    	<td>Usercode</td>
                        <td>:</td>
                        <td><?=$result[0]['usercode']?></td>
                    </tr>
                    <tr>
                    	<td>Username</td>
                        <td>:</td>
                        <td><?=$result[0]['username']?></td>
                    </tr>
                     <tr>
                    	<td>Status</td>
                        <td>:</td>
                        <td><?=$result[0]['status']?></td>
                    </tr>
                </table>
                <?php if(isset($child[0])){
						echo '<strong>'.$result[0]['fname'].' '.$result[0]['lname'].'</strong> Not Remove From Paid ';
				 }else{
					echo '<div class="form-actions"><button type="submit" class="btn btn-primary btnsubmit btn-confirm">Remove From Paid</button></div>';
				 }?>
        	</form>
        <?php }else {?>
                    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>" enctype="multipart/form-data">
                        <div class="control-group">
                        	<label class="control-label">Search Member</label>
                        	<div class="controls">
                       	 		<input type="text" id="membername" value="" placeholder="Member Name, Code" class=" span12 {validate:{required:true}}" />
                        		<input type="hidden" id="user_code" name="user_code" />
                        	</div>
                        </div>
                        <!------------------>
                        <div class="form-actions">
                        <button type="submit" class="btn btn-primary btnsubmit">Check</button>
                        </div>
                    </form>
        <?php } ?>
      </div>
      
    </div>

