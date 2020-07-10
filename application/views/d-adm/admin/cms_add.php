<?php
	if($segment_set['mode']=='Edit'){
		$btntext='Update';
	}else{
		$btntext='Insert';
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
      <h3 class="page-header">
        <?=MATRIX_LLB?>
        CMS </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">
        <?=MATRIX_LLB?>
        </a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">CMS</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <form class="form-horizontal left-align" id="form2" method="post" action="<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/insert" enctype="multipart/form-data">
      <input type="hidden" name="mode" id="mode" value="<?=$segment_set['mode']?>" />
      <input type="hidden" name="eid" id="eid" 	 value="<?=$segment_set['eid']?>" />
     
      <div class="control-group">
        <label class="control-label">Page Name</label>
        <div class="controls">
          <input  value="<?=$result[0]['page_name']?>" type="text"  readonly="readonly"/>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label">Page Title <span class="req">*</span></label>
        <div class="controls">
          <input id="page_title" name="page_title" value="<?=$result[0]['page_title']?>" type="text" required="required" class="span12 {validate:{required:true}}" placeholder="Page Title"/>
        </div>
      </div>
      
      
      
       <div class="control-group">
        <label class="control-label">Video Url</label>
        <div class="controls">
          <input id="video_url" name="video_url" value="<?=$result[0]['video_url']?>" type="text"  class="span12" placeholder="Video Url"/>
        </div>
      </div>
      
      
      
      
      
      
      <div class="control-group">
        <label class="control-label"> Description <span class="req">*</span></label>
        <div class="controls">
          <textarea id="description" name="description" class="span12"><?=$result[0]['description']?>
</textarea>
          <script type="text/javascript">
    				CKEDITOR.replace( 'description',{});
				</script> 
        </div>
      </div>
      
      
      
      
      
      
      
      
      <!------------------->
      <div class="form-actions">
        <button type="submit" class="btn btn-primary btnsubmit">
        <?=$btntext?>
        </button>
        <a href="<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/view">
        <button type="button" class="btn">Cancel</button>
        </a> </div>
    </form>
  </div>
</div>

<style>
	.req{
		color:#F00;
	}
</style>


