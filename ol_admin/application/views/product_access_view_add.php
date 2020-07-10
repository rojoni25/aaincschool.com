
<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<script>
	$(function () {
                var validator = $("#form2").validate({
                    meta: "validate"
                });
				$(".btnsubmit").click(function () {
					
					if($('#user_code').val()==''){ alert('Select Member'); return false; }
					
					var con=confirm(''+$( "#membername" ).val()+'" Get Permition to Access Product ?');
					if(!con){
						return false;
					}
                     var validator = $("#form2").validate({
                    	meta: "validate"
                	});
                });
                $(".cancel").click(function () {
                    validator.resetForm();
                });
            });
</script>

<script>
	$(document).ready(function(e) {
        $("#membername").autocomplete({
                        source:'<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/auto_camplate',
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
    });
</script>


    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Product Access List
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Master</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Product Access List</li>
        </ul>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
            <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/product_access_insert" enctype="multipart/form-data">
                <input type="hidden" name="mode" id="mode" value="<?=$this->uri->segment(3)?>" />
                <input type="hidden" name="eid" id="eid" 	 value="<?=$this->uri->segment(4)?>" />
                <div class="control-group">
                	<label class="control-label">Search Member</label>
                	<div class="controls">
                        <input type="text" id="membername" name="membername" value="" placeholder="Search Member" />
                        <input type="hidden" id="user_code" name="user_code" />
                	</div>
                </div>
            <!------------------>
            <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Add</button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
            </div>
            </form>
      </div>
    </div>
    
    <div class="row-fluid">
      <div class="span12">
      	<table class="stat-table table table-stats table-striped table-sortable table-bordered">
        	<tr>
            	<td>Usercode</td>
                <td>Name</td>
                <td>Opration</td>
            </tr>
            <tbody>
            	<tr>
                	<?php for($i=0;$i<count($member);$i++){
						echo '<tr>
            					<td>'.$member[$i]['usercode'].'</td>
                				<td>'.$member[$i]['fname'].' '.$member[$i]['lname'].'</td>
                				<td><a href="'.base_url().'index.php/'.$this->uri->segment(1).'/delete_permition/'.$member[$i]['idcode'].'">Delete</a></td>
            				 </tr>';
					}?>
                </tr>
            </tbody>
        </table>
        </div>
    </div>

