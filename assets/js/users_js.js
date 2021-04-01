$(document).ready(function() {
	$('#btnSubmit').on('click', function() {
        var rememberme = 0;
		var email = $('#inputEmail').val();
		var password = $('#inputPassword').val();
        if ($('#rememberMe').is(':checked')) {
        	rememberme = 1;
        }
		if(email!="" && password!="" ){
			$.ajax({
				url: "Login/processLogin",
				type: "POST",
				data: { email: email, password: password, rememberme:rememberme },
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
 					if(dataResult == 1){
						location.href = "dashboard";						
					}
					else if(dataResult == 4){
						$("#error-msg").show();
						$('#error-msg').html('Invalid email address or password.');
					}    					
					else if(dataResult == 2){
						$("#error-msg").show();
						$('#error-msg').html('Please enter email address.');
					}    					
					else if(dataResult ==3){
						$("#error-msg").show();
						$('#error-msg').html('Please enter password.');
					}    					
				}
			});
		}
		else{
		$("#error-msg").show();
		$('#error-msg').html('Please enter the email address and password.');
		}
	});
    
    /** This below validation code is called when you click on register and update button**/
    $("#btnRegisterUpdate").click(function(){
        var error = 0;	
        var user_id       = $('#hdnUserId').val();
        var user_name     = $('#inputUsername').val();
        var user_password = $('#inputPassword').val();
        var user_email    = $('#inputEmail').val();
        var age           = $('#inputAge').val();
        var city          = $('#inputCity').val();
        var postcode      = $('#inputPostcode').val();
        var address       = $('#inputAddress').val();
        $('#emailerror').html('');
        $('#postcodeerror').html('');
        $('#usernameerror').html('');
        $('#passworderror').html('');
        $('#ageerror').html('');
    
        if($.trim(user_name) == '')
        {
            $("#inputUsername").addClass('add_border');
            error = 1;
        }
        else {
            if(user_name.length <6 || user_name.length > 15)
            {
                $('#usernameerror').html('The username should be between 6 to 15 characters long');
                $("#inputUsername").addClass('add_border');
                error = 1;
            }
        }
            
        if($.trim(user_email) == '')
        {
            $("#inputEmail").addClass('add_border');
            error = 1;
        }
        else {
            if (!validateEmail(user_email)) 
            {
                $('#emailerror').html('Please enter valid email address');
                $("#inputEmail").addClass('add_border');
                error = 1;
            } 
        }
    				
        if($.trim(user_password) == '')
    	{
    		$("#inputPassword").addClass('add_border');
            error = 1;
    	}
        else {
            if(user_password.length <8)
            {
                $('#passworderror').html('The password should have 8 or more characters');
                $("#inputPassword").addClass('add_border');
                error = 1;
            }
        }
    				
        if($.trim(age) == '')
        {
            $("#inputAge").addClass('add_border');
            error = 1;
        }
        else {
            if (!validateAge(age)) 
            {
                $('#ageerror').html('Your age it should be greater than 18');
                $("#inputAge").addClass('add_border');
                error = 1;
            } 
        }
        
        if($.trim(city) == '')
    	{
    		$("#inputCity").addClass('add_border');
            error = 1;
    	}
        
        if($.trim(postcode) == '')
        {
            $("#inputPostcode").addClass('add_border');
            error = 1;
        }
        else {
            if (!validatePostcode(postcode)) 
            {
                $('#postcodeerror').html('Please enter proper postcode (format: XX-XXX)');
                $("#inputPostcode").addClass('add_border');
                error = 1;
            } 
        }
        
        if($.trim(address) == '')
        {
            $("#inputAddress").addClass('add_border');
            error = 1;
        }
        
        if(error == 1)
        {
            $('#error').html('Please fill all the field !');
            return false;
        }
        
        /**** For Editing the user record ****/
        if(parseInt(user_id)>0) {
			$.ajax({
				url: "User/processEditUser",
				type: "POST",
				data: {
					user_id: user_id,
					user_name: user_name,
					user_password: user_password,						
					user_email: user_email,
					age: age,											
					city: city,						
					postcode: postcode,
					address: address											
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult == 1){
						location.href = "dashboard";						
					}
					else {
						$("#error").show();
						$('#error').html(dataResult['error']);
					}	
				}
			});
		}
        /**** End For Editing the user record ****/            				
	});
    
    $('input').on('keydown', function() {
        $(this).removeClass('add_border');
//         $(this).val($(this).val().replace(/\s/g, ''));
    });
});

function validateEmail(email)
{
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validatePostcode(inputtxt)
{
    var postcode = /^^[A-Za-z0-9]{2}-[A-Za-z0-9]{3}$/;
    if(inputtxt.match(postcode)) 
    {
        return true;
    }  
    return false;
}

function validateAge(inputtxt)
{
	if(parseInt(inputtxt)>18) 
	{
        return true;
	}
	return false;
}