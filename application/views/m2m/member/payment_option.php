<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Payment Receiving Option (DFSM)
      	
        <span class="pull-right"><a href="<?=base_url()?>index.php/m2m/page/view/"><button class="btn btn-round-min" type="button"><span><i class="icon-home"></i></span></button></a></span>
      
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">DFSM</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Set Receiving Option</li>
    </ul>
  </div>
</div>

<div class="row-fluid ">
      <div class="">
       		
		<?php
            if($contain[0]['video_url']!=''){
                echo '<div class="video_frm">';
                echo '<div class="inner_frm">';
                 if (strpos($contain[0]['video_url'], 'youtube') !== false || strpos($contain[0]['video_url'], 'slideshare') !== false)
                {
                    echo '<iframe width="100%" height="100%" src="'.$contain[0]['video_url'].'" frameborder="0" allowfullscreen></iframe>';
                }
                else{
                    echo '<video width="100%" height="100%" controls="controls"><source src="'.$contain[0]['video_url'].'" type="video/mp4"></video>';
                }
                echo '</div>';
                echo '</div>';
            }
     ?>
               
         
      </div>
      
        <div style="margin-top:30px;">
        	<div class="txtdiv"><?=$contain[0]['textdt']?></div>
            <div style="clear:both;overflow:hidden;"></div>
        </div>
    </div>
   <br /><br /> 

<div class="row-fluid">
  <div class="span12">
    	<form action="<?=base_url()?>index.php/m2m/<?=$this->uri->rsegment(1)?>/insertrecord/" method="post">
        	<input type="hidden" name="usercode" value="<?=$result[0]['usercode']?>" />
        
            <table class="table table-striped table-bordered">
                <tr>
                    <td width="19%">Account Name</td>
                    <td width="1%"></td>
                    <td width="80%"><input type="text" name="name" id="name" class="span12" value="" required="required" placeholder="Account Name" /></td>
                </tr>
                <tr>
                    <td>Account Detail</td>
                    <td></td>
                    <td><textarea id="account_detail" name="account_detail" class="span12" required="required" placeholder="Account Detail"></textarea></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td><button type="submit" class="btn btn-primary">Insert</button></td>
                </tr>   	
            </table>
        
        </form>    
        
  </div>
</div>

<div class="row-fluid ">
  <div class="span12">
   
    
     <div class="primary-head">
      <h3 class="page-header">Payment Receiving Option List</h3>
    </div>
      <table class="table table-striped table-bordered">
      	<thead>
            <tr>
	            <th>Sr</th>
    	        <th>Account Name</th>
        	    <th>Account Detail</th>
                <th>#</th>
            </tr>
        </thead>
    	<tbody>
        	<?php for($i=0;$i<count($result);$i++){ 
				$row=$i+1;
			?>
            	<tr>
	            	<td><?=$row?></td>
    	        	<td><?=$result[$i]['name']?></td>
        	    	<td><?=$result[$i]['account_detail']?></td>
                    <td><a href="<?=base_url()?>index.php/m2m/<?=$this->uri->rsegment(1)?>/delete/<?=$result[$i]['id']?>">Delete</a></td>
            	</tr>
            <?php } ?>
        </tbody>
        
    </table>
    
  </div>
</div>

 
<br /><br />

<style>
	.switch_item_custom li{
		width:180px;
		height:100px;
	}
	.switch_item_custom li a{
		width:180px;
		height:100px;
	}
	.switch_item_custom li p{
		font-size:20px !important;
		font-weight:bold;
		padding-top:20px;
		color:#FFF;
	}
	.switch_item_custom li a span {
		font-weight:bold;
		font-size:14px !important;
	}
	
	
</style>

<style>
.btncls{
	border:none;
}
.video_frm{
	width: 473px;
	height: 333px;
	overflow:hidden;
	margin:auto;
	background-image:url(<?=base_url();?>asset/images/cap_frm.png);
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}
.inner_frm{
	height: 291px;
	width: 390px;
	margin-top: 20px;
	margin-left: 40px;
}
.txtdiv{
	width:90%;
	position:relative;
	margin:auto;
}
.cls_head_btn{
	font-family: Arial, Helvetica, sans-serif;
}

@media  only screen and (max-width: 535px){
	.video_frm {
		width: 284px;
		height: 200px;
	}
	
	.inner_frm {
		height: 176px;
		width: 235px;
		margin-top: 12px;
		margin-left: 24px;
	}
}
@media  only screen and (max-width: 310px){
	.video_frm {
		width: 190px;
		height: 134px;
	}
	
	.inner_frm {
		height: 118px;
		width: 157px;
		margin-top: 8px;
		margin-left: 16px;
	}
}
</style> 
	
