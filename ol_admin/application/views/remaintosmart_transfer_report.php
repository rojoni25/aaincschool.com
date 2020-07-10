<script>

	$(document).ready(function(e) {
    var url2='<?php echo base_url()?>index.php/reports/remaintosmart_transfer_report_get';

        

    $.ajax({url:url2,success:function(result){

  

      $('#data_table').html(result);

    

    }}); 
    // $('#data-table').dataTable( {
    //   "bProcessing": true,
    //   "bServerSide": true,
    //   "bSort": true,
    //   "sAjaxSource": "<?=base_url()?>index.php/reports/remaintosmart_transfer_report_get",
    //   "aLengthMenu": [[100, 200, 500, 1000], [100, 200, 500, 1000]],
    //   "iDisplayLength":100
    // });

  });

	

</script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul><ul class="top-banner-free"></ul></div></div>





    <div class="row-fluid ">

      <div class="span12">

        <div class="primary-head">

          <h3 class="page-header"> WalletR to Smartw Transfer

          </h3>

        </div>
      </div>

    </div>

    <div class="row-fluid">

      <div class="span12 tblover">

            <table class="table table-striped table-bordered" id="data-table">

                <thead>

                    <tr>

                        <th>Usercode</th>

                        <th>Name</th>

                        <th>Remian Wallet</th>

                        <th>Transfer Amount</th>

                        <th> Date </th>
                    </tr>

                </thead>

                <tbody id="data_table">

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