<script>
	$(document).ready(function(e) {
		
		$(document).on('click','#btn_insert',function(e){
			var con=confirm('Are You Sore get Permission');
			if(!con){
				return false;
			}
		});
		
		$(document).on('change','#usercode_sel',function(e){
			var url='<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/blog_permission/'+$(this).val();
			window.location.href=url;
		});
		
		$(document).on('click','.remove_per',function(e){
			e.preventDefault();
			var url=$(this).attr('href');
			var tr=$(this).closest('tr');
			$.ajax({url:url,success:function(result){
				tr.remove();
			}});
		});
		
		
		
    });
</script>

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Product Blog Permission</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Paid Product</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Product</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Blog Permission</li>
    </ul>
  </div>
</div>
<?php if($this->session->flashdata('show_msg')!=''){ ?>
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <i class="icon-info-sign"></i><strong>
  <?=$this->session->flashdata('show_msg')?>
  </strong> </div>
<?php } ?>
<br />
<div class="row-fluid">
  <div class="span6">
    <?php if(!isset($result[0])){?>

    <table class="table">
     
        <tr>
          <td width="30%">Select Permission</td>
          <td width="1%"></td>
          <td width="69%"><select name="usercode_sel" id="usercode_sel">
              <option value="">Select</option>
              <?php for($i=0;$i<count($member);$i++){
                        echo '<option value="'.$member[$i]['usercode'].'">'.$member[$i]['name'].'</option>';
                 }?>
            </select></td>
        </tr>
      
      </table>
    <?php } else{ ?>
    <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/blog_permission_insert" enctype="multipart/form-data">
      <input type="hidden" name="usercode" id="usercode" value="<?=$result[0]['usercode']?>" />
      <table class="table">
        <tr>
          <td width="30%">Usercode</td>
          <td width="1%"></td>
          <td width="69%"><?=$result[0]['usercode']?></td>
        </tr>
        <tr>
          <td>Username</td>
          <td></td>
          <td><?=$result[0]['username']?></td>
        </tr>
        <tr>
          <td>Name</td>
          <td></td>
          <td><?=$result[0]['name']?></td>
        </tr>
        <tr>
          <td>Get Permission</td>
          <td></td>
          <td><select name="permission_to" id="permission_to" required>
              <option value="">Select</option>
              <?php for($i=0;$i<count($member);$i++){
                                echo '<option value="'.$member[$i]['usercode'].'">'.$member[$i]['name'].'</option>';
                            }?>
            </select></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td><button type="submit" class="btn btn-success btnsubmit" id="btn_insert" name="get_permission" value="Y">Get Permission</button>
          	  <a href="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/blog_permission/"><input type="button" class="btn btn-danger" value="Refresh" /></a>	
          </td>
        </tr>
      </table>
    </form>
    <?php } ?>
    <!------------------> 
    
  </div>

</div>

  <?php if(isset($permission[0])){?>
 		<table class="table">
  <thead>
    <tr>
      <th width="15%">Usercode</th>
      <th width="30%">Name</th>
      <th width="25%">Remove</th>
    </tr>
  </thead>
  <tbody>
    <?php for($i=0;$i<count($permission);$i++){?>
    <tr>
      <td><?=$permission[$i]['permission_to']?></td>
      <td><?=$permission[$i]['name']?></td>
      <td><a class="remove_per" href="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/remove_blog_permission/<?=$permission[$i]['id']?>">Remove</a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
  <?php } ?>


<style>
	.show_msg{
		color:#F00;
		font-weight:bold;
	}
</style>
