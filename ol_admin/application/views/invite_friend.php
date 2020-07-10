
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
          <h3 class="page-header">Invite Friend
          <a style="float:right;" href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/invite_friends_history"><button type="button" class="btn btn-info btn_padding">Invite History</button></a> &nbsp;&nbsp;
          <a style="float:right;margin-right:10px;" href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/"><button type="button" class="btn btn-danger btn_padding">Friend View</button></a>
         
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Friend</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Invite Friend</li>
        </ul>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
      <p>
      		<?php
            	if($_REQUEST['success']=='true'){ ?>
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<i class="icon-ok-sign"></i><strong>Success:-</strong> Request Send Successfully
					</div>
				<?php }
			?>
      </p>
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/invitefriends_insertrecord">
        	 <?php
				 $b_url	= base_url().'index.php/rg/?r='.$result[0]['username'].'';
				 $b_url = str_replace("ol_admin/", "", $b_url);
			?>
       		<input type="hidden" name="ref_link" id="ref_link" value="<?=$b_url?>" />
        	
 
             <div class="control-group">
            <label class="control-label">Link</label>
            <div class="controls" style="padding-top:5px;">
           
             <a href="<?=$b_url?>"><?=$b_url?></a>
            </div>
          </div>
          <!------------------>
           
          <div class="control-group">
            <label class="control-label">Email Id</label>
            <div class="controls">
              <input id="invite_emailid" name="invite_emailid" value="" class="span12 {validate:{required:true}}" type="email" placeholder="Enter Your Friend Email Id"/>
            </div>
          </div>
          <!------------------>
          <div class="control-group">
            <label class="control-label">Subject</label>
            <div class="controls">
              <input id="subject" name="subject" value="" type="text" class="span12 {validate:{required:true}}" placeholder="Enter Subject"/>
            </div>
          </div>
          <!------------------>
          <div class="control-group">
            <label class="control-label">Message</label>
            <div class="controls">
            <textarea id="message" name="message" class="span12 {validate:{required:true}}" placeholder="Message"></textarea>
            </div>
          </div>
          
          <!------------------->
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Send</button>
            <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>"><button type="button" class="btn">Cancel</button></a>
          </div>
        </form>
      </div>
    </div>

