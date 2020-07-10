
<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<script src="<?php echo base_url();?>/ckeditor/ckeditor.js"></script>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Custom Page CMS
      
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">CMS</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Custom Page CMS</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/custom_page_insert" enctype="multipart/form-data">
    
      <input type="hidden" name="eid" id="eid" 	 value="<?=$result[0]['pagecode']?>" />
     
      <!------------------>
      
      <div class="control-group">
        <label class="control-label">Page Name</label>
        <div class="controls">
          <input  value="<?=$result[0]['pagename']?>" type="text" class="span12" readonly/>
        </div>
      </div>
      <!-------------------> 
      <!------------------>
      
      <div class="control-group">
        <label class="control-label">Page Title</label>
        <div class="controls">
          <input id="title" name="title" value="<?=$result[0]['title']?>" type="text" class="span12" required="required" placeholder="Title"/>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">Enter Video URL Mp4/Youtube</label>
        <div class="controls">
          <input id="video_url" name="video_url" value="<?=$result[0]['video_url']?>" type="text" class="span12 {validate:{url:true}}" placeholder="Enter Video URL Mp4/Youtube"/>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label">Page Contain</label>
        <div class="controls">
          <textarea id="textdt" name="textdt" class="span12"><?=$result[0]['textdt']?>
</textarea>
          <script type="text/javascript">
    				CKEDITOR.replace( 'textdt',
					{
						
					});
				</script> 
        </div>
      </div>
      
      
       <div class="control-group">
        <label class="control-label">Not Permission Page</label>
        <div class="controls">
          <textarea id="textdt2" name="textdt2" class="span12"><?=$result[0]['textdt2']?>
</textarea>
          <script type="text/javascript">
    				CKEDITOR.replace( 'textdt2',
					{
						
					});
				</script> 
        </div>
      </div>
      
      <!------------------->
      <div class="form-actions">
        <button type="submit" class="btn btn-primary btnsubmit">Update</button>
        <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/custom_page">
        <button type="button" class="btn">Cancel</button>
        </a> </div>
    </form>
  </div>
</div>
