<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script src="<?=base_url();?>asset/js/jquery.tablecloth.js"></script>
<script src="<?=base_url();?>asset/js/jquery.dataTables.js"></script>
<script src="<?=base_url();?>asset/js/ZeroClipboard.js"></script>
<script src="<?=base_url();?>asset/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url();?>asset/js/TableTools.js"></script>


</head>
<style>
.mfp-content {
	width:600px !important;
	background-color: #fff;
	padding: 15px;
	padding-bottom: 30px;
	margin: 20px auto;
}
.fromclose {
	float: right;
	text-decoration: none;
	color: #333;
}

#h2_head {
	font-size: 20px;
}
.table_popup{
	font-size:15px;
}
</style>
<body>
<h2>
  <h2 id="h2_head">
    Report Issue
    <a class="popup-modal-dismiss fromclose" href="#" title="Close"><i class="icon-remove"></i></a></h2>
</h2>
<form method="post" action="<?php echo base_url();?>index.php/capture_pages/report_issue_insert">
 <input  type="hidden" id="issue_url_code" name="issue_url_code" value="<?=$this->uri->segment(3)?>" >
         <div class="span1">
         <label class="control-label">Url</label>
         </div>
         <div class="span5">
         <input  type="text" id="issue_url" name="issue_url" style="width:90%" value="<?=base_url()?>index.php/capture/page/<?=$this->uri->segment(3)?>"readonly>
         </div>
         
         <div class="span1">
         <label class="control-label">Description</label>
         </div>
         <div class="span5">
         <textarea id="contain" name="contain" style="width:90%"></textarea>
         </div>
         
            <button type="submit" class="btn btn-primary btnsubmit">Send</button>
 </form>
</body>
</html>
