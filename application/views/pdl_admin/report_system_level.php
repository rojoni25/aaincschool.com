

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header"><?=$title?></h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">PDL</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Report</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active"><?=$title?></li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12 membertable">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th width="5%">Level</th>
          <th width="10%">Total Member</th>
         
        </tr>
      </thead>
      <tbody>
      	<?php
        	for($i=0;$i<count($level);$i++){
				$row=$i+1;
				echo '<tr>
					<td>'.$row.'</td>
					<td>'.$level[$i].'</td>
				</tr>';
			}
		?>
      </tbody>
    </table>
  </div>
</div>

