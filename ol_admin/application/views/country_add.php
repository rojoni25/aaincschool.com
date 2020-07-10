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
          <h3 class="page-header">Country
            <?=$this->uri->segment(3)?>
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Master</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Country</li>
        </ul>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
       		<input type="hidden" name="mode" id="mode" value="<?=$this->uri->segment(3)?>" />
        	<input type="hidden" name="eid" id="eid" 	 value="<?=$this->uri->segment(4)?>" />
          <div class="control-group">
            <label class="control-label">Country Name</label>
            <div class="controls">
              <input id="firstname" name="country_name" value="<?=$result[0]['country_name']?>" class="span12 {validate:{required:true}}" type="text" placeholder="Country Name"/>
            </div>
          </div>
          <!------------------>
          <div class="control-group">
            <label class="control-label">Country Phone Code</label>
            <div class="controls">
              <input id="lastname" name="country_pri_code" value="<?=$result[0]['country_pri_code']?>" type="text" class="span12 {validate:{required:true}}" placeholder="+91"/>
            </div>
          </div>
          <!------------------->
            <div class="control-group">
            <label class="control-label">Country Flag</label>
            <div class="controls">
              	<input type="file" name="post_img" id="post_img" class="span12" value=""/>
            </div>
          </div>
          <!------------------->
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Update</button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
          </div>
        </form>
      </div>
    </div>

