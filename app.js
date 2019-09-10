$('#loginSubmit').click(function(){
    // let sUserEmail = $('#txtLoginEmail').val();
    // let sUserPassword = $('#txtLoginPassword').val();

    // console.log(sUserEmail);
    // console.log(sUserPassword);

    $.ajax({
        url : "api/api-login-user.php", 
        method : "POST",
        data : $('#loginForm').serialize(),
        dataType : "JSON" 
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
        url : "api/api-register-user.php", 
        method : "POST", 
        data : $('#registerUserForm').serialize(), 
        dataType : "JSON"
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


$('#registerAgentSubmit').click(function(){
    console.log('test');
    $.ajax({
        url : "api/api-register-agent.php", 
        method : "POST", 
        data : $('#registerAgentForm').serialize(), 
        dataType : "JSON"
    })
    .done(function(JData){
        console.log('test');
        if(JData.status === 1){
            window.location.pathname = 'PROJECT/profile.php'
        }
        else{
            console.log('register failed');
        }
    })
})
