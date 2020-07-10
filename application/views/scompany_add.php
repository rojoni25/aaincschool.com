<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
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
          <h3 class="page-header">Company Secret Page</h3>
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
    		<input type="hidden" name="page_key" id="page_key" 	 value="<?=$result[0]['page_key']?>" />
          	<input type="hidden" name="eid" id="eid"  value="<?=$result[0]['secret_page_code']?>" />
          <div class="control-group">
            <label class="control-label">Page Name</label>
            <div class="controls">
              <input  value="<?=$result[0]['page_name']?>" class="span12" type="text" readonly="readonly"/>
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
            <button type="submit" class="btn btn-primary btnsubmit">Save Change</button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/show/<?=$result[0]['page_key']?>"><button type="button" class="btn">Cancel</button></a>
          </div>
        </form>
      </div>
    </div>

