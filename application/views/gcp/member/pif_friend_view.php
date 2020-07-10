<link rel="stylesheet" href="<?=base_url()?>asset/popover/jquery.webui-popover.min.css">
<script src="<?=base_url()?>asset/popover/jquery.webui-popover.min.js"></script>


<script>
	$(document).ready(function(e) {
         ///////////
			$('.show-pop-event').each(function(i,elem) {
			//webuiPopover
				var url=$(this).attr('href');
					$(this).webuiPopover({
					constrains: 'horizontal', 
					trigger:'click',
					multi: false,
					placement:'auto',
					type:'async',
					container: "body",
					url:url,
					cache:false,
					content: function(data){
						return data;
					}
				});
			//end webuiPopover
			});
		  //////////
    });
</script>

<script>
	$(document).on('submit','#frequest',function(e){
		
		var sel_user=$('#sel_user').val();
		
		
		if (typeof sel_user === "undefined") {
			alert('Please Select PIF Friend');
			$('#meberserch').focus();
    		return false;
		}
		
		e.preventDefault();
		var con=confirm("Are You Sour Send PIF");
		
		if(!con){
			return false;
		}
		
		
		
		var form = $(this);
		var post_url = form.attr('action');
		$(".submit_process").html("<i class='icon-spinner icon-spin'></i> processing......");
		$('.tr_submit_tr').hide();
		$.ajax({
			type: 'post',url: post_url,data: $(this).serialize(),
			success: function (result) {	
						
				var data	=	$.parseJSON(result);
				$('.pop-div-main').html(data['msg']);
				$('#request_tbl tbody').html(data['html']);
			}
		});
			
	});
</script>

<script>
$(document).on('click','.btnsearch', function (e) {
	search_member();	
});

$(document).on('change','#meberserch', function (e) {
	search_member();	
});

function search_member(){
		if($('#meberserch').val()==''){
			$('#meberserch').focus();
			return false;
		}
		
		var url='<?php echo MATRIX_BASE;?>pif_friend/find_member/'+$('#meberserch').val();
		
		$.ajax({url:url,success:function(result){	
		
			$('.tr_result').html(result);
			
        }});
}
</script>

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
    <h3 class="page-header">PIF For Friend 
    	<a style="margin-left:20px;" href="<?=MATRIX_BASE?>martix/dashboard/" class="pull-right"><span class="label label-success"><font style="font-weight:bold;letter-spacing:1px;">Dashboard</font></span></a>
    	<a href="<?=MATRIX_BASE?><?=$this->uri->rsegment(1)?>/extra_position_popup" class="pull-right show-pop-event"><span class="label label-success"><font style="font-weight:bold;letter-spacing:1px;font-size:16px;">PIF For Friend</font></span></a>
    </h3>
    <table class="table table-striped table-bordered" id="request_tbl">
      <thead>
        <tr>
          <th width="5%">No</th>
          <th width="15%">Friend Name</th>
          <th width="15%">Usercode</th>
          <th width="20%">Date</th>
          <th width="40%">Message</th>
        </tr>
      </thead>
      <tbody>
        <?=$html?>
      </tbody>
    </table>
  </div>
</div>

<style>
	.tot_m_14{
		background-color:#80cbc4 !important;	
	}
	.incomplete{
		background-color:#ffecb3;
	}
	.con_td_2{
		background-color:#80cbc4 !important;	
	}
	.con_td_4{
		background-color:#80cbc4 !important;	
	}
	.con_td_8{
		background-color:#80cbc4 !important;	
	}
	#txtmsg{
	resize:none;
	width:90%;
	height:140px;
}
.verified{
	font-weight:bold;
	color:#060;
}
#show_msg{
	font-weight:bold;
	color:#090;
	font-size:18px;
}
.webui-popover {
	width:700px !important;
	min-height:100px;
}
</style>
