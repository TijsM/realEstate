$('#loginSubmit').click(function(){
    // let sUserEmail = $('#txtLoginEmail').val();
    // let sUserPassword = $('#txtLoginPassword').val();

    // console.log(sUserEmail);
    // console.log(sUserPassword);

    $.ajax({
        url : "api/api-login-user.php", // the end-point
        method : "POST", // pass via post
        data : $('#loginForm').serialize(), // create the form to be passed
        dataType : "JSON" // get text and convert it into JSON
      })
      .done( function( jData  ){
        if(jData.status === 1){
        window.location.pathname = 'PROJECT/profile.php'
        }
        else{
            console.log('login failed');
        }
      })
})

$('#registerUserSubmit').click(function(){
    // let sName = $('#txtRegisterUserName').val();
    // console.log(sName);
    $.ajax({
        url : "api/api-register-user.php", // the end-point
        method : "POST", // pass via post
        data : $('#registerUserForm').serialize(), // create the form to be passed
        dataType : "JSON" // get text and convert it into JSON
    })
    .done(function(JData){
        if(JData.status === 1){
            window.location.pathname = 'PROJECT/profile.php'
        }
        else{
            console.log('register failed');
        }
    })
})
