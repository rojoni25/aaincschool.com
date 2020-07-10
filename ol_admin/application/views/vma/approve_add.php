<?php
	if(count($upling_chain)>3){
		$next_top=$next_level[count($next_level)-3]['usercode'];
	}else{
		$next_top=1;
	}
?>

<script src="<?php echo base_url();?>asset/js/popup/js/lightbox.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/jquery.carouFredSel-5.5.0-packed.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/jquery.magnific-popup.js"></script>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/js/popup/css/lightbox.css">
<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">

<script>
	$(document).on('click', '.open_popup', function (e) {
			var url='<?php echo vma_base();?>tree_pop/tree_popup/<?=$next_top?>';
			e.preventDefault();
			$.magnificPopup.open({items: { src:url},type: 'ajax',modal: true,preloader: false}, 0);
		});
		
		$(document).on('click', '.popup-modal-dismiss', function (e) {
			e.preventDefault();
			$.magnificPopup.close();
		});
</script>



<script>
	$(document).ready(function(e) {
        
    });
	
	$(document).on('change','#downline',function(e){
		if($(this).val()=='select_postion'){
			$('.select_tr').removeClass('dis_none');	
		}else{
			$('.select_tr').addClass('dis_none');
		}
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
      <h3 class="page-header">VMA Member Approve</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">VMA</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Member Approve</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span12">
    <form action="<?=vma_base()?><?=$this->uri->rsegment(1)?>/approve_insert" method="post">
        <input type="hidden" name="request_code" value="<?=$result['request_code']?>" />
        <input type="hidden" name="next_postion" value="<?=$position_user?>" />
        <input type="hidden" name="selected_user_code" id="selected_user_code" value="" />
      <table class="table">
       
        
        <tr>
          <td width="19%">Downline Of</td>
          <td width="1%">:</td>
          <td width="80%">
                <select name="downline" id="downline" required="required">
                    <option value="next_position">Next Available Position</option>
                    <option value="select_postion">Select Postion</option>
                </select>
            </td>
        </tr>
        
         <tr>
          <td>Next Postion</td>
          <td>:</td>
          <td>
          		<?php for($i=0;$i<count($upling_chain);$i++){
						$divider=($i<count($upling_chain)-1) ? " <i class='icon-angle-right'></i> " : "";
						echo  $upling_chain[$i]['name'].' '.$divider	;
					} ?>
          </td>
        </tr>
        
         <tr class="select_tr dis_none">
          <td>Select Postion</td>
          <td>:</td>
          <td><a href="#" class="open_popup"><span class="label label-success">Select</span></a>
          		<p id="select_position_chain"></p>
          </td>
        </tr>
        
        <tr>
          <td width="19%">Usercode</td>
          <td width="1%">:</td>
          <td width="80%"><?=$result['usercode']?></td>
        </tr>
        <tr>
          <td>Username</td>
          <td>:</td>
          <td><?=$result['username']?></td>
        </tr>
        <tr>
          <td>Member</td>
          <td>:</td>
          <td><?=$result['name']?></td>
        </tr>
        
        <tr>
          <td></td>
          <td></td>
          <td><button type="submit" class="btn btn-success">Submit</button></td>
        </tr>
        
        
      </table>
    </form>
  </div>
</div>

<style>
	.dis_none{
		display:none;
	}
	.spna-bold{
		color:#F00;
		font-weight:bold;
	}
</style>





