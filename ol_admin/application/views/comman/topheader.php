<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Admin | <?=getconfigMeta('comanyname')?> 2019</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Admin Panel Template">
<meta name="author" content="Westilian: Kamrujaman Shohel">

<link href="<?php echo base_url();?>asset/css/bootstrap.css" rel="stylesheet">
<!-- <link href="<?php echo base_url();?>asset/css/bootstrap-responsive.css" rel="stylesheet"> -->
<link rel="stylesheet" href="<?php echo base_url();?>asset/css/font-awesome.css">

<link href="<?php echo base_url();?>asset/css/styles.css" rel="stylesheet">
<link href="<?php echo base_url();?>asset/css/theme-blue.css" rel="stylesheet">


<link href="<?php echo base_url();?>asset/css/aristo-ui.css" rel="stylesheet">
<link href="<?php echo base_url();?>asset/css/elfinder.css" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>



<script src="<?php echo base_url();?>asset/js/jquery.js"></script>
<script src="<?php echo base_url();?>asset/js/jquery-ui-1.10.1.custom.min.js"></script>
<script src="<?php echo base_url();?>asset/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>asset/js/accordion.nav.js"></script>
<script src="<?php echo base_url();?>asset/js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>asset/js/jquery.metadata.js"></script>
<script src="<?php echo base_url();?>asset/js/custom.js"></script>
<script src="<?php echo base_url();?>asset/js/respond.min.js"></script>
<script src="<?php echo base_url();?>asset/js/ios-orientationchange-fix.js"></script>

<?php  if($table_list){ ?>
			<script src="<?php echo base_url();?>asset/js/jquery.tablecloth.js"></script>
            <script src="<?php echo base_url();?>asset/js/jquery.dataTables.js"></script>
            <script src="<?php echo base_url();?>asset/js/ZeroClipboard.js"></script>
            <script src="<?php echo base_url();?>asset/js/dataTables.bootstrap.js"></script>
            <script src="<?php echo base_url();?>asset/js/TableTools.js"></script>
            <script src="<?php echo base_url();?>asset/js/all_fun.js"></script>
            
           
<?php } ?>

<?php  if($popup_box){ ?>
		<script src="<?php echo base_url();?>asset/popup/js/lightbox.js"></script>
        <script src="<?php echo base_url();?>asset/popup/js/jquery.carouFredSel-5.5.0-packed.js"></script>
        <script src="<?php echo base_url();?>asset/popup/js/jquery.magnific-popup.js"></script>
        <link  rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/popup/css/lightbox.css">
<?php } ?>

<?php if($select_chosen){?>
		<link href="<?php echo base_url();?>asset/css/chosen.css" rel="stylesheet">
		<script src="<?php echo base_url();?>asset/js/chosen.jquery.js"></script>
<?php } ?>
<link href="<?php echo base_url();?>asset/css/responsive.css" rel="stylesheet">

</head>
<body>
