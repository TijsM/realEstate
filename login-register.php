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
                        <label for="txtEmail">Email address</label>
                        <input type="text" class="form-control" id="txtLoginEmail" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
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
                register form
            </div>
        </div>
    </div>
</div>





<?php
require_once(__DIR__ . '/components/bottom.php');
?>