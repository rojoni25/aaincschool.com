var baseurl;
$(document).ready(function(e) {
    baseurl=$('#baseurl').val();	
});

	   ////////////
	   	$(document).on('change', '#username', function (e) {
				
				var value 		= $('#username').val();
		
				var url=''+baseurl+'index.php/comman_controler/check_username/'+value+'/Add/';
			
				$.ajax({url:url,success:function(result){
					
					if(result=='flase'){
						alert('"'+value+'" Username is already sxist');
						$('#username').val('');
					}
				
				}});
			});
	   ////////////
		
		<!---------This Method is use for change status-------------->
		$(document).on('click', '.btnsubmit', function (e) {
			if($('#fname').val()==""){
				$("#fname").focus();
				alert('First Name is require');
				
				return false;
			}
			if($('#lname').val()==""){
				$("#lname").focus();
				alert('Last Name is require');
				return false;
			}
			if($('#emailid').val()==""){
				$("#emailid").focus();
				alert('Email id is require');
				return false;
			}
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (!filter.test($('#emailid').val())) {
				$('#emailid').val('')
   		 		alert("Enter Vailed Email Address");
    			return false;
 			}
			if($('#username').val()==""){
				$("#username").focus();
				alert('Username is require');
				return false;
			}
			var uname = /[0-9a-zA-Z]/;
			if(!uname.test($('#username').val())){
			    $('#username').val('')
			    alert('Username must have alphanumeric characters only');
			    return false;
			}
			if($('#username').val().length < 4){
				$("#username").focus();
				alert('Username Minumum 4 Character');
				return false;
			}
			if($('#password').val()==""){
				$("#password").focus();
				alert('Password is require');
				return false;
			}
			if($('#password').val().length < 4){
				$("#password").focus();
				alert('Password Minumum 4 Character');
				return false;
			}
			if($('#repeat_password').val()==""){
				$("#repeat_password").focus();
				alert('Enter Repeat Password');
				return false;
			}
			if($('#password').val()!=$('#confirmpass').val()){
				$('#password').val('');
				$('#confirmpass').val('');
				alert('Enter Repeat is Not Match');
				return false;
			}
			$('#form-signin').submit();
		});
		
		$(document).on('keydown', '#username', function (event) {
			if(event.shiftKey)
				return false;
				var keyCode = event.which;
				if(keyCode==32){
				event.preventDefault();
			    }
		});
		
		$(document).on('keydown', '#password', function (event) {
			if(event.shiftKey)
				return false;
				var keyCode = event.which;
				if(keyCode==32){
				event.preventDefault();
			    }
		});
		