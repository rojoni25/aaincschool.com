
<script>
	$(document).ready(function(e) {
		
		$(document).on('click','#btn_insert',function(e){
			if($('#kdk_code').val()==''){
				$('#kdk_code').focus();
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
      <h3 class="page-header">KDK Code</h3>
    </div>
    <ul class="breadcrumb">
    
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">R-Matrix</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">KDK Code</li>
      
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
    	<form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/kdk_code" enctype="multipart/form-data">
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
                	<td width="30%">Enter KDK Code</td>
                    <td width="1%"></td>
                    <td width="69%"><input type="text" name="kdk_code" id="kdk_code" placeholder="Enter KDK Code" value="" /></td>
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
            			<a href="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/kdk_code"><button type="button" class="btn btn-primary"><strong>Search Member</strong></button></a>&nbsp;&nbsp;&nbsp;&nbsp;
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



	<table class="table">
    		<thead>
            	<tr>
                	<th>Usercode</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>KDK Code</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
            	<?php for($i=0;$i<count($result_list);$i++){?>
                	<tr>
                	<td><?=$result_list[$i]['usercode']?></td>
                    <td><?=$result_list[$i]['username']?></td>
                    <td><?=$result_list[$i]['name']?></td>
                    <td><?=$result_list[$i]['kdk_code']?></td>
                    <td><a href="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/remove_kdk_code/<?=$result_list[$i]['id']?>">Remove</a></td>
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