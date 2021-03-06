<?php
	if($segment_set['mode']=='Edit'){
		$btntext='Update';
	}else{
		$btntext='Insert';
	}
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
      <h3 class="page-header">
        <?=MATRIX_LLB?>
         Product 
         	
            <span class="pull-right">
        	<a href="<?=MATRIX_BASE?>ad_dashboard/dashboard" class="back_btn"><span class="label label-success">Dashboard</span></a>
        </span>	
            
         </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">
        <?=MATRIX_LLB?>
        </a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Product Pages</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <form class="form-horizontal left-align" id="form2" method="post" action="<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/insert" enctype="multipart/form-data">
      <input type="hidden" name="mode" id="mode" value="<?=$segment_set['mode']?>" />
      <input type="hidden" name="eid" id="eid" 	 value="<?=$segment_set['eid']?>" />
     
      
      <div class="control-group">
        <label class="control-label">Product Pages Name <span class="req">*</span></label>
        <div class="controls">
          <input id="product_name" name="product_name" value="<?=$result[0]['product_name']?>" type="text" required="required" class="span12 {validate:{required:true}}" placeholder="Pages Name"/>
        </div>
      </div>
      
 
      
      <div class="control-group">
        <label class="control-label"> Description <span class="req">*</span></label>
        <div class="controls">
          <textarea id="description" name="description" class="span12"><?=$result[0]['description']?>
</textarea>
          <script type="text/javascript">
    				CKEDITOR.replace( 'description',{});
				</script> 
        </div>
      </div>
      
      
      
      <div class="control-group">
        <label class="control-label">Status <span class="req">*</span></label>
        <div class="controls">
          	<select name="status" id="status">
            	<?php
                	$sel1=($result[0]['status']=='Active') 	? "selected='selected'" : "";
					$sel2=($result[0]['status']=='Inactive') ? "selected='selected'" : "";
				?>
            	<option <?=$sel1?> value="Active">Active</option>
                <option <?=$sel2?> value="Inactive">Inactive</option>
            </select>
        </div>
      </div>
      
      
      
      
      <!------------------->
      <div class="form-actions">
        <button type="submit" class="btn btn-primary btnsubmit">
        <?=$btntext?>
        </button>
        <a href="<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/view">
        <button type="button" class="btn">Cancel</button>
        </a> </div>
    </form>
  </div>
</div>

<style>
	.req{
		color:#F00;
	}
</style>


