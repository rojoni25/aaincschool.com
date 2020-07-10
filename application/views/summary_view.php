<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
    <div class="marquee_div">
        <span class="spm_llb">Just Joined</span>
        <marquee><h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3></marquee>
    </div>  
<?php } ?>
<link href="<?=base_url();?>asset/tree/treecss.css" rel="stylesheet">
<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">
<script>
	$(document).ready(function(e) {
       
			
		var url2='<?php echo base_url()?>index.php/comman_controler/get_level_summary/?tree=3';
				
		$.ajax({url:url2,success:function(result){
	
			$('.level_summary3').html(result);
		
		}});
		
		var url2='<?php echo base_url()?>index.php/comman_controler/get_level_summary/?tree=5';
				
		$.ajax({url:url2,success:function(result){
	
			$('.level_summary5').html(result);
		
		}});
		
		var url2='<?php echo base_url()?>index.php/comman_controler/get_level_summary/?tree=10';
				
		$.ajax({url:url2,success:function(result){
	
			$('.level_summary10').html(result);
		
		}});
		
		
	   
    });
</script>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Summary</h3>
        <div>
    </div>
    </div>
   
  </div>
</div>





<div class="row-fluid level_summary3">
   
   </div>
  
  <div class="row-fluid ">
   		
        <div class="span6 level_summary5">
        </div>
        <div class="span6 level_summary10">
        </div>
       
   </div>
    <div class="row-fluid ">
    	<div class="span6">
        	<?=$level?>
        </div>
    </div>
   
  <style>
  	.level_summary3 table tr:first-child {
		background:#0093A8;
		color:#FFF;
	}
	.level_summary3 table tbody{
		border:#0093A8 solid 1px;
	}
	.level_summary5 table tr:first-child {
		background:#009600;
		color:#FFF;
	}
	.level_summary5 table{
		border:#009600 solid 1px;
	}
	.level_summary10 table tr:first-child {
		background:#A300AA;
		color:#FFF;
	}
	.level_summary10 table{
		border:#A300AA solid 1px;
	}
  </style> 
   
   
   
   
