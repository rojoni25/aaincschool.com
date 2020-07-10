
    
    <script>
    	$(document).on('change','#month_name',function(e){
			var date=$('#month_name').val();
			var url='<?=vma_ad()?><?=$this->uri->rsegment(1)?>/get_unqulified_list/'+date;
			
			$.ajax({url:url,
				beforeSend: function(){
   				},
   				complete: function(){
   				},
				success:function(result){
					$('#data-table tbody').html(result);
				},
      			error: function( jqXHR, textStatus, errorThrown) {
         			alert(textStatus);
      			}
			});
			
		});
    </script>
    
  
    
	<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>
    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Unqulified Payment Report</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">VMA</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Unqulified Payment Report</li>
        </ul>
      </div>
    </div>
    
   <?php
   		$date 		= date('01-m-Y',$time[0]['timedt']);
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
      <div class="span12">
      <table class="table">
          <tr>
            <td width="20%">Select Month</td>
            <td width="1%">:</td>
            <td width="79%"><select name="month_name" id="month_name" class="clssel">
                <option value="">Select Month</option>
                <?php for($i=0;$i<count($month_list);$i++){
						$sel=($month_list[$i]['month_value']==$sel_date) ? "selected='selected'" : "";
					?>
                	<option <?=$sel?> value="<?=$month_list[$i]['month_value']?>"><?=$month_list[$i]['month_name']?></option>
                <?php } ?>
              </select></td>
          </tr>
          
          
          <tr>
            <td>Total Wallet</td>
            <td>:</td>
            <td><strong>$<?=number_format($tot,2)?></strong></td>
          </tr>
          
       
       
        </table>
      </div>
    </div>
   
   
   
    
    <div class="row-fluid">
      <div class="span12">
        <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
                <th>SRno.</th>
                <th>Payment To</th>
                <th>Unqulified User</th>
                <th>Amount</th>
                <th>Date</th>  
            </tr>
          </thead>
          <tbody>
         		
           </tbody>
        </table>
      </div>
    </div>

