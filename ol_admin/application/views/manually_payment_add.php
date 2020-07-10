<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<script>
	$(function () {
                var validator = $("#form2").validate({
                    meta: "validate"
                });
				$(".btnsubmit").click(function () {
					
					if($('#requestcode').val()==''){ alert('Select Member'); return false; }
					
					var con=confirm(''+$( "#requestcode option:selected" ).text()+'" Payment Done ?');
					if(!con){
						return false;
					}
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
          <h3 class="page-header">Manually Payment
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Master</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Manually Payment</li>
        </ul>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
       		<input type="hidden" name="mode" id="mode" value="<?=$this->uri->segment(3)?>" />
        	<input type="hidden" name="eid" id="eid" 	 value="<?=$this->uri->segment(4)?>" />
          <div class="control-group">
            <label class="control-label">Select Member</label>
            <div class="controls">
            	<select name="requestcode" id="requestcode">
              		<option value="">--Select--</option>
              		<?php for($i=0;$i<count($requestcode);$i++){
						echo '<option value="'.$requestcode[$i]['requestcode'].'">'.$requestcode[$i]['fname'].' '.$requestcode[$i]['lname'].'</option>';
					}?>
              </select>
            </div>
          </div>
          <!------------------>
          
         
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Payment</button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
          </div>
        </form>
      </div>
    </div>

