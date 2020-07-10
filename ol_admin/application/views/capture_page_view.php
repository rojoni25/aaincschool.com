<script>
	$(document).ready(function(e) {
        $(document).on('click', '.pageperview', function (e) {
			var pagecode=$(this).attr('value');
			//*********//
				params  = 'width='+screen.width;
				params += ', height='+screen.height;
				params += ', top=0, left=0'
				params += ', fullscreen=yes';
				var url='<?php echo base_url();?>index.php/capture/page/'+pagecode+'';
				url=url.replace('ol_admin/', '')
				
				newwin=window.open(url,'', params);
				if (window.focus) {newwin.focus()}
					
			//***********//
		});
		
		$(document).on('click', '.delete', function (e) {	
			var pagecode=$(this).attr('value');
			///////////
			var url='<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/record_update/'+pagecode+'';
			//alert(url);
			$(this).parent().parent().remove();
			
			$.ajax({url:url,success:function(result){
				
     		}});
			////////////
		});
    });
	
	$(document).on('change','#page_type',function(e){
			var page_type=$('#page_type').val();
			var url='<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/view/'+page_type;
			//alert(url);
			window.location.href=url;

		});
</script>
<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">
<div class="row-fluid ">

  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Capture Page Master</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Master</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Capture Page</li>
    </ul>
    <div class="span3">
            <select id="page_type" name="page_type">
                  		<option value="">All</option>
                        <?php
                        	for($i=0;$i<count($category);$i++)
							{
								$sel=($category[$i]['capture_filter_code']==''.$this->uri->segment(3).'')?"selected":"";
								echo '<option '.$sel.' value="'.$category[$i]['capture_filter_code'].'">'.$category[$i]['page_type'].'</option>';
							}
						?>
                  </select>
      </div>
     
  </div>
</div>
 	 
<div class="row-fluid">

 
     <div class="span10" style="text-align:right;margin-bottom:10px;"> 
        <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/my_capture_page/">
        <button type="button" class="btn btn-info btn_padding">Admin Capture Page</button>
        </a> 
    </div>
     <div class="span2" style="text-align:right;margin-bottom:10px;">
        <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/capture_page_report/">
        <button type="button" class="btn btn-warning btn_padding">Member Capture Page</button>
        </a> 
    </div>
</div>
<div class="row-fluid" style="min-height:1250px;position:relative;">
		<div class="span12">
        		<?php for($i=0;$i<count($result);$i++){	?>
                	
                	<div class="thumdiv">
                    	<a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/addnew/Add/<?=$result[$i]['pagecode']?>">
							<div class="board-widgets green">
								<div class="board-widgets-head clearfix">
									<h4 class="pull-left"><? echo $i + 1;?>) <i class="icon-inbox"></i><?=$result[$i]['pagelable']?></h4>
								</div>
								<img src="<?php echo base_url();?>asset/capture_thum/<?=$result[$i]['thum_img']?>" />
							</div>
                    	</a>
					</div>
                <?php } ?>
				
</div>
                <div style="clear:both;overflow:hidden;"></div>
</div>
 <div style="clear:both;overflow:hidden;"></div>
<style>
	.btncls{
		border:none;
		margin-right:5px;
	}
	.thumdiv{
		width:230px;
		height:130px;
		float:left;
		margin-left:10px;
		margin-bottom:10px;
	}

</style>