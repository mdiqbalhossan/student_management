$(document).ready(function() {
		
    $("#next-1").click(function(event) {
        event.preventDefault();
        $("#nameErr").html('');
        $("#emailErr").html('');
        $("#genderErr").html('');
        $("#dobErr").html('');
        $("#religionErr").html('');
        $("#phoneErr").html('');
        $("#addressErr").html('');
        $("#cityErr").html('');
        $("#countryErr").html('');

        if($("#name").val() == ''){
            $("#nameErr").html(' * name is required!');
            return false;
        }else if(!isNaN($("#name").val())){
            $("#nameErr").html(' * Numbers are not allowed!');
            return false;
        }else if($("#email").val() == ''){
            $("#emailErr").html(' * email is required!');
            return false;
        }else if(!validateEmail($("#email").val())){
            $("#emailErr").html(' * email is not valid!');
            return false;
        }else if($("#phone").val() == ''){
            $("#phoneErr").html(' * Phone Number is required!');
            return false;	
        }else if(isNaN($("#phone").val())){
            $("#phoneErr").html(' * phone is not valid.Only Numbers are allowed!');
            return false;	
        }else if($("#phone").val().length != 11){
            $("#phoneErr").html(' * phone number must be of more than 11 character!');
            return false;	
        }else if($("#gender").val() == ''){
            $("#genderErr").html(' * Gender is required!');
            return false;
        }else if($("#dob").val() == ''){
            $("#dobErr").html(' * Date Of Birth is Required!');
            return false;
        }else if($("#religion").val() == ''){
            $("#religionErr").html(' * Religion is required!');
            return false;
        }else if($("#address").val() == ''){
            $("#addressErr").html(' * Address is required!');
            return false;
        }else if($("#city").val() == ''){
            $("#cityErr").html(' * City is required!');
            return false;
        }else if($("#country").val() == ''){
            $("#countryErr").html(' * Country is required!');
            return false;
        }else{
            $("#second").show();
            $("#first").hide();
            $("#progressBar").css('width', '50%');
            $("#progressBarText").html('Step-2');
        }

        function validateEmail($email){
            var eamilReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return eamilReg.test($email);
        }

        
    });

    $("#next-2").click(function(event) {
        event.preventDefault();

        $("#admission_dateErr").html('');
        $("#admission_numberErr").html('');
        $("#classErr").html('');
        $("#rollErr").html('');

        if($("#admission_date").val() == ''){
            $("#admission_dateErr").html(' * Admission Date is Required!');
            return false;
        }else if($("#admission_number").val() == ''){
            $("#admission_numberErr").html(' * Admission Number is Required!');
            return false;
        }else if(isNaN($("#admission_number").val())){
            $("#admission_numberErr").html(' * phone is not valid.Only Numbers are allowed!');
            return false;	
        }else if($("#admission_number").val().length != 6){
            $("#admission_numberErr").html(' * Admission number must be of 6 character!');
            return false;	
        }else if($("#class").val() == ''){
            $("#classErr").html(' * Class is Required!');
            return false;
        }else if($("#roll").val() == ''){
            $("#rollErr").html(' * Roll Number is Required!');
            return false;
        }else if(isNaN($("#roll").val())){
            $("#rollErr").html(' * roll is not valid.Only Numbers are allowed!');
            return false;	
        }else{
            $("#second").hide();
            $("#third").show();
            $("#progressBar").css('width', '75%');
            $("#progressBarText").html('Step-3');
        }       

        
    });

    $("#next-3").click(function(e){
        e.preventDefault();

        $("#father_nameErr").html('');
        $("#father_phoneErr").html('');
        $("#mother_nameErr").html('');
        $("#mother_phoneErr").html('');

        if($("#father_name").val() == ''){
            $("#father_nameErr").html('* Father Name is Required!');
            return false;
        }else if($("#father_phone").val() == ''){
            $("#father_phoneErr").html(' * Phone Number is required!');
            return false;	
        }else if(isNaN($("#father_phone").val())){
            $("#father_phoneErr").html(' * phone is not valid.Only Numbers are allowed!');
            return false;	
        }else if($("#father_phone").val().length != 11){
            $("#father_phoneErr").html(' * phone number must be of more than 11 character!');
            return false;	
        }else if($("#mother_name").val() == ''){
            $("#mother_nameErr").html('* Mother Name is Required!');
            return false;
        }else if($("#mother_phone").val() == ''){
            $("#mother_phoneErr").html(' * Phone Number is required!');
            return false;	
        }else if(isNaN($("#mother_phone").val())){
            $("#mother_phoneErr").html(' * phone is not valid.Only Numbers are allowed!');
            return false;	
        }else if($("#mother_phone").val().length != 11){
            $("#mother_phoneErr").html(' * phone number must be of more than 11 character!');
            return false;	
        }else{
            $("#third").hide();
            $("#fourth").show();
            $("#progressBar").css('width', '100%');
            $("#progressBarText").html('Step-4');
        }

    });

    $("#form-data").submit(function(e){
        e.preventDefault();
        $("#submit").val('Please Wait...');

        $.ajax({
            url: 'lib/action.php',
            type: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(this),
            success:function(response){
                $("#result").show();
                $("#result").html(response);
                $("#submit").val('Update');
            }
        });
        
        

    })



    $("#prev-2").click(function(event) {
        event.preventDefault();
        $("#second").hide();
        $("#first").show();
        $("#progressBar").css('width', '25%');
        $("#progressBarText").html('Step-1');
    });

    $("#prev-3").click(function(event) {
        event.preventDefault();
        $("#second").show();
        $("#third").hide();
        $("#progressBar").css('width', '50%');
        $("#progressBarText").html('Step-2');
    });

    $("#prev-4").click(function(event) {
        event.preventDefault();
        $("#third").show();
        $("#fourth").hide();
        $("#progressBar").css('width', '75%');
        $("#progressBarText").html('Step-3');
    });



});	