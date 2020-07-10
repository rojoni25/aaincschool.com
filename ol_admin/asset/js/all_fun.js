// JavaScript Document

$(document).ready(function() {
	var url=$("#url_list").val();
	var url_curr=url+'/listing';
	$.ajax({url:url_curr,success:function(result){
			$("#data-table tbody").html(result);
			$('#data-table').dataTable({
					"bProcessing": true,
					"iDisplayLength": 25,
					"responsive": true,
					"bDestroy": true
			});
			
			
     }});
	
	
		
	//status change
	$(document).on('click', '.btn_aaply', function (e) {
			
			var select_status = $('#select_status').val();
			var record_count=0;
			if(select_status==''){
				return false;
			}
			
			var value_all='';
			$('.recode_status_code').each( function( i , e ) {
				if ($(this).is(':checked')) {
					record_count++;
				}
				
			});
			if(record_count>0){
				var conf=confirm('Are Your Sour '+record_count+' Record '+select_status+' ?');
			}
			else{
				alert('Please Select Record');
				return false;
			}
			
			if(conf==true){
				$('.recode_status_code').each( function( i , e ) {
   			 		var value 		= $(this).attr('value');
	
					if ($(this).is(':checked')) 
					{
						value_all+=value+'M';
						$(this).parent().parent().removeClass('even');
						if(select_status=='Active'){
							$(this).parent().parent().removeClass('st_inactive');
						}
						else if(select_status=='Inactive'){
							$(this).parent().parent().addClass('st_inactive');
						}
						else if(select_status=='Delete'){
							$(this).parent().parent().remove();
						}
						
    				} 
			 });//end loop
			}//end if
			
	
			var url_update=url+'/record_update/'+select_status+'/'+value_all;
			$.ajax({url:url_update,success:function(result){		 	
            }});	
		});	
	
		
});
