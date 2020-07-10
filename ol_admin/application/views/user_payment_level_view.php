<script>
	$(document).ready(function(e) {
        $('#data-table').dataTable({
		});
		$(document).on('click', '.btngoto', function (e) {
			var value 		= $('#pay_level').val();
			if(value==''){
				$('#pay_level').focus();
				return false;
			}
			else{
				window.location.href='<?=base_url()?>index.php/user_payment_level/view/'+value;
			}
		});
    });
</script>

<div class="row-fluid ">  <div class="span12">    <ul class="top-banner"></ul></div></div>


    <div class="row-fluid ">
      <div class="span12">
        <div class="primary-head">
          <h3 class="page-header">Member Payment Level</h3>
        </div>
        <ul class="breadcrumb">
          <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
          <li><a href="#">System</a><span class="divider"><i class="icon-angle-right"></i></span></li>
          <li class="active">Renewed Membership</li>
        </ul>
      </div>
    </div>
   
      <div>
    		<input type="text" value="" id="pay_level" placeholder="Enter Payment Level" />
            <button class="btn btn-info btngoto" style="margin-top:-11px;">Go</button>
      </div> 
    
    <div class="row-fluid">
      <div class="span12 tblover">
      		
         <table class="table table-striped table-bordered" id="data-table">
          <thead>
            <tr>
              <th width="10%">Usercode</th>
              	<th>Name</th>
             	<th>Username</th>
              	<th>Email Id</th>
                <th>Payment Level</th>
               
            </tr>
          </thead>
          <tbody>
          <?=$html?>
           </tbody>
        </table>
      </div>
    </div>

<style>
	.tblover{
		overflow-x: auto;
	}
</style>