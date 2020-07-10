

<script src="<?php echo base_url();?>asset/js/jquery.tablecloth.js"></script>
<script src="<?php echo base_url();?>asset/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>asset/js/ZeroClipboard.js"></script>
<script src="<?php echo base_url();?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>asset/js/TableTools.js"></script>

<script>
	$(document).ready(function(e) {
        $('#data-table').dataTable({
					"bProcessing": true,
					"iDisplayLength": 25,
					"responsive": true,
					"bDestroy": true
		});
		
		$(document).on('click','.reject_req',function(e){
			var con=confirm('Are You Sure Reject Request ?');
			if(!con){
				e.preventDefault();
				return false;
			}
		});
    });
</script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">R-Matrix Request</h3>
    </div>
    <ul class="breadcrumb">
    
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">R-Matrix</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Member Request</li>
      
    </ul>
  </div>
</div>

  <?php if($this->session->flashdata('show_msg')!=''){ ?>
  	<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<i class="icon-info-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
	</div>
     <?php } ?>  
	<br />




	<table class="table table-striped table-bordered dataTable" id="data-table">
    		<thead>
            	<tr>
                	<th>Usercode</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
            	<?php for($i=0;$i<count($result_list);$i++){?>
                	<tr>
                	<td><?=$result_list[$i]['usercode']?></td>
                    <td><?=$result_list[$i]['username']?></td>
                    <td><?=$result_list[$i]['name']?></td>
                    <td><?=date('M d, Y  i:j',$result_list[$i]['request_time'])?></td>
                    <td>
                    	<a href="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/request_approve/<?=$result_list[$i]['request_code']?>"><span class="label label-success">Approve</span></a>&nbsp;&nbsp;
                        <a class="reject_req" href="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/reject_request/<?=$result_list[$i]['request_code']?>"><span class="label label-important">Reject</span></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>	
              
            </table>


<style>
	.show_msg{
		color:#F00;
		font-weight:bold;
	}
</style>