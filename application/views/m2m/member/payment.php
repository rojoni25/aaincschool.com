<script>
	$(document).on('submit', '#frmsubmit', function(){
		if($('#page_key').val()==''){
			$('#page_key').focus();
			return false;	
		}
	});
</script>

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<?php if($this->session->userdata["ref"]["currect_add"]!=''){?>
<div class="marquee_div"> <span class="spm_llb">Just Joined</span>
  <marquee>
  <h3 class="maq_h3">
    <?=$this->session->userdata["ref"]["currect_add"]?>
  </h3>
  </marquee>
</div>
<?php } ?>


<?php if($this->session->flashdata('show_msg')!=''){?>
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <i class="icon-info-sign"></i><strong>
  <?=$this->session->flashdata('show_msg');?>
  </strong> </div>
<?php } ?>

<div class="row-fluid ">
      <div class="">
       		
		<?php
            if($contain[0]['video_url']!=''){
                echo '<div class="video_frm">';
                echo '<div class="inner_frm">';
                if (strpos($contain[0]['video_url'], 'youtube') !== false)
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
    <br />
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Payment Send To Member</h3>
      	
        
        
      	<table class="table table-striped table-bordered">
        	<tr>
            	<td width="19%">Usercode</td>
                <td width="1%">:</td>
                <td width="80%"><?=$payment_to[0]['usercode']?></td>
            </tr>
            
            <tr>
            	<td>Member Name</td>
                <td>:</td>
                <td><?=$payment_to[0]['fname']?> <?=$payment_to[0]['lname']?></td>
            </tr>
            
            <tr>
            	<td>Email Id</td>
                <td>:</td>
                <td><?=$payment_to[0]['emailid']?></td>
            </tr>
            
            <tr>
            	<td>Contact No.</td>
                <td>:</td>
                <td><?=$payment_to[0]['mobileno']?></td>
            </tr>
            <tr>
            	<td>Email</td>
                <td>:</td>
                <td><a href="<?php echo base_url();?>index.php/m2m/<?=$this->uri->rsegment(1)?>/send_email">Send Email</a></td>
            </tr>
        </table>
    </div>
  </div>
</div>

<div class="row-fluid">
      <div class="span6">
      	<h3 class="page-header">Send Payment Confirmmation (DFSM)</h3>
        <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/m2m/<?=$this->uri->rsegment(1)?>/payment_insert" enctype="multipart/form-data">
       		
          <div class="control-group">
            <label class="control-label">Subject</label>
            <div class="controls">
              <input id="subject" name="subject" value="" class="span12" type="text" placeholder="Enter Subject"/>
            </div>
          </div>
          <!------------------>
          <div class="control-group">
            <label class="control-label">Paymant Detail</label>
            <div class="controls">
              <textarea id="textdt" name="textdt" class="span12" placeholder="Enter Your Paymant Details Hear"></textarea>
            </div>
          </div>
          
           <div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
              <p class="msg_show"></p>
            </div>
          </div>
         
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit" onclick="return validation();">Send</button>
          </div>
        </form>
      </div>
      
      <div class="span6">
      		<h3 class="page-header">Payment</h3>
      		<table class="table table-striped table-bordered">
            	<thead>
                	<tr>
                    	<th>Sr</th>
                        <th>Name</th>
                        <th>Acount Detail</th>
                    </tr>
                </thead>
                <tbody>
                	<?php for($i=0;$i<count($payment_option);$i++){ 
						$row=$i+1;
                    	echo '<tr>
                        		<td>'.$row.'</td>
                            	<td>'.$payment_option[$i]['name'].'</td>
                            	<td>'.$payment_option[$i]['account_detail'].'</td>
                        	</tr>';
                     } ?>
                </tbody>
            </table>
      </div>
    </div>
	  <div style="clear:both;overflow:hidden;"></div>
    
    <div class="row-fluid">
      <div class="span12">
      		<table class="table table-striped table-bordered">
            	<thead>
                	<tr>
                    	<th>Sr</th>
                        <th>Subject</th>
                        <th>Payment Detail</th>
                    </tr>
                </thead>
                <tbody>
                	<?php for($i=0;$i<count($send_payment_list);$i++){ 
						$row=$i+1;
                    	echo '<tr>
                        		<td>'.$row.'</td>
                            	<td>'.$send_payment_list[$i]['subject'].'</td>
                            	<td>'.$send_payment_list[$i]['textdt'].'</td>
                        	</tr>';
                     } ?>
               </tbody> 
               </table>    
      </div>
    </div>
    <div style="clear:both;overflow:hidden;"></div>
    
    <div class="row-fluid">
      <div class="span12">
      
        <a href="<?=base_url()?>index.php/m2m/payment_option"><button class="btn btn-success"><strong>Set Your Payment Receiving</strong></button></a>
      </div>
    </div> 
    
    
     
   <br />
    
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
	