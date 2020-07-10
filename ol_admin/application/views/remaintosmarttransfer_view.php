<script src="<?php echo base_url();?>asset/js/popup/js/lightbox.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/jquery.carouFredSel-5.5.0-packed.js"></script>
<script src="<?php echo base_url();?>asset/js/popup/js/jquery.magnific-popup.js"></script>
<link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/js/popup/css/lightbox.css">

<script>
	$(document).ready(function(e) {
        /////////////////////
		 $(document).on('click', '.open_popup', function (e) {
			var url 		= $(this).attr('href');
			e.preventDefault();
			$.magnificPopup.open({items: { src:url},type: 'ajax',modal: true,preloader: false}, 0);
		});
		
		$(document).on('click', '.popup-modal-dismiss', function (e) {
			e.preventDefault();
			$.magnificPopup.close();
		});
		////////////////////
    });
</script>

<script>
	$(document).ready(function(e) {
		////form submit Jquery///
		$('#frmsub').on('submit', function (e) {
			
			e.preventDefault();
			
			var form = $(this);
			var post_url = form.attr('action');
			$(".process-span").html("<i class='icon-spinner icon-spin'></i> processing......");
			
			$.ajax({
				type: 'post',url: post_url,data: $(this).serialize(),
				success: function (result) {	
					$(".process-span").html("");						
					$('.contain-tbl').html(result);
				}
			});
		});
		////End submit Jquery///

    //////////
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
	});

  function getwalletamount(wallet){
      uid = $("#user_code").val();
      $.ajax({
        type: 'post',url: '<?php echo base_url(); ?>index.php/reports/getremainwalletamt',data: {uid:uid,wallet:wallet},
        success: function (result) {  
          $('#remainamt').html('Remain Amount : $'+result);
          $('#transferamt').val(result);
        }
      });
  }
</script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>


<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">WalletR to Smartw Transfer Report</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Report</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">WalletR to Smartw Transfer</li>
    </ul>
  </div>
</div>
<?php
   		$date 		= date('01-m-Y', $first_dt[0]['dt']);
   		$end_date 	= date('t-m-Y',time());
 		$dt_show=date('F Y', strtotime($date));
		
 		while (strtotime($date) <= strtotime($end_date)) {
			
			$month_list[]=array(
				'month_name' => $dt_show,
				'month_value' => $date
			);	
 			
 			$date = date ("d-m-Y", strtotime("+1 month", strtotime($date)));
			$dt_show=date('F Y', strtotime($date));
 		}
		
   ?>
<div class="row-fluid">
  <div class="span12 list_status_div">
  		<form action="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/insert_transfer" method="post" >
            <table class="stat-table table table-stats table-striped table-sortable table-bordered">
                <tr>
                    <th>Member</th>
                    <td>
                        <input type="text" id="membername" value="" placeholder="Search Member" />
                        <input type="hidden" id="user_code" name="user_code" />
                    </td>
                </tr>

                <tr>
                    <th>Remain Wallet</th>
                    <td>
                      <select name="remainwallet" id="remainwallet" class="clssel" onchange="getwalletamount(this.value);">
                        <option value="">Select</option>	
                        <option value="1">W1</option>  
                        <option value="2">W2</option>  
                        <option value="3">W3</option>  
                        <option value="4">W4</option>  
                        <option value="5">W5</option>  
                        <option value="6">W6</option>  
                        <option value="7">W7</option>  
                      </select>
                      <div id="remainamt"></div>
                    </td>
                </tr>
                 <tr>
                    <th>Transfer Amount</th>
                    <td>
                        <input type="text" id="transferamt" name="transferamt" value="" placeholder="Transfer Amount" />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                    	<input type="submit" class="btn btn-success" value="Transfer" />
                        <span class="process-span"></span>
                    </td>
                </tr>
            </table>
        </form>
        
   </div>
</div>
<div class="row-fluid">
  <div class="span12 contain-tbl">
   
  </div>
</div>

<style>
	.process-span{
		color:#F00;
	}
</style>