<!-------------------->
<script>
	$(document).ready(function(e) {
        $(document).on('click', '.pageperview', function (e) {
			var pagecode=$(this).attr('value');
			//*********//
				params  = 'width='+screen.width;
				params += ', height='+screen.height;
				params += ', top=0, left=0'
				params += ', fullscreen=yes';
				var url='<?php echo base_url();?>index.php/capture/page/'+pagecode+'';
			
				newwin=window.open(url,'', params);
				if (window.focus) {newwin.focus()}
			//***********//
		});
		
		
    });
</script>
<div class="CSSTableGenerator" >
  <table >
    <tr>
      <td > Name </td>
      <td> Page Name </td>
      <td> Opration </td>
    </tr>
    <?php

    	for($i=0;$i<count($result);$i++){
			$edit='';
			if($result[$i]['change']=='Y'){
				$edit='<a href="'.base_url().'index.php/'.$this->uri->segment(1).'/addnew/Edit/'.$result[$i]['capture_page_code'].'" class="edit_rcd"><button class="btn-warning btncls" type="button">Edit</button></a>';
			}
			echo '<tr>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['page_name'].'</td>
						<td>
						'.$edit.'
						<a href="#" class="pageperview" value="'.$result[$i]['capture_page_code'].'"><button class="btn-danger btncls" type="button">Preview</button></a>
						</td>
              		</tr>';
		}
		
		for($i=0;$i<count($result2);$i++){
			echo '<tr>
					<td>Free</td>
					<td>'.$result2[$i]['page_name'].'</td><td>
					<a href="#" class="pageperview" value="'.$result2[$i]['capture_page_code'].'"><button class="btn-danger btncls" type="button">Preview</button></a>
					</td>
				</tr>';
		}
	?>
  </table>
</div>

<!-------------------->

</div>
<!-- end content right side -->
</div>
<!-- end content area -->
<div class="clearfix mar_top5"></div>
