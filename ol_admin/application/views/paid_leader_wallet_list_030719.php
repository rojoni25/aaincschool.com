<script>

	$(document).ready(function(e) {

		var url2='<?php echo base_url()?>index.php/user/paid_leader_wallet_get';

        

    $.ajax({url:url2,success:function(result){

  

      $('#data_table').html(result);

    

    }});  

    });

	

</script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>





    <div class="row-fluid ">

      <div class="span12">

        <div class="primary-head">

          <h3 class="page-header">Paid Member Wallet

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

    

            <table class="table table-striped table-bordered" >

                <thead>

                    <tr>

                        <th>Usercode</th>

                        <th>Name</th>

                        <th>Referal Wallet</th>

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