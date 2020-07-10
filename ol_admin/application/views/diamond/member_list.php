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
      <h3 class="page-header">Diamond Member List
      	<div class="pull-right">
        	<a href="<?=diamond_base()?>diamond_wallet/view"><button class="btn btn-round-min btn-success"><span><i class="icon-home"></i></span></button></a>
        </div>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Diamond</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Confirmation Message</li>
    </ul>
  </div>
</div>




<div class="row-fluid">
  <div class="span12">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th>SR.No</th>	
          <th>Usercode</th>
          <th>Name</th>
          <th>Username</th>
          <th>Emailid</th>
          <th>Contact No</th>
          <th>#</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0;$i<count($result);$i++) { 
			$row=$i+1;
		?>
        <tr>
          <td><?=$row?></td>	
          <td><?=$result[$i]['usercode']?></td>
          <td><?=$result[$i]['fname']?> <?=$result[$i]['lname']?></td>
           <td><?=$result[$i]['username']?></td>
          <td><?=$result[$i]['emailid']?></td>
          <td><?=$result[$i]['mobileno']?></td>
         
           <td>
                <div class="btn-group">
                <button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>
                <ul class="dropdown-menu">
                	
                    <li><a href="<?=diamond_base()?>diamond_wallet/transaction/<?=$result[$i]['usercode']?>">View</a></li>
                </ul>
                </div>
           </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
