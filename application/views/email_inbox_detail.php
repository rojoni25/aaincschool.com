<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
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

<?php
	//var_dump($result);
?>
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Email
            <a class="remove_cls" href="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/record_update2/Delete/<?=$this->uri->segment(3)?>"><i class=" icon-remove-sign "></i></a>
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Email</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Inbox</li>
        </ul>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
       		
            
             <!------------------>
          <div class="control-group">
            <label class="control-label">Subject</label>
            <div class="controls">
              <input  value="<?=$result[0]['subject']?>" class="span12" type="text" readonly="readonly"/>
            </div>
          </div>
          <!------------------>
          <?php
          	$timedt = date("d-m-Y - g:i a", strtotime($result[0]['timedt']));
		  ?>
          <div class="control-group">
            <label class="control-label">Date</label>
            <div class="controls">
              <input  value="<?=$timedt?>" class="span12" type="text" readonly="readonly"/>
            </div>
          </div>
            <!------------------>
            <!------------------>
          <div class="control-group">
            <label class="control-label">Sender</label>
            <div class="controls">
              <input  value="<?=$result[0]['fname']?> <?=$result[0]['lname']?>" class="span12" type="text" readonly="readonly"/>
            </div>
          </div>
            <!------------------>
          <div class="control-group">
            <label class="control-label">Message</label>
            <div class="controls"><p><?=$result[0]['msg']?></p></div>
          </div>
         
      
        </form>
      </div>
    </div>

<style>
	.remove_cls{
		float:right;
		color:#333;
	}
	.remove_cls:hover{
		color:#000;
		text-decoration:none;	
	}
</style>