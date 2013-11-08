$(document).ready(function(){
    /* Add validation  rules */
    $( "#user_password" ).rules( "add", {
        required: true,
        minlength: 5
    });
    $( "#confirm_password" ).rules( "add", {
        required: true,
        equalTo: "#user_password"
    });

});