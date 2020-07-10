<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>







<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Gift Earned
      	
        <span class="pull-right">
        	<a href="<?=base_url()?>index.php/m2m/<?=$this->uri->rsegment(1)?>/gift_earned/"><i class="icon-arrow-left"></i></a>
        </span>
        
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">DFSM Admin</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Gift Earned</li>
    </ul>
  </div>
</div>

    <div class="row-fluid">
        <div class="span12">
            <table class="table">
            	<tr>
                	<td width="19%">Usercode</td>
                    <td width="1%">:</td>
                    <td width="80%"><?=$result[0]['usercode']?></td>
                </tr>
                <tr>
                	<td>Member Name</td>
                    <td>:</td>
                    <td><?=$result[0]['member_name']?></td>
                </tr>
                
                <tr>
                	<td>Downline Of</td>
                    <td>:</td>
                     <td><?=$result[0]['upling_name']?> <?=$result[0]['upling']?></td>
                </tr>
                
                <tr>
                	<td>Payment To</td>
                    <td>:</td>
                     <td><?=$result[0]['pay_name']?> <?=$result[0]['payto']?></td>
                </tr>
            </table>    
        </div>
    </div>

 <h3 class="page-header">Payment Detail</h3>
 
<div class="row-fluid">
  <div class="span12">
    	
      
        <table class="table">
            	<thead>
                	<tr>
                        <th>Sr</th>
                        <th>Subject</th>
                        <th>Payment Detail</th>


                    </tr>
                </thead>
                <tbody>
					<?php for($i=0;$i<count($list);$i++){ 
						$row=$i+1;
						echo '<tr>
								<td>'.$row.'</td>
								<td>'.$list[$i]['subject'].'</td>
								<td>'.$list[$i]['textdt'].'</td>
						</tr>';
                    } ?>
               </tbody> 
               </table>    
        
  </div>
</div>









