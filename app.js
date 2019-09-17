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
                window.location.pathname = 'PROJECT/index.php'
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
                window.location.pathname = 'PROJECT/index.php'
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
                window.location.pathname = 'PROJECT/index.php'
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
            sessionStorage.clear();
            localStorage.clear();
            window.location.pathname = 'PROJECT/login-register.php'
            if (jData.status == 1) {
               
            }
            else {
                window.location.pathname = 'PROJECT/login-register.php'
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

                $('#errorAddProp').empty();
                $('#errorAddProp').html(`
                    <div class="alert alert-danger credentialError" role="alert">
                        ${jData.message}
                    </div>
                `)

               
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

                $('#errorUpdateProp').empty();
                $('#errorUpdateProp').html(`
                    <div class="alert alert-danger credentialError" role="alert">
                        ${jData.message}
                    </div>
                `)

                // console.log('updating failed!');
                // window.location.pathname = 'PROJECT/my-properties.php'
            }

        })
})

$('#btnShowDeleted').click(function () {
    console.log('in show deleted props')


    $.ajax({
        url: "api/api-get-deleted-properties.php",
        dataType: "JSON"
    })
        .done(function (jData) {
            console.log(jData);

            jData.forEach(function (item) {
                console.log(item)

                $('#deletedProps').append(`
                <div class='list-group-item oneProp'>
                <div><strong>${item.name}</strong></div>
                <div>${item.price}</div>
                <div>${item.bedrooms}</div>
                <div>${item.location.city} - ${item.location.street}- ${item.location.houseNumber} </div>
                <div>                   
                    <a onclick=updateProperties('${item.propertyId}') id='btnRestoreProp'> <i class="fas fa-eye iconMyProperties"></i></i></a>
                </div>
             </div>
             
                `)

            })
        })
    $('#deletedProps').empty();

})

function updateProperties(id) {
    console.log('in function')
    $.ajax({
        url: `api/api-restore-property.php?propId=${id}`,
        dataType: "JSON"
    }).done(function () {
        location.reload();
    })
}

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
        .fail(function () {
            console.log('in fail')

        })
})



function fillSavedProperties(){
    console.log('in saved props');
    $.ajax({
        url: `api/api-get-saved-properties.php`,
        dataType: "JSON"
    }).done(function (jData) {
        // console.log(jData);
        $(jData).each(function(index, prop) {
        //    console.log('x');           
           $('#groupSavedProperties').append(`
            <div class="list-group-item oneProp">
                <div><strong>${prop.name}</strong></div>
                <div>${prop.price}</div>
                <div>${prop.bedrooms}</div>
                <div>${prop.location.city} ${prop.location.street} ${prop.location.houseNumber}</div>
                <div><a class="btn btn-primary" href="property-details.php?id=${prop.propertyId}" role="button">View property</a></div>
            </div>
           `);
        })
    })
}


function saveProperty(propId){
    console.log(propId);

    $.ajax({
        url: `api/api-save-property.php?propId=${propId}`,
        dataType: "JSON"
    }).done(function (jData) {
        $('#allertSaved').empty();
        $('#allertSaved').css("display", "block");
        $('#allertSaved').html(`
            ${jData.message}
        `);

        setTimeout(() => {
            $('#allertSaved').css("display", "none");
        }, 5000);
    })
}
