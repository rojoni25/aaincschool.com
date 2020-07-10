<script>
	$(document).on('click','.tr_delete', function (e) {
		var con=confirm('Are You Sure Delete Balance Withdrawal Request');	
		if(!con){
			return false;
		}	
	});	
</script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Withdrawal Request</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Finance</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Withdrawal Request</li>
    </ul>
  </div>
</div>

<?php if($this->session->flashdata('show_msg')!=''){?>
<div class="alert <?=$this->session->flashdata('show_msg_class')?>">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
</div>
<?php } ?>




<div class="row-fluid">
  <div class="span12">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Usercode</th>
          <th>Username</th>
          <th>Memeber Name</th>
           <th>Paypal Id</th>
          <th>Amount</th>
          <th>Comment</th>
          <th>Date</th>
          <th>Opration</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
