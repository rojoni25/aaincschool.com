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
      <h3 class="page-header">Money Transfer Request</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Finance</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Money Transfer Request</li>
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
            <th>Memeber Name</th>
            <th>Tranfer</th>
            <th>Amount</th>
            <th>Date</th>
            <th>CW Bal.</th>
            <th>PW Bal.</th>
            <th>Opration</th>
        </tr>
      </thead>
      <tbody>
      	<?php for($i=0;$i<count($result);$i++){
			$row=$i+1;
			
			$tranfer='';
			if($result[$i]['wallet_type']=='1'){
				$tranfer='Company Wallet to Personal Wallet';
			}
			if($result[$i]['wallet_type']=='2'){
				$tranfer='Personal Wallet to Company Wallet';
			}
			
			echo '<tr>
					<td>'.$row.'</th>
					<td>'.$result[$i]['usercode'].'</th>
					<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
					<td>'.$tranfer.'</td>
					<td>$'.$result[$i]['amount'].'</th>
					<td>'.date('d-m-Y',strtotime($result[$i]['date_time'])).'</td>
					<td>$'.$result[$i]['main_balance'].'</td>
					<td>$'.$result[$i]['personal_wallet'].'</td>
					<td>
						<a href="'.base_url().'index.php/'.$this->uri->segment(1).'/approve_req/'.$result[$i]['id'].'">Approve</a>  &nbsp;&nbsp;|&nbsp;&nbsp; 
						<a href="'.base_url().'index.php/'.$this->uri->segment(1).'/delete_req/'.$result[$i]['id'].'">Delete</a>
					</td>
        		</tr>';
		}?>
      </tbody>
    </table>
  </div>
</div>
