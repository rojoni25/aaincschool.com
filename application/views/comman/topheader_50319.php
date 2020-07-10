<!DOCTYPE html>
<html lang="en">
<head>
    <title>Member | Affiliworx 2018</title>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- FAV ICON(BROWSER TAB ICON) -->
    <link rel="shortcut icon" href="images/fav.ico" type="image/x-icon">
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:500,700" rel="stylesheet">
    <!-- FONTAWESOME ICONS -->
    <link rel="stylesheet" href="<?=base_url();?>asset/css/font-awesome.min.css">
    <!-- ALL CSS FILES -->
    <link href="<?=base_url();?>asset/css/materialize.css" rel="stylesheet">
    <link href="<?=base_url();?>asset/css/style.css" rel="stylesheet">
    <link href="<?=base_url();?>asset/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
    <link href="<?=base_url();?>asset/css/responsive.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <script src="<?=base_url();?>asset/js/jquery.min.js"></script>
    <script src="<?=base_url();?>asset/js/bootstrap.js" type="text/javascript"></script>
    <script src="<?=base_url();?>asset/js/materialize.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>asset/js/custom.js"></script>
    <script src="<?=base_url();?>asset/js/jquery.validate.js"></script>
    <script src="<?=base_url();?>asset/js/jquery.tablecloth.js"></script>
    <script src="<?=base_url();?>asset/js/jquery.dataTables.js"></script>
    <script src="<?=base_url();?>asset/js/ZeroClipboard.js"></script>
    <script src="<?=base_url();?>asset/js/datatable.js"></script>
    <script src="<?=base_url();?>asset/js/TableTools.js"></script>
    <script src="<?=base_url();?>asset/js/all_fun.js"></script>
</head>
<style type="text/css">
    .spm_llb {
        background: #C96;
        padding: 10px 10px;
        position: absolute;
        font-size: 16px;
        color: #FFF;
        z-index: 1;
    }
    .maq_h3 {
        font-size: 20px;
        margin: 0px;
        padding: 10px;
        color: #173E54;
    }
    marquee {
        margin: 0px;
        padding: 0px;
        background-color: rgba(232,138,5,0.8);
    }
</style>
<body>
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!--== MAIN CONTRAINER ==-->
    <div class="container-fluid sb1">
        <div class="row">
            <!--== LOGO ==-->
            <div class="col-md-2 col-sm-3 col-xs-6 sb1-1"> <a href="#" class="btn-close-menu"><i class="fa fa-times" aria-hidden="true"></i></a> <a href="#" class="atab-menu"><i class="fa fa-bars tab-menu" aria-hidden="true"></i></a>
                <a href="<?=base_url();?>index.php/welcome" class="logo"><img src="<?=base_url();?>asset/img/logo.png" alt="" /> </a>
            </div>
            <!--== SEARCH ==-->
            <div class="col-md-4 col-sm-4 mob-hide">
                <a class='waves-effect dropdown-button top-user-pro' href='#' > My Sponsor : <span><?=$this->session->userdata['ref']['name']?></span></a>
                <a class='waves-effect dropdown-button top-user-pro' href='<?=base_url()?>index.php/opportunity/page/business'> New Opportunities</a>
                
            </div>
            <!--== NOTIFICATION ==-->
            <div class="col-md-2 tab-hide">
                <div class="top-not-cen"> 
                    <a class='waves-effect btn-noti' href='<?=base_url()?>index.php/notification'><i class="fa fa-globe" aria-hidden="true"></i><span class="notify-tip notification-cls">0</span></a>  
                </div>
            </div>
            <?php
                $redirect   = urlencode(str_replace('index.php?', 'index.php/', current_url()));

                if($this->session->userdata['tbl']['current_account']=='Active')
                {
                    $change_text='Paid';
                }
                else{
                    $change_text='Free';
                }
            ?>
            <div class="col-md-2 col-sm-2 col-xs-2">
                <!-- Dropdown Trigger -->
                <a class='waves-effect dropdown-button top-user-pro' href='#' data-activates='top-ac'> <?=$change_text?> <i class="fa fa-angle-down" aria-hidden="true"></i> </a>
                <!-- Dropdown Structure -->
                <ul id='top-ac' class='dropdown-content top-menu-sty'>
                    <li><a href="<?=base_url()?>index.php/login/go_in_paid?redirect=<?php echo $redirect; ?>" class="waves-effect"><i class="fa fa-cogs"></i>Paid Account</a> </li>
                    <li><a href="<?=base_url()?>index.php/login/go_in_free?redirect=<?php echo $redirect; ?>"><i class="fa fa-bar-chart"></i> Free Account</a> </li>
                </ul>
            </div>
            <!--== MY ACCCOUNT ==-->
            <div class="col-md-2 col-sm-3 col-xs-4">
                <!-- Dropdown Trigger -->
                <a class='waves-effect dropdown-button top-user-pro' href='#' data-activates='top-menu'><img src="<?=base_url()?>upload/user_thum/<?=$this->session->userdata['logged_ol_member']['user_img']?>" alt="" />My Account <i class="fa fa-angle-down" aria-hidden="true"></i> </a>
                <!-- Dropdown Structure -->
                <ul id='top-menu' class='dropdown-content top-menu-sty'>
                    <li><a href="<?php echo base_url();?>index.php/profile" class="waves-effect"><i class="fa fa-undo" aria-hidden="true"></i> Edit Profile</a> </li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url();?>index.php/login/logout" class="ho-dr-con-last waves-effect"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</a> </li>
                </ul>
            </div>
        </div>
    </div>
