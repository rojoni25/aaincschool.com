<script>

	$(document).ready(function() {

		var url2='<?php echo base_url()?>index.php/user/reverse_five_by_three_wallet_ajax';

        

          $('#data-table').dataTable( {
        		"bProcessing": true,
        		"bServerSide": true,
        		"bSort": true,
        		
        		"sAjaxSource": url2,
        		"aLengthMenu": [[100, 200, 500, 1000], [100, 200, 500, 1000]],
        		"iDisplayLength":100,
        		"aoColumnDefs": [
                  { 'bSortable': false, 'aTargets': [ 2,3 ] }
               ]
        		
        		
        	} );
        	

    });

	

</script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>





    <div class="row-fluid ">

      <div class="span12">

        <div class="primary-head">

          <h3 class="page-header">Reverse 5x3 Wallet

          	 <!-- <a href="<?php echo base_url();?>index.php/export_excel/send_request/<?=$this->uri->segment(3)?>" style="float:right;" title="Export To Excel"><img src="<?php echo base_url();?>asset/images/excel-icon.png" width="30" /></a> -->

          </h3>

        </div>

        <!-- <ul class="breadcrumb">

          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>

          <li><a href="#">Master</a><span class="divider"><i class="icon-angle-right"></i></span></li>

          <li class="active">Upgrade Request</li>

        </ul> -->

      </div>

    </div>

    

   

    

    <div class="row-fluid">

      <div class="span12 tblover">

    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th>User Code</th>
          <th>Name</th>
          <th>Amount</th>
          <th>Remaining</th>
        
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>

  

         

      </div>

    </div>



<style>

	.tblover{

		overflow-x: auto;

	}

	.sendbtn {

		border: medium none;

		padding: 0px 10px;

	}

	.trpaid{

		background-color:#3BE61A !important;

		font-weight:bold;

	}

	.trunpaid{

		background-color:#98E49C  !important;

	}

</style>