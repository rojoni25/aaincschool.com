<link href="<?php echo base_url();?>asset/js/auto_camplate/jquery-ui.css" rel="stylesheet">

<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>

<?php
	$result		=	$this->asm_class->get_pages_contain();
	
	$product1	=	$this->asm_class->check_product('1');
	$product2	=	$this->asm_class->check_product('2');
	
?>

<div class="row-fluid">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">
        <?=$result[0]['pagename']?>
      </h3>
    </div>
  </div>
</div>

<div class="row-fluid ">
 
    	<?php 
			if(!$product2){
				echo '<div class="span6 pay_div_cls">';
    			echo get_pay_btn2();
				echo '</div>';
				
				if(!$product1){
					echo ' <div class="span6 pay_div_cls">';
    				echo get_pay_btn1();
					echo '</div>';
				}
				
        	}
				
		 ?>
         
        
  
</div>


<div style="clear:both;overflow:hidden;"></div>


<div class="row-fluid">

<div class="span12">
  <h4 style="margin-bottom:20px;">
    <?=$result[0]['title']?>
  </h4>
  <div>
    <?php
		if($result[0]['video_url']!=''){
			echo '<div class="video_frm">
					<div class="inner_frm">';
				if (strpos($result[0]['video_url'], 'youtube') !== false)
				{
					echo '<iframe width="100%" height="100%" src="'.$result[0]['video_url'].'" frameborder="0" allowfullscreen></iframe>';
				}
				else{
					echo '<video width="100%" height="100%" controls="controls"><source src="'.$result[0]['video_url'].'" type="video/mp4"></video>';
				}
			echo '</div>
			</div>';
			
		}
    
    ?>
  </div>
  <div style="margin-top:30px;">
    <div>
      <?=$result[0]['textdt']?>
    </div>
  </div>
</div>
<div style="clear:both;overflow:hidden;"></div>
<style>
	.btncls{
		border:none;
	}
	.video_frm{
		width: 473px;
		height: 333px;
		overflow:hidden;
		margin:auto;
		background-image:url(<?=base_url();?>asset/images/cap_frm.png);
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	.inner_frm{
		height: 291px;
		width: 390px;
		margin-top: 20px;
		margin-left: 40px;
	}
	.txtdiv{
		width:90%;
		position:relative;
		margin:auto;
	}
	.txtdiv{
		width:90%;
		position:relative;
		margin:auto;
	}
	.pay_div_cls .n-sources{
		font-size:21px !important;
		padding:15px 0px;
	}
	.pay_div_cls .board-widgets-botttom a{
		font-size:16px !important;
		padding:10px 10px;
	}
	@media  only screen and (max-width: 535px){
#request_page{
	margin-top:5px;
	margin-left:0%;
	float:right;

}
#add_page{
	margin-top:5px;
	margin-left:0%;

}
#view_page{
	margin-top:10px;
	margin-right:10px;
	float:left;

}

.video_frm {
   width: 284px;
height: 200px;
}

.inner_frm {
    height: 176px;
    width: 235px;
    margin-top: 12px;
    margin-left: 24px;
}
}
@media  only screen and (max-width: 310px){
.video_frm {
    width: 190px;
    height: 134px;
}

.inner_frm {
    height: 118px;
width: 157px;
margin-top: 8px;
margin-left: 16px;
}
}
</style>
<?php 
	function get_pay_btn1(){
		
		$url=''.base_url().'index.php/n_product/subscription/1';
		
		$html='
    		<div class="board-widgets bondi-blue">
			<a href="'.$url.'">
    			<div class="board-widgets-content">
                	<span class="n-sources">One Time Payment $15 for 1 Months.</span>
    				<p><img src="'.base_url().'asset/images/credit_card_img.gif" /></p>
    			</div>
			
    	</a>
    	<div class="board-widgets-botttom"><a href="'.$url.'">Click For Online Payment</a></div></div>	';
		return $html;
	}
	
	
	function get_pay_btn2()
	{
		
		$url=''.base_url().'index.php/n_product/subscription/2';	
		$html='<div class="board-widgets bondi-blue">
			<a href="'.$url.'">
    			<div class="board-widgets-content">
                <span class="n-sources">One Time Payment $100 for 6 Months.</span>
    			<p><img src="'.base_url().'asset/images/credit_card_img.gif" /></p>
			</div>	
    	</a>
    	<div class="board-widgets-botttom"><a href="'.$url.'">Click For Online Payment</a></div></div>';
		return $html;
	}
?>
