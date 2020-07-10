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

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">VMA Payment Confirmation Message</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">VMA</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Confirmation Message</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th>Usercode</th>
          <th>Name</th>
          <th>Subject</th>
          <th>Message</th>
          <th>Date</th>
          <th>#</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0;$i<count($result);$i++) { ?>
        <tr>
          <th><?=$result[$i]['usercode']?></th>
          <th><?=$result[$i]['name']?></th>
          <th><?=$result[$i]['subject']?></th>
          <th><?=$result[$i]['msg']?></th>
          <th><?=date('d-m-Y',strtotime($result[$i]['timedt']))?></th>
           <th><a href="<?=vma_base()?><?=$this->uri->rsegment(1)?>/delete1/<?=$result[$i]['id']?>"><span class="label label-important">Delete</span></a>
           	   &nbsp;&nbsp;&nbsp;<a href="<?=vma_base()?>message/send/<?=$result[$i]['usercode']?>"><span class="label label-info">Send Email</span></a>
           </th>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
