


    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Invite Friend
          <a style="float:right;" href="<?php echo smfund();?><?=$this->uri->rsegment(1)?>/invite_friends_history"><button type="button" class="btn btn-info btn_padding">Invite History</button></a> &nbsp;&nbsp;
          <a  class="view_friend" style="float:right;margin-right:10px;" href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/"><button type="button" class="btn btn-danger btn_padding">Friend View</button></a>
         
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
            	if($this->session->flashdata('show_msg')!=''){ ?>
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
					</div>
				<?php }
			?>
      </p>
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo smfund();?><?=$this->uri->rsegment(1)?>/invitefriends_insertrecord">
        	 
       		<input type="hidden" name="ref_link" id="ref_link" value="<?=$b_url?>" />
        	<input type="hidden" name="pagecode" id="pagecode" value="<?=$_REQUEST['page']?>" />
            <input type="hidden" name="current_url" id="current_url" value="<?=$current_url?>" />
            
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
              <input id="invite_emailid" name="invite_emailid" required="required" value="" class="span12 {validate:{required:true}}" type="email" placeholder="Enter Your Friend Email Id"/>
            </div>
          </div>
          <!------------------>
          <div class="control-group">
            <label class="control-label">Subject</label>
            <div class="controls">
              <input id="subject" name="subject" required="required" value="" type="text" class="span12 {validate:{required:true}}" placeholder="Enter Subject"/>
            </div>
          </div>
          <!------------------>
          <div class="control-group">
            <label class="control-label">Message</label>
            <div class="controls">
            <textarea id="message" name="message" required="required" class="span12 {validate:{required:true}}" placeholder="Message"></textarea>
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

<style>
@media  only screen and (max-width: 360px){
	.page-header {
    font-size: 20px;
	height:70px;
	}
	.view_friend{
		margin-top:5px;
		margin-left:45%;
		float:right;
	}
}
</style>