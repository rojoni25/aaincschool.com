<script>

	$(document).ready(function(e) {

		var url2='<?php echo base_url()?>index.php/user/paid_leader_wallet_get';

        var urltemp='<?php echo base_url()?>index.php/user/add50toReverseWallets';

    // $.ajax({url:url2,success:function(result){

  

    //   $('#data_table').html(result);

    

    // }});  
     $('#data-table').dataTable( {
      "bProcessing": true,
      "bServerSide": true,
      "bSort": true,
      "sAjaxSource": url2,
      "aLengthMenu": [[100, 200, 500, 1000], [100, 200, 500, 1000]],
      "iDisplayLength":100,
	   "fnRowCallback": function (row, data, displayNum, displayIndex, dataIndex) {
	       $("td:eq(5)",row).css("background-color","#FFFFE0 !important");
	       $("td:eq(7)",row).css("background-color","#FA8072 !important");
	       $("td:eq(9)",row).css("background-color","#87CEFA !important");
	        $("td:eq(11)",row).css("background-color","#FFFFE0 !important");
	       $("td:eq(13)",row).css("background-color","#FA8072 !important");
	       $("td:eq(15)",row).css("background-color","#87CEFA !important");
	       $("td:eq(17)",row).css("background-color","#FFFFE0 !important");
		    if(data[2]<3){
		        $("td:eq(2)",row).css("color","rgba(255, 0, 0, 1) !important");
		        

		    }
		}
    });


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
        <div class="span12">
          <ul class="top-banner"><ul class="top-banner top_amount_list">
			<li><a href="#">&Sigma; W1:  <span><?=$w1Total?></span></a></li>
			<li><a href="#">&Sigma; W1R:  <span><?=$w1rTotal?></span></a></li>
			<li><a href="#">&Sigma; W2:  <span><?=$w2Total?></span></a></li>
			<li><a href="#">&Sigma; W2R:  <span><?=$w2rTotal?></span></a></li>
			<li><a href="#">&Sigma; W3:  <span><?=$w3Total?></span></a></li>
			<li><a href="#">&Sigma; W3R:  <span><?=$w3rTotal?></span></a></li>
			<li><a href="#">&Sigma; W4:  <span><?=$w4Total?></span></a></li>
			<li><a href="#">&Sigma; W4R:  <span><?=$w4rTotal?></span></a></li>
			<li><a href="#">&Sigma; W5:  <span><?=$w5Total?></span></a></li>
			<li><a href="#">&Sigma; W5R:  <span><?=$w5rTotal?></span></a></li>
			<li><a href="#">&Sigma; W6:  <span><?=$w6Total?></span></a></li>
			<li><a href="#">&Sigma; W6R:  <span><?=$w6rTotal?></span></a></li>
			<li><a href="#">&Sigma; W7:  <span><?=$w7Total?></span></a></li>
			<li><a href="#">&Sigma; W7R:  <span><?=$w7rTotal?></span></a></li>
		
			<div style="clear:both;overflow:hidden;"></div>
		</ul></ul>
		</div>

    </div>

    

   

    

    <div class="row-fluid">

      <div class="span12 tblover">

    

            <table class="table table-striped table-bordered" id="data-table" >

                <thead>

                    <tr>

                        <th>Usercode</th>

                        <th>Name</th>
                        <th>Free Ref Count</th>
                        <th>Ref Count</th>
                        <th>Ref Wallet</th>

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