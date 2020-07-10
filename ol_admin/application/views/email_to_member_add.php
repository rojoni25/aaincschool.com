
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
      <h3 class="page-header">Email To Member
        <?=$this->uri->segment(3)?>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Capture Pages</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Email To Member</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/send_email_member" enctype="multipart/form-data">
      <input type="hidden" name="mode" id="mode" value="<?=$this->uri->segment(3)?>" />
      <input type="hidden" name="eid" id="eid" value="<?=$result[0]['usercode']?>" />
      
      <!------------------>
      
      <div class="control-group">
        <label class="control-label">Email</label>
        <div class="controls">
          <input  value="<?=$result[0]['emailid']?>" type="text" class="span12" name="emailto" readonly/>
        </div>
      </div>
      <!-------------------> 
      <!------------------>
    
      <div class="control-group">
        <label class="control-label">Email Subject</label>
        <div class="controls">
          <input id="email_subject" name="email_subject" value="<?=$result[0]['email_subject']?>" type="text" class="span12 {validate:{required:true}}" placeholder="Title"/>
        </div>
      </div>
     
     
      
      <div class="control-group">
        <label class="control-label">
          <?=$result[0]['title_lable']?>
        </label>
        <div class="controls">
          <textarea id="textdt" name="textdt" class="span12"><?=$result[0]['email_text']?></textarea>  
          
        <script type="text/javascript">
    				CKEDITOR.replace( 'textdt',
					{
						toolbar :
						[
							{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','FontSize' ] }
						],
						removePlugins: 'resize',
						
						
        				
					});
				</script> 
        </div>
      </div>
    
      <!------------------->
      <div class="form-actions">
        <button type="submit" class="btn btn-primary btnsubmit">Update</button>
        <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">
        <button type="button" class="btn">Cancel</button>
        </a> </div>
    </form>
  </div>
</div>
