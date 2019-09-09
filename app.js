$('#loginSubmit').click(function(){
    let sUserEmail = $('#txtLoginEmail').val();
    let sUserPassword = $('#txtLoginPassword').val();

    console.log(sUserEmail);
    console.log(sUserPassword);

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
