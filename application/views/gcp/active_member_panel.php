<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<script>
	$('.v_link').on('click', function (e) {
		var con=confirm('Send Verification Email ?');
		if(con){
			window.location.href='<?=base_url()?>index.php/welcome/email_verification';
			$.magnificPopup.close();	
		}
		e.preventDefault();
		
	});
</script>
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
@media (max-width: 550px) {
.mfp-content {
	width: 310px !important;
}
.btnlink{
	padding: 10px 20px !important;
}

}
@media (max-width: 350px) {
#h2_head{
	font-size:12px;
}
.mfp-content {
	width: 170px !important;
}
.btnlink{
	padding: 10px 13px !important;
	font-size:16px !important;
}
}

</style>
<body>
	
  	<h2 id="h2_head">
    <?php if($this->session->userdata["logged_ol_member"]["status"]=='Active'){?>
    		Choose Your Back Office
     <?php } ?>       
    <a class="popup-modal-dismiss fromclose" href="#" title="Close"><i class="icon-remove"></i></a></h2>
	</h2>
     <?php if($this->session->userdata["logged_ol_member"]["status"]=='Active'){?>
        <table width="100%">
            <tr>
            	<td align="center"><a class="btnlink" href="<?=base_url()?>index.php/login/go_in_paid">Paid</a></td>
            	<td align="center"><a class="btnlink" href="<?=base_url()?>index.php/login/go_in_free">Free</a></td>
            </tr>
        </table>
    <?php } ?>
    <?php if($this->session->userdata["logged_ol_member"]["email_verification"]=='N'){?>
    	<div style="margin-top:20px;">
    		<h5>Your Email Is Unverified</h5>
            <h5>Please Verify Your Email <span class="label label-important"><a  href="#" class="linkllb v_link">Email Verification</a></span></h5>
        </div>
    <?php } ?>
</body>
</html>

<style>
.linkllb, .linkllb:hover {
	color:#FFF;
	text-decoration:none;
}
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
	.txtyoutube{
		text-align:center;
		cursor:copy !important;
	}
</style>
