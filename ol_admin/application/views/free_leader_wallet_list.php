<script>

	$(document).ready(function(e) {

		/*var url2='<?php echo base_url()?>index.php/user/free_leader_wallet_get';

        

    $.ajax({url:url2,success:function(result){

  

      $('#data_table').html(result);

    

    }}); */ 
    $('#data-table').dataTable( {
      "bProcessing": true,
      "bServerSide": true,
      "bSort": true,
      "sAjaxSource": "<?=base_url()?>index.php/user/free_leader_wallet_get",
      "aLengthMenu": [[100, 200, 500, 1000], [100, 200, 500, 1000]],
      "iDisplayLength":100
    });

  });

	

</script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul><ul class="top-banner-free"></ul></div></div>





    <div class="row-fluid ">

      <div class="span12">

        <div class="primary-head">

          <h3 class="page-header">Free Member Wallet

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

                        <th>Usercode</th>

                        <th>Name</th>

                        <th>Smart Wallet</th>

                        <th>W1</th>

                        <th>W1 R</th>

                        <th>W2</th>

                        <th>W2 R</th>

                        <th>W3</th>

                        <th>W3 R</th>
                        
                        <th>W4</th>

                        <th>W4 R</th>
                        
                        <th>W5</th>

                        <th>W5 R</th>
                        
                        <th>W6</th>

                        <th>W6 R</th>
                        
                        <th>W7</th>

                        <th>W7 R</th>

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