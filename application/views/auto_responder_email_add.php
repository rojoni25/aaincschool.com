
<div class="row">
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
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
  <ul>
    <li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
    <li class="active-bre"><a href="#"> Email</a> </li>
    <li class="active-bre"><a href="#"> Auto Responder Email</a> </li>
    
  </ul>
</div>
<div class="tz-2 tz-2-admin">
    <div class="tz-2-com tz-2-main">
      <h4>Auto Responder Email</h4>
      <!------------>
      <br>
      <div class="hom-cre-acc-left hom-cre-acc-right">
        <div class="col-md-12">
          <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
            <input type="hidden" name="mode" id="mode" value="<?=$this->uri->segment(3)?>" />
            <input type="hidden" name="eid" id="eid" 	 value="<?=$result[0]['email_code']?>" />
            
            <!------------------>
            
            <div class="control-group">
              <label class="control-label">Email Type</label>
              <div class="controls">
                <input  value="<?=$result[0]['dispaly_name']?>" type="text" class="span12" readonly="readonly"/>
              </div>
            </div>
            <!-------------------> 
            <!------------------>
          
            <div class="control-group">
              <label class="control-label">Email Subject</label>
              <div class="controls">
                <input id="email_subject" name="email_subject" value="<?=$result[0]['subject']?>" type="text" class="span12 {validate:{required:true}}" placeholder="Email Subject"/>
              </div>
            </div>
            
             
           
           
            
            <div class="control-group">
              <label class="control-label">
                <?=$result[0]['title_lable']?>
              </label>
              <div class="controls">
                <textarea id="textdt" name="textdt" class="span12"><?=$result[0]['email_html']?></textarea>  
                <script type="text/javascript">
      					 CKEDITOR.env.isCompatible = true;
          				 CKEDITOR.replace( 'textdt' ); 
      		 </script>
              
              </div>
            </div>
            
            
            <div class="control-group">
              <label class="control-label">Admin Contain</label>
              <div class="controls">
               <p><?=$result[0]['admin_contain']?></p>
              </div>
            </div>
          
           
            <div class="form-actions">
              <button type="submit" class="btn btn-primary btnsubmit">Update</button>
              <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">
              <button type="button" class="btn">Cancel</button>
              </a> </div>
          </form>
        </div>
      </div>
  </div>
</div>