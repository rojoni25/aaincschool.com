<script src="<?=base_url()?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url()?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url()?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url()?>asset/js/TableTools.js"></script>
	
	<script>
    	$(document).ready(function(e) {
            $('#data-table').dataTable({
					"bProcessing": true,
					"iDisplayLength": 25,
					"responsive": true,
					"bDestroy": true
			});
        });
    </script>
	<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">VMA Member</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">VMA</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">VMA Member</li>
        </ul>
      </div>
    </div>
    
    <?php if($this->session->flashdata('show_msg')!=''){?>
    	<div class="alert alert-success">
   	 		<button type="button" class="close" data-dismiss="alert">&times;</button>
    		<strong><?=$this->session->flashdata('show_msg')?></strong> 
    	</div>
   <?php } ?>
    
    <div class="row-fluid">
      <div class="span12">
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
            	<th>Usercode</th>
            	<th>Name</th>
              	<th>Username</th>
                <th>Email Id</th>
             	<th>Referral</th>
                <th>Status</th>
                <th>#</th>
               
            </tr>
          </thead>
          <tbody>
          	<?=$html?>
           </tbody>
        </table>
      </div>
    </div>

