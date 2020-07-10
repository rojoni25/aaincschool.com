<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<style>
.mfp-content {
	width: 500px !important;
	background-color: #fff;
	padding: 10px;
	padding-bottom: 30px;
	margin: 10px auto;
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
	font-size: 17px;
	text-align: center;
}
.table_popup{
	font-size:15px;
}
</style>
<body>
	<h2>
  <h2 id="h2_head">
    Mesaage To Admin
    <a class="popup-modal-dismiss fromclose" href="#" title="Close"><i class="icon-remove"></i></a></h2>
</h2>
	<form class="form-horizontal left-align" id="frm_send" method="post" action="<?php echo base_url();?>index.php/upgrade_membership/insertrecord_message" enctype="multipart/form-data">
    
	<table width="90%">
    	<tr>
        	<td><input type="text" class="txtbox" name="txtsubject" id="txtsubject" placeholder="Subject" /></td>
        </tr>
        <tr>
        	<td><textarea name="txtmsg" id="txtmsg" class="txtarea" placeholder="Message"></textarea></td>
           
        </tr>
    	<tr class="tblsubmit">
        	<td><input type="submit" class="btnlink" value="Send" /></td>
           
        </tr>
    </table>
    </form>
</body>
</html>

<style>
.btnlink{
	text-decoration:none;
	padding: 12px 60px;
	background-color:#B06700;
	color:#FFF;
	font-size:18px;
}
.btnlink:hover{
	text-decoration:none;
}
.leftd {
	float: left;
	width: 48%;
	position: relative;
	overflow: hidden;
}
.rightd {
	float: right;
	width: 48%;
	position: relative;
	overflow: hidden;
}
.linethro {
	text-decoration: line-through;
}
.textcur{
		cursor:copy !important;
	}
	.btncls{
		border:none;
		margin-right:5px;
	}
	.thumdiv{
		width:250px;
		height:240px;
		float:left;
		margin-left:10px;
		margin-bottom:10px;
	}
	.txtbox{
		height:27px;
		width:100%;
		background:none;
		border:#999 solid 1px;
	}
	.txtarea{
		height:127px;
		width:100%;
		background:none;
		border:#999 solid 1px;
	}
</style>

<script>
	$(document).ready(function(e) {
       ////form submit Jquery///
				
    				$('form#frm_send').on('submit', function (e) {
							
							 e.preventDefault();
							if($('#txtsubject').val()==''){ $('#txtsubject').focus(); return false; }
							if($('#txtmsg').val()==''){ $('#txtmsg').focus();  return false; }
							var form = $(this);
							var post_url = form.attr('action');
							
							$(".tblsubmit").html("<h2 id='h2_submit'><i class='icon-spinner icon-spin'></i> Sending......</h2>");
							
							$.ajax({
								type: 'post',url: post_url,data: $(this).serialize(),
								success: function () {							
									$(".tblsubmit").html("<h2 id='h2_submit'>Message Sent</h2>");
									$.magnificPopup.close();
							
								}
							});
						});
  				
                ////End submit Jquery///
    });
</script>
