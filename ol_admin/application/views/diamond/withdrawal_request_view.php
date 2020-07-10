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
      <h3 class="page-header">Diamond Withdrawal Request
      	<div class="pull-right">
        	<a href="<?=diamond_base()?>diamond_wallet/view"><button class="btn btn-round-min btn-success"><span><i class="icon-home"></i></span></button></a>
        </div>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Diamond</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Withdrawal Request</li>
    </ul>
  </div>
</div>


<?php if($this->session->flashdata('show_msg')!=''){?>
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="icon-info-sign"></i><strong><?=$this->session->flashdata('show_msg');?></strong>
    </div>
<?php } ?>


<div class="row-fluid">
  <div class="span12">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th>Usercode</th>
          <th>Name</th>
          <th>Message</th>
          <th>Amount</th>
          <th>Date</th>
          <th>#</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0;$i<count($result);$i++) { ?>
        <tr>
          <td><?=$result[$i]['usercode']?></td>
          <td><?=$result[$i]['name']?></td>
          <td><?=$result[$i]['text_dt']?></td>
          <td>$<?=number_format($result[$i]['amount'],2)?></td>
          <td><?=date('d-m-Y',strtotime($result[$i]['date_dt']))?></td>
           <td>
                <div class="btn-group">
                <button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>
                <ul class="dropdown-menu">
                	<li><a href="<?=diamond_base()?><?=$this->uri->rsegment(1)?>/withdrawal_request_approve/<?=$result[$i]['id']?>">Approve</a></li>
                    <li><a href="<?=diamond_base()?><?=$this->uri->rsegment(1)?>/delete3/<?=$result[$i]['id']?>">Delete</a></li>
                </ul>
                </div>
           </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
