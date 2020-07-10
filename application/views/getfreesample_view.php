<div class="marquee_div">
    <span class="spm_llb">Just Joined</span>
    <marquee>
    	<h3 class="maq_h3"><?=$this->session->userdata["ref"]["currect_add"]?></h3>
    </marquee>
</div> 
<!--== breadcrumbs ==-->
<div class="sb2-2-2">
	<ul>
		<li><a href="<?=base_url()?>index.php/welcome"><i class="fa fa-home" aria-hidden="true"></i></a> </li>
		<li class="active-bre"><a href="#"> Welcome</a> </li>
		<li class="page-back"> <a href="#"> <i class="fa fa-calendar" aria-hidden="true"></i> <?=date('F d, Y')?></a> </li>
		<li class="active-bre page-back"> Last Login Date & Time : <?=lastlogin($this->session->userdata['logged_ol_member']['usercode'])?></li>
		<li class="page-back"> Your Username : <?=$this->session->userdata['logged_ol_member']['username']?></li>
	</ul>
</div>
<div class="tz-2 tz-2-admin">
	<div class="tz-2-com tz-2-main">
		<h4>Get Free Sample</h4>
		
	</div>
	<div class="tz-2-com tz-2-main">
		<br><br><br><br><br><br><br><br><br>

	</div>
</div>
