<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>



<?php if($this->session->flashdata('show_msg')!=''){?>
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <i class="icon-info-sign"></i><strong>
  <?=$this->session->flashdata('show_msg');?>
  </strong> </div>
<?php } ?>



<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Under Process (Dreem Student)
      	 <span class="pull-right">
        	<a href="<?=base_url()?>index.php/dreem_student/page/view/">
            	<button class="btn btn-round-min" type="button"><span><i class="icon-home"></i></span></button>
            </a>
        </span>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Dreem Student</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Under Process</li>
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
    	
      
        <table class="table table-striped table-bordered">
            	<thead>
                    <tr>
                        <th>Sr</th>
                        <th>Usercode</th>
                        <th>Name</th>
                        <th>Downline Of</th>
                        <th>Payment To</th>
                    </tr> 
                </thead>
                <tbody>
                	<?php for($i=0;$i<count($result);$i++){ 
						$row=$i+1;
						if($result[$i]['tot_payment']=='0'){
							$btn='Not Send';
						}else{
							$btn='<a href="'.base_url().'index.php/dreem_student/'.$this->uri->rsegment(1).'/payment_view/'.$result[$i]['usercode'].'">Payment View</a>';
							$btn.='&nbsp;&nbsp;&nbsp;&nbsp;<a class="approve" href="'.base_url().'index.php/dreem_student/'.$this->uri->rsegment(1).'/insert_tree/'.$result[$i]['usercode'].'">Approve</a>';
						}
                    	echo '<tr>
                        		<td>'.$row.'</td>
								<td>'.$result[$i]['usercode'].'</td>
                            	<td>'.$result[$i]['member_name'].'</td>
								<td>'.$result[$i]['upling_name'].' ('.$result[$i]['upling'].')</td>
                            	<td>'.$result[$i]['pay_name'].' ('.$result[$i]['payto'].')</td>
								<td>'.$btn.'</td>
                        	</tr>';
                     } ?>
               </tbody> 
               </table>    
        
  </div>
</div>




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
	






