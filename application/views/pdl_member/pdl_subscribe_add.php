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
			
			$(document).on('change', '#emailid', function (e) {
				var value=$(this).val();
				if(value==''){
					return false;
				}
				var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (!filter.test(value)) {
					$(this).val('');
   		 			alert("Enter Vailed Email Address");
    				return false;
 				}
				var url_update='<?=base_url();?>index.php/<?=$this->uri->segment(1)?>/check_email/'+value;
				$.ajax({url:url_update,success:function(result){	
					if(result=='1'){
						alert('" '+value+' " is already exist');
						$('#emailid').val('');
					}	 	
            	}});	
			});	
</script>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">PDL Subscription</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li class="active">PDL Subscription</li>
    </ul>
  </div>
</div>

<?php if($this->session->flashdata('show_msg')!=''){?>
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <i class="icon-info-sign"></i><strong>
  <?=$this->session->flashdata('show_msg')?>
  </strong> </div>
<?php } ?>
</div>


<div class="row-fluid" style="margin-bottom:20px;">
  <div class="">
	<?php
		if($contain[0]['video_url']!=''){
			echo '<div class="video_frm">';
			echo '<div class="inner_frm">';
			if (strpos($contain[0]['video_url'], 'youtube') !== false)
			{
				echo '<iframe width="100%" height="100%" src="'.$contain[0]['video_url'].'" frameborder="0" allowfullscreen></iframe>';
			}
			else{
				echo '<video width="100%" height="100%" controls="controls"><source src="'.$contain[0]['video_url'].'" type="video/mp4"></video>';
			}
			echo '</div>';
			echo '</div>';
		}
		
		?>
  </div>
  <div style="margin-top:30px;">
    <div class="txtdiv">
      <?=$contain[0]['textdt']?>
    </div>
    <div style="clear:both;overflow:hidden;"></div>
  </div>
</div>


<div class="row-fluid">
  <div class="span12">
    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/subscription_create" enctype="multipart/form-data">
      <!------------------>
      <div class="control-group">
        <label class="control-label">Amount</label>
        <div class="controls">
          <input value="$25.00" class="span12" type="text" readonly="readonly"/>
        </div>
      </div>
      
      <!------------------>
      <div class="control-group">
        <label class="control-label">Credit Card Number</label>
        <div class="controls">
          <input id="cardNumber" name="cardNumber" value="" class="span12 {validate:{required:true}}" type="text" placeholder="Credit Card Number"/>
        </div>
      </div>
      <!------------------> 
      
      <!------------------>
      <div class="control-group">
        <label class="control-label">Expiration Date</label>
        <div class="controls">
          <input id="expirationDate" name="expirationDate" value="" class="span12 {validate:{required:true}}" type="text" placeholder="YYYY-MM"/>
          <br />
          <span>YYYY-MM</span> </div>
      </div>
      <div class="form-actions">
        <button type="submit" class="btn btn-primary btnsubmit"><strong>Subscription</strong></button>
        <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">
        <button type="button" class="btn">Cancel</button>
        </a> </div>
    </form>
  </div>
</div>
<style>
	.btncls{
		border:none;
	}
	.video_frm{
		width: 473px;
		height: 333px;
		overflow:hidden;
		margin:auto;
		background-image:url(<?=base_url();?>asset/images/cap_frm.png);
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	.inner_frm{
		height: 291px;
		width: 390px;
		margin-top: 20px;
		margin-left: 40px;
	}
	.txtdiv{
		width:90%;
		position:relative;
		margin:auto;
	}
</style>
<script>
	function Checkfiles()
    {
		
        var fup = document.getElementById('post_img');
        var fileName = fup.value;
        var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
		
    	if(ext =="jpeg" ||  ext=="png"  || ext=="jpg")
    	{
        	return true;
   		}
    	else
    	{
        	alert("Upload jpeg,png,jpg Images only");
			fup.value="";
        	return false;
    	}
    }
</script>