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
      <h3 class="page-header">Dreem Student CMS
        
	      <span class="pull-right"><a href="<?=base_url()?>index.php/dreem_student/ad_dashboard/"><button class="btn btn-round-min" type="button"><span><i class="icon-home"></i></span></button></a></span>
       
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Dreem Student</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">CMS Pages</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/dreem_student/<?=$this->uri->rsegment(1)?>/insertrecord" enctype="multipart/form-data">
    
      <input type="hidden" name="eid" id="eid" 	 value="<?=$result[0]['cms_pages_code']?>" />
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
          <input id="title" name="title" value="<?=$result[0]['title']?>" type="text" class="span12 {validate:{required:true}}" placeholder="Title"/>
        </div>
      </div>
    
    
      			
        <div class="control-group">
        <label class="control-label">Enter Video URL Mp4/Youtube</label>
        <div class="controls">
        <input id="video_url" name="video_url" value="<?=$result[0]['video_url']?>" type="text" class="span12 {validate:{url:true}}" placeholder="Enter Video URL Mp4/Youtube"/>
        </div>
        </div>
              
           
    
      
     
     
      
      <div class="control-group">
        <label class="control-label">
          <?=$result[0]['title_lable']?>
        </label>
        <div class="controls">
          <textarea id="textdt" name="textdt" class="span12"><?=$result[0]['textdt']?></textarea>
          
    	
          <script type="text/javascript">CKEDITOR.replace( 'textdt',{});</script>
         
        </div>
      </div>
     
      
      
      
      
      
      
      
      
      <!------------------->
      <div class="form-actions">
        <button type="submit" class="btn btn-primary btnsubmit">Update</button>
        </div>
    </form>
  </div>
</div>
