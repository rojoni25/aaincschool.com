<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
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
          <h3 class="page-header">Company Secret Page
            <?=$this->uri->segment(3)?>
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Pages</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Company Secret Page</li>
        </ul>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
       		<input type="hidden" name="mode" id="mode" value="<?=$this->uri->segment(3)?>" />
        	<input type="hidden" name="eid" id="eid" 	 value="<?=$this->uri->segment(4)?>" />
          <div class="control-group">
            <label class="control-label">Page Name</label>
            <div class="controls">
              <input id="page_name" name="page_name" value="<?=$result[0]['page_name']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Enter Page Name"/>
            </div>
          </div>
          <!------------------>
          <div class="control-group">
            <label class="control-label">Page Title</label>
            <div class="controls">
              <input id="page_title" name="page_title" value="<?=$result[0]['page_title']?>" type="text" class="span12 {validate:{required:true}}" placeholder="Enter Page Title"/>
            </div>
          </div>
          <!------------------->
          
          <!------------------>
          <div class="control-group">
            <label class="control-label">Video Url</label>
            <div class="controls">
              <input id="video_link" name="video_link" value="<?=$result[0]['video_link']?>" type="text" class="span12" placeholder="Enter Video Link"/>
            </div>
          </div>
          <!------------------->
          
          <!------------------>
          <div class="control-group">
            <label class="control-label">Page Secret Key</label>
            <div class="controls">
              <input id="page_key" name="page_key" value="<?=$result[0]['page_key']?>" type="text" class="span12 {validate:{required:true}}" placeholder="Enter page Key"/>
            </div>
          </div>
          <!------------------->
          
            <!------------------>
          <div class="control-group">
           
              
               <textarea id="contain" name="contain" class="span12"><?=$result[0]['contain']?></textarea>
               
          		<script type="text/javascript">
    				CKEDITOR.replace('contain',
					{
						
					});
				</script>
              
          
          </div>
          <!------------------->
           
          <!------------------->
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Update</button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
          </div>
        </form>
      </div>
    </div>

