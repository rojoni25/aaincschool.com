<?php
	if(count($next_level)>3){
		$next_top=$next_level[count($next_level)-3][0]['idcode'];
	}else{
		$next_top=1;
	}
?>

<script src="<?php echo base_url();?>asset/js/popup/js/lightbox.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/jquery.carouFredSel-5.5.0-packed.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/jquery.magnific-popup.js"></script>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/js/popup/css/lightbox.css">

<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">



<script>
	$(document).on('click', '.open_popup', function (e) {
			var url='<?php echo MATRIX_BASE;?>r_matrix_tree/tree_popup/<?=$next_top?>';
			e.preventDefault();
			$.magnificPopup.open({items: { src:url},type: 'ajax',modal: true,preloader: false}, 0);
		});
		
		$(document).on('click', '.popup-modal-dismiss', function (e) {
			e.preventDefault();
			$.magnificPopup.close();
		});
</script>


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

	<script>
    	$(document).ready(function(e) {
            $(document).on('change','#downline',function(e){
				
				var downline=$(this).val();
				if(downline=='select_postion'){
					$('.select_pos').removeClass('dis-none');
					$('.next_pos').addClass('dis-none');
					
				}
				else{
					$('.next_pos').removeClass('dis-none');
					$('.select_pos').addClass('dis-none');
				}
				
			});
			
			 	  
        });
		
		$(document).on('submit','#form2',function(e){
			 	if($('#downline').val()==''){
						$('#downline').focus();
						return false;	
				}
				
				var con=confirm('Are You Soue');			
				
				if(!con){
					return false;
				}
		
		});
    </script>		
 
 <?php
	$arr_segment=$this->uri->rsegment_array();
	echo list_matrix_menu($arr_segment);
?>
 
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Insert Member In Tree</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#"><?=MATRIX_LLB?></a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Insert Member In Tree</li>
        </ul>
      </div>
    </div>
 
    <div class="row-fluid">
      <div class="span12">
      
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo MATRIX_BASE;?><?=$this->uri->rsegment(1)?>/insert_approve" enctype="multipart/form-data">
     	 <input type="hidden" name="request_code" id="request_code"  value="<?=$result[0]['request_code']?>" />
         <input type="hidden" name="select_downline" id="select_downline"  value="" />
         <?php if($extra_position){?>
          			<input type="hidden" name="extra_position" value="True" />
         <?php } ?>
         
          <div class="control-group">
            <label class="control-label">Downline Of </label>
            <div class="controls">
              <select id="downline" name="downline" class="span6" >
              		<option value="">Select</option>	
                	<option value="next_position">Next Available Position</option>		
                    <option value="select_postion">Position Select</option>		
              </select>
             
            </div>
          </div>
          <!------------------>
          
          
          <div class="control-group select_pos dis-none">
            <label class="control-label">Select</label>
            <div class="controls">
              	<span id="selected_name"></span> <a href="#" class="open_popup"><span class="label label-important">Select</span></a> 
            </div>
          </div>
          
          
          <div class="control-group">
            <label class="control-label">Next Available Position</label>
            <div class="controls">
              	<ul class="breadcrumb2"><?=$next_html?></ul>
            </div>
          </div>
          
          
          
          
          <div class="control-group">
            <label class="control-label">Usercode</label>
            <div class="controls">
              <input  value="<?=$result[0]['usercode']?>" type="text" class="span12" readonly />
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label">Member Name</label>
            <div class="controls">
              <input  value="<?=$result[0]['name']?>" type="text" class="span12" readonly />
            </div>
          </div>
          
           
          
           <div class="control-group">
            <label class="control-label">Username</label>
            <div class="controls">
              <input  value="<?=$result[0]['username']?>" type="text" class="span12" readonly />
            </div>
          </div>
          <!------------------->
            
          <!------------------->
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit">Submit</button>
            <a href="<?php echo MATRIX_BASE;?>index.php/<?=$this->uri->rsegment(1)?>"><button type="button" class="btn">Cancel</button></a>
            
            
          </div>
        </form>
      </div>
    </div>

<style>
	.dis-none{
		display:none;
	}
	.show_msg{
		color:#F00;
		font-size:14px;
	}
	#selected_name{
		font-weight:bold;
	}
	.breadcrumb2{
		padding: 8px 15px;
		margin: 0px 0px 20px;
		list-style: outside none none;
		background-color: #F5F5F5;
	}
	.breadcrumb2 > li {
    	display: inline-block;
    	text-shadow: 0px 1px 0px #FFF;
	}
</style>
