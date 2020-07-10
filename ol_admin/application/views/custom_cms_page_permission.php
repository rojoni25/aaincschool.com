
<script>
	$(document).ready(function(e) {
		
		$(document).on('click','#btn_insert',function(e){
			var con=confirm('Are You Sore get Permission');
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
      <h3 class="page-header">Custom Page Permission</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">CMS</a><span class="divider"><i class="icon-angle-right"></i></span></li>
        <li><a href="#">Custom Page</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Permission</li>
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
    	<form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/custom_page_permission/<?=$result[0]['pagecode']?>" enctype="multipart/form-data">
        <input type="hidden" name="usercode" id="usercode" value="<?=$search['dt']['usercode']?>" />
        <input type="hidden" name="pagecode" id="pagecode" value="<?=$result[0]['pagecode']?>" />
        <?php if(!$search['vali']){?>	
        
         <div class="control-group">
            <label class="control-label">Page Name</label>
            <div class="controls">
            	<input type="text"  class="span12" value="<?=$result[0]['pagename']?>" readonly="readonly" />
                
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label">Search Member</label>
            <div class="controls">
            	<input type="text" name="membercode" id="membercode" class="span12" placeholder="Usercode, Username" />
                <span class="show_msg"><?=$search['msg']?></span>
            </div>
          </div>
          <?php } else{ ?>
          	<table class="table">
            	<tr>
                	<td width="30%">Page Name</td>
                    <td width="1%"></td>
                    <td width="69%"><?=$result[0]['pagename']?></td>
                </tr>
            	<tr>
                	<td width="30%">Usercode</td>
                    <td width="1%"></td>
                    <td width="69%"><?=$search['dt']['usercode']?></td>
                </tr>
                <tr>
                	<td>Username</td>
                    <td></td>
                    <td><?=$search['dt']['username']?></td>
                </tr>
                <tr>
                	<td>Name</td>
                    <td></td>
                     <td><?=$search['dt']['fname']?> <?=$result['dt']['lname']?></td>
                </tr>
            </table>
          <?php } ?>
          <!------------------>
          <div class="form-actions">
          
            <?php if($search['vali']){?>
            	<button type="submit" class="btn btn-success btnsubmit" id="btn_insert" name="get_permission" value="Y">Get Permission</button>
                <a href="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/custom_page_permission/<?=$result[0]['pagecode']?>"><button type="button" class="btn btn-info">Refresh</button></a>
            <?php } else{?>
            	  <button type="submit" class="btn btn-primary btnsubmit" name="search" value="Y">Check Member</button>
            <?php } ?>
          
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
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
            	<?php for($i=0;$i<count($result_list);$i++){?>
                	<tr>
                	<td><?=$result_list[$i]['usercode']?></td>
                    <td><?=$result_list[$i]['username']?></td>
                    <td><?=$result_list[$i]['name']?></td>
                    <td><a href="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/remove_permission/<?=$result_list[$i]['id']?>/<?=$result[0]['pagecode']?>">Remove</a></td>
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