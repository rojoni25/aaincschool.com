<?php
	if($seg_value['mode']=='Add'){
		$btntest='Add Blog';	
	}else{
		$btntest='Update';
	}
?>

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<script src="<?php echo base_url();?>/ckeditor/ckeditor.js"></script> 
<script>
	$(function () {
                var validator = $("#form2").validate({
                    meta: "validate"
                });
				$(".btnsubmit").click(function () {
                     var validator = $("#form2").validate({
                    	meta: "validate"
                	});
                });
                $(".cancel").click(function () {
                    validator.resetForm();
                });
            });
</script>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">My Blog
        <?=$this->uri->segment(3)?>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">AMS</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">My Blog</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insert_blog" enctype="multipart/form-data">
      <input type="hidden" name="mode" id="mode" value="<?=$seg_value['mode']?>" />
      <input type="hidden" name="eid" id="eid" 	 value="<?=$seg_value['eid']?>" />
      
      <!------------------>
      
      <div class="control-group">
        <label class="control-label">Page Name</label>
        <div class="controls">
          <input name="title" id="title" value="<?=$result[0]['title']?>" type="text" class="span12" required="required"/>
        </div>
      </div>
      <!-------------------> 
      <div class="control-group">
        <label class="control-label">
         	description
        </label>
        <div class="controls">
          <textarea id="description" name="description" class="span12"><?=$result[0]['description']?></textarea>
                 <script type="text/javascript"> CKEDITOR.replace( 'description',{});</script>
        </div>
      </div>
   
    	
        <div class="control-group">
        <label class="control-label">Status</label>
        <div class="controls">
          	<select id="status" name="status">
            	<option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>
      </div>  
    
      
      
      <!------------------->
      <div class="form-actions">
        <button type="submit" class="btn btn-primary btnsubmit"><?=$btntest?></button>
        <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">
        <button type="button" class="btn">Cancel</button>
        </a> </div>
    </form>
  </div>
</div>
