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
		});
    </script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>


<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Join Member</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Report</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Join Member</li>
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
  		<form action="<?=base_url()?>index.php/<?=$this->uri->segment(1)?>/join_month_date_wise" method="post" id="frmsub">
            <table class="stat-table table table-stats table-striped table-sortable table-bordered">
                <tr>
                    <td>Type</td>
                    <td>:</td>
                    <td>
                        <select id="report_type" name="report_type">
                            <option value="join">Join Member</option>
                            <option value="active">Active Member</option>
                             <option value="renew_member">Renew-Member</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Month</td>
                    <td>:</td>
                    <td>
                    <select name="month_name" id="month_name" class="clssel">
                    <option value="">Select</option>	
                    <?php for($i=0;$i<count($month_list);$i++){?>
                    <option value="<?=$month_list[$i]['month_value']?>"><?=$month_list[$i]['month_name']?></option>
                    <?php } ?>
                    </select>
                    </td>
                    </tr>
                    
                    
                    <tr>
                    <td></td>
                    <td></td>
                    <td>
                    	<input type="submit" class="btn btn-success" value="Get Report" />
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