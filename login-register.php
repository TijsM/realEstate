<?php
require_once(__DIR__ . '/components/top.php');
?>


<div class="accordion col col-lg-6 align-self-center offset-lg-3 loginRegisterContainer" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link accordion-title" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Login
                </button>
            </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <form method="POST" id="loginForm">
                    <div class="form-group">
                        <label for="txtLoginEmail">Email address</label>
                        <input type="text" class="form-control" id="txtLoginEmail" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="txtLoginPassword">Password</label>
                        <input type="password" class="form-control" id="txtLoginPassword" name='password' placeholder="Password">
                    </div>
                    <button type="button" class="btn btn-primary" id="loginSubmit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
                <button class="btn btn-link collapsed accordion-title" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Register
                </button>
            </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="row">
                            <div class="col-4">
                                <div class="list-group " id="list-tab" role="tablist">
                                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">register as a user</a>
                                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">register as an agent</a>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                        <form method="POST" id="registerUserForm">
                                            <div class="form-group">
                                                <label for="txtRegisterUserName">Name</label>
                                                <input type="text" class="form-control" id="txtRegisterUserName" name="name" placeholder="Enter first name">
                                            </div>
                                            <div class="form-group">
                                                <label for="txtRegisterUserFamilyName">Name</label>
                                                <input type="text" class="form-control" id="txtRegisterUserFamilyName" name="familyName" placeholder="Enter family name">
                                            </div>
                                            <div class="form-group">
                                                <label for="txtRegisterUserEmail">Email address</label>
                                                <input type="text" class="form-control" id="txtRegisterUserEmail" name="email" placeholder="Enter email">
                                            </div>
                                            <div class="form-group">
                                                <label for="txtRegisterUserPassword">Password</label>
                                                <input type="password" class="form-control" id="txtRegisterUserPassword" name='password' placeholder="Password">
                                            </div>
                                            <button type="button" class="btn btn-primary" id="registerUserSubmit">Submit</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                                        <form method="POST" id="loginForm">
                                            <div class="form-group">
                                                <label for="txtRegisterAgentName">Name</label>
                                                <input type="text" class="form-control" id="txtRegisterAgentName" name="name" placeholder="Enter first name">
                                            </div>
                                            <div class="form-group">
                                                <label for="txtRegisterAgentFamilyName">Name</label>
                                                <input type="text" class="form-control" id="txtRegisterAgentFamilyName" name="familyName" placeholder="Enter family name">
                                            </div>
                                            <div class="form-group">
                                                <label for="txtRegisterAgentEmail">Email address</label>
                                                <input type="text" class="form-control" id="txtRegisterAgentEmail" name="email" placeholder="Enter email">
                                            </div>
                                            <div class="form-group">
                                                <label for="txtRegisterAgentPhone">phone number</label>
                                                <input type="password" class="form-control" id="txtRegisterAgentPhone" name='phoneNumber' placeholder="phone number">
                                            </div>
                                            <div class="form-group">
                                                <label for="txtRegisterAgentPassword">Password</label>
                                                <input type="password" class="form-control" id="txtRegisterAgentPassword" name='password' placeholder="Password">
                                            </div>

                                            <button type="button" class="btn btn-primary" id="loginSubmit">Submit</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php
require_once(__DIR__ . '/components/bottom.php');
?>