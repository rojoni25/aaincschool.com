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

<?php
	//var_dump($result);
?>
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Profile
            
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Product</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Paid</li>
        </ul>
      </div>
    </div>
   
   
   	<?php if($this->session->flashdata('show_msg')!=''){?>
        		<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<i class="icon-info-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
					</div>
        <?php } ?>
   
    <div class="row-fluid">
      <div class="span12">
      
      
        
        
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