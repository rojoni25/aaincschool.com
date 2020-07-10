<script src="<?=base_url()?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url()?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url()?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>asset/js/TableTools.js"></script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<script>
	$(document).ready(function() {
	$('#data-table').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"bSort": false,
		"sAjaxSource": "<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/listing/<?=$this->uri->segment(3)?>"
	} );
} );

$(document).ready(function(e) {
    $(document).on('change','#report_type',function(e){
		var value=$(this).val();
		window.location.href='<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/view/'+value;
	});
	
	
});
</script>

    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Virtual Balance
          	 <a href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/export_excel" style="float:right;" title="Export To Excel"><img src="<?php echo base_url();?>asset/images/excel-icon.png" width="30" /></a>
          </h3>
         
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Finance</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Virtual Balance</li>
        </ul>
      </div>
    </div>
    
    
    <div class="row-fluid">
      <div class="span12">
      		<?php
				$sel_1=($this->uri->segment(3)=='3by3') ? "selected='selected'" : "";
            	$sel_2=($this->uri->segment(3)=='5by3') ? "selected='selected'" : "";
				$sel_3=($this->uri->segment(3)=='10by3') ? "selected='selected'" : "";
			?>
      		<select id="report_type" name="report_type">
            	<option <?=$sel_1?> value="3by3">3 x 3</option>
                <option <?=$sel_2?> value="5by3">5 x 3</option>
                <option <?=$sel_3?> value="10by3">10 x 3</option>
            </select>
      </div>
    </div>  
   
  
    <div class="row-fluid">
      <div class="span12">
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
                <tr>
                    <th>code</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Balance</th>
                    <th></th>
                </tr>
          </thead>
          <tbody>
            <tr><td colspan="8"><h6 style="text-align:center;color:#F00;font-weight:bold;">loading..</h6></td></tr>
           </tbody>
        </table>
      </div>
    </div>

<style>
	#report_type{
		width:250px;
		height:27px;
		border:#666 solid 1px;
		font-weight:bold;
	}
	#report_type option{
		padding:2px 2px;
	}
</style>
