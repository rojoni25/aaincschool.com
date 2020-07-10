<div class="row-fluid ">
  <div class="span12">
    <ul class="top-banner">
    </ul>
  </div>
</div>
<input type="hidden" id="url_list" value="<?php echo base_url();?>index.php/<?=$this->uri->segment(1)?>">
<div class="row-fluid ">
  <div class="span12">
    <div class="primary-head">
      <h3 class="page-header">Coded Residual Details</h3>
    </div>
    <ul class="breadcrumb">
      <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
      <li><a href="#">Email</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active">Send Email</li>
    </ul>
  </div>
</div>
<div class="row-fluid">
  <div class="span6">
    <div class="widget-header">Coded</div>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Usercode</th>
          <th>Name</th>
        </tr>
      </thead>
      <tbody>
        <?php
            	for($i=0;$i<count($coded);$i++){
					echo '<tr>
							<td>'.$coded[$i]['usercode'].'</td>
							<td>'.$coded[$i]['fname'].' '.$coded[$i]['lname'].'</td>
						</tr>';	
				}
			?>
      </tbody>
    </table>
    <div class="widget-header">Coded Match</div>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Usercode</th>
          <th>Name</th>
        </tr>
      </thead>
      <tbody>
        <?php
            	for($i=0;$i<count($coded_match);$i++){
					echo '<tr>
							<td>'.$coded_match[$i]['usercode'].'</td>
							<td>'.$coded_match[$i]['fname'].' '.$coded_match[$i]['lname'].'</td>
						</tr>';	
				}
			?>
      </tbody>
    </table>
  </div>
  <!-----span6------->
  <div class="span6">
    <div class="widget-header">Residual</div>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Usercode</th>
          <th>Name</th>
          <th>Level</th>
        </tr>
      </thead>
      <tbody>
        <?php
            	for($i=0;$i<count($residual);$i++){
					echo '<tr>
							<td>'.$residual[$i]['usercode'].'</td>
							<td>'.$residual[$i]['fname'].' '.$residual[$i]['lname'].'</td>
							<td>'.$residual[$i]['level'].'</td>
						</tr>';	
				}
			?>
      </tbody>
    </table>
    <div class="widget-header">Residual Match</div>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Usercode</th>
          <th>Name</th>
           <th>Level</th>
        </tr>
      </thead>
      <tbody>
        <?php
            	for($i=0;$i<count($residual_match);$i++){
					echo '<tr>
							<td>'.$residual_match[$i]['usercode'].'</td>
							<td>'.$residual_match[$i]['fname'].' '.$residual_match[$i]['lname'].'</td>
							<td>'.$residual_match[$i]['level'].'</td>
						</tr>';	
				}
			?>
      </tbody>
    </table>
  </div>
  <!-----span6-------> 
</div>
<script>
		function checkAll()
		{
			var chKidall=document.getElementById('chkall');
			if(chKidall.checked==true){ var stu=true;}
			else{ var stu=false;}
			var frmlist=document.getElementById('frmlist');
			for(i=0;i<frmlist.elements.length;i++)
			{
				if(frmlist.elements[i].id =='chKid')
				{
					frmlist.elements[i].checked=stu;	
				}
			}
		
		}
		
		function vali(){
			var frmlist=document.getElementById('frmlist');
			var subject=document.getElementById('subject');
			if(subject.value==''){
				subject.focus();
				return false;
			}
			frmlist.submit();
		}
</script> 
