<div class="alert vma-banner">
	<?php 
		$level1 = $this->vma_class->count_member_on_level1();
		$leve1_income	=	$level1*1.66;
		
		$level2 = $this->vma_class->count_member_on_level2();
		$leve2_income	=	$level2*1.66;
		
		$level3 = $this->vma_class->count_member_on_level3();
		$leve3_income	=	$level3*1.66;
		
		
		$main_balance = $this->vma_class->main_balance();
		
	 ?>
  
     
	
    	<ul>
        	<li>Level-1 : <span class="llb"><?=$level1?></span></li>
            <li class="sep">Daily Income Level-1 : <span class="llb2">$<?=number_format($leve1_income,2)?></span></li>
            <li>Level-2 : <span class="llb"><?=$level2?></span></li>
            <li class="sep">Daily Income Level-2 :<span class="llb2"> $<?=number_format($leve2_income,2)?></span></li>
            <li>Level-3 : <span class="llb"><?=$level3?></span></li>
            <li class="sep">Daily Income Level-3 : <span class="llb2">$<?=number_format($leve3_income,2)?></span></li>
            
            <li class="sep">Balance : <span class="llb2">$<?=number_format($main_balance['balance'],2)?></span></li>
            <div style="clear:both;overflow:hidden;"></div>
        </ul>
        
        <style>
			.vma-banner{
				padding: 6px 6px;
				background-color:#327a63;
			}
			.vma-banner ul{
				position: relative;
				list-style: none;
				margin: 0px;
				padding: 0px;
			}
        	.vma-banner ul li {
				float: left;
				margin: 2px;
				padding: 5px;
			}
			.vma-banner ul li .llb{
				font-weight:bold;
			}
			.vma-banner ul li .llb2{
				font-weight:bold;
				font-style:italic;	
			}
			.vma-banner ul .sep{
				margin-right:50px;
			}
        </style>
   
</div>