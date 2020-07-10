<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<?php if(count($accept_result)>0) {?>
<div class="row-fluid">
  <div class="span12">
    <h3 class="page-header"><?=MATRIX_LLB?> Position
    	<div class="pull-right"><a href="<?=MATRIX_BASE?>member/dashboard/"><span class="label label-important">Dashboard</span> </a> </div>
    </h3>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Position</th>
          <th>Join Date</th>
          <th>Balance</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0;$i<count($accept_result);$i++){			
				$no=$i+1;	
				echo '<tr>
						<th>Position-'.$no.'</th>
						<th>'.date('d-m-Y',$accept_result[$i]['add_time']).'</th>
						<th>$'.number_format($accept_result[$i]['balance'],2).'</th>
					</tr>';
			}?>
      </tbody>
    </table>
  </div>
</div>
<?php } ?>
<style>
	.tot_m_14{
		background-color:#80cbc4 !important;	
	}
	.incomplete{
		background-color:#ffecb3;
	}
	.con_td_2{
		background-color:#80cbc4 !important;	
	}
	.con_td_4{
		background-color:#80cbc4 !important;	
	}
	.con_td_8{
		background-color:#80cbc4 !important;	
	}
	#txtmsg{
	resize:none;
	width:90%;
	height:140px;
}
.verified{
	font-weight:bold;
	color:#060;
}
#show_msg{
	font-weight:bold;
	color:#090;
	font-size:18px;
}
.webui-popover {
	width:700px !important;
	min-height:100px;
}
.btncustom{
	font-weight:bold;
}
</style>
