<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Join Request Approve (DFSM)
      
      		<span class="pull-right">
        	<a href="<?=base_url()?>index.php/m2m/ad_dashboard/">
            	<button class="btn btn-round-min" type="button"><span><i class="icon-home"></i></span></button>
            </a>
        </span>
      
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">DFSM Admin</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Join Request</li>
    </ul>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    	<form action="<?=base_url()?>index.php/m2m/<?=$this->uri->rsegment(1)?>/request_approve/" method="post">
        	<input type="hidden" name="usercode" value="<?=$result[0]['usercode']?>" />
        
	        <table class="table">
        	<tr>
            	<td width="19%">Usercode</td>
                <td width="1%"></td>
                <td width="80%"><?=$result[0]['usercode']?></td>
            </tr>
            <tr>
            	<td>Name</td>
                <td></td>
                <td><?=$result[0]['fname']?> <?=$result[0]['lname']?></td>
            </tr>
            <tr>
            	<td>Username</td>
                <td></td>
                <td><?=$result[0]['username']?></td>
            </tr>
            <tr>
            	<td>Email ID</td>
                <td></td>
                <td><?=$result[0]['emailid']?></td>
            </tr>
            <tr>
            	<td>Contact No.</td>
                <td></td>
               <td><?=$result[0]['mobileno']?></td>
            </tr>
            
            <tr>
            	<td>Downline Of</td>
                <td></td>
               <td>
               		<select id="downline_of" name="downline_of">
                   		<?php for($i=0;$i<count($member);$i++) {?>
                        	<option value="<?=$member[$i]['usercode']?>"><?=$member[$i]['fname']?> <?=$member[$i]['lname']?></option>
                        <?php } ?>
                    </select>
               </td>
            </tr> 
            <tr>
            	<td></td>
                <td></td>
               	<td>
                	<button type="submit" class="btn btn-primary">Approve Request</button>
                </td>
            </tr>   	
        </table>
        
        </form>    
        
  </div>
</div>









