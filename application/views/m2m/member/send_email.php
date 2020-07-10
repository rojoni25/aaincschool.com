<script>
	$(document).on('submit', '#frmsubmit', function(){
		if($('#page_key').val()==''){
			$('#page_key').focus();
			return false;	
		}
	});
</script>

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
<div class="marquee_div"> <span class="spm_llb">Just Joined</span>
  <marquee>
  <h3 class="maq_h3">
    <?=$this->session->userdata["ref"]["currect_add"]?>
  </h3>
  </marquee>
</div>
<?php } ?>


<?php if($this->session->flashdata('show_msg')!=''){?>
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <i class="icon-info-sign"></i><strong>
  <?=$this->session->flashdata('show_msg');?>
  </strong> </div>
<?php } ?>



<div class="row-fluid">
      <div class="span12">
      	<h3 class="page-header">Send Email (DFSM)
        	 <span class="pull-right"><a href="<?=base_url()?>index.php/m2m/page/view/"><button class="btn btn-round-min" type="button"><span><i class="icon-home"></i></span></button></a></span>
        </h3>
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/m2m/<?=$this->uri->rsegment(1)?>/send_email_insert" enctype="multipart/form-data">
       		
         <div class="control-group">
            <label class="control-label">Member</label>
            <div class="controls">
              <input value="<?=$result[0]['fname']?> <?=$result[0]['lname']?>" readonly="readonly" disabled="disabled" class="span12"  type="text" />
            </div>
          </div>
          <!------------------>
          
          <div class="control-group">
            <label class="control-label">Subject</label>
            <div class="controls">
              <input id="subject" name="subject" value="" class="span12" type="text" placeholder="Enter Subject" required="required"/>
            </div>
          </div>
          <!------------------>
          <div class="control-group">
            <label class="control-label">Message</label>
            <div class="controls">
              <textarea id="textdt" name="textdt" class="span12" placeholder="Enter Your Message Hear" required="required"></textarea>
            </div>
          </div>
          
           <div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
              <p class="msg_show"></p>
            </div>
          </div>
         
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit" onclick="return validation();">Send</button>
          </div>
        </form>
      </div>
      
      
    </div>
	  <div style="clear:both;overflow:hidden;"></div>
    
    
    
    
     
    
    
     
  
    

	