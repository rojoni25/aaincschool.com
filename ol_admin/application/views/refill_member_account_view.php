<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">
<script>
	$(document).ready(function(e) {
		/////////////////////////
		 $(document).on('submit','#form2',function(e){
			
			if($('#membername').val()==''){
				alert('Please Enter Member');
				$('#membername').focus();
				return false;
			} 
			 
			var val=$('#refill_amount').val();
			if (!$.isNumeric(val)) {
				$('#refill_amount').focus();
   			 	alert('Invalid Amount !');
			 	return false;
			}
			var val_f=parseFloat(val)
			if(val_f <= 0){
				$('#refill_amount').focus();
				alert('Invalid Amount !');
			 	return false;
			}
			
			var con=confirm('Are You Sure You Want To Refill Account');
			if(!con){
				return false;
			}
		});
		////////////////////////	
        //////////
	   		$("#membername").autocomplete({
                        source:'<?php echo base_url();?>index.php/comman_controler/auto_camplate_active',
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
    });
</script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Refill Member Account</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">System </a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Refill Member Account</li>
    </ul>
  </div>
</div>

<?php if($this->session->flashdata('show_msg')!=''){?>
	<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<i class="icon-ok-sign"></i><strong><?=$this->session->flashdata('show_msg')?></strong>
	</div>
<?php } ?>

<div class="row-fluid">
  <div class="span12 list_status_div">
   		 <form class="form-horizontal left-align" id="form2" method="post" action="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>/insertrecord" enctype="multipart/form-data">
         	
            <div class="control-group">
            <label class="control-label">Search Member</label>
            <div class="controls">
              <input type="text" id="membername" name="membername" class="span12" value="<?=$_POST['membername']?>" placeholder="Search Member" />
    		  <input type="hidden" id="user_code" name="usercode" value="<?=$_POST['usercode']?>" name="usercode" />
            </div>
          </div>
         
          <div class="control-group">
            <label class="control-label">Enter Refill Amount (<font style="color:#F00;font-weight:bold;">$</font>)</label>
            <div class="controls">
              <input id="refill_amount" name="refill_amount" value="" class="span12  {validate:{required:true}}" type="text" placeholder="Enter Amount"/>
            </div>
          </div>
          
            <div class="control-group">
            <label class="control-label">Select Account</label>
            <div class="controls">
            	<select name="account_type" id="account_type" class="span12  {validate:{required:true}}">
                	<option value="main_balance">Company Wallet</option>
                    <option value="personal_wallet">Personal Wallet</option>
                </select>
            </div>
          </div>
         
          
          <div class="form-actions">
            <button type="submit" class="btn btn-primary btnsubmit"><strong>Refill Amount</strong></button>
            
          </div>
        </form>
   
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    <table class="table table-striped table-bordered" id="data-table">
      <thead>
        <tr>
          <th>Usercode</th>
          <th>Name</th>
          <th>Username</th>
          <th>Amount</th>
          <th>Date</th>
          <th>Wallet</th>
        </tr>
      </thead>
      <tbody>
      	<?php for($i=0;$i<count($result);$i++){
			$wallet=($result[$i]['ac_type']=='CW') ? "Company Wallet" : "Personal Wallet";
			?>
        	<tr>
            	<td><?=$result[$i]['usercode']?></td>
                <td><?=$result[$i]['fname']?> <?=$result[0]['lname']?></td>
                <td><?=$result[$i]['username']?></td>
                <td><?=$result[$i]['amount']?></td>
                <td><?=date('d-m-Y',$result[$i]['timedt'])?></td>
                <td><?=$wallet?></td>
            </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
