


    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Message To Admin</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Message</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Message To Admin</li>
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
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo smfund();?><?=$this->uri->rsegment(1)?>/send_message">
        	 
       		<input type="hidden" name="usercode" id="usercode" value="<?=$result[0]['usercode']?>" />
           
           <div class="control-group">
            <label class="control-label"></label>
            <div class="controls" style="padding-top:5px;">
             	<strong>Message To Admin</strong>
            </div>
          </div>
          <!------------------>
         
         
          <!------------------>
          <div class="control-group">
            <label class="control-label">Subject</label>
            <div class="controls">
              <input id="subject" name="subject" required="required" value="" type="text" class="span12" placeholder="Enter Subject"/>
            </div>
          </div>
          <!------------------>
          <div class="control-group">
            <label class="control-label">Message</label>
            <div class="controls">
            <textarea id="message" name="message" required="required" class="span12" placeholder="Message"></textarea>
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