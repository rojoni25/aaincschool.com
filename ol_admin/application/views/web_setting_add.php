<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
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
          <h3 class="page-header">Web Setting
            <?=$this->uri->segment(3)?>
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">System</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Web Setting</li>
        </ul>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
          <!------------------>
          <div class="control-group">
            <label class="control-label">Company Name</label>
            <div class="controls">
              <input id="comanyname" name="comanyname" value="<?=getconfigMeta('comanyname')?>" class="span12 {validate:{required:true}}" type="text" placeholder="Company Name"/>
            </div>
          </div>
          <!------------------>
          <!------------------>
          <div class="control-group">
            <label class="control-label">Company Short Name</label>
            <div class="controls">
              <input id="comanyshortname" name="comanyshortname" value="<?=getconfigMeta('comanyshortname')?>" class="span12" type="text" placeholder="Company Short Name"/>
            </div>
          </div>
          <!------------------>
          <!------------------>
          <div class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
              <input id="email_id" name="email_id" value="<?=getconfigMeta('email')?>" class="span12 {validate:{required:true}}" type="text" placeholder="Email Id"/>
            </div>
          </div>
          <!------------------>
          <!------------------>
          <div class="control-group">
            <label class="control-label">Phone</label>
            <div class="controls">
              <input id="phone_no" name="phone_no" value="<?=getconfigMeta('phone')?>" class="span12 {validate:{required:true}}" type="text" placeholder="Phone"/>
            </div>
          </div>
          <!------------------>
            <!------------------>
          <div class="control-group">
            <label class="control-label">Skype</label>
            <div class="controls">
              <input id="skype" name="skype" value="<?=getconfigMeta('skype')?>" class="span12" type="text" placeholder="Skype"/>
            </div>
          </div>
          <!------------------>
          <!------------------>
          <div class="control-group">
            <label class="control-label">Facebook</label>
            <div class="controls">
              <input id="facebook_link" name="facebook_link" value="<?=getconfigMeta('facebook_link')?>" class="span12" type="text" placeholder="Facebook"/>
            </div>
          </div>
          <!------------------>
          <!------------------>
          <div class="control-group">
            <label class="control-label">Instagram</label>
            <div class="controls">
              <input id="instagram_link" name="instagram_link" value="<?=getconfigMeta('instagram_link')?>" class="span12" type="text" placeholder="Instagram"/>
            </div>
          </div>
          <!------------------>
           <!------------------>
          <div class="control-group">
            <label class="control-label">Youtube</label>
            <div class="controls">
              <input id="youtube_link" name="youtube_link" value="<?=getconfigMeta('youtube_link')?>" class="span12" type="text" placeholder="Youtube Link"/>
            </div>
          </div>
          <!------------------>
           <!------------------>
          <div class="control-group">
            <label class="control-label">Google+</label>
            <div class="controls">
              <input id="googleplus_link" name="googleplus_link" value="<?=getconfigMeta('googleplus_link')?>" class="span12" type="text" placeholder="Google Plus"/>
            </div>
          </div>
          <!------------------>
           <!------------------>
          <div class="control-group">
            <label class="control-label">Twitter</label>
            <div class="controls">
              <input id="twitter_link" name="twitter_link" value="<?=getconfigMeta('twitter_link')?>" class="span12" type="text" placeholder="Twitter Id"/>
            </div>
          </div>
          <!------------------>
           <!------------------>
          <div class="control-group">
            <label class="control-label">Linkedin</label>
            <div class="controls">
              <input id="linkedin_link" name="linkedin_link" value="<?=getconfigMeta('linkedin_link')?>" class="span12" type="text" placeholder="Linkedin"/>
            </div>
          </div>
          <!------------------>

          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Update</button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
          </div>
        </form>
      </div>
    </div>

