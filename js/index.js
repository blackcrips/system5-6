let username = $('#username');
let password = $('#password');
let validationMessage = $('#validation-message');

checkEmpty();
emptyValidationMessage();

$('.forgot-password').click(function(){
    window.location.href = 'forgotPassword.php';
});

function checkEmpty()
{
    $('#submit').click(function(e) {
        if(username.val() == "" || password.val() == ""){
            e.preventDefault();
            validationMessage.html('Please fill up all fields');
        }else if(!validateEmail(username.val())){
            e.preventDefault();
            validationMessage.html("Please enter a valid email");
        } else {
            $('#formLogin').submit();
        }
    })
}

function validateEmail($email)
{
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
}

function emptyValidationMessage()
{
    $('.elemInput').keydown(function(){
        validationMessage.html('');
    });
}