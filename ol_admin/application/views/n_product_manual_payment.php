
<script>
	$(document).ready(function(e) {
		
		$(document).on('click','#btn_insert',function(e){
			var con=confirm('Confirm Payment ?');
			if(!con){
				return false;
			}
		});
		
    });
</script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Paid Product Manual Payment</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Paid Product</a><span class="divider"><i class="icon-angle-right"></i></span></li>
        <li><a href="#">Payment</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Manual Payment</li>
    </ul>
  </div>
</div>

  <?php if($this->session->flashdata('show_msg')!=''){ ?>
  	<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<i class="icon-info-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
	</div>
     <?php } ?>  
     
     <?php if($msg){?>
            <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="icon-info-sign"></i><strong><?=$msg?></strong>
            </div>     	
     <?php } ?>
     
	<br />
<div class="row-fluid">
  <div class="span6">
    	<form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/manual_payment" enctype="multipart/form-data">
        <input type="hidden" name="usercode" id="usercode" value="<?=$result['dt']['usercode']?>" />
        <?php if(!$result['vali']){?>	
          <div class="control-group">
            <label class="control-label">Search Member</label>
            <div class="controls">
            	<input type="text" name="membercode" id="membercode" class="span12" placeholder="Usercode, Username" />
                <span class="show_msg"><?=$result['msg']?></span>
            </div>
          </div>
          <?php } else{ ?>
          	<table class="table">
            	<tr>
                	<td width="30%">Usercode</td>
                    <td width="1%"></td>
                    <td width="69%"><?=$result['dt']['usercode']?>
                    
                    	</td>
                </tr>
                <tr>
                	<td>Username</td>
                    <td></td>
                    <td><?=$result['dt']['username']?></td>
                </tr>
                <tr>
                	<td>Name</td>
                    <td></td>
                     <td><?=$result['dt']['fname']?> <?=$result['dt']['lname']?></td>
                </tr>
                
                <tr>
                	<td>Select Product</td>
                    <td></td>
                     <td>
                     	<select id="product_type" name="product_type">
                            <option value="1">$15</option>
                            <option value="2">$100</option>
                        </select>
                     </td>
                </tr>
                
            </table>
          <?php } ?>
          <!------------------>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit" name="search" value="Y">Check Member</button>
            <?php if($result['vali']){?>
            	<button type="submit" class="btn btn-success btnsubmit" id="btn_insert" name="get_payment" value="Y">Insert Payment</button>
            <?php } ?>
          
          </div>
        </form>
  </div>
   <div class="span6">
   </div>
</div>




<style>
	.show_msg{
		color:#F00;
		font-weight:bold;
	}
</style>