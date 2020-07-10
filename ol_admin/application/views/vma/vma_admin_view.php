<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">
<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<script>
	$(document).ready(function(e) {
		/////////////////
		$("#membername").autocomplete({
                        source:'<?php echo base_url();?>index.php/comman_controler/auto_camplate',
                        minLength:1,selectFirst: true,selectOnly: true,
						select: function(event, ui) {
						event.preventDefault();
							$(this).parent().children('#user_code').val(ui.item.value);
							//$('#category_code').val(ui.item.value);
							$('#name').val(ui.item.label);},
						
						focus: function(event, ui) {
							event.preventDefault();
							$(this).parent().children('#user_code').val(ui.item.value);
							$(this).val(ui.item.label);
							$(this).removeClass('loading');},
						change: function(event,ui){
							if(ui.item==null){
								$(this).val((ui.item ? ui.item.id : ""));
								$(this).parent().children('#user_code').val('');
								$(this).removeClass('loading');}
							else{
								$(this).removeClass('loading');}},
								search: function(){
								  $(this).addClass('loading');
									},
        				open: function(){
							$(this).removeClass('loading');
							}
              });
	   /////auto///////	
	   
	   	$(document).on('click', '#btn_find', function (e) {
			var value=$('#user_code').val();
			var url='<?=vma_base()?><?=$this->uri->rsegment(1)?>/vma_admin/'+value;
			window.location.href=url;
		});
		
		$(document).on('submit', '#frm', function (e) {
			var amount	=	$('#amount').val();
			if(amount==''){
				return false;
			}
			var Vamount=parseFloat(amount);
			
			if(Vamount < 1 ){
				$('#amount').focus();
				return false;
			}
			
		});
		
	});
	
</script>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">VMA Admin
        <div class="pull-right"> 
          <button class="btn btn-round-min btn-success"><span><i class="icon-home"></i></span></button>
          </a> </div>
      </h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">VMA</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Admin</li>
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
<div class="row-fluid">
  <div class="span12">
    <?php if(!isset($result[0])) { ?>
    <table class="table">
      <tr>
        <td width="19%">Search Member</td>
        <td width="1%"></td>
        <td width="80%"><input type="text" id="membername" value="" placeholder="Member Name, Code" class=" span12 {validate:{required:true}}" />
          <input type="hidden" id="user_code" name="user_code" /></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td><button type="button" id="btn_find" class="btn btn-primary btnsubmit">Check</button></td>
      </tr>
    </table>
    <?php }else { ?>
    <form action="<?=vma_base()?><?=$this->uri->rsegment(1)?>/add_admin/" method="post" id="frm">
      <input type="hidden" name="usercode"  value="<?=$result[0]['usercode']?>" />
      <table class="table">
        <tr>
          <td width="19%">Member Name</td>
          <td width="1%"></td>
          <td width="80%"><?=$result[0]['fname']?>
            <?=$result[0]['lname']?></td>
        </tr>
        <tr>
          <td>Usercode</td>
          <td></td>
          <td><?=$result[0]['usercode']?></td>
        </tr>
        <tr>
          <td>Username</td>
          <td></td>
          <td><?=$result[0]['username']?></td>
        </tr>
        <tr>
          <td>Email Id</td>
          <td></td>
          <td><?=$result[0]['emailid']?></td>
        </tr>
        
        <tr>
          <td></td>
          <td></td>
          <td>
          	<?php if($check) {?>
        		<h5>Member Is Exist</h5>    	
            <?php } else {?>
          		<button type="submit"  class="btn btn-primary btnsubmit">Add</button>
            <?php } ?>
           </td>
        </tr>
      </table>
    </form>
    <?php } ?>
  </div>
</div>
<div class="row-fluid ">
  <div class="span12">
  	
    <table class="table">
    	<thead>
            <tr>
                <th>Sr.No</th>
                <th>Username</th>
                <th>Usercode</th>
                <th>Name</th>
                <th>Email Id</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
        	<?php for($i=0;$i<count($list);$i++){ 
				$row=$i+1;
			?>
                    <tr>
                        <td><?=$row?></td>
                        <td><?=$list[$i]['usercode']?></td>
                        <td><?=$list[$i]['username']?></td>
                        <td><?=$list[$i]['name']?></td>
                        <td><?=$list[$i]['emailid']?></td>
                        <td><a href="<?=vma_base()?><?=$this->uri->rsegment(1)?>/delete_admin/<?=$list[$i]['id']?>">Delete</a></td>
                    </tr>
            <?php } ?>
        </tbody>
    </table>
  </div>
</div>  
