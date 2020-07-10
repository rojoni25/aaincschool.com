	<script>
    	$(document).ready(function(e) {
          	$('#data-table').dataTable();  
        });
    </script>
   <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Invite Friends History
           <a style="float:right;" href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/invitefriends"><button type="button" class="btn btn-success btn_padding">Invite Friends</button></a> &nbsp;&nbsp;
          <a style="float:right;margin-right:10px;" href="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/"><button type="button" class="btn btn-warning btn_padding">Friend View</button></a>
          </h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">Invite Friends</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Invite Friends History</li>
        </ul>
      </div>
    </div>
    
  
    
    <div class="row-fluid">
      <div class="span12">
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
              	<th width="20%">Emaild</th>
                <th width="20%">Date</th>
             	<th width="20%">Subject</th>
              	<th width="40%">Message</th>
            </tr>
          </thead>
          <?php
          	for($i=0;$i<count($result);$i++){
				$new_date = date('d-M-Y h:ia', strtotime($result[$i]['timedt']));
				echo'<tr class="'.$status.'">
						<td>'.$result[$i]['invite_emailid'].'</td>
						<td>'.$new_date.'</td>
						<td>'.$result[$i]['subject'].'</td>
						<td>'.$result[$i]['message'].'</td>
              		</tr>';
			}
		  ?>
          <tbody>
            
           </tbody>
        </table>
      </div>
    </div>

