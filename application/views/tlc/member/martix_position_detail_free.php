<script>
	$(document).on('change','#multi_position',function(e){
			var value	=	$(this).val();
			window.location.href='<?php echo MATRIX_BASE?><?php echo $this->uri->rsegment(1)?>/position_detail/'+value;
		});
</script>

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <h3 class="page-header">Position Details 
        <a href="<?=MATRIX_BASE?>page/view/?page_key=tlc" class="pull-right"><span class="label label-success"><font style="font-weight:bold;letter-spacing:1px;">Dashboard</font></span></a>
        <a style="margin-right:15px;" href="<?=MATRIX_BASE?>martix_position_free/view/" class="pull-right"><span class="label label-important"><font style="font-weight:bold;letter-spacing:1px;">Back</span></font></a>
        </h3>
    <table class="table table-striped table-bordered">
      <tr>
        <td width="24%">Position</td>
        <td width="1%">:</td>
        <td width="75"><?php if(count($position)>1) {?>
          <select id="multi_position">
            <?php for($i=0;$i<count($position);$i++){
                        			$pos=$i+1;
                        			$sel=($position[$i]['idcode']==$this->uri->segment(3)) ? "selected='selected'" : "";
                        			echo '<option '.$sel.' value="'.$position[$i]['idcode'].'">Position :'.$pos.'</option>';
                        	} ?>
          </select>
          <?php } else{
			 	echo count($position);
			 }?></td>
      </tr>
      <?php if(isset($member)){ ?>
      <tr>
        <td>Total Member</td>
        <td></td>
        <td><?=count($member)?></td>
      </tr>
      <?php } ?>
    </table>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <h3 class="page-header">Position Details </h3>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0;$i<count($member);$i++){
				$no=$i+1;
				echo '<tr>
            			<th>'.$no.'</th>
            			<th>'.$member[$i]['name2'].'</th>
            		 </tr>';
			}?>
      </tbody>
    </table>
  </div>
</div>

<?php
	/* Set locale to Dutch */
	setlocale(LC_ALL, 'nl_NL');

	/* Output: vrijdag 22 december 1978 */
	
	echo strftime("%A %e %B %Y", mktime(0, 0, 0, 12, 22, 1978));

	/* try different possible locale names for german as of PHP 4.3.0 */
	$loc_de = setlocale(LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge');
	
	echo "Preferred locale for german on this system is '$loc_de'";
?>

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
</style>
