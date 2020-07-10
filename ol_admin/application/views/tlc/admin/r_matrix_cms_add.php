<?php
	$option=explode('|',$result[0]['option']);
	
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
      <h3 class="page-header">R-Matrix
        
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">R-Matrix</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">CMS</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <form class="form-horizontal left-align" id="form2" method="post" action="<?=MATRIX_BASE?>/r_matrix_cms/insertrecord" enctype="multipart/form-data">
      <input type="hidden" name="mode" id="mode" value="<?=$this->uri->segment(3)?>" />
      <input type="hidden" name="eid" id="eid" 	 value="<?=$result[0]['cms_pages_code']?>" />
       <input type="hidden" name="page_type" id="page_type" 	 value="<?=$result[0]['page_type']?>" />
      <!------------------>
      
      <div class="control-group">
        <label class="control-label">Page Name-1</label>
        <div class="controls">
          <input  value="<?=$result[0]['pagename']?>" type="text" class="span12" readonly/>
        </div>
      </div>
      <!-------------------> 
      <!------------------>
      <?php	if(in_array('title',$option)){  ?>
      <div class="control-group">
        <label class="control-label">Page Title</label>
        <div class="controls">
          <input id="title" name="title" value="<?=$result[0]['title']?>" type="text" class="span12 {validate:{required:true}}" placeholder="Title"/>
        </div>
      </div>
      <?php } ?>
      <?php	if(in_array('video_url',$option)){  ?>
      			<?php	if(in_array('multi_v',$option)){  ?>
                            <div class="control-group">
                            <label class="control-label">Enter Video <br />(Multi Video Link)</label>
                            <div class="controls">
                            <input id="video_url" name="video_url" value="<?=$result[0]['video_url']?>" type="text" class="span12" placeholder="url One || url tow || url three"/>
                            <p><strong>You Can Insert Multi video Url Seprated By ( <span style="color:#F00;">||</span> ) double pipe sign</strong></p>
                            </div>
                            </div>
                <?php } else {?>
                            <div class="control-group">
                            <label class="control-label">Enter Video URL Mp4/Youtube</label>
                            <div class="controls">
                            <input id="video_url" name="video_url" value="<?=$result[0]['video_url']?>" type="text" class="span12 {validate:{url:true}}" placeholder="Enter Video URL Mp4/Youtube"/>
                            </div>
                            </div>
              <?php } ?>
           
      <?php } ?>
      
      <?php if (in_array("bg_video", $option)){?>
               <div class="control-group">
                <label class="control-label">Youtube Background Video</label>
                <div class="controls">
                  <input id="video_url" name="video_url" value="<?=$result[0]['video_url']?>"type="text" class="span12 {validate:{url:true}}" placeholder="Enter Video URL Youtube"/>
                  </div>
              </div>
      <?php } ?>
      <?php if (in_array("bg_img", $option)){?>
               <div class="control-group">
                <label class="control-label">Background Image</label>
                <div class="controls">
                  <input id="bg_img_url" name="bg_img_url" value="<?=$result[0]['bg_img_url']?>"type="text" class="span12 {validate:{url:true}}" placeholder="Enter Video URL Youtube"/>
                  </div>
              </div>
      <?php } ?>
      <?php if(in_array('textdt',$option)){  ?>
      <div class="control-group">
        <label class="control-label">
          <?=$result[0]['title_lable']?>
        </label>
        <div class="controls">
          <textarea id="textdt" name="textdt" class="span12"><?=$result[0]['textdt']?>
</textarea>
          <?php
			  	
              	if(in_array('ckediter',$option)){  ?>
          <script type="text/javascript">
    				CKEDITOR.replace( 'textdt',
					{
						
					});
				</script>
          <?php	}  ?>
        </div>
      </div>
      <?php } ?>
      
       <?php if(in_array('ckediter2',$option)){  ?>
      <div class="control-group">
        <label class="control-label">
         Content Area 1
        </label>
        <div class="controls">
          <textarea id="textdt2" name="textdt2" class="span12"><?=$result[0]['textdt2']?></textarea>
                 <script type="text/javascript"> CKEDITOR.replace( 'textdt2',{});</script>
        </div>
      </div>
      <?php } ?>
      
       <?php if(in_array('ckediter3',$option)){  ?>
      <div class="control-group">
        <label class="control-label">
         Content Area 2
        </label>
        <div class="controls">
          <textarea id="textdt3" name="textdt3" class="span12"><?=$result[0]['textdt3']?></textarea>
                 <script type="text/javascript"> CKEDITOR.replace( 'textdt3',{});</script>
        </div>
      </div>
      <?php } ?>
      
       <?php if(in_array('ckediter4',$option)){  ?>
      <div class="control-group">
        <label class="control-label">
         Content Area 3
        </label>
        <div class="controls">
          <textarea id="textdt4" name="textdt4" class="span12"><?=$result[0]['textdt4']?></textarea>
                 <script type="text/javascript"> CKEDITOR.replace( 'textdt4',{});</script>
        </div>
      </div>
      <?php } ?>
      
      
      <!------------------->
      <div class="form-actions">
        <button type="submit" class="btn btn-primary btnsubmit">Update</button>
        <a href="<?php echo base_url();?>index.php/r_matrix/dashboard"><button type="button" class="btn">Cancel</button></a> 
        </div>
    </form>
  </div>
</div>
