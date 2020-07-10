<script src="<?=base_url();?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url();?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url();?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url();?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url();?>asset/js/TableTools.js"></script>
<script>
	$(document).ready(function(e) {
		
		$('#data-table').dataTable({
					"bProcessing": true,
					"iDisplayLength": 25,
					"responsive": true,
					"bDestroy": true
		});
		
		$(document).on('click','#btn_insert',function(e){
			if($('#access_code').val()==''){
				$('#access_code').focus();
				return false;
			}
			var con=confirm('Are You Insert');
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
      <h3 class="page-header"><?=MATRIX_LLB?> Code
      
      	<span class="pull-right">
        	<a href="<?=MATRIX_BASE?>ad_dashboard/dashboard" class="back_btn"><span class="label label-success">Dashboard</span></a>
        </span>	
      </h3>
    </div>
    <ul class="breadcrumb">
    
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#"><?=MATRIX_LLB?></a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active"> Code</li>
      
    </ul>
  </div>
</div>

  <?php if($this->session->flashdata('show_msg')!=''){ ?>
  	<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<i class="icon-info-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
	</div>
     <?php } ?>  
	<br />
<div class="row-fluid">
  <div class="span6">
    	<form class="form-horizontal left-align" id="form2" method="post" action="<?php echo MATRIX_BASE;?><?=$this->uri->rsegment(1)?>/access_code" enctype="multipart/form-data">
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
                	<td width="30%">Enter  Code</td>
                    <td width="1%"></td>
                    <td width="69%"><input type="text" name="access_code" id="access_code" placeholder="Enter  Code" value="" /></td>
                </tr>
                
                <tr>
                	<td width="30%">Insert Join Request</td>
                    <td width="1%"></td>
                    <td width="69%"><input type="checkbox" name="join_request" id="join_request" value="Y" /></td>
                </tr>
                
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
            </table>
          <?php } ?>
          <!------------------>
          <div class="form-actions">
            
            <?php if($result['vali']){?>
            			<a href="<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/access_code"><button type="button" class="btn btn-primary"><strong>Search Member</strong></button></a>&nbsp;&nbsp;&nbsp;&nbsp;
  		        	  	<button type="submit" class="btn btn-success btnsubmit" id="btn_insert" name="get_permission" value="Y"><strong>Insert Code</strong></button> 
          		    	  
            <?php }else{
				echo '<button type="submit" class="btn btn-primary btnsubmit" name="search" value="Y">Check Member</button>';
			} ?>
          
          </div>
        </form>
  </div>
   <div class="span6">
   </div>
</div>



	<table class="table table-striped table-bordered dataTable" id="data-table">
    		<thead>
            	<tr>
                	<th>Usercode</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th> Code</th>
                   
                </tr>
            </thead>
            <tbody>
            	<?php for($i=0;$i<count($result_list);$i++){?>
                	<tr>
                	<td><?=$result_list[$i]['usercode']?></td>
                    <td><?=$result_list[$i]['username']?></td>
                    <td><?=$result_list[$i]['name']?></td>
                    <td><?=$result_list[$i]['access_code']?></td>
                   
                </tr>
                <?php } ?>
            </tbody>	
              
            </table>


<style>
	.show_msg{
		color:#F00;
		font-weight:bold;
	}
</style>