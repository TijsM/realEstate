$('#loginSubmit').click(function () {
    // let sUserEmail = $('#txtLoginEmail').val();
    // let sUserPassword = $('#txtLoginPassword').val();

    // console.log(sUserEmail);
    // console.log(sUserPassword);
    $.ajax({
        url: "api/api-login-user.php",
        method: "POST",
        data: $('#loginForm').serialize(),
        dataType: "JSON"
    })
        .done(function (jData) {
            if (jData.status === 1) {
                window.location.pathname = 'PROJECT/profile.php'
            }
            else {
                $('#loginError').empty();
                $('#loginError').html(`
            <div class="alert alert-danger credentialError" role="alert">
                ${jData.message}
            </div>
            `)

            }
        })
})

$('#registerUserSubmit').click(function () {
    // let sName = $('#txtRegisterUserName').val();
    // console.log(sName);
    $.ajax({
        url: "api/api-register-user.php",
        method: "POST",
        data: $('#registerUserForm').serialize(),
        dataType: "JSON"
    })
        .done(function (jData) {
            if (jData.status === 1) {
                window.location.pathname = 'PROJECT/profile.php'
                }
            else {
                $('#registerUserError').empty();
                $('#registerUserError').html(`
            <div class="alert alert-danger credentialError" role="alert">
                ${jData.message}
            </div>
            `)
            }
        })

})


$('#registerAgentSubmit').click(function () {
    console.log('test');
    $.ajax({
        url: "api/api-register-agent.php",
        method: "POST",
        data: $('#registerAgentForm').serialize(),
        dataType: "JSON"
    })
        .done(function (jData) {
            console.log('test');
            if (jData.status == 1) {
                window.location.pathname = 'PROJECT/profile.php'
            }
            else {
                $('#registerAgentError').empty();
                $('#registerAgentError').html(`
            <div class="alert alert-danger credentialError" role="alert">
                ${jData.message}
            </div>
            `)
            }
        })
})


$('#frmUpdateUserConfirm').click(function () {
    //checking if the form contains a field for the telephone number
    //if this is the case, it is an agent, otherwise it is a user
    const isAgent = ($('#agentPhone').length) ? true : false;

    if (isAgent) {
        //agent
        console.log('in agent update');
        $.ajax({
            url: "api/api-update-agent.php",
            method: "POST",
            data: $('#frmUpdateUser').serialize(),
            dataType: "JSON"
        })
            .done(function (jData) {
                // console.log('test');
                if (jData.status === 1) {
                    window.location.pathname = 'PROJECT/profile.php'
                }
                else {
                    $('#updateError').empty();
                    $('#updateError').html(`
                <div class="alert alert-danger credentialError" role="alert">
                    ${jData.message}
                </div>
                `)
                }
            })
    }
    else {
        //user
        console.log('in user update');
        $.ajax({
            url: "api/api-update-user.php",
            method: "POST",
            data: $('#frmUpdateUser').serialize(),
            dataType: "JSON"
        })
            .done(function (jData) {
                if (jData.status === 1) {
                    window.location.pathname = 'PROJECT/profile.php'
                }
                else {
                    $('#updateError').empty();
                    $('#updateError').html(`
                <div class="alert alert-danger credentialError" role="alert">
                    ${jData.message}
                </div>
                `)
                }
            })
    }
})

$('#deleteUser').click(function () {
    console.log('test');
    $.ajax({
        url: "api/api-delete-user.php",
        method: "POST",
        data: $('#frmUpdateUser').serialize(),
        dataType: "JSON"
    })
        .done(function (jData) {
            console.log('test');
            if (jData.status == 1) {
                window.location.pathname = 'PROJECT/'
            }
            else {
                $('#registerAgentError').empty();
                $('#registerAgentError').html(`
            <div class="alert alert-danger credentialError" role="alert">
                ${jData.message}
            </div>
            `)
            }
        })
})

$('#linkLogout').click(function () {
    console.log('test');
    $.ajax({
        url: "api/api-logout.php",
        dataType: "JSON"
    })
        .done(function (jData) {

            if (jData.status == 1) {
                window.location.pathname = 'PROJECT/login-register.php'
            }
            else {
                console.log('logging out failed')
            }

        })
})


$('#btnSubmitProperty').click(function (e) {
    console.log('in add property');

    //stop auto refresh
    e.preventDefault();

    var formData = new FormData(document.getElementById('frmAddProperty'));

    $.ajax({
        url: "api/api-add-property.php",
        method: 'POST',
        data: formData,
        dataType: "JSON",
        cache: false,
        contentType: false,
        processData: false
    })
        .done(function (jData) {
            if (jData.status == 1) {
                window.location.pathname = 'PROJECT/my-properties.php'
            }
            else {
                console.log('updating failed!');
                window.location.pathname = 'PROJECT/my-properties.php'
            }

        })
})


$('#btnUpdateProperty').click(function (e) {
    console.log('in update');

    //stop auto refresh
    e.preventDefault();

    var formData = new FormData(document.getElementById('frmUpdateProperty'));

    $.ajax({
        url: "api/api-update-property.php",
        method: 'POST',
        data: formData,
        dataType: "JSON",
        cache: false,
        contentType: false,
        processData: false
    })
        .done(function (jData) {

            if (jData.status == 1) {
                window.location.pathname = 'PROJECT/my-properties.php'
            }
            else {
                console.log('updating failed!');
                window.location.pathname = 'PROJECT/my-properties.php'
            }

        })
        
})
$('#btnSendEmail').click(function () {
    $('#emailStatus').empty();
    $('#emailStatus').html(`
        <div class="success alert-success" role="alert">
            email was sent
        </div>
    `)
    
    $.ajax({
        url: "api/api-send-email.php",
        method: "POST",
        data: $('#frmSendMail').serialize(),
        dataType: "JSON"
    })
        .done(function (jData) {
            console.log('in done')
        })
        .fail(function(){
          console.log('in fail')
            
        })
})

