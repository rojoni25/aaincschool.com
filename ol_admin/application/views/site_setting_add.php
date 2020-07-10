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
          <h3 class="page-header">Site Setting
            <?=$this->uri->segment(3)?>
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">System</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Site Setting</li>
        </ul>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
       		<input type="hidden" name="mode" id="mode" value="Edit" />
        	<input type="hidden" name="eid" id="eid" 	 value="<?=$this->uri->segment(4)?>" />
          <div class="control-group">
            <label class="control-label">Name</label>
            <div class="controls">
             <input type="text" readonly value="<?=$result[0]['settint_label']?>" class="span10" style="cursor:not-allowed;">
            </div>
          </div>
          
          <?php if(in_array($result[0]['lable_acces_nm'], array('scroll_mem_back', 'scroll_home'))){ $val = intval($result[0]['setting_value']); ?>
            <div class="control-group">
              <label class="control-label">Value</label>
              <div class="controls">
                <select id="setting_value" name="setting_value" class="span12">
                  <option value="1" <?php echo $val==1?'selected="selected"':''; ?>>Show</option>
                  <option value="0" <?php echo $val==0?'selected="selected"':''; ?>>Hide</option>
                </select>
              </div>
            </div>
          <?php } else{ ?>
          <div class="control-group">
            <label class="control-label">Value</label>
            <div class="controls">
              <input id="setting_value" name="setting_value" value="<?=$result[0]['setting_value']?>" type="text" class="span12 {validate:{required:true,number:true}}" placeholder="+91"/>
            </div>
          </div>
          <?php } ?>
          
          
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Update</button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
          </div>
        </form>
      </div>
    </div>

