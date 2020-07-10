
<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<?=$this->load->view('vma/top_banner')?>

<?php if($this->session->flashdata('show_msg')!=''){?>
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="icon-info-sign"></i><strong><?=$this->session->flashdata('show_msg');?></strong>
    </div>
<?php } ?>                    

<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Withdrawal (VMS)
      	<div class="pull-right">
        	<a href="<?=vma_base()?>dashboard/view"><button class="btn btn-round-min btn-success"><span><i class="icon-home"></i></span></button></a>
        </div>
      </h3>
    </div>
  </div>
</div>

<?php
	$pending=$this->comman_fun->get_table_data('vma_withdrawal',array('usercode'=>$this->session->userdata['logged_ol_member']['usercode'],'status'=>'process'));
?>

<div class="row-fluid">
  <div class="span12">
  		<?php if(isset($pending[0])){  ?>
        	<h5>One Withdrawal Request Is Aleardy Pending </h5>
            <table class="table">
            	<tr>
                	<td width="19%">Amount</td>
                    <td width="1%">:</td>
                    <td width="80%">$<?=number_format($pending[0]['amount'],2)?></td>
                </tr>
                <tr>
                	<td>Date</td>
                    <td>:</td>
                    <td><?=date('d-m-Y',strtotime($pending[0]['date_dt']))?></td>
                </tr>
                 <tr>
                	<td>description</td>
                    <td>:</td>
                    <td><?=$pending[0]['text_dt']?></td>
                </tr>
            </table>
        <?php } else { ?>
     	<form class="form-horizontal left-align" id="form2" method="post" action="<?=vma_base()?><?=$this->uri->rsegment(1)?>/insert" enctype="multipart/form-data">
        	<table class="table">
            	<tr>
                	<td width="15%">balance</td>
                    <td width="1%">:</td>
                    <td width="84%"> <input  value="$<?=number_format($payment['balance'],2)?>" class="span12" type="text" disabled="disabled"  /></td>
                </tr>
                
                
                
            	<tr>
                	<td width="15%">Amount</td>
                    <td width="1%">:</td>
                    <td width="84%"> <input id="amount" name="amount" value="<?=$result[0]['amount']?>" class="span12" type="number" step="0.01" placeholder="Enter Amount"/></td>
                </tr>
                
                <tr>
                	<td>Description</td>
                    <td>:</td>
                    <td>
                    	<textarea id="text_dt" name="text_dt" class="span12"  placeholder="Enter Description"><?=$result[0]['text_dt']?></textarea>
                    </td>
                </tr>
                
                
                 <tr>
                	<td></td>
                    <td></td>
                    <td><button type="submit" class="btn btn-primary btnsubmit">Submit</button></td>
                </tr>
                
            </table>
            
          
            
            
             
        </form>
        <?php } ?>
  
  </div>
</div>


<style>
	.switch_item_custom li{
		width:150px;
		height:100px;
	}
	.switch_item_custom li a{
		width:150px;
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
