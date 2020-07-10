<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<script src="<?php echo base_url(); ?>ol_admin/asset/js/jquery-ui-1.10.1.custom.min.js"></script>
<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">
<script>
	
	
	$(document).on('submit','#fsub',function(e){
		e.preventDefault();
		if($('#access_code').val()==''){
			$('#access_code').focus();	
			return false;
		}
		var form = $(this);
		var post_url = form.attr('action');
		$(".tblsubmit").html("<i class='icon-spinner icon-spin'></i> Sending......");
		$('.submit_tr').hide();
		$.ajax({
			type: 'post',url: post_url,data: $(this).serialize(),
				success: function (result) {	
					
					var data=$.parseJSON(result);
					if(data['vali']=='false'){
						$(".tblsubmit").html(data['msg']);
						$('.submit_tr').show();
					}
					else{
						$(".tblsubmit").html(data['msg']);
						$('.submit_tr').html('');
						get_listing();
						//$.magnificPopup.close();	
					}						
					
				}
		});
		
		//
		
	});
	
	
	
</script>
<style>
.mfp-content {
	width: 500px !important;
	background-color: #fff;
	padding: 15px;
	padding-bottom: 30px;
	margin: 20px auto;
	min-height:300px !important;
}
.fromclose {
	float: right;
	text-decoration: none;
	color: #333;
}
.right_fol {
	float: right;
	text-decoration: none;
	margin-right: 10px;
	color: #333;
}
.right_fol:hover {
	text-decoration: none;
}
.fromclose:hover {
	text-decoration: none;
	color: #333;
}
#h2_head {
	font-size: 20px;
}
.table_popup {
	font-size: 15px;
}
.search_txt{
	margin-left:10px;
	font-weight:bold;
}
</style>
<body>
 
<h2 id="h2_head"> Code<a class="popup-modal-dismiss fromclose" href="#" title="Close"><i class="icon-remove"></i></a></h2>
<form action="<?=MATRIX_BASE?>ad_request/access_code_insert" method="post" id="fsub">
	<input type="hidden" name="id" value="<?=$result[0]['id']?>" />
    <table class="table">
        <tr>
            <td width="24%">Name</td>
            <td width="1%">:</td>
            <td width="75%"><?=$result[0]['name']?></td>
        </tr>
        <tr>
            <td>Usercode</td>
            <td>:</td>
            <td><?=$result[0]['username']?></td>
        </tr>
        <tr>
            <td>Enter </td>
            <td>:</td>
            <td><input type="text" name="access_code" id="access_code" placeholder=" code" /></td>
        </tr>
        
        <tr class="submit_tr">
            <td></td>
            <td></td>
            <td><button type="submit" class="btn btn-primary btnsubmit">Submit</button></td>
        </tr>
        <tr>
            <td colspan="3" class="tblsubmit"></td>
        </tr>
        
    </table>
</form>
</body>
</html>
<style>
	.tblsubmit{
		color:#F00;
		font-size:14px;
	}
</style>
